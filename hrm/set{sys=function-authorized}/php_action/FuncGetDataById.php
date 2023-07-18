<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';
    $request = $_GET['request'];

    $query_get_data = "SELECT a.*, b.id as admin_type_id, b.admin_type_name FROM hrmfunctionauthorization a
                        LEFT JOIN hrmadmintype b
                        ON a.id_admin_type = b.id 
                        WHERE a.id = '$request'";
    $result_data = mysqli_fetch_assoc(mysqli_query($connect, $query_get_data));

    $query_admin_type = "SELECT * FROM hrmadmintype";
    $result_admin_type = mysqli_fetch_all(mysqli_query($connect, $query_admin_type), MYSQLI_ASSOC);

    $return_json = [
        $result_data,
        $result_admin_type
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($return_json);