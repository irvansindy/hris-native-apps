<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no				= strtoupper($_POST['inp_emp_no']);
	$inp_reason_code		= strtoupper($_POST['inp_reason_code']);
	$inp_reason_name_en 	= strtoupper($_POST['inp_reason_name_en']);
	$inp_reason_name_id 	= strtoupper($_POST['inp_reason_name_id']);

	$get_company = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));

	$sql_0 = "INSERT INTO `hrmovertimereason` 
					(
						`reason_code`, 
						`reason_name_en`, 
						`reason_name_id`, 
						`reason_name_my`, 
						`reason_name_th`, 
						`modified_by`, 
						`modified_date`, 
						`created_by`, 
						`created_date`, 
						`company_id`
					) 
						VALUES 
							(
								'$inp_reason_code', 
								'$inp_reason_name_en', 
								'$inp_reason_name_id', 
								'$inp_reason_name_en', 
								'$inp_reason_name_en', 
								'$inp_emp_no', 
								'$SFdatetime', 
								'$inp_emp_no', 
								'$SFdatetime', 
								'$get_company[company_id]'
							)";

	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data";			
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