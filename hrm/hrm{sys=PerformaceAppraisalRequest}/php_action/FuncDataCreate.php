<?php 
require_once '../../../application/config.php';

$SFyear              = date("Y");
$SFdate              = date("Y-m-d");
$SFtime              = date('h:i:s');
$SFdatetime          = date("Y-m-d H:i:s");
$SFnumber            = date("Ymd");
$var_find            = array('-', '');
$var_replace         = array('', '');
$identity    		= str_replace($var_find, $var_replace, $_POST['sel_ipp_reqno_spv_downS']);
$SFnumbercon         = 'PA-APPR'.$SFyear.'-'.$identity;

//PAREQ2021-130299-20122020
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver			= strtoupper($_POST['sel_emp_no_approver']);
	$sel_ipp_requester_spv_downS	= strtoupper($_POST['sel_ipp_requester_spv_downS']);
	$sel_ipp_reqno_spv_downS		= strtoupper($_POST['sel_ipp_reqno_spv_downS']);
	$sel_remark_from_approver_spv_down	= strtoupper($_POST['sel_remark_from_approver_spv_down']);

	$get_company				= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_periode				= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmperf_set_period ORDER BY period_id DESC LIMIT 1"));

	$get_data_0          		= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    		= $get_data_0['position_id'];

	// $delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
	for($ikpi=0;$ikpi<count($_POST['inp_attitude_spvdown_approver1']);$ikpi++){
		$ikpi_plus 		= $ikpi+1;
		$inp_attitude_spvdown_approver1	= $_POST['inp_attitude_spvdown_approver1'][$ikpi]; // req_no
		$inp_attitude_spvdown_approver2	= $_POST['inp_attitude_spvdown_approver2'][$ikpi]; // item
		$inp_attitude_spvdown_approver3	= $_POST['inp_attitude_spvdown_approver3'][$ikpi]; // kpi_midyear_realisasi Mid Year
		$inp_attitude_spvdown_approver4	= $_POST['inp_attitude_spvdown_approver4'][$ikpi]; // Full kpi_fullyear_realisasi
		
		if($inp_attitude_spvdown_approver0!==''){

		$sql_1 = mysqli_query($connect, "UPDATE `hrmperf_parequest_stfsc` 
								SET 
									`kpi_midyear_realisasi`	= '$inp_attitude_spvdown_approver3',
									`kpi_fullyear_realisasi`	= '$inp_attitude_spvdown_approver4',
									`ipa_remark`			= '$sel_remark_from_approver_spv_down'
								WHERE  
									`att_item`			= '$inp_attitude_spvdown_approver2'
									AND `pa_reqno` 		= '$inp_attitude_spvdown_approver1'");
		}
	}

	$delete = "DELETE FROM `hrdperf_ipprequest` WHERE `ipp_reqno` = '$sel_ipp_reqno_spv_upS'";
	$connect->query($delete);

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
                        where a.emp_no = '$sel_ipp_requester_spv_downS' and
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
                              where a.emp_no = '$sel_ipp_requester_spv_downS' and
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
                                    where a.emp_no = '$sel_ipp_requester_spv_downS' and
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

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '25'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
	$alert_print_1    = $alert_1['alert'];
	$alert_2          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_2    = $alert_2['alert'];

	if($sql_1 == TRUE && $sql_2 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_appraised_spvdown";
		$validator['messages'] = $alert_print_0;
		$get_select_max_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(request_status) as `status` FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
		$upd_approval_appraisal_status = mysqli_query($connect, "UPDATE hrmperf_parequest_stfsc SET appraisal_status = '$get_select_max_approver[status]', ipa_reqno = '$SFnumbercon' WHERE pa_reqno = '$sel_ipp_reqno_spv_downS'");
	} else {
		$get_data_from_table_approval = mysqli_query($connect, "SELECT * FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'");
		if(mysqli_num_rows($get_data_from_table_approval) > 0){
			$validator['success'] = true;
			$validator['code'] = "success_appraised_spvdown";
			$validator['messages'] = $alert_print_2;	
			$get_select_max_approver = mysqli_fetch_array(mysqli_query($connect, "SELECT MAX(request_status) as `status` FROM hrmrequestapproval WHERE request_no = '$SFnumbercon'"));
			$upd_approval_appraisal_status = mysqli_query($connect, "UPDATE hrmperf_parequest_stfsc SET appraisal_status = '$get_select_max_approver[status]', ipa_reqno = '$SFnumbercon' WHERE pa_reqno = '$sel_ipp_reqno_spv_downS'");
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