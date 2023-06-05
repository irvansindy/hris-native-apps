<?php
    require_once '../../../application/config.php';
    $id = $_GET['id'];

    $query_leave_group_setting = "SELECT * FROM hrmvalleavegroup WHERE id = '$id'";
    $result_leave_group_setting = mysqli_fetch_assoc(mysqli_query($connect, $query_leave_group_setting));

    $query_shift_daily_code = "SELECT shiftdailycode FROM hrmttamshiftdaily WHERE shiftdailycode not in ('L01','JOLV')";
    $result_shift_daily_code = mysqli_fetch_all(mysqli_query($connect, $query_shift_daily_code), MYSQLI_ASSOC);
    
    $query_cost_code = "SELECT costcenter_code, costcenter_name_en FROM teomcostcenter;";
    $result_cost_code = mysqli_fetch_all(mysqli_query($connect, $query_cost_code), MYSQLI_ASSOC);

    $response = [
        $result_leave_group_setting, //0
        $result_shift_daily_code, //1
        $result_cost_code //2
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($response);