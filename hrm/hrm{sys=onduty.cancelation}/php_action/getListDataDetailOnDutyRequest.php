<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $request_no = $_GET['request_no'];

    // get data on duty detail
    $queryGetDataDetailOnDuty = "SELECT * FROM hrdondutyrequestdtl WHERE request_no = '$request_no'";
    $resultDataDetailOnDuty = mysqli_fetch_all(mysqli_query($connect, $queryGetDataDetailOnDuty), MYSQLI_ASSOC);

    if ($resultDataDetailOnDuty == true) {
        http_response_code(200);
        $resultJson = [
            'messages' => 'Success to get all data',
            'data' => $resultDataDetailOnDuty
        ];
    } else {
        http_response_code(400);
        $resultJson = [
            'messages' => 'Failed to get all data',
            'data' => NULL
        ];
    }
    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($resultJson);