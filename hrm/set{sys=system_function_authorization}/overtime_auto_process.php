<?php
// DATA NEEDED FOR PROCESS DATA NEEDED FOR PROCESS DATA NEEDED FOR PROCESS
// var $get_attendance_attend_id

$doc_number_OVERTIME_REQUEST = mysqli_fetch_array(mysqli_query($connect, "SELECT 
												code_pattern, 
												seq_number
											FROM tclmdocnumber 
											WHERE code_type = 'OVERTIME_REQUEST'"));

$key = "OVERTIME_REQUEST";      
$doc_number_OVERTIME_REQUEST_1 = $doc_number_OVERTIME_REQUEST['seq_number']+1;
$doc_number_OVERTIME_REQUEST_2 = $doc_number_OVERTIME_REQUEST['code_pattern'];


$find_replace = array('[YYYYMM]','[XXXXXX]');
$repl_replace = array($SFyearmonth, $get_attendance_attend_id);
$SFnumbercon = str_replace($find_replace , $repl_replace , $doc_number_OVERTIME_REQUEST_2);











$get_All_overtime = mysqli_query($connect, "SELECT
                                                        a.attend_id,
                                                        a.daytype,
                                                        a.dateforcheck,
                                                        a.overtime_code,
                                                        a.emp_id,
                                                        a.shiftstarttime,
                                                        a.shiftendtime,
                                                        a.starttime,
                                                        a.endtime,
                                                        b.var2,
                                                        d.emp_no,
                                                        '0.5' AS rounding,

                                                        IFNULL((TIMESTAMPDIFF(MINUTE,a.starttime,a.shiftstarttime)/60)*60 , 0) AS actual_start,
                                                        IFNULL((TIMESTAMPDIFF(MINUTE,a.shiftendtime,a.endtime)/60)*60 , 0) AS actual_end,

                                                        IFNULL((FLOOR(TIMESTAMPDIFF(MINUTE,a.starttime,a.shiftstarttime)/60/0.5)*0.5)*60 , 0) AS hours_start,
                                                        IFNULL((FLOOR(TIMESTAMPDIFF(MINUTE,a.shiftendtime,a.endtime)/60/0.5)*0.5)*60 , 0) AS hours_end,

                                                        CASE
                                                               WHEN IFNULL(((FLOOR(TIMESTAMPDIFF(MINUTE,a.starttime,a.shiftstarttime)/60/0.5)*0.5)*60 + (FLOOR(TIMESTAMPDIFF(MINUTE,a.shiftendtime,endtime)/60/0.5)*0.5)*60), 0) < b.var2 THEN b.var2
                                                               ELSE IFNULL(((FLOOR(TIMESTAMPDIFF(MINUTE,a.starttime,a.shiftstarttime)/60/0.5)*0.5)*60 + (FLOOR(TIMESTAMPDIFF(MINUTE,a.shiftendtime,endtime)/60/0.5)*0.5)*60), 0)
                                                        END AS 'ovt_auto'

                                                 FROM hrdattendance a
                                                 LEFT JOIN db_config_str b ON b.var1='MIN_OVT_AUTO'
                                                 INNER JOIN hrmovtauto c ON a.emp_id=c.emp_id AND c.ovt_auto = 'Y'
                                                 LEFT JOIN view_employee d ON a.emp_id=d.emp_id
                                                 WHERE 
                                                 a.attend_id = '$get_attendance_attend_id' AND
                                                 a.daytype = 'WD' AND
                                                 (a.starttime IS NOT NULL OR a.endtime IS NOT NULL)
                                                                                                  
                                                 UNION ALL

                                                 SELECT
                                                        a.attend_id,
                                                        a.daytype,
                                                        a.dateforcheck,
                                                        a.overtime_code,
                                                        a.emp_id,
                                                        a.shiftstarttime,
                                                        a.shiftendtime,
                                                        a.starttime,
                                                        a.endtime,
                                                        b.var2,
                                                        d.emp_no,
                                                        '0.5' AS rounding, 
                                                        
                                                        '0' AS actual_start, 
                                                        IFNULL((TIMESTAMPDIFF(MINUTE,a.starttime,a.endtime)/60)*60, 0) AS actual_end, 
                                                        '0' AS hours_start, 
                                                        IFNULL((FLOOR(TIMESTAMPDIFF(MINUTE,a.starttime,a.endtime)/60/0.5)*0.5)*60, 0) AS hours_end, 
                                                        
                                                        IFNULL((FLOOR(TIMESTAMPDIFF(MINUTE,a.starttime,a.endtime)/60/0.5)*0.5)*60, 0) AS 'ovt_auto'

                                                 FROM hrdattendance a
                                                 LEFT JOIN db_config_str b ON b.var1='MIN_OVT_AUTO'
                                                 INNER JOIN hrmovtauto c ON a.emp_id=c.emp_id AND c.ovt_auto = 'Y'
                                                 LEFT JOIN view_employee d ON a.emp_id=d.emp_id
                                                 WHERE 
                                                 a.attend_id = '$get_attendance_attend_id' AND
                                                 a.daytype = 'OFF' AND
                                                 (a.starttime IS NOT NULL OR a.endtime IS NOT NULL) AND
                                                 IFNULL((FLOOR(TIMESTAMPDIFF(MINUTE,a.starttime,a.endtime)/60/0.5)*0.5)*60, 0) > 0");

while ($row_overtime = mysqli_fetch_array($get_All_overtime)) {

       $get_emp_id                        = $row_overtime['emp_id'];
       $get_attendance_attend_id          = $row_overtime['attend_id'];
       $get_attendance_dateforcheck       = $row_overtime['dateforcheck'];
       $qGet_RecordedTime_7               = $row_overtime['starttime'];
       $qGet_RecordedTime_8               = $row_overtime['endtime'];
       $qGet_RecordedTime_5               = $row_overtime['shiftstarttime'];
       $qGet_RecordedTime_6               = $row_overtime['shiftendtime'];
       $accepted_minutes                  = $row_overtime['ovt_auto']; 
       $accepted_minutes_index            = $row_overtime['ovt_auto'];
       $inp_requestee                     = $row_overtime['emp_no'];
       $inp_remark                        = 'Overtime Auto For : ' . $get_attendance_attend_id;
       $get_attendance_overtime_before    = $row_overtime['hours_start'];
       $overtime_before                   = $row_overtime['hours_start'];
       $sum_first                         = $row_overtime['hours_start'];
       $get_attendance_overtime_break     = '0';
       $overtime_break                    = '0';
       $sum_second                        = '0';
       $get_attendance_overtime_after     = $row_overtime['hours_end'];
       $overtime_after                    = $row_overtime['hours_end'];
       $sum_three                         = $row_overtime['hours_end'];
       $qGet_RecordedTime_4               = $row_overtime['overtime_code'];
       $source_function                   = 'ATTENDANCE.EDIT';
       $inp_mode                          = 'MD';
       $rounding                          = $row_overtime['rounding']; 

       $query_ovt = "INSERT INTO `hrdattovtdetail` 
                                   (
                                          `ovtdetail_id`
                                          ,`emp_id`
                                          ,`attend_id` 
                                          ,`ot_date` 
                                          ,`ot_starttime` 
                                          ,`ot_endtime` 
                                          ,`shiftstarttime`
                                          ,`shiftendtime`
                                          ,`accepted_min`
                                          ,`accepted_min_index` 
                                          ,`created_by` 
                                          ,`created_date` 
                                          ,`modified_by` 
                                          ,`modified_date` 
                                          ,`remark`
                                          ,`auto` 
                                          ,`propose_before`
                                          ,`before`
                                          ,`index_before` 
                                          ,`propose_break1` 
                                          ,`break1` 
                                          ,`index_break1`
                                          ,`propose_after` 
                                          ,`after` 
                                          ,`index_after` 
                                          ,`ovttype` 
                                          ,`ovtrequest_no` 
                                          ,`deductbreaktime`
                                          ,`ovtreqtype`
                                          ,`minutes_rounddown`
                                   ) VALUES 
                                          (
                                                 '$SFnumbercon' 
                                                 ,'$get_emp_id'
                                                 ,'$get_attendance_attend_id' 
                                                 ,'$get_attendance_dateforcheck' 
                                                 ,'$qGet_RecordedTime_7' 
                                                 ,'$qGet_RecordedTime_8'
                                                 ,'$qGet_RecordedTime_5'
                                                 ,'$qGet_RecordedTime_6'
                                                 ,'$accepted_minutes'
                                                 ,'$accepted_minutes_index'
                                                 ,'$inp_requestee' 
                                                 ,'$SFdatetime' 
                                                 ,'$inp_requestee' 
                                                 ,'$SFdatetime' 
                                                 ,'$inp_remark' 
                                                 ,'0' 
                                                 ,'$get_attendance_overtime_before'
                                                 ,'$overtime_before'
                                                 ,'$sum_first' 
                                                 ,'$get_attendance_overtime_break'
                                                 ,'$overtime_break'
                                                 ,'$sum_second' 
                                                 ,'$get_attendance_overtime_after'
                                                 ,'$overtime_after'
                                                 ,'$sum_three' 
                                                 ,'$qGet_RecordedTime_4'
                                                 ,'$source_function'
                                                 ,''
                                                 ,'$inp_mode'
                                                 ,'$rounding'

                                          ) ON DUPLICATE KEY UPDATE

                                                 `ovtdetail_id`              = '$SFnumbercon'
                                                 ,`ot_date`                  = '$get_attendance_dateforcheck'
                                                 ,`emp_id`                   = '$get_emp_id'
                                                 ,`ot_starttime`             = '$qGet_RecordedTime_7'
                                                 ,`ot_endtime`               = '$qGet_RecordedTime_8'
                                                 ,`shiftstarttime`           = '$qGet_RecordedTime_5'
                                                 ,`shiftendtime`             = '$qGet_RecordedTime_6'
                                                 ,`accepted_min`             = '$accepted_minutes'
                                                 ,`accepted_min_index`       = '$accepted_minutes_index'
                                                 ,`modified_by`              = '$inp_requestee'
                                                 ,`modified_date`            = '$SFdatetime' 
                                                 ,`remark`                   = '$inp_remark'
                                                 ,`auto`                     = '0'
                                                 ,`ovttype`                  = '$qGet_RecordedTime_4'
                                                 ,`ovtrequest_no`            = '$source_function'
                                                 ,`propose_before`           = '$get_attendance_overtime_before'
                                                 ,`before`                   = '$overtime_before'
                                                 ,`index_before`             = '$sum_first'
                                                 ,`propose_break1`           = '$get_attendance_overtime_break'
                                                 ,`break1`                   = '$overtime_break'
                                                 ,`index_break1`             = '$sum_second'
                                                 ,`propose_after`            = '$get_attendance_overtime_after'
                                                 ,`after`                    = '$overtime_after'
                                                 ,`index_after`              = '$sum_three'
                                                 ,`ovtreqtype`               = '$inp_mode'
                                                 ,`minutes_rounddown`        = '$rounding'";

       $insert_overtime = mysqli_query($connect, $query_ovt);

       if($insert_overtime){
              $update_attendance = mysqli_query($connect, "UPDATE hrdattendance SET 
                     total_ot = '$accepted_minutes',
                     total_otindex = '$accepted_minutes_index'
              WHERE attend_id = '$get_attendance_attend_id'");
       }
       
}