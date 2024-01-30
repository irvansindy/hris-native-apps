<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // response json
    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

    // set variable
    $date_time = date("Y-m-d H:i:s");
    $detail_emp_no = $_POST['detail_emp_no'];
    $detail_emp_id = $_POST['detail_emp_id'];
    $detail_seq_number = $_POST['detail_seq_number'];
    $detail_decree_number = $_POST['detail_decree_number'];
    $detail_letter_type = $_POST['detail_letter_type'];
    $detail_letter_date = $_POST['detail_letter_date'];
    $detail_effective_date = $_POST['detail_effective_date'];
    $detail_letter_reference = $_POST['detail_letter_reference'];

    if($_POST) {
        $query_update_decree = "UPDATE tclmletterdocument SET
            `template_code` = '$detail_letter_type',
            `letter_date` = '$detail_letter_date',
            `effective_date` = '$detail_effective_date',
            `letter_reference` = '$detail_letter_reference',
            `modified_date` = '$date_time',
            `modified_by` = '$detail_emp_no'
            WHERE `letter_no` = '$detail_decree_number'
        ";
        $exe_update_decree = $connect->query($query_update_decree);

        if ($exe_update_decree = FALSE) {
            http_response_code(402);
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "failed_message";
            $response['messages'] = 'Decree failed to update';
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Decree successfully updated';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }