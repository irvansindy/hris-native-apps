<?php 
	error_reporting(0);
	date_default_timezone_set('Asia/Jakarta');
	require_once '../../../application/config.php';

    $request = $_POST['request'];

    $query_get_data = "SELECT * FROM berita WHERE id_berita = '$request'";
    $result_data = mysqli_fetch_assoc(mysqli_query($connect, $query_get_data));

    $return_json = [
        $result_data
    ];

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($return_json);