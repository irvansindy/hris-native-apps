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


if($_POST) {	
	


		$validator = array('success' => false, 'messages' => array());

		$sel_emp_no_approver						= strtoupper($_POST['sel_emp_no_approver']); 
		$sel_ipp_reqno_revised_spv_upS				= strtoupper($_POST['sel_ipp_reqno_revised_spv_upS']);
		$inp_emp_no							= $_POST['sel_ipp_requester_revised_spv_upS'];

		$get_data_0          	= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
		$get_data_print_0    	= $get_data_0['position_id'];

		$sql = mysqli_query($connect, "UPDATE `hrmperf_ipprequest` SET `modified_date` = '$SFdatetime' , `modified_by` = '$sel_emp_no_approver' WHERE `ipp_reqno` = '$sel_ipp_reqno_revised_spv_upS'");			

		$delete = mysqli_query($connect, "DELETE FROM hrmrequestapproval WHERE `request_no` = '$sel_ipp_reqno_revised_spv_upS'");

		$delete = mysqli_query($connect, "DELETE FROM hrdperf_ipprequest WHERE `ipp_reqno` = '$sel_ipp_reqno_revised_spv_upS'");
		
		// for($ikpi=0;$ikpi<count($_POST['inp_performance_spvup_revised0']);$ikpi++){
		// 	$ikpi_plus 		= $ikpi+1;
		// 	$inp_performance_spvup_revised0	= $_POST['inp_performance_spvup_revised0'][$ikpi]; // item
		// 	$inp_performance_spvup_revised1	= $_POST['inp_performance_spvup_revised1'][$ikpi]; // bobot
		// 	$inp_performance_spvup_revised2	= $_POST['inp_performance_spvup_revised2'][$ikpi]; // target
		// 	$inp_performance_spvup_revised3	= $_POST['inp_performance_spvup_revised3'][$ikpi]; // Target Mid Year
		// 	$inp_performance_spvup_revised4	= $_POST['inp_performance_spvup_revised4'][$ikpi]; // Full Year
		// 	$inp_performance_spvup_revised5	= $_POST['inp_performance_spvup_revised5'][$ikpi]; // Full Year
		// 	$inp_performance_spvup_revised6	= $_POST['inp_performance_spvup_revised6'][$ikpi]; // Full Year
		// 	$inp_performance_spvup_revised7	= $_POST['inp_performance_spvup_revised7'][$ikpi]; // Full Year
		// 	$inp_performance_spvup_revised8	= $_POST['inp_performance_spvup_revised8'][$ikpi]; // Full Year
		// 	$inp_performance_spvup_revised9	= $_POST['inp_performance_spvup_revised9'][$ikpi]; // Full Year
			
		// 	if($inp_performance_spvup_revised0!==''){

		// 	$sql_1 = mysqli_query($connect, "UPDATE `hrdperf_ipprequest` SET 				
		// 									`kpi_name` = '$inp_performance_spvup_revised1', 
		// 									`kpi_unit` = '$inp_performance_spvup_revised2',
		// 									`kpi_bobot` = '$inp_performance_spvup_revised3',  
		// 									`kpi_type_id` = '$inp_performance_spvup_revised4',  
		// 									`kpi_midyear_trg` = '$inp_performance_spvup_revised5', 
		// 									`kpi_fullyear_trg` = '$inp_performance_spvup_revised6',  
		// 									`kpi_reviewperiod_id` = '$inp_performance_spvup_revised7', 
		// 									`remark` = '$inp_performance_spvup_revised8',
		// 									`kpi_lg`= '$inp_performance_spvup_revised9', 
											
		// 									`modified_date` = '$SFdatetime', 
		// 									`modified_by` = '$inp_emp_no'
										
		// 								WHERE `ipp_reqno` = '$sel_ipp_reqno_revised_spv_upS'");
		// 	}
		// }

		for($ikpi=0;$ikpi<count($_POST['inp_performance_spvup_revised0']);$ikpi++){
			$ikpi_plus 				= $ikpi+1;
			$inp_performance_spvup_revised0	= $_POST['inp_performance_spvup_revised0'][$ikpi]; // item
			$inp_performance_spvup_revised1	= $_POST['inp_performance_spvup_revised1'][$ikpi]; // bobot
			$inp_performance_spvup_revised2	= $_POST['inp_performance_spvup_revised2'][$ikpi]; // target
			$inp_performance_spvup_revised3	= $_POST['inp_performance_spvup_revised3'][$ikpi]; // Target Mid Year
			$inp_performance_spvup_revised4	= $_POST['inp_performance_spvup_revised4'][$ikpi]; // Full Year
			$inp_performance_spvup_revised5	= $_POST['inp_performance_spvup_revised5'][$ikpi]; // Full Year
			$inp_performance_spvup_revised6	= $_POST['inp_performance_spvup_revised6'][$ikpi]; // Full Year
			$inp_performance_spvup_revised7	= $_POST['inp_performance_spvup_revised7'][$ikpi]; // Full Year
			$inp_performance_spvup_revised8	= $_POST['inp_performance_spvup_revised8'][$ikpi]; // Full Year
			$inp_performance_spvup_revised9	= $_POST['inp_performance_spvup_revised9'][$ikpi]; // Full Year
			$inp_performance_spvup_revised10	= $_POST['inp_performance_spvup_revised10'][$ikpi]; // Full Year 
			
			if($inp_performance_spvup_revised0 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
				
			} else if($inp_performance_spvup_revised1 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

			} else if($inp_performance_spvup_revised2 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

			} else if($inp_performance_spvup_revised3 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
			
			} else if($inp_performance_spvup_revised4 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

			} else if($inp_performance_spvup_revised5 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

			} else if($inp_performance_spvup_revised6 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

			} else if($inp_performance_spvup_revised7 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");
			
			} else if($inp_performance_spvup_revised8 == ''){ 

				$sql_1 = mysqli_query($connect, "INSERT INTO `hrdperf_ipprequestasdasdsdsadsadsadsad`");

			} else if($inp_performance_spvup_revised9 == ''){ 

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
													'$sel_ipp_reqno_revised_spv_upS', 
													'$ikpi_plus', 
													'$inp_performance_spvup_revised0', 
													'$inp_performance_spvup_revised1', 
													'$inp_performance_spvup_revised2', 
													'$inp_performance_spvup_revised3', 
													'$inp_performance_spvup_revised4', 
													'$inp_performance_spvup_revised5', 
													'$inp_performance_spvup_revised6', 
													'$inp_performance_spvup_revised7',
													'$inp_performance_spvup_revised8', 
													'$inp_performance_spvup_revised9', 
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
				where a.emp_no = '$inp_emp_no' and
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
					where a.emp_no = '$inp_emp_no' and
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
						where a.emp_no = '$inp_emp_no' and
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
											'$sel_ipp_reqno_revised_spv_upS', 
											'$r[request_approval_formula]', 
											'$r[seq_id]',  
											'$r[req]',
											'$approval_status_when_submit',
											'$r[ordering]',
											'$approval_req_status_when_submit',
											'$r[position_id]' 
										)");
										
		}

		$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
		$alert_print_0    = $alert_0['alert'];
		$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
		$alert_print_1    = $alert_1['alert'];

		$ceksum	    = mysqli_fetch_array(mysqli_query($connect, "SELECT SUM(kpi_bobot) AS total FROM hrdperf_ipprequest WHERE ipp_reqno = '$sel_ipp_reqno_revised_spv_upS'"));		
	
		if($sql == TRUE ) {		
			if($ceksum['total'] != '100') {
				$validator['success'] = false;
				$validator['code'] = "failed_message" ;
				$validator['messages'] = 'Something data cannot be process please check kpi bobot must be 100% and data cannot empty';
				
				$sql_2 = "UPDATE hrmrequestapproval SET request_status = '4' WHERE request_no = '$sel_ipp_reqno_revised_spv_upS'";
				$sql_3 = "UPDATE hrmperf_ipprequest SET `status` = '4' WHERE ipp_reqno = '$sel_ipp_reqno_revised_spv_upS'";
				$query = $connect->query($sql_2);
				$query = $connect->query($sql_3);
		
			} else {
				$validator['success'] = true;
				$validator['code'] = "success_message_revised_spv_up_version";
				//$validator['code'] = "failed_message" ;
				$validator['messages'] = $alert_print_0 . $sql_1s;
			}				
			
		} else {	
			
			$validator['success'] = false;
			$validator['code'] = "failed_message" ;
			$validator['messages'] = $alert_print_1;

		}
		// condition ends

		// close the database connection
		$connect->close();
		echo json_encode($validator);	
}