<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*,
		b.Full_Name
		FROM hrmperf_ipprequest a
		LEFT JOIN view_employee b on a.requester=b.emp_no
	   WHERE a.ipp_reqno = '$memberId'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

