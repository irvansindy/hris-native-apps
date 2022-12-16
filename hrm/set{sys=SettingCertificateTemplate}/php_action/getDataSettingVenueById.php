<?php 
require_once '../../../application/config.php';

$code = $_POST['venue_code'];

$getDataMaster = "SELECT * FROM trnmvenue WHERE venue_code = '$code'";
$getDataDetail = "SELECT * FROM trndvenue WHERE venue_code = '$code'";

$queryMaster = mysqli_query($connect, $getDataMaster);
$resultMaster = mysqli_fetch_assoc($queryMaster);

$queryDetail = mysqli_query($connect, $getDataDetail);
$resultDetail = [];
while ($index = mysqli_fetch_array($queryDetail)) {
    $listDetail = [
        'venue_code' => $index['venue_code'],
        'room_code' => $index['room_code'],
        'room_name' => $index['room_name'],
        'created_by' => $index['created_by'],
        'created_date' => $index['created_date'],
        'modified_by' => $index['modified_by'],
        'modified_date' => $index['modified_date']
    ];

    array_push($resultDetail, $listDetail);
}
// $resultDetail = mysqli_fetch_array($queryDetail);

$dataResults = [
    'master' => $resultMaster,
    'detail' => $resultDetail
    // 'detail' => $queryDetail
];

$connect->close();

// var_dump($dataResults);

// echo json_encode($result);
// echo json_encode($dataResults['master']['city_id']);
echo json_encode($dataResults);