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
	
$modal_id_leaverequest 			= $_POST['request_no'];
$modal_id_leaverequest_app 		= $_POST['request_app'];

// MENDAPATKAN TANGGAL DIBUAT------------------------------>
// MENDAPATKAN TANGGAL DIBUAT------------------------------>
$get_leave_startdate   			= mysqli_fetch_array(mysqli_query($connect, "SELECT leave_startdate,leave_code FROM hrmleaverequest WHERE request_no='$modal_id_leaverequest'"));
$get_leave_startdate_print 		= $get_leave_startdate['leave_startdate'];
$get_leave_type_print 			= $get_leave_startdate['leave_code'];
// MENDAPATKAN TANGGAL DIBUAT------------------------------>
// MENDAPATKAN TANGGAL DIBUAT------------------------------>

// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
$val_leave_approve              = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmvalleave WHERE leave_code = '$get_leave_type_print'"));
$val_leave_max_approved      	= $val_leave_approve['max_apvr_day'];
// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->
// MENDAPATKAN MAKSIMUM WAKTU YANG DIIJINKAN--------------->

// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
$val_start_to_current   		= mysqli_fetch_array(mysqli_query($connect, "SELECT datediff('$get_leave_startdate_print', current_date()) as days"));
$val_start_to_current_print 	= $val_start_to_current['days'];
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE


// MENDAPATKAN LEAVE REQUEST NUMBER------------------------>
// MENDAPATKAN LEAVE REQUEST NUMBER------------------------>
$val_leavereq   				= mysqli_fetch_array(mysqli_query($connect, "SELECT leaverequest_no FROM hrmleavecancelrequest WHERE request_no = '$modal_id_leaverequest'"));
$val_leavereq_print 			= $val_leavereq['leaverequest_no'];
// MENDAPATKAN LEAVE REQUEST NUMBER------------------------>
// MENDAPATKAN LEAVE REQUEST NUMBER------------------------>

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

if($val_start_to_current_print < $val_leave_max_approved){
      echo "<script type='text/javascript'>
                  window.alert('$alert_print4 Max Approve This Request $val_leave_max_approved Days');     
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
			window.alert('Required approval is approved');
			window.location.replace('../hrm{sys=time.approval}?emp_id=$username');       
		</script>";
	} elseif($check_count_sequence['total'] > 1){
		echo "<script type='text/javascript'>
			window.alert('Sequence Approval is approved');
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
				$leave_cancel_request_detail = mysqli_query($connect, "SELECT
				a.leaverequest_no,
				b.request_no,
				a.totaldays,
				a.requestfor as employee,
				DATE(b.leave_date) AS date
				FROM hrmleavecancelrequest a
				LEFT JOIN hrdleavecancelrequest b ON a.request_no=b.request_no
				WHERE a.leaverequest_no = '$val_leavereq_print'");
				
					while($r_detail=mysqli_fetch_array($leave_cancel_request_detail)){
						$detail_employee			= $r_detail['employee'];
						$detail_request_no 			= $r_detail['leaverequest_no'];
						$detail_leave_date 			= $r_detail['date'];
						$detail_totaldays 			= $r_detail['totaldays'];
						$process_cancel_detail 		= mysqli_query($connect, "UPDATE 
																				hrdleaverequest 
																				SET 
																				cancelsts='Y' 
																				WHERE 
																					request_no = '$detail_request_no' AND 
																					DATE(leave_date) = '$detail_leave_date'
						");
						
					}
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
					$getleave_cancellation		= mysqli_fetch_array(mysqli_query($connect, "SELECT
																							a.totaldays
																							FROM hrmleavecancelrequest a
																							WHERE a.leaverequest_no = '$val_leavereq_print'"));
					$getleave_cancellation_print= $getleave_cancellation['totaldays'];																	
					// GET TOTAL LEAVE CANCEL DAYS ----------------------------->
					// GET TOTAL LEAVE CANCEL DAYS ----------------------------->
					
					// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
					// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
					$getleave					= mysqli_fetch_array(mysqli_query($connect, "SELECT remaining 
																								FROM hrmempleavebal 
																								WHERE emp_id = '$detail_employee'"));
					$getleave_print 			= $getleave['remaining'];																	
					// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->
					// PROSES MENAMBAHKAN LEAVE BALANCE KE ttadempgetleave ----->

					// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
					// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
					$remaining_balance			= $getleave_print + $getleave_cancellation_print;
					$process_back_leave 		= mysqli_query($connect, "UPDATE hrmempleavebal SET remaining='$remaining_balance' WHERE emp_id = '$detail_employee'");
					// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->
					// PENAMBAHAN TOTAL CANCEL DITAMBAH SALDO REMAINING BALANCE ->

				$proc_detail = mysqli_num_rows($leave_cancel_request_detail);

				if($proc_detail){
					echo "<script type='text/javascript'>
							window.alert('$val_leavereq_print Successfully Approved Request [Fully Approved]');
							window.location.replace('../hrm{sys=leave.cancellation.approval}?emp_id=$username');       
						</script>";
				} else {
						echo "<script type='text/javascript'>
							window.alert('Failed Approved Request [Partially Approved] error no : 182');
						</script>";
				}
												

			} else{
				// AgusPrass 03/03/2021 Mengganti alert
			     echo "<script type='text/javascript'>
						window.alert('$val_leavereq_print Successfully Approved Request [Partially Approved]');     
					</script>";
				// AgusPrass 03/03/2021 Mengganti alert
		    }
	}
}
?>
<?php } ?>
<!-- Yang harus diganti -->
<!-- window.alert('.$proc_frs.'); -->