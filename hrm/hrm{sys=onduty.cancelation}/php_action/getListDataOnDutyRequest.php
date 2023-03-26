<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    // get user
    $emp_no = $_GET['empno'];
    $getUser = "SELECT emp_id FROM view_employee WHERE emp_no = '$emp_no'";
    $resultGetUser = mysqli_fetch_assoc(mysqli_query($connect, $getUser));
    $emp_id = $resultGetUser['emp_id'];
    
    // get data onduty request
    $queryGetDataOnDuty = "SELECT
        a.request_no,
        b.emp_id,
        c.purpose_name_en,
        d.name_en,
        a.requestdate,
        a.requestenddate
    FROM hrdondutyrequest a
    LEFT JOIN view_employee b ON a.requestfor=b.emp_id
    INNER JOIN hrmondutypurposetype c ON a.purpose_code = c.purpose_code
    LEFT JOIN hrmstatus d ON (SELECT request_status FROM hrmrequestapproval 
        WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1) = d.code
    WHERE b.emp_id = '$emp_id'
    AND (d.code IN ('3'))
    GROUP BY request_no;";
    $resultGetDataOnDuty = mysqli_fetch_all(mysqli_query($connect, $queryGetDataOnDuty), MYSQLI_ASSOC);

    if($resultGetDataOnDuty == true) {
        http_response_code(200);
        $resultJson = [
            'messages' => 'Success to get all data',
            'data' => $resultGetDataOnDuty
        ];
    } else {
        http_response_code(400);
        $resultJson = [
            'messages' => 'Failed to get all data',
            'data' => NULL
        ];
    }

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($resultJson);