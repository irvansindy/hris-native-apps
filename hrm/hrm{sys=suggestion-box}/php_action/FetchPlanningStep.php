<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $request_no = $_GET['request_no'];
    // echo 'PHP version: ' . phpversion();
    // detail planning step
    $fetch_data_planing_step = "SELECT 
            a.planing_step,
            a.pic,
            a.type_planing,
            DATE_FORMAT(a.start_date, '%Y-%m-%d') AS start_date,
            DATE_FORMAT(a.end_date, '%Y-%m-%d') AS end_date,
            a.suggestion_improvement_planning_master_id AS master_plan_id,
            b.request_no,
            b.root_cause
        FROM table_suggestion_improvement_planning_step a
            -- RIGHT JOIN table_suggestion_improvement_planning b 
            LEFT JOIN table_suggestion_improvement_planning b 
            ON a.suggestion_improvement_planning_master_id = b.id
        WHERE b.request_no = '$request_no'
        ORDER BY a.suggestion_improvement_planning_master_id ASC
        ";
    $result_data_planing_step = mysqli_fetch_all(mysqli_query($connect, $fetch_data_planing_step), MYSQLI_ASSOC);
    
    // master planning
    $fetch_data_master_planing = "SELECT id, request_no, root_cause FROM table_suggestion_improvement_planning WHERE request_no = '$request_no'";
    $result_data_master_planing = mysqli_fetch_all(mysqli_query($connect, $fetch_data_master_planing), MYSQLI_ASSOC);

    // count all data
    $total_data_planing_step = count($result_data_planing_step);
    $total_data_master_planing = count($result_data_master_planing);
    $total_data = [
        $total_data_planing_step,
        $total_data_master_planing
    ];

    // result json
    $response_json = [
        $result_data_planing_step,
        $result_data_master_planing,
        $total_data,
    ];

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($response_json);
