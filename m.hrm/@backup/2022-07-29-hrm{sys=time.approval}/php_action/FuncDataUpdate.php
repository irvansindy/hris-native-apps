<?php 
require_once '../../../application/config.php';
//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver		= strtoupper($_POST['sel_emp_no_approver']);

	$sel_approval_request_no	= strtoupper($_POST['sel_approval_request_no']);

	$flag_is_deducted 		= mysqli_fetch_array(mysqli_query($connect, "SELECT 
													b.deductedleave, 
													a.leave_code, 
													a.emp_id,
													a.totaldays,
													c.emp_no,
													DATE(a.leave_startdate) as leave_startdate,
													DATE(a.leave_enddate) as leave_enddate
												FROM 
												hrmleaverequest a
												LEFT JOIN ttamleavetype b ON a.leave_code=b.leave_code
												LEFT JOIN view_employee c ON a.emp_id =c.emp_id
												WHERE a.request_no = '$sel_approval_request_no'"));
	$flag_is_deducted_print	= $flag_is_deducted['deductedleave'];
	$flag_emp_id			= $flag_is_deducted['emp_id'];
	$flag_emp_no			= $flag_is_deducted['emp_no'];
	$flag_totaldays		= $flag_is_deducted['totaldays'];
	$flag_leavecode		= $flag_is_deducted['leave_code'];
	$flag_leave_startdate	= $flag_is_deducted['leave_startdate'];
	$flag_leave_enddate		= $flag_is_deducted['leave_enddate'];

	$get_data_0          	= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    	= $get_data_0['position_id'];

	$get_data_1			= mysqli_query($connect, "SELECT * FROM hrdvalleave WHERE emp_id = '$flag_emp_no'");
	$get_data_print1		= mysqli_num_rows($get_data_1);

	// CEK APAKAH MENGGUNAKAN CUTI LAMA DAN BARU ATAU SALAH SATU
	// CEK APAKAH MENGGUNAKAN CUTI LAMA DAN BARU ATAU SALAH SATU
	$get_data_31          	= mysqli_query($connect, "SELECT 
										a.empgetleave_id
									FROM hrmempleavebal a
									WHERE 
										a.emp_id = '$flag_emp_id'
										AND a.leave_code = '$flag_leavecode'
										AND ('$flag_leave_startdate' BETWEEN DATE(a.startvaliddate) and DATE(a.endvaliddate))");
	$get_data_31s          	= "SELECT 
										a.empgetleave_id
									FROM hrmempleavebal a
									WHERE 
										a.emp_id = '$flag_emp_id'
										AND a.leave_code = '$flag_leavecode'
										AND ('$flag_leave_startdate' BETWEEN DATE(a.startvaliddate) and DATE(a.endvaliddate))";
	$get_data_32          	= mysqli_query($connect, "SELECT 
										 a.empgetleave_id
									FROM hrmempleavebal a
									WHERE 
										a.emp_id = '$flag_emp_id'
										AND a.leave_code = '$flag_leavecode'
										AND ('$flag_leave_enddate' BETWEEN DATE(a.startvaliddate) and DATE(a.endvaliddate))");
	$request_use_old_balance	= mysqli_num_rows($get_data_31);
	$request_use_new_balance	= mysqli_num_rows($get_data_32);
	// CEK APAKAH MENGGUNAKAN CUTI LAMA DAN BARU ATAU SALAH SATU
	// CEK APAKAH MENGGUNAKAN CUTI LAMA DAN BARU ATAU SALAH SATU

	// CEK LEAVE BALANCE DARI MASING MASING PERIODE CUTI LAMA DAN BARU
	// CEK LEAVE BALANCE DARI MASING MASING PERIODE CUTI LAMA DAN BARU
	$q1 = "SELECT a.empgetleave_id,
			SUM(a.remaining) AS total_remaining,
			COUNT(*) AS total
		FROM hrmempleavebal a
		WHERE 
			a.emp_id = '$flag_emp_id' 
			AND a.leave_code = '$flag_leavecode'
			AND a.remaining > 0
			AND a.active_status = '1'
			AND ('$flag_leave_startdate' BETWEEN DATE(a.startvaliddate) and DATE(a.endvaliddate) OR
			'$flag_leave_enddate' BETWEEN DATE(a.startvaliddate) and DATE(a.endvaliddate))";
	$q2 = "SELECT c.empgetleave_id,
		(SELECT REPLACE(SUM(x1.remaining),',','.') 
				FROM hrmempleavebal x1 
				WHERE c.emp_id=x1.emp_id AND x1.leave_code='$flag_leavecode' and x1.active_status = '1'
				GROUP BY x1.empgetleave_id
				ORDER BY x1.startvaliddate ASC LIMIT 1) AS remaining
			FROM hrmempleavebal c
			WHERE
		c.emp_id = '$flag_emp_id' AND
		c.active_status = '1' AND
		c.leave_code = '$flag_leavecode' AND
		('$flag_leave_startdate' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate) OR
		'$flag_leave_enddate' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate))
		ORDER BY startvaliddate ASC LIMIT 1";
	$q3 = "SELECT c.empgetleave_id,
		(SELECT REPLACE(SUM(x1.remaining),',','.') 
				FROM hrmempleavebal x1 
				WHERE c.emp_id=x1.emp_id AND x1.leave_code='$flag_leavecode' and x1.active_status = '1'
				GROUP BY x1.empgetleave_id
				ORDER BY x1.startvaliddate DESC LIMIT 1) AS remaining
			FROM hrmempleavebal c
			WHERE 
		c.emp_id = '$flag_emp_id' and
		c.active_status = '1' and
		c.leave_code = '$flag_leavecode' AND 
		('$flag_leave_startdate' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate) OR
		'$flag_leave_enddate' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate))
		ORDER BY startvaliddate DESC LIMIT 1";
	$all_leave_balance 			= mysqli_num_rows(mysqli_query($connect, "$q1"));
	$total_leave_balance 		= mysqli_fetch_array(mysqli_query($connect, "$q1"));
	$old_leave_balance 			= mysqli_fetch_array(mysqli_query($connect, "$q2"));
	$new_leave_balance 			= mysqli_fetch_array(mysqli_query($connect, "$q3"));

	$QGet_empgetleave_id_first_r 	= $old_leave_balance['empgetleave_id'];
	$QGet_empgetleave_id_second_r 	= $new_leave_balance['empgetleave_id'];
	$QGet_remaining_id_first_r 		= $old_leave_balance['remaining'];
	$QGet_remaining_id_second_r 	= $new_leave_balance['remaining'];

	// CEK LEAVE BALANCE DARI MASING MASING PERIODE CUTI LAMA DAN BARU
	// CEK LEAVE BALANCE DARI MASING MASING PERIODE CUTI LAMA DAN BARU
	
	// UPDATE DULU SIAPA APPROVERNYA AGAR DISET SEBAGAI SUDAH APPROVED
	// UPDATE DULU SIAPA APPROVERNYA AGAR DISET SEBAGAI SUDAH APPROVED
	$sql = "UPDATE `hrmrequestapproval` SET
					`status` 		= '1'
				WHERE
					`request_no` 		= '$sel_approval_request_no' AND
					`position_id`		= '$get_data_print_0'";

	$sql_if_fail = "UPDATE `hrmrequestapproval` SET
					`status` 		= '0'
				WHERE
					`request_no` 		= '$sel_approval_request_no' AND
					`position_id`		= '$get_data_print_0'";

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '19'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '20'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);

	if($query == TRUE) {
		$var1_use_for_all	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$flag_totaldays) AS total"));

		

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

		if($get_any_request['total_approver'] == $get_any_request['total']){
			$set_status = '3';
			$condition  = 'ZMAR';

			if($total_leave_balance['total_remaining'] >= $flag_totaldays) {
				$data_print = "ZMAR_CON1";
				if($QGet_remaining_id_first_r >= $flag_totaldays){
					$data_print = "ZMAR_CON1.1";
					$old_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$flag_totaldays) AS total"));
					$q4 		=  "UPDATE hrmempleavebal SET 
										remaining = '$old_processing[total]',
										modified_by = '$sel_emp_no_approver',
										remark = '$data_print | $QGet_remaining_id_first_r - $old_processing[total]'
									WHERE
								empgetleave_id = '$QGet_empgetleave_id_first_r'";
					$q4_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_first_r',
																'$flag_totaldays',
																'$old_processing[total]',
																'$data_print', 
																'$SFdatetime'
															)";

				} else if($QGet_remaining_id_first_r < $flag_totaldays){
					$data_print = "ZMAR_CON1.2";
					if(var1_use_for_all['total'] >= '0'){
						$old_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$QGet_remaining_id_first_r) AS total"));
						$mid_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($flag_totaldays-$QGet_remaining_id_first_r) AS total"));
						$new_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_second_r-$mid_processing[total]) AS total"));
						
						$q4 		=  "UPDATE hrmempleavebal SET 
											remaining = '$old_processing[total]',
											modified_by = '$sel_emp_no_approver',
											remark = '$data_print | $QGet_remaining_id_first_r - $old_processing[total]'
										WHERE
									empgetleave_id = '$QGet_empgetleave_id_first_r'";
						$q5 		=  "UPDATE hrmempleavebal SET 
											remaining = '$new_processing[total]',
											modified_by = '$sel_emp_no_approver',
											remark = '$data_print | $QGet_remaining_id_second_r - $old_processing[total]'
										WHERE
									empgetleave_id = '$QGet_empgetleave_id_second_r'";

						$q4_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_first_r',
																'$QGet_remaining_id_first_r',
																'$old_processing[total]',
																'$data_print',
																'$SFdatetime'
															)";
						$q5_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_second_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_second_r',
																'$mid_processing[total]',
																'$new_processing[total]',
																'$data_print', 
																'$SFdatetime'
															)";

					}

				} else {
					$q4 		=  "SELECT * FROM hrmempleavebalX";
					$q5 		=  "SELECT * FROM hrmempleavebalX";
				}
			}

		} else if($get_any_request['total_without_acknowledge'] == $get_any_request['total_approver_without_acknowledge']){
			$set_status = '3';
			$condition  = 'ZMAQ';

			if($total_leave_balance['total_remaining'] >= $flag_totaldays) {
				$data_print = "ZMAQ_CON1";
				if($QGet_remaining_id_first_r >= $flag_totaldays){
					$data_print = "ZMAQ_CON1.1";
					$old_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$flag_totaldays) AS total"));
					$q4 		=  "UPDATE hrmempleavebal SET 
										remaining = '$old_processing[total]',
										modified_by = '$sel_emp_no_approver',
										remark = '$data_print | $QGet_remaining_id_first_r - $old_processing[total]'
									WHERE
								empgetleave_id = '$QGet_empgetleave_id_first_r'";
					$q4_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_first_r',
																'$flag_totaldays',
																'$old_processing[total]',
																'$data_print', 
																'$SFdatetime'
															)";

				} else if($QGet_remaining_id_first_r < $flag_totaldays){
					$data_print = "ZMAQ_CON1.2";
					if(var1_use_for_all['total'] >= '0'){
						$old_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$QGet_remaining_id_first_r) AS total"));
						$mid_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($flag_totaldays-$QGet_remaining_id_first_r) AS total"));
						$new_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_second_r-$mid_processing[total]) AS total"));
						
						$q4 		=  "UPDATE hrmempleavebal SET 
											remaining = '$old_processing[total]',
											modified_by = '$sel_emp_no_approver',
											remark = '$data_print | $QGet_remaining_id_first_r - $old_processing[total]'
										WHERE
									empgetleave_id = '$QGet_empgetleave_id_first_r'";
						$q5 		=  "UPDATE hrmempleavebal SET 
											remaining = '$new_processing[total]',
											modified_by = '$sel_emp_no_approver',
											remark = '$data_print | $QGet_remaining_id_second_r - $old_processing[total]'
										WHERE
									empgetleave_id = '$QGet_empgetleave_id_second_r'";

						$q4_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_first_r',
																'$QGet_remaining_id_first_r',
																'$old_processing[total]',
																'$data_print',
																'$SFdatetime'
															)";
						$q5_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_second_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_second_r',
																'$mid_processing[total]',
																'$new_processing[total]',
																'$data_print', 
																'$SFdatetime'
															)";

					}

				} else {
					$q4 		=  "SELECT * FROM hrmempleavebalX";
					$q5 		=  "SELECT * FROM hrmempleavebalX";
				}

			} else if($total_leave_balance['total_remaining'] < $flag_totaldays && $get_data_print1 == '0' ) {
				$data_print = "pinjam cuti tidak diijinkan";
				$condition  = 'ZMAF';

					$q4 		=  "SELECT * FROM hrmempleavebalX";
					$q5 		=  "SELECT * FROM hrmempleavebalX";
			} else if($total_leave_balance['total_remaining'] < $flag_totaldays && $get_data_print1 == '1' ) {
				$data_print = "pinjam cuti diijinkan";
				$condition  = 'ZMAG';

					$old_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$flag_totaldays) AS total"));
					$q4 		=  "UPDATE hrmempleavebal SET 
											remaining = '$old_processing[total]',
											modified_by = '$sel_emp_no_approver',
											remark = '$data_print | $QGet_remaining_id_first_r - $old_processing[total]'
										WHERE
									empgetleave_id = '$QGet_empgetleave_id_first_r'";
					$q4_log	=  "INSERT INTO `sys_deductedleave_log` 
									(
										`empgetleave_id`, 
										`leaverequest_no`, 
										`total_current_remaining`,
										`total_days`,
										`total_remaining`,
										`message`, 
										`created_date`
									) VALUES 
										(
											'$QGet_empgetleave_id_first_r', 
											'$sel_approval_request_no', 
											'$QGet_remaining_id_first_r',
											'$flag_totaldays',
											'$old_processing[total]',
											'$data_print', 
											'$SFdatetime'
										)";
			} else {
				$data_print = "no condition";
				$q4 		=  "SELECT * FROM hrmempleavebalX";
				$q5 		=  "SELECT * FROM hrmempleavebalX";
			}

		} else if($get_any_request['total'] > $get_any_request['total_approver']){
			$set_status = '3';
			$condition  = 'ZMAE';
			
			if($total_leave_balance['total_remaining'] >= $flag_totaldays) {
				$data_print = "ZMAE_CON1";
				if($QGet_remaining_id_first_r >= $flag_totaldays){
					$data_print = "ZMAE_CON1.1";
					$old_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$flag_totaldays) AS total"));
					$q4 		=  "UPDATE hrmempleavebal SET 
										remaining = '$old_processing[total]',
										modified_by = '$sel_emp_no_approver',
										remark = '$data_print | $QGet_remaining_id_first_r - $old_processing[total]'
									WHERE
								empgetleave_id = '$QGet_empgetleave_id_first_r'";
					$q4_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_first_r',
																'$flag_totaldays',
																'$old_processing[total]',
																'$data_print', 
																'$SFdatetime'
															)";

				} else if($QGet_remaining_id_first_r < $flag_totaldays){
					$data_print = "ZMAE_CON1.2";
					if(var1_use_for_all['total'] >= '0'){
						$old_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_first_r-$QGet_remaining_id_first_r) AS total"));
						$mid_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($flag_totaldays-$QGet_remaining_id_first_r) AS total"));
						$new_processing	= mysqli_fetch_array(mysqli_query($connect, "SELECT SUM($QGet_remaining_id_second_r-$mid_processing[total]) AS total"));
						
						$q4 		=  "UPDATE hrmempleavebal SET 
											remaining = '$old_processing[total]',
											modified_by = '$sel_emp_no_approver',
											remark = '$data_print | $QGet_remaining_id_first_r - $old_processing[total]'
										WHERE
									empgetleave_id = '$QGet_empgetleave_id_first_r'";
						$q5 		=  "UPDATE hrmempleavebal SET 
											remaining = '$new_processing[total]',
											modified_by = '$sel_emp_no_approver',
											remark = '$data_print | $QGet_remaining_id_second_r - $old_processing[total]'
										WHERE
									empgetleave_id = '$QGet_empgetleave_id_second_r'";

						$q4_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_first_r',
																'$QGet_remaining_id_first_r',
																'$old_processing[total]',
																'$data_print',
																'$SFdatetime'
															)";
						$q5_log	=  "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_current_remaining`,
															`total_days`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_second_r', 
																'$sel_approval_request_no', 
																'$QGet_remaining_id_second_r',
																'$mid_processing[total]',
																'$new_processing[total]',
																'$data_print', 
																'$SFdatetime'
															)";

					}

				} else {
					$q4 		=  "SELECT * FROM hrmempleavebalX";
					$q5 		=  "SELECT * FROM hrmempleavebalX";
				}
			}
		} else	{
			$condition  = 'ZMAW';
			$set_status = '2';
		}
		
		$sql_if_success2 = "UPDATE `hrmrequestapproval` SET
					`request_status` 	= '$set_status'
				WHERE
					`request_no` 		= '$sel_approval_request_no'";

		$sql_if_fail2 = "UPDATE `hrmrequestapproval` SET
					`request_status` 	= '2'
				WHERE
					`request_no` 		= '$sel_approval_request_no'";

		
		$query 		= $connect->query($sql);
		$query_if_success 	= $connect->query($sql_if_success2);
		$queryq4 		= $connect->query($q4); //JIKA DEDUCTED LEAVE OLD
		$queryq5 		= $connect->query($q5); //JIKA DEDUCTED LEAVE NEW

		if($queryq4 == TRUE || $queryq5 == TRUE && $flag_is_deducted_print == "Y"){
			$validator['success'] = true;
			$validator['code'] = "success_message_approved";
			$queryq4_log 		= $connect->query($q4_log); //JIKA DEDUCTED LEAVE OLD
			$queryq5_log 		= $connect->query($q5_log); //JIKA DEDUCTED LEAVE NEW

			//$validator['code'] = "failed_message";
			$validator['messages'] = $alert_print_0;
		} else if($flag_is_deducted_print == "N"){
			$validator['success'] = true;
			$validator['code'] = "success_message_approved";
			//$validator['code'] = "failed_message";
			$validator['messages'] = $alert_print_0;	 
		} else {
			$validator['success'] = true;
			// $validator['code'] = "success_message_approved";
			$validator['code'] = "failed_message";
			$validator['messages'] = $alert_print_1 . $condition;	 
		}
		
			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1 . $condition;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}