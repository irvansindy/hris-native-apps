<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';
    !empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
    if ($getdata == 0) {
        include "../../../application/session/sessionlv2.php";
    } else {
        include "../../../application/session/mobile.session.php";
    }

    $request_no = $_POST['request_no'];

    // get data master
    $queryMaster = "SELECT 
        a.request_no,
        a.requestfor,
        DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
        a.remark,
        b.Full_Name,
        b.emp_no,
        c.purpose_name_en
        FROM hrmondutycancelrequest a 
        LEFT JOIN view_employee b ON a.requestfor = b.emp_id 
        LEFT JOIN hrmondutypurposetype c ON a.purpose_code = c.purpose_code
        WHERE a.request_no = '$request_no'";
    
    $resultMaster = mysqli_fetch_assoc(mysqli_query($connect, $queryMaster));

    // get data detail approval
    $queryListApproval = "SELECT 
        a.position_id,
        a.req,
        b.emp_no,
        b.Full_Name,
        c.name_id as status_approve,
        CASE 
            WHEN a.`status` = '1' THEN 'Has been approved'
            ELSE 'Waiting'
            END AS req_status 
        FROM hrmrequestapproval a
        INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        INNER JOIN hrmstatus c ON a.request_status=c.code
        AND a.request_no = '$request_no' AND a.req = 'Notification'

        UNION ALL

        SELECT 
        a.position_id,
        a.req,
        b.emp_no,
        b.Full_Name,
        c.name_id as status_approve,

        CASE 
            WHEN a.`status` = '1' THEN 'Has been approved'
            ELSE 'Waiting'
            END AS req_status 
        FROM hrmrequestapproval a
        INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        INNER JOIN hrmstatus c ON a.request_status=c.code
        AND a.request_no = '$request_no' AND a.req = 'Sequence'

        UNION ALL

        SELECT 
        a.position_id,
        a.req,
        b.emp_no,
        b.Full_Name,
        c.name_id as status_approve,

        CASE 
            WHEN a.`status` = '1' THEN 'Has been approved'
            ELSE 'Waiting'
            END AS req_status 
        FROM hrmrequestapproval a
        INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
        INNER JOIN hrmstatus c ON a.request_status=c.code
        AND a.request_no = '$request_no' AND a.req = 'Required'
    ";

    $resultDetail = mysqli_fetch_all(mysqli_query($connect, $queryListApproval), MYSQLI_ASSOC);

    // get data status approval
    $queryRequestStatus = "SELECT MAX(request_status) AS status_request FROM hrmrequestapproval WHERE request_no = '$request_no'";
    $exeRequestStatus = mysqli_query($connect, $queryRequestStatus);
    $resultRequestStatus = mysqli_fetch_assoc($exeRequestStatus);

    if($resultMaster == true && $resultDetail == true) {
        http_response_code(200);
        $response = [
            'messages' => 'On duty cancel request successfully fetched',
            'data' => [
                $resultMaster,
                $resultDetail,
                $resultRequestStatus
            ]
        ];
    } else {
        http_response_code(400);
        $response = [
            'messages' => 'On duty cancel request failed to get',
            'data' => NULL
        ];
    }

    $connect->close();
    header('Content-Type: application/json');
    echo json_encode($response);