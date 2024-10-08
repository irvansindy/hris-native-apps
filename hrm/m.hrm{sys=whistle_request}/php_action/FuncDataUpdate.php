<?php 
require_once '../../../application/config.php';
$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_id				= addslashes($_POST['sel_emp_id']);
	$sel_first_name			= addslashes($_POST['sel_first_name']);
	$sel_middle_name		= addslashes($_POST['sel_middle_name']);
	$sel_last_name			= addslashes($_POST['sel_last_name']);
	$sel_gender				= $_POST['sel_gender'];
	$sel_taxno				= $_POST['sel_taxno'];
	$sel_email				= $_POST['sel_email'];
	$sel_phone				= $_POST['sel_phone'];
	$sel_birthplace			= $_POST['sel_birthplace'];
	$sel_birthdate			= $_POST['sel_birthdate'];
	$sel_maritalstatus		= $_POST['sel_maritalstatus'];
	$sel_address			= addslashes($_POST['sel_address']);
	$sel_city_id			= $_POST['sel_city_id'];
	$sel_zipcode			= $_POST['sel_zipcode'];
	$sel_employ_code		= $_POST['sel_employ_code'];
	$sel_grade_code			= $_POST['sel_grade_code'];
	$sel_cost_code			= $_POST['sel_cost_code'];
	$sel_position_id		= $_POST['sel_position_id'];
	$sel_worklocation_code	= $_POST['sel_worklocation_code'];
	$sel_shiftgroup_code	= $_POST['sel_shiftgroup_code'];
	$sel_joindate			= $_POST['sel_joindate'];

	//bank.info
	$sel_account_name       = $_POST['sel_account_name'];
	$sel_bank_name          = $_POST['sel_bank_name'];
	$sel_branch             = $_POST['sel_branch'];
	$sel_account_number     = $_POST['sel_account_number'];
	$sel_zipcode            = $_POST['sel_zipcode'];

	//user.info
	$sel_latitude			= $_POST['sel_latitude'];
    $sel_longitude			= $_POST['sel_longitude'];
    $sel_pin				= $_POST['sel_pin'];

	$full_name				= $sel_first_name.' '.$sel_middle_name.' '.$sel_last_name;
	$sel_emp_no				= $_POST['sel_emp_no'];

	//=================GET OTHER COMPONENT.DBSTRCON==================//
	$dbsetting              	= mysqli_fetch_array(mysqli_query($connect, "SELECT var2 FROM db_config_str WHERE var1 = 'EMP.DEFAULT.ACCMENU'"));
	$dbsetting_var2         	= addslashes($dbsetting['var2']);
	//=================GET OTHER COMPONENT.DBSTRCON==================//

	$temp = "../../../asset/emp_photos/";

		$fileupload     = $_FILES['sel_fileToUpload']['tmp_name'];
		$ImageName      = $_FILES['sel_fileToUpload']['name'];
		$acak           = rand(111111111111111111, 999999999999999999);
		$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt       = str_replace('.','',$ImageExt);
		$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
		$NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);

		if(move_uploaded_file($fileupload, $temp.$NewImageName)){
	
		$sql_0 			= "UPDATE view_employee SET 
													`first_name` = '$sel_first_name',
													`middle_name` = '$sel_middle_name',
													`last_name` = '$sel_last_name',
													`Full_Name` = '$full_name',
													`gender` = '$sel_gender',
													`user_id` = '$flag',
													`taxno` = '$sel_taxno',
													`geocoord` = '0',
													`status` = '1',
													`req_status` = '1', 
													`lastreqno` = '$sel_emp_id',
													`email` = '$sel_email', 
													`photo` = '$NewImageName', 
													`phone` =  '$sel_phone',
													`birthplace` =  '$sel_birthplace',
													`birthdate` = '$sel_birthdate', 
													`maritalstatus` = '$sel_maritalstatus', 
													`address` = '$sel_address', 
													`city_id` = '$sel_city_id', 
													`state_id` = '--21', 
													`country_id` = '--22', 
													`zipcode` = '$sel_zipcode', 
													`company_id` = '--24', 
													`emp_no` = '$sel_emp_id',
													`start_date` = '$sel_joindate', 
													`end_date` = '--27', 
													`is_main` = '--28', 
													`empcompany_status` = '$sel_employ_code', 
													`grade_code` = '$sel_grade_code', 
													`employ_code` = '$sel_employ_code', 
													`cost_code` = '$sel_cost_code', 
													`position_id` = '$sel_position_id',  
													`worklocation_code` = '$sel_worklocation_code', 
													`debug` = 'update'
													WHERE emp_id = '$sel_emp_id'";

		$sql_1 = "UPDATE `users` SET 
							`avatar` = '$NewImageName',
							`latitude` = '$sel_latitude',
                            `longlatitude` = '$sel_longitude',
							`pin` = '$sel_pin'
							WHERE username = '$sel_emp_id'";

		$sql_2 = "UPDATE `hrmempbank` SET
							`name_inbank` = '$sel_account_name',  
							`bank` = '$sel_bank_name', 
							`cabang` = '$sel_branch', 
							`rekening` = '$sel_account_number'
							WHERE emp_no = '$sel_emp_id'";
	
		// condition start
		$query_0 = $connect->query($sql_0);
		$query_1 = $connect->query($sql_1);
		$query_2 = $connect->query($sql_2);

		if($query_0 == TRUE ) {						
			$validator['success'] = true;
			$validator['code'] = "success_message_update";
			$validator['messages'] = "Successfully saved data";		
			
		}
		// condition ends

		// close the database connection
		$connect->close();
		echo json_encode($validator);

	} else {

		$sql_0 			= "UPDATE view_employee SET 
													`first_name` = '$sel_first_name',
													`middle_name` = '$sel_middle_name',
													`last_name` = '$sel_last_name',
													`Full_Name` = '$full_name',
													`gender` = '$sel_gender',
													`user_id` = '$flag',
													`taxno` = '$sel_taxno',
													`geocoord` = '0',
													`status` = '1',
													`req_status` = '1', 
													`lastreqno` = '$sel_emp_id',
													`email` = '$sel_email', 
													`phone` =  '$sel_phone',
													`birthplace` =  '$sel_birthplace',
													`birthdate` = '$sel_birthdate', 
													`maritalstatus` = '$sel_maritalstatus', 
													`address` = '$sel_address', 
													`city_id` = '$sel_city_id', 
													`state_id` = '--21', 
													`country_id` = '--22', 
													`zipcode` = '$sel_zipcode', 
													`company_id` = '--24', 
													`emp_no` = '$sel_emp_id',
													`start_date` = '$sel_joindate', 
													`end_date` = '--27', 
													`is_main` = '--28', 
													`empcompany_status` = '$sel_employ_code', 
													`grade_code` = '$sel_grade_code', 
													`employ_code` = '$sel_employ_code', 
													`cost_code` = '$sel_cost_code', 
													`position_id` = '$sel_position_id',  
													`worklocation_code` = '$sel_worklocation_code', 
													`debug` = 'update'
													WHERE emp_id = '$sel_emp_id'";

		$sql_1 = "UPDATE `users` SET 
							`latitude` = '$sel_latitude',
							`longlatitude` = '$sel_longitude',
							`pin` = '$sel_pin'
							WHERE username = '$sel_emp_id'";
		
		$sql_2 = "UPDATE `hrmempbank` SET
								`name_inbank` = '$sel_account_name',  
								`bank` = '$sel_bank_name', 
								`cabang` = '$sel_branch', 
								`rekening` = '$sel_account_number'
								WHERE emp_no = '$sel_emp_id'";

		// condition start
		$query_0 = $connect->query($sql_0);
		$query_1 = $connect->query($sql_1);
		$query_2 = $connect->query($sql_2);

		if($query_0 == TRUE ) {						
			$validator['success'] = true;
			$validator['code'] = "success_message_update";
			$validator['messages'] = "Successfully saved data";		
			
		}
		// condition ends

		// close the database connection
		$connect->close();
		echo json_encode($validator);
		
	}
}