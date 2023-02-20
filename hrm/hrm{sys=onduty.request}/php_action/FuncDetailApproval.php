<?php
    require_once '../../../application/config.php';

    $request_no = $_GET['request_no'];

    // get Data Master 
    $queryMaster = "SELECT
    a.request_no,
    a.requestfor,
    DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
    DATE_FORMAT(a.requestenddate, '%d %b %Y') as requestenddate,
    a.remark,
    b.Full_Name,
    b.emp_no
    FROM hrdondutyrequest a LEFT JOIN view_employee b ON a.requestfor = b.emp_id WHERE a.request_no = '$request_no'";

    // get data list approval
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

    $exeMaster = mysqli_query($connect, $queryMaster);
    $exEApproval = mysqli_query($connect, $queryListApproval);

    $resultMaster = mysqli_fetch_assoc($exeMaster);
    $resultApproval = mysqli_fetch_all($exEApproval, MYSQLI_ASSOC);

    // get data status approval
    $queryRequestStatus = "SELECT MAX(request_status) AS status_request FROM hrmrequestapproval WHERE request_no = '$request_no'";
    $exeRequestStatus = mysqli_query($connect, $queryRequestStatus);
    $resultRequestStatus = mysqli_fetch_assoc($exeRequestStatus);

    $returnJson = [
        $resultMaster, //0
        $resultApproval, //1
        $resultRequestStatus //2
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($returnJson);