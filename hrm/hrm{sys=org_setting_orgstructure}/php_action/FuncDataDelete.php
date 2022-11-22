<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$position_id_delete				= $_POST['position_id_delete'];

$sql = "DELETE FROM hrmorgstrucdev WHERE position_id = '$position_id_delete'";

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