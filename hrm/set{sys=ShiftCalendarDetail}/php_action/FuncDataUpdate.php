<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumbercon    		= 'LVR' . $SFnumber;
	$SFReqtype				= 'Attendance.leave';

	$sel_emp_no     		= $_POST['sel_emp_no'];
	$sel_years				= $_POST['sel_years'];
	$sel_shiftgroup			= $_POST['sel_shiftgroup'];
	$sel_day_counts			= $_POST['sel_day_counts'];
	$sel_shiftgroupname		= $_POST['sel_shiftgroupname'];
	$sel_shiftgroupid		= $_POST['sel_shiftgroupid'];

	$key = $sel_shiftgroup . '_' . $sel_years;

	$get_row = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM hrmtshiftregroup WHERE shiftregroup_id = '$sel_shiftgroupid' AND shiftgroup_id = '$sel_shiftgroup' AND shiftyear = '$sel_years'"));

	$lp = "SELECT * FROM hrmtshiftregroup WHERE shiftregroup_id = '$sel_shiftgroupid' AND shiftgroup_id = '$sel_shiftgroup' AND shiftyear = '$sel_years'";

	$sql_0 = "UPDATE `hrmtshiftregroup`
					SET
						`shiftregroup_name` = '$sel_shiftgroupname', 
						`day_start`			= '$sel_day_counts',
						`modified_date` 	= '$SFdatetime'
					WHERE `shiftregroup_id` = '$sel_shiftgroupid'";

	if($get_row < 1) {
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = " Calender doesnt Exist";

	} else {
		$query_0 = $connect->query($sql_0);
	
		if ($query_0 == TRUE) {	

			// DISET 400 UNTUK MENJAGA DAYOFYEAR LEBIH DARI 365 DAYS
			for ($x = 1; $x <= 400; $x++) {
				$sql_attendancetemp = mysqli_query($connect, "SELECT a.*
																	FROM 
																HRMTTARSHIFTGROUPDAILY a
																WHERE a.shiftgroupcode = '$sel_shiftgroup'");
				
				// JIKA PATTERN SUDAH ADA DI SHIFT GROUP MAKA
				if(mysqli_num_rows($sql_attendancetemp) > 0) {
					// $connect->query("DELETE FROM `debug`");
					
					$validator['success'] = false;
					$validator['code'] = "success_message";
					$validator['messages'] = "Successfully update calendar";

					$no = 1;
					while ($rSql_attendancetemp = mysqli_fetch_array($sql_attendancetemp)) {
						$COUNT = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM debug WHERE col2 = '$sel_shiftgroup'"));
				
						$get_hrmtshiftregroup = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmtshiftregroup WHERE shiftgroup_id = '$sel_shiftgroup' AND shiftyear = '$sel_years'"));
				
						$get_hrmtshiftregroup_r1 = $get_hrmtshiftregroup['shiftyear'];
						$get_hrmtshiftregroup_r2 = $get_hrmtshiftregroup['shiftregroup_id'];	
				
						if ($COUNT < 400) {
							$row = $COUNT + 1;
							$insert = mysqli_query($connect, "INSERT INTO debug (col1, col2, col3, col4) VALUES ('$row', '$sel_shiftgroup','$rSql_attendancetemp[shiftdailycode]' ,'$rSql_attendancetemp[premicheck]')");
						}
					}
					
				} else {
					$connect->query("DELETE FROM `hrmtshiftregroup` WHERE `shiftgroup_id` = '$sel_shiftgroup'");

					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = "Shift Group Code Have Not Pattern, Please go to setting > Time Attendance > Shift Group";
				}
			}

			$connect->query("DELETE FROM `hrmgroupsheduledetail` WHERE `shiftregroup_id` = '$sel_shiftgroup'");

			$sql_1 = "INSERT INTO hrmgroupsheduledetail 
									(
										groupscheduledetail_id,
										scheduleyear, 
										shiftregroup_id,
										shiftgroupcode,
										shiftgroupname,
										shiftdailycode, 
										daytype,
										dateshift,
										datestartshift,
										dateendshift,
										created_date,
										created_by,
										modified_date,
										modified_by,
										day_no,
										premicheck,
										company_id
									)
						SELECT
							b.col1,
							'$sel_years',
							a.col2,
							a.col2,
							'$sel_shiftgroupname',
							CASE 
								WHEN d.start_date IS NOT NULL THEN 'L01'
								WHEN e.start_date IS NOT NULL THEN 'L01'
								ELSE a.col3
							END AS shiftdailycode,
							CASE 
								WHEN d.start_date IS NOT NULL THEN CONCAT('PHOFF')
								WHEN e.start_date IS NOT NULL THEN CONCAT('PHOFF')
								ELSE c.daytype
							END AS daytype,
							b.col2 as dateshift,
							CASE 
								WHEN d.start_date IS NOT NULL THEN CONCAT(DATE(b.col2) , ' ' , TIME_FORMAT(c.starttime , '00:00:00'))
								WHEN e.start_date IS NOT NULL THEN CONCAT(DATE(b.col2) , ' ' , TIME_FORMAT(c.starttime , '00:00:00'))
								ELSE CONCAT(DATE(b.col2) , ' ' , TIME_FORMAT(c.starttime , '%H:%i:%s'))
							END AS datestartshift,
							CASE 
								WHEN d.start_date IS NOT NULL THEN CONCAT(DATE(b.col2) , ' ' , TIME_FORMAT(c.endtime , '00:00:00'))
								WHEN e.start_date IS NOT NULL THEN CONCAT(DATE(b.col2) , ' ' , TIME_FORMAT(c.endtime , '00:00:00'))
								WHEN (d.start_date IS NULL AND e.start_date IS NULL) AND DATEDIFF(c.endtime , c.starttime) > '0' THEN CONCAT(DATE_ADD(DATE(b.col2), INTERVAL 1 DAY) , ' ' , TIME_FORMAT(c.endtime , '%H:%i:%s')) 
								ELSE CONCAT(DATE(b.col2) , ' ' , TIME_FORMAT(c.endtime , '%H:%i:%s')) 
							END AS dateendshift,
							'$SFdatetime',
							'$username',
							'$SFdatetime',
							'$username',
							b.col1,
							a.col4,
							'13576'
						FROM debug a
						LEFT JOIN debugdate b ON a.col1-($sel_day_counts-1)=b.col1 
						LEFT JOIN hrmttamshiftdaily c ON a.col3=c.shiftdailycode
						LEFT JOIN hrmholiday d ON DATE(b.col2) BETWEEN DATE(d.start_date) AND DATE(d.end_date) AND d.is_recur = '0'
						LEFT JOIN hrmholiday e ON DATE_FORMAT(b.col2, '%m-%d') = DATE_FORMAT(e.start_date, '%m-%d') AND e.is_recur = '1'

						WHERE 
						a.col2 = '$sel_shiftgroup' AND
						a.col1 >= $sel_day_counts AND 
						b.col2 IS NOT NULL";
			
			$query_1 = $connect->query($sql_1);

			$connect->query("DELETE FROM `debug`");
			
		} else {
			$validator['success'] = false;
			$validator['code'] = "failed_message";
			$validator['messages'] = "Failed create request" . $sql;
		}
	}

	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
