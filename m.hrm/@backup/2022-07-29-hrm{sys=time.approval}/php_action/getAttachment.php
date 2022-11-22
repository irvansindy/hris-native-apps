<?php
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

$sql = "SELECT `request_no`,`file_name`,DATE_FORMAT(`created_date`, '%d %M %Y %H:%i:%s') as `created_date` FROM hrmattachment where `request_no` = '$memberId' order by created_date desc";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);