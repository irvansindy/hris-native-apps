<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    include "../../../application/session/sessionlv2.php";
    require_once '../../../application/config.php';

    $menu_id = $_POST['menu_id'];

    $query_get_data = "SELECT * FROM hrmmenu WHERE menu_id = '$menu_id';";

    $result_menu = mysqli_fetch_assoc(mysqli_query($connect, $query_get_data));

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($result_menu);