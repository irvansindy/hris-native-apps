<?php
    require_once '../../../application/config.php';
    
    $stateId = $_GET['venue_state'];

    // print_r($stateId);
    // die();

    $getDataCity = "SELECT * FROM hrmcity WHERE state_id = '$stateId'";
    
    $query = mysqli_query($connect, $getDataCity);

    while ($row = mysqli_fetch_object($query)) {
        $result_array[] = $row;
    }
    $response = [
        'status' => 1,
        'message' =>'Success',
        'data' => $result_array
    ];
    // echo json_decode($result);
    header('Content-Type: application/json');
    echo json_encode($response);