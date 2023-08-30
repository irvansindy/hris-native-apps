<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    $request_no = $_GET['request_no'];
    // get data from table_suggestion_master for data master suggestion
    $query_fetch_master_data = "SELECT * FROM table_suggestion_master WHERE request_no = '$request_no'";
    $result_master_data = mysqli_fetch_assoc(mysqli_query($connect, $query_fetch_master_data));
    
    // get data from table_suggestion_identify_problem_detail for root cause Category - Possible Direct Cause
    $query_fetch_problem_detail = "SELECT 
            a.id,
            b.id as category_id,
            a.possible_direct_cause,
            b.category_name,
            c.request_no
        FROM table_suggestion_identify_problem_detail a
        LEFT JOIN table_suggestion_identify_problem_master b 
            ON a.suggestion_identify_problem_master_id = b.id
        LEFT JOIN table_suggestion_master c
            ON a.request_no = c.request_no
        WHERE c.request_no = '$request_no'
            AND c.emp_no = '$username'
            ORDER BY category_id";
    $result_problem_detail = mysqli_fetch_all(mysqli_query($connect, $query_fetch_problem_detail), MYSQLI_ASSOC);
    
    // get data from table_suggestion_improvement_planning for Planing Root Cause
    $query_fetch_planing_root_cause = "SELECT 
            a.id,
            a.root_cause,
            b.request_no,
            b.emp_no
        FROM table_suggestion_improvement_planning a
        JOIN table_suggestion_master b
            ON a.request_no = b.request_no
        WHERE b.request_no = '$request_no'
            AND b.emp_no = '$username'";
    $result_planing_root_cause = mysqli_fetch_all(mysqli_query($connect, $query_fetch_planing_root_cause), MYSQLI_ASSOC);

    $response_json = [
        $result_master_data, //0
        $result_problem_detail, //1
        $result_planing_root_cause, //2
    ];

    $connect->close();
    header('Content-Type: application/json');
	// echo json_encode($rows);
	echo json_encode($response_json);