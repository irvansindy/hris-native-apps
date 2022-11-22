<?php
require_once '../../../application/config.php';

$requestno 	= $_POST['requestno'];
$employee 	= $_POST['employee'];
$event		= $_POST['event'];

//$memberId = 'DO170048';

$sql = "SELECT 
			*
		FROM trnmanswer a
		WHERE a.emp_id = '$employee' AND a.request_no = '$requestno' AND course_code = '$event'";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);
