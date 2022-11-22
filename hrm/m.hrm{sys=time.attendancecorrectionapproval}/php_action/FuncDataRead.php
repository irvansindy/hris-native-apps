<?php 
require_once '../../../application/config.php';
include '../../../model/ta/GMAttendanceCorrectionApprovalSearchGen.php';
include '../../../model/ta/GMAttendanceCorrectionApprovalList.php';

$output = array('data' => array());

$data = $_GET['emp_id'];
$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '
	<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['attend_id'].'`)"><input type="image" src="../../asset/dist/img/icons/acticon-note.png" title="delete" style="width: 20px;"/></a>   
	';


	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['attend_id'].'`)"> </a>';


	$output['data'][] = array(
		$row['tgl'],
		$row['emp_no'],
		$row['Full_Name'],
		$row['daytype'],
		$row['att_flag_start'],
		$row['att_flag_end'],
		$rmintf



	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP