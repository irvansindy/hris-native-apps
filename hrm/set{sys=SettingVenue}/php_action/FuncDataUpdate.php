<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$edit_emp_no 	= $_POST['edit_emp_no'];
	$edit_venue_code 	= $_POST['edit_venue_code'];
	$edit_venue_name 	= strtoupper($_POST['edit_venue_name']);
	$edit_venue_type 	= $_POST['edit_venue_type'];
	$edit_venue_address 	= strtoupper($_POST['edit_venue_address']);
	$edit_venue_country 	= strtoupper($_POST['edit_venue_country']);
	$edit_venue_state 	= strtoupper($_POST['edit_venue_state']);
	$edit_venue_city 	= strtoupper($_POST['edit_venue_city']);
	$edit_venue_postal_code 	= strtoupper($_POST['edit_venue_postal_code']);
	$edit_venue_phone 	= strtoupper($_POST['edit_venue_phone']);
	$edit_venue_fax 	= strtoupper($_POST['edit_venue_fax']);
	$edit_venue_remark 	= strtoupper($_POST['edit_venue_remark']);
	$edit_venue_room_code 	= $_POST['edit_venue_room_code'];
	$edit_venue_room_name 	= $_POST['edit_venue_room_name'];
	$date = date('Y-m-d H:i:s');

	$query_update_master_venue = "UPDATE trnmvenue SET 
		`venue_name` = '$edit_venue_name',
		`venue_type` = '$edit_venue_type',
		`venue_address` = '$edit_venue_address',
		`country_id` = '$edit_venue_country',
		`state_id` = '$edit_venue_state',
		`city_id` = '$edit_venue_city',
		`venue_zipcode` = '$edit_venue_postal_code',
		`venue_phone` = '$edit_venue_phone',
		`venue_fax` = '$edit_venue_fax',
		`remark` = '$edit_venue_remark',
		`active_status` = '1',
		`created_by` = '$edit_emp_no',
		`created_date` = '$date',
		`modified_by` = '$edit_emp_no',
		`modified_date` = '$date'
		WHERE venue_code = '$edit_venue_code';
	";

	// $exe_query_master = $connect->query($query_update_master_venue);

	$query_delete_detail_old_venue = "DELETE FROM `trndvenue` WHERE `venue_code` = '$edit_venue_code'";

	$exe_query_delete_detail = $connect->query($query_delete_detail_old_venue);

	if ($exe_query_delete_detail == TRUE) {
		for ($index=0; $index < count($edit_venue_room_code); $index++) { 
			$data_edit_venue_room = $edit_venue_room_code[$index];
			$data_edit_venue_name = $edit_venue_room_name[$index];

			$query_update_detail_venue = "INSERT INTO `trndvenue`
			(
				`venue_code`,
				`room_code`,
				`room_name`,
				`created_by`,
				`created_date`,
				`modified_by`,
				`modified_date`
			) VALUES (
				'$edit_venue_code',
				'$data_edit_venue_room',
				'$data_edit_venue_name',
				'$edit_emp_no',
				'$date',
				'$edit_emp_no',
				'$date'
			)";
			$exe_query_detail = $connect->query($query_update_detail_venue);
		}
	}

	// if($exe_query_master == TRUE && $exe_query_detail == TRUE) {
	if($exe_query_detail == TRUE) {
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