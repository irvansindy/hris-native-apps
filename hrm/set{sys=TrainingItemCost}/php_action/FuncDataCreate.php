<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no	= strtoupper($_POST['inp_emp_no']);
	$input_cost_item_code 	= strtoupper($_POST['input_cost_item_code']);
	$input_cost_item_name_id 	= strtoupper($_POST['input_cost_item_name_id']);
	$input_cost_item_name_en 	= strtoupper($_POST['input_cost_item_name_en']);
	$input_cost_item_status 	= strtoupper($_POST['input_cost_item_status']);

	$sql_0 = "INSERT INTO `trncost` 
					(
						`item_code`, 
						`item_name_id`, 
						`item_name_en`, 
						`status`
					) 
						VALUES 
							(
							'$input_cost_item_code',
							'$input_cost_item_name_id',
							'$input_cost_item_name_en',
							'$input_cost_item_status'
							)";

	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data";	
	}
	// condition ends
	// var_dump($query_0);
	// die();
	// close the database connection
	$connect->close();
	header('Content-Type: application/json');
	echo json_encode($validator);
}