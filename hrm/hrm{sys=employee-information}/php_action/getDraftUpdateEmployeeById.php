<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $request_update_id = $_GET['request_update_id'];
    // var_dump( $request_update_id );
    // fetch master update employee
    $query_fetch_update_employee = "SELECT * FROM view_employee_update WHERE request_update_id = '$request_update_id'";
    // var_dump($query_fetch_update_employee);
    $result_fetch_update_employee = mysqli_fetch_assoc(mysqli_query($connect, $query_fetch_update_employee));

    // fetch detail education update employee
    $query_fetch_education_update_employee = "SELECT * FROM employee_education_update WHERE request_update_id ='$request_update_id'";
    $result_fetch_education_update_employee = mysqli_fetch_all(mysqli_query($connect, $query_fetch_education_update_employee), MYSQLI_ASSOC);

    // fetch detail contact update employee
    $query_fetch_contact_update_employee = "SELECT * FROM employee_emergency_contact_update WHERE request_update_id ='$request_update_id'";
    $result_fetch_contact_update_employee = mysqli_fetch_all(mysqli_query($connect, $query_fetch_contact_update_employee), MYSQLI_ASSOC);

    // fetch detail family update employee
    $query_fetch_family_update_employee = "SELECT * FROM employee_family_dependent_update WHERE request_update_id ='$request_update_id'";
    $result_fetch_family_update_employee = mysqli_fetch_all(mysqli_query($connect, $query_fetch_family_update_employee), MYSQLI_ASSOC);

    $result_json = [
        $result_fetch_update_employee,
        $result_fetch_education_update_employee,
        $result_fetch_contact_update_employee,
        $result_fetch_family_update_employee
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($result_json);