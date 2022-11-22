<?php
require_once '../../../application/config.php';

$training_category 	= $_POST['training_category'];
$training_course 	= $_POST['training_course'];

$request_no         = $_POST['request_no'];
$emp_id             = $_POST['emp_id'];
$training_category  = $_POST['training_category'];
$training_course    = $_POST['training_course'];
$question_type		= $_POST['question_type'];

$sql = "SELECT
				COUNT(*) as total_answer 
			FROM trndanswer b                                                                 
			WHERE 
				b.request_no = '$request_no' AND 
				b.emp_id = '$emp_id' AND
				b.course_category = '$training_category' AND
				b.question_type = '$question_type'";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);