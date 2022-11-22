<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	
	// $period		= $_POST['period'].'_'.$_POST['nip'].$flag;
	// $nip		= $_POST['nip'];
	// $org		= $_POST['org'];
	// $emp		= $_POST['emp'];
	// $grp		= $_POST['grp'];
	// $jobstatus	= $_POST['jobstatus'];
	// $amount 	= str_replace("." , "", $_POST['amount']);
	// $note		= $_POST['note'];
	$inp_emp_no 			= strtoupper($_POST['inp_emp_no']);
	$inp_token 			= strtoupper($_POST['inp_token']);

	$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));

	$inp_purpose_code		= strtoupper($_POST['inp_purpose_code']);
	$inp_purpose_name_en 	= strtoupper($_POST['inp_purpose_name_en']);
	$inp_purpose_name_id 	= strtoupper($_POST['inp_purpose_name_id']);
	$inp_attendcode 		= strtoupper($_POST['inp_attendcode']);

	$sql_0 = "INSERT INTO `hrmondutypurposetype` 
					(
						`purpose_code`, 
						`purpose_name_en`, 
						`purpose_name_id`, 
						`purpose_name_my`, 
						`purpose_name_th`, 
						`company_id`, 
						`created_by`, 
						`created_date`,
						`modified_by`, 
						`modified_date`, 
						`attend_code`
					) 
						VALUES
							(
								'$inp_purpose_code', 
								'$inp_purpose_name_en', 
								'$inp_purpose_name_id', 
								'$inp_purpose_name_en', 
								'$inp_purpose_name_en', 
								'$get_company[company_id]', 
								'$inp_emp_no', 
								'$SFdatetime', 
								'$inp_emp_no', 
								'$SFdatetime', 
								'$inp_attendcode'
							)";

	for($iemg=0;$iemg<count($_POST['inp_allowance_item']);$iemg++){
		$iemg_plus = $iemg+1;
		$inp_allowance_item	= $_POST['inp_allowance_item'][$iemg];
		
		if($inp_allowance_item!==''){
	 
		$sql_1 = mysqli_query($connect, "INSERT INTO `hrrondutypurposecomp` 
									(
										`purpose_code`, 
										`item_code`, 
										`company_id`, 
										`created_by`, 
										`created_date`, 
										`modified_by`, 
										`modified_date`
									) 
										VALUES 
											(
												'$inp_purpose_code', 
												'$inp_allowance_item', 
												'$get_company[company_id]', 
												'$inp_emp_no', 
												'$SFdatetime', 
												'$inp_emp_no', 
												'$SFdatetime'
											)
		");
	 
		}
	}

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
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