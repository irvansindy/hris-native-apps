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
<div class='panel panel-default'>
       <div class='panel-body'>
              <fieldset class='col-md-12'>
                     <p style="font-size: 15px;font-weight: bold;">Trafic import data :</p>
                     <div id="progress"
                            style="width:100%;border:1px solid rgba(102,102,102,1); text-shadow: 4px 4px 4px #666666;">
                     </div>
                     <div id="info" style="margin-top: 16px;font-size: 13px;"></div>
                     <?php
}
?>




<table cellspacing="0" style="border-collapse:collapse; border:1px solid grey; width:264pt" >
	<tbody>
		<tr>
			<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">No</span></span></span></td>
			<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">EmpNo</span></span></span></td>
			<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">Date</span></span></span></td>
			<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">ShiftCode</span></span></span></td>
			<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">OldShiftCode</span></span></span></td>
			<td style="background-color:#002060; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:#bfbfbf"><span style="font-family:Arial,sans-serif">AttdetailCode</span></span></span></td>
			<td style="background-color:#d9d9d9; height:12.75pt; text-align:center; vertical-align:bottom; white-space:nowrap;padding: 10px;"><span style="font-size:10pt;padding: 10px;"><span style="color:black"><span style="font-family:Arial,sans-serif">Remark</span></span></span></td>
		</tr>
	</tbody>


                            <?php

require_once '../../../application/config.php';

require '../../../asset/gt_excel/excel_reader.php';


$inp = $_POST['inp_upload_type'];

