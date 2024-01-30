<?php
include '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

$years                  = date("Y");
$years_numbering        = date("y");
$flag                   = date("his");
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumber_1             = date("Ymd");

$SFCareernumbercon      = 'CTL' . $SFnumber;

//if form is submitted
if ($_POST) {

	$validator             = array('success' => false, 'messages' => array());

	$employee_id           = addslashes($_POST['inp_emp_id']);
	$inp_first_name        = addslashes($_POST['inp_first_name']);
	$inp_middle_name       = addslashes($_POST['inp_middle_name']);
	$inp_last_name         = addslashes($_POST['inp_last_name']);
	$inp_gender            = $_POST['inp_gender'];
	$inp_email             = $_POST['inp_email'];
	$inp_email_personal    = $_POST['inp_email_personal'];
	$inp_phone             = $_POST['inp_phone'];
	$inp_birthplace        = $_POST['inp_birthplace'];
	$inp_birthdate         = $_POST['inp_birthdate'];
	$inp_maritalstatus     = $_POST['inp_maritalstatus'];
	$inp_address           = addslashes($_POST['inp_address']);
	$inp_city_id           = $_POST['inp_city_id'];
	$inp_zipcode           = $_POST['inp_zipcode'];
	$inp_employ_code       = $_POST['inp_employ_code'];
	$inp_grade_code        = $_POST['inp_grade_code'];
	$inp_cost_code         = $_POST['inp_cost_code'];
	$inp_position_id       = $_POST['inp_position_id'];
	$inp_worklocation_code = $_POST['inp_worklocation_code'];
	$inp_shiftgroup_code   = $_POST['inp_shiftgroup_code'];
	$inp_joindate          = $_POST['inp_joindate'];
	$inp_religion          = $_POST['inp_religion'];
	$inp_identity_no       = $_POST['inp_identity_no'];
	$inp_sel_customfield4  = $_POST['inp_sel_customfield4'];
	$inp_sel_ptkp  		   = $_POST['inp_sel_ptkp'];
	$inp_pin               = $_POST['inp_pin'];
	$inp_mobile_attendance = $_POST['inp_mobile_attendance'];

	//bank.info
	$inp_account_name      = $_POST['inp_account_name'];
	$inp_bank_name         = $_POST['inp_bank_name'];
	$inp_branch            = $_POST['inp_branch'];
	$inp_account_number    = $_POST['inp_account_number'];
	$inp_zipcode           = $_POST['inp_zipcode'];

	$full_name             = addslashes($_POST['inp_full_name']);
	$inp_emp_no            = $_POST['inp_emp_no'];

	//=================GET OTHER COMPONENT.DBSTRCON==================//
	$dbsetting             = mysqli_fetch_array(mysqli_query($connect, "SELECT var2 FROM db_config_str WHERE var1 = 'EMP.DEFAULT.ACCMENU'"));
	$dbsetting_var2        = addslashes($dbsetting['var2']);
	//=================GET OTHER COMPONENT.DBSTRCON==================//

	//OBJECT ORIENTED STYLE
	$mth           = "SELECT
						SUBSTRING(DATE_FORMAT('$inp_joindate', '%m'),1,1) AS fo,
						SUBSTRING(DATE_FORMAT('$inp_joindate', '%m'),2,2) AS lo";
	$result_mth    = $connect->query($mth);
	$row           = $result_mth->fetch_array(MYSQLI_ASSOC);
	$month1        = $row["fo"];
	$month2        = $row["lo"];
	//OBJECT ORIENTED STYLE

	

	//OBJECT ORIENTED STYLE
	$query          = "SELECT
							code_pattern, 
							seq_number+1 AS last_no,
							CASE 
								WHEN seq_number+1 < 10 THEN CONCAT('000' , seq_number+1)
								WHEN seq_number+1 >= 10 AND seq_number+1 < 100 THEN CONCAT('00' , seq_number+1)
								WHEN seq_number+1 >= 100 AND seq_number+1 < 1000 THEN CONCAT('0' , seq_number+1)
							END AS new_sequence
						FROM tclmdocnumber WHERE code_type   = 'EMP_NO'";
	$result         = $connect->query($query);
	$row            = $result->fetch_array(MYSQLI_ASSOC);
	$arr_0_0        = $row["code_pattern"];
	$arr_0_1        = $row["new_sequence"];
	$arr_0_2        = $row["last_no"];
	$var1           = array("xxxx", "yy", "[", "]" , "m1" , "m2");
	$var2           = array($arr_0_1, $years_numbering, "", "" , $month1 , $month2);
	$employee_no    = str_replace($var1, $var2, $arr_0_0);
	// print_r($employee_no);
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query1 		= "SELECT
							code_pattern,
							seq_number+1 AS last_no,
							CASE 
								WHEN seq_number+1 < 10 THEN CONCAT('000' , seq_number+1)
								WHEN seq_number+1 >= 10 AND seq_number+1 < 100 THEN CONCAT('00' , seq_number+1)
								WHEN seq_number+1 >= 100 AND seq_number+1 < 1000 THEN CONCAT('0' , seq_number+1)
								WHEN seq_number+1 >= 1000 AND seq_number+1 < 10000 THEN CONCAT('0' , seq_number+1)
								ELSE seq_number+1
							END AS new_sequence
						FROM tclmdocnumber WHERE code_type = 'EMP_ID'";
	$result1       = $connect->query($query1);
	$row1          = $result1->fetch_array(MYSQLI_ASSOC);
	$arr_1_0       = $row1["code_pattern"];
	$arr_1_1       = $row1["new_sequence"];
	$arr_1_2       = $row["last_no"];
	$var1          = array("xxxx", "yy", "[", "]" , "m1" , "m2");
	$var2          = array($arr_1_1, $years_numbering, "", "" , $month1 , $month2);
	$employee_id   = str_replace($var1, $var2, $arr_1_0);
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query2    = "SELECT
						MAX(view_employee.user_id)+1 as sequence_id
					FROM view_employee";
	$result2   = $connect->query($query2);
	$row1      = $result2->fetch_array(MYSQLI_ASSOC);
	$arr_2_0   = $row1["sequence_id"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query3    = "SELECT * FROM hrmorgstruc WHERE position_id = '$inp_position_id'";
	$result3   = $connect->query($query3);
	$row1      = $result3->fetch_array(MYSQLI_ASSOC);
	$arr_3_0   = $row1["company_id"];
	$arr_3_1   = $row1["pos_code"];
	$arr_3_2   = $row1["pos_name_en"];
	$arr_3_3   = $row1["parent_path"];
	$arr_3_4   = $row1["costcenter_code"];
	$arr_3_5   = $row1['jobstatuscode'];
	$arr_3_6   = $row1['parent_id'];

	//OBJECT ORIENTED STYLE
	$query4 = "SELECT
											*
										FROM teomjobgrade WHERE teomjobgrade.grade_code = '$inp_grade_code'";
	$result4   = $connect->query($query4);
	$row1      = $result4->fetch_array(MYSQLI_ASSOC);
	$arr_4_0   = $row1["gradecategory_code"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query5 = "SELECT
											*
										FROM view_employee WHERE view_employee.idnumber = '$inp_identity_no'";
	$result5   = $connect->query($query5);
	$row1      = $result5->fetch_array(MYSQLI_ASSOC);
	$arr_5_0   = $row1["idnumber"];
	$arr_5_1   = $row1["emp_no"];
	$arr_5_2   = $row1["Full_Name"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query6 = "SELECT A.shiftgroupname
										FROM hrmgroupsheduledetail A
										WHERE 
											A.shiftgroupcode='$inp_shiftgroup_code' AND 
											A.scheduleyear = (SELECT MAX(hrmgroupsheduledetail.scheduleyear) FROM hrmgroupsheduledetail WHERE A.shiftgroupcode='$inp_shiftgroup_code')
											LIMIT 1";
	$result6   = $connect->query($query6);
	$row1      = $result6->fetch_array(MYSQLI_ASSOC);
	$arr_6_0   = $row1["shiftgroupname"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query7 = "SELECT 
											teomworklocation.lat_lng
										FROM
										teomworklocation WHERE teomworklocation.worklocation_code = '$inp_worklocation_code'";
	$result7   = $connect->query($query7);
	$row1      = $result7->fetch_array(MYSQLI_ASSOC);
	$arr_7_0   = (explode(", ", $row1["lat_lng"]));
	$arr_7_0_1 = $arr_7_0[0];
	$arr_7_0_2 = $arr_7_0[1];
	//OBJECT ORIENTED STYLE

	if ($arr_5_0 != '') {
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Employees have been registered with the following details : $arr_5_2 [$arr_5_1]";

	} else {

		$temp = "../../../asset/emp_photos/";
		if (isset($_FILES['inp_fileToUpload']['tmp_name'])) {


			$fileupload    = $_FILES['inp_fileToUpload']['tmp_name'];
			$ImageName     = $_FILES['inp_fileToUpload']['name'];
			$acak          = rand(111111111111111111, 999999999999999999);
			$ImageExt      = substr($ImageName, strrpos($ImageName, '.'));
			$ImageExt      = str_replace('.', '', $ImageExt);
			$ImageName     = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
			$NewImageName  = str_replace(' ', '', $acak . '.' . $ImageExt);

			move_uploaded_file($fileupload, $temp . $NewImageName);

			if (move_uploaded_file($fileupload, $temp . $NewImageName)) {
				compressImage($_FILES['inp_fileToUpload']['tmp_name'], $temp . $NewImageName, 60);
			}

			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_0 = "INSERT INTO `view_employee` 
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
														`email_personal`,
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
														`religion`,
														`token`, 
														`nationality`, 
														`debug`,
														`idnumber`

													) 

														VALUES (
																	'$employee_id',
																	'$inp_first_name',
																	'$inp_middle_name',
																	'$inp_last_name',
																	'$full_name',
																	'$inp_gender',
																	'$arr_2_0',
																	'$inp_sel_customfield4',
																	'0',
																	'1',
																	'1',
																	'$employee_no',
																	'$inp_email',
																	'$inp_email_personal',
																	'$NewImageName',
																	'$inp_phone',
																	'$inp_birthplace',
																	'$inp_birthdate',
																	'$inp_maritalstatus',
																	'$inp_address',
																	'$inp_city_id',
																	'0',
																	'0',
																	'$inp_zipcode',
																	'$arr_3_0',
																	'$employee_no',
																	'$inp_joindate',
																	'0',
																	'0',
																	'$inp_employ_code',
																	'$inp_grade_code',
																	'$inp_employ_code',
																	'$inp_cost_code',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'$arr_3_1',
																	'$arr_3_6',
																	'$arr_3_2',
																	'$arr_3_2',
																	'$arr_3_2',
																	'$arr_3_2',
																	'I',
																	'0',
																	'$arr_3_3',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'0',
																	'$inp_grade_code',
																	'$arr_4_0',
																	'$inp_worklocation_code',
																	'$inp_religion',
																	'0',
																	'WNI',
																	'$employee_id',
																	'$inp_identity_no'
																)";
			//PASSED@2023-07-19
			//PASSED@2023-07-19


			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$add_password = addslashes('$2y$10$J5szzn9EZTHRy6YJgdlUWeClckG3qZP65wil3SKlENo.qYoijIRDS');
			$sql_1 = "REPLACE INTO `users` 
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
																	`longlatitude`,
																	`pin`,
																	`att_type`,
																	`timesheet`,
																	`timesheet_type`
																) 
																VALUES 
																	(
																			'$employee_id',
																			'$inp_first_name $inp_middle_name $inp_last_name', 
																			'$employee_no', 
																			'$add_password', 
																			'pc.index{tsc=information}', 
																			'4', 
																			'1', 
																			'0', 
																			'Passive', 
																			'1', 
																			'$NewImageName', 
																			'$inp_cost_code', 
																			'1', 
																			'$arr_7_0_1', 
																			'$arr_7_0_2',
																			'$inp_pin',
																			'$inp_mobile_attendance',
																			'Sales',
																			'Others'
																	)";
			//PASSED@2023-07-19
			//PASSED@2023-07-19


			//PASSED@2023-07-19
			//PASSED@2023-07-19
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
																		'$employee_id',
																		a.shiftgroupcode,
																		CONCAT('ATD-$employee_id', DATE_FORMAT(a.dateshift, '%d%m%Y')) as attend_id,
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
																		`emp_id` = '$employee_id'";
			//PASSED@2023-07-19
			//PASSED@2023-07-19


			//PASSED@2023-07-19
			//PASSED@2023-07-19
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
																	'$employee_no', 
																	'$inp_shiftgroup_code', 
																	'$inp_joindate 00:00:00', 
																	'$username', 
																	'$SFdatetime', 
																	'$username', 
																	'$SFdatetime')";
			//PASSED@2023-07-19
			//PASSED@2023-07-19


			
			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_4 = "REPLACE INTO `hrmempbank` 
															(
																`emp_id`, 
																`name_inbank`, 
																`bank`, 
																`cabang`, 
																`rekening`, 
																`flag`, 
																`created_by`, 
																`created_date`, 
																`modified_by`, 
																`modified_date`
															) 
																VALUES (
																	'$employee_id', 
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
			//PASSED@2023-07-19
			//PASSED@2023-07-19

			
			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_6 = "REPLACE INTO `mgtools_teodempcustomfield` (
																`emp_id`,
																`customfield4`, 
																`customfield5`) 
															VALUES (
																	'$employee_id', 
																	'$inp_sel_customfield4', 
																	'$inp_sel_ptkp')";
			//PASSED@2023-07-19
			//PASSED@2023-07-19

			
			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_7 = "INSERT IGNORE INTO users_menu_access
														SELECT
															A.emp_no,
															B.menu_id,
															'0',
															'$arr_3_0'
														FROM view_employee A
														LEFT JOIN hrmmenu B ON B.menu_id <> '99'
														WHERE A.emp_no = '$employee_no' AND B.menu_id IN ('1','113','115','2','24','4','43','5', '549', '7','8', '9')";


			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_8 = "UPDATE hrmorgstruc SET
								emp_no 			= '$employee_no',
								org_status		= ''
							WHERE position_id 	= '$inp_position_id'";
			//PASSED@2023-07-19
			//PASSED@2023-07-19

			
			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_11 = "REPLACE INTO `hrmemploymenthistory` 
								(
									`history_no`, 
									`emp_id`, 
									`careertransition_code`, 
									`careertranstype`, 
									`effectivedt`, 
									`enddt`, 
									`company_id`, 
									`emp_no`, 
									`position_code`, 
									`employmentstatus_code`, 
									`grade_code`, 
									`costcenter_code`, 
									`worklocation_code`, 
									`jobstatus_code`, 
									`taxlocation_code`, 
									`resign_type`, 
									`resign_reason`, 
									`employment_enddate`, 
									`spv_parent`, 
									`mgr_parent`, 
									`created_date`, 
									`created_by`, 
									`modified_date`, 
									`modified_by`, 
									`remark`, 
									`vacant`, 
									`replacementSPV`, 
									`replacementMGR`, 
									`reset_lengthofservice`, 
									`currency_code`, 
									`salary`, 
									`salary_effectivedt`, 
									`salary_update`, 
									`user_status`, 
									`attachment`
								) 
									VALUES 
										(
											'$SFCareernumbercon',
											'$employee_id',
											'JOIN',
											'NEW',
											'$inp_joindate',
											'0000-00-00 00:00:00',
											'$arr_3_0',
											'$employee_no',
											'$arr_3_1',
											'$inp_employ_code',
											'$inp_grade_code',
											'$arr_3_4',
											'$inp_worklocation_code',
											'$arr_3_5',
											'',
											'',
											'',
											'0000-00-00 00:00:00',
											'',
											'',
											'$SFdatetime',
											'$username',
											'$SFdatetime',
											'$username',
											'',
											'',
											'',
											'',
											'0',
											'',
											'',
											'0000-00-00 00:00:00',
											'',
											'0',
											''
										)";
			//PASSED@2023-07-19
			//PASSED@2023-07-19


			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_12 = "UPDATE tclmdocnumber SET seq_number = '$arr_0_2'
								WHERE code_type = 'EMP_NO'";
			//PASSED@2023-07-19
			//PASSED@2023-07-19


			//PASSED@2023-07-19
			//PASSED@2023-07-19
			$sql_13 = "UPDATE tclmdocnumber SET seq_number = '$arr_1_2'
								WHERE code_type = 'EMP_ID'";
			//PASSED@2023-07-19
			//PASSED@2023-07-19


			$query_0   = $connect->query($sql_0);
			$query_1   = $connect->query($sql_1);
			$query_2   = $connect->query($sql_2);
			$query_3   = $connect->query($sql_3);
			$query_4   = $connect->query($sql_4);
			$query_6   = $connect->query($sql_6);
			$query_11  = $connect->query($sql_11);
			$query_12  = $connect->query($sql_12);
			$query_13  = $connect->query($sql_13);

			if ($query_0 == TRUE && $query_1 == TRUE) {

				$query_7 = $connect->query($sql_7);
				$query_8 = $connect->query($sql_8);

				$validator['success'] = true;
				$validator['code'] = "success_message";
				$validator['messages'] = "Successfully saved submit data employee";
			} else {

				mysqli_query($connect, "DELETE FROM view_employee WHERE emp_id = '$employee_id'");
				mysqli_query($connect, "DELETE FROM users WHERE username = '$employee_no'");

				$validator['success'] = false;
				$validator['code'] = "failed_message";
				$validator['messages'] = "Failed saved data";
			}
			// condition ends

			// close the database connection

		}
	}
	$connect->close();
	echo json_encode($validator);
}