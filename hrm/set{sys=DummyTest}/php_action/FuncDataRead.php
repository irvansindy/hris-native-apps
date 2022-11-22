<?php 
require_once '../../../application/config.php';
include "../../../model/st/GMOvertimeReasonSettingSearchGen.php";
include "../../../model/st/GMOvertimeReasonSetting.php";

$output = array('data' => array());

// $sql = $qListRender;
$getDataDummyDebug = "SELECT * FROM debug";

$query = mysqli_query($connect, $getDataDummyDebug);

// var_dump($query);
// die();

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['col1'].'`)"><u>'.$row['col1'].'</u></a>   ';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['col1'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

	$output['data'][] = array(
		$x,
		$rmintf,
		$row['col2'],
		$row['col3'],
		$row['col4'],
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP