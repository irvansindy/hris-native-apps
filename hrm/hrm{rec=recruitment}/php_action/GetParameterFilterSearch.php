<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    // get data city
    $query_fetch_city = "SELECT city_id, city_init, city_name FROM tgemcity ORDER BY city_name ASC LIMIT 3500";
    $result_fetch_city = mysqli_fetch_all(mysqli_query($connect, $query_fetch_city), MYSQLI_ASSOC);

    // get data education
    $query_fetch_education = "SELECT * FROM sdk_edu ORDER BY edu_value ASC";
    $result_fetch_education = mysqli_fetch_all(mysqli_query($connect, $query_fetch_education), MYSQLI_ASSOC);

    // get data status
    $query_fetch_status = "SELECT * FROM application_status ORDER BY id ASC";
    $result_fetch_status = mysqli_fetch_all(mysqli_query($connect, $query_fetch_status), MYSQLI_ASSOC);

    $response_json = [
        $result_fetch_city,
        $result_fetch_education,
        $result_fetch_status
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($response_json);