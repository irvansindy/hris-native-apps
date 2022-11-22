<?php
require_once '../../../application/config.php';

$training_category 	= $_POST['training_category'];
$training_course 	= $_POST['training_course'];

$request_no           = $_POST['request_no'];
$emp_id               = $_POST['emp_id'];
$training_category    = $_POST['training_category'];
$training_course      = $_POST['training_course'];

$sql = "SELECT 
				* 
			FROM trnmquestion a                                                                 
			LEFT JOIN trndanswer b ON a.course_code=b.course_code AND b.request_no = '$request_no' AND b.emp_id = '$emp_id'";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);
