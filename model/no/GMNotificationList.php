
<?php

if (!empty($_POST['empnip']) && !empty($_POST['empname'])) {
    $identitynip = $_POST['empnip'];
    $identityname = $_POST['empname'];
    $where = "WHERE (a.request_no like '$identitynip') AND (b.full_name like '%$identityname%') AND g.emp_no='$username'";
} elseif (!empty($_POST['empnip']) && empty($_POST['empname'])) {
    $identitynip = $_POST['empnip'];
    $where = "WHERE (a.request_no like '$identitynip')";
} elseif (!empty($_POST['empname'])) {
    $identityname = $_POST['empname'];
    $where = "WHERE (b.full_name like '%$identityname%')";
} else {

    // AgusPrass 03/03/2021 menambahkan AND e.request_status <> '3'
    $where = "WHERE (g.emp_no='$username' or c.emp_no='$username') and (d.code NOT IN ('0','8','5')) AND datautama.request_status <> '3'";
    // AgusPrass 03/03/2021
}

if (isset($_POST["limit"], $_POST["start"])) {
    $page = $_POST["limit"];
    $limit = $_POST["start"];
}else{
    $page = 0;
    $limit = 10;
}
// AgusPrass 05/03/2021 Merubah query biar bisa membaca leave cancellation juga

$qListRender = "SELECT 
                c.emp_no,
                c.emp_id,
                datautama.*,
                DATE_FORMAT(i.leave_startdate, '%d %b %Y' ) AS leave_startdate,
                DATE_FORMAT(i.leave_enddate, '%d %b %Y' ) AS leave_enddate,
                DATE_FORMAT(datautama.requestdate, '%d %b %Y' ) as req_date,
                h.leavename_en,
                d.name_en
                FROM
                    (
	                SELECT  a.request_no, 
	                        a.requestfor AS requestedby, 
	                        a.requestdate AS requestdate, 
	                        a.leave_code AS leave_code,
	                        a.created_date AS created_date,
	                        X.approval_list,
	                        X.status,
	                        X.request_status, 
	                        'hrmleavecancelrequest' AS remarks
	
	                FROM hrmleavecancelrequest a 
	                LEFT JOIN hrmrequestapproval X ON X.request_no = a.request_no
	                
                    UNION ALL
	                
                    SELECT  a.request_no, 
	                        a.requestedby AS requestedby, 
	                        a.requestdate AS requestdate , 
	                        a.leave_code AS leave_code ,
	                        a.created_date AS created_date,
	                        X.approval_list,
	                        X.status,
	                        X.request_status, 
	                        'hrmleaverequest' AS remarks
	
	                FROM hrmleaverequest a 
	                LEFT JOIN hrmrequestapproval X ON X.request_no = a.request_no
                    ) datautama
                LEFT JOIN teodempcompany c ON c.emp_id = datautama.requestedby
                LEFT JOIN hrmstatus d ON (SELECT request_status FROM hrmrequestapproval WHERE request_no = datautama.request_no ORDER BY `request_status` DESC limit 1)=d.code
                LEFT JOIN hrmorgstruc f on f.pos_code=datautama.approval_list
                LEFT JOIN teodempcompany g on f.position_id=g.position_id
                LEFT JOIN ttamleavetype h on datautama.leave_code=h.leave_code
                LEFT JOIN hrmleaverequest i ON i.request_no = datautama.request_no
                $where

                GROUP BY datautama.request_no
                ORDER BY datautama.created_date DESC

                LIMIT $limit, $page";

// $qListRender = "SELECT 
//                      a.*,
//                      DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
//                      DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
//                      b.emp_no,
//                      d.name_en,
//                      h.leavename_en 
//                      FROM hrmleaverequest a
//                      LEFT JOIN teodempcompany b on a.emp_id=b.emp_id
//                      -- LEFT JOIN hrmrequest c on a.request_no=c.request_no

//                      LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

//                      LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
//                      LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
//                      LEFT JOIN teodempcompany g on f.position_id=g.position_id
//                      LEFT JOIN ttamleavetype h on a.leave_code=h.leave_code

//                      $where

//                      GROUP BY a.request_no


//                      ORDER BY a.created_date DESC

//                      LIMIT $limit, $page";

// Menganti where     $where = "WHERE (g.emp_no='$username' or b.emp_no='$username') and (d.code NOT IN ('0','4','8','5')) AND e.request_status <> '3'";
// AgusPrass 05/03/2021 Merubah query biar bisa membaca leave cancellation juga
?>