<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver		= strtoupper($_POST['sel_emp_no_approver']);
	$sel_approval_request_no	= strtoupper($_POST['sel_approval_request_no']);
	$key_0						= strtoupper($_POST['sel_approval_request_no']);
	$get_data_0          		= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    		= $get_data_0['position_id'];

	$get_data_1					= mysqli_query($connect, "SELECT * FROM hrdvalleave WHERE emp_id = '$flag_emp_no'");
	$get_data_print1			= mysqli_num_rows($get_data_1);

	$sql_approval_status = "UPDATE `hrmrequestapproval` SET
					`status` 		= '1',
					`_approval_time`	= '$SFdatetime'
				WHERE
					`request_no` 		= '$sel_approval_request_no' AND
					`position_id`		= '$get_data_print_0'";
	$qsql_approval_status = $connect->query($sql_approval_status);

	$get_any_request = mysqli_fetch_array(mysqli_query($connect, "SELECT
												
												COUNT(*) as total_approver,
												(SELECT 
													COUNT(*) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_approval_request_no' AND
														req IN ('Sequence','Required')) AS total_approver_without_acknowledge,
												(SELECT 
													SUM(STATUS) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_approval_request_no' AND
														req IN ('Sequence','Required')) AS total_without_acknowledge,
												SUM(STATUS) AS total
											FROM hrmrequestapproval
												WHERE
													request_no = '$sel_approval_request_no' AND
													req IN ('Notification','Sequence','Required')"));


	// IF FULLY APPROVED
	if ($get_any_request['total_approver'] == $get_any_request['total'] || $get_any_request['total'] > $get_any_request['total_approver'] || $get_any_request['total_without_acknowledge'] == $get_any_request['total_approver_without_acknowledge']) {
		$set_status = '3';

		$sql_approval_request = "UPDATE `hrmrequestapproval` SET
												`request_status` 	= '$set_status'
											WHERE
												`request_no` 		= '$sel_approval_request_no'";

		$qsql_approval_request = $connect->query($sql_approval_request);

		$sql = "SELECT * FROM `sys_deducted_leave` WHERE `leave_request_no` = '$sel_approval_request_no'";
		$get_Formula = mysqli_query($connect, $sql);
		if (mysqli_num_rows($get_Formula) > 0) {
			while ($row = mysqli_fetch_array($get_Formula)) {
				$empgetleave_id = $row['empgetleave_bal'];

				//OBJECT ORIENTED STYLE
				$getempgetleave 		= "SELECT `remaining` FROM `hrmempleavebal` WHERE `empgetleave_id` = '$empgetleave_id'";
				$result 				= $connect->query($getempgetleave);
				$rowgetempgetleave 		= $result->fetch_array(MYSQLI_ASSOC);
				$getempgetleave_r1 		= $rowgetempgetleave['remaining'] - $row['total_usage'];
				$getempgetleave_r2 		= $rowgetempgetleave['remaining'];
				//OBJECT ORIENTED STYLE

				$att_formula = "UPDATE `hrmempleavebal` SET 
														`remaining` = '$getempgetleave_r1'
												WHERE `empgetleave_id` = '$empgetleave_id'";

				$upd_status = "UPDATE `sys_deducted_leave` SET 
										`status_process` 		= '1',
										`last_remaining` 		= '$getempgetleave_r2',
										`current_remaining` 	= '$getempgetleave_r1'
										WHERE `empgetleave_bal` = '$empgetleave_id' AND leave_request_no = '$sel_approval_request_no'";

				$formula_process = $connect->query($att_formula);
				$formula_process = $connect->query($upd_status);

				if (1 == 1) {

					$validator['success'] = false;
					$validator['code'] = "success_message";
					$validator['messages'] = "Successfully approve request";
				} else {

					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = "Failed approve request";
				}
			}
		} else {
			$validator['success'] = false;
			$validator['code'] = "success_message";
			$validator['messages'] = "Successfully approve request";
		}


















	// IF PARTIALLY APPROVED
	} else {
		$set_status = '2';

		$sql_approval_request = "UPDATE `hrmrequestapproval` SET
												`request_status` 	= '$set_status'
											WHERE
												`request_no` 		= '$sel_approval_request_no'";
		$qsql_approval_request = $connect->query($sql_approval_request);

		$validator['success'] = false;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully approve request";
	}

	require_once '../../set{sys=system_function_authorization}/leave_attendance_process.php';


	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
