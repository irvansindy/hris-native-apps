<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_overtime_codes			= $_POST['sel_overtime_codes'];

$sql = "DELETE FROM hrmovertime WHERE overtime_code = '$sel_overtime_codes'";

$query = $connect->query($sql);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message";
	$validator['messages'] = "Successfully delete data";			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = "Failed to delete data";	
}

// close database connection
$connect->close();
echo json_encode($validator);