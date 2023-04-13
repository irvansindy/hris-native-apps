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

    $getPositionId = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
	$empPositionId = $getPositionId['position_id'];

    // get data master
    $queryMaster = "SELECT
        a.request_no,
        a.onduty_reqno,
        a.requestedby,
        a.requestfor,
        DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
        b.Full_Name,
        b.emp_no,
        c.purpose_name_en
        FROM hrmondutycancelrequest a 
            LEFT JOIN view_employee b ON a.requestfor = b.emp_id 
            LEFT JOIN hrmondutypurposetype c ON a.purpose_code = c.purpose_code
            WHERE a.request_no = '$request_no'
        GROUP BY request_no";

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

    // get status request approval
	$queryStatusApproval = "SELECT 
	COUNT(*) as is_can_approve,
    (SELECT req_master.request_no FROM hrmondutycancelrequest req_master WHERE req_master.request_no = '$request_no') AS is_avail_request,
    -- (SELECT req_master.upload_filename FROM hrmondutycancelrequest req_master WHERE req_master.request_no = '$request_no') AS is_avail_attachment,
    (SELECT 
		(CASE 
        WHEN (SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req IN ('Notification','Sequence','Required')) = '3' THEN 
        CASE
			WHEN 
				master_approval.req = 'Required' AND
				master_approval.request_status IN ('1','2') AND
				(SELECT SUM(req_approve.status) AS total_status FROM hrmrequestapproval req_approve WHERE req_approve.request_no =  master_approval.request_no AND master_approval.req = 'Sequence') IN ('0') 
				THEN 'HIDE'
				ELSE 'SHOW'
			END
		WHEN (SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req IN ('Notification','Sequence','Required')) = '2' THEN
		CASE
			WHEN 
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Notification') > 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Sequence') > 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Required') = 0
				THEN 'SHOW'
			WHEN
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Notification') > 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Sequence') = 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Required') > 0
				THEN 'SHOW'
			WHEN
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Notification') = 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Sequence') > 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Required') > 0 AND
				master_approval.req = 'Required' AND
				master_approval.request_status IN ('1','2') AND
				(SELECT SUM(req_approve.status) AS total_status FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Sequence') IN ('0')
				THEN 'HIDE'
			ELSE 'SHOW'
		END
		WHEN (SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req IN ('Notification','Sequence','Required')) = '1' THEN
		CASE
			WHEN
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Notification') > 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Sequence') = 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Required') = 0
				THEN 'SHOW'
			WHEN 
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Notification') = 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Sequence') > 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Required') = 0
				THEN 'SHOW'
			WHEN 
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Notification') = 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Sequence') = 0 AND
				(SELECT COUNT(req_approve.req) AS total_req FROM hrmrequestapproval req_approve WHERE req_approve.request_no = master_approval.request_no AND req_approve.req = 'Required') > 0
				THEN 'SHOW'
			ELSE 'SHOW'
		END
	END
    ) IN ('SHOW')) AS is_ready
    FROM hrmrequestapproval master_approval
    WHERE 
		master_approval.request_no = '$request_no' AND
		master_approval.position_id = '$empPositionId' AND
		master_approval.status = 0 AND
		master_approval.request_status IN ('1','2','3','','')";

    $exeStatusApproval = mysqli_query($connect, $queryStatusApproval);
    $resultStatusApproval = mysqli_fetch_assoc($exeStatusApproval);

    if($resultMaster == true && $resultDetail == true) {
        http_response_code(200);
        $response = [
            'messages' => 'On duty cancel request successfully fetched',
            'data' => [
                $resultMaster, //0
                $resultDetail, //1
                $resultRequestStatus, //2
                $resultStatusApproval //3
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