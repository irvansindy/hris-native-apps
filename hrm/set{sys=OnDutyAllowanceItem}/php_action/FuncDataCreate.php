<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 
'messages' => array());

	
	// $period		= $_POST['period'].'_'.$_POST['nip'].$flag;
	// $nip		= $_POST['nip'];
	// $org		= $_POST['org'];
	// $emp		= $_POST['emp'];
	// $grp		= $_POST['grp'];
	// $jobstatus	= $_POST['jobstatus'];
	// $amount 	= str_replace("." , "", $_POST['amount']);
	// $note			= $_POST['note'];
	$inp_emp_no 			= strtoupper($_POST['inp_emp_no']);
	$inp_token 			= strtoupper($_POST['inp_token']);

	$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));

	$inp_item_code		= strtoupper($_POST['inp_item_code']);
	$inp_item_name_en 		= $_POST['inp_item_name_en'];
	$inp_item_name_id 		= $_POST['inp_item_name_id'];
	$inp_type 			= strtoupper($_POST['inp_type']);
	$inp_currency_code 		= strtoupper($_POST['inp_currency_code']);
	$inp_category_name_en 	= strtoupper($_POST['inp_category_name_en']);
	$inp_formula			= addslashes($_POST['inp_formula']);

	$sql_0 = "INSERT INTO `hrmondutyallowitem`
					(
						`item_code`,
						`category_code`,
						`currency_code`,
						`type`,
						`item_name_en`,
						`item_name_id`,
						`item_name_my`,
						`item_name_th`,
						`formula`,
						`item_order`,
						`company_id`,
						`created_by`,
						`created_date`, 
						`modified_by`,
						`modified_date`
					) VALUES (
							'$inp_item_code',
							'$inp_category_name_en', 
							'$inp_currency_code', 
							'$inp_type', 
							'$inp_item_name_en', 
							'$inp_item_name_id', 
							'$inp_item_name_en', 
							'$inp_item_name_en', 
							'$inp_formula',
							'0', 
							'$get_company[company_id]', 
							'$inp_emp_no', 
							'$SFdatetime', 
							'$inp_emp_no', 
							'$SFdatetime')";

	$delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$inp_item_code'");
	for($iemg=0;$iemg<count($_POST['inp_purposed_code']);$iemg++){
		$iemg_plus = $iemg+1;
		$inp_purposed_code	= $_POST['inp_purposed_code'][$iemg];
		
		if($inp_purposed_code!==''){

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
												'$inp_purposed_code', 
												'$inp_item_code', 
												'$get_company[company_id]', 
												'$username', 
												'$SFdatetime', 
												'$username', 
												'$SFdatetime'
											)");

		}
	}

	for($iemg=0;$iemg<count($_POST['inp_purposed_code']);$iemg++){
		$iemg_plus = $iemg+1;
		$inp_purposed_code	= $_POST['inp_purposed_code'][$iemg];
		
		if($inp_purposed_code!==''){
	
		$sql_1 = mysqli_query($connect, "INSERT INTO `hrmondutypurposetype` 
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
												'$inp_purposed_code', 
												'$inp_item_code', 
												'$get_company[company_id]', 
												'$username', 
												'$SFdatetime', 
												'$username', 
												'$SFdatetime'
											)");
	
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