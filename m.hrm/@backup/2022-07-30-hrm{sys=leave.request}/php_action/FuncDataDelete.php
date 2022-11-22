<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}

$validator = array('success' => false, 'messages' => array());

$sel_reason_code			= $_GET['id'];

$query_2 = $connect->query("UPDATE `hrmrequestapproval` SET `request_status` = '8' WHERE `request_no` = '$sel_reason_code'");

if($query_2 == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message";
	$validator['messages'] = "Successfully cancel request";			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = "Failed to cancel request";	
}

// close database connection
$connect->close();
echo json_encode($validator);