<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

$SFnumbercon = $_GET['SFnumbercon'];

$sql = "SELECT * FROM mgtools_teodempfamily a
		WHERE 
			a.empfamily_id = '$memberId' AND
			a.request_no = '$SFnumbercon'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

