<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sql = "INSERT INTO `hrdattendance_dev` (`attend_id`, `emp_id`, `attend_date`, `shiftdaily_code`, `company_id`, `shiftstarttime`, `shiftendtime`, `attend_code`, `starttime`, `endtime`, `actual_in`, `actual_out`, `daytype`, `ip_starttime`, `ip_endtime`, `remark`, `default_shift`, `total_ot`, `total_otindex`, `overtime_code`, `created_date`, `created_by`, `modified_date`, `modified_by`, `flexibleshift`, `auto_ovt`, `actualworkmnt`, `premicheck`, `dateforcheck`, `shiftgroupcode`, `geolocation`, `photo_start`, `photo_end`, `geoloc_start`, `geoloc_end`, `att_flag_start`, `att_flag_end`, `distance_start`, `distance_end`, `totalot_rounddown`, `check`, `check2`) VALUES ('DATA', 'oop', '2022-06-08 12:48:40', 'op', 'op', '2022-06-08 12:48:41', '2022-06-08 12:48:41', 'po', '2022-06-08 12:48:41', '2022-06-08 12:48:41', 'op', 'op', 'op', 'opo', 'po', 'po', 'po', 'po', 'pop', 'op', '2022-06-08 12:48:43', 'o', '2022-06-08 12:48:43', 'op', 'op', 'opo', 'po', 'po', '2022-06-08', 'pop', 'o', 'po', 'po', 'p', 'op', 'op', 'op', 'op', 'op', 'op', 'op', 'op')";

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