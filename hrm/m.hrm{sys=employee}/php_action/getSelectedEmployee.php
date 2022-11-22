<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT * FROM view_employee a
		LEFT JOIN users b on a.emp_id=b.username
		LEFT JOIN hrmempbank c on a.emp_id=c.emp_no
		WHERE a.emp_no = '$memberId'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

