<?php 
require_once '../../../application/config.php';
$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_id			= addslashes($_POST['inp_emp_id']);
	$inp_first_name		= addslashes($_POST['inp_first_name']);
	$inp_middle_name		= addslashes($_POST['inp_middle_name']);
	$inp_last_name		= addslashes($_POST['inp_last_name']);
	$inp_gender			= $_POST['inp_gender'];
	$inp_taxno			= $_POST['inp_taxno'];
	$inp_email			= $_POST['inp_email'];
	$inp_phone			= $_POST['inp_phone'];
	$inp_birthplace		= $_POST['inp_birthplace'];
	$inp_birthdate		= $_POST['inp_birthdate'];
	$inp_maritalstatus		= $_POST['inp_maritalstatus'];
	$inp_address			= addslashes($_POST['inp_address']);
	$inp_city_id			= $_POST['inp_city_id'];
	$inp_zipcode			= $_POST['inp_zipcode'];
	$inp_employ_code		= $_POST['inp_employ_code'];
	$inp_grade_code		= $_POST['inp_grade_code'];
	$inp_cost_code		= $_POST['inp_cost_code'];
	$inp_position_id		= $_POST['inp_position_id'];
	$inp_worklocation_code	= $_POST['inp_worklocation_code'];
	$inp_shiftgroup_code		= $_POST['inp_shiftgroup_code'];
	$inp_joindate			= $_POST['inp_joindate'];

	//bank.info
	$inp_account_name       	= $_POST['inp_account_name'];
	$inp_bank_name          	= $_POST['inp_bank_name'];
	$inp_branch             	= $_POST['inp_branch'];
	$inp_account_number     	= $_POST['inp_account_number'];
	$inp_zipcode            	= $_POST['inp_zipcode'];

	//customfield
	$sel_customfield4       = $_POST['sel_customfield4'];
	$sel_ptkp       		= $_POST['sel_ptkp'];

	$full_name			= $inp_first_name.' '.$inp_middle_name.' '.$inp_last_name;
	$inp_emp_no			= $_POST['inp_emp_no'];

	//=================GET OTHER COMPONENT.DBSTRCON==================//
	$dbsetting              	= mysqli_fetch_array(mysqli_query($connect, "SELECT var2 FROM db_config_str WHERE var1 = 'EMP.DEFAULT.ACCMENU'"));
	$dbsetting_var2         	= addslashes($dbsetting['var2']);
	//=================GET OTHER COMPONENT.DBSTRCON==================//

	$temp = "../../../asset/emp_photos/";
	if (isset($_FILES['inp_fileToUpload']['tmp_name'])) {
	

		$fileupload     = $_FILES['inp_fileToUpload']['tmp_name'];
		$ImageName      = $_FILES['inp_fileToUpload']['name'];
		$acak           = rand(111111111111111111, 999999999999999999);
		$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt       = str_replace('.','',$ImageExt);
		$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
		$NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);

		move_uploaded_file($fileupload, $temp.$NewImageName);

		if(move_uploaded_file($fileupload, $temp.$NewImageName)){			  
	
				 compressImage($_FILES['inp_fileToUpload']['tmp_name'],$temp.$NewImageName,60);	 
		}	

		$inp_emp_id		= strtoupper($_POST['inp_emp_id']);

		$sql_0 			= "INSERT INTO `view_employee` 
												(
													`emp_id`, 
													`first_name`,
													`middle_name`,
													`last_name`,
													`Full_Name`,
													`gender`,
													`user_id`,
													`taxno`,
													`geocoord`, 
													`status`, 
													`req_status`, 
													`lastreqno`, 
													`email`, 
													`photo`, 
													`phone`, 
													`birthplace`, 
													`birthdate`, 
													`maritalstatus`, 
													`address`, 
													`city_id`, 
													`state_id`, 
													`country_id`, 
													`zipcode`, 
													`company_id`, 
													`emp_no`,
													`start_date`, 
													`end_date`, 
													`is_main`, 
													`empcompany_status`, 
													`grade_code`, 
													`employ_code`, 
													`cost_code`, 
													`spv_parent`, 
													`spv_pos`, 
													`spv_path`, 
													`spv_level`, 
													`mgr_parent`, 
													`mgr_pos`, 
													`mgr_path`, 
													`mgr_level`, 
													`position_id`, 
													`pos_code`, 
													`parent_id`, 
													`pos_name_en`, 
													`pos_name_id`, 
													`pos_name_my`, 
													`pos_name_th`, 
													`jobstatuscode`, 
													`pos_level`, 
													`parent_path`, 
													`pos_flag`, 
													`dept_id`, 
													`dorder`, 
													`jobtitle_code`, 
													`report_topos`, 
													`clevel`, 
													`corder`, 
													`changeflag`, 
													`report_postype`, 
													`dept_code`, 
													`grade_order`, 
													`grade_category`, 
													`worklocation_code`, 
													`token`, 
													`nationality`, 
													`debug`

												) 

													VALUES (
																'$inp_emp_id',
																'$inp_first_name',
																'$inp_middle_name',
																'$inp_last_name',
																'$full_name',
																'$inp_gender',
																'$flag',
																'$inp_taxno',
																'0',
																'1',
																'1',
																'$inp_emp_id',
																'$inp_email',
																'$NewImageName',
																'$inp_phone',
																'$inp_birthplace',
																'$inp_birthdate',
																'$inp_maritalstatus',
																'$inp_address',
																'$inp_city_id',
																'--21',
																'--22',
																'$inp_zipcode',
																'--24',
																'$inp_emp_id',
																'$inp_joindate',
																'--27',
																'--28',
																'$inp_employ_code',
																'$inp_grade_code',
																'$inp_employ_code',
																'$inp_cost_code',
																'--33',
																'--34',
																'--35',
																'--36',
																'--37',
																'--38',
																'--39',
																'--40',
																'$inp_position_id',
																'--42',
																'--43',
																'$inp_position_id',
																'--45',
																'--46',
																'--47',
																'--48',
																'--49',
																'--50',
																'--51',
																'--52',
																'--53',
																'--54',
																'--55',
																'--56',
																'--57',
																'--58',
																'--59',
																'--60',
																'--61',
																'--62',
																'$inp_worklocation_code',
																'--64',
																'--65',
																'$inp_emp_id'
															)";

	
		$add_password = addslashes('$2y$10$J5szzn9EZTHRy6YJgdlUWeClckG3qZP65wil3SKlENo.qYoijIRDS');
		// Default of Password : Hris9090
		$sql_1 = "INSERT INTO `users` 
                                                            (
                                                                `idu`,
                                                                `nama`, 
                                                                `username`, 
                                                                `password`, 
                                                                `hak_akses`, 
                                                                `function_authorized`, 
                                                                `access_group`, 
                                                                `access_employee`, 
                                                                `user_type`, 
                                                                `user_status`, 
                                                                `avatar`, 
                                                                `position`, 
                                                                `login`, 
                                                                `latitude`, 
                                                                `longlatitude`
                                                            ) 
                                                            VALUES 
                                                                (
                                                                        'UID$inp_emp_id',
                                                                        '$inp_first_name $inp_middle_name $inp_last_name', 
                                                                        '$inp_emp_id', 
                                                                        '$add_password', 
                                                                        'pc.index{tsc=information}', 
                                                                        '4', 
                                                                        '1', 
                                                                        '0', 
                                                                        'SuperAdmin', 
                                                                        '1', 
                                                                        '$NewImageName', 
                                                                        '$inp_cost_code', 
                                                                        '1', 
                                                                        '0', 
                                                                        '0'
                                                                )";

		$sql_2 = "INSERT INTO `hrdattendance` 
															(
																`emp_id`,
																`shiftgroupcode`,
																`attend_id`,
																`dateforcheck`,
																`created_by`,
																`modified_by`,
																`created_date`,
																`modified_date`,
																`check`,
																`shiftdaily_code`,
																`attend_date`,
																`shiftstarttime`,
																`shiftendtime`,
																`daytype`)

															SELECT 
																	'$inp_emp_id',
																	a.shiftgroupcode,
																	CONCAT('ATD-$inp_emp_id', DATE_FORMAT(a.dateshift, '%d%m%Y')) as attend_id,
																	a.dateshift,
																	'$username',
																	'$username',
																	'$SFdatetime',
																	'$SFdatetime',
																	'1',
																	a.shiftdailycode,
																	CONCAT(a.dateshift,' 00:00:00') AS attend_date,
																	a.datestartshift,
																	a.dateendshift,
																	b.daytype

																FROM groupscheduledetail a
																LEFT JOIN hrmshiftdaily b on a.shiftdailycode=b.shiftdaily
																WHERE a.shiftgroupcode='$inp_shiftgroup_code' AND
																a.dateshift >= '$inp_joindate'
																ORDER BY a.dateshift ASC

																ON DUPLICATE KEY UPDATE 
																	`emp_id` = '$inp_emp_id'";

		$sql_3 = "INSERT INTO `hrmempshiftgroup` 
														(
																`emp_no`, 
																`shiftgroupcode`, 
																`startvaliddate`, 
																`created_by`, 
																`created_date`, 
																`modified_by`, 
																`modified_date`) 
													VALUES (
																'$inp_emp_id', 
																'$inp_shiftgroup_code', 
																'$inp_joindate 00:00:00', 
																'$username', 
																'$SFdatetime', 
																'$username', 
																'$SFdatetime')";

			
		$sql_4 = "INSERT INTO `hrmempbank` 
														(
															`emp_no`, 
															`name_inbank`, 
															`bank`, 
															`cabang`, 
															`rekening`, 
															`flag`, 
															`created_by`, 
															`created_date`, 
															`modified_by`, 
															`modified_date`) 
														VALUES (
																'$inp_emp_id', 
																'$inp_account_name', 
																'$inp_bank_name', 
																'$inp_branch', 
																'$inp_account_number', 
																'insert',
																'$username', 
																'$SFdatetime', 
																'$username', 
																'$SFdatetime'
															)";

		// $sql_5 = "INSERT INTO `users_menu_access` (
		// 													`emp_no`, 
		// 													`formula`, 
		// 													`is_acccessgroup_use`) 
		// 												VALUES (
		// 														'$inp_emp_id', 
		// 														'$dbsetting_var2', 
		// 														'DefaultAccess')";

		$sql_6 = "INSERT INTO `teodempcustomfield` (
															`emp_id`,
															`customfield1`, 
															`customfield2`) 
														VALUES (
																'$inp_emp_id', 
																'$inp_idnumber', 
																'$inp_religion')";
		
		$sql_7 = "INSERT IGNORE INTO users_menu_access
													SELECT
														A.emp_no,
														B.menu_id,
														'0',
														'15136'
													FROM view_employee A
													LEFT JOIN hrmmenu B ON B.menu_id <> '99'
													WHERE A.emp_no = '$inp_emp_id' AND B.menu_id IN ('1','113','115','2','24','4','43','5', '549', '7','8', '9')";

		$sql_8 			= "INSERT INTO `mgtools_teodempcustomfield` 
										(
											`emp_id`,
											`customfield4`, 
											`customfield5`,
											`created_by`,
											`created_date`,
											`modified_by`,
											`modified_date`
										) 
										VALUES (
												'$inp_emp_id',
												'$sel_customfield4', 
												'$sel_ptkp', 
												'$username',
												'$SFdatetime',
												'$username',
												'$SFdatetime'
												)";


													
	
	// condition start
	$query_0 = $connect->query($sql_0);
	$query_1 = $connect->query($sql_1);
	$query_2 = $connect->query($sql_2);
	$query_3 = $connect->query($sql_3); 
	$query_4 = $connect->query($sql_4);
	$query_6 = $connect->query($sql_6);
	$query_7 = $connect->query($sql_7); 
 

	if($query_0 == TRUE && $query_1 == TRUE ) {		

		$query_8 = $connect->query($sql_8); 

		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data";		
		
	} else {		
		mysqli_query($connect, "DELETE FROM view_employee WHERE emp_id = '$inp_emp_id'");
		mysqli_query($connect, "DELETE FROM users WHERE username = '$inp_emp_id'");
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data" . $sql_0;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
}