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

    if($_POST) {
        $id = $_POST['upd_id'];
        $update_shift_daily_code = $_POST['update_shift_daily_code'];
        $update_cost_code = $_POST['update_cost_code'];
        $update_max_manpower = $_POST['update_max_manpower'];
        $inp_emp_no = $_POST['inp_emp_no'];
        $update_active_status_code = $_POST['update_active_status_code'];

        $query_update_leave_group_quota = "UPDATE hrmvalleavegroup SET 
        `shiftdailycode` = '$update_shift_daily_code',
        `cost_code` = '$update_cost_code',
        `max_manpower` = '$update_max_manpower',
        `modified_by` = '$inp_emp_no',
        `modified_date` = '$modified_date',
        `active_status` = '$update_active_status_code'
        WHERE id = '$id'";

        $exe_query_update_leave_group_quota = $connect->query($query_update_leave_group_quota);

        if($exe_query_update_leave_group_quota == true) {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = "Successfully Update data";			
        } else {		
            http_response_code(400);
            $response['success'] = false;
            $response['code'] = "failed_message";
            $response['messages'] = "Failed Update data";	
        }
    
        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }