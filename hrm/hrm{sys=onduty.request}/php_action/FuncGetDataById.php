<?php
	require_once '../../../application/config.php';
    $request_no = $_GET['request_no'];

    $queryMaster = "SELECT * FROM hrdondutyrequest WHERE request_no = '$request_no'";
    $queryDetail = "SELECT * from hrdondutyrequestdtl where request_no = '$request_no'";
    $queryDetailFirst = "SELECT * from hrdondutyrequestdtl where request_no = '$request_no' LIMIT 1";

    $exeMaster = mysqli_query($connect, $queryMaster);
    $exeDetail = mysqli_query($connect, $queryDetail);
    $exeDetailFirst = mysqli_query($connect, $queryDetailFirst);

    // var_dump($exeDetail->num_rows);
    // die();
    
    $resultMaster = mysqli_fetch_assoc($exeMaster);
    $resultDetail = mysqli_fetch_all($exeDetail, MYSQLI_ASSOC);
    $resultDetailFirst = mysqli_fetch_assoc($exeDetailFirst);

    $returnJson = [
        $resultMaster, //0
        $resultDetailFirst, //1
        $resultDetail, //2
    ];

    $connect->close();
    header('Content-Type: application/json');
	// echo json_encode($rows);
	echo json_encode($returnJson);
