<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $letter_no = $_GET['letter_no'];
    $query_get_decree = "SELECT * FROM tclmletterdocument WHERE letter_no = '$letter_no'";
    $result_get_decree = mysqli_fetch_assoc(mysqli_query($connect, $query_get_decree));

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($result_get_decree);