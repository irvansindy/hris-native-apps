<?php 
require_once '../../../application/config.php';
	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumbercon    		= 'EMP' . $SFnumber;
	$SFReqtype				= 'Employment.data';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_requestfor 			= $_POST['settlement_emp_no'];
	$username     				= $_POST['settlement_emp_no'];
	$inp_emp_no					= $_POST['inp_emp_no'];

	$settlement_emp_id			= addslashes($_POST['settlement_emp_id']);
	$settlement_first_name		= addslashes($_POST['settlement_first_name']);
	$settlement_middle_name		= addslashes($_POST['settlement_middle_name']);
	$settlement_last_name		= addslashes($_POST['settlement_last_name']);

	$full_name					= $settlement_first_name.' '.$settlement_middle_name.' '.$settlement_last_name;

	$settlement_emp_id 			= addslashes($_POST['settlement_emp_id']);
	$settlement_emp_no 			= addslashes($_POST['settlement_emp_no']);
	$settlement_first_name 		= addslashes($_POST['settlement_first_name']);
	$settlement_middle_name 	= addslashes($_POST['settlement_middle_name']);
	$settlement_place_ofbirth 	= addslashes($_POST['settlement_place_ofbirth']);
	$settlement_birth_date 		= addslashes($_POST['settlement_birth_date']);
	$settlement_id_number 		= addslashes($_POST['settlement_id_number']);
	$settlement_idfamily 		= addslashes($_POST['settlement_idfamily']);
	$settlement_gender 			= addslashes($_POST['settlement_gender']);
	$settlement_bloodtype 		= addslashes($_POST['settlement_bloodtype']);
	$settlement_religion 		= addslashes($_POST['settlement_religion']);
	$settlement_maritalstatus 	= addslashes($_POST['settlement_maritalstatus']);
	$settlement_nationality 	= addslashes($_POST['settlement_nationality']);
	$settlement_mobilephone 	= addslashes($_POST['settlement_mobilephone']);
	$settlement_personalmail 	= addslashes($_POST['settlement_personalmail']);
	$settlement_officemail 		= addslashes($_POST['settlement_officemail']);

	// SECTION ADDRESS
	$settlement_current_address = addslashes($_POST['settlement_current_address']);
	$settlement_curcountry 		= addslashes($_POST['settlement_curcountry']);
	$settlement_curprovince 	= addslashes($_POST['settlement_curprovince']);
	$settlement_curcity 		= addslashes($_POST['settlement_curcity']);
	$settlement_curdistrict 	= addslashes($_POST['settlement_curdistrict']);
	$settlement_currt			= addslashes($_POST['settlement_currt']);
	$settlement_currw			= addslashes($_POST['settlement_currw']);
	$settlement_curpostalcode	= addslashes($_POST['settlement_curpostalcode']);

		require_once '../../set{sys=system_function_authorization}/workflow_formula.php';

		$sql_00 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM view_employee WHERE emp_id = '$settlement_emp_id'"));

		!empty($sql_00['first_name'] != $settlement_first_name) ? $sql_001 = $settlement_first_name : $sql_001  = "---";
		!empty($sql_00['middle_name'] != $settlement_middle_name) ? $sql_002 = $settlement_middle_name : $sql_002  = "---";
		!empty($sql_00['last_name'] != $settlement_last_name) ? $sql_003 = $settlement_last_name : $sql_003 = "---";
		!empty($sql_00['Full_Name'] != $full_name) ? $sql_004 = $full_name : $sql_004 = "---";
		!empty($sql_00['birthplace'] != $settlement_place_ofbirth) ? $sql_005 = $settlement_place_ofbirth : $sql_005 = "---";
		!empty($sql_00['birthdate'] != $settlement_birth_date) ? $sql_006 = $settlement_birth_date : $sql_006 = "---";
		!empty($sql_00['idnumber'] != $settlement_id_number) ? $sql_007 = $settlement_id_number : $sql_007 = "---";
		!empty($sql_00['familyidnumber'] != $settlement_idfamily) ? $sql_008 = $settlement_idfamily : $sql_008 = "---";
		!empty($sql_00['gender'] != $settlement_gender) ? $sql_009 = $settlement_gender : $sql_009 = "---";
		!empty($sql_00['religion'] != $settlement_religion) ? $sql_010 = $settlement_religion : $sql_010 = "---";
		!empty($sql_00['maritalstatus'] != $settlement_maritalstatus) ? $sql_011 = $settlement_maritalstatus : $sql_011 = "---";
		!empty($sql_00['nationality'] != $settlement_nationality) ? $sql_012 = $settlement_nationality : $sql_012 = "---";
		!empty($sql_00['phone'] != $settlement_mobilephone) ? $sql_013 = $settlement_mobilephone : $sql_013 = "---";
		!empty($sql_00['email_personal'] != $settlement_personalmail) ? $sql_014 = $settlement_personalmail : $sql_014 = "---";
		!empty($sql_00['email'] != $settlement_officemail) ? $sql_015 = $settlement_officemail : $sql_015 = "---";

		$sql_0 			= "INSERT INTO mgtools_view_employee 
										(
											`request_no`, 
											`emp_id`, 
											`first_name`, 
											`middle_name`, 
											`last_name`, 
											`Full_Name`, 
											`birthplace`, 
											`birthdate`, 
											`idnumber`, 
											`familyidnumber`, 
											`gender`, 
											`religion`, 
											`maritalstatus`, 
											`nationality`, 
											`phone`, 
											`email_personal`, 
											`email`	

										) VALUES 
											(
												'$SFnumbercon',
												'$settlement_emp_id',
												'$sql_001',
												'$sql_002',
												'$sql_003',
												'$sql_004',
												'$sql_005',
												'$sql_006',
												'$sql_007',
												'$sql_008',
												'$sql_009',
												'$sql_010',
												'$sql_011',
												'$sql_012',
												'$sql_013',
												'$sql_014',
												'$sql_015'
											)";

		$sql_01 = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM teodempaddress WHERE emp_id = '$settlement_emp_id' AND addresstype_code = 'A'"));

		!empty($sql_01['address'] != $settlement_current_address ) ? $sql_004 = $settlement_current_address  : $sql_004 = "---";
		!empty($sql_01['rt'] != $settlement_currt ) ? $sql_005 = $settlement_currt  : $sql_005 = "---";
		!empty($sql_01['rw'] != $settlement_currw ) ? $sql_006 = $settlement_currw  : $sql_006 = "---";
		!empty($sql_01['district'] != $settlement_curdistrict ) ? $sql_008 = $settlement_curdistrict  : $sql_008 = "---";
		!empty($sql_01['city_id'] != $settlement_curcity ) ? $sql_009 = $settlement_curcity  : $sql_009 = "---";
		!empty($sql_01['state_id'] != $settlement_curprovince ) ? $sql_010 = $settlement_curprovince  : $sql_010 = "---";
		!empty($sql_01['country_id'] != $settlement_curcountry ) ? $sql_011 = $settlement_curcountry  : $sql_011 = "---";
		!empty($sql_01['zipcode'] != $settlement_curpostalcode) ? $sql_012 = $settlement_curpostalcode : $sql_012 = "---";
		
		$sql_1 			= "INSERT INTO `mgtools_teodempaddress` 
									(
										`request_no`,
										`emp_id`, 
										`addresstype_code`, 
										`address`, 
										`rt`, 
										`rw`, 
										`district`, 
										`city_id`, 
										`state_id`, 
										`country_id`, 
										`zipcode`
									) 
										VALUES 
											(
												'$SFnumbercon',
												'$settlement_emp_id', 
												'A',
												'$sql_004', 
												'$sql_005', 
												'$sql_006', 
												'$sql_008', 
												'$sql_009', 
												'$sql_010', 
												'$sql_011', 
												'$sql_012'
											)";

	// condition start
	$query_0 = $connect->query($sql_0);
	$query_1 = $connect->query($sql_1);
	if (!$list_approval_process) {
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Wrong approval formula" ;
		
		$connect->query("DELETE FROM `mgtools_view_employee` WHERE `request_no` = '$SFnumbercon'");
		$connect->query("DELETE FROM `mgtools_teodempaddress` WHERE `request_no` = '$SFnumbercon'");
	
	} else if($query_0 == TRUE ) {						
		$validator['success'] = true;
		$validator['code'] = "success_message_update";
		$validator['messages'] = "Successfully saved data";		
	} else {
		$validator['success'] = true;
		$validator['code'] = "failed_message_update";
		$validator['messages'] = "Failed saved data";		
	}
	// condition ends
	// close the database connection
	$connect->close();
	echo json_encode($validator);
		
}