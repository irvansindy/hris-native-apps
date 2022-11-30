<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no	= strtoupper($_POST['sel_emp_no']);
	$instructor_code = $_POST['edit_instructor_code'];
	$instructor_name = strtoupper($_POST['edit_instructor_name']);
	$instructor_detail = $_POST['edit_instructor_code_detail'];

	$query_update_instructor_master = "UPDATE trninstructor SET 
			`instructor_name`	= '$instructor_name'
			WHERE instructor_code 		= '$instructor_code'";

	$query_delete_instructor_detail = "DELETE FROM `trndinstructor` WHERE `instructor_code` = '$instructor_code'";

	$execute_delete = $connect->query($query_delete_instructor_detail);

	if ($execute_delete = TRUE) {
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
				'$sel_emp_no',
				'$SFdatetime',
				'$sel_emp_no',
				'$SFdatetime'
			)";
			$query_detail = $connect->query($sql_detail);
		}
	}

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($query_update_instructor_master);

	if($query == TRUE) {
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}