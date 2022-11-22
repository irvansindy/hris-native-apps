<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no			= strtoupper($_POST['inp_emp_no']);
	$inp_schedulegroup_code	= strtoupper($_POST['inp_schedulegroup_code']);
	$inp_schedulegroup_desc 	= strtoupper($_POST['inp_schedulegroup_desc']);
	$inp_order_id 		= strtoupper($_POST['inp_order_id']);

	$get_company = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$inp_emp'"));

	$sql_0 = "INSERT INTO `hrmschedulegroup` 
				(
					`schedulegroup_code`, 
					`schedulegroup_desc`, 
					`company_id`, 
					`created_date`, 
					`created_by`, 
					`modified_date`, 
					`modified_by`, 
					`order_id`
				) 
					VALUES 
						(
							'$inp_schedulegroup_code', 
							'$inp_schedulegroup_desc', 
							15134, 
							'$SFdatetime', 
							'$inp_emp_no', 
							'$SFdatetime', 
							'$inp_emp_no', 
							'$inp_order_id'
						)
	";

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {						
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