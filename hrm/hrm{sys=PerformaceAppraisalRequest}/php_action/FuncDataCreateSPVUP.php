<?php 
require_once '../../../application/config.php';

$SFyear              = date("Y");
$SFdate              = date("Y-m-d");
$SFtime              = date('h:i:s');
$SFdatetime          = date("Y-m-d H:i:s");
$SFnumber            = date("Ymd");
$var_find            = array('-', '');
$var_replace         = array('', '');
$identity    		= str_replace($var_find, $var_replace, $_POST['sel_ipp_reqno_spv_upS']);
$SFnumbercon         = 'PA-APPR'.$SFyear.'-'.$identity;

//PAREQ2021-130299-20122020
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver			= strtoupper($_POST['sel_emp_no_approver']);
	$sel_ipp_requester_spv_upS		= strtoupper($_POST['sel_ipp_requester_spv_upS']);
	$sel_ipp_reqno_spv_upS		= strtoupper($_POST['sel_ipp_reqno_spv_upS']);
	$sel_ipp_revno_spv_upS		= strtoupper($_POST['sel_ipp_revno_spv_upS']);
	$sel_remark_from_approver_spv_up	= addslashes($_POST['sel_remark_from_approver_spv_up']);

	$get_company				= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$sel_ipp_requester_spv_upS'"));
	$get_periode				= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmperf_set_period ORDER BY period_id DESC LIMIT 1"));

	$get_data_0          		= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    		= $get_data_0['position_id'];

	$sql = "";
		
	for($ikpi=0;$ikpi<count($_POST['inp_performance_spvup_approver01']);$ikpi++){
		$ikpi_plus 				= $ikpi+1;
		$inp_performance_spvup_approver0	= $_POST['inp_performance_spvup_approver0'][$ikpi]; // period
		$inp_performance_spvup_approver00	= $_POST['inp_performance_spvup_approver00'][$ikpi]; // period
		$inp_performance_spvup_approver01	= $_POST['inp_performance_spvup_approver01'][$ikpi]; // bobot
		$inp_performance_spvup_approver02	= $_POST['inp_performance_spvup_approver02'][$ikpi]; // target
		$inp_performance_spvup_approver6	= $_POST['inp_performance_spvup_approver6'][$ikpi]; // Target Mid Year
		$inp_performance_spvup_approver7	= $_POST['inp_performance_spvup_approver7'][$ikpi]; // Full Year
		$inp_performance_spvup_approver8	= $_POST['inp_performance_spvup_approver8'][$ikpi]; // Full Year
		$inp_performance_spvup_approver9	= $_POST['inp_performance_spvup_approver9'][$ikpi]; // Full Year
		
		if(
			$inp_performance_spvup_approver6 !=='' ||
			$inp_performance_spvup_approver7 !=='' ||
			$inp_performance_spvup_approver8 !=='' ||
			$inp_performance_spvup_approver9 !==''){

		$sql_1 = mysqli_query($connect, "INSERT INTO `hrmperf_parequest`
									(
										`ipp_reqno`,
										`ipp_id`,
										`ip_period`,
										`pa_midyear_realisasi`, 
										`pa_midyear_rvt`, 
										`pa_fullyear_realisasi`, 
										`pa_fullyear_rvt`, 
										`pa_rr`, 
										`pa_brr`, 
										`filename`, 
										`remark`,
										`status`, 
										`created_date`, 
										`created_by`, 
										`modified_date`, 
										`modified_by`
									) 
										VALUES 
											(
												'$sel_ipp_reqno_spv_upS', 
												'$inp_performance_spvup_approver0', 
												'$inp_performance_spvup_approver00', 
												'$inp_performance_spvup_approver6', 
												'$inp_performance_spvup_approver7', 
												'$inp_performance_spvup_approver8', 
												'$inp_performance_spvup_approver9', 
												'9', 
												'9', 
												'9', 
												'$sel_remark_from_approver_spv_up', 
												'1', 
												'$SFdatetime', 
												'$username',
												'$SFdatetime',
												'$username'
											)
											ON DUPLICATE KEY UPDATE
												`pa_midyear_realisasi`	= '$inp_performance_spvup_approver6', 
												`pa_midyear_rvt`		= '$inp_performance_spvup_approver7', 
												`pa_fullyear_realisasi`	= '$inp_performance_spvup_approver8', 
												`pa_fullyear_rvt`		= '$inp_performance_spvup_approver9',
												`remark`			= '$sel_remark_from_approver_spv_up'");

		}
	}

	$sql_approval = mysqli_query($connect, 
				"SELECT 
					*
					FROM hrdperf_ipprequest a
					where a.ipp_reqno = '$sel_ipp_reqno_spv_upS'
				");
      
			while($r=mysqli_fetch_array($sql_approval)){
						
			$sql_2 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequest_review` 
										(
											`rev_id`,
											`ipp_reqno`, 
											`ipp_id`, 
											`kpi_perspektif_id`, 
											`kpi_name`, 
											`kpi_unit`, 
											`kpi_bobot`, 
											`kpi_type_id`, 
											`kpi_midyear_trg`, 
											`kpi_fullyear_trg`, 
											`kpi_reviewperiod_id`, 
											`remark`, 
											`kpi_lg`, 
											`created_date`, 
											`created_by`, 
											`modified_date`, 
											`modified_by`
										) 
											VALUES 
												(
													'$sel_ipp_revno_spv_upS',
													'$sel_ipp_reqno_spv_upS', 
													'$r[ipp_id]', 
													'$r[kpi_perspektif_id]', 
													'$r[kpi_name]', 
													'$r[kpi_unit]', 
													'$r[kpi_bobot]', 
													'$r[kpi_type_id]', 
													'$r[kpi_midyear_trg]', 
													'$r[kpi_fullyear_trg]', 
													'$r[kpi_reviewperiod_id]',
													'$r[remark]', 
													'$r[kpi_lg]', 
													'$SFdatetime', 
													'$sel_emp_no_approver', 
													'$SFdatetime', 
													'$sel_emp_no_approver'
												)");
											
						}

	$sql_approval = mysqli_query($connect, 
				"SELECT 
					*
					FROM hrmperf_parequest a
					where a.ipp_reqno = '$sel_ipp_reqno_spv_upS'
				");
      
			while($r=mysqli_fetch_array($sql_approval)){
						
			$sql_2 = mysqli_query($connect, "INSERT INTO `hrmperf_parequest_review` 
										(
											`rev_id`, 
											`ipp_reqno`, 
											`ipp_id`, 
											`ip_period`, 
											`pa_midyear_realisasi`, 
											`pa_midyear_rvt`, 
											`pa_fullyear_realisasi`, 
											`pa_fullyear_rvt`, 
											`pa_rr`, 
											`pa_brr`, 
											`filename`, 
											`remark`, 
											`status`, 
											`created_date`, 
											`created_by`, 
											`modified_date`, 
											`modified_by`
										) 
											VALUES (
													'$sel_ipp_revno_spv_upS', 
													'$sel_ipp_reqno_spv_upS',
													'$r[ipp_id]',
													'$r[ip_period]',
													'$r[pa_midyear_realisasi]',
													'$r[pa_midyear_rvt]',
													'$r[pa_fullyear_realisasi]',
													'$r[pa_fullyear_rvt]', 
													'$r[pa_rr]',
													'$r[pa_brr]',
													'$r[filename]',
													'$r[remark]',
													'$r[status]',
													'$r[created_date]',
													'$r[created_by]',
													'$r[modified_date]',
													'$r[modified_by]')");
											
						}

	$delete = "DELETE FROM `hrdperf_ipprequest` WHERE `ipp_reqno` = '$sel_ipp_reqno_spv_upS'";
	$connect->query($delete);

	for($ikpi=0;$ikpi<count($_POST['inp_performance_spvup_approver0']);$ikpi++){
			$ikpi_plus 		= $ikpi+1;
			$inp_performance_spvup_approver0	= $_POST['inp_performance_spvup_approver0'][$ikpi]; // item
			$inp_performance_spvup_approver1	= $_POST['inp_performance_spvup_approver1'][$ikpi]; // bobot
			$inp_performance_spvup_approver2	= $_POST['inp_performance_spvup_approver2'][$ikpi]; // target
			$inp_performance_spvup_approver12	= $_POST['inp_performance_spvup_approver12'][$ikpi]; // Full Year
			$inp_performance_spvup_approver3	= $_POST['inp_performance_spvup_approver3'][$ikpi]; // Target Mid Year
			$inp_performance_spvup_approver4	= $_POST['inp_performance_spvup_approver4'][$ikpi]; // Full Year
			$inp_performance_spvup_approver5	= $_POST['inp_performance_spvup_approver5'][$ikpi]; // Full Year
			$inp_performance_spvup_approver6	= $_POST['inp_performance_spvup_approver6'][$ikpi]; // Full Year
			$inp_performance_spvup_approver7	= $_POST['inp_performance_spvup_approver7'][$ikpi]; // Full Year
			$inp_performance_spvup_approver8	= $_POST['inp_performance_spvup_approver8'][$ikpi]; // Full Year
			// $inp_performance_spvup_approver9	= $_POST['inp_performance_spvup_approver9'][$ikpi]; // Full Year
			$inp_performance_spvup_approver10	= $_POST['inp_performance_spvup_approver10'][$ikpi]; // Full Year
			$inp_performance_spvup_approver11	= $_POST['inp_performance_spvup_approver11'][$ikpi]; // Full Year
			

			if($inp_performance_spvup_approver0 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsadss123`";
				
			} else if($inp_performance_spvup_approver1 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`";

			} else if($inp_performance_spvup_approver2 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`";

			} else if($inp_performance_spvup_approver3 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`";
			
			} else if($inp_performance_spvup_approver4 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`";

			} else if($inp_performance_spvup_approver5 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`";

			} else if($inp_performance_spvup_approver10 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`";

			} else if($inp_performance_spvup_approver11 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				$consql_1 = "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`";
			
			} else {

				
				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequest` 
										(
											`ipp_reqno`, 
											`ipp_id`, 
											`kpi_perspektif_id`, 
											`kpi_name`, 
											`kpi_unit`, 
											`kpi_bobot`, 
											`kpi_type_id`, 
											`kpi_midyear_trg`, 
											`kpi_fullyear_trg`, 
											`kpi_reviewperiod_id`, 
											`remark`, 
											`kpi_lg`, 
											`created_date`, 
											`created_by`, 
											`modified_date`, 
											`modified_by`
										) 
											VALUES 
												(
													'$sel_ipp_reqno_spv_upS', 
													'$ikpi_plus', 
													'$inp_performance_spvup_approver0', 
													'$inp_performance_spvup_approver1', 
													'$inp_performance_spvup_approver2', 
													'$inp_performance_spvup_approver3', 
													'$inp_performance_spvup_approver12', 
													'$inp_performance_spvup_approver4', 
													'$inp_performance_spvup_approver5', 
													'$inp_performance_spvup_approver00',
													'$inp_performance_spvup_approver10', 
													'$inp_performance_spvup_approver11', 
													'$SFdatetime', 
													'$sel_emp_no_approver', 
													'$SFdatetime', 
													'$sel_emp_no_approver'
												)");
			}
		}

	

	$sql_3 = mysqli_query($connect, "UPDATE `hrmperf_ipprequest` 
								SET 
									`ipa_remark`	= '$sel_remark_from_approver_spv_up'
								WHERE `ipp_reqno` 	= '$sel_ipp_reqno_spv_upS'");

	

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
	$alert_print_1    = $alert_1['alert'];
	$alert_2          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_2    = $alert_2['alert'];

	$sql_approval = mysqli_query($connect, 
						"SELECT 
							a.emp_no as seq_id,
							a.empno_appvr1,
							x2.position_id,
							x2.pos_code as request_approval_formula,
							'Notification' as req,
							'0' as ordering
							FROM tclcdreqappsetting a
							LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
							LEFT JOIN view_employee x2 on a.empno_appvr1=x2.emp_no
							where a.emp_no = '$sel_ipp_requester_spv_upS' and
								a.empno_appvr1 is not null and
								a.empno_appvr1 <> '' and
								a.request_type = 'Performance.appraisal'
									
								UNION ALL
								
								SELECT 
								a.emp_no as seq_id,
								a.empno_appvr2,
								x2.position_id,
								x2.pos_code as request_approval_formula,
								'Sequence' as req,
								'0' as ordering
								FROM tclcdreqappsetting a
								LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
								LEFT JOIN view_employee x2 on a.empno_appvr2=x2.emp_no
								where a.emp_no = '$sel_ipp_requester_spv_upS' and
									a.empno_appvr2 is not null and
									a.empno_appvr2 <> '' and
									a.request_type = 'Performance.appraisal'
								
									UNION ALL
									
									SELECT
									a.emp_no as seq_id,
									a.empno_appvr3,
									x2.position_id,
									x2.pos_code as request_approval_formula,
									'Required' as req,
									'0' as ordering
									FROM tclcdreqappsetting a
									LEFT JOIN view_employee x1 on a.emp_no=x1.emp_no
									LEFT JOIN view_employee x2 on a.empno_appvr3=x2.emp_no
									where a.emp_no = '$sel_ipp_requester_spv_upS' and
										a.empno_appvr3 is not null and
										a.empno_appvr3 <> '' and
										a.request_type = 'Performance.appraisal'
						");
      
						while($r=mysqli_fetch_array($sql_approval)){
						
						if ($r['position_id'] == $get_data_print_0) {
							$approval_status_when_submit = '1';
							$approval_req_status_when_submit = '2';
						} else {
							$approval_status_when_submit = '0';
							$approval_req_status_when_submit = '1';
						}
						
						$sql_2 = mysqli_query($connect, "INSERT INTO hrmrequestapproval 
												(
													`request_no`, 
													`approval_list`,
													`seq_id`,
													`req`,
													`status`,
													`ordering`,
													`request_status`,
													`position_id`
												) 
													VALUES 
														(
															'$SFnumbercon', 
															'$r[request_approval_formula]', 
															'$r[seq_id]',  
															'$r[req]',
															'$approval_status_when_submit',
															'$r[ordering]',
															'$approval_req_status_when_submit',
															'$r[position_id]' 
														) 
														ON DUPLICATE KEY UPDATE 
															`created_date` = '$SFdatetime',
															`req` = '$r[req]',
															`status` = '$approval_status_when_submit',
															`ordering` = '$r[ordering]',
															`request_status` = '$approval_req_status_when_submit'");
											
						}

	// condition start
	$query = $connect->query($sql);

	$ceksum	    = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(kpi_bobot) AS total FROM hrdperf_ipprequest WHERE ipp_reqno = '$sel_ipp_reqno_spv_upS'"));	
	
	$data = "SELECT SUM(kpi_bobot) AS total FROM hrdperf_ipprequest WHERE ipp_reqno = '$sel_ipp_reqno_spv_upS'";

	if($ceksum['total'] != '100') {
		$validator['success'] = false;
		$validator['code'] = "failed_message" ;
		$validator['messages'] = 'Something data cannot be process please check kpi bobot must be 100% and data cannot empty' ;
						
	} else if($sql_1 && $sql_2) {						
		$validator['success'] = true;
		$validator['code'] = "success_appraised_spvup";
		$validator['messages'] = $alert_print_0;
		$get_select_max_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(request_status) as `status` FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
		$upd_approval_appraisal_status = mysqli_query($connect, "UPDATE hrmperf_ipprequest SET appraisal_status = '$get_select_max_approver[status]', ipa_reqno = '$SFnumbercon' WHERE ipp_reqno = '$sel_ipp_reqno_spv_upS'");

	} else {
		$get_data_from_table_approval = mysqli_query($connect, "SELECT * FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'");
		if(mysqli_num_rows($get_data_from_table_approval) > 0){
			$validator['success'] = true;
			$validator['code'] = "success_appraised_spvup";
			//$validator['code'] = "failed_message";
			$validator['messages'] = $alert_print_2;
			$get_select_max_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(request_status) as `status` FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
			$upd_approval_appraisal_status = mysqli_query($connect, "UPDATE hrmperf_ipprequest SET appraisal_status = '$get_select_max_approver[status]', ipa_reqno = '$SFnumbercon'  WHERE ipp_reqno = '$sel_ipp_reqno_spv_upS'");

		} else {
			$validator['success'] = false;
			$validator['code'] = "failed_message";
			$validator['messages'] = $alert_print_1;
		}
	}
	// condition ends 

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}