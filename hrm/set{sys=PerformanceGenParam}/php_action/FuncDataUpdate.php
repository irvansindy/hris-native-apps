<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no			= strtoupper($_POST['inp_emp_no']);
	$sel_parameter_code		= $_POST['sel_parameter_code'];

	$delete = mysqli_query($connect, "DELETE FROM `hrdvalmargin` WHERE `request_type` = '$sel_parameter_code'");

	$print =  "DELETE FROM `hrdvalmargin` WHERE `request_type` = '$sel_parameter_code'";

	for($iemg=0;$iemg<count($_POST['sel_parameter']);$iemg++){
		$iemg_plus = $iemg+1;
		$sel_parameters	= $_POST['sel_parameter'][$iemg];

		$sql_1 = mysqli_query($connect, "INSERT INTO `hrdvalmargin` 
									(
										`id_val`, 
										`emp_no`, 
										`request_type`,
										`ref_doc`, 
										`max_apvr_day`, 
										`remarks`, 
										`_timestamp`
									) VALUES 
										(
											'REF$flag$iemg',
											'$sel_parameters', 
											'$sel_parameter_code', 
											'1', 
											'30', 
											'1', 
											'2022-04-07 15:37:09'
										)");
	}

	if($delete == TRUE) {							
		// $validator['success'] = true;
		// $validator['code'] = "success_message";
		$validator['success'] = false;
		$validator['code'] = "failed_message";
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