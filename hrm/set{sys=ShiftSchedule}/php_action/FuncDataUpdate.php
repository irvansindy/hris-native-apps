<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no			= strtoupper($_POST['sel_emp_no']);
	$sel_schedulegroup_code	= strtoupper($_POST['sel_schedulegroup_code']);
	$sel_schedulegroup_desc 	= strtoupper($_POST['sel_schedulegroup_desc']);
	$sel_order_id 		= $_POST['sel_order_id'];


	$sql = "UPDATE hrmschedulegroup SET 
					`schedulegroup_desc`	= '$sel_schedulegroup_desc',
					`order_id`		= '$sel_order_id',
					`modified_date`	= '$SFdatetime',
					`modified_by`		= '$sel_emp_no'
					
				WHERE schedulegroup_code 	= '$sel_schedulegroup_code'";

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);

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