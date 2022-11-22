<?php
require_once '../../../application/config.php';
$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$family_empfamily_id	= addslashes($_POST['family_empfamily_id']);
	$family_relationship	= addslashes($_POST['family_relationship']);
	$family_name			= strtoupper(addslashes($_POST['family_name']));;

	$sql_0 					= "UPDATE teodempfamily SET name = '$family_name' WHERE empfamily_id = '$family_empfamily_id'";

	// condition start
	$query_0 = $connect->query($sql_0);

	if ($query_0 == TRUE) {
		$validator['success'] = true;
		$validator['code'] = "success_message_update";
		$validator['messages'] = "Successfully saved data";
		$validator['employee'] = "DO177533";
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
