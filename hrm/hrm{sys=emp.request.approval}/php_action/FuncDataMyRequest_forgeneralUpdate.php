<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no_approver						= strtoupper($_POST['sel_emp_no_approver']);
	$sel_approval_general_request_no			= strtoupper($_POST['sel_approval_general_request_no']);
	$sel_approval_general_emp_no				= strtoupper($_POST['sel_approval_general_emp_no']);
	$sel_approval_general_emp_id				= strtoupper($_POST['sel_approval_general_emp_id']);
	$sel_approval_general_request_type			= strtoupper($_POST['sel_approval_general_request_type']);
	$get_data_0          						= mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
	$get_data_print_0    						= $get_data_0['position_id'];


	$sql_approval_status = "UPDATE `hrmrequestapproval` SET
					`status` 		= '1',
					`_approval_time`	= '$SFdatetime'
				WHERE
					`request_no` 		= '$sel_approval_general_request_no' AND
					`position_id`		= '$get_data_print_0'";
	$qsql_approval_status = $connect->query($sql_approval_status);

	$sql_rt = "SELECT
												
	COUNT(*) as total_approver,
	(SELECT 
		COUNT(*) AS total_approver_without_acknowledge
		FROM hrmrequestapproval
			WHERE
			request_no = '$sel_approval_general_request_no' AND
			req IN ('Sequence','Required')) AS total_approver_without_acknowledge,
	(SELECT 
		SUM(STATUS) AS total_approver_without_acknowledge
		FROM hrmrequestapproval
			WHERE
			request_no = '$sel_approval_general_request_no' AND
			req IN ('Sequence','Required')) AS total_without_acknowledge,
	SUM(STATUS) AS total
