<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $request_no = $_GET['request_no'];
    $requestby = $_GET['requestby'];
    // get data on duty master 
    $queryGetDataMasterOnDuty = "SELECT
        a.request_no,
        a.requestfor,
        a.purpose_code,
        b.purpose_name_en,
        a.remark,
        c.emp_no,
        c.Full_Name
    FROM hrdondutyrequest a
    JOIN hrmondutypurposetype b ON a.purpose_code = b.purpose_code
    JOIN view_employee c ON a.requestfor = c.emp_id
    WHERE a.request_no = '$request_no'
    GROUP BY request_no";
    $resultDataMasterOnDuty = mysqli_fetch_all(mysqli_query($connect, $queryGetDataMasterOnDuty), MYSQLI_ASSOC);

    // get data on duty detail
    $queryGetDataDetailOnDuty = "SELECT * FROM hrdondutyrequestdtl WHERE request_no = '$request_no'";
    $resultDataDetailOnDuty = mysqli_fetch_all(mysqli_query($connect, $queryGetDataDetailOnDuty), MYSQLI_ASSOC);

    if ($resultDataDetailOnDuty == true) {
        http_response_code(200);
        $resultJson = [
            'messages' => 'Success to get all data',
            'data' => [
                $resultDataMasterOnDuty,
                $resultDataDetailOnDuty
            ],
            'requestby' => $requestby
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