<?php
date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;

if (isset($_POST['submit_approve'])) {
	
$modal_id_leaverequest 		= $_POST['request_no'];
$modal_id_leaverequest_app 		= $_POST['request_app'];

// MENDAPATKAN TANGGAL DIBUAT------------------------------>
// MENDAPATKAN TANGGAL DIBUAT------------------------------>
$get_leave_startdate   		= mysqli_fetch_array(mysqli_query($connect, "SELECT leave_startdate,leave_code,urgent_request,urgent_reason FROM hrmleaverequest WHERE request_no='$modal_id_leaverequest'"));
$get_leave_startdate_print 		= $get_leave_startdate['leave_startdate'];
$get_leave_startdate_str 		= date("Y-m-d", strtotime($get_leave_startdate['leave_startdate']));
$get_leave_type_print 		= $get_leave_startdate['leave_code'];
$get_leave_urgent_print 		= $get_leave_startdate['urgent_request'];
$get_leave_urgent_reason_print 	= $get_leave_startdate['urgent_reason'];
// MENDAPATKAN TANGGAL DIBUAT------------------------------>
// MENDAPATKAN TANGGAL DIBUAT------------------------------>

// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
$val_leave_approve              	= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$get_leave_type_print'"));
$val_leave_max_approved      		= $val_leave_approve['max_apvr_day'];

$val_leave_urg_approve             = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleaveurgreason WHERE reason_code = '$get_leave_urgent_reason_print'"));
$val_leave_urg_max_approved        = $val_leave_urg_approve['max_apvr_day'];
// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->

// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
$val_start_to_current   		= mysqli_fetch_array(mysqli_query($connect, "SELECT datediff('$get_leave_startdate_print', current_date()) as days"));
$val_start_to_current_print 	= $val_start_to_current['days'];
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE

// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
$get_emp   				= mysqli_fetch_array(mysqli_query($connect, "SELECT a.emp_id
												FROM hrmleaverequest a 
												WHERE a.request_no = '$modal_id_leaverequest'"));
$get_emp_print			= $get_emp['emp_id'];
// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
$alert4            = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '4'"));
$alert_print4      = $alert4['alert'];

if($val_start_to_current_print <= $val_leave_max_approved && $inp_urgent_decl == 'N'){
	echo "<script type='text/javascript'>
		     window.alert('$alert_print4 Max Approve Request is $val_leave_max_approved Days (REGULAR)');     
	      </script>";
 
}else if($val_start_to_current_print < $val_leave_urg_max_approved && $inp_urgent_decl == 'Y'){
	 echo "<script type='text/javascript'>
			 window.alert('$alert_print4 Max Leave Request $val_leave_urg_max_req Days $inp_urgent_decl (URGENT) $val_start_to_current_print | $val_leave_urg_max_approved');     
		 </script>";
 
 } else {
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG


$check_count_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT count(DISTINCT(req)) as total 
																	FROM hrmrequestapproval
																		WHERE request_no = '$modal_id_leaverequest' and 	
																		req IN ('Sequence','Required')"));

$check_sum_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT count(DISTINCT(req)) as total 
																	FROM hrmrequestapproval
																		WHERE request_no = '$modal_id_leaverequest' and 
																		req IN ('Sequence','Required') and status > 0"));





// =========================================================================================================
// ======================||\\=====||===||===================================================================
// ======================||==\\===||===||===================================================================
// ======================||===\\==||===||===================================================================
// ======================||=====\\||===||===================================================================
// ======================||=======||===||===================================================================
// =========================================================================================================





$who_is_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT request_no, approval_list, req
FROM hrmrequestapproval
	WHERE request_no = '$modal_id_leaverequest' and approval_list = '$modal_id_leaverequest_app'"));


if($who_is_approver['req'] == 'Sequence'){
	$counting_seq = '+1'; 
	$counting_req = '';
} elseif($who_is_approver['req'] == 'Required') {
	$counting_seq = '';
	$counting_req = '+1';
}

$check_count_required = mysqli_fetch_array(mysqli_query($connect, "SELECT count(DISTINCT(req))$counting_req as total
	FROM hrmrequestapproval
		WHERE request_no = '$modal_id_leaverequest' and
		req IN ('Required') and status > 0"));

$check_count_sequence = mysqli_fetch_array(mysqli_query($connect, "SELECT count(DISTINCT(req))$counting_seq as total
	FROM hrmrequestapproval
		WHERE request_no = '$modal_id_leaverequest' and
		req IN ('Sequence') and status > 0"));



$var_check_count_approver      = $check_count_approver['total'];
$var_check_sum_approver        = $check_sum_approver['total']+1;


	if($check_count_required['total'] > 1){
		echo "<script type='text/javascript'>
			window.alert('Failed : Required approval is approved');
			window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
		</script>";
	} elseif($check_count_sequence['total'] > 1){
		echo "<script type='text/javascript'>
			window.alert('Failed : Sequence Approval is approved');
			window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
		</script>";
	} else {

		if($var_check_count_approver == $var_check_sum_approver){
			$req_code = '3'; //Fully Approved
		} elseif($var_check_sum_approver > $var_check_count_approver){
			$req_code = '3'; //Fully Approved
		} else {
			$req_code = '2'; //Partially Approved
		}

		$process_frs = mysqli_query($connect, "UPDATE hrmrequestapproval SET 
													`status` = '1'
												WHERE  
												`request_no` = '$modal_id_leaverequest' AND
												`approval_list` = '$modal_id_leaverequest_app' AND
												`request_status` <> '3'
						");

		$process_sec = mysqli_query($connect, "UPDATE hrmrequestapproval SET 
													`request_status` = '$req_code'
												WHERE  
												`request_no` = '$modal_id_leaverequest' AND
												`request_status` <> '3'
						");

		$process_approval_logs = mysqli_query($connect, "INSERT INTO hrmrequestapproval_log							
													SELECT  
														request_no,
														position_id,
														approval_list,
														seq_id,
														req,
														CASE 
															WHEN `approval_list` = '$modal_id_leaverequest_app' THEN '1'
															ELSE `status` 
														END AS status,
														ordering,
														'$req_code',
														revised_remark,
														'$SFdatetime'
													FROM hrmrequestapproval
													WHERE `request_no` = '$modal_id_leaverequest'");

						
		$proc_frs = mysqli_num_rows($process_frs);
		$proc_sec = mysqli_num_rows($process_sec);
		
		if($process_frs && $process_sec && $req_code == '3')
		{
				/**
				 *
				 * '||''|.                            '||
				 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
				 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
				 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
				 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
				 *                                                  ||
				 * --------------- By Display:inline ------------- '''' -----------
				 */

				// GET TOTAL LEAVE CANCEL DAYS ----------------------------->
				// GET TOTAL LEAVE CANCEL DAYS ----------------------------->
				$getleave_request		= mysqli_fetch_array(mysqli_query($connect, "SELECT
															a.totaldays
															FROM hrmleaverequest a
															WHERE a.request_no = '$modal_id_leaverequest'"));
				$getleave_request_print = $getleave_request['totaldays'];																	
				// GET TOTAL LEAVE CANCEL DAYS ----------------------------->
				// GET TOTAL LEAVE CANCEL DAYS ----------------------------->

				//CEK JIKA ADA 2 LEAVE BALANCE ACTIVE

				$get_empgetleave_id = "SELECT c.empgetleave_id 
									FROM hrmempleavebal c
									WHERE 
								c.emp_id = '$get_emp_print' and
								c.active_status = '1' and
								c.leave_code = '$get_leave_type_print' and 
								'$get_leave_startdate_str' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate)";
				$Qget_empgetleave_id = mysqli_query($connect, $get_empgetleave_id);
				$Aget_empgetleave_id = mysqli_fetch_array($Qget_empgetleave_id);
				$print_empgetleave_id = $Aget_empgetleave_id['empgetleave_id'];


				if(mysqli_num_rows($Qget_empgetleave_id) > '1'){
					$QGet_empgetleave_id_first = mysqli_fetch_array(mysqli_query($connect, "SELECT c.empgetleave_id,
																(SELECT REPLACE(SUM(x1.remaining),',','.') 
																		FROM hrmempleavebal x1 
																		WHERE c.emp_id=x1.emp_id AND x1.leave_code='$get_leave_type_print' 
																		GROUP BY x1.empgetleave_id
																		ORDER BY x1.startvaliddate ASC LIMIT 1) AS remaining
																	FROM hrmempleavebal c
																	WHERE 
																c.emp_id = '$get_emp_print' and
																c.active_status = '1' and
																c.leave_code = '$get_leave_type_print' and 
																'$get_leave_startdate_str' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate)
																ORDER BY startvaliddate ASC LIMIT 1"));
					$QGet_empgetleave_id_second = mysqli_fetch_array(mysqli_query($connect, "SELECT c.empgetleave_id,
																(SELECT REPLACE(SUM(x1.remaining),',','.') 
																		FROM hrmempleavebal x1 
																		WHERE c.emp_id=x1.emp_id AND x1.leave_code='$get_leave_type_print'
																		GROUP BY x1.empgetleave_id
																		ORDER BY x1.startvaliddate DESC LIMIT 1) AS remaining
																	FROM hrmempleavebal c
																	WHERE 
																c.emp_id = '$get_emp_print' and
																c.active_status = '1' and
																c.leave_code = '$get_leave_type_print' and 
																'$get_leave_startdate_str' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate)
																ORDER BY startvaliddate DESC LIMIT 1"));
					$QGet_empgetleave_id_first_r 	= $QGet_empgetleave_id_first['empgetleave_id'];
					$QGet_empgetleave_id_second_r 	= $QGet_empgetleave_id_second['empgetleave_id'];
					$QGet_remaining_id_first_r 		= $QGet_empgetleave_id_first['remaining'];
					$QGet_remaining_id_second_r 	= $QGet_empgetleave_id_second['remaining'];
				} else {
					$QGet_empgetleave_id_second = mysqli_fetch_array(mysqli_query($connect, "SELECT c.empgetleave_id,
																(SELECT REPLACE(SUM(x1.remaining),',','.') 
																		FROM hrmempleavebal x1 
																		WHERE c.emp_id=x1.emp_id AND x1.leave_code='$get_leave_type_print' GROUP BY x1.leave_code) AS remaining
																	FROM hrmempleavebal c
																	WHERE 
																c.emp_id = '$get_emp_print' and
																c.active_status = '1' and
																c.leave_code = '$get_leave_type_print' and 
																'$get_leave_startdate_str' BETWEEN DATE(c.startvaliddate) and DATE(c.endvaliddate)
																ORDER BY startvaliddate DESC LIMIT 1"));
					$QGet_empgetleave_id_first_r 	= '';
					$QGet_empgetleave_id_second_r 	= $QGet_empgetleave_id_second['empgetleave_id'];
					$QGet_remaining_id_first_r 		= '0';
					$QGet_remaining_id_second_r 	= $QGet_empgetleave_id_second['remaining'];
				}
				//CEK JIKA ADA 2 LEAVE BALANCE ACTIVE

				
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
				

				$getleave_first		= mysqli_fetch_array(mysqli_query($connect, "SELECT 
															(SELECT REPLACE(SUM(x1.remaining),',','.') FROM hrmempleavebal x1 WHERE 
																	x1.empgetleave_id = '$QGet_empgetleave_id_first_r' AND 
																	c.emp_id=x1.emp_id AND 
																	x1.leave_code='$get_leave_type_print' GROUP BY x1.leave_code) AS remaining
																FROM hrmempleavebal c
															WHERE 
															c.empgetleave_id = '$QGet_empgetleave_id_first_r'
															GROUP BY c.empgetleave_id
															"));
				$getleave_first_print 	= $getleave_first['remaining'];

				$getleave			= mysqli_fetch_array(mysqli_query($connect, "SELECT 
															(SELECT REPLACE(SUM(x1.remaining),',','.') FROM hrmempleavebal x1 WHERE 
																x1.empgetleave_id = '$QGet_empgetleave_id_second_r' AND 
																c.emp_id=x1.emp_id AND 
																x1.leave_code='$get_leave_type_print' GROUP BY x1.leave_code) AS remaining
																FROM hrmempleavebal c
															WHERE 
															c.empgetleave_id = '$QGet_empgetleave_id_second_r'
															GROUP BY c.empgetleave_id
															"));
				$getleave_print 		= $getleave['remaining'];
															
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->

				// PENGURANGAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
				// PENGURANGAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
				$get_leaveremaining_first  	= $getleave_first['remaining'];
				$get_leaverequestcount	= $getleave_request['totaldays'];

				$get_leaveremaining  	= $getleave['remaining'];
				$get_leaverequestcount	= $getleave_request['totaldays'];

				//JIKA LEAVE AKTIF LEBIH DARI 1
				// --> DAN CUTI LAMA SUDAH HABIS
				if(mysqli_num_rows($Qget_empgetleave_id) > '1' && $get_leaveremaining_first == 0) {
					$remaining_balance_first = '0';
					$remaining_balance = $get_leaveremaining - $get_leaverequestcount;
					$con = 'con1';
				//JIKA LEAVE AKTIF LEBIH DARI 1
				// --> DAN CUTI LAMA BELUM HABIS
				} else if (mysqli_num_rows($Qget_empgetleave_id) > '1' && $get_leaveremaining_first > 0) {
					// --> DAN CUTI LAMA LEBIH DARI JUMLAH REQUEST
					if($get_leaveremaining_first > $get_leaverequestcount){
						$remaining_balance_first = $get_leaveremaining_first - $get_leaverequestcount;
						$remaining_balance = $getleave_print;
						$con = 'con2a';
					// --> DAN CUTI LAMA KURANG DARI JUMLAH REQUEST
					} else if ($get_leaveremaining_first < $get_leaverequestcount) {
						$use_first_balance = $get_leaverequestcount - $get_leaveremaining_first;
						$use_second_balance = ($get_leaverequestcount - $get_leaveremaining_first) - $get_leaveremaining_second;
						$remaining_balance_first = '0';
						$remaining_balance = ($get_leaveremaining_first + $get_leaveremaining) - $get_leaverequestcount;
						$con = 'con2b';
					}
				} else {
					$remaining_balance_first = '0';
					$remaining_balance = $get_leaveremaining - $get_leaverequestcount;
					$con = 'con3';
				}
				

				$flag_is_deducted 		= mysqli_fetch_array(mysqli_query($connect, "SELECT deductedleave FROM ttamleavetype WHERE leave_code = '$get_leave_type_print'"));
				$flag_is_deducted_print	= $flag_is_deducted['deductedleave'];

				


				if($flag_is_deducted_print == 'Y') {
					$process_back_leave_first 	= mysqli_query($connect, "UPDATE hrmempleavebal SET 
													remaining = '$remaining_balance_first',
													modified_by = '$username',
													remark = '$con | $get_leaveremaining_first - $get_leaverequestcount'
												WHERE 
												empgetleave_id = '$QGet_empgetleave_id_first_r'");

					$process_back_leave 	= mysqli_query($connect, "UPDATE hrmempleavebal SET 
													remaining = '$remaining_balance',
													modified_by = '$username', 
													remark='Print:$get_leaveremaining || $remaining_balance : $get_leaveremaining - $get_leaverequestcount || UPDATE hrmempleavebal SET remaining =$remaining_balance WHERE  emp_id = $get_emp_print and leave_code = $get_leave_type_print and active_status = 1 and (SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and  $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate)' 
												WHERE
												empgetleave_id = '$QGet_empgetleave_id_second_r'");
					if($flag_is_deducted_print == 'Y'){
						echo "<script type='text/javascript'>
							window.alert('Successfully Approved Request [ Fully Approved $print_empgetleave_id ]');
							window.location.replace('../hrm{sys=time.approval}?emp_id=$username');   
						</script>";
						
						if(mysqli_num_rows($Qget_empgetleave_id) > '1' && $get_leaveremaining_first == 0) {
							$insert_sys_deductedleave_log = mysqli_query($connect, "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_days`,
															`total_current_remaining`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_second_r', 
																'$modal_id_leaverequest', 
																'$get_leaverequestcount',
																'$get_leaveremaining',
																'$remaining_balance',
																'CON1 : UPDATE hrmempleavebal SET remaining = $remaining_balance |modified_by = $username | remark=Print:$get_leaveremaining || $remaining_balance : $get_leaveremaining - $get_leaverequestcount || UPDATE hrmempleavebal SET remaining =$remaining_balance WHERE  emp_id = $get_emp_print and leave_code = $get_leave_type_print and active_status = 1 and (SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and  $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate) WHERE emp_id = $get_emp_print andleave_code = $get_leave_type_print andactive_status = 1 and(SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate)', 
																'$SFdatetime'
															)");
						//JIKA LEAVE AKTIF LEBIH DARI 1
						// --> DAN CUTI LAMA BELUM HABIS
						} else if (mysqli_num_rows($Qget_empgetleave_id) > '1' && $get_leaveremaining_first > 0) {
							// --> DAN CUTI LAMA LEBIH DARI JUMLAH REQUEST
							if($get_leaveremaining_first > $get_leaverequestcount){
								$insert_sys_deductedleave_log = mysqli_query($connect, "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_days`,
															`total_current_remaining`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$modal_id_leaverequest', 
																'$use_first_balance',
																'$get_leaveremaining_first',
																'$remaining_balance_first',
																'CON2a : $QGet_remaining_id_first_r > $get_leaverequestcount || UPDATE hrmempleavebal SET remaining = $remaining_balance |modified_by = $username | remark=Print:$get_leaveremaining || $remaining_balance : $get_leaveremaining - $get_leaverequestcount || UPDATE hrmempleavebal SET remaining =$remaining_balance WHERE  emp_id = $get_emp_print and leave_code = $get_leave_type_print and active_status = 1 and (SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and  $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate) WHERE emp_id = $get_emp_print andleave_code = $get_leave_type_print andactive_status = 1 and(SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate)', 
																'$SFdatetime'
															)");
							// --> DAN CUTI LAMA KURANG DARI JUMLAH REQUEST
							} else if ($get_leaveremaining_first < $get_leaverequestcount) {
								$insert_sys_deductedleave_log = mysqli_query($connect, "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_days`,
															`total_current_remaining`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_first_r', 
																'$modal_id_leaverequest', 
																'$use_first_balance',
																'$get_leaveremaining_first',
																'$remaining_balance_first',
																'CON3 : UPDATE hrmempleavebal SET remaining = $remaining_balance |modified_by = $username | remark=Print:$get_leaveremaining || $remaining_balance : $get_leaveremaining - $get_leaverequestcount || UPDATE hrmempleavebal SET remaining =$remaining_balance WHERE  emp_id = $get_emp_print and leave_code = $get_leave_type_print and active_status = 1 and (SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and  $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate) WHERE emp_id = $get_emp_print andleave_code = $get_leave_type_print andactive_status = 1 and(SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate)', 
																'$SFdatetime'
															)");
								$insert_sys_deductedleave_log = mysqli_query($connect, "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_days`,
															`total_current_remaining`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_second_r', 
																'$modal_id_leaverequest', 
																'$use_second_balance',
																'$get_leaveremaining',
																'$remaining_balance',
																'CON3 : UPDATE hrmempleavebal SET remaining = $remaining_balance |modified_by = $username | remark=Print:$get_leaveremaining || $remaining_balance : $get_leaveremaining - $get_leaverequestcount || UPDATE hrmempleavebal SET remaining =$remaining_balance WHERE  emp_id = $get_emp_print and leave_code = $get_leave_type_print and active_status = 1 and (SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and  $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate) WHERE emp_id = $get_emp_print andleave_code = $get_leave_type_print andactive_status = 1 and(SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate)', 
																'$SFdatetime'
															)");
							}
						} else {
							$insert_sys_deductedleave_log = mysqli_query($connect, "INSERT INTO `sys_deductedleave_log` 
														(
															`empgetleave_id`, 
															`leaverequest_no`, 
															`total_days`,
															`total_current_remaining`,
															`total_remaining`,
															`message`, 
															`created_date`
														) VALUES 
															(
																'$QGet_empgetleave_id_second_r', 
																'$modal_id_leaverequest', 
																'$get_leaverequestcount',
																'$get_leaveremaining',
																'$remaining_balance',
																'CON4 : UPDATE hrmempleavebal SET remaining = $remaining_balance |modified_by = $username | remark=Print:$get_leaveremaining || $remaining_balance : $get_leaveremaining - $get_leaverequestcount || UPDATE hrmempleavebal SET remaining =$remaining_balance WHERE  emp_id = $get_emp_print and leave_code = $get_leave_type_print and active_status = 1 and (SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and  $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate) WHERE emp_id = $get_emp_print andleave_code = $get_leave_type_print andactive_status = 1 and(SELECT deductedleave FROM ttamleavetype WHERE leave_code = $get_leave_type_print) = Y  and $get_leave_startdate_str BETWEEN DATE(startvaliddate) and DATE(endvaliddate)', 
																'$SFdatetime'
															)");
						}
						
					} else {
						echo "<script type='text/javascript'>
							window.alert('Failed Approved Request [Partially Approved] error no : 182');
						</script>";
					}
				 
				} else {
					echo "<script type='text/javascript'>
							window.alert('Successfully Approved Request [ Fully Approved2 ]');
							window.location.replace('../hrm{sys=time.approval}?emp_id=$username'); 
						</script>";
						// 
				}
				
				// PENGURANGAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
				// PENGURANGAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->


				
											

			} else{
				echo "<script type='text/javascript'>
						window.alert('Successfully Approved Request'); 
					</script>";
			}
		}
	}
























} else if (isset($_POST['submit_approve_notification'])) {
	
	$modal_id_leaverequest = $_POST['request_no'];
	$modal_id_leaverequest_app = $_POST['request_app'];
	
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	$get_leave_startdate   		= mysqli_fetch_array(mysqli_query($connect, "SELECT leave_startdate,leave_code,urgent_request,urgent_reason FROM hrmleaverequest WHERE request_no='$modal_id_leaverequest'"));
	$get_leave_startdate_print 		= $get_leave_startdate['leave_startdate'];
	$get_leave_type_print 		= $get_leave_startdate['leave_code'];
	$get_leave_urgent_print 		= $get_leave_startdate['urgent_request'];
	$get_leave_urgent_reason_print 	= $get_leave_startdate['urgent_reason'];
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	$val_leave_approve = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$get_leave_type_print'"));
	$val_leave_max_approved = $val_leave_approve['max_apvr_day'];

	$val_leave_urg_approve             = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleaveurgreason WHERE reason_code = '$get_leave_urgent_reason_print'"));
	$val_leave_urg_max_approved        = $val_leave_urg_approve['max_apvr_day'];
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	$val_start_to_current = mysqli_fetch_array(mysqli_query($connect, "SELECT datediff('$get_leave_startdate_print', current_date()) as days"));
	$val_start_to_current_print = $val_start_to_current['days'];
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	$get_emp = mysqli_fetch_array(mysqli_query($connect, "SELECT a.emp_id
									FROM hrmleaverequest a 
									WHERE a.request_no = '$modal_id_leaverequest'"));
	$get_emp_print = $get_emp['emp_id'];
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	
	/**
	 *
	 * '||''|.                            '||
	 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
	 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
	 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
	 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
	 *                                                  ||
	 * --------------- By Display:inline ------------- '''' -----------
	 */
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	$alert4            = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '4'"));
	$alert_print4      = $alert4['alert'];
	
	if($val_start_to_current_print > $val_leave_max_approved && $inp_urgent_decl == 'N'){
		echo "<script type='text/javascript'>
			     window.alert('$alert_print4 Max Approve Request is $val_leave_max_approved Days (REGULAR)');     
		      </script>";
	 }else if($val_start_to_current_print > $val_leave_urg_max_approved && $inp_urgent_decl == 'Y'){
		 echo "<script type='text/javascript'>
				 window.alert('$alert_print4 Max Leave Request $val_leave_urg_max_req Days $inp_urgent_decl (URGENT)');     
			 </script>";
	 } else {
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	
	
	
	
	$who_is_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT request_no, approval_list, req
	FROM hrmrequestapproval
		WHERE request_no = '$modal_id_leaverequest' and approval_list = '$modal_id_leaverequest_app'"));
	
	
	
	$check_count_notification = mysqli_fetch_array(mysqli_query($connect, "SELECT count(*) as total
		FROM hrmrequestapproval
			WHERE request_no = '$modal_id_leaverequest' and
			req IN ('Notification') and status > '0'"));
	

		if($check_count_notification['total'] > 0){
			echo "<script type='text/javascript'>
					window.alert('Failed : Notification approval as Acknowledge is approved By $who_is_approver[approval_list]');
					window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
				</script>";
		} else {
			$process_frs = mysqli_query($connect, "UPDATE 
									hrmrequestapproval SET 
										`status` = '1',
										`request_status` = '2'
										WHERE  
										`request_no` = '$modal_id_leaverequest' AND 
										`approval_list` = '$modal_id_leaverequest_app' AND
										`req` = 'Notification' AND
										`request_status` <> '3'
							");
							
			$proc_frs = mysqli_num_rows($process_frs);
	
				if($process_frs){
					$process_approval_logs = mysqli_query($connect, "INSERT INTO hrmrequestapproval_log							
																SELECT  
																	request_no,
																	position_id,
																	approval_list,
																	seq_id,
																	req,
																	CASE 
																		WHEN `approval_list` = '$modal_id_leaverequest_app' THEN '1'
																		ELSE '0' 
																	END AS status,
																	ordering,
																	'2',
																	revised_remark,
																	'$SFdatetime'
																FROM hrmrequestapproval
																WHERE `request_no` = '$modal_id_leaverequest'");

					echo "<script type='text/javascript'>
							window.alert('Successfully Approved Request [as Acknowledge]');
							window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
						</script>";
				} else {
						echo "<script type='text/javascript'>
							window.alert('Wrong Approval Formula');
						</script>";
				}
		}
	}























// DIFFERENCES IF KNOWS LIST APPROVER JUST ACKNOWLEDGE AND REQUIRED THEN IF ACKNOWLEDGE HAS BEEN APPROVED AUTOMATICLY UPDATE STATUS TO PARTIALLY APPROVED

} else if (isset($_POST['submit_approve_notification_as_required'])) {
	
	$modal_id_leaverequest = $_POST['request_no'];
	$modal_id_leaverequest_app = $_POST['request_app'];
	
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	$get_leave_startdate   		= mysqli_fetch_array(mysqli_query($connect, "SELECT leave_startdate,leave_code,urgent_request,reason_code FROM hrmleaverequest WHERE request_no='$modal_id_leaverequest'"));
	$get_leave_startdate_print 		= $get_leave_startdate['leave_startdate'];
	$get_leave_type_print 		= $get_leave_startdate['leave_code'];
	$get_leave_urgent_print 		= $get_leave_startdate['urgent_request'];
	$get_leave_urgent_reason_print 	= $get_leave_startdate['reason_code'];
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	// MENDAPATKAN TANGGAL DIBUAT------------------------------>
	
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	$val_leave_approve = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$get_leave_type_print'"));
	$val_leave_max_approved = $val_leave_approve['max_apvr_day'];

	$val_leave_urg_approve             = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleaveurgreason WHERE reason_code = '$get_leave_urgent_reason_print'"));
	$val_leave_urg_max_approved        = $val_leave_urg_approve['max_apvr_day'];
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
	
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	$val_start_to_current = mysqli_fetch_array(mysqli_query($connect, "SELECT datediff('$get_leave_startdate_print', current_date()) as days"));
	$val_start_to_current_print = $val_start_to_current['days'];
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
	
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	$get_emp = mysqli_fetch_array(mysqli_query($connect, "SELECT a.emp_id
									FROM hrmleaverequest a 
									WHERE a.request_no = '$modal_id_leaverequest'"));
	$get_emp_print = $get_emp['emp_id'];
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	// MENDAPATKAN EMPLOYEE NUMBER ---------------------------->
	
	/**
	 *
	 * '||''|.                            '||
	 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
	 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
	 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
	 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
	 *                                                  ||
	 * --------------- By Display:inline ------------- '''' -----------
	 */
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	$alert4            = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '4'"));
	$alert_print4      = $alert4['alert'];
	
	if($val_start_to_current_print < $val_leave_max_approved && $inp_urgent_decl == 'N'){
		echo "<script type='text/javascript'>
			     window.alert('$alert_print4 Max Approve Request is $val_leave_max_approved Days (REGULAR)');     
		      </script>";
	 
	 }else if($val_leave_to_current_print < $val_leave_urg_max_approved){
		 echo "<script type='text/javascript'>
				 window.alert('$alert_print4 Max Leave Request $val_leave_urg_max_req Days $inp_urgent_decl (URGENT)');     
			 </script>";
	 
	 } else {
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	//VALIDASI TANGGAL PENGAJUAN VS DB CONFIG
	
	
	
	
	$who_is_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT request_no, approval_list, req
	FROM hrmrequestapproval
		WHERE request_no = '$modal_id_leaverequest' and approval_list = '$modal_id_leaverequest_app'"));
	
	
	$check_count_notification = mysqli_fetch_array(mysqli_query($connect, "SELECT count(*) as total
		FROM hrmrequestapproval
			WHERE request_no = '$modal_id_leaverequest' and
			req IN ('Notification') and status > '0'"));
	

		if($check_count_notification['total'] > 0){
			echo "<script type='text/javascript'>
					window.alert('Failed : Notification approval as Acknowledge | Sequence is approved By $who_is_approver[approval_list]');
					window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
				</script>";
		} else {
			$process_frs = mysqli_query($connect, "UPDATE 
								hrmrequestapproval SET 
									`status` = '1',
									`request_status` = '2'
									WHERE  
									`request_no` = '$modal_id_leaverequest' AND
									`req` = 'Sequence' AND
									`approval_list` = '$modal_id_leaverequest_app'
							");
							
			$proc_frs = mysqli_num_rows($process_frs);
	
				if($process_frs){
					$process_approval_logs = mysqli_query($connect, "INSERT INTO hrmrequestapproval_log							
																		SELECT  
																			request_no,
																			position_id,
																			approval_list,
																			seq_id,
																			req,
																			CASE 
																				WHEN `approval_list` = '$modal_id_leaverequest_app' THEN '1'
																				ELSE '0' 
																			END AS status,
																			ordering,
																			'2',
																			revised_remark,
																			'$SFdatetime'
																		FROM hrmrequestapproval
																		WHERE `request_no` = '$modal_id_leaverequest'");

					echo "<script type='text/javascript'>
							window.alert('Successfully Approved Request [as Sequence]');
							window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
						</script>";
				} else {
						echo "<script type='text/javascript'>
							window.alert('Wrong Approval Formula');
						</script>";
				}
		}
	}
}
?>