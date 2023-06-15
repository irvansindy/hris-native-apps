<?php
	require_once '../../../application/config.php';
	!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
	if ($getdata == 0) {
		include "../../../application/session/sessionlv2.php";
	} else {
		include "../../../application/session/mobile.session.php";
	}

	$request_no = $_GET['request_no'];

	$get_position_id = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
	$emp_position = $get_position_id['position_id'];

	// get data master
	$query_master_approval = "SELECT 
		a.request_no,
		a.emp_id,
		DATE_FORMAT(a.requestdate, '%d %b %Y') as requestdate,
		-- DATE_FORMAT(a.requestenddate, '%d %b %Y') as requestenddate,
		DATE_FORMAT(a.requestdate, '%Y-%m-%d') as startDateAttendance,
		-- DATE_FORMAT(a.requestenddate, '%Y-%m-%d') as endDateAttendance,
		b.Full_Name,
		b.emp_no,
		rests.revised_remark as remark

		FROM hrmattcorrection a
		LEFT JOIN view_employee b ON a.emp_id=b.emp_id
		LEFT JOIN (
			SELECT 
			request_no,
			revised_remark,
			MAX(request_status) AS status
			FROM
			hrmrequestapproval
			-- WHERE position_id = '800023'
			WHERE position_id = '$emp_position'
			GROUP BY request_no
		) rests ON rests.request_no = a.request_no
		LEFT JOIN hrmstatus d ON d.code = rests.status
		WHERE a.request_no = '$request_no'
		-- WHERE a.request_no = 'ATR20230614114432'
		GROUP BY a.request_no";

	$result_master_approval = mysqli_fetch_assoc(mysqli_query($connect, $query_master_approval));

	// get data list approval
	$query_list_approval = "SELECT 
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

	$result_list_approval = mysqli_fetch_all(mysqli_query($connect, $query_list_approval), MYSQLI_ASSOC);

	// get status request approval
	$query_status_approval = "SELECT 
		COUNT(*) as is_can_approve,
		(SELECT req_master.request_no FROM hrmattcorrection req_master WHERE req_master.request_no = '$request_no') AS is_avail_request,
		(SELECT req_master.attachment FROM hrmattcorrection req_master WHERE req_master.request_no = '$request_no') AS is_avail_attachment,
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
			master_approval.position_id = '$emp_position' AND
			master_approval.status = 0 AND
			master_approval.request_status IN ('1','2','3','','')";

	$result_status_spproval = mysqli_fetch_assoc(mysqli_query($connect, $query_status_approval));

	// get data on duty list detail
	$get_detail_attendance_correct = "SELECT request_no, startdate AS starttime, enddate AS endtime, date_format(startdate, '%Y-%m-%d') AS startdate, date_format(enddate, '%Y-%m-%d') AS enddate FROM hrdondutyrequestdtl WHERE request_no = '$request_no'";
	$result_detail_attendance_correct = mysqli_fetch_all(mysqli_query($connect, $get_detail_attendance_correct), MYSQLI_ASSOC);

	// get data list attendance
	// $getListAttendance = "SELECT `attend_id` FROM `hrdattendance` WHERE emp_id = '$result_master_approval[requestfor]' AND DATE_FORMAT(`attend_date`, '%Y-%m-%d') BETWEEN '$result_master_approval[startDateAttendance]' AND '$result_master_approval[endDateAttendance]'";
	// $exeListAttendance = mysqli_query($connect, $getListAttendance);
	// $resultListAttendance = mysqli_fetch_all($exeListAttendance, MYSQLI_ASSOC);

    $return_json = [
        $result_master_approval, //0
        $result_list_approval, //1
		$result_status_spproval, //2
		$result_detail_attendance_correct, //3
		// $resultListAttendance, //4
    ];

    $connect->close();
    header('Content-Type: application/json');
	echo json_encode($return_json);