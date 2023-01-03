<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$delete_cost_item_id = $_POST['delete_cost_item_id'];

$sql = "DELETE FROM trncost WHERE item_code = '$delete_cost_item_id'";

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