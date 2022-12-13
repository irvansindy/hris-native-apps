<?php
    require_once '../../../application/config.php';
    
    // $result_array = [];
    $countryId = $_GET['venue_country'];

    // print_r($countryId);
    // die();

    $getDataState = "SELECT * FROM hrmstate WHERE country_id = '$countryId'";
    
    $query = mysqli_query($connect, $getDataState);

    while ($row = mysqli_fetch_object($query)) {
        $result_array[] = $row;
    }
    $response = [
        'status' => 1,
        'message' =>'Success',
        'data' => $result_array
    ];
    
    header('Content-Type: application/json');
    echo json_encode($response);