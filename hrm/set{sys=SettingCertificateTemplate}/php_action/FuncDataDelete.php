<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$certificate_code = $_POST['del_certificate_code'];

$sql = "DELETE FROM ttamcertification_template WHERE certificate_code = '$certificate_code'";

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