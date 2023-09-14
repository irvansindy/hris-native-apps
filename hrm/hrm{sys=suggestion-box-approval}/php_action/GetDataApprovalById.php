<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';

    $request_no = $_GET['request_no'];

    // get data from table_suggestion_master for data master suggestion
    $query_fetch_master_data = "SELECT 
    a.request_no,
    a.suggestion_title AS title,
    b.Full_name AS name,
    DATE_FORMAT(a.date, '%d %b %Y') AS request_date
        FROM table_suggestion_master a
        JOIN view_employee b ON a.emp_no = b.emp_no
    WHERE request_no = '$request_no'";
    $result_master_data = mysqli_fetch_assoc(mysqli_query($connect, $query_fetch_master_data));

    // get data list approval
	$queryListApproval = "SELECT 
	a.position_id,
	a.req,
	b.emp_no,
	b.Full_Name,
	c.name_my as status_approve,
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
	c.name_my as status_approve,

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
	c.name_my as status_approve,

	CASE 
		WHEN a.`status` = '1' THEN 'Has been approved'
		ELSE 'Waiting'
		END AS req_status 
	FROM hrmrequestapproval a
	INNER JOIN view_employee b ON a.position_id=b.position_id AND (b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')
	INNER JOIN hrmstatus c ON a.request_status=c.code
	AND a.request_no = '$request_no' AND a.req = 'Required'
	";

	$exeApproval = mysqli_query($connect, $queryListApproval);
	$resultApproval = mysqli_fetch_all($exeApproval, MYSQLI_ASSOC);

    $response_json = [
        $result_master_data, //0 is data master
        $resultApproval //1 is data approval
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($response_json);