<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_process_order		= strtoupper($_POST['inp_process_order']);
	$inp_formula			= addslashes($_POST['inp_formula']);

	$sql = "INSERT INTO `hrmattformula` 
					(
						`company_id`, 
						`process_order`, 
						`ordering`, 
						`attformula`, 
						`created_date`, 
						`created_by`, 
						`modified_date`, 
						`modified_by`, 
						`listattendcode`
					) 
						VALUES 
							(
								'13576', 
								'$inp_process_order', 
								'$inp_process_order',
								'$inp_formula', 
								'$SFdatetime', 
								'$username', 
								'$SFdatetime', 
								'$username', 
								'ABS')";

	// condition start
	$query = $connect->query($sql);

	if($query == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully Update data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed Update data";	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}