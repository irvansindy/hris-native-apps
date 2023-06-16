<?php
	require_once '../../../application/config.php';
    $request_no = $_GET['request_no'];

    $queryMaster = "SELECT * FROM hrdondutyrequest WHERE request_no = '$request_no'";
    $queryDetail = "SELECT * from hrdondutyrequestdtl where request_no = '$request_no'";
    $queryDetailFirst = "SELECT * from hrdondutyrequestdtl where request_no = '$request_no' LIMIT 1";

    $exeMaster = mysqli_query($connect, $queryMaster);
    $exeDetail = mysqli_query($connect, $queryDetail);
    $exeDetailFirst = mysqli_query($connect, $queryDetailFirst);
    
    $resultMaster = mysqli_fetch_assoc($exeMaster);
    $resultDetail = mysqli_fetch_all($exeDetail, MYSQLI_ASSOC);
    $resultDetailFirst = mysqli_fetch_assoc($exeDetailFirst);

    // get data master
    $query_data_master = "SELECT
        a.request_no,
        a.emp_id,
        DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
        a.startdate,
        a.enddate,
        a.reason,
        b.Full_Name,
        a.attachment,
        b.emp_no
        FROM hrmattcorrection a LEFT JOIN view_employee b ON a.emp_id = b.emp_id 
        WHERE a.request_no = '$request_no'";
    $result_data_master = mysqli_fetch_assoc(mysqli_query($connect, $query_data_master));

    // get data detail
    $query_data_detail = "SELECT * FROM hrdattcorrection WHERE request_no = '$request_no'";
    $result_data_detail = mysqli_fetch_all(mysqli_query($connect, $query_data_detail), MYSQLI_ASSOC);

    // get detail first
    $query_detail_first = "SELECT * FROM hrdattcorrection WHERE request_no = '$request_no' LIMIT 1";
    $result_detail_first = mysqli_fetch_assoc(mysqli_query($connect, $query_detail_first));

    $return_json = [
        $result_data_master, //0
        $result_data_detail, //1
        // $result_detail_first, //2
    ];

    $connect->close();
    header('Content-Type: application/json');
	// echo json_encode($rows);
	echo json_encode($return_json);
