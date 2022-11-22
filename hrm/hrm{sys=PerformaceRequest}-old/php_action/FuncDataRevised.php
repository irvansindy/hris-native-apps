<?php 
require_once '../../../application/config.php';

$SFyear              = date("Y");
$SFdate              = date("Y-m-d");
$SFtime              = date('h:i:s');
$SFdatetime          = date("Y-m-d H:i:s");
$SFnumber            = date("Ymdhis");
$var_find            = array('-', '');
$var_replace         = array('', '');
$identity    		= str_replace($var_find, $var_replace, substr($_POST['inp_SpvDonwManpower'],-9,-2));

	$inp_emp_no			= strtoupper($_POST['inp_emp_no']);
	$revised_request_no		= strtoupper($_POST['revised_request_no']);
	$revised_requester_spvdown	= strtoupper($_POST['revised_requester_spvdown']);

	$get_data_0          	= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));	
	$get_data_print_0    	= $get_data_0['position_id'];

//PAREQ2021-130299-20122020
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	
	for($ikpi=0;$ikpi<count($_POST['inp_attitude_revised0']);$ikpi++){
		$ikpi_plus 		= $ikpi+1;
		$inp_attitude_revised0	= $_POST['inp_attitude_revised0'][$ikpi]; // item
		$inp_attitude_revised1	= $_POST['inp_attitude_revised1'][$ikpi]; // bobot
		$inp_attitude_revised2	= $_POST['inp_attitude_revised2'][$ikpi]; // target
		$inp_attitude_revised3	= $_POST['inp_attitude_revised3'][$ikpi]; // Target Mid Year
		$inp_attitude_revised4	= $_POST['inp_attitude_revised4'][$ikpi]; // Full Year
			
			if($inp_attitude_revised0!==''){

			$sql_1 = mysqli_query($connect, "UPDATE `hrmperf_parequest_stfsc` 
										SET 
											`kpi_bobot` 		= '$inp_attitude_revised1',
											`kpi_target`		= '$inp_attitude_revised2',
											`kpi_midyear_trg` 	= '$inp_attitude_revised3',
											`kpi_fullyear_trg` 	= '$inp_attitude_revised4'
									WHERE 
									`att_item` = '$inp_attitude_revised0' 
									AND `pa_reqno` = '$revised_request_no'");

			}
	}

	$delete_approval_process = mysqli_query($connect, "DELETE FROM `hrmrequestapproval` WHERE `request_no` = '$revised_request_no'");

	if($delete_approval_process){
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
				where a.emp_no = '$revised_requester_spvdown' and
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
					where a.emp_no = '$revised_requester_spvdown' and
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
						where a.emp_no = '$revised_requester_spvdown' and
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
											'$revised_request_no', 
											'$r[request_approval_formula]', 
											'$r[seq_id]',  
											'$r[req]',
											'$approval_status_when_submit',
											'$r[ordering]',
											'$approval_req_status_when_submit',
											'$r[position_id]'
										)");						   
		}
	}

	


	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '26'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '27'"));
	$alert_print_1    = $alert_1['alert'];

	if($sql_1 == TRUE){						
		$validator['success'] = true;
		$validator['code'] = "success_message_revised_spv_down";
		$validator['messages'] = $alert_print_0;
	} else {	
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = mysqli_num_rows($get_data_1);	

	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}