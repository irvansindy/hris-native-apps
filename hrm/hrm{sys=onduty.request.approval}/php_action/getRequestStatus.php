<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
include "../../../application/session/sessionlv2.php";
} else {
include "../../../application/session/mobile.session.php";
}


$memberId = $_POST['request_no_spvdown'];
//$memberId = 'PAREQ2022-130299';

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$username'"));
$get_data_print_0    = $get_data_0['position_id'];

//$memberId = 'DO170048';

$sql = "SELECT 
	COUNT(*) AS is_approved_spvdown,
	(SELECT x1.urgent_request FROM hrmleaverequest x1 WHERE x1.request_no='$memberId') AS urg,
	(SELECT COUNT(*) AS total FROM hrmattachment x2 WHERE x2.request_no='$memberId') AS file_name,
	(SELECT (CASE
	WHEN (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req IN ('Notification','Sequence','Required')) = '3' THEN
		CASE WHEN 
		a.req = 'Required' AND 
		a.request_status IN ('1','2') AND
		(SELECT SUM(y1.`status`) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') IN ('0')
		THEN 'HIDE'
		ELSE 'SHOW'		
		END
	WHEN (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req IN ('Notification','Sequence','Required')) = '2' THEN
		CASE 
			WHEN 
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') > 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') > 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') = 0
			THEN 'SHOW'
			WHEN 
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') > 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') = 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') > 0
			THEN 'SHOW'
			WHEN 
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') = 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') > 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') > 0 AND
				a.req = 'Required' AND
				a.request_status IN ('1','2') AND
				(SELECT SUM(y1.`status`) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') IN ('0')
			THEN 'HIDE'
		ELSE 'SHOW'
		END
	WHEN (SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req IN ('Notification','Sequence','Required')) = '1' THEN
		CASE 
			WHEN 
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') > 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') = 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') = 0
			THEN 'SHOW'
			WHEN 
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') = 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') > 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') = 0
			THEN 'SHOW'
			WHEN 
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Notification') = 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Sequence') = 0 AND
				(SELECT COUNT(y1.req) AS total FROM hrmrequestapproval y1 WHERE y1.request_no=a.request_no AND y1.req = 'Required') > 0
			THEN 'SHOW'
		ELSE 'SHOW'
		END
	END) IN ('SHOW')) AS ready
	FROM 
	hrmrequestapproval a
	WHERE 
			a.request_no = '$memberId' AND
			a.position_id='$get_data_print_0' AND
			a.status = '0' AND
			a.request_status IN ('1','2','3','','')";
			// a.request_status IN ('1','2','3','4','5')";

$query = mysqli_query($connect, $sql);
$result = [mysqli_fetch_assoc($query)];

$connect->close();

echo json_encode($result);