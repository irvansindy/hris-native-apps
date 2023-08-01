<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no = strtoupper($_POST['sel_emp_no']);
	$edit_cost_item_code = strtoupper($_POST['edit_cost_item_code']);
	$edit_cost_item_name_id = strtoupper($_POST['edit_cost_item_name_id']);
	$edit_cost_item_name_en = strtoupper($_POST['edit_cost_item_name_en']);
	$edit_cost_item_status = strtoupper($_POST['edit_cost_item_status']);

	$result_status = $edit_cost_item_status = 'ACTIVE' ? 'ACTIVE' : 'INACTIVE';

	$sql = "UPDATE trncost SET 
				`item_name_id` = '$edit_cost_item_name_id',
				`item_name_en` = '$edit_cost_item_name_en', 
				`status` = '$result_status'
			WHERE item_code = '$edit_cost_item_code'";

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
	header('Content-Type: application/json');
	echo json_encode($validator);
}