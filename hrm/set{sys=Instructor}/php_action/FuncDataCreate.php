<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no = strtoupper($_POST['inp_emp_no']);
	$inp_token = strtoupper($_POST['inp_token']);
	$instructor_code = strtoupper($_POST['instructor_code']);
	$instructor_name = strtoupper($_POST['instructor_name']);
	$instructor_detail = $_POST['provider_item'];

	$sql_0 = "INSERT INTO `trninstructor` 
		(
			`instructor_code`, 
			`instructor_name`,
			`instructorcodeext`
		) 
		VALUES
			(
				'$instructor_code',
				'$instructor_name',
				NUll
			)";

	// $result_provider = implode(',', $instructor_detail);

	// insert data detail instructor
	for ($index=0; $index < count($instructor_detail); $index++) {
		$data_provider = $instructor_detail[$index];
		$sql_detail = "INSERT INTO `trndinstructor`
		(
			`instructor_code`,
			`provider`,
			`created_by`, 
			`created_date`, 
			`modified_by`, 
			`modified_date`
		)
		VALUES (
			'$instructor_code',
			'$data_provider',
			'$inp_emp_no',
			'$SFdatetime',
			'$inp_emp_no',
			'$SFdatetime'
		)";
		$query_detail = $connect->query($sql_detail);
	}

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query_0 = $connect->query($sql_0);
	// $query_1 = $connect->multi_query($result_detail);
	// $query_1 = $connect->mysqli_real_escape_string($result_detail);

	if($query_0 == TRUE && $query_detail == TRUE) {						
	// if($query_detail) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1;	
		// $validator['messages'] = var_dump($instructor_detail);
	// condition ends
	}
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