FROM hrmrequestapproval
	WHERE
		request_no = '$sel_approval_general_request_no' AND
		req IN ('Notification','Sequence','Required')";

	$get_any_request = mysqli_fetch_array(mysqli_query($connect, "SELECT
												
												COUNT(*) as total_approver,
												(SELECT 
													COUNT(*) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_approval_general_request_no' AND
														req IN ('Sequence','Required')) AS total_approver_without_acknowledge,
												(SELECT 
													SUM(STATUS) AS total_approver_without_acknowledge
													FROM hrmrequestapproval
														WHERE
														request_no = '$sel_approval_general_request_no' AND
														req IN ('Sequence','Required')) AS total_without_acknowledge,
												SUM(STATUS) AS total
											FROM hrmrequestapproval
												WHERE
													request_no = '$sel_approval_general_request_no' AND
													req IN ('Notification','Sequence','Required')"));

	if ($get_any_request['total_approver'] == $get_any_request['total'] || $get_any_request['total'] > $get_any_request['total_approver'] || $get_any_request['total_without_acknowledge'] == $get_any_request['total_approver_without_acknowledge']) {
		$set_status = '3';

		$sql_approval_request = "UPDATE `hrmrequestapproval` SET
												`request_status` 	= '$set_status'
											WHERE
												`request_no` 		= '$sel_approval_general_request_no'";

		$qsql_approval_request = $connect->query($sql_approval_request);
		
		if($sel_approval_general_request_type == 'EMPLOYMENT.DATA') {

			$sql_0 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM view_employee WHERE emp_no = '$sel_approval_general_emp_no'"));
			$sql_00 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_view_employee WHERE request_no = '$sel_approval_general_request_no'"));

			$sql_00['first_name'] == '---' ? $sql_001 = $sql_0['first_name'] : $sql_001 = $sql_00['first_name'];
			$sql_00['middle_name'] == '---' ? $sql_002 = $sql_0['middle_name'] : $sql_002 = $sql_00['middle_name'];
			$sql_00['last_name'] == '---' ? $sql_003 = $sql_0['last_name'] : $sql_003 = $sql_00['last_name'];
			$sql_00['Full_Name'] == '---' ? $sql_004 = $sql_0['Full_Name'] : $sql_004 = $sql_00['Full_Name'];
			$sql_00['birthplace'] == '---' ? $sql_005 = $sql_0['birthplace'] : $sql_005 = $sql_00['birthplace'];
			$sql_00['birthdate'] == '---' ? $sql_006 = $sql_0['birthdate'] : $sql_006 = $sql_00['birthdate'];
			$sql_00['idnumber'] == '---' ? $sql_007 = $sql_0['idnumber'] : $sql_007 = $sql_00['idnumber'];
			$sql_00['familyidnumber'] == '---' ? $sql_008 = $sql_0['familyidnumber'] : $sql_008 = $sql_00['familyidnumber'];
			$sql_00['gender'] == '---' ? $sql_009 = $sql_0['gender'] : $sql_009 = $sql_00['gender'];
			$sql_00['religion'] == '---' ? $sql_010 = $sql_0['religion'] : $sql_010 = $sql_00['religion'];
			$sql_00['maritalstatus'] == '---' ? $sql_011 = $sql_0['maritalstatus'] : $sql_011 = $sql_00['maritalstatus'];
			$sql_00['nationality'] == '---' ? $sql_012 = $sql_0['nationality'] : $sql_012 = $sql_00['nationality'];
			$sql_00['phone'] == '---' ? $sql_013 = $sql_0['phone'] : $sql_013 = $sql_00['phone'];
			$sql_00['email_personal'] == '---' ? $sql_014 = $sql_0['email_personal'] : $sql_014 = $sql_00['email_personal'];
			$sql_00['email'] == '---' ? $sql_015 = $sql_0['email'] : $sql_015 = $sql_00['email'];

			$sql_updatefrom_validity_mgtools_view_employee = "UPDATE `view_employee` SET
																	`first_name` 		= '$sql_001',
																	`middle_name` 		= '$sql_002',
																	`last_name` 		= '$sql_003',
																	`Full_Name` 		= '$sql_004',
																	`birthplace` 		= '$sql_005',
																	`birthdate` 		= '$sql_006',
																	`idnumber` 			= '$sql_007',
																	`familyidnumber` 	= '$sql_008',
																	`gender` 			= '$sql_009',
																	`religion` 			= '$sql_010',
																	`maritalstatus` 	= '$sql_011',
																	`nationality` 		= '$sql_012',
																	`phone` 			= '$sql_013',
																	`email_personal` 	= '$sql_014',
																	`email` 			= '$sql_015'
																WHERE
																	`emp_no` 			= '$sel_approval_general_emp_no'";

			$qUpdateWhereValid = $connect->query($sql_updatefrom_validity_mgtools_view_employee);


			$sql_1 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM teodempaddress WHERE emp_id = '$sel_approval_general_emp_id' AND addresstype_code = 'A'"));
			$sql_01 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM mgtools_teodempaddress WHERE request_no = '$sel_approval_general_request_no' AND addresstype_code = 'A'"));

			$sql_01['address'] == '---' ? $sql_001 = $sql_1['address'] : $sql_001 = $sql_01['address'];
			$sql_01['rt'] == '---' ? $sql_002 = $sql_1['rt'] : $sql_002 = $sql_01['rt'];
			$sql_01['rw'] == '---' ? $sql_003 = $sql_1['rw'] : $sql_003 = $sql_01['rw'];
			$sql_01['district'] == '---' ? $sql_004 = $sql_1['district'] : $sql_004 = $sql_01['district'];
			$sql_01['city_id'] == '---' ? $sql_005 = $sql_1['city_id'] : $sql_005 = $sql_01['city_id'];
			$sql_01['state_id'] == '---' ? $sql_006 = $sql_1['state_id'] : $sql_006 = $sql_01['state_id'];
			$sql_01['country_id'] == '---' ? $sql_007 = $sql_1['country_id'] : $sql_007 = $sql_01['country_id'];
			$sql_01['zipcode'] == '---' ? $sql_008 = $sql_1['zipcode'] : $sql_008 = $sql_01['zipcode'];
			
			$sql_updatefrom_validity_mgtools_teodempaddress			= "UPDATE `teodempaddress` SET 
											`address` 			= '$sql_001', 
											`rt` 				= '$sql_002', 
											`rw` 				= '$sql_003',  
											`district` 			= '$sql_004',  
											`city_id` 			= '$sql_005',  
											`state_id` 			= '$sql_006',  
											`country_id` 		= '$sql_007',  
											`zipcode` 			= '$sql_008'
									WHERE
											`emp_ID` 			= '$sel_approval_general_emp_id' AND 
											`addresstype_code` 	= 'A'";
			
			$qUpdateWhereValid = $connect->query($sql_updatefrom_validity_mgtools_teodempaddress);

		}

		if ($qsql_approval_request == TRUE) {

			$validator['success'] = false;
			$validator['code'] = "success_message";
			$validator['messages'] = "Successfully approve request";

		} else {

			$validator['success'] = false;
			$validator['code'] = "failed_message";
			$validator['messages'] = "Failed approve request";

		}
	} else {

		$set_status = '2';

		$sql_approval_request = "UPDATE `hrmrequestapproval` SET
												`request_status` 	= '$set_status'
											WHERE
												`request_no` 		= '$sel_approval_general_request_no'";
		$qsql_approval_request = $connect->query($sql_approval_request);

		$validator['success'] = false;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully approve request ";

	}

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
