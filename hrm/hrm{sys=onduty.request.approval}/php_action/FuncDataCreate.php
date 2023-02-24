<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}


$SFyear              = date("Y");
$SFdate              = date("Y-m-d");
$SFtime              = date('h:i:s');
$SFdatetime          = date("Y-m-d H:i:s");
$SFnumber            = date("Ymd");
$var_find            = array('-', '');
$var_replace         = array('', '');
$identity    		= str_replace($var_find, $var_replace, substr($_POST['inp_SpvDonwManpower'],-9,-2));
$SFnumbercon         = 'PAREQ'.$SFyear.'-'.$identity;

//PAREQ2021-130299-20122020
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no			= strtoupper($_POST['inp_emp_no']);
	$inp_SpvDonwManpower_pre	= strtoupper($_POST['inp_SpvDonwManpower']);

	// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]
	$inp_SpvDonwManpower 	= substr($inp_SpvDonwManpower_pre,-9,-2);
	// GET OUTPUT NIP 13-0299 FROM AGUS PRASETYA [ 13-0299 ]

	$inp_token 			= strtoupper($_POST['inp_token']);

	$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$inp_SpvDonwManpower'"));
	$get_periode			= mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmperf_set_period ORDER BY period_id DESC LIMIT 1"));

	// $delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
	for($ikpi=0;$ikpi<count($_POST['inp_attitude0']);$ikpi++){
		$ikpi_plus 		= $ikpi+1;
		$inp_attitude0	= $_POST['inp_attitude0'][$ikpi]; // item
		$inp_attitude1	= $_POST['inp_attitude1'][$ikpi]; // bobot
		$inp_attitude2	= $_POST['inp_attitude2'][$ikpi]; // target
		$inp_attitude3	= $_POST['inp_attitude3'][$ikpi]; // Target Mid Year
		$inp_attitude4	= $_POST['inp_attitude4'][$ikpi]; // Full Year
		
		if($inp_attitude0!==''){

		$sql_1 = mysqli_query($connect, "INSERT INTO `hrmperf_parequest_stfsc` 
					(
						`att_item`, 
						`pa_reqno`, 
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
								'$inp_SpvDonwManpower', 
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
                        where a.emp_no = '$inp_SpvDonwManpower' and
                              a.empno_appvr1 is not null and
                              a.empno_appvr1 <> ''
                        
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
                              where a.emp_no = '$inp_SpvDonwManpower' and
                                    a.empno_appvr2 is not null and
                                    a.empno_appvr2 <> ''
                              
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
                                    where a.emp_no = '$inp_SpvDonwManpower' and
                                          a.empno_appvr3 is not null and
                                          a.empno_appvr3 <> ''
                        ");
      
      	while($r=mysqli_fetch_array($sql_approval)){
	      
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
                                                                        '0',
                                                                        '$r[ordering]',
                                                                        '1',
                                                                        '$r[position_id]' 
                                                                  )");						   
      	}


	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
	$alert_print_1    = $alert_1['alert'];

	if($sql_1 == TRUE && $sql_2 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message_spv_down";
		$validator['messages'] = $alert_print_0. '-down';			
	} else {		
		$remove_process = mysqli_fetch_array(mysqli_query($connect, "DELETE FROM hrmperf_parequest_stfsc WHERE ipp_reqno = '$SFnumbercon'"));	
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