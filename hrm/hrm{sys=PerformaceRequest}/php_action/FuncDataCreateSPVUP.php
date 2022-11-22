<?php 
require_once '../../../application/config.php';

$SFyear              = date("Y");
$SFdate              = date("Y-m-d");
$SFtime              = date('h:i:s');
$SFdatetime          = date("Y-m-d H:i:s");
$SFnumber            = date("Ymdhis");
$var_find            = array('-', '');
$var_replace         = array('', '');
$identity    		= str_replace($var_find, $var_replace, substr($_POST['employee'],-9,-2));
$SFnumbercon         = 'PAREQ'.$SFyear.'-'.$identity.$SFnumber;


$inp_formtype = $_POST['inp_formtype'];
//PAREQ2021-130299-20122020
//if form is submitted
if($_POST) {	
	if($inp_formtype == 'spv_up') {


		$validator = array('success' => false, 'messages' => array());

		$inp_emp_no			= strtoupper($_POST['inp_emp_no']);
		$employee_pre			= strtoupper($_POST['employee']);

		// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]
		$employee 			= strtoupper($_POST['inp_empperformance']);
		$inp_career			= strtoupper($_POST['inp_careerhistory']);
		// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]

		$inp_token 			= strtoupper($_POST['inp_token']);

		$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$employee'"));
		$get_periode			= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmperf_set_period ORDER BY period_id DESC LIMIT 1"));

		$get_data_0          	= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));
		$get_data_print_0    	= $get_data_0['position_id'];

		$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
		$alert_print_0    = $alert_0['alert'];
		$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
		$alert_print_1    = $alert_1['alert'];
		$alert_3          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '30'"));
		$alert_print_3    = $alert_3['alert'];

		// GET OUTPUT FROM CAREER
		// GET OUTPUT FROM CAREER
		$get_data_0 			= mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(a.request_status) as req, b.career_history_no as career_history_no
													FROM hrmrequestapproval a
													LEFT JOIN hrmperf_ipprequest b ON a.request_no=b.ipp_reqno
													WHERE a.seq_id = '$employee' AND
													a.request_status IN ('1','2')"));

		$get_data_1          	= mysqli_fetch_array(mysqli_query($connect, "SELECT 
														history_no,
														DATE_FORMAT(effectivedt, '%Y-%m-%d') AS effectivedt,
														YEAR(effectivedt) as y_effectivedt 
													FROM hrmemploymenthistory a 
													WHERE 
													a.careertransition_code = 'MOVEMENT'
													AND a.careertranstype = 'MUTN'
													AND a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$employee')
													ORDER BY effectivedt DESC LIMIT 1"));

              $get_data_2			= mysqli_fetch_array(mysqli_query($connect, "SELECT 
														history_no,
														DATE_FORMAT(effectivedt, '%Y-%m-%d') AS effectivedt 
													FROM hrmemploymenthistory a 
													WHERE 
													a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$employee')"));

													
		
		if($get_data_1['history_no'] != '') {
			$career    	= $get_data_1['history_no'];
			$get_data_print_2		= $get_data_1['effectivedt'];
			$dateprint			= date('d F Y', strtotime($get_data_print_2));
		} else {
			$career    	= $get_data_2['history_no'];
			$get_data_print_2		= $get_data_2['effectivedt'];
			$dateprint			= date('d F Y', strtotime($get_data_print_2));
		}

		$val_request_to_current               = mysqli_fetch_array(mysqli_query($connect, "SELECT datediff(current_date() , '$get_data_print_2') as days"));
		$val_request_to_current_print         = $val_request_to_current['days'];
		// GET OUTPUT FROM CAREER
		// GET OUTPUT FROM CAREER

		// GET VAL PERFORMANCE APPROVER
		// GET VAL PERFORMANCE APPROVER
		$hrmvalmargin_perormance = mysqli_fetch_array(mysqli_query($connect, "SELECT max_apvr_day FROM hrdvalmargin WHERE request_type = 'Performance.Plan.Request' and emp_no = '$employee'"));
		$hrmvalmargin_perormance_R0 = $hrmvalmargin_perormance['max_apvr_day'];
		// GET VAL PERFORMANCE APPROVER
		// GET VAL PERFORMANCE APPROVER

		// JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
              // JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
              // if(($val_request_to_current_print > $hrmvalmargin_perormance_R0)) {
		if(($get_data_0['career_history_no'] != '' || $get_data_0['career_history_no'] != NULL) && ($SFyear == $get_data_1['y_effectivedt']) && ($val_request_to_current_print > $hrmvalmargin_perormance_R0)) {
				//  && ($val_request_to_current_print > $hrmvalmargin_perormance_R0) && ($SFyear == $get_data_1['y_effectivedt'])) {

                            $validator['success'] = false;
                            $validator['code'] = "failed_message";
                            $validator['messages'] = $alert_print_3 . " allowed day is " . $hrmvalmargin_perormance_R0 . " Days" . "<p style='color: #83aa80;'><br> Last effective career is " . $dateprint . "</p>";
                     
                     // condition ends
                     $connect->close();
                     echo json_encode($validator);
              // JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
              // JIKA CAREER TIDAK SAMA DENGAN ATAU TERDAPAT CAREER MOVEMENT BARU, DAN BATAS APPROVED LEBIH DARI YANG DIIJINKAN MAKA BERLAKU KONDISI TIDAK DAPAT DISUBMIMT
                     
              } else {

			$is_any_request = mysqli_query($connect, "SELECT * FROM `hrmperf_ipprequest` WHERE `requester` = '$employee' AND career_history_no = '$inp_career' AND ip_period = '$get_periode[period_id]' AND `status` IN ('1','2','3','4')");

			$sql = mysqli_query($connect, "INSERT INTO `hrmperf_ipprequest` 
							(
								`ipp_reqno`,
								`career_history_no`,
								`requester`,
								`ip_period`, 
								`remark`, 
								`status`, 
								`kpi_period_type`, 
								`created_date`, 
								`created_by`, 
								`modified_date`, 
								`modified_by`
							) 
								VALUES 
									(
										'$SFnumbercon', 
										'$inp_career', 
										'$employee', 
										'$get_periode[period_id]', 
										'oo', 
										'1', 
										'1', 
										'$SFdatetime', 
										'$inp_emp_no', 
										'$SFdatetime', 
										'$inp_emp_no'
									)");

			$query_num_rows = mysqli_num_rows($is_any_request);
			$query_assoc_rows = mysqli_fetch_assoc($is_any_request);
				
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
					where a.emp_no = '$employee' and
						a.empno_appvr1 is not null and
						a.empno_appvr1 <> '' and
						a.request_type = 'Performance'
					
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
						where a.emp_no = '$employee' and
							a.empno_appvr2 is not null and
							a.empno_appvr2 <> '' and
							a.request_type = 'Performance'
						
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
							where a.emp_no = '$employee' and
								a.empno_appvr3 is not null and
								a.empno_appvr3 <> '' and
								a.request_type = 'Performance'
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
											)");
											
			$sql_2_print = "INSERT INTO hrmrequestapproval 
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
											)";
			}

			
			for($ikpi=0;$ikpi<count($_POST['inp_performance0']);$ikpi++){
				$ikpi_plus 		= $ikpi+1;
				$inp_performance0	= $_POST['inp_performance0'][$ikpi]; // item
				$inp_performance1	= $_POST['inp_performance1'][$ikpi]; // bobot
				$inp_performance2	= $_POST['inp_performance2'][$ikpi]; // target
				$inp_performance3	= $_POST['inp_performance3'][$ikpi]; // Target Mid Year
				$inp_performance4	= $_POST['inp_performance4'][$ikpi]; // Full Year
				$inp_performance5	= $_POST['inp_performance5'][$ikpi]; // Full Year
				$inp_performance6	= $_POST['inp_performance6'][$ikpi]; // Full Year
				$inp_performance7	= $_POST['inp_performance7'][$ikpi]; // Full Year
				$inp_performance8	= $_POST['inp_performance8'][$ikpi]; // Full Year
				$inp_performance9	= $_POST['inp_performance9'][$ikpi]; // Full Year
				$inp_performance10	= $_POST['inp_performance10'][$ikpi]; // Full Year

				if($inp_performance0 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
					
				} else if($inp_performance1 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

				} else if($inp_performance2 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

				} else if($inp_performance3 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				
				} else if($inp_performance4 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

				} else if($inp_performance5 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

				} else if($inp_performance6 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

				} else if($inp_performance7 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				
				} else if($inp_performance8 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

				} else if($inp_performance9 == ''){ 

					$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				
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
														'$SFnumbercon', 
														'$ikpi_plus', 
														'$inp_performance0', 
														'$inp_performance1', 
														'$inp_performance2', 
														'$inp_performance3', 
														'$inp_performance4', 
														'$inp_performance5', 
														'$inp_performance6', 
														'$inp_performance7',
														'$inp_performance8', 
														'$inp_performance9', 
														'$SFdatetime', 
														'$inp_emp_no', 
														'$SFdatetime', 
														'$inp_emp_no'
													)");

				}
			}

			$ceksum	    = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(kpi_bobot) AS total FROM hrdperf_ipprequest WHERE ipp_reqno = '$SFnumbercon'"));		

			if($ceksum['total'] != '100') {
				
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = 'Something data cannot be process please check kpi bobot must be 100% and data cannot emptys, Please make sure there is no duplicate data in this request';
				
				// $remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_ipprequest WHERE ipp_reqno = '$SFnumbercon'"));	
				// $remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrdperf_ipprequest WHERE ipp_reqno = '$SFnumbercon'"));
				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
				
			} else if($query_num_rows > '0') {
				
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = $inp_career ."Performance has been create before please check request : " . $query_assoc_rows['ipp_reqno'];

			} else if($query_num_rows == '0' && $sql_2 == TRUE && $sql == TRUE) {
				
				$validator['success'] = true;
				$validator['code'] = "success_message_spv_up_version";
				$validator['messages'] = $alert_print_0;
				//$validator['success'] = false;
				//$validator['code'] = "failed_message";
				//$validator['messages'] = $alert_print_0;
						
			} else if($sql_2 == FALSE && $query == TRUE) {

				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_ipprequest WHERE ipp_reqno = '$SFnumbercon'"));	
				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrdperf_ipprequest WHERE ipp_reqno = '$SFnumbercon'"));
				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
				
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Wrong approval formula";

			} else {

				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_ipprequest WHERE ipp_reqno = '$SFnumbercon'"));	
				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrdperf_ipprequest WHERE ipp_reqno = '$SFnumbercon'"));
				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));

				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = $alert_print_1;

			}
			// condition ends

			// close the database connection
			$connect->close();
			echo json_encode($validator);
		}










		
	} else {










			$validator = array('success' => false, 'messages' => array());

			$inp_emp_no			= strtoupper($_POST['inp_emp_no']);
			$employee_pre	= strtoupper($_POST['employee']);

			// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]
			$employee 			= strtoupper($_POST['inp_empperformance']);
			$career			= strtoupper($_POST['inp_careerhistory']);
			// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]

			$inp_token 			= strtoupper($_POST['inp_token']);

			$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$employee'"));
			$get_periode			= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmperf_set_period ORDER BY period_id DESC LIMIT 1"));

			$alert_0          		= mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
			$alert_print_0    		= $alert_0['alert'];
			$alert_1          		= mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
			$alert_print_1    		= $alert_1['alert'];

			$get_data_0          	= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));
			$get_data_print_0    	= $get_data_0['position_id'];

			$get_data_1			= mysqli_query($connect, "SELECT pa_reqno FROM hrmperf_parequest_stfsc WHERE requester = '$employee' AND ip_period = '$get_periode[period_id]' AND `status` IN ('1','2','3','4')");
			$get_data_2			= mysqli_query($connect, "SELECT request_type FROM tclcdreqappsetting WHERE request_type = 'Performance' AND emp_no = '$employee'");

			$get_data_3          	= mysqli_fetch_array(mysqli_query($connect, "SELECT history_no FROM hrmemploymenthistory a
													WHERE
													a.careertransition_code = 'MOVEMENT'
													AND a.careertranstype = 'MUTN'
													AND a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$employee')
													ORDER BY effectivedt DESC LIMIT 1"));
			
			$get_data_4			= mysqli_fetch_array(mysqli_query($connect, "SELECT history_no FROM hrmemploymenthistory a 
													WHERE 
													a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$employee')"));
			if($get_data_3['history_no'] != '') {
				$get_data_print_3    	= $get_data_3['history_no'];
			} else {
				$get_data_print_3    	= $get_data_4['history_no'];
			}

			if (mysqli_num_rows($get_data_1) > 1) {		
				$pa_reqno = mysqli_fetch_array($get_data_1);
				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Previous performance exist please check Ref. No : " . $pa_reqno['pa_reqno'];

			} else if(mysqli_num_rows($get_data_1) < 1) {
				// $delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
				for($ikpi=0;$ikpi<count($_POST['inp_attitude1']);$ikpi++){
					$ikpi_plus 		= $ikpi+1;
					$inp_attitude0	= $_POST['inp_attitude0'][$ikpi]; // item
					$inp_attitude1	= $_POST['inp_attitude1'][$ikpi]; // bobot
					$inp_attitude2	= $_POST['inp_attitude2'][$ikpi]; // target
					$inp_attitude3	= $_POST['inp_attitude3'][$ikpi]; // Target Mid Year
					$inp_attitude4	= $_POST['inp_attitude4'][$ikpi]; // Full Year

					if($inp_attitude0 == ''){ 

						$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
						
					} else if($inp_attitude1 == ''){ 

						$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

					} else if($inp_attitude2 == ''){ 

						$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

					} else if($inp_attitude3 == ''){ 

						$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
					
					} else {

						$sql_1 = mysqli_query($connect, "INSERT INTO `hrmperf_parequest_stfsc` 
								(
									`att_item`, 
									`pa_reqno`,
									`career_history_no`,
									`requester`, 
									`ip_period`,
									`kpi_bobot`, 
									`kpi_target`, 
									`r1_rating`, 
									`r2_rating`, 
									`r3_rating`, 
									`kpi_midyear_trg`, 
									`kpi_midyear_realisasi`, 
									`kpi_fullyear_trg`, 
									`kpi_fullyear_realisasi`, 
									`final_rating`, 
									`frb`, 
									`remark`, 
									`status`, 
									`created_date`, 
									`created_by`, 
									`modified_date`, 
									`modified_by`
								) 
									VALUES 
										(
											'$inp_attitude0', 
											'$SFnumbercon', 
											'$career',
											'$employee', 
											'$get_periode[period_id]', 
											'$inp_attitude1', 
											'$inp_attitude2', 
											'0', 
											'0', 
											'0', 
											'$inp_attitude3', 
											'0', 
											'$inp_attitude4', 
											'0', 
											'0', 
											'0', 
											'0', 
											'1', 
											'$SFdatetime', 
											'$inp_emp_no', 
											'$SFdatetime', 
											'$inp_emp_no'
										)");


					}
				}

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
						where a.emp_no = '$employee' and
							a.empno_appvr1 is not null and
							a.empno_appvr1 <> '' and
							a.request_type = 'Performance'
						
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
							where a.emp_no = '$employee' and
								a.empno_appvr2 is not null and
								a.empno_appvr2 <> '' and
								a.request_type = 'Performance'
							
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
								where a.emp_no = '$employee' and
									a.empno_appvr3 is not null and
									a.empno_appvr3 <> '' and
									a.request_type = 'Performance'
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
												)");						   
				}

				$ceksum	    = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(kpi_bobot) AS total FROM hrmperf_parequest_stfsc WHERE pa_reqno = '$SFnumbercon'"));		

				if($ceksum['total'] != '100') {
					$validator['success'] = false;
					$validator['code'] = "failed_message" ;
					$validator['messages'] = 'Something data cannot be process please check kpi bobot must be 100% and data cannot empty, Please make sure there is no duplicate data in this request';
						
					$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_parequest_stfsc WHERE pa_reqno = '$SFnumbercon'"));	

					$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));	
						
				} else if($sql_1 == TRUE && $sql_2 == TRUE){

					$update_process = mysqli_query($connect, "UPDATE hrmperf_parequest_stfsc SET `status` = '$approval_req_status_when_submit' WHERE pa_reqno = '$SFnumbercon'");						
					$validator['success'] = true;
					//$validator['code'] = "failed_message";
					$validator['code'] = "success_message_spv_up_version";
					$validator['messages'] = $alert_print_0;

				} else if (mysqli_num_rows($get_data_2) < 1) {
					
					$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_parequest_stfsc WHERE pa_reqno = '$SFnumbercon'"));
					$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = "wrong approval formula";

				} else {

					$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_parequest_stfsc WHERE pa_reqno = '$SFnumbercon'"));
					$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = $alert_print_1;
				}	
			} else {
				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_parequest_stfsc WHERE pa_reqno = '$SFnumbercon'"));
				$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
				$validator['success'] = false;
				$validator['code'] = "failed_message" . $inp_formtype;
				$validator['messages'] = $alert_print_1;
			}
			// condition ends

			// close the database connection
			$connect->close();
			echo json_encode($validator);
	}
}
