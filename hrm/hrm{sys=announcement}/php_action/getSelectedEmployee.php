<?php 
require_once '../../../application/config.php';

$memberId = $_POST['member_id'];

//$memberId = 'DO170048';

$sql = "SELECT * FROM berita a
		WHERE a.id_berita = '$memberId'";
		
$query = mysqli_query($connect, $sql);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

