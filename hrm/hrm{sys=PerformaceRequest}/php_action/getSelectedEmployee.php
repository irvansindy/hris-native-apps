<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
		a.*,
		b.Full_Name,
		c.period_name
		FROM hrmperf_parequest_stfsc a
		LEFT JOIN view_employee b on a.requester=b.emp_no
		INNER JOIN hrmperf_set_period c on a.ip_period=c.period_id
	   WHERE a.pa_reqno = '$memberId'
	   GROUP BY a.pa_reqno";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

