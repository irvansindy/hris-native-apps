<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_overtime_code		= strtoupper($_POST['sel_overtime_code']);
	$sel_overtime_minimum 	= strtoupper($_POST['sel_overtime_minimum']);
	$sel_ovtcalctype 		= strtoupper($_POST['sel_ovtcalctype']);
	$sel_otrounding 		= strtoupper($_POST['sel_otrounding']);
	$sel_otroundlimit 		= strtoupper($_POST['sel_otroundlimit']);
	$sel_otachieved 		= strtoupper($_POST['sel_otachieved']);
	$lbl_sel_otdeucted 		= strtoupper($_POST['lbl_sel_otdeucted']);
	$sel_emp_no 			= strtoupper($_POST['sel_emp_no']);
	$sel_token 			= strtoupper($_POST['sel_token']);


	$sql = "UPDATE hrmovertime SET 
					`overtime_minimum`	= '$sel_overtime_minimum',
					`created_date`	= '$SFdatetime', 
					`created_by`		= '$sel_emp_no', 
					`modified_date`	= '$SFdatetime', 
					`modified_by`		= '$sel_emp_no', 
					`otrounding`		= '$sel_otrounding', 
					`otroundlimit`	= '$sel_otroundlimit', 
					`ovtcalctype`		= '$sel_ovtcalctype', 
					`otdeducthour`	= '$lbl_sel_otdeucted'
					
				WHERE overtime_code 	= '$sel_overtime_code'";
				
	$delete = mysqli_query($connect, "DELETE FROM `hrmovertimefactor` WHERE `overtime_code` = '$sel_overtime_code'");
	for($iemg=0;$iemg<count($_POST['FactorHour']);$iemg++){
		$iemg_plus = $iemg+1;
		$FactorHour	= $_POST['FactorHour'][$iemg];
		$FactorValue 	= $_POST['FactorValue'][$iemg];
		$OTminutes 	= $_POST['OTminutes'][$iemg];
		$OTmeal 	= $_POST['OTmeal'][$iemg];
		$OTtransport 	= $_POST['OTtransport'][$iemg];
		
		if($FactorHour!==''){
	
		$sql_1 = mysqli_query($connect, "INSERT INTO `hrmovertimefactor` 
								(
									`overtime_code`, 
									`factor_no`, 
									`step`, 
									`value`, 
									`created_date`, 
									`created_by`, 
									`modified_date`, 
									`modified_by`
								) VALUES 
									(
										'$sel_overtime_code',
										'$iemg_plus',
										'$FactorHour',
										'$FactorValue',
										'$SFdatetime',
										'$sel_emp_no ',
										'$SFdatetime',
										'$sel_emp_no '
									)
							");
	
		}
	}

	$delete = mysqli_query($connect, "DELETE FROM `hrmovertimeother` WHERE `overtime_code` = '$sel_overtime_code'");
	for($iemg=0;$iemg<count($_POST['OTtypeother']);$iemg++){
		$iemg_plus 		= $iemg+1;
		$OTtypeother		= $_POST['OTtypeother'][$iemg];
		$OTminutes		= $_POST['OTminutes'][$iemg];
		$OTvalue 		= $_POST['OTvalue'][$iemg];
		
		if($OTtypeother!==''){
	 
		$sql_2 = mysqli_query($connect, "INSERT INTO `hrmovertimeother` 
									(
										`overtime_code`, 
										`factor_no`, 
										`type_code`, 
										`step`, 
										`value`,
										`created_date`, 
										`created_by`, 
										`modified_date`, 
										`modified_by`
									) 
										VALUES
											(
												'$sel_overtime_code', 
												'$iemg_plus', 
												'$OTtypeother', 
												'$OTminutes', 
												'$OTvalue',
												'$SFdatetime', 
												'$sel_emp_no ', 
												'$SFdatetime', 
												'$sel_emp_no '
											)");
	 
		}
	}


	// condition start
	$query = $connect->query($sql);

	if($query == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
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