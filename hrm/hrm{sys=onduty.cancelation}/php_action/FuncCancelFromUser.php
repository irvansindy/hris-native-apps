<?php
    require_once '../../../application/config.php';
    !empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
    if ($getdata == 0) {
        include "../../../application/session/sessionlv2.php";
    } else {
        include "../../../application/session/mobile.session.php";
    }

    $response = [
        'success' => false,
        'messages' => []
    ];

    $request_no = $_GET['request_no'];

    // var_dump($request_no);

    $exeQuery = $connect->query("UPDATE `hrmrequestapproval` SET `request_status` = '8' WHERE `request_no` = '$request_no'");

    if ($exeQuery == TRUE) {
        http_response_code(200);
        $response['success'] = true;
        $response['code'] = 'success_message';
        $response['messages'] = 'On duty cancel request has been canceled';
    } else {
        http_response_code(400);
        $response['success'] = false;
        $response['code'] = 'failed_message';
        $response['messages'] = 'Failed to cancel the On duty cancel request';
    }

    $connect->close();
    echo json_encode($response);