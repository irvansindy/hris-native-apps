<?php 
require_once 'koneksi.php';

if($_GET['action'] == "table_data"){


		$columns = array( 
	                            0 => 'a.request_no', 
	                            1 => 'b.Full_Name',
	                            2 => 'a.request_date',
	                            3 => 'c.pos_name_en',
                                4 => 'd.pos_name_en', 
	                            5 => 'a.position_name',
	                            6 => 'g.`type`',
	                            7 => 'e.name_en',
                                8 => 'f.name_en',
	                        );

		$querycount = $mysqli->query("SELECT 
        COUNT(a.request_no) as jumlah
        FROM hrmorgessrequest a");
		$datacount = $querycount->fetch_array();
	
  
        $totalData = $datacount['jumlah'];
            
        $totalFiltered = $totalData; 

        $limit = $_POST['length'];
        $start = $_POST['start'];
        $order = $columns[$_POST['order']['0']['column']];
        $dir = $_POST['order']['0']['dir'];
            
        if(empty($_POST['search']['value']))
        {            
        	$query = $mysqli->query("SELECT 
            a.request_no,
            a.request_by,
            CONCAT('[', a.request_by, '] ', b.Full_Name) AS fullname,
            DATE_FORMAT(a.request_date, '%d %M %Y') AS req_date,
            c.pos_name_en AS req_division,
            d.pos_name_en AS req_department,
            a.position_name,
            g.`type`,
            a.request_type,
            e.name_en AS status_approval,
            f.name_en AS req_status
            FROM hrmorgessrequest a
            LEFT JOIN view_employee b ON b.emp_no = a.request_by
            LEFT JOIN hrmorgstruc c ON c.position_id = a.request_division
            LEFT JOIN hrmorgstruc d ON d.position_id = a.request_department
            LEFT JOIN hrmstatus e ON e.code = a.status_approval
            LEFT JOIN hrmorgreqstatus f ON f.code = a.request_status
            LEFT JOIN hrmorgessrequesttype g ON g.type_id = a.request_type
            ORDER BY $order $dir
        																LIMIT $limit 
        																OFFSET $start");
        }
        else {
            $search = $_POST['search']['value']; 
            $query = $mysqli->query("SELECT id,nama,no_hp FROM tbl_kontak WHERE nama LIKE '%$search%' 
            															or no_hp LIKE '%$search%' 
            															order by $order $dir 
            															LIMIT $limit 
            															OFFSET $start");


           $querycount = $mysqli->query("SELECT count(id) as jumlah FROM tbl_kontak WHERE nama LIKE '%$search%' 
       																						or no_hp LIKE '%$search%'");
		   $datacount = $querycount->fetch_array();
           $totalFiltered = $datacount['jumlah'];
        }

        $data = array();
        if(!empty($query))
        {
            $no = $start + 1;
            while ($r = $query->fetch_array())
            {
                $nestedData['request_no'] = $r['request_no'];
                $nestedData['Full_Name'] = $r['fullname'];
                $nestedData['request_date'] = $r['req_date'];
                $nestedData['pos_name_en_1'] = $r['req_division'];
                $nestedData['pos_name_en_2'] = $r['req_department'];
                $nestedData['position_name'] = $r['position_name'];
                $nestedData['request_type'] = $r['type'];
                $nestedData['name_en_1'] = $r['status_approval'];
                $nestedData['name_en_2'] = $r['req_status'];
                $nestedData['aksi'] = "<a href='#' id='{$r["request_no"]}' class='open_view_reqno'><img src='../../asset/img/icons/acticon-note.png'></a>
                <a href='#' id1='{$r["request_no"]}' id2='{$r["request_type"]}' class='' data-toggle='modal' id='modal_view_requester' data-target='#modal-view-requester'><img src='../../asset/img/icons/glasses.png'></a>";
                $data[] = $nestedData;
                $no++;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($_POST['draw']),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 

}