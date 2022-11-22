<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no			= strtoupper($_POST['inp_emp_no']);
	$sel_parameter		= strtoupper($_POST['sel_parameter']);

	$delete = mysqli_query($connect, "DELETE FROM `hrdvalmargin` WHERE `request_type` = '$sel_parameter'");

	$print =  "DELETE FROM `hrdvalmargin` WHERE `request_type` = '$sel_parameter'";

	for($iemg=0;$iemg<count($_POST['sel_parameter']);$iemg++){
		$iemg_plus = $iemg+1;
		$sel_parameters	= $_POST['sel_parameter'][$iemg];
		
		if($sel_parameter!==''){

		$sql_1 = mysqli_query($connect, "INSERT INTO `hrdvalmargin` 
									(
										`id_val`, 
										`emp_no`, 
										`request_type`,
										`ref_doc`, 
										`max_apvr_day`, 
										`remarks`
									) VALUES 
										(
											'$iemg',
											'$sel_parameters', 
											'$sel_parameter', 
											'1', 
											'1', 
											'1' 
										)");

		}
	}

	if($sql_1 == TRUE) {						
		// $validator['success'] = true;
		// $validator['code'] = "success_message";
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Successfully saved data" . $print;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data";	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}