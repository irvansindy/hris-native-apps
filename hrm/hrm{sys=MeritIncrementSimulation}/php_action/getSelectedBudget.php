<?php 
require_once '../../../application/config.php';

$key = $_POST['key'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*
		FROM hrmperf_comparatio_annual_budget a
	   WHERE a.ip_period = '$key'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

