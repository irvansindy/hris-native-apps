<?php 
	require_once '../../../application/config.php';

	$instructor_code = $_POST['instructor_code'];

	//$memberId = 'DO170048';

	$sql = "SELECT 
			a.*
			FROM trninstructor a
			WHERE a.instructor_code = '$instructor_code'";
			
	$query = mysqli_query($connect, $sql);
	$result = mysqli_fetch_assoc($query);

	$connect->close();

	header('Content-Type: application/json');
	echo json_encode($result);

