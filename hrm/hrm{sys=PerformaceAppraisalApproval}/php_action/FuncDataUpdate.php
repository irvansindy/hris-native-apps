<?php 
require_once '../../../application/config.php';
//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver			= strtoupper($_POST['sel_emp_no_approver']);

	$sel_ipp_reqno_spv_downS		= strtoupper($_POST['sel_ipp_reqno_spv_downS']);

	$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    = $get_data_0['position_id'];

	$get_data_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT req FROM hrmrequestapproval WHERE position_id = '$get_data_print_0' AND request_no = '$sel_ipp_reqno_spv_downS'"));
	$get_data_print_1    = $get_data_1['req'];
	
	$sql = "UPDATE `hrmrequestapproval` SET
					`status` 		= '1'
				WHERE
					`request_no` 		= '$sel_ipp_reqno_spv_downS' AND
					`position_id`		= '$get_data_print_0'";

	// $delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
	for($ikpi=0;$ikpi<count($_POST['inp_attitude_spvdown_approver1']);$ikpi++){
		$ikpi_plus 				= $ikpi+1;

		$inp_attitude_spvdown_approver1	= $_POST['inp_attitude_spvdown_approver1'][$ikpi]; // bobot
		$inp_attitude_spvdown_approver2	= $_POST['inp_attitude_spvdown_approver2'][$ikpi]; // target
		$inp_attitude_spvdown_approver3	= $_POST['inp_attitude_spvdown_approver3'][$ikpi]; // Target Mid Year
		$inp_attitude_spvdown_approver4	= $_POST['inp_attitude_spvdown_approver4'][$ikpi]; // Full Year
		$inp_attitude_spvdown_approver5	= $_POST['inp_attitude_spvdown_approver5'][$ikpi]; // Full Year
		$inp_attitude_spvdown_approver6	= $_POST['inp_attitude_spvdown_approver6'][$ikpi]; // Full Year
		$inp_attitude_spvdown_approver7	= $_POST['inp_attitude_spvdown_approver7'][$ikpi]; // Full Year
		
		if(
			$inp_attitude_spvdown_approver3!=='' || 
			$inp_attitude_spvdown_approver4!=='' || 
			$inp_attitude_spvdown_approver5!=='' || 
			$inp_attitude_spvdown_approver6!=='' ||
			$inp_attitude_spvdown_approver7!==''
		)


		
		{
				if($get_data_print_1 == 'Notification'){
					$rating_for 	= 'r1_rating';
					$value		= $inp_attitude_spvdown_approver5;
				} else if($get_data_print_1 == 'Sequence'){
					$rating_for 	= 'r2_rating';
					$value		= $inp_attitude_spvdown_approver6;
				} else if($get_data_print_1 == 'Required'){
					$rating_for 	= 'r3_rating';
					$value		= $inp_attitude_spvdown_approver7;
				} else {
					$rating_for 	= 'failed';
					$value		= 'failed';
				}

				$sql_1 = mysqli_query($connect, "UPDATE `hrmperf_parequest_stfsc` SET 
											$rating_for			= '$value',  
											`modified_date`		= '$SFdatetime',
											`modified_by`			= '$sel_emp_no_approver'
												WHERE pa_reqno = '$inp_attitude_spvdown_approver1' 
												AND att_item = '$inp_attitude_spvdown_approver2'
											 ");


				$sql_1e	 = "UPDATE `hrmperf_parequest_stfsc` SET 
											$rating_for			= '$value',  
											`modified_date`		= '$SFdatetime',
											`modified_by`			= '$sel_emp_no_approver'
												WHERE pa_reqno = '$inp_attitude_spvdown_approver1' 
												AND att_item = '$inp_attitude_spvdown_approver2'
											 ";

		}
	}

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '19'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '20'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);

	if($query == TRUE && $sql_1 == TRUE) {
		$get_any_request = mysqli_fetch_array(mysqli_query($connect, "SELECT 
												COUNT(*) as total_approver,
												(SELECT 
													COUNT(*) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_ipp_reqno_spv_downS' AND
														req IN ('Sequence','Required')) AS total_approver_without_acknowledge,
												(SELECT 
													SUM(STATUS) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_ipp_reqno_spv_downS' AND
														req IN ('Sequence','Required')) AS total_without_acknowledge,
												SUM(STATUS) AS total
											FROM hrmrequestapproval
												WHERE
													request_no = '$sel_ipp_reqno_spv_downS' AND
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
					`request_no` 		= '$sel_ipp_reqno_spv_downS'";
		$sql1 = "UPDATE `hrmperf_parequest_stfsc` SET
					`status` 		= '$set_status',
					`modified_by`		= '$sel_emp_no_approver'
				WHERE
					`pa_reqno` 		= '$sel_ipp_reqno_spv_downS'";

		$query = $connect->query($sql);
		$query = $connect->query($sql1);

		if($query){
			$get_select_max_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(request_status) as `status` FROM hrmrequestapproval WHERE request_no = '$sel_ipp_reqno_spv_downS'"));
			$upd_approval_appraisal_status = mysqli_query($connect, "UPDATE hrmperf_parequest_stfsc SET appraisal_status = '$get_select_max_approver[status]' WHERE ipa_reqno = '$sel_ipp_reqno_spv_downS'");
		}

		$validator['success'] = true;
		$validator['code'] = "success_message_approved_spv_down";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1 . $get_data_print_1;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}