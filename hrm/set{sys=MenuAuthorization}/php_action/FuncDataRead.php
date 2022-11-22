<?php
include "../../../application/session/sessionlv2.php";
require_once '../../../application/config.php';


!empty($_GET['username']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	$user = $username;
} else {
	$user = $_GET['username'];
}

require_once '../../../model/gen_auth_data/_auth_data.php';
require_once '../../../model/eo/GMEmployeeList.php';

$output = array('data' => array());

$sql = $qListRender_srvside;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['emp_id'].'`)"> <input type="image" src="../../asset/dist/img/glasses.png" title="view menu" /></a>';

	$output['data'][] = array(
		$x,
		$row['emp_no'],
		$row['Full_Name'],
		$row['user_type'],
		"<img src='../../asset/dist/img/$row[user_status]'/>",
		"<img src='../../asset/dist/img/$row[employment_status]'/>",
		$row['pos_name_en'],
		$row['worklocation_name'],
		$row['company_name'],
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP