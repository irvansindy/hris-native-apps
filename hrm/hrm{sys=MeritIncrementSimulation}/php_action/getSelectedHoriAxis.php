<?php 
require_once '../../../application/config.php';

$key0 = $_POST['key0'];
$key1 = $_POST['key1'];
$key2 = $_POST['key2'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*
		FROM hrmperf_comparatio a
	   WHERE 
	   		a.index_percentage_horizontal = '$key0' AND
			a.ip_period = '$key1' AND
			a.compa_ratio_id = '$key2'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

