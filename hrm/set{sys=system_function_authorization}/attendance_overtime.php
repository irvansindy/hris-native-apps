<?php
       // DATA NEEDED FOR PROCESS DATA NEEDED FOR PROCESS DATA NEEDED FOR PROCESS
       // var $get_attendance_emp_no;
       // var $attenddate;
       // var $get_attendance_dateforcheck;
       // var $get_attendance_overtime_before
       // var $get_attendance_overtime_break
       // var $get_attendance_overtime_after
       // OVR-[YYYYMM]-[XXXXXX]
       $key = "OVERTIME_REQUEST";
       $doc_number_OVERTIME_REQUEST_1 = $doc_number_OVERTIME_REQUEST['seq_number']+1;
       $doc_number_OVERTIME_REQUEST_2 = $doc_number_OVERTIME_REQUEST['code_pattern'];
       $find_replace = array('[YYYYMM]','[XXXXXX]');
       $repl_replace = array($SFyearmonth,$doc_number_OVERTIME_REQUEST_1);
       $document_numbering = str_replace($find_replace , $repl_replace , $doc_number_OVERTIME_REQUEST_2);

       $get_RecordedTime = "SELECT
                            a.attend_id,
                            a.shiftdaily_code,
                            a.overtime_code,
                            a.daytype,
                            a.shiftstarttime,
                            a.shiftendtime,
                            a.starttime,
                            a.endtime,
                            CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_starttime , ' %H:%i:%s')) AS break_starttime,
                            CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_endtime , ' %H:%i:%s')) AS break_endtime,
                            -- ============================================================================================================================================
                            -- ============================================================================================================================================
                            CASE
                                   WHEN b.productivehours > 0 AND TIMESTAMPDIFF(MINUTE, a.starttime, a.shiftstarttime) > 0 THEN TIMESTAMPDIFF(MINUTE, a.starttime, a.shiftstarttime)
                                   ELSE 0
                            END AS ov_before,
                            CASE
                                   WHEN b.productivehours > 0 AND 
                                                 TIMESTAMPDIFF
                                                 (
                                                        MINUTE, 
                                                        CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_starttime , ' %H:%i:%s')), 
                                                        CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_endtime , ' %H:%i:%s'))
                                                 ) > 0 AND 
                                          (
                                                 CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_starttime , ' %H:%i:%s')) BETWEEN a.starttime AND a.endtime OR
                                                 CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_endtime , ' %H:%i:%s')) BETWEEN a.starttime AND a.endtime 
                                          ) THEN 
                                                 TIMESTAMPDIFF
                                                 (
                                                        MINUTE, 
                                                        CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_starttime , ' %H:%i:%s')), 
                                                        CONCAT(DATE_FORMAT(a.shiftstarttime , '%Y-%m-%d') , DATE_FORMAT(c.break_endtime , ' %H:%i:%s'))
                                                 )
                                   ELSE 0
                            END AS ov_middle,
                            CASE
                                   WHEN b.productivehours > 0 AND TIMESTAMPDIFF(MINUTE, a.shiftendtime, a.endtime) > 0 THEN TIMESTAMPDIFF(MINUTE, a.shiftendtime, a.endtime)
                                   WHEN b.productivehours = 0 AND TIMESTAMPDIFF(MINUTE, a.starttime, a.endtime) > 0 AND TIMESTAMPDIFF(MINUTE, a.starttime, a.endtime) > 420 THEN TIMESTAMPDIFF(MINUTE, a.starttime, a.endtime) - 60
                                   WHEN b.productivehours = 0 AND TIMESTAMPDIFF(MINUTE, a.starttime, a.endtime) > 0 AND TIMESTAMPDIFF(MINUTE, a.starttime, a.endtime) < 420 THEN TIMESTAMPDIFF(MINUTE, a.starttime, a.endtime)
                                   ELSE 0
                            END AS ov_after
                            -- ============================================================================================================================================
                            -- ============================================================================================================================================
                            FROM hrdattendance a
                            LEFT JOIN hrmttamshiftdaily b ON a.shiftdaily_code=b.shiftdailycode
                            LEFT JOIN hrmttadshiftbreak c ON a.shiftdaily_code=c.shiftdailycode
              
                            WHERE a.attend_id = '$get_attendance_attend_id'";
              
       $qGet_RecordedTime = mysqli_fetch_array(mysqli_query($connect, $get_RecordedTime));

       $qGet_RecordedTime_1 = $qGet_RecordedTime['ov_before'];
       $qGet_RecordedTime_2 = $qGet_RecordedTime['ov_middle'];
       $qGet_RecordedTime_3 = $qGet_RecordedTime['ov_after'];
       $qGet_RecordedTime_4 = $qGet_RecordedTime['overtime_code'];

       if($get_attendance_overtime_before <= $qGet_RecordedTime_1) {
              $overtime_before = $get_attendance_overtime_before;
       } else {
              $overtime_before = $qGet_RecordedTime_1;
       }
       if($get_attendance_overtime_break <= $qGet_RecordedTime_2) {
              $overtime_break = $get_attendance_overtime_break;
       } else {
              $overtime_break = $qGet_RecordedTime_2;
       }
       if($get_attendance_overtime_after <= $qGet_RecordedTime_3) {
              $overtime_after = $get_attendance_overtime_after;
       } else {
              $overtime_after = $qGet_RecordedTime_3;
       }
       $accepted_minutes = $overtime_before+$overtime_break+$overtime_after;
    
       if($get_attendance_relative == 'Y'){
              $insert_overtime = mysqli_query($connect , "INSERT INTO `hrdattovtdetail` 
                                                                      (
                                                                             `ovtdetail_id` 
                                                                             ,`attend_id` 
                                                                             ,`ot_date` 
                                                                             ,`ot_starttime` 
                                                                             ,`ot_endtime` 
                                                                             ,`accepted_min` 
                                                                             ,`created_by` 
                                                                             ,`created_date` 
                                                                             ,`modified_by` 
                                                                             ,`modified_date` 
                                                                             ,`remark`
                                                                             ,`auto` 
                                                                             ,`before` 
                                                                             ,`break1` 
                                                                             ,`break2` 
                                                                             ,`break3` 
                                                                             ,`break4` 
                                                                             ,`break5` 
                                                                             ,`after` 
                                                                             ,`deducted` 
                                                                             ,`ovttype` 
                                                                             ,`ovtrequest_no` 
                                                                             ,`deductbreaktime`
                                                                      ) VALUES 
                                                                      (
                                                                             '$document_numbering' 
                                                                             ,'$get_attendance_attend_id' 
                                                                             ,'$get_attendance_dateforcheck' 
                                                                             ,'2022-07-09 08:00:00' 
                                                                             ,'2022-07-09 10:00:00' 
                                                                             ,'60' 
                                                                             ,'$username' 
                                                                             ,'$SFdatetime' 
                                                                             ,'$username' 
                                                                             ,'$SFdatetime' 
                                                                             ,'$get_attendance_relative' 
                                                                             ,'0' 
                                                                             ,'0' 
                                                                             ,'0' 
                                                                             ,'0' 
                                                                             ,'0' 
                                                                             ,'0' 
                                                                             ,'0'
                                                                             ,'60' 
                                                                             ,'0'
                                                                             ,'ovt'
                                                                             ,''
                                                                             ,''
                                                                      )");
       } else {
                     $insert_overtime = mysqli_query($connect , "INSERT INTO `hrdattovtdetail` 
                                                               (
                                                                      `ovtdetail_id` 
                                                                      ,`attend_id` 
                                                                      ,`ot_date` 
                                                                      ,`ot_starttime` 
                                                                      ,`ot_endtime` 
                                                                      ,`accepted_min` 
                                                                      ,`created_by` 
                                                                      ,`created_date` 
                                                                      ,`modified_by` 
                                                                      ,`modified_date` 
                                                                      ,`remark`
                                                                      ,`auto` 
                                                                      ,`before` 
                                                                      ,`break1` 
                                                                      ,`break2` 
                                                                      ,`break3` 
                                                                      ,`break4` 
                                                                      ,`break5` 
                                                                      ,`after` 
                                                                      ,`deducted` 
                                                                      ,`ovttype` 
                                                                      ,`ovtrequest_no` 
                                                                      ,`deductbreaktime`
                                                               ) VALUES 
                                                                      (
                                                                             '$document_numbering' 
                                                                             ,'$get_attendance_attend_id' 
                                                                             ,'$get_attendance_dateforcheck' 
                                                                             ,'$get_attendance_dateforcheck' 
                                                                             ,'$get_attendance_dateforcheck' 
                                                                             ,'$accepted_minutes'
                                                                             ,'$username' 
                                                                             ,'$SFdatetime' 
                                                                             ,'$username' 
                                                                             ,'$SFdatetime' 
                                                                             ,'$get_attendance_relative' 
                                                                             ,'0' 
                                                                             ,'$overtime_before' 
                                                                             ,'$overtime_break' 
                                                                             ,'0' 
                                                                             ,'0' 
                                                                             ,'0' 
                                                                             ,'0'
                                                                             ,'$overtime_after' 
                                                                             ,'0'
                                                                             ,'$qGet_RecordedTime_4'
                                                                             ,''
                                                                             ,''
                                                                      ) ON DUPLICATE KEY UPDATE
                                                                             `ot_date` = '$get_attendance_dateforcheck' 
                                                                             ,`ot_starttime` = '$get_attendance_dateforcheck' 
                                                                             ,`ot_endtime` = '$get_attendance_dateforcheck' 
                                                                             ,`accepted_min` = '$accepted_minutes' 
                                                                             ,`modified_by` = '$username' 
                                                                             ,`modified_date` = '$SFdatetime' 
                                                                             ,`remark` = '$get_attendance_relative'
                                                                             ,`auto` = '0'
                                                                             ,`ovttype` = '$qGet_RecordedTime_4'
                                                                             ,`before` = '$overtime_before'
                                                                             ,`break1` = '$overtime_break' 
                                                                             ,`after` = '$overtime_after'");
       }
              
              if($insert_overtime){

           
                     $get_Formula = mysqli_query($connect, "SELECT * FROM hrmovertimefactor
                                                               WHERE overtime_code = '$qGet_RecordedTime_4'
                                                               ORDER BY factor_no ASC");
                     if (mysqli_num_rows($get_Formula) > 0) { 
                            while ($row = mysqli_fetch_array($get_Formula)) {

                            }
                     }

                     $update_attendance = mysqli_query($connect, "UPDATE hrdattendance SET 
                                                               total_ot = '$get_attendance_overtime_break'
                                                        WHERE attend_id = '$get_attendance_attend_id'");

                     $doc_numbering_increment = mysqli_query($connect , "UPDATE `tclmdocnumber` SET
                                                                                    `seq_number` = '$doc_number_OVERTIME_REQUEST_1'
                                                                             WHERE `code_type` = '$key'"); 
              }

       
?>