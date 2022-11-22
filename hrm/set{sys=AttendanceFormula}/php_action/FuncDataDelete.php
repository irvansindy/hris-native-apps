<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_process_order			= $_POST['sel_process_order'];

$sql = "DELETE FROM hrmattformula WHERE process_order = '$sel_process_order'";

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