<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$provider_name 	= strtoupper($_POST['provider_name']);
	$provider_type 	= strtoupper($_POST['provider_type']);
	$pic 	= strtoupper($_POST['pic']);
	$provider_country 	= strtoupper($_POST['provider_country']);
	$provider_state 	= strtoupper($_POST['provider_state']);
	$provider_city 	= strtoupper($_POST['provider_city']);
	$zipcode 	= strtoupper($_POST['zipcode']);
	$provider_email 	= strtoupper($_POST['provider_email']);
	$provider_phone 	= strtoupper($_POST['provider_phone']);
	$provider_fax 	= strtoupper($_POST['provider_fax']);
	$provider_website 	= strtoupper($_POST['provider_website']);
	$provider_speciality 	= strtoupper($_POST['provider_speciality']);
	$provider_address 	= strtoupper($_POST['provider_address']);
	$provider_remark 	= strtoupper($_POST['provider_remark']);
	$provider_code = preg_filter('/[^A-Z]/', '', $provider_name);

	$query = "INSERT INTO `trnprovider` 
		(
			`provider_code`,
			`provider_name`,
			`provider_type`,
			`pic`,
			`city_id`,
			`state_id`,
			`country_id`,
			`zipcode`,
			`phone`,
			`fax`,
			`email`,
			`web_address`,
			`speciality`,
			`address`,
			`remark`
		) 
			VALUES 
				(
					'$provider_code',
					'$provider_name',
					'$provider_type',
					'$pic',
					'$provider_city',
					'$provider_state',
					'$provider_country',
					'$zipcode',
					'$provider_phone',
					'$provider_fax',
					'$provider_email',
					'$provider_website',
					'$provider_speciality',
					'$provider_address',
					'$provider_remark'
				)";

	// condition start
	$executeQuery = $connect->query($query);

	if($executeQuery == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data";	
	}
	// condition ends
	// var_dump($query_0);
	// die();
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}