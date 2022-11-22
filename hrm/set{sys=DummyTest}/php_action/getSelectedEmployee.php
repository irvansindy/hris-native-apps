<?php 
require_once '../../../application/config.php';

$col1 = $_POST['member_id'];

//$memberId = 'DO170048';

// $sql = "SELECT 
// 		a.*
// 		FROM hrmovertimereason a
// 		WHERE a.reason_code = '$memberId'";

$getData = "SELECT * FROM debug WHERE col1 = '$col1'";

$query = mysqli_query($connect, $getData);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

