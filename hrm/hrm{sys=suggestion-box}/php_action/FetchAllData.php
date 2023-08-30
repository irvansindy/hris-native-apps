<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    $query_fetch_data = "SELECT 
        request_no,
        suggestion_title,
        status,
        date, emp_no
    FROM table_suggestion_master WHERE emp_no='$username'";

    $response = [
        'data' => []
    ];

    $exe_query_fetch = mysqli_query($connect, $query_fetch_data);

    $result_fetch_data = mysqli_fetch_all($exe_query_fetch, MYSQL_ASSOC);
    
    $number = 1;

    for ($i=0; $i < count($result_fetch_data); $i++) { 
        // for request number
        $link_request = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#detail_data_suggestion" data-backdrop="static" data-request_no="'.$result_fetch_data[$i]['request_no'].'" id="get_detail_suggestion">'.$result_fetch_data[$i]['request_no'].'</a>';
        // onclick="detailSuggestion(`'.$result_fetch_data[$i]['request_no'].'`)"
        // for button action
        $dummy_modal = '<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>';

        $response['data'][] = [
            $number,
            $link_request,
            $result_fetch_data[$i]['suggestion_title'],
            $result_fetch_data[$i]['date'],
            // $dummy_modal
            $result_fetch_data[$i]['status'],
        ];
        $number++;
    }

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($response);
    // echo json_encode($response['data'][0][1]);