<?php 
require_once '../../../application/config.php';
include "../../../model/st/GMOvertimeReasonSettingSearchGen.php";
include "../../../model/st/GMOvertimeReasonSetting.php";

$output = array('data' => array());

// $sql = $qListRender;
$getDataTrainingCost = "SELECT * FROM trncost";

$query = mysqli_query($connect, $getDataTrainingCost);

$number = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$dataById = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editTrainingCost(`'.$row['item_code'].'`)"><u>'.$row['item_code'].'</u></a>   ';

	$actionDelete = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="deleteTrainingCost(`'.$row['item_code'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

	$output['data'][] = array(
		$number,
		$dataById,
		$row['item_name_id'],
		$row['status'],
		$actionDelete
	);

	$number++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP