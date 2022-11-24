<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$debug_by_col1 = $_POST['debug_by_col1'];

$sql = "DELETE FROM debug WHERE col1 = '$debug_by_col1'";

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