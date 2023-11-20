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
    $date = date('Y:m:d h:i:s');
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
        ";

        $exe_query_reject_update_applicant = $connect->query($query_reject_update_applicant);

        $query_add_log_applicant_detail = "INSERT INTO `employer_applicant_detail` (
            `employer_applicant_id`,
            `application_status_id`,
            `created_at`,
            `updated_at`
        ) VALUES (
            '$applicant_number',
            '$status',
            '$date',
            '$date'
        )";
        
        $exe_query_add_log_applicant_detail = $connect->query($query_add_log_applicant_detail);

        // create new data employee
        if($status_data == 4) {
            $full_name = $_POST['hired_full_name'];
            $address = $_POST['hired_address'];
            $query_create_new_employee = include'CreateNewEmployee.php';
        }

        if ($exe_query_reject_update_applicant == FALSE || $exe_query_add_log_applicant_detail == FALSE) {
            http_response_code(400);
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