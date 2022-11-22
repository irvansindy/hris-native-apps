<?php 
require_once '../../../application/config.php';

$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	//========================POST VALUE FORM========================//
	$inp_emp_no		   = $_POST['inp_emp_no'];
	$inp_emp_id             = $_POST['inp_emp_id'];
	$inp_shiftgroupcode     = $_POST['inp_shiftgroupcode'];
	$inp_shiftstartdate     = $_POST['inp_shiftstartdate'];
	//========================POST VALUE FORM========================//

	$delete_attendance    = "DELETE a FROM hrdattendance a
								LEFT JOIN hrdattstatusdetail b ON a.attend_id=b.attend_id 
									WHERE 
										a.dateforcheck >= '$inp_shiftstartdate' AND 
										a.emp_id = '$inp_emp_id' AND
										b.attend_id IS NULL";

	$delete_attendance_process = mysqli_query($connect, $delete_attendance);

	$sql_0 = "INSERT INTO hrmempshiftgroup 
                        (
                            `emp_id`, 
                            `shiftgroupcode`, 
                            `startshiftdate`,
				  			`company_id`,
                            `created_by`, 
                            `created_date`, 
                            `modified_by`,
                            `modified_date`
                        ) VALUES (
                              	'$inp_emp_id', 
                              	'$inp_shiftgroupcode', 
                              	'$inp_shiftstartdate',
				  				'13576',
                              	'$inp_emp_no', 
                              	'$SFdatetime', 
				  				'$inp_emp_no',
                              	'$SFdatetime'
                        )";
	
	$sql_1 = "INSERT INTO hrdattendance 
					(
						emp_id,
						shiftgroupcode,
						attend_id,
						dateforcheck,
						created_by,
						modified_by,
						created_date,
						modified_date,
						`check`,
						shiftdaily_code,
						attend_date,
						shiftstarttime,
						shiftendtime,
						daytype
					)

					SELECT 
						'$inp_emp_id',
						a.shiftgroupcode,
						CONCAT('ATD-$inp_emp_id', DATE_FORMAT(a.dateshift, '%d%m%Y')) as attend_id,
						a.dateshift,
						'$inp_emp_no',
						'$inp_emp_no',
						'$SFdatetime',
						'$SFdatetime',
						'1',
						a.shiftdailycode,
						CONCAT(a.dateshift,' 00:00:00') AS attend_date,
						a.datestartshift,
						a.dateendshift,
						a.daytype

					FROM HRMGROUPSHEDULEDETAIL a
					LEFT JOIN hrmttamshiftdaily b on a.shiftdailycode=b.shiftdailycode
					WHERE a.shiftgroupcode = '$inp_shiftgroupcode' AND
					a.dateshift >= '$inp_shiftstartdate'
					GROUP BY a.dateshift
					ORDER BY a.dateshift ASC
					
					ON DUPLICATE KEY UPDATE 
					
					`emp_id` = '$inp_emp_id'";

	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {				
		$query_1 = $connect->query($sql_1);

		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data" ;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed process data" ;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}