if(isset($_POST['submit'])){
	if($inp == 'SH') {
	 	$target = basename($_FILES['filepegawaiall']['name']) ;
		move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
		$data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);

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

			$ColumnHead1     	= 'EmpNo';
			$ColumnHead2     	= 'Date';
			$ColumnHead3     	= 'ShiftCode';
			$ColumnHead4     	= 'OldShiftCode';
			
			$TemplateHead1     	= 'EmpNo';
			$TemplateHead2     	= 'Date';
			$TemplateHead3     	= 'ShiftCode';
			$TemplateHead4     	= 'OldShiftCode';

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
					document.getElementById("info").innerHTML="'.$k.' from '.$barisreal.' record successfully upload ('.$percent.' Finish). \n /n Estimated time : '.$estimated.' \n";
				</script>';

		
			if (
				empty($DataRows1) or
				empty($DataRows2))
			{
			
			$query = "INSERT INTO tclcdreqappsetting_failed
							(
								$DatabasesHead1,
								$DatabasesHead2,
								$DatabasesHead3,
								$DatabasesHead4
							)
								VALUES
									(
										'$DataRows1',
										'$DataRows2',
										'$DataRows3',
										'$DataRows4'
									)";
				
			} else {

				$sql_hrdattendance = mysqli_query($connect, "SELECT emp_id,attend_id,emp_id,shiftdaily_code,shiftstarttime FROM hrdattendance WHERE emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$DataRows1') AND dateforcheck = '$DataRows2' AND shiftdaily_code = '$DataRows4'");

				//ECHO "SELECT emp_id,attend_id,emp_id,shiftdaily_code,shiftstarttime FROM hrdattendance WHERE emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$DataRows1') AND dateforcheck = '$DataRows2' AND shiftdaily_code = '$DataRows4'";
			
							while($r=mysqli_fetch_array($sql_hrdattendance)){

							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes
							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes
							$get_attendance_attend_id = $r['attend_id'];
							$get_attendance_emp_id = $r['emp_id'];
							$get_attendance_shiftstarttime = $r['get_attendance_shiftstarttime'];
							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes
							// required_data_for_process_attendance_from_attendance_formula variable like $get_attendance_emp_id etc cannot changes

							$sql_shiftschedule = mysqli_fetch_array(mysqli_query($connect, "SELECT 
																	CONCAT('$DataRows2', TIME_FORMAT(starttime, ' %H:%i:%s')) AS starttime, 
																	CASE 
																	WHEN hrmttamshiftdaily.shiftdailycode  LIKE '%3%' THEN CONCAT(DATE_ADD('$DataRows2', INTERVAL 1 DAY), TIME_FORMAT(endtime, ' %H:%i:%s'))
																	ELSE CONCAT('$DataRows2', TIME_FORMAT(endtime, ' %H:%i:%s'))
																	END AS endtime,
																	daytype
																	FROM hrmttamshiftdaily WHERE shiftdailycode = '$DataRows3'"));

							if(!empty($sql_shiftschedule['starttime'])) {
								$query = "INSERT INTO `hrdlogttadattendance`
											(
												`attend_id`,
												`emp_id`,
												`shiftdaily_code_old`,
												`shiftstarttime_old`,
												`shiftdaily_code_new`,
												`shiftstarttime_new`,
												`company_id`,
												`modified_date`,
												`modified_by`,
												`action_status`
											)
												VALUES
													(
														'$r[attend_id]',
														'$r[emp_id]',
														'$r[shiftdaily_code]',
														'$r[shiftstarttime]',
														'$DataRows3',
														'$sql_shiftschedule[starttime]',
														'13576',
														'$SFdatetime',
														'$username',
														'UPDATE')";

								$hasil 	= mysqli_query($connect, $query);

								$query_s = "UPDATE `hrdattendance` SET
												`shiftdaily_code` 	= '$DataRows3',
												`shiftstarttime`	= '$sql_shiftschedule[starttime]',
												`shiftendtime`	= '$sql_shiftschedule[endtime]',
												`daytype`		= '$sql_shiftschedule[daytype]',
												`modified_date`	= '$SFdatetime'
												WHERE `attend_id` = '$r[attend_id]'";
								
								$hasil_s 	= mysqli_query($connect, $query_s);

								if($hasil_s){
									include "../../set{sys=system_function_authorization}/attendance_formula.php";
								}
							} else {
								
								$query = "INSERT INTO `hrdlogttadattendance`
											(
												`attend_id`,
												`emp_id`,
												`shiftdaily_code_old`,
												`shiftstarttime_old`,
												`shiftdaily_code_new`,
												`shiftstarttime_new`,
												`company_id`,
												`modified_date`,
												`modified_by`,
												`action_status`
											)
												VALUES
													(
														'$r[attend_id]',
														'$r[emp_id]',
														'$r[shiftdaily_code]',
														'$r[shiftstarttime]',
														'$DataRows3',
														'$sql_shiftschedule[starttime]',
														'13576',
														'$SFdatetime',
														'$username',
														'UPDATE')";

								$hasil 	= mysqli_query($connect, $query);

								$sql_shiftschedule_default = $DataRows2 . " 00:00:00";

								$query_s = "UPDATE `hrdattendance` SET
												`shiftdaily_code` 	= '$DataRows3',
												`shiftstarttime`	= '$sql_shiftschedule_default',
												`shiftendtime`	= '$sql_shiftschedule_default',
												`daytype`		= '$sql_shiftschedule[daytype]',
												`modified_date`	= '$SFdatetime'
												WHERE `attend_id` = '$r[attend_id]'";
								
								$hasil_s 	= mysqli_query($connect, $query_s);

								if($hasil_s){
									include "../../set{sys=AttendanceFormula}/attendance_formula.php";
								}
							}

							$generate_attendance = mysqli_fetch_array(mysqli_query($connect, "SELECT GROUP_CONCAT(attend_code) as attdetaillist
															FROM hrdattstatusdetail
															WHERE attend_id = '$get_attendance_attend_id'
															GROUP BY attend_id"));
							
								
							if($hasil != '0') {
								ECHO "<tr>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$k</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows1</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows2</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows3</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$DataRows4</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>$generate_attendance[attdetaillist]</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey;white-space: nowrap;padding: 5px;'>Suceessfully upload shift"."</td>
									</tr>";
								// ECHO $att_formula."<br>";
								// ECHO $delete_process;
												
							} else {
								ECHO "<tr>	
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$k</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows1</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows2</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows3</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows4</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$generate_attendance[attdetaillist]</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>Some data failed process !!"."</td>
									</tr>";
							}

							flush();
				}
						if(mysqli_num_rows($sql_hrdattendance) == '0') {
								ECHO "<tr>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$k</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows1</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows2</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows3</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$DataRows4</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>$generate_attendance[attdetaillist]</td>
										<td style='font-size: 12px; border-collapse:collapse; border:1px solid grey; background: #ea1e1e;color: white;white-space: nowrap;padding: 5px;'>Wrong old shift"."</td>
									</tr>";

								}		
			}			
		}

		unlink($_FILES['filepegawaiall']['name']);
		}
	}
		else {
		echo "gaada proses";
	}
} 
?>
                     </table>