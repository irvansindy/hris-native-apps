<?php 
require_once '../../../application/config.php';
$rfid = $_GET['rfid'];
include "../../../model/pr/GMPerformancePlanSearchGen.php";
include "../../../model/pr/GMPerformancePlan.php";

$output = array('data' => array());

$sql = $qListRenderRevisedRemark;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	if($row['id_revised'] < '10') {
		$numbering = '0000';
	} else if ($row['id_revised'] < '100') {
		$numbering = '000';
	} else if ($row['id_revised'] < '1000') {
		$numbering = '00';
	} else {
		$numbering = '0';
	}

	$output['data'][] = array(
		'Rev-' . $numbering . $row['id_revised'],
		$row['Full_Name'] . ' [' . $row['created_by'] . '] ',
		$row['remark_revised'],
		$row['tgl']
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP