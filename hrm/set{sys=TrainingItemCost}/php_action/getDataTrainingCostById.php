<?php 
require_once '../../../application/config.php';

$item_code = $_POST['item_code'];

$getData = "SELECT * FROM trncost WHERE item_code = '$item_code'";

$query = mysqli_query($connect, $getData);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

