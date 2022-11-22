<?php
       // DATA NEEDED FOR PROCESS DATA NEEDED FOR PROCESS DATA NEEDED FOR PROCESS
       // var get_attendance_emp_no;
       // var attenddate;
       // var get_attendance_dateforcheck;


       if($DataRows4 > 0 || $rSql_attendancetemp_status > 0) {

              $get_Attendance = "SELECT   
                                                 a.shiftdaily_code,
                                                 a.attend_id,
                                                 DATE_ADD(a.shiftstarttime, INTERVAL -b.grace_eai MINUTE) AS surplus,
                                                 DATE_ADD(a.shiftstarttime, INTERVAL b.grace_lti MINUTE) AS surmins

                                          FROM hrdattendance a
                                          LEFT JOIN hrmttamshiftdaily b ON a.shiftdaily_code=b.shiftdailycode
                                   WHERE
                                   a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no='$get_attendance_emp_no') AND
                                   '$attenddate' BETWEEN 
                                   DATE_ADD(a.shiftstarttime, INTERVAL -b.grace_eai MINUTE) AND 
                                   DATE_ADD(a.shiftstarttime, INTERVAL b.grace_lti MINUTE) AND
                                   a.dateforcheck = '$get_attendance_dateforcheck'
                                   ORDER BY a.shiftstarttime ASC LIMIT 1";
              $qGet_Attendance = mysqli_fetch_array(mysqli_query($connect, $get_Attendance));

              $qGet_Attendance_shiftcode = $qGet_Attendance['shiftdaily_code'];
              $qGet_Attendance_surplus = $qGet_Attendance['surplus'];
              $qGet_Attendance_surmins = $qGet_Attendance['surmins'];

              $get_RecordedTime = "SELECT 
                                          MIN(a.attend_date) AS attend_start
                                   FROM 
                                   HRDATTENDANCETEMP a
                                   WHERE a.attendanceid = '$get_attendance_emp_no' AND
                                   a.`status` = '1' AND
                                   a.attend_date BETWEEN '$qGet_Attendance_surplus' AND '$qGet_Attendance_surmins'";
                     
              $qGet_RecordedTime = mysqli_fetch_array(mysqli_query($connect, $get_RecordedTime));

              $update_attendance = mysqli_query($connect, "UPDATE hrdattendance SET 
                                                                             starttime = '$qGet_RecordedTime[attend_start]'
                                                                      WHERE attend_id = '$qGet_Attendance[attend_id]'");

              $update_attendance_print = "UPDATE hrdattendance SET 
                                                                             starttime = '$qGet_RecordedTime[attend_start]'
                                                                      WHERE attend_id = '$qGet_Attendance[attend_id]'";

       } else if ($DataRows4 == 0 || $rSql_attendancetemp_status == 0) {

              $get_Attendance = "SELECT
                                                 a.shiftdaily_code,
                                                 a.attend_id,
                                                 DATE_ADD(a.shiftendtime, INTERVAL -b.grace_eao MINUTE) AS surplus,
                                                 DATE_ADD(a.shiftendtime, INTERVAL b.grace_lto MINUTE) AS surmins
                                          FROM hrdattendance a
                                          LEFT JOIN hrmttamshiftdaily b ON a.shiftdaily_code=b.shiftdailycode
                                   WHERE
                                   a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no='$get_attendance_emp_no') AND
                                  '$attenddate' BETWEEN 
                                   DATE_ADD(a.shiftendtime, INTERVAL -b.grace_eao MINUTE) AND 
                                   DATE_ADD(a.shiftendtime, INTERVAL b.grace_lto MINUTE) 
                                   -- AND a.dateforcheck = '$get_attendance_dateforcheck'
                                   ORDER BY a.shiftstarttime ASC LIMIT 1";
              $qGet_Attendance = mysqli_fetch_array(mysqli_query($connect, $get_Attendance));

              $qGet_Attendance_shiftcode = $qGet_Attendance['shiftdaily_code'];
              $qGet_Attendance_surplus = $qGet_Attendance['surplus'];
              $qGet_Attendance_surmins = $qGet_Attendance['surmins'];

              $get_RecordedTime = "SELECT 
                                              MAX(a.attend_date) AS attend_start
                                   FROM 
                                   HRDATTENDANCETEMP a
                                   WHERE a.attendanceid = '$get_attendance_emp_no' AND
                                   a.`status` = '0' AND
                                   a.attend_date BETWEEN '$qGet_Attendance_surplus' AND '$qGet_Attendance_surmins'";
              
              $qGet_RecordedTime = mysqli_fetch_array(mysqli_query($connect, $get_RecordedTime));

              $update_attendance = mysqli_query($connect, "UPDATE hrdattendance SET 
                                                                             endtime = '$qGet_RecordedTime[attend_start]'
                                                                      WHERE attend_id = '$qGet_Attendance[attend_id]'");
              
              $update_attendance_print = "UPDATE hrdattendance SET 
                                                                             endtime = '$qGet_RecordedTime[attend_start]'
                                                                      WHERE attend_id = '$qGet_Attendance[attend_id]'";

       }

?>