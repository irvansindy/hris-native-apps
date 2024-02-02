<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $emp_no = $_GET['data_emp_no'];
    // get data user
    $query_get_user = "SELECT 
        emp_id,
        emp_no,
        Full_Name,
        birthplace,
        DATE_FORMAT(birthdate, '%Y-%m-%d') AS birthdate,
        idnumber,
        familyidnumber,
        DATE_FORMAT(start_date, '%Y-%m-%d') AS start_date,
        gender,
        religion,
        maritalstatus,
        nationality,
        phone,
        email,
        email_personal,
        address
    FROM view_employee WHERE emp_no ='$emp_no'";
    $result_get_user = mysqli_fetch_assoc(mysqli_query($connect, $query_get_user));

    // user family 
    $query_fetch_family = "SELECT a.order, a.relationship_name_id FROM hrmfamilyrelation a ORDER BY a.order asc LIMIT 11;";
    $result_get_family = mysqli_fetch_all(mysqli_query($connect, $query_fetch_family), MYSQLI_ASSOC);

    $response_json = [
        $result_get_user,
        $result_get_family
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($response_json);