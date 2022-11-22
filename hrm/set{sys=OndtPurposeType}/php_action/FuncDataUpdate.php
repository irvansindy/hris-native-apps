<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no			= strtoupper($_POST['sel_emp_no']);
	$sel_purpose_code		= strtoupper($_POST['sel_purpose_code']);
	$sel_purpose_name_en 		= strtoupper(addslashes($_POST['sel_purpose_name_en']));
	$sel_purpose_name_id 		= strtoupper(addslashes($_POST['sel_purpose_name_id']));
	$sel_attend_code		= strtoupper(addslashes($_POST['sel_attend_code']));


	$sql = "UPDATE hrmondutypurposetype SET 
					`purpose_name_en`	= '$sel_purpose_name_en',
					`purpose_name_id` 	= '$sel_purpose_name_id',
					`attend_code`		= '$sel_attend_code'
				WHERE purpose_code 		= '$sel_purpose_code'";

	$delete = mysqli_query($connect, "DELETE FROM `hrrondutypurposecomp` WHERE `purpose_code` = '$sel_purpose_code'");
	for($iemg=0;$iemg<count($_POST['sel_allowance_item']);$iemg++){
		$iemg_plus = $iemg+1;
		$sel_allowance_item	= $_POST['sel_allowance_item'][$iemg];
		
		if($sel_allowance_item!==''){
	
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
												'$sel_purpose_code', 
												'$sel_allowance_item', 
												'$get_company[company_id]', 
												'$sel_emp_no', 
												'$SFdatetime', 
												'$sel_emp_no', 
												'$SFdatetime'
											)
		");
	
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