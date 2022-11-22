<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT *, c.Full_Name as suspect FROM whstd_request a
		LEFT JOIN view_employee b on a.created_by=b.emp_no
		LEFT JOIN view_employee c on a.suspecter=c.emp_no
		WHERE a._id_whistle = '$memberId'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

