<?php
if (isset($_POST['submit_approve'])) {
$modal_id_leaverequest = $_POST['request_no'];
$modal_id_leaverequest_app = $_POST['request_app'];

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
			window.location.replace('../hrm{sys=time.attendance}?emp_id=$username');       
		</script>";
	} elseif($check_count_sequence['total'] > 1){
		echo "<script type='text/javascript'>
			window.alert('Sequence Approval is approved');
			window.location.replace('../hrm{sys=time.attendance}?emp_id=$username');       
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
		
		if($process_frs && $process_sec)
			{
			echo "<script type='text/javascript'>
					window.alert('Successfully Approved Request');
					window.location.replace('../hrm{sys=time.attendance}?emp_id=$username?emp_id=$username');       
				</script>";
			} else{
			     echo "<script type='text/javascript'>
						window.alert('.$proc_frs.');     
					</script>";
		      }
	}
	




}
?>