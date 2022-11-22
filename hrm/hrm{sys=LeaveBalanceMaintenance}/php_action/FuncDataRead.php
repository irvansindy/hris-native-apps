<?php 
require_once '../../../application/config.php';
include "../../../model/st/GMWorkflowSettingSearchGen.php";
include "../../../model/st/GMWorkflowSetting.php";

$output = array('data' => array());

$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['empno_appvr1'] == '' && $row['empno_appvr2'] == '' && $row['empno_appvr3'] == ''){
		$r1 = '<p style="text-align: center;background: red; height: 8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$r2 = '<p style="text-align: center;background: red; height: 8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		$r3 = '<p style="text-align: center;background: red; height: 8px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	} else {
		$r1 = $row['empno_appvr1'];
		$r2 = $row['empno_appvr2'];
		$r3 = $row['empno_appvr3'];
	}

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['emp_no'].'`)"><u>'.$row['emp_no'].'</u></a>   ';

	$output['data'][] = array(
		$x,
		$rmintf,
		$row['full_name'],
		$row['cost_code'],
		$row['request_code'],
		$r1,
		$r2,
		$r3
		
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP