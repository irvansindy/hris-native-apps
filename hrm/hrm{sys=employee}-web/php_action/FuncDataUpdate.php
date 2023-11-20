<?php
require_once '../../../application/config.php';
$years = date("Y");
$flag = date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_id = addslashes($_POST['sel_emp_id']);
	$sel_first_name = addslashes($_POST['sel_first_name']);
	$sel_middle_name = addslashes($_POST['sel_middle_name']);
	$sel_last_name = addslashes($_POST['sel_last_name']);
	$sel_gender = addslashes($_POST['sel_gender']);
	$sel_taxno = addslashes($_POST['sel_taxno']);
	$sel_email = addslashes($_POST['sel_email']);
	$sel_phone = addslashes($_POST['sel_phone']);
	$sel_birthplace = addslashes($_POST['sel_birthplace']);
	$sel_birthdate = addslashes($_POST['sel_birthdate']);
	$sel_maritalstatus = addslashes($_POST['sel_maritalstatus']);
	$sel_address = addslashes($_POST['sel_address']);
	$sel_city_id = addslashes($_POST['sel_city_id']);
	$sel_zipcode = addslashes($_POST['sel_zipcode']);
	$sel_employ_code = addslashes($_POST['sel_employ_code']);
	$sel_grade_code = addslashes($_POST['sel_grade_code']);
	$sel_cost_code = addslashes($_POST['sel_cost_code']);

	$sel_position_id_ori = addslashes($_POST['sel_position_id']);
	$sel_position_id_arr = explode(" ", $sel_position_id_ori);
	$sel_position_id = addslashes($sel_position_id_arr[0]);

	$sel_worklocation_code = addslashes($_POST['sel_worklocation_code']);
	$sel_shiftgroup_code = addslashes($_POST['sel_shiftgroup_code']);
	$sel_joindate = addslashes($_POST['sel_joindate']);
	$sel_identity_no = addslashes($_POST['sel_identity_no']);
	//bank.info
	$sel_account_name = addslashes($_POST['sel_account_name']);
	$sel_bank_name = addslashes($_POST['sel_bank_name']);
	$sel_branch = addslashes($_POST['sel_branch']);
	$sel_account_number = addslashes($_POST['sel_account_number']);
	$sel_zipcode = addslashes($_POST['sel_zipcode']);
	//users.info
	$sel_latitude = addslashes($_POST['sel_latitude']);
	$sel_longitude = addslashes($_POST['sel_longitude']);
	$sel_pin = addslashes($_POST['sel_pin']);
	//customfield
	$sel_customfield4 = addslashes($_POST['sel_customfield4']);
	$sel_ptkp = addslashes($_POST['sel_ptkp']);

	$sel_bpjskes = addslashes($_POST['sel_bpjskes']);
	$sel_bpjsjkk = addslashes($_POST['sel_bpjsjkk']);
	$sel_bpjsjkm = addslashes($_POST['sel_bpjsjkm']);
	$sel_bpjsjht = addslashes($_POST['sel_bpjsjht']);
	$sel_bpjsjp = addslashes($_POST['sel_bpjsjp']);


	$full_name_ori = $sel_first_name . ' ' . $sel_middle_name . ' ' . $sel_last_name;
	$full_name = str_replace("  ", " ", "$full_name_ori");
	$sel_emp_no = $_POST['sel_emp_no'];

	//=================GET OTHER COMPONENT.DBSTRCON==================//
	$dbsetting = mysqli_fetch_array(mysqli_query($connect, "SELECT var2 FROM db_config_str WHERE var1 = 'EMP.DEFAULT.ACCMENU'"));
	$dbsetting_var2 = addslashes($dbsetting['var2']);
	//=================GET OTHER COMPONENT.DBSTRCON==================//

	//OBJECT ORIENTED STYLE
	$query = "SELECT * FROM view_employee WHERE emp_id = '$sel_emp_id'";
	$result = $connect->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$arr_0_a = $row["emp_no"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query = "SELECT * FROM hrmorgstruc WHERE position_id = '$sel_position_id'";
	$result = $connect->query($query);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$arr_0 = $row["costcenter_code"];
	$arr_1 = $row["position_id"];
	$arr_2 = $row["pos_code"];
	$arr_3 = $row["pos_name"];
	$arr_4 = $row["pos_name_en"];
	$arr_5 = $row["pos_name_id"];
	$arr_6 = $row["pos_name_my"];
	$arr_7 = $row["pos_name_th"];
	$arr_8 = $row["parent_id"];
	$arr_9 = addslashes($row["parent_id"]);
	//OBJECT ORIENTED STYLE

	$temp = "../../../asset/emp_photos/";

	$fileupload = $_FILES['sel_fileToUpload']['tmp_name'];
	$ImageName = $_FILES['sel_fileToUpload']['name'];
	$acak = rand(111111111111111111, 999999999999999999);
	$ImageExt = substr($ImageName, strrpos($ImageName, '.'));
	$ImageExt = str_replace('.', '', $ImageExt);
	$ImageName = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	$NewImageName = str_replace(' ', '', $acak . '.' . $ImageExt);

	if (move_uploaded_file($fileupload, $temp . $NewImageName)) {

		$sql_0 = "UPDATE view_employee SET 
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
													`empcompany_status` = '$sel_employ_code', 
													`grade_code` = '$sel_grade_code', 
													`employ_code` = '$sel_employ_code', 
													`cost_code` = '$sel_cost_code', 
													`position_id` = '$arr_1',  
													`idnumber` = '$sel_identity_no',
													`worklocation_code` = '$sel_worklocation_code', 
													`debug` = 'update',
													`pos_code` = '$arr_2',
													`parent_id` = '$arr_8',
													`pos_name_en` = '$arr_4',
													`pos_name_id` = '$arr_5',
													`pos_name_my` = '$arr_6',
													`pos_name_th` = '$arr_7',
													`parent_path` = '$arr_9'

													WHERE emp_id = '$sel_emp_id'";

		$sql_1 = "UPDATE `users` SET 
													`avatar` 		= '$NewImageName',
													`latitude` 		= '$sel_latitude',
													`longlatitude` 	= '$sel_longitude',
													`pin` 			= '$sel_pin'
													WHERE username 	= '$sel_emp_no'";

		$sql_2 = "REPLACE INTO hrmempbank 
										(
											`emp_id`,
											`name_inbank`,
											`bank`,
											`cabang`,
											`rekening`,
											`modified_by`,
											`modified_date`
										) VALUES 
											(
												'$sel_emp_id',
												'$sel_account_name',
												'$sel_bank_name',
												'$sel_branch',
												'$sel_account_number',
												'$sel_emp_no',
												'$SFdatetime'
											)";

		$sql_3 = "REPLACE INTO `mgtools_teodempcustomfield` 
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
											'$sel_emp_id',
											'$sel_customfield4', 
											'$sel_ptkp', 
											'$sel_emp_no',
											'$SFdatetime',
											'$sel_emp_no',
											'$SFdatetime'
											)";

		$sql_4 = "REPLACE INTO `pay_insurance`
								(
									`emp_id`,
									`component_id`,
									`value`,
									`company_id`,
									`created_by`,
									`created_date`,
									`modified_by`,
									`modified_date`
								)
								SELECT
									'$sel_emp_id',
									'BPJSKES',
									'$sel_bpjskes',
									'a.company_id',
									'$sel_emp_no',
									'$SFdatetime',
									'$sel_emp_no',
									'$SFdatetime'

								FROM view_employee a
								WHERE a.emp_id = '$sel_emp_id'

								UNION ALL

								SELECT
									'$sel_emp_id',
									'BPJSKES_ALLOWANCE',
									'$sel_bpjskes',
									'a.company_id',
									'$sel_emp_no',
									'$SFdatetime',
									'$sel_emp_no',
									'$SFdatetime'

								FROM view_employee a
								WHERE a.emp_id = '$sel_emp_id'";

		$sql_5 = "REPLACE INTO `pay_insurance`
								(
									`emp_id`,
									`component_id`,
									`value`,
									`company_id`,
									`created_by`,
									`created_date`,
									`modified_by`,
									`modified_date`
								)
								SELECT
									'$sel_emp_id',
									'BPJSJKK',
									'$sel_bpjsjkk',
									'a.company_id',
									'$sel_emp_no',
									'$SFdatetime',
									'$sel_emp_no',
									'$SFdatetime'

								FROM view_employee a
								WHERE a.emp_id = '$sel_emp_id'
								

								UNION ALL

								SELECT
									'$sel_emp_id',
									'BPJSJKK_ALLOWANCE',
									'$sel_bpjsjkk',
									'a.company_id',
									'$sel_emp_no',
									'$SFdatetime',
									'$sel_emp_no',
									'$SFdatetime'

								FROM view_employee a
								WHERE a.emp_id = '$sel_emp_id'";


		$sql_6 = "REPLACE INTO `pay_insurance`
										(
											`emp_id`,
											`component_id`,
											`value`,
											`company_id`,
											`created_by`,
											`created_date`,
											`modified_by`,
											`modified_date`
										)
										SELECT
											'$sel_emp_id',
											'BPJSJKM',
											'$sel_bpjsjkm',
											'a.company_id',
											'$sel_emp_no',
											'$SFdatetime',
											'$sel_emp_no',
											'$SFdatetime'

										FROM view_employee a
										WHERE a.emp_id = '$sel_emp_id'

										UNION ALL

										SELECT
											'$sel_emp_id',
											'BPJSJKM_ALLOWANCE',
											'$sel_bpjsjkm',
											'a.company_id',
											'$sel_emp_no',
											'$SFdatetime',
											'$sel_emp_no',
											'$SFdatetime'

										FROM view_employee a
										WHERE a.emp_id = '$sel_emp_id'";

		$sql_7 = "REPLACE INTO `pay_insurance`
										(
											`emp_id`,
											`component_id`,
											`value`,
											`company_id`,
											`created_by`,
											`created_date`,
											`modified_by`,
											`modified_date`
										)
										SELECT
											'$sel_emp_id',
											'BPJSJHT',
											'$sel_bpjsjht',
											'a.company_id',
											'$sel_emp_no',
											'$SFdatetime',
											'$sel_emp_no',
											'$SFdatetime'

										FROM view_employee a
										WHERE a.emp_id = '$sel_emp_id'

										UNION ALL

										SELECT
											'$sel_emp_id',
											'BPJSJHT_ALLOWANCE',
											'$sel_bpjsjht',
											'a.company_id',
											'$sel_emp_no',
											'$SFdatetime',
											'$sel_emp_no',
											'$SFdatetime'

										FROM view_employee a
										WHERE a.emp_id = '$sel_emp_id'";

		$sql_8 = "REPLACE INTO `pay_insurance`
								(
									`emp_id`,
									`component_id`,
									`value`,
									`company_id`,
									`created_by`,
									`created_date`,
									`modified_by`,
									`modified_date`
								)
								SELECT
									'$sel_emp_id',
									'BPJSJP',
									'$sel_bpjsjp',
									'a.company_id',
									'$sel_emp_no',
									'$SFdatetime',
									'$sel_emp_no',
									'$SFdatetime'

								FROM view_employee a
								WHERE a.emp_id = '$sel_emp_id'

								UNION ALL

								SELECT
									'$sel_emp_id',
									'BPJSJP_ALLOWANCE',
									'$sel_bpjsjp',
									'a.company_id',
									'$sel_emp_no',
									'$SFdatetime',
									'$sel_emp_no',
									'$SFdatetime'

								FROM view_employee a
								WHERE a.emp_id = '$sel_emp_id'";

		$sql_9 = "UPDATE hrmorgstruc 
									SET 
										org_status 	= 'Vacant',
										emp_no		= ''
								WHERE emp_no		= '$arr_0_a'";

		$sql_10 = "UPDATE hrmorgstruc 
								SET 
									org_status 	= '',
									emp_no		= '$arr_0_a'
								WHERE position_id		= '$sel_position_id'";

		// condition start
		$query_0 = $connect->query($sql_0);
		$query_1 = $connect->query($sql_1);
		$query_2 = $connect->query($sql_2);
		$query_3 = $connect->query($sql_3);
		$query_4 = $connect->query($sql_4);
		$query_5 = $connect->query($sql_5);
		$query_6 = $connect->query($sql_6);
		$query_7 = $connect->query($sql_7);
		$query_8 = $connect->query($sql_8);
		$query_9 = $connect->query($sql_9);
		$query_10 = $connect->query($sql_10);

		if ($query_7 == TRUE) {
			$query_8 = $connect->query($sql_8);
		}

		if ($query_3 == TRUE) {
			$validator['success'] = true;
			$validator['code'] = "success_message_update";
			$validator['messages'] = "Successfully saved data $sql_7";
		} else {
			$validator['success'] = false;
			$validator['code'] = "false_message_update";
			$validator['messages'] = "Failed to saved data";
		}
		// condition ends

		// close the database connection
		$connect->close();
		echo json_encode($validator);
	} else {

		$sql_0 = "UPDATE view_employee SET 
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
													`empcompany_status` = '$sel_employ_code', 
													`grade_code` = '$sel_grade_code', 
													`employ_code` = '$sel_employ_code', 
													`cost_code` = '$sel_cost_code', 
													-- `position_id` = '$sel_position_id',  
													`worklocation_code` = '$sel_worklocation_code', 
													`debug` = 'update',
													`idnumber` = '$sel_identity_no',
													`position_id` = '$arr_1',  
													`worklocation_code` = '$sel_worklocation_code', 
													`debug` = 'update',
													`pos_code` = '$arr_2',
													`parent_id` = '$arr_8',
													`pos_name_en` = '$arr_4',
													`pos_name_id` = '$arr_5',
													`pos_name_my` = '$arr_6',
													`pos_name_th` = '$arr_7',
													`parent_path` = '$arr_9'
													WHERE emp_id = '$sel_emp_id'";

		$sql_1 = "UPDATE users SET 
													`latitude` = '$sel_latitude',
													`longlatitude` = '$sel_longitude',
													`pin` = '$sel_pin'
													WHERE username = '$sel_emp_no'";

		$sql_2 = "REPLACE INTO hrmempbank 
								(
									`emp_id`,
									`name_inbank`,
									`bank`,
									`cabang`,
									`rekening`,
									`modified_by`,
									`modified_date`
								) VALUES 
									(
										'$sel_emp_id',
										'$sel_account_name',
										'$sel_bank_name',
										'$sel_branch',
										'$sel_account_number',
										'$sel_emp_no',
										'$SFdatetime'
									)";

		$sql_3 = "REPLACE INTO `mgtools_teodempcustomfield` 
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
											'$sel_emp_id',
											'$sel_customfield4', 
											'$sel_ptkp', 
											'$sel_emp_no',
											'$SFdatetime',
											'$sel_emp_no',
											'$SFdatetime'
											)";


		$sql_4 = "REPLACE INTO `pay_insurance`
									(
										`emp_id`,
										`component_id`,
										`value`,
										`company_id`,
										`created_by`,
										`created_date`,
										`modified_by`,
										`modified_date`
									)
									SELECT
										'$sel_emp_id',
										'BPJSKES',
										'$sel_bpjskes',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'

									UNION ALL

									SELECT
										'$sel_emp_id',
										'BPJSKES_ALLOWANCE',
										'$sel_bpjskes',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'";

		$sql_5 = "REPLACE INTO `pay_insurance`
									(
										`emp_id`,
										`component_id`,
										`value`,
										`company_id`,
										`created_by`,
										`created_date`,
										`modified_by`,
										`modified_date`
									)
									SELECT
										'$sel_emp_id',
										'BPJSJKK',
										'$sel_bpjsjkk',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'


									UNION ALL

									SELECT
										'$sel_emp_id',
										'BPJSJKK_ALLOWANCE',
										'$sel_bpjsjkk',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'";


		$sql_6 = "REPLACE INTO `pay_insurance`
									(
										`emp_id`,
										`component_id`,
										`value`,
										`company_id`,
										`created_by`,
										`created_date`,
										`modified_by`,
										`modified_date`
									)
									SELECT
										'$sel_emp_id',
										'BPJSJKM',
										'$sel_bpjsjkm',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'

									UNION ALL

									SELECT
										'$sel_emp_id',
										'BPJSJKM_ALLOWANCE',
										'$sel_bpjsjkm',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'";

		$sql_7 = "REPLACE INTO `pay_insurance`
									(
										`emp_id`,
										`component_id`,
										`value`,
										`company_id`,
										`created_by`,
										`created_date`,
										`modified_by`,
										`modified_date`
									)
									SELECT
										'$sel_emp_id',
										'BPJSJHT',
										'$sel_bpjsjht',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'

									UNION ALL

									SELECT
										'$sel_emp_id',
										'BPJSJHT_ALLOWANCE',
										'$sel_bpjsjht',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'";

		$sql_8 = "REPLACE INTO `pay_insurance`
									(
										`emp_id`,
										`component_id`,
										`value`,
										`company_id`,
										`created_by`,
										`created_date`,
										`modified_by`,
										`modified_date`
									)
									SELECT
										'$sel_emp_id',
										'BPJSJP',
										'$sel_bpjsjp',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'

									UNION ALL

									SELECT
										'$sel_emp_id',
										'BPJSJP_ALLOWANCE',
										'$sel_bpjsjp',
										'a.company_id',
										'$sel_emp_no',
										'$SFdatetime',
										'$sel_emp_no',
										'$SFdatetime'

									FROM view_employee a
									WHERE a.emp_id = '$sel_emp_id'";

		$sql_9 = "UPDATE hrmorgstruc 
								SET 
									org_status 	= 'Vacant',
									emp_no		= ''
							WHERE emp_no		= '$arr_0_a'";

		$sql_10 = "UPDATE hrmorgstruc 
								SET 
									org_status 	= '',
									emp_no		= '$arr_0_a'
								WHERE position_id		= '$sel_position_id'";

		// condition start
		$query_0 = $connect->query($sql_0);
		$query_1 = $connect->query($sql_1);
		$query_2 = $connect->query($sql_2);
		$query_3 = $connect->query($sql_3);
		$query_4 = $connect->query($sql_4);
		$query_5 = $connect->query($sql_5);
		$query_6 = $connect->query($sql_6);
		$query_7 = $connect->query($sql_7);
		$query_8 = $connect->query($sql_8);
		$query_9 = $connect->query($sql_9);
		$query_10 = $connect->query($sql_10);

		if ($query_7 == TRUE) {
			$query_8 = $connect->query($sql_8);
		}

		if ($query_3 == TRUE) {
			$validator['success'] = true;
			$validator['code'] = "success_message";
			$validator['messages'] = "Successfully saved data";
		} else {
			$validator['success'] = false;
			$validator['code'] = "false_message_update";
			$validator['messages'] = "Failed to saved data";
		}
		// condition ends

		// close the database connection
		$connect->close();
		echo json_encode($validator);
	}
}
