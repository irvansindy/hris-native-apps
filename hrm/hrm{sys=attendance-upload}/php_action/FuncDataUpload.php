<style>
body {
       font-family: Arial;
       margin: 0;
}

.header {
       padding-top: 5px;
       padding-bottom: 5px;
       text-align: center;
       background: #3d8ad9;
       font-weight: 200px;
       color: white;
       height: 25px;
       border-bottom: 3px solid #FFF;
}
</style>

<body>
       <div class="header">
              <img src="../../../asset/dist/img/corporate_upload.png" width="120" />
       </div>
</body>

<?php require_once '../../../application/config.php'; ?>
<?php require_once '../../../application/session/session.php'; ?>
<?php
date_default_timezone_set('Asia/Bangkok');
?>

<?php
if (isset($_POST['submit'])) {
?>
<?php } ?>

<?php

require_once '../../../application/config.php';

require '../../../asset/gt_excel/excel_reader.php';


$inp = $_POST['inp_upload_type'];
$machine_code = $_POST['inp_machine_code'];

if(isset($_POST['submit'])){
	if($inp == 'SH') {
		echo '<div class="panel panel-default">
				<div class="panel-body">
					<fieldset class="col-md-12">
						<p style="font-size: 15px;font-weight: bold;">Trafic import data :</p>
						<div id="progress"
							style="width:100%;border:1px solid rgba(102,102,102,1); text-shadow: 4px 4px 4px #666666;">
						</div>
						<div id="info" style="margin-top: 16px;font-size: 13px;"></div>';

		echo '<table cellspacing="0" style="border-collapse:collapse; border:1px solid grey; width:264pt" >
			<tbody>
				<tr>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">No</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">EmpNo</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Attend_Date</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Attend_Time</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Attend_Status</span></span></span></td>
					<td style="background-color:#d9d9d9; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:black"><span style="font-family:Arial,sans-serif">Remark</span></span></span></td>
				</tr>
			</tbody>';
		
	 	$target = basename($_FILES['attendanceuploadprocess']['name']) ;
		move_uploaded_file($_FILES['attendanceuploadprocess']['tmp_name'], $target);
		$data = new Spreadsheet_Excel_Reader($_FILES['attendanceuploadprocess']['name'],false);

		$baris = $data->rowcount($sheet_index=0);

		for ($i=1; $i<=$baris; $i) {
			$ExcelHead1            = $data->val($i, 1);
			$ExcelHead2            = $data->val($i, 2);
			$ExcelHead3            = $data->val($i, 3);
			$ExcelHead4            = $data->val($i, 4);

		for ($i=2; $i<=$baris; $i++) {

			$find_replace         = array('.', ',');
			$new_replace          = array('.', '.');
			
			$DataRows1          	= $data->val($i, 1);
			$DataRows2           = date('Y-m-d', strtotime($data->val($i, 2)));
			$DataRows3           = strtoupper($data->val($i, 3));
			$DataRows4           = $data->val($i, 4);
			$DataRows5           = date('Ymd', strtotime($data->val($i, 2)));

			$ColumnHead1     	= 'attendanceid';
			$ColumnHead2     	= 'attend_date';
			$ColumnHead3     	= 'Attend_Time';
			$ColumnHead4     	= 'status';
			
			$TemplateHead1     	= 'EmpNo';
			$TemplateHead2     	= 'Attend_Date';
			$TemplateHead3     	= 'Attend_Time';
			$TemplateHead4     	= 'Attend_Status';

			if ($TemplateHead1 != $ExcelHead1){
				$DatabasesHead1 = 'unidentified';
			} else {
				$DatabasesHead1 = $ColumnHead1;
			}
				if ($TemplateHead2 != $ExcelHead2){
					$DatabasesHead2 = 'unidentified';
				} else {
					$DatabasesHead2 = $ColumnHead2;
				}
					if ($TemplateHead3 != $ExcelHead3){
						$DatabasesHead3 = 'unidentified';
					} else {
						$DatabasesHead3 = $ColumnHead3;
					}		  
						if ($TemplateHead4 != $ExcelHead4){
							$DatabasesHead4 = 'unidentified';
						} else {
							$DatabasesHead4 = $ColumnHead4;
						}				  		

			$barisreal = $baris-1;
			$k = $i-1;

			if ($TemplateHead1 != $ExcelHead1 || $TemplateHead2 != $ExcelHead2 || $TemplateHead3 != $ExcelHead3 || $TemplateHead4 != $ExcelHead4){
				echo "<tr><td colspan='5'>".$k." . Invalid Header"."</td></tr>";
			}

		
			
			
			$percent = intval($k/$barisreal * 100)."%";

			$minutess = intval($barisreal/$k);

			if($minutess >= 60) {
				$estimated = intval(($barisreal/$k) / 60) . " hours";
			} else if ($minutess < 60) {
				$estimated = intval(($barisreal/$k)) . " minutes";
			} else if ($minutess < 1) {
				$estimated = intval(($barisreal/$k)) . " second";
			}
		
			

			echo '<script language="javascript">
					document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.'; background: linear-gradient(229deg, #b9b9b980, #8c8b88);\">&nbsp;</div>";
					document.getElementById("info").innerHTML="'.$k.' from '.$barisreal.' record successfully upload ('.$percent.' Finish). \n Estimated time : '.$estimated.' \n";
				</script>';

		
			if (
				empty($DataRows1) or
				empty($DataRows2))
			{
			
			$query = "";
				
			} else {
				
				$var1 = array(
									":"
									);
							$var2 =array(
									""
									);
							$conversion = str_replace($var1, $var2, $DataRows3); 

							$date_formatter = mysqli_fetch_array(mysqli_query($connect, "SELECT 
																DATE_FORMAT('$DataRows2', '%d') as day_format,
																DATE_FORMAT('$DataRows2', '%m') as month_format,
																DATE_FORMAT('$DataRows2', '%Y') as year_format,
																TIME_FORMAT('$DataRows3', '%H') as hour_format,
																TIME_FORMAT('$DataRows3', '%i') as minutes_format,
																TIME_FORMAT('$DataRows3', '%s') as second_format"));

							$attenddata = $DataRows1.$DataRows5.$conversion.$k.$SFnumber;
							$attenddate = $DataRows2. " ".$date_formatter['hour_format'].":".$date_formatter['minutes_format'].":".$date_formatter['second_format'];

							$query = "INSERT INTO `hrdattendancetemp` 
												(
													`attenddata`, 
													`machine_code`, 
													`attendanceid`, 
													`attend_date`, 
													`hour`, 
													`minute`, 
													`second`, 
													`day`, 
													`month`, 
													`year`, 
													`status`, 
													`machineno`, 
													`uploadstatus`, 
													`created_by`, 
													`created_date`, 
													`modified_by`, 
													`modified_date`, 
													`company_id`
												) VALUES 
													(
														'$attenddata', 
														'$machine_code', 
														'$DataRows1', 
														'$attenddate', 
														'$date_formatter[hour_format]', 
														'$date_formatter[minutes_format]', 
														'$date_formatter[second_format]', 
														'$date_formatter[day_format]', 
														'$date_formatter[month_format]', 
														'$date_formatter[year_format]', 
														'$DataRows4', 
														'0', 
														'1', 
														'$username', 
														'$SFdatetime', 
														'$username', 
														'$SFdatetime', 
														'13576'
													)";
								
							$hasil 	= mysqli_query($connect, $query);							
								
							if($hasil != '0') {
								ECHO "<tr>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$k</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows1</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows2</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows3</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows4</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>Suceessfully upload attendance"."</td>
									</tr>";
												
							} else {
								ECHO "<tr>	
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$k</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows1</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows2</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows3</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows4</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>Some data failed process !!"."</td>
									</tr>";
							}

					flush(10);
				}

				

				$sql_hrdattendance = mysqli_query($connect, "SELECT 
												b.emp_no,
												a.attend_id,
												a.emp_id,
												a.shiftdaily_code,
												a.dateforcheck,
												'$DataRows4' as status_attendance,
												DATE(a.shiftstarttime) AS date_start,
												DATE(a.shiftstarttime) AS date_end
											FROM hrdattendance a 
											LEFT JOIN view_employee b on a.emp_id=b.emp_id
											WHERE
											b.emp_no = '$DataRows1' AND
											((CASE 
											WHEN '$DataRows4'+1 = 1 THEN DATE(a.shiftendtime) = '$DataRows2' 
											WHEN '$DataRows4'+1 > 1 THEN DATE(a.shiftstarttime) = '$DataRows2' END))");

							// echo "SELECT 
							// 					b.emp_no,
							// 					a.attend_id,
							// 					a.emp_id,
							// 					a.shiftdaily_code,
							// 					a.dateforcheck,
							// 					'$DataRows4' as status_attendance,
							// 					DATE(a.shiftstarttime) AS date_start,
							// 					DATE(a.shiftstarttime) AS date_end
							// 				FROM hrdattendance a 
							// 				LEFT JOIN view_employee b on a.emp_id=b.emp_id
							// 				WHERE
							// 				b.emp_no = '$DataRows1' AND
							// 				((CASE 
							// 				WHEN '$DataRows4'+1 = 1 THEN DATE(a.shiftendtime) = '$DataRows2' 
							// 				WHEN '$DataRows4'+1 > 1 THEN DATE(a.shiftstarttime) = '$DataRows2' END))"."<br><br>";

				//ECHO "SELECT emp_id,attend_id,emp_id,shiftdaily_code,shiftstarttime FROM hrdattendance WHERE emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$DataRows1') AND dateforcheck = '$DataRows2' AND shiftdaily_code = '$DataRows4'";
			
							while($r=mysqli_fetch_array($sql_hrdattendance)){

							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes
							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes
							$get_attendance_attend_id = $r['attend_id'];
							$get_attendance_emp_no = $r['emp_no'];
							$get_attendance_emp_id = $r['emp_id'];
							$get_attendance_status_attendance = $r['status_attendance'];
							$get_attendance_shiftdaily_code = $r['shiftdaily_code'];
							$get_attendance_dateforcheck = $r['dateforcheck'];
							$get_attendance_date_start = $r['date_start'];
							$get_attendance_date_end = $r['date_end'];
							$get_attendance_shiftstarttime = $r['get_attendance_shiftstarttime'];
							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes
							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes

							if($hasil){
								include "../../set{sys=system_function_authorization}/attendance_process.php";
								if($update_attendance) {
									include "../../set{sys=system_function_authorization}/attendance_formula.php";
								}

								// ECHO $get_Attendance ."<br><br>";
								// ECHO $update_attendance_print ."<br><br><hr>";
							}
				
				// mysqli_close($connect);
	
			}			
		}

		unlink($_FILES['attendanceuploadprocess']['name']);
		}
	
	}  else if($inp == 'RM') {

		echo '<div class="panel panel-default">
				<div class="panel-body">
					<fieldset class="col-md-12">
						<p style="font-size: 15px;font-weight: bold;">Data has been reproces :</p>';

		echo '<table cellspacing="0" style="border-collapse:collapse; border:1px solid grey; width:264pt" >
			<tbody>
				<tr>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Attendance id</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">EmpNo</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Attend_Date</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Attend_Time</span></span></span></td>
					<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Attend_Status</span></span></span></td>
					<td style="background-color:#d9d9d9; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:black"><span style="font-family:Arial,sans-serif">Remark</span></span></span></td>
				</tr>
			</tbody>';

		$startdate = $_POST['inp_startdate'];
		$enddate = $_POST['inp_enddate'];

		for($emp_hdlsel_empid=0;$emp_hdlsel_empid<count($_POST['sel_parameter']);$emp_hdlsel_empid++){
			$emp_hdlsel_empid_plus = $emp_hdlsel_empid+1;
			$sel_parameters	= $_POST['sel_parameter'][$emp_hdlsel_empid];

			// $sql_attendancetemp = mysqli_query($connect, "SELECT 	
			// 														*, 
			// 														DATE(a.attend_date) AS attend_date_process 
			// 														FROM hrdattendancetemp a 
			// 													WHERE a.attendanceid = '$sel_parameters' AND 
			// 													DATE(attend_date) BETWEEN '$startdate' AND '$enddate'");

			
			$sql_attendancetemp = mysqli_query($connect, "SELECT 	
																	*, 
																	DATE(a.attend_date) AS attend_date_process 
																	FROM hrdattendancetemp a
																	LEFT JOIN user_timeattendance b ON a.created_by=b.id
																WHERE b.emp_id = '$sel_parameters' AND 
																DATE(attend_date) BETWEEN '$startdate' AND '$enddate'");

		// 	echo "SELECT 	
		// 	*, 
		// 	DATE(a.attend_date) AS attend_date_process 
		// 	FROM hrdattendancetemp a
		// 	LEFT JOIN user_timeattendance b ON a.created_by=b.id
		// WHERE b.emp_id = '$sel_parameters' AND 
		// DATE(attend_date) BETWEEN '$startdate' AND '$enddate'";

			while($rSql_attendancetemp = mysqli_fetch_array($sql_attendancetemp)){
				//echo $rSql_attendancetemp['attend_date'] . " | " . $rSql_attendancetemp['status'] ."<br>";

				// $rSql_attendancetemp_attendanceid = $rSql_attendancetemp['attendanceid'];
				$rSql_attendancetemp_attendanceid = $rSql_attendancetemp['emp_id'];
				$rSql_attendancetemp_attend_date = $rSql_attendancetemp['attend_date_process'];
				$rSql_attendancetemp_status	= $rSql_attendancetemp['status'];
				$attenddate = $rSql_attendancetemp['attend_date'];

				$sql_hrdattendance = mysqli_fetch_array(mysqli_query($connect, "SELECT 
												b.emp_no,
												a.attend_id,
												a.emp_id,
												a.shiftdaily_code,
												a.dateforcheck,
												'$rSql_attendancetemp_status' as status_attendance,
												DATE(a.shiftstarttime) AS date_start,
												DATE(a.shiftstarttime) AS date_end
											FROM hrdattendance a 
											LEFT JOIN view_employee b on a.emp_id=b.emp_id
											WHERE
											b.emp_no = '$rSql_attendancetemp_attendanceid' AND
											((CASE 
											WHEN '$rSql_attendancetemp_status'+1 = 1 THEN DATE(a.shiftendtime) = '$rSql_attendancetemp_attend_date' 
											WHEN '$rSql_attendancetemp_status'+1 > 1 THEN DATE(a.shiftstarttime) = '$rSql_attendancetemp_attend_date' END))"));


				$get_attendance_attend_id 			= $sql_hrdattendance['attend_id'];
				$get_attendance_emp_no 				= $sql_hrdattendance['emp_no'];
				$get_attendance_emp_id 				= $sql_hrdattendance['emp_id'];
				$get_attendance_status_attendance 	= $sql_hrdattendance['status_attendance'];
				$get_attendance_shiftdaily_code 	= $sql_hrdattendance['shiftdaily_code'];
				$get_attendance_dateforcheck 		= $sql_hrdattendance['dateforcheck'];
				$get_attendance_date_start 			= $sql_hrdattendance['date_start'];
				$get_attendance_date_end 			= $sql_hrdattendance['date_end'];
				$get_attendance_shiftstarttime 		= $sql_hrdattendance['get_attendance_shiftstarttime'];

				include "../../set{sys=system_function_authorization}/attendance_process.php";

				if($update_attendance) {
					include "../../set{sys=system_function_authorization}/attendance_formula.php";
				}

				// echo $get_RecordedTime . "<br>";

				echo "<tr>
						<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>".$get_attendance_attend_id."</td>
						<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>".$get_attendance_emp_no."</td>
						<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>".$rSql_attendancetemp_attend_date."</td>
						<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>".$attenddate."</td>
						<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>".$rSql_attendancetemp_status."</td>
						<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>Successfully reprocess attendance</td>
					</tr>";

				
			}
		}
	}
} 
?>
</table>