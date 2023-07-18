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

    // set time
    $SFdate = date("Y-m-d");
    $SFtime = date('h:i:s');
    $SFdatetime = date("Y-m-d H:i:s");
    $SFnumber = date("YmdHis");

    if ($_POST) {
        // set variable
        $input_emp_no = $_POST['input_emp_no'];
        $input_group_name = $_POST['input_group_name'];
        $input_description = $_POST['input_description'];
        $input_admin_type = $_POST['input_admin_type'];
        $input_active_status = $_POST['input_active_status'];
        $result_status = $input_active_status != null ? 1 : 0;
        $input_active_verify = $_POST['input_active_verify'];
        $result_verify = $input_active_verify != null ? 1 : 0;
        
        // set input data to database
        $query_insert_master_data = "INSERT INTO `hrmfunctionauthorization` (
            `name`,
            `description`,
            `id_admin_type`,
            `active_status`,
            `verification`,
            `emp_no`,
            `created_by`,
            `created_date`,
            `modified_by`,
            `modified_date`
        ) VALUES (
            '$input_group_name',
            '$input_description',
            '$input_admin_type',
            '$result_status',
            '$result_verify',
            '$input_emp_no',
            '$input_emp_no',
            '$SFdatetime',
            '$input_emp_no',
            '$SFdatetime'
        )";

        $execute_query_master_data = $connect->query($query_insert_master_data);

        // if ($execute_query_master_data == true && $execute_query_menu == true) {
        if ($execute_query_master_data == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Function Authorization successfully added';
        } else {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Function Authorization failed to add';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }