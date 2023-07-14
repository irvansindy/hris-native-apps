<?php 
require_once '../../../application/config.php';

$code = $_POST['certificate_code'];

$getDataMaster = "SELECT * FROM ttamcertification_template WHERE certificate_code = '$code'";

$queryMaster = mysqli_query($connect, $getDataMaster);
$resultMaster = mysqli_fetch_assoc($queryMaster);


$dataResults = [
    'master' => $resultMaster,
];

$connect->close();
echo json_encode($dataResults);