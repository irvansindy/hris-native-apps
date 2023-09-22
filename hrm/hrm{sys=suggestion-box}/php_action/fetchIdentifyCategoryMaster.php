<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    $query_fetch = "SELECT id, category_name as name FROM table_suggestion_identify_problem_master";

    $result_data = mysqli_fetch_all(mysqli_query($connect, $query_fetch), MYSQLI_ASSOC);

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($result_data);