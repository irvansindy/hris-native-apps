<?php 
    require_once '../../../application/config.php';

    $insturtor_code = $_GET['insturtor_code'];

    $data_detail = mysqli_query($connect, 
        "SELECT a.provider_code, a.provider_name, (SELECT 'selected' FROM trndinstructor b
        WHERE b.provider=a.provider_code AND  b.instructor_code = 'TRAINER0') AS selected 
        FROM trnprovider a;"
    );

    $result = mysqli_fetch_array($data_detail);

    header('Content-Type: application/json');
	echo json_encode($result);