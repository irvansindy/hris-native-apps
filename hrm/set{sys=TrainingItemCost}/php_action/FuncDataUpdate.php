<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no = strtoupper($_POST['sel_emp_no']);
	$edit_col1 = strtoupper($_POST['edit_col1']);
	$edit_col2 = strtoupper($_POST['edit_col2']);
	$edit_col3 = strtoupper($_POST['edit_col3']);
	$edit_col4 = strtoupper($_POST['edit_col4']);
	// $sel_reason_code		= strtoupper($_POST['sel_reason_code']);
	// $sel_reason_name_en 		= strtoupper(addslashes($_POST['sel_reason_name_en']));
	// $sel_reason_name_id 		= strtoupper(addslashes($_POST['sel_reason_name_id']));

	$sql = "UPDATE debug SET 
					`col2`	= '$edit_col2',
					`col3`	= '$edit_col3',
					`col4`	= '$edit_col4'
				WHERE col1 = '$edit_col1'";

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