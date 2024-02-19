<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
    include "../../../application/session/sessionlv2.php";
} else {
    include "../../../application/session/mobile.session.php";
}

require_once '../../../application/config.php';
// $user                 = $_GET['username'];
$user = mysqli_real_escape_string($connect, $_GET['username']);

$output = array('data' => array());

$sql = "SELECT 
    a.request_update_id,
    a.emp_id,
    a.emp_no,
    a.full_name,
    a.create_date,
    a.status AS status_req
FROM view_employee_update a WHERE a.emp_no = '$user' AND a.create_by = '$user' ORDER BY a.create_date DESC";

$query = mysqli_query($connect, $sql);

$number = 1;
while ($row = mysqli_fetch_assoc($query)) {

    if ($row['status_req'] == 'draft') {
        // $request_number = '<a href="" type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateEmployeeData" data-backdrop="static" data-request_id="'.$row['request_update_id'].'" class="detail_request_id" >'.$row['request_update_id'].'</a>';
        $request_number = '<a href="#" type="button" nowrap="nowrap" data-request_id="'.$row['request_update_id'].'" class="detail_request_id">'.$row['request_update_id'].'</a>';
    } else {
        $request_number = $row['request_update_id'];
    }

	$output['data'][] = array(
		$number,
        $request_number,
        $row['emp_no'],
        $row['full_name'],
        $row['create_date'],
        $row['status_req'],
	);  

	$number++;
}

// database connection close
$connect->close();
// var_dump($output);
echo json_encode($output);
// KASIH KUTIP TUH DI NIP