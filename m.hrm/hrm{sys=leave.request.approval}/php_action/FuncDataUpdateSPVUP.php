<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver			= strtoupper($_POST['sel_emp_no_approver']);

	$sel_ipp_reqno_spv_upS		= strtoupper($_POST['sel_ipp_reqno_spv_upS']);

	$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    = $get_data_0['position_id'];
	
	$sql = "UPDATE `hrmrequestapproval` SET
					`status` 		= '1'
				WHERE
					`request_no` 		= '$sel_ipp_reqno_spv_upS' AND
					`position_id`		= '$get_data_print_0'";

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '19'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '20'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);

	if($query == TRUE) {
		$get_any_request = mysqli_fetch_array(mysqli_query($connect, "SELECT 
												COUNT(*) as total_approver,
												(SELECT 
													COUNT(*) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_ipp_reqno_spv_upS' AND
														req IN ('Sequence','Required')) AS total_approver_without_acknowledge,
												(SELECT 
													SUM(STATUS) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_ipp_reqno_spv_upS' AND
														req IN ('Sequence','Required')) AS total_without_acknowledge,
												SUM(STATUS) AS total
											FROM hrmrequestapproval
												WHERE
													request_no = '$sel_ipp_reqno_spv_upS' AND
													req IN ('Notification','Sequence','Required')"));

		if($get_any_request['total_approver'] == $get_any_request['total']){
			$set_status = '3';
		} else if($get_any_request['total'] > $get_any_request['total_approver']){
			$set_status = '3';		
		} else if($get_any_request['total_without_acknowledge'] == $get_any_request['total_approver_without_acknowledge']){
			$set_status = '3';
		} else	{
			$set_status = '2';
		}
		
		$sql = "UPDATE `hrmrequestapproval` SET
					`request_status` 	= '$set_status'
				WHERE
					`request_no` 		= '$sel_ipp_reqno_spv_upS'";
		$sql1 = "UPDATE `hrmperf_parequest_stfsc` SET
					`status` 		= '$set_status',
					`modified_by`		= '$sel_emp_no_approver'
				WHERE
					`pa_reqno` 		= '$sel_ipp_reqno_spv_upS'";

		$query = $connect->query($sql);
		$query = $connect->query($sql1);

		$validator['success'] = true;
		$validator['code'] = "success_message_approved_spv_up";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}