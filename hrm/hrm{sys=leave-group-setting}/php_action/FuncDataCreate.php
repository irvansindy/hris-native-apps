<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // set structure response json
    $response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

    // set local time
    $date_time = date("Y-m-d H:i:s");

    if ($_POST) {
        // set variable 
        $inp_shift_daily_code = $_POST['inp_shift_daily_code'];
        $inp_cost_code = $_POST['inp_cost_code'];
        $inp_max_manpower = $_POST['inp_max_manpower'];
        $inp_emp_no = $_POST['inp_emp_no'];

        $query_check_exist_data = "SELECT shiftdailycode, cost_code FROM hrmvalleavegroup WHERE shiftdailycode = '$inp_shift_daily_code' OR cost_code = '$inp_cost_code'";
        $result_check_exist_data = mysqli_num_rows(mysqli_query($connect, $query_check_exist_data));

        if ($result_check_exist_data > 0) {
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = "Leave Group Quota already exists";
        } else {
            // set query insert data
            $query_create_leave_group_quota = "INSERT INTO `hrmvalleavegroup` (
                `shiftdailycode`,
                `cost_code`,
                `max_manpower`,
                `company_id`,
                `created_by`,
                `created_date`,
                `modified_by`,
                `modified_date`,
                `active_status`
            ) VALUES (
                '$inp_shift_daily_code',
                '$inp_cost_code',
                '$inp_max_manpower',
                '13576',
                '$inp_emp_no',
                '$date_time',
                '$inp_emp_no',
                '$date_time',
                '1'
            )";
    
            $execute_query_create_leave_group_quota = $connect->query($query_create_leave_group_quota);
    
            if ($execute_query_create_leave_group_quota == true) {
                http_response_code(200);
                $response['success'] = true;
                $response['code'] = "success_message";
                $response['messages'] = 'Leave group quota successfully added';
            } else {
                http_response_code(400);
                $response['success'] = false;
                $response['code'] = "success_message";
                $response['messages'] = 'Leave group quota failed to add';
            }
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }