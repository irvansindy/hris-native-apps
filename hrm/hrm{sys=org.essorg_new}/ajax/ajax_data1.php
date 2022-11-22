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
e.name_en AS status_approval,
f.name_en AS req_status,
a.request_status
FROM hrmorgessrequest a
LEFT JOIN view_employee b ON b.emp_no = a.request_by
LEFT JOIN hrmorgstruc c ON c.position_id = a.request_division
LEFT JOIN hrmorgstruc d ON d.position_id = a.request_department
LEFT JOIN hrmstatus e ON e.code = a.status_approval
LEFT JOIN hrmorgreqstatus f ON f.code = a.request_status
LEFT JOIN hrmorgessrequesttype g ON g.type_id = a.request_type
WHERE (a.request_no IN (SELECT
DISTINCT(a.request_no)
FROM hrmrequestapprovalessod a 
WHERE a.seq_id = '$username'))
ORDER BY a.status_approval ASC";

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['request_status'] != '0'){
		$prn = "<a href='../hrm{sys=org.essorg}/{chat}.php?param={$row["request_no"]}' target='_blank'><img src='../../asset/img/icons/acticon-note.png'></a>
		<a href='#' id1='{$row["request_no"]}' id2='{$row["request_type"]}' class='' data-toggle='modal' id='modal_view_requester' data-target='#modal-view-requester'><img src='../../asset/img/icons/glasses.png'></a>";
	}else{
		$prn = "<a href='../hrm{sys=org.essorg}/{chat}.php?param={$row["request_no"]}' target='_blank'><img src='../../asset/img/icons/acticon-note.png'></a>
		<a href='#' id1='{$row["request_no"]}' id2='{$row["request_type"]}' class='' data-toggle='modal' id='modal_view_requester' data-target='#modal-view-requester'><img src='../../asset/img/icons/glasses.png'></a>";
	}

	$output['data'][] = array(
		$row['request_no'],
		$row['fullname'],
		$row['req_date'],
		$row['req_division'],
		$row['req_department'],
		$row['type'],
        $row['status_approval'],
		$row['req_status'],
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP
?>