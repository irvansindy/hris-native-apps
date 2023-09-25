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
    $time = date("H:i:s");
    $date_time = date("Y-m-d H:i:s");
    $emp_no = $_POST['planing_emp_no'];
    $request_no = $_POST['planing_request_no'];
    $suggestion_planing_step_title = $_POST['suggestion_planing_step_title'];
    $suggestion_planing_step_pic = $_POST['suggestion_planing_step_pic'];
    $suggestion_planing_master_plan = $_POST['suggestion_planing_master_plan'];
    $suggestion_planing_step_type = $_POST['suggestion_planing_step_type'];
    $suggestion_planing_step_start_date = $_POST['suggestion_planing_step_start_date'];
    $suggestion_planing_step_end_date = $_POST['suggestion_planing_step_end_date'];
    if ($_POST) {
        # code...
        // looping data for create or update planing step
        for ($i=0; $i < count($suggestion_planing_step_title) ; $i++) { 
            $start_planning = $suggestion_planing_step_start_date[$i].' '.$time;
            $end_planning = $suggestion_planing_step_end_date[$i].' '.$time;
            $query_create_data = "INSERT INTO `table_suggestion_improvement_planning_step` (
                `suggestion_improvement_planning_master_id`,
                -- `request_no`,
                `pic`,
                `type_planing`,
                `start_date`,
                `end_date`,
                `planing_step`,
                `created_at`,
                `created_by`,
                `updated_at`,
                `updated_by`
            ) VALUES (
                '$suggestion_planing_master_plan[$i]',
                '$suggestion_planing_step_pic[$i]',
                '$suggestion_planing_step_type[$i]',
                '$start_planning',
                '$end_planning',
                '$suggestion_planing_step_title[$i]',
                '$date_time',
                '$emp_no',
                '$date_time',
                '$emp_no'
            )";
    
            // $exe_create_data = mysqli_query($connect, $query_create_data);
            $exe_create_data = $connect->query($query_create_data);
        }
    
        if ($exe_create_data == FALSE) {
            http_response_code(402);
            // rollback for error response
            mysqli_rollback($connect);
            $response['success'] = false;
            $response['code'] = "success_message";
            $response['messages'] = 'Suggestion planning step failed to update';
        } else {
            http_response_code(200);
            $response['success'] = true;
            $response['code'] = "success_message";
            $response['messages'] = 'Suggestion planning step successfully updated';
        }

        $connect->close();
        header('Content-Type: application/json');
        echo json_encode($response);
    }