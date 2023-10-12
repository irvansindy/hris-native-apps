<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    // response json
    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

    // set variable
    $json_data = json_decode($_POST['json_data']);

    $applicant_number = $_POST['value_application_id'];
    $status_data = $_POST['application_status'];
    $status = $status_data = NULL ? 5 : $status_data;
    $message_data = $status_data = NULL ? 'reject' : 'update';

    if ($_POST) {
        # code...
        $query_reject_update_applicant = "UPDATE employer_applicant SET
            `status` = '$status'
            WHERE id_applicant = '$applicant_number'
            -- WHERE id_vacancy = '$applicant_number'
        ";

        var_dump($query_reject_update_applicant);
        $exe_query_reject_update_applicant = $connect->query($query_reject_update_applicant);
        
        if ($exe_query_reject_update_applicant == FALSE) {
            http_response_code(402);
            // rollback for error response
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Applicantion data failed to '.$message_data;
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Applicantion data successfully '.$message_data;
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }