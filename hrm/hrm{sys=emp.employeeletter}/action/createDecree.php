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
    $input_emp_no = $_POST['input_emp_no'];
    $input_emp_id = $_POST['input_emp_id'];
    $input_seq_number = $_POST['input_seq_number'];
    $input_decree_number = $_POST['input_decree_number'];
    $input_letter_type = $_POST['input_letter_type'];
    $input_letter_date = $_POST['input_letter_date'];
    $input_effective_date = $_POST['input_effective_date'];
    $input_letter_reference = $_POST['input_letter_reference'];

    if ($_POST) {
        $query_create_decree = "INSERT INTO `tclmletterdocument` (
            `letter_no`,
            `template_code`,
            `letter_date`,
            `effective_date`,
            `letter_signee`,
            `letter_signee2`,
            `letter_receiver`,
            `letter_file`,
            `letter_reference`,
            `created_date`,
            `created_by`,
            `modified_date`,
            `modified_by`,
            `company_id`
        ) VALUES (
            '$input_decree_number', -- letter no
            '$input_letter_type', -- letter type / template code
            '$input_letter_date', -- letter date
            '$input_effective_date', -- effective date
            '3402202107000001', -- signee 1
            '3000000000000001', -- signee 2
            '$input_emp_id', -- receiver
            '', -- file
            '$input_letter_reference',
            '$date_time',
            '$input_emp_no',
            '$date_time',
            '$input_emp_no',
            '13576'
        )";
        // var_dump($query_create_decree);
        $exe_create_decree = $connect->query($query_create_decree);
        
        $query_update_counter = "UPDATE tclmdocnumber SET 
            `seq_number` = '$input_seq_number'
            WHERE code_type = '$input_letter_type'";
        $exe_update_counter = $connect->query($query_update_counter);

        if ($exe_create_data = FALSE) {
            http_response_code(402);
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "failed_message";
            $response['messages'] = 'Decree failed to create';
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Decree successfully added';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }