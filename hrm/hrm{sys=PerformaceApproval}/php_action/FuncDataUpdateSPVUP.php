<?php 
require_once '../../../application/config.php';
//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver			= strtoupper($_POST['sel_emp_no_approver']);

	$sel_ipp_reqno_spv_upS		= strtoupper($_POST['sel_ipp_reqno_spv_upS']);

	$sel_remark_from_approver		= strtoupper($_POST['sel_remark_from_approver']);

	$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    = $get_data_0['position_id'];

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '19'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '20'"));
	$alert_print_1    = $alert_1['alert'];
	$alert_3          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '30'"));
	$alert_print_3    = $alert_3['alert'];

	// GET OUTPUT FROM CAREER
	// GET OUTPUT FROM CAREER
	$career_history_for_get_authorized = mysqli_fetch_array(mysqli_query($connect, "SELECT 
													career_history_no,
													requester 
													FROM hrmperf_ipprequest 
													WHERE ipp_reqno = '$sel_ipp_reqno_spv_upS'"));

	$ss = "SELECT career_history_no,requester FROM hrmperf_ipprequest WHERE ipp_reqno = '$sel_ipp_reqno_spv_upS'";

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

	// GET IF APPRAISAL STATUS IS RUNNING OR NOT YET FULLY APPROVED
	// GET IF APPRAISAL STATUS IS RUNNING OR NOT YET FULLY APPROVED
	$get_previous_request 		= mysqli_fetch_array(mysqli_query($connect, "SELECT A.history_no,MIN(A.effectivedt),A.appraisal_status AS effectivedt FROM (
															SELECT
																a.history_no,
																b.appraisal_status,
																DATE_FORMAT(effectivedt, '%Y-%m-%d') AS effectivedt 
															FROM hrmemploymenthistory a
															LEFT JOIN hrmperf_ipprequest b ON a.history_no=b.career_history_no
															WHERE
															a.careertransition_code = 'MOVEMENT'
															AND a.careertranstype = 'MUTN'
															AND b.appraisal_status <> '3'
															AND a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$career_history_for_get_authorized_r1')
															ORDER BY effectivedt DESC
															) A"));
	$get_previous_request_R0 = $get_previous_request['history_no'];
	// GET IF APPRAISAL STATUS IS RUNNING OR NOT YET FULLY APPROVED
	// GET IF APPRAISAL STATUS IS RUNNING OR NOT YET FULLY APPROVED

	// GET VAL PERFORMANE APPROVER
	// GET VAL PERFORMANE APPROVER
	$hrmvalmargin_perormance = mysqli_fetch_array(mysqli_query($connect, "SELECT max_apvr_day FROM hrmvalmargin WHERE request_type = 'Performance'"));
	$hrmvalmargin_perormance_R0 = $hrmvalmargin_perormance['max_apvr_day'];
	// GET VAL PERFORMANE APPROVER
	// GET VAL PERFORMANE APPROVER

	// JIKA PERFORMANCE PLAN SAMPAI DENGAN PERFORMANCE APPRAISAL BELUM DI SELESAIKAN MAKA WAJIB UNTUK DISELESAIKAN TEREBIH DAHULU
       // JIKA PERFORMANCE PLAN SAMPAI DENGAN PERFORMANCE APPRAISAL BELUM DI SELESAIKAN MAKA WAJIB UNTUK DISELESAIKAN TEREBIH DAHULU
       // if(($val_request_to_current_print > $hrmvalmargin_perormance_R0)) {
	if(($career_history_for_get_authorized_r0 != $get_previous_request_R0)) {
				//  && ($val_request_to_current_print > $hrmvalmargin_perormance_R0) && ($SFyear == $get_data_1['y_effectivedt'])) {

                            $validator['success'] = false;
                            $validator['code'] = "failed_message";
                            $validator['messages'] = "Failed to aproved this request there is outstanding performance at career " . $career_history_for_get_authorized_r0 . $get_previous_request_R0 ;
                     
                     // condition ends
                     $connect->close();
                     echo json_encode($validator);

	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
	// if(($career_history_for_get_authorized_r0 == $get_data_1_r0) && ($val_request_to_current_print > $hrmvalmargin_perormance_R0)) {

	// 		$validator['success'] = false;
	// 		$validator['code'] = "failed_message";
	// 		$validator['messages'] = $alert_print_3;
		
	// 	// condition ends
	// 	$connect->close();
	// 	echo json_encode($validator);
	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
	// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
		
	} else {
	
		$sql = "UPDATE `hrmrequestapproval` SET
						`status` 		= '1',
						`remark_fromapprover`= '$sel_remark_from_approver'
					WHERE
						`request_no` 		= '$sel_ipp_reqno_spv_upS' AND
						`position_id`		= '$get_data_print_0'";

		

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
			// $validator['code'] = "failed_message";
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