<?php 
require_once '../../../application/config.php';

$code = $_POST['provider_code'];

$getData = "SELECT * FROM trnprovider WHERE provider_code = '$code'";

$query = mysqli_query($connect, $getData);
$result = mysqli_fetch_assoc($query);

$connect->close();

echo json_encode($result);

