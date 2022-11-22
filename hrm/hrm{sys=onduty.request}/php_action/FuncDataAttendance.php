<?php
require_once '../../../application/config.php';
$SFdate         		= date("Y-m-d");
$SFtime         		= date('h:i:s');
$SFdatetime     		= date("Y-m-d H:i:s");
$SFnumber       		= date("YmdHis");
$SFnumbercon    		= 'EMP' . $SFnumber;

//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$employee 					= $_POST['employee'];
	$inp_destination_code		= $_POST['inp_destination_code'];


	for ($iemg = 0; $iemg < count($_POST['update']); $iemg++) {
		$iemg_plus = $iemg + 1;
		$update	= $_POST['update'][$iemg];

		if ($update !== '') {

			$inp_attend_id              	= $_POST['inp_attend_id_' . $update];
            $emp_id_id                  	= $_POST['emp_id_' . $update];
            $sel_shiftdaily_code_id     	= $_POST['sel_shiftdaily_code_' . $update];
            $starttime_in_id            	= $_POST['starttime_in_' . $update];
            $endtime_in_id              	= $_POST['endtime_out_' . $update];
            $inp_hours_starttime        	= $_POST['inp_hours_starttime_' . $update];
            $inp_hours_endtime          	= $_POST['inp_hours_endtime_' . $update];
            $inp_remark                 	= $_POST['inp_remark_' . $update];
            $inp_dateforcheck           	= $_POST['inp_dateforcheck_' . $update];
            $before                     	= $_POST['before_' . $update];
            $break                      	= $_POST['break_' . $update];
            $after                      	= $_POST['after_' . $update];
            $inp_overtime_relative      	= $_POST['inp_overtime_relative_' . $update];
            $total_ot                   	= $before + $break + $after;

            $get_attendance_attend_id 		= $inp_attend_id;
            $get_attendance_emp_id 			= $emp_id_id;
            $get_attendance_dateforcheck 	= $inp_dateforcheck;
            $get_attendance_shiftstarttime 	= $starttime_in_id;
            $get_attendance_overtime_before = $before;
            $get_attendance_overtime_break 	= $break;
            $get_attendance_overtime_after 	= $after;
            $get_attendance_relative 		= $inp_overtime_relative;

			$delete = mysqli_query($connect, "DELETE FROM `hrdattstatusdetail` WHERE `attend_id` = '$inp_attend_id'");
			include "../../set{sys=system_function_authorization}/attendance_formula.php";

			$get_attendance_starttime = $starttime_in_id . " " . $inp_hours_starttime . ":00";
            if ($inp_hours_starttime 	== '00:00' || $inp_hours_starttime == '') {
                   $starttime 			= ",`starttime` = NULL";
                   $insertstarttime 	= "NULL";
            } else {
                   $starttime 			= ",`starttime` = '$get_attendance_starttime'";
                   $insertstarttime 	= "'$get_attendance_starttime'";
            }

            $get_attendance_endtime 	= $endtime_in_id . " " . $inp_hours_endtime . ":00";
            if ($inp_hours_endtime 		== '00:00' || $inp_hours_endtime == '') {
                   $endtime 			= ",`endtime` = NULL";
                   $insertendtime 		= "NULL";
            } else {
                   $endtime 			= ",`endtime` = '$get_attendance_endtime'";
                   $insertendtime 		= "'$get_attendance_endtime'";
            }

            $sql_shift = "SELECT 
                                  (CASE 
                                         WHEN (SELECT DATE(hrmholiday.start_date) FROM hrmholiday WHERE DATE(hrmholiday.start_date) = '$inp_dateforcheck' AND hrmholiday.is_recur = '0') = '$inp_dateforcheck' THEN CONCAT('PH' , hrmttamshiftdaily.daytype)
                                         WHEN (SELECT 
                                                DATE_FORMAT(hrmholiday.start_date, '%m-%d') 
                                                FROM hrmholiday
                                                WHERE DATE_FORMAT(hrmholiday.start_date, '%m-%d') = DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                                AND hrmholiday.is_recur = '1'
                                         ) =  DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                         THEN hrmttamshiftdaily.overtimecode_ph
                                         ELSE hrmttamshiftdaily.overtimecode
                                         END
                                  ) AS 'overtimecode',
                                  CONCAT('$inp_dateforcheck', TIME_FORMAT(hrmttamshiftdaily.starttime, ' %H:%i:%s')) AS starttime, 
                                  CASE 
                                  WHEN hrmttamshiftdaily.shiftdailycode  LIKE 'S3%' THEN CONCAT(DATE_ADD('$inp_dateforcheck', INTERVAL 1 DAY), TIME_FORMAT(hrmttamshiftdaily.endtime, ' %H:%i:%s'))
                                  ELSE CONCAT('$inp_dateforcheck', TIME_FORMAT(hrmttamshiftdaily.endtime, ' %H:%i:%s'))
                                  END AS endtime,
                                  (CASE 
                                         WHEN (SELECT DATE(hrmholiday.start_date) FROM hrmholiday WHERE DATE(hrmholiday.start_date) = '$inp_dateforcheck' AND hrmholiday.is_recur = '0') = '$inp_dateforcheck' THEN CONCAT('PH' , hrmttamshiftdaily.daytype)
                                         WHEN (SELECT 
                                                DATE_FORMAT(hrmholiday.start_date, '%m-%d') 
                                                FROM hrmholiday
                                                WHERE DATE_FORMAT(hrmholiday.start_date, '%m-%d') = DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                                AND hrmholiday.is_recur = '1'
                                         ) =  DATE_FORMAT('$inp_dateforcheck', '%m-%d')
                                         THEN CONCAT('PH' , hrmttamshiftdaily.daytype)
                                         ELSE hrmttamshiftdaily.daytype
                                         END
                                  ) AS 'daytype'
                            FROM hrmttamshiftdaily 
                            WHERE hrmttamshiftdaily.shiftdailycode = '$sel_shiftdaily_code_id'";
				
			$sql_shiftschedule = mysqli_fetch_array(mysqli_query($connect, $sql_shift));
			
			$str_arr = explode(",", $string);

			$sql_att_edit = "INSERT INTO `hrdattendance` 
                                                 (
                                                        `attend_id` 
                                                        ,`emp_id` 
                                                        ,`attend_date` 
                                                        ,`shiftdaily_code` 
                                                        ,`company_id` 
                                                        ,`shiftstarttime` 
                                                        ,`shiftendtime` 
                                                        ,`attend_code` 
                                                        ,`starttime` 
                                                        ,`endtime` 
                                                        ,`actual_in` 
                                                        ,`actual_out`
                                                        ,`daytype`
                                                        ,`ip_starttime` 
                                                        ,`ip_endtime`
                                                        ,`remark`
                                                        ,`default_shift`
                                                        ,`total_ot`
                                                        ,`total_otindex`
                                                        ,`overtime_code` 
                                                        ,`created_date` 
                                                        ,`created_by`
                                                        ,`modified_date`
                                                        ,`modified_by` 
                                                        ,`flexibleshift`
                                                        ,`auto_ovt`
                                                        ,`actualworkmnt`
                                                        ,`premicheck`
                                                        ,`dateforcheck`
                                                        ,`shiftgroupcode`
                                                        ,`geolocation` 
                                                        ,`photo_start` 
                                                        ,`photo_end` 
                                                        ,`geoloc_start` 
                                                        ,`geoloc_end` 
                                                        ,`att_flag_start` 
                                                        ,`att_flag_end` 
                                                        ,`distance_start` 
                                                        ,`distance_end` 
                                                        ,`totalot_rounddown` 
                                                        ,`check`
                                                        ,`check2`
                                                 ) VALUES (
                                                        '$inp_attend_id' 
                                                        ,'$emp_id_id' 
                                                        ,'$starttime_in_id' 
                                                        ,'$sel_shiftdaily_code_id' 
                                                        ,'op'
                                                        ,'$sql_shiftschedule[starttime]' 
                                                        ,'$sql_shiftschedule[endtime]' 
                                                        ,'po'
                                                        ,$insertstarttime
                                                        ,$insertendtime
                                                        ,'op' 
                                                        ,'op'
                                                        ,'op'
                                                        ,'$sql_shiftschedule[daytype]'
                                                        ,'po'
                                                        ,'$inp_remark'
                                                        ,'po'
                                                        ,'po'
                                                        ,'pop' 
                                                        ,'$sql_shiftschedule[overtimecode]'
                                                        ,'2022-06-08 12:48:43' 
                                                        ,'o'
                                                        ,'2022-06-08 12:48:43' 
                                                        ,'op'
                                                        ,'op' 
                                                        ,'opo'
                                                        ,'po' 
                                                        ,'po'
                                                        ,'$inp_dateforcheck'
                                                        ,'pop' 
                                                        ,'o' 
                                                        ,'po'
                                                        ,'po' 
                                                        ,'p' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'op' 
                                                        ,'$starttime_in_id'

                                                 ) ON DUPLICATE KEY UPDATE
                                                 
                                                 `attend_id`          = '$inp_attend_id'
                                                 ,`shiftdaily_code`   = '$sel_shiftdaily_code_id'
                                                 ,`shiftstarttime`    = '$sql_shiftschedule[starttime]'
                                                 ,`shiftendtime`      = '$sql_shiftschedule[endtime]'
                                                 ,`daytype`           = '$sql_shiftschedule[daytype]'
                                                 ,`overtime_code`     = '$sql_shiftschedule[overtimecode]'
                                                 ,`remark`            = '$inp_remark Attendance Edit ~ Update $SFdatetime'
                                                 $starttime
                                                 $endtime";

            $process = mysqli_query($connect, $sql_att_edit);

			if ($process) {
				$delete = mysqli_query($connect, "DELETE FROM `hrdattstatusdetail` WHERE `attend_id` = '$get_attendance_attend_id'");
				include "../../set{sys=system_function_authorization}/attendance_formula.php";
			}

			$sql_0  			= "INSERT INTO `dev` 
											(
												`val0`, 
												`val1`, 
												`val2`,
												`val3`
											)
												VALUES
													(
														'$inp_attend_id',
														'$inp_hours_starttime',
														'$inp_dateforcheck',
														'$inp_destination_code'
													)";

			$query_0 = $connect->query($sql_0);

			$validator['success'] = true;
			$validator['code'] = "success_message_update";
			$validator['messages'] = "Successfully saved data";
		} else {
			$validator['success'] = true;
			$validator['code'] = "failed_message_update";
			$validator['messages'] = "You have submitted answer";
		}
	}
}

$connect->close();
echo json_encode($validator);
