<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*
		FROM hrmovertimereason a
	   WHERE a.reason_code = '$memberId'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

