<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$input_emp_no 	= $_POST['input_emp_no'];
	$input_venue_code 	= $_POST['input_venue_code'];
	$input_venue_name 	= strtoupper($_POST['input_venue_name']);
	$input_venue_type 	= strtoupper($_POST['input_venue_type']);
	$input_venue_address 	= strtoupper($_POST['input_venue_address']);
	$input_venue_room_code 	= $_POST['input_venue_room_code'];
	$input_venue_room_name 	= $_POST['input_venue_room_name'];
	$input_venue_country 	= strtoupper($_POST['input_venue_country']);
	$input_venue_state 	= strtoupper($_POST['input_venue_state']);
	$input_venue_city 	= strtoupper($_POST['input_venue_city']);
	$input_venue_postal_code 	= strtoupper($_POST['input_venue_postal_code']);
	$input_venue_phone 	= strtoupper($_POST['input_venue_phone']);
	$input_venue_fax 	= strtoupper($_POST['input_venue_fax']);
	$input_venue_remark 	= strtoupper($_POST['input_venue_remark']);
	// $array_room = json_decode($_POST['array_room']);
	$date = date('Y-m-d H:i:s');

	$query_master_venue = "INSERT INTO `trnmvenue` (
		`venue_code`,
		`venue_name`,
		`venue_type`,
		`venue_address`,
		`country_id`,
		`state_id`,
		`city_id`,
		`venue_zipcode`,
		`venue_phone`,
		`venue_fax`,
		`remark`,
		`active_status`,
		`created_by`,
		`created_date`,
		`modified_by`,
		`modified_date`
	) VALUES (
		'$input_venue_code',
		'$input_venue_name',
		'$input_venue_type',
		'$input_venue_address',
		'$input_venue_country',
		'$input_venue_state',
		'$input_venue_city',
		'$input_venue_postal_code',
		'$input_venue_phone',
		'$input_venue_fax',
		'$input_venue_remark',
		'1',
		'$input_emp_no',
		'$date',
		'$input_emp_no',
		'$date'
	)
	";
	$exe_query_master = $connect->query($query_master_venue);
	
	if (count($input_venue_room_code) != 0 && count($input_venue_room_name) != 0) {
		for ($index=0; $index < count($input_venue_room_code); $index++) { 
			$data_room_code = $input_venue_room_code[$index];
			$data_room_name = $input_venue_room_name[$index];
			if ($data_room_code !== NULL) {
				# code...
				$query_detail_venue = "INSERT INTO `trndvenue`(
					`venue_code`,
					`room_code`,
					`room_name`,
					`created_by`,
					`created_date`,
					`modified_by`,
					`modified_date`
				) VALUES (
					'$input_venue_code',
					'$data_room_code',
					'$data_room_name',
					'$input_emp_no',
					'$date',
					'$input_emp_no',
					'$date'
				)";
				$exe_query_detail = $connect->query($query_detail_venue);
			} else {
				$validator['messages'] = "Data Room Code or Room Name can't be null";
			}
		}
	}

	// if($exe_query_master == TRUE && $exe_query_detail == TRUE) {						
	if($exe_query_detail == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data";
	}

	// close the database connection
	$connect->close();
	echo json_encode($validator);
	// echo json_encode($data_room);
}