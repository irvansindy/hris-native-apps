<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    $request_no = $_POST['request_no'];
    // get data from table_suggestion_master for data master suggestion
    $query_fetch_master_data = "SELECT a.*, d.name_my AS req_status, e.Full_Name FROM table_suggestion_master a
        LEFT JOIN view_employee e ON 
            a.emp_no = e.emp_no
        LEFT JOIN hrmstatus d ON 
        (SELECT request_status FROM hrmrequestapproval
        WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
    WHERE request_no = '$request_no'";
    $result_master_data = mysqli_fetch_assoc(mysqli_query($connect, $query_fetch_master_data));
    
    // get data from table_suggestion_identify_problem_master
    $query_fetch_identify_problem_master = "SELECT * FROM table_suggestion_identify_problem_master order by id ASC";
    $result_fetch_identify_problem_master = mysqli_fetch_all(mysqli_query($connect, $query_fetch_identify_problem_master), MYSQLI_ASSOC);

    // get data from table_suggestion_identify_problem_detail
    $result_identify_problem_detail = [];
    for ($i=0; $i < count($result_fetch_identify_problem_master); $i++) { 
        $list_identify_problem_master = strtolower($result_fetch_identify_problem_master[$i]['category_name']);
        $result_identify_problem_master = str_replace(' ', '_', $list_identify_problem_master);
        
        $problem_master_id = $result_fetch_identify_problem_master[$i]['id'];
        // query eacg identify problem detail
        $query_list_identify_problem_.$result_identify_problem_master = "SELECT
                a.id,
                b.id as category_id,
                b.category_name,
                a.possible_direct_cause,
                a.request_no,
                a.created_by
            FROM table_suggestion_identify_problem_detail a
            JOIN table_suggestion_identify_problem_master b
                ON a.suggestion_identify_problem_master_id = b.id
            JOIN table_suggestion_master c
                ON a.request_no = c.request_no
            WHERE c.request_no = '$request_no'
                AND b.id = '$problem_master_id'";
        
        $result_fetch_identify_problem_detail = mysqli_fetch_all(mysqli_query($connect, $query_list_identify_problem_.$result_identify_problem_master), MYSQLI_ASSOC);

        // push all data to result list data
        array_push($result_identify_problem_detail, $result_fetch_identify_problem_detail);
    }

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

    $response = include'../a3_report/a3_report.php';

    // $response_json = [
    //     $result_master_data, //0 is data master
    //     $result_identify_problem_detail, //1 is data detail for root cause possible direct cause
    //     $result_planing_root_cause, //2 is data list for planing
    //     $result_fetch_identify_problem_master, //3 is data master root cause
    // ];

    $connect->close();
    // header('Content-Type: application/json');
	// echo json_encode($response_json);