<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());
	
	$inp_worklocation_code		= strtoupper($_POST['inp_worklocation_code']);
	$inp_worklocation_name_en 		= strtoupper($_POST['inp_worklocation_name_en']);
	$inp_worklocation_name_id 		= strtoupper($_POST['inp_worklocation_name_id']);
	$inp_latitude 			= strtoupper($_POST['inp_latitude']);
	$inp_longitude 			= strtoupper($_POST['inp_longitude']);


	$sql_0 = "INSERT INTO `hrmworklocation` 
					(
						`worklocation_code`, 
						`worklocation_name`, 
						`worklocation_name_en`, 
						`latitude`, 
						`longitude`
					) 
						VALUES 
							(
								'$inp_worklocation_code', 
								'$inp_worklocation_name_id', 
								'$inp_worklocation_name_en', 
								'$inp_latitude', 
								'$inp_longitude'
							)";

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