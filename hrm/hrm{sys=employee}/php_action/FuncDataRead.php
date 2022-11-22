<?php
include "../../../application/session/sessionlv2.php";
require_once '../../../application/config.php';
$user = $_GET['username'];
require_once '../../../model/gen_auth_data/_auth_data.php';
require_once '../../../model/eo/GMEmployeeList.php';

$output = array('data' => array());

$sql = $qListRender_srvside;

$query = mysqli_query($connectnect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a href="" type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" onclick="editMember(`'.$row['emp_no'].'`)">'.$row['emp_no'].'</a> ';

	$output['data'][] = array(
		$x,
        $rmintf,
        $row['Full_Name'],
        $row['gender_name'],
        $row['pos_name_en'],
        $row['join_date'],
        $row['employmentstatus_name_en'],
        $row['email'],
        $urgent,
        $row['end_date']
	);

	$x++;
}

// database connection close
$connectnect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP