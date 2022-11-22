<?php 
require_once '../../../application/config.php';
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no			= strtoupper($_POST['sel_emp_no']);

	$sel_item_code		= strtoupper($_POST['sel_item_code']);
	$sel_item_name_en 		= $_POST['sel_item_name_en'];
	$sel_item_name_id 		= $_POST['sel_item_name_id'];
	$sel_type 			= strtoupper($_POST['sel_type']);
	$sel_currency_code 		= strtoupper($_POST['sel_currency_code']);
	$sel_category_name_en 	= strtoupper($_POST['sel_category_name_en']);
	$sel_formula			= addslashes($_POST['sel_formula']);
	
	$sql = "UPDATE `hrmondutyallowitem` SET
					`currency_code` 	= '$sel_currency_code',
					`type`			= '$sel_type',
					`formula`		= '$sel_formula',
					`item_name_en` 	= '$sel_item_name_en',
					`item_name_id` 	= '$sel_item_name_id',
					`item_name_my`	= '$sel_item_name_en',
					`item_name_th`	= '$sel_item_name_en'
				WHERE `item_code` 		= '$sel_item_code'";

	$delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `item_code` = '$sel_item_code'");
	for($iemg=0;$iemg<count($_POST['sel_purposed_code']);$iemg++){
		$iemg_plus = $iemg+1;
		$sel_purposed_code	= $_POST['sel_purposed_code'][$iemg];
		
		if($sel_purposed_code!==''){

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
												'$sel_purposed_code', 
												'$sel_item_code', 
												'$get_company[company_id]', 
												'$username', 
												'$SFdatetime', 
												'$username', 
												'$SFdatetime'
											)");

		}
	}

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);

	if($query == TRUE) {
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