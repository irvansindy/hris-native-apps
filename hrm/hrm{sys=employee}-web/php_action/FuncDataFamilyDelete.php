<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$family_delete_empfamily_id				= $_POST['family_delete_empfamily_id'];
$family_delete_emp_id					= $_POST['family_delete_emp_id'];

$sql = "DELETE FROM mgtools_teodempfamily WHERE empfamily_id = '$family_delete_empfamily_id'";

$query = $connect->query($sql);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message";
	$validator['messages'] = "Successfully delete data";		
	$validator['employee'] = "$family_delete_emp_id";			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = "Failed to delete data";	
}

// close database connection
$connect->close();
echo json_encode($validator);