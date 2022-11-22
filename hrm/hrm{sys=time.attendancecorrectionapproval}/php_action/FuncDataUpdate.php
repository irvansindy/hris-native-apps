<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp			= strtoupper($_POST['sel_emp']);
	$sel_attend_id		= strtoupper($_POST['sel_attend_id']);
	$sel_remark 			= strtoupper($_POST['sel_remark']);
	

	$sql = "UPDATE `hrdattcorrection` SET 
				`status` 		= '1',
				`modified_date`	= '$SFdatetime',
				`modified_by`		= '$sel_emp'
			WHERE `attend_id` 		= '$sel_attend_id'";

	$sql1 = "UPDATE `hrdattendance` SET 
				`remark` 		= '$sel_remark',
				`modified_date`	= '$SFdatetime',
				`modified_by`		= '$sel_emp'
			WHERE `attend_id` 		= '$sel_attend_id'";

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);
	$query1 = $connect->query($sql1);

	if($query == TRUE && $query1 == TRUE) {
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1 . $sql;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}