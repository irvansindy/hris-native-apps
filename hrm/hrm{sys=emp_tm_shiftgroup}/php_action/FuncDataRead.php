<?php 
require_once '../../../application/config.php';
include "../../../model/eo/GMEmployeeSearchSrvSideGen.php";
include "../../../model/eo/GMEmployeeList.php";

$output = array('data' => array());

$sql = $qListRender_srvside;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['emp_id'].'`)"><u>'.$row['emp_no'].'</u></a>   ';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['emp_id'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

	$output['data'][] = array(
		$x,
		$rmintf,
		$row['Full_Name'],
		$row['pos_name_en'],
		$row['emp_id'],
		$row['emp_id'],
		$row['emp_id'],
		$row['emp_id'],
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP