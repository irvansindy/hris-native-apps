<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $letter_no = $_GET['letter_no'];
    $emp_id = $_GET['emp_id'];
    // var_dump($emp_id);
    $query_get_decree = "SELECT 
        seq_id,
        letter_no,
        template_code,
        DATE_FORMAT(letter_date, '%Y-%m-%d') AS letter_date,
        DATE_FORMAT(effective_date, '%Y-%m-%d') AS effective_date,
        letter_signee,
        letter_signee2,
        letter_receiver,
        letter_reference,
        created_date,
        created_by,
        modified_date,
        modified_by
    FROM tclmletterdocument WHERE letter_no = '$letter_no'";
    $result_get_decree = mysqli_fetch_assoc(mysqli_query($connect, $query_get_decree));

    $query_ref = "SELECT history_no, emp_id, careertransition_code, careertranstype FROM hrmemploymenthistory WHERE emp_id = '$emp_id'";

    $result_ref = mysqli_fetch_all(mysqli_query($connect, $query_ref), MYSQLI_ASSOC);

    $response_json = [
        "decree" => $result_get_decree,
        "ref" => $result_ref
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($response_json);