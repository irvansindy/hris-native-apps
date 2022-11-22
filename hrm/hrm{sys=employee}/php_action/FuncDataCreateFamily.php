<?php
require_once '../../../application/config.php';
$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_no				= addslashes($_POST['inp_emp_no']);

	$get_empid				= mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));
	$get_empid_r1			= $get_empid['emp_id'];
	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumbercon    		= 'EMP' . $SFnumber . $get_empid_r1;

	$family_relationship	= addslashes($_POST['family_relationship']);
	$family_name			= strtoupper(addslashes($_POST['family_name']));
	$family_birth_date		= addslashes($_POST['family_birth_date']);
	$family_gender			= addslashes($_POST['family_gender']);
	$family_alivestatus		= addslashes($_POST['family_alivestatus']);

	$count_existing			= mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `teodempfamily` WHERE `emp_id` = '$get_empid_r1' AND `relationship` = '$family_relationship'"));



	$sql_0 					= "INSERT INTO `teodempfamily` 
												(
													`empfamily_id`, 
													`emp_id`, 
													`name`, 
													`relationship`, 
													`dependentsts`, 
													`gender`, 
													`alive_status`, 
													`birthplace`, 
													`birthdate`, 
													`occupation`, 
													`familyemp_id`, 
													`marital_status`, 
													`blood_type`, 
													`phone`, 
													`address`, 
													`document`, 
													`supporting_document`, 
													`document_date`, 
													`lasteducation_status`, 
													`child_order`, 
													`company`, 
													`created_date`, 
													`created_by`, 
													`modified_date`, 
													`modified_by`, 
													`first_name`, 
													`middle_name`, 
													`last_name`, 
													`identity_no`, 
													`sss_dependent`, 
													`bir_dependent`, 
													`philhealth_dependent`, 
													`disability`, 
													`legitimate`
												) VALUES 
													(
														'$SFnumbercon', 
														'$get_empid_r1', 
														'$family_name', 
														'$family_relationship', 
														'1', 
														'$family_gender', 
														'$family_alivestatus', 
														'1', 
														'$family_birth_date', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'2021-08-12 11:21:48', 
														'1', 
														'1', 
														'1', 
														'$SFdatetime', 
														'$inp_emp_no', 
														'$SFdatetime', 
														'$inp_emp_no', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1', 
														'1'
													)";

	// condition start
	

	if ($count_existing > 0) {
		$validator['success'] = true;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data family exist";
		$validator['employee'] = "$get_empid_r1";
	} else {

		$query_0 = $connect->query($sql_0);

		if ($query_0 == TRUE) {
			$validator['success'] = true;
			$validator['code'] = "success_message";
			$validator['messages'] = "Successfully saved data";
			$validator['employee'] = "$get_empid_r1";
		} else {
			$validator['success'] = true;
			$validator['code'] = "false_message";
			$validator['messages'] = "Failed saved data";
			$validator['employee'] = "$get_empid_r1";
		}
	}
	
	
	
	
	
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
