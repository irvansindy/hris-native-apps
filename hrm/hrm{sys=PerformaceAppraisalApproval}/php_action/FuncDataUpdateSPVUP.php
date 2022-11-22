<?php 
require_once '../../../application/config.php';
//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver			= strtoupper($_POST['sel_emp_no_approver']);
	$sel_ipp_reqno_spv_upS		= strtoupper($_POST['sel_ipp_reqno_spv_upS']);
	$sel_remark_from_approver_spv_up	= strtoupper($_POST['sel_remark_from_approver_spv_up']);

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '19'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '20'"));
	$alert_print_1    = $alert_1['alert'];
	$alert_3          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '31'"));
	$alert_print_3    = $alert_3['alert'];

	// GET VAL PERFORMANE APPROVER
	// GET VAL PERFORMANE APPROVER
	$hrmvalmargin_perormance = mysqli_fetch_array(mysqli_query($connect, "SELECT max_apvr_day FROM hrmvalmargin WHERE request_type = 'Performance.Appraisal'"));
	$hrmvalmargin_perormance_R0 = $hrmvalmargin_perormance['max_apvr_day'];
	// GET VAL PERFORMANE APPROVER
	// GET VAL PERFORMANE APPROVER

	// GET OUTPUT FROM CAREER
	// GET OUTPUT FROM CAREER
	$career_history_for_get_authorized = mysqli_fetch_array(mysqli_query($connect, "SELECT career_history_no,requester FROM hrmperf_ipprequest WHERE ipa_reqno = '$sel_ipp_reqno_spv_upS'"));
	$ss = "SELECT career_history_no,requester FROM hrmperf_ipprequest WHERE ipa_reqno = '$sel_ipp_reqno_spv_upS'";
	$career_history_for_get_authorized_r0 = $career_history_for_get_authorized['career_history_no'];
	$career_history_for_get_authorized_r1 = $career_history_for_get_authorized['requester'];

	$get_data          	= mysqli_fetch_array(mysqli_query($connect, "SELECT history_no,DATE_FORMAT(effectivedt, '%Y-%m-%d') AS effectivedt FROM hrmemploymenthistory a 
													WHERE 
													a.careertransition_code = 'MOVEMENT'
													AND a.careertranstype = 'MUTN'
													AND a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$career_history_for_get_authorized_r1')
													ORDER BY effectivedt DESC LIMIT 1"));
	
	$get_data_1_r0	= $get_data['history_no'];
	$get_data_1_r1	= $get_data['effectivedt'];

	$val_request_to_current               = mysqli_fetch_array(mysqli_query($connect, "SELECT datediff(current_date() , '$get_data_1_r1') as days"));
	$val_request_to_current_print         = $val_request_to_current['days'];
	// GET OUTPUT FROM CAREER
	// GET OUTPUT FROM CAREER

	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
	if(($career_history_for_get_authorized_r0 != $get_data_1_r0) && ($val_request_to_current_print > $hrmvalmargin_perormance_R0)) {
			
			$validator['success'] = false;
			$validator['code'] = "failed_message";
			$validator['messages'] = $alert_print_3;	
		
		// condition ends
		$connect->close();
		echo json_encode($validator);
	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
		
	} else {

		$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$sel_ipp_requester_spv_upS'"));
		$get_periode			= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmperf_set_period ORDER BY period_id DESC LIMIT 1"));

		$get_data_0          	= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
		$get_data_print_0    	= $get_data_0['position_id'];
		
		$sql = "UPDATE `hrmrequestapproval` SET
						`status` 		= '1',
						`revised_remark` 	= '$sel_remark_from_approver_spv_up'
					WHERE
						`request_no` 		= '$sel_ipp_reqno_spv_upS' AND
						`position_id`		= '$get_data_print_0'";

		// $delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
		for($ikpi=0;$ikpi<count($_POST['inp_performance_spvup_approver1']);$ikpi++){
			$ikpi_plus 				= $ikpi+1;
			$inp_performance_spvup_approver0	= $_POST['inp_performance_spvup_approver0'][$ikpi]; // period
			$inp_performance_spvup_approver1	= $_POST['inp_performance_spvup_approver1'][$ikpi]; // bobot
			$inp_performance_spvup_approver2	= $_POST['inp_performance_spvup_approver2'][$ikpi]; // target
			$inp_performance_spvup_approver3	= $_POST['inp_performance_spvup_approver3'][$ikpi]; // Target Mid Year
			$inp_performance_spvup_approver4	= $_POST['inp_performance_spvup_approver4'][$ikpi]; // Full Year
			$inp_performance_spvup_approver5	= $_POST['inp_performance_spvup_approver5'][$ikpi]; // Full Year
			$inp_performance_spvup_approver6	= $_POST['inp_performance_spvup_approver6'][$ikpi]; // Full Year
			$inp_performance_spvup_approver7	= $_POST['inp_performance_spvup_approver7'][$ikpi]; // Full Year
			$inp_performance_spvup_approver8	= $_POST['inp_performance_spvup_approver8'][$ikpi]; // Full Year
			
			if(
				$inp_performance_spvup_approver3!=='' || 
				$inp_performance_spvup_approver4!=='' || 
				$inp_performance_spvup_approver5!=='' || 
				$inp_performance_spvup_approver6!=='' || 
				$inp_performance_spvup_approver7!=='' || 
				$inp_performance_spvup_approver8!==''	
			){

			$sql_1 = mysqli_query($connect, "UPDATE `hrmperf_parequest` SET `pa_midyear_realisasi`	= '$inp_performance_spvup_approver3', 
												`pa_midyear_rvt`		= '$inp_performance_spvup_approver4', 
												`pa_fullyear_realisasi`	= '$inp_performance_spvup_approver5', 
												`pa_fullyear_rvt`		= '$inp_performance_spvup_approver6',
												`pa_rr`			= '$inp_performance_spvup_approver7',
												`pa_brr`			= '$inp_performance_spvup_approver8',
												`modified_date`		= '$SFdatetime',
												`modified_by`		= '$sel_emp_no_approver'
									WHERE ipp_reqno = '$inp_performance_spvup_approver1' AND ipp_id = '$inp_performance_spvup_approver2'
												");
			}
		}

		// $delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
		for($ikpi=0;$ikpi<count($_POST['inp_performance_att_spvup_approver0']);$ikpi++){
			$ikpi_plus 				= $ikpi+1;
			$inp_performance_att_spvup_approver	= $_POST['inp_performance_att_spvup_approver'][$ikpi]; // period
			$inp_performance_att_spvup_approver0	= $_POST['inp_performance_att_spvup_approver0'][$ikpi]; // period
			$inp_performance_att_spvup_approver1	= $_POST['inp_performance_att_spvup_approver1'][$ikpi]; // bobot
			$inp_performance_att_spvup_approver2	= $_POST['inp_performance_att_spvup_approver2'][$ikpi]; // target
			$inp_performance_att_spvup_approver3	= $_POST['inp_performance_att_spvup_approver3'][$ikpi]; // Target Mid Year
			$inp_performance_att_spvup_approver4	= $_POST['inp_performance_att_spvup_approver4'][$ikpi]; // Full Year
			
			if(
				$inp_performance_att_spvup_approver1!=='' || 
				$inp_performance_att_spvup_approver2!=='' || 
				$inp_performance_att_spvup_approver3!=='' || 
				$inp_performance_att_spvup_approver4!==''
			) {

			$sql_2 = mysqli_query($connect, "INSERT INTO `hrmperf_parequest_att` 
											(
												`ipp_reqno`, 
												`ip_period`, 
												`att_item`, 
												`kpi_bobot`, 
												`rr`, 
												`brr`, 
												`remark`,
												`created_date`,
												`created_by`,
												`modified_date`,
												`modified_by`
											)
												VALUES
													(
														'$inp_performance_spvup_approver1',
														'$get_periode[period_id]',
														'$inp_performance_att_spvup_approver',
														'$inp_performance_att_spvup_approver1',
														'$inp_performance_att_spvup_approver2',
														'$inp_performance_att_spvup_approver3',
														'$inp_performance_att_spvup_approver4',
														'$SFdatetime',
														'$sel_emp_no_approver',
														'$SFdatetime', 
														'$sel_emp_no_approver'
													)
													ON DUPLICATE KEY UPDATE

														`kpi_bobot` 		= '$inp_performance_att_spvup_approver1',
														`rr` 			= '$inp_performance_att_spvup_approver2',
														`brr`			= '$inp_performance_att_spvup_approver3', 
														`remark`		= '$inp_performance_att_spvup_approver4',
														`modified_date`	= '$SFdatetime', 
														`modified_by`		= '$sel_emp_no_approver'
													");
			}
		}

		// $delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
		for($ikpi=0;$ikpi<count($_POST['inp_performance_feed_spvup_approver0']);$ikpi++){
			$ikpi_plus 				= $ikpi+1;
			$inp_performance_feed_spvup_approver	= $_POST['inp_performance_feed_spvup_approver'][$ikpi]; // period
			$inp_performance_feed_spvup_approver0	= $_POST['inp_performance_feed_spvup_approver0'][$ikpi]; // period
			$inp_performance_feed_spvup_approver1	= $_POST['inp_performance_feed_spvup_approver1'][$ikpi]; // bobot
			$inp_performance_feed_spvup_approver2	= $_POST['inp_performance_feed_spvup_approver2'][$ikpi]; // target
			$inp_performance_feed_spvup_approver3	= $_POST['inp_performance_feed_spvup_approver3'][$ikpi]; // Target Mid Year
			
			if(
				$inp_performance_feed_spvup_approver1!=='' || 
				$inp_performance_feed_spvup_approver2!=='' || 
				$inp_performance_feed_spvup_approver3!==''
			){

			$sql_3 = mysqli_query($connect, "INSERT INTO `hrmperf_parequest_feed` 
											(
												`ipp_reqno`, 
												`ip_period`, 
												`feedback_positive`, 
												`feedback_Improvement`, 
												`coaching`, 
												`created_date`, 
												`created_by`, 
												`modified_date`, 
												`modified_by`
											) 
												VALUES 
													(
														'$inp_performance_feed_spvup_approver0', 
														'$get_periode[period_id]', 
														'$inp_performance_feed_spvup_approver1', 
														'$inp_performance_feed_spvup_approver2', 
														'$inp_performance_feed_spvup_approver3', 
														'$SFdatetime',
														'$sel_emp_no_approver',
														'$SFdatetime', 
														'$sel_emp_no_approver'
													)
													
													ON DUPLICATE KEY UPDATE

														`feedback_positive`		= '$inp_performance_feed_spvup_approver1', 
														`feedback_Improvement`	= '$inp_performance_feed_spvup_approver2', 
														`coaching`			= '$inp_performance_feed_spvup_approver3', 
														`modified_date`		= '$SFdatetime',
														`modified_by`			= '$sel_emp_no_approver'
													");
			}
		}

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

			if($query) {
				$get_select_max_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(request_status) as `status` FROM hrmrequestapproval WHERE request_no = '$sel_ipp_reqno_spv_upS'"));
				$upd_approval_appraisal_status = mysqli_query($connect, "UPDATE hrmperf_ipprequest SET appraisal_status = '$get_select_max_approver[status]' WHERE ipa_reqno = '$sel_ipp_reqno_spv_upS'");
			}

			$validator['success'] = true;
			$validator['code'] = "success_message_approved_spv_up";
			//$validator['code'] = "failed_message";
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
}