<?php
require_once '../../../application/config.php';

$requestno			= $_POST['requestno'];
$employee			= $_POST['employee'];
$event				= $_POST['event'];
$question_type		= $_POST['question_type'];
$training_category	= $_POST['training_category'];

//$memberId = 'DO170048';

$sql = "SELECT 
			*
		FROM trndanswer a
		WHERE 
			a.emp_id = '$employee' AND 
			a.request_no = '$requestno' AND
			a.question_type = '$question_type' AND
			a.course_category = '$training_category'";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);
