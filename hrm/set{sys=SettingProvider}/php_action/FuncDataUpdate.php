<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$provider_code 	= $_POST['edit_provider_code'];
	$provider_name 	= strtoupper($_POST['edit_provider_name']);
	$provider_type 	= strtoupper($_POST['edit_provider_type']);
	$pic 	= strtoupper($_POST['edit_pic']);
	$provider_country 	= strtoupper($_POST['edit_provider_country']);
	$provider_state 	= strtoupper($_POST['edit_provider_state']);
	$provider_city 	= strtoupper($_POST['edit_provider_city']);
	$zipcode 	= strtoupper($_POST['edit_zipcode']);
	$provider_email 	= strtoupper($_POST['edit_provider_email']);
	$provider_phone 	= strtoupper($_POST['edit_provider_phone']);
	$provider_fax 	= strtoupper($_POST['edit_provider_fax']);
	$provider_website 	= strtoupper($_POST['edit_provider_website']);
	$provider_speciality 	= strtoupper($_POST['edit_provider_speciality']);
	$provider_address 	= strtoupper($_POST['edit_provider_address']);
	$provider_remark 	= strtoupper($_POST['edit_provider_remark']);

	$sql = "UPDATE trnprovider SET 
			`provider_name` = '$provider_name',
			`provider_type` = '$provider_type',
			`pic` = '$pic',
			`city_id` = '$provider_city',
			`state_id` = '$provider_state',
			`country_id` = '$provider_country',
			`zipcode` = '$zipcode',
			`phone` = '$provider_phone',
			`fax` = '$provider_fax',
			`email` = '$provider_email',
			`web_address` = '$provider_website',
			`speciality` = '$provider_speciality',
			`address` = '$provider_address',
			`remark` = '$provider_remark'
				WHERE provider_code = '$provider_code'";

	// print_r($sql);
	// die();
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