<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>

<?php
if (isset($_POST['submit_approve'])) {
	
$modal_id_leaverequest 		= $_POST['request_no'];
$modal_id_leaverequest_app 		= $_POST['request_app'];

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
$val_leave_approve              	= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$get_leave_type_print'"));
$val_leave_max_approved      	= $val_leave_approve['max_apvr_day'];

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

		$process_frs = mysqli_query($connect, "UPDATE 
							hrmrequestapproval SET 
								`status` = '1'
								WHERE  
								`request_no` = '$modal_id_leaverequest' and 
								`approval_list` = '$modal_id_leaverequest_app' and
								`request_status` <> '3'
						");

		$process_sec = mysqli_query($connect, "UPDATE 
							hrmrequestapproval SET 
								`request_status` = '$req_code'
								WHERE  
								`request_no` = '$modal_id_leaverequest' and
								`request_status` <> '3'
						");

						
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
				
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
				$getleave					= mysqli_fetch_array(mysqli_query($connect, "SELECT remaining 
																							FROM hrmempleavebal 
																							WHERE emp_id = '$get_emp_print'"));
				$getleave_print 			= $getleave['remaining'];																	
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
				// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->

				// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
				// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
				$remaining_balance			= $getleave_print - $getleave_request_print;
				$process_back_leave 		= mysqli_query($connect, "UPDATE hrmempleavebal SET remark='agus proc $remaining_balance' WHERE emp_id = '$get_emp_print '");
				// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
				// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->


			if($process_back_leave){
				echo "<script type='text/javascript'>
						window.alert('Successfully Approved Request [Fully Approved]');
						window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
					</script>";
			} else {
					echo "<script type='text/javascript'>
						window.alert('Failed Approved Request [Partially Approved] error no : 182');
					</script>";
			}
											

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
					window.alert('Failed : Notification approval as Acknowledge is approved By $who_is_approver[approval_list]');
					window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
				</script>";
		} else {
			$process_frs = mysqli_query($connect, "UPDATE 
									hrmrequestapproval SET 
										`status` = '1',
										`request_status` = '2'
										WHERE  
										`request_no` = '$modal_id_leaverequest' and 
										`approval_list` = '$modal_id_leaverequest_app' and
										`request_status` <> '3'
							");
							
			$proc_frs = mysqli_num_rows($process_frs);
	
				if($process_frs){
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
									`request_no` = '$modal_id_leaverequest' and 
									`approval_list` = '$modal_id_leaverequest_app'
							");
							
			$proc_frs = mysqli_num_rows($process_frs);
	
				if($process_frs){
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