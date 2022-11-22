<?php 
require_once '../../../application/config.php';
include "../../../model/st/GMParameteGeneralSettingSearchGen.php";
include "../../../model/st/GMParameteGeneralSetting.php";

$output = array('data' => array());

$sql = $qListRender;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['request_type'].'`)"><u>'.$row['request_type'].'</u></a>   ';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['request_type'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

	$output['data'][] = array(
		$x,
		$rmintf,
		$row['remarks'],
		// $prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP