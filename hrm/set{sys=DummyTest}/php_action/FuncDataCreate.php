<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no				= strtoupper($_POST['inp_emp_no']);
	// $inp_reason_code		= strtoupper($_POST['inp_reason_code']);
	// $inp_reason_name_en 	= strtoupper($_POST['inp_reason_name_en']);
	// $inp_reason_name_id 	= strtoupper($_POST['inp_reason_name_id']);
	$inp_col_1 	= strtoupper($_POST['inp_col_1']);
	$inp_col_2 	= strtoupper($_POST['inp_col_2']);
	$inp_col_3 	= strtoupper($_POST['inp_col_3']);
	$inp_col_4 	= strtoupper($_POST['inp_col_4']);
	
	// $get_company = mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));

	$sql_0 = "INSERT INTO `debug` 
					(
						`col1`, 
						`col2`, 
						`col3`, 
						`col4`
					) 
						VALUES 
							(
							'$inp_col_1',
							'$inp_col_2',
							'$inp_col_3',
							'$inp_col_4'
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
	// var_dump($query_0);
	// die();
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}