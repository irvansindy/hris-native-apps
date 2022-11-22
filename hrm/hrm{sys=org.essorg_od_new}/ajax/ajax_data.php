<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];
$search_rn          = $_GET['id1'];
$search_rb          = $_GET['id2'];
$search_type        = $_GET['id3'];

if(empty($search_rn) && empty($search_rb) && empty($search_type)){
    $where      = "";
}elseif(empty($search_rn) && empty($search_rb) && !empty($search_type)){
    $where      = "AND (a.request_type LIKE '%$search_type%')";
}elseif(empty($search_rn) && !empty($search_rb) && empty($search_type)){
    $where      = "AND (a.request_by LIKE '%$search_rb%' OR b.Full_Name LIKE '%$search_rb%')";
}elseif(empty($search_rn) && !empty($search_rb) && !empty($search_type)){
    $where      = "AND (a.request_by LIKE '%$search_rb%' OR b.Full_Name LIKE '%$search_rb%' OR a.request_type LIKE '%$search_type%')";
}elseif(!empty($search_rn) && empty($search_rb) && empty($search_type)){
    $where      = "AND (a.request_no LIKE '%$search_rn%')";
}elseif(!empty($search_rn) && empty($search_rb) && !empty($search_type)){
    $where      = "AND (a.request_no LIKE '%$search_rn%' OR a.request_type LIKE '%$search_type%')";
}elseif(!empty($search_rn) && !empty($search_rb) && empty($search_type)){
    $where      = "AND (a.request_no LIKE '%$search_rn%' OR a.request_by LIKE '%$search_rb%' OR b.Full_Name LIKE '%$search_rb%')";
}elseif(!empty($search_rn) && !empty($search_rb) && !empty($search_type)){
    $where      = "AND (a.request_no LIKE '%$search_rn%' OR a.request_by LIKE '%$search_rb%' OR b.Full_Name LIKE '%$search_rb%' OR a.request_type LIKE '%$search_type%')";
}

$output = array('data' => array());

$sql = "SELECT 
a.request_no,
a.request_by,
CONCAT('[', a.request_by, '] ', b.Full_Name) AS fullname,
DATE_FORMAT(a.request_date, '%d %M %Y') AS req_date,
c.pos_name_en AS req_division,
d.pos_name_en AS req_department,
g.`type`,
a.request_type,
a.status_approval,
e.name_en AS status_approval1,
a.request_status,
f.name_en AS req_status
FROM hrmorgessrequest a
LEFT JOIN view_employee b ON b.emp_no = a.request_by
LEFT JOIN hrmorgstruc c ON c.position_id = a.request_division
LEFT JOIN hrmorgstruc d ON d.position_id = a.request_department
LEFT JOIN hrmstatus e ON e.code = a.status_approval
LEFT JOIN hrmorgreqstatus f ON f.code = a.request_status
LEFT JOIN hrmorgessrequesttype g ON g.type_id = a.request_type
WHERE (a.request_no IN (SELECT
DISTINCT(x.request_no)
FROM hrmrequestapprovalessod x 
WHERE x.approval_list IN (SELECT view_employee.pos_code FROM view_employee WHERE view_employee.emp_no = '$username')
OR x.seq_id = '$username'))
$where";



$query = mysqli_query($connect, $sql);


while ($row = mysqli_fetch_assoc($query)) {

    // Get color
    if($row['status_approval'] == '1'){
        $bg_color   = '#828282';
    }elseif($row['status_approval'] == '3'){
        $bg_color   = '#098524';
    }elseif($row['status_approval'] == '4'){
        $bg_color   = '#e05f02';
    }elseif($row['status_approval'] == '5'){
        $bg_color   = '#c90000';
    }
    // Get color

    // Get color
    $bg_color_req       = '';
    if($row['request_status'] == '1'){
        $bg_color_req   = '#828282';
    }elseif($row['request_status'] == '3'){
        $bg_color_req   = '#098524';
    }elseif($row['request_status'] == '4'){
        $bg_color_req   = '#e05f02';
    }elseif($row['request_status'] == '5'){
        $bg_color_req   = '#c90000';
    }
    // Get color

    

    
    // Ambil data status request
    $sql_status_req    = mysqli_query($connect, "SELECT 
    a.code,
    a.name_en
    FROM hrmorgreqstatus a
    WHERE a.code <> '$row[request_status]'");
    // Ambil data status request

    // Ambil data status request
    $sql_status_req_selected    = mysqli_query($connect, "SELECT 
    a.code,
    a.name_en
    FROM hrmorgreqstatus a
    WHERE a.code = '$row[request_status]'");
    // Ambil data status request
    

	$prn = "<a href='../hrm{sys=org.essorg_od}/{chat}.php?param={$row["request_no"]}' target='_blank'><img src='../../asset/img/icons/acticon-note.png'></a>
    <a href='#' id1='{$row["request_no"]}' id2='{$row["request_type"]}' class='' data-toggle='modal' id='modal_view_od' data-target='#modal-view-od'><img src='../../asset/img/icons/glasses.png'></a>";



    $req_status = "<select class='input--style-6 status_req' name='status_req' id='{$row['request_no']}' style='width:120px ;height: 30px; background:{$bg_color_req}; color:white'>";

    while($data_req_sel = mysqli_fetch_assoc($sql_status_req_selected)){
        $req_status .= "<option value='{$data_req_sel["code"]}' selected>{$data_req_sel["name_en"]}</option>";
    }

    while($data_req = mysqli_fetch_assoc($sql_status_req)){
        $req_status .= "<option value='{$data_req["code"]}'>{$data_req["name_en"]}</option>";
    }
    
    $req_status .= "</select>";

	$output['data'][] = array(
		$row['request_no'],
		$row['fullname'],
		$row['req_date'],
		$row['req_division'],
		$row['req_department'],
		$row['type'],
        $row['status_approval1'],
		$req_status,
		$prn
	);

	
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>