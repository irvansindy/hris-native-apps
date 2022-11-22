<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$temp = "../../../asset/emp_photos/";
	if (isset($_FILES['inp_foto_1']['tmp_name'])) {
		$fileupload     = $_FILES['inp_foto_1']['tmp_name'];
		$ImageName      = $_FILES['inp_foto_1']['name'];
		$acak           = rand(111111111111111111, 999999999999999999);
		$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt       = str_replace('.','',$ImageExt);
		$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
		$NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);
		$inp_foto_1     = $temp . $NewImageName;
		move_uploaded_file($fileupload, $temp.$NewImageName);
	} else {
		$inp_foto_1 = "../../../asset/emp_photos/no-image.png";
	}

	// $period		= $_POST['period'].'_'.$_POST['nip'].$flag;
	// $nip		= $_POST['nip'];
	// $org		= $_POST['org'];
	// $emp		= $_POST['emp'];
	// $grp		= $_POST['grp'];
	// $jobstatus	= $_POST['jobstatus'];
	// $amount 	= str_replace("." , "", $_POST['amount']);
	// $note		= $_POST['note'];
	$inp_overtime_code		= strtoupper($_POST['inp_overtime_code']);
	$inp_overtime_minimum 	= strtoupper($_POST['inp_overtime_minimum']);
	$inp_ovtcalctype 		= strtoupper($_POST['inp_ovtcalctype']);
	$inp_otrounding 		= strtoupper($_POST['inp_otrounding']);
	$inp_otroundlimit 		= strtoupper($_POST['inp_otroundlimit']);
	$inp_otachieved 		= strtoupper($_POST['inp_otachieved']);
	$lbl_inp_otdeucted 		= strtoupper($_POST['lbl_inp_otdeucted']);
	$inp_emp_no 			= strtoupper($_POST['inp_emp_no']);
	$inp_token 			= strtoupper($_POST['inp_token']);
	$lang 				= strtoupper($_POST['lang']);


	$sql_0 = "INSERT INTO `hrmovertime` 
			(
				`overtime_code`, 
				`overtime_minimum`, 
				`daytype`, 
				`otdeducthour`, 
				`otdeductmultiplier`, 
				`premiumpay`, 
				`nsd`, 
				`created_date`, 
				`created_by`, 
				`modified_date`, 
				`modified_by`, 
				`otrounding`, 
				`otroundlimit`, 
				`ovtcalctype`, 
				`splitovtdaytypeph`
			) VALUES 
				(
					'$inp_overtime_code', 
					'$inp_overtime_minimum', 
					NULL, 
					NULL, 
					NULL, 
					NULL, 
					NULL, 
					'$SFdatetime', 
					'13-0299', 
					'$SFdatetime', 
					'13-0299', 
					'$inp_otrounding', 
					'$inp_otroundlimit', 
					'$inp_ovtcalctype', 
					'$lbl_inp_otdeucted'
				)";
	
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
										'$inp_overtime_code',
										'$iemg_plus', 
										'$FactorHour', 
										'$FactorValue', 
										'$SFdatetime', 
										'$inp_emp_no', 
										'$SFdatetime', 
										'$inp_emp_no'
									)
							");
	 
		}
	}
	
	for($iemg=0;$iemg<count($_POST['OTtypeother']);$iemg++){
		$iemg_plus 		= $iemg+1;
		$OTtypeother		= $_POST['OTtypeother'][$iemg];
		$OTminutes		= $_POST['OTminutes'][$iemg];
		$OTmeal 		= $_POST['OTmeal'][$iemg];
		$OTminOTtranspor 	= $_POST['OTtransport'][$iemg];
		
		if($OTtypeother!==''){
	 
		$sql_2 = mysqli_query($connect, "INSERT INTO `hrmovertimeother` 
									(
										`overtime_code`, 
										`factor_no`, 
										`type_code`, 
										`step`, 
										`created_date`, 
										`created_by`, 
										`modified_date`, 
										`modified_by`
									) 
										VALUES
											(
												'$inp_overtime_code', 
												'$iemg_plus', 
												'$OTtypeother', 
												'$OTminutes', 
												'$SFdatetime', 
												'$inp_emp_no', 
												'$SFdatetime', 
												'$inp_emp_no'
											)");
	 
		}
	}

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