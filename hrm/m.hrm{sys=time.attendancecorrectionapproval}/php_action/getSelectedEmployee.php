<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];
//$memberId = 'DO170048';

$sql = "SELECT a.*,
		b.remark_in,
		DATE_FORMAT(a.dateforcheck, '%d %b %Y') as tgl 
		FROM hrdattendance a
		LEFT JOIN hrdattcorrection b ON a.attend_id=b.attend_id
		WHERE a.attend_id = '$memberId'
		ORDER BY a.dateforcheck ASC";

$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

