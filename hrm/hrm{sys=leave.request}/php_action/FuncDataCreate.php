<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$response = [
		'success' => false,
		'messages' => []
	];

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumbercon    		= 'LVR' . $SFnumber;
	$SFReqtype				= 'Attendance.leave';

	$inp_emp_no     		= $_POST['inp_emp_no'];
	$inp_token				= addslashes($_POST['inp_token']);
	$inp_requestfor 		= $_POST['inp_requestfor'];
	$modal_leave			= $_POST['modal_leave'];
	$inp_daytype			= $_POST['inp_daytype'];
	$inp_remark				= $_POST['inp_remark'];
	$inp_urgent_decl        = $_POST['inp_urgent_decl'];
	$urgent_reason        = $_POST['urgent_reason'];

	$modal_leave_start 		= $_POST['modal_leave_start'];
	$modal_leave_end 		= $_POST['modal_leave_end'];
	$inp_hdtype_starttime	= $_POST['inp_hdtype_starttime'];
	$inp_hdtype_endtime		= $_POST['inp_hdtype_endtime'];
	$inp_pdtype_starttime	= $_POST['inp_pdtype_starttime'];
	$inp_pdtype_endtime		= $_POST['inp_pdtype_endtime'];
	$inp_deductedleave		= $_POST['inp_deductedleave'];

	// check existing data leave request
	$check_leave_request = "SELECT 
		a.emp_id,
		b.Full_Name,
		c.shiftdaily_code,
		b.cost_code,
		DATE_FORMAT(a.leave_startdate, '%Y-%m-%d') AS start_date
	FROM hrmleaverequest a
		LEFT JOIN view_employee b ON a.emp_id = b.emp_id
		LEFT JOIN hrdattendance c ON b.emp_id = c.emp_id
	WHERE DATE_FORMAT(a.leave_startdate, '%Y-%m-%d') = '$modal_leave_start'
	GROUP BY a.emp_id";

	$result_leave = mysqli_fetch_assoc(mysqli_query($connect, $check_leave_request));

	// check user in same dept
	$check_user = "SELECT 
		a.emp_id,
		a.emp_no,
		a.cost_code,
		b.shiftdailycode,
		b.max_manpower,
		b.cost_code as cost,
		c.shiftdaily_code
	FROM view_employee a
		LEFT JOIN hrmvalleavegroup b ON a.cost_code = b.cost_code
		LEFT JOIN hrdattendance c ON a.emp_id = c.emp_id
	WHERE a.emp_no = '$inp_emp_no'
	-- WHERE a.emp_id = '3402202205000001'
	and DATE_FORMAT(c.attend_date, '%Y-%m-%d') = '$modal_leave_start'
	GROUP BY a.emp_id";

	$result_user = mysqli_fetch_assoc(mysqli_query($connect, $check_user));

	// echo json_encode([
	// 	'leave_cost_code' => $result_leave['cost_code'],
	// 	'leave_shiftdaily_code' => $result_leave['shiftdaily_code'],
	// 	'user_cost_code' => $result_user['cost_code'],
	// 	'user_shiftdaily_code' => $result_user['shiftdaily_code'],
	// 	'user_shiftdailycode' => $result_user['shiftdailycode'],
	// ]);

	if ($result_user['cost_code'] == $result_leave['cost_code'] && $result_user['shiftdaily_code'] == $result_leave['shiftdaily_code'] && $inp_urgent_decl == 0) {
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Tidak bisa mengajukan perizinan, harap hubungi pihak HRD";
	} else {
		// $response['messages'] = 'gak bisa gan';
		require_once '../../set{sys=system_function_authorization}/workflow_formula.php';

		$sql_leave_request_detail = "SELECT 
			b.emp_id,
			a.shiftstarttime,
			a.shiftendtime,
			d.shiftstarttime as max_shiftstarttime,
			d.shiftendtime as min_shiftendtime,
			DATE(a.shiftstarttime) as date_shift,
			MID(a.shiftstarttime,12,12) as shift_start,
			MID(a.shiftendtime,12,12) as shift_end,
			TIME_FORMAT(c.break_starttime, '%H:%i:%s') as break_starttime,
			TIME_FORMAT(c.break_endtime, '%H:%i:%s') as break_endtime,
			CASE 
				WHEN $inp_urgent_decl = '1' THEN 'Y'
				ELSE 'N'
			END AS urgent_request,
			CASE 
				WHEN '$inp_daytype' = 'FD' THEN MIN(a.shiftstarttime)
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '1' THEN MIN(a.shiftstarttime)
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '2' THEN CONCAT(DATE_FORMAT(MIN(a.shiftstarttime), '%Y-%m-%d ') , TIME_FORMAT(c.break_endtime, '%H:%i:%s'))
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '3' THEN MIN(a.shiftstarttime)
				WHEN '$inp_daytype' = 'PD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) THEN CONCAT(DATE_FORMAT(MIN(a.shiftstarttime), '%Y-%m-%d ') , '$inp_pdtype_starttime')
				ELSE MIN(a.shiftstarttime)
			END AS leave_starttime,
			CASE 
				WHEN '$inp_daytype' = 'FD' THEN MAX(a.shiftendtime)
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_hdtype_starttime' = '1' AND '$inp_hdtype_endtime' = 'noselect' THEN CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , TIME_FORMAT(c.break_starttime, '%H:%i:%s'))
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_hdtype_starttime' = '2' AND '$inp_hdtype_endtime' = 'noselect' THEN MAX(a.shiftendtime)
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_hdtype_starttime' = '3' AND '$inp_hdtype_endtime' = 'noselect' THEN MAX(a.shiftendtime)
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_hdtype_endtime' = '1' THEN CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , TIME_FORMAT(c.break_starttime, '%H:%i:%s'))
				WHEN '$inp_daytype' = 'PD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) THEN CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , '$inp_pdtype_endtime')
				ELSE MAX(a.shiftendtime)
			END AS leave_endtime,
			CASE 
				WHEN '$inp_daytype' IN ('FD','PD') THEN '3'
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '1' THEN '1'
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '2' THEN '2'
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_hdtype_endtime' = '1' THEN '1'
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_hdtype_endtime' = '2' THEN '2'
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_end' = DATE(MAX(a.shiftendtime)) AND '$inp_hdtype_endtime' = '3' THEN '3'
				ELSE '3'
			END AS dayrequesttype,
			CASE 
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' IN ('1','2') AND '$inp_hdtype_endtime' = 'noselect' THEN d.total_calculate-0.5
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '3' AND '$inp_hdtype_endtime' = 'noselect' THEN d.total_calculate
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '2' AND '$inp_hdtype_endtime' = '1' THEN d.total_calculate-1
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '3' AND '$inp_hdtype_endtime' = '1' THEN d.total_calculate-0.5
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '2' AND '$inp_hdtype_endtime' = '2' THEN d.total_calculate-0.5
				WHEN '$inp_daytype' = 'HD' AND '$modal_leave_start' = DATE(MIN(a.shiftstarttime)) AND '$inp_hdtype_starttime' = '2' AND '$inp_hdtype_endtime' = '3' THEN d.total_calculate-0.5
				WHEN '$inp_daytype' = 'PD' AND 
					(
						(
							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_starttime, '%H:%i:%s')) >
							CONCAT('$modal_leave_start ' , '$inp_pdtype_starttime') AND
							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_starttime, '%H:%i:%s')) <
							CONCAT('$modal_leave_start ' , '$inp_pdtype_endtime') 
								OR
							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_endtime, '%H:%i:%s')) >
							CONCAT('$modal_leave_start ' , '$inp_pdtype_starttime') AND
							CONCAT('$modal_leave_start ' , TIME_FORMAT(c.break_endtime, '%H:%i:%s')) <
							CONCAT('$modal_leave_start ' , '$inp_pdtype_endtime') 
						)
					) THEN
					(TIMESTAMPDIFF(MINUTE,CONCAT('$modal_leave_start ' , '$inp_pdtype_starttime'),CONCAT('$modal_leave_end ' , '$inp_pdtype_endtime'))/e.productivehours) -
					(TIMESTAMPDIFF(MINUTE,CONCAT(DATE_FORMAT(MIN(a.shiftstarttime), '%Y-%m-%d ') , TIME_FORMAT(c.break_starttime, '%H:%i:%s')),CONCAT(DATE_FORMAT(MAX(a.shiftendtime), '%Y-%m-%d ') , TIME_FORMAT(c.break_endtime, '%H:%i:%s')))/e.productivehours)
				WHEN '$inp_daytype' = 'PD' THEN (TIMESTAMPDIFF(MINUTE,CONCAT('$modal_leave_start ' , '$inp_pdtype_starttime'),CONCAT('$modal_leave_end ' , '$inp_pdtype_endtime'))/e.productivehours)
				ELSE d.total_calculate
			END AS total_days
			FROM hrdattendance a
			LEFT JOIN view_employee b on a.emp_id=b.emp_id
			LEFT JOIN hrmttadshiftbreak c on a.shiftdaily_code=c.shiftdailycode
			LEFT JOIN 
				(
					SELECT 
						sub1.emp_id,
						sub1.attend_id,
						MIN(sub1.shiftstarttime) as shiftstarttime,
						MAX(sub1.shiftendtime) as shiftendtime,
						count(sub1.daytype) as total_calculate
					FROM hrdattendance sub1
					WHERE
					sub1.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$inp_requestfor') and
					sub1.daytype IN ('WD','PHWD') and
					sub1.dateforcheck between '$modal_leave_start' and '$modal_leave_end'
				) d ON a.emp_id=d.emp_id
			LEFT JOIN hrmttamshiftdaily e on a.shiftdaily_code=e.shiftdailycode
			WHERE 
			b.emp_no = '$inp_requestfor' and
			a.daytype IN ('WD','PHWD') and
			a.dateforcheck between '$modal_leave_start' and '$modal_leave_end'
			GROUP BY a.dateforcheck
			ORDER BY a.dateforcheck ASC";

		$leave_request_detail = mysqli_query($connect, $sql_leave_request_detail );

		if (mysqli_num_rows($leave_request_detail) == '0') {
			$validator['success'] = false;
			$validator['code'] = "failed_message";
			$validator['messages'] = "0 working days" ;
			$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
			$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
			$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");
		}  

		while ($r_detail = mysqli_fetch_array($leave_request_detail)) {

			$sql_1 = "INSERT INTO hrdleaverequest 
				(
					`request_no`, 
					`company_id`, 
					`leave_date`, 
					`leave_starttime`,
					`leave_endtime`, 
					`created_by`, 
					`created_date`, 
					`modified_by`, 
					`modified_date`, 
					`cancelsts`, 
					`dayrequesttype`
				) 
				VALUES 
				(
					'$SFnumbercon', 
					'13576', 
					'$r_detail[shiftstarttime]',
					'$r_detail[leave_starttime]',
					'$r_detail[leave_endtime]',
					'$username', 
					'$SFdatetime', 
					'$username', 
					'$SFdatetime', 
					'N',
					'$r_detail[dayrequesttype]'
				)";

			$sql_2 = "SELECT
				COUNT(*) AS total,
				d.deductedleave AS deductedleave
				FROM hrdleaverequest a
				LEFT JOIN 
					(
						SELECT 
						sub1.request_no,
							MAX(sub1.request_status) as request_status
						FROM hrmrequestapproval sub1
						GROUP BY sub1.request_no
					) b on a.request_no=b.request_no
				LEFT JOIN hrmleaverequest c ON a.request_no=c.request_no
				LEFT JOIN ttamleavetype d ON c.leave_code=d.leave_code
				WHERE 
					b.request_status IN ('1','2','3','4','9') AND
					('$r_detail[leave_starttime]' BETWEEN a.leave_starttime AND a.leave_endtime OR 
					'$r_detail[leave_endtime]' BETWEEN a.leave_starttime AND a.leave_endtime) AND
					a.cancelsts = 'N'";

			$query_2 = mysqli_fetch_array(mysqli_query($connect , $sql_2));

			$sql_3 = "SELECT 
					CASE 
					WHEN SUM(c.remaining) < '$r_detail[total_days]' THEN 'notallowed'
					ELSE 'allow'
					END balance_amount
				FROM view_employee a
				LEFT JOIN hrmempleavebal c on a.emp_id=c.emp_id
				WHERE a.emp_no='$inp_requestfor' and c.leave_code = '$modal_leave' and c.active_status = '1'";

			$query_3 = mysqli_fetch_array(mysqli_query($connect , $sql_3));

			$sql_4 = "SELECT 
					a.max_req_day,
					a.min_req_day,
					CASE 
						WHEN DATEDIFF('$modal_leave_start', CURRENT_DATE()) < a.max_req_day AND $inp_urgent_decl = '0' THEN 'notallowed'
						ELSE 'allow'
					END AS urgent_permission 
				FROM hrmvalleave a 
				WHERE a.leave_code = '$modal_leave'";

			$query_4 = mysqli_fetch_array(mysqli_query($connect , $sql_4));
			
			if (!$list_approval_process) {
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Wrong approval formula" . $sql_approval ;
				$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");

			}  else if ($query_4['urgent_permission'] == 'notallowed') {
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Max request date, out of date" ;
				$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");
			
			} else if ($query_2['total'] > 0) {
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Employee having request at range date" ;
				$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");
			
			} else if ($query_3['balance_amount'] == 'notallowed') {
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Leave balance remaining not enough" ;
				$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
				$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");

			} else { 
				$query_1 = $connect->query($sql_1);

				if ($r_detail['leave_starttime'] > $r_detail['leave_endtime']) {
					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = "Leave starttime cannot more than endtime $inp_urgent_decl" ;
					$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
					$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
					$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");
		
				} else if ($query_1 == TRUE) {

					$get_request  = mysqli_fetch_array(mysqli_query($connect , 
						"SELECT A.is_approved
						FROM
							(
								SELECT CASE WHEN ((
								SELECT COUNT(*) AS total
								FROM hrmrequestapproval
								WHERE request_no = '$SFnumbercon' AND req IN ('Sequence','Required')) <= (
								SELECT COUNT(*) AS total
								FROM hrmrequestapproval
								WHERE request_no = '$SFnumbercon' AND `status` = '1' AND req IN ('Sequence','Required'))) THEN '3' ELSE '' END AS is_approved) A")
							);

					if($get_request['is_approved'] == '3') {
						$connect->query("UPDATE hrmrequestapproval 
						SET request_status = '3'
						WHERE request_no = '$SFnumbercon'");
					}

					$key_0 = $SFnumbercon; 
					$key_1 = $modal_leave; 
					$key_2 = $r_detail['total_days']; 
					$key_3 = $r_detail['emp_id'];
					$key_4 = $inp_emp_no;
					$key_5 = $inp_deductedleave;

					if($key_5 == 'Y'){
						require_once '../../set{sys=system_function_authorization}/leave_balance_formula.php';

						if ($empgetleave_formula_process) {
							$validator['success'] = false;
							$validator['code'] = "success_message";
							$validator['messages'] = "Successfully submit request";

						} else {
							$validator['success'] = false;
							$validator['code'] = "failed_message";
							$validator['messages'] = "There is something problem with leave balances";
							$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
							$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
							$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");
						}

						$connect->query("INSERT INTO hrmleaverequest
							(
								`request_no`, 
								`company_id`,
								`requestedby`, 
								`emp_id`, 
								`requestdate`, 
								`leave_code`,
								`leave_startdate`, 
								`leave_enddate`, 
								`totaldays`, 
								`remark`, 
								`approval_status`, 
								`created_by`, 
								`created_date`,
								`modified_by`, 
								`modified_date`, 
								`refdoc`,
								`urgent_reason`,
								`urgent_request`,
								`token`) 
								VALUES 
								(
									'$SFnumbercon', 
									'13576', 
									'$inp_emp_no', 
									'$r_detail[emp_id]', 
									'$SFdatetime', 
									'$modal_leave', 
									'$r_detail[max_shiftstarttime]', 
									'$r_detail[min_shiftendtime]', 
									'$r_detail[total_days]', 
									'$inp_remark' , 
									'0', 
									'$inp_emp_no', 
									'$SFdatetime', 
									'$inp_emp_no', 
									'$SFdatetime', 
									'0',
									'$urgent_reason',
									'$r_detail[urgent_request]',
									'$inp_token')
							");
					}

				} else {
					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = "Failed create request";
					$connect->query("DELETE FROM `hrmleaverequest` WHERE `request_no` = '$SFnumbercon'");
					$connect->query("DELETE FROM `hrdleaverequest` WHERE `request_no` = '$SFnumbercon'");
					$connect->query("DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$SFnumbercon'");
				}
			}
		}

	}
	// condition ends
	// close the database connection

	$connect->close();
	header('Content-Type: application/json');
	echo json_encode($validator);
}