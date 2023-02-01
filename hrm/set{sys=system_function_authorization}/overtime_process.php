<?php

if($source_process == 'OTHERS') {
       $sel_approval_request_no    = $attend_id;
       $sel_emp_no_approver        = $sel_emp_no_approver;
       $get_All_overtime = mysqli_query($connect, "SELECT attend_id FROM hrdattovtdetail WHERE attend_id='$sel_approval_request_no'");
} else {
       $sel_approval_request_no    = $sel_approval_request_no;
       $sel_emp_no_approver        = $sel_emp_no_approver;
       $get_All_overtime = mysqli_query($connect, "SELECT attend_id FROM hrdattovtdetail WHERE ovtdetail_id='$sel_approval_request_no'");
}


while ($row_overtime = mysqli_fetch_array($get_All_overtime)) {
       $sel_attend_id = $row_overtime['attend_id'];
       $hrdattendance = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                             a.attend_id,
                                                                             a.propose_before,
                                                                             a.propose_break1,
                                                                             a.propose_after,
                                                                             a.ovttype 
                                                                      FROM hrdattovtdetail a
                                                                      LEFT JOIN
                                                                             (
                                                                                    SELECT
                                                                                           sub2.request_no,
                                                                                           MAX(sub2.request_status) AS request_status
                                                                                    FROM hrmrequestapproval sub2
                                                                                    GROUP BY sub2.request_no
                                                                             ) e ON a.ovtdetail_id=e.request_no
                                                                      WHERE a.attend_id = '$sel_attend_id' AND (e.request_status = '3' or a.ovtrequest_no = 'ATTENDANCE.EDIT')"));
       $get_attendance_attend_id          = $hrdattendance[0];
       $get_attendance_overtime_before    = $hrdattendance[1];
       $get_attendance_overtime_break     = $hrdattendance[2];
       $get_attendance_overtime_after     = $hrdattendance[3];
       $qGet_RecordedTime_4               = $hrdattendance[4];

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
                            FROM hrdattendance a
                            LEFT JOIN hrmttamshiftdaily b ON a.shiftdaily_code=b.shiftdailycode
                            LEFT JOIN hrmttadshiftbreak c ON a.shiftdaily_code=c.shiftdailycode              
                            WHERE a.attend_id = '$get_attendance_attend_id'";



       $qGet_RecordedTime = mysqli_fetch_array(mysqli_query($connect, $get_RecordedTime));

       $qGet_RecordedTime_0 = $qGet_RecordedTime['starttime'];
       $qGet_RecordedTime_1 = $qGet_RecordedTime['ov_before'];
       $qGet_RecordedTime_2 = $qGet_RecordedTime['ov_middle'];
       $qGet_RecordedTime_3 = $qGet_RecordedTime['ov_after'];
       $qGet_RecordedTime_4 = $qGet_RecordedTime['overtime_code'];

       // -- ============================================================================================================================================

       //CARI MANA YANG PALING MASUK DI MENIT

       //CARI MANA YANG PALING MASUK DI MENIT
       if ($get_attendance_overtime_before <= $qGet_RecordedTime_1) {
              $overtime_before = $get_attendance_overtime_before;
       } else {
              $overtime_before = $qGet_RecordedTime_1;
       }
       if ($get_attendance_overtime_break <= $qGet_RecordedTime_2) {
              $overtime_break = $get_attendance_overtime_break;
       } else {
              $overtime_break = $qGet_RecordedTime_2;
       }
       if ($get_attendance_overtime_after <= $qGet_RecordedTime_3) {
              $overtime_after = $get_attendance_overtime_after;
       } else {
              $overtime_after = $qGet_RecordedTime_3;
       }
       $accepted_minutes = $overtime_before + $overtime_break + $overtime_after;
       //CARI MANA YANG PALING MASUK DI MENIT

       //CARI MANA YANG PALING MASUK DI MENIT

       // -- ============================================================================================================================================



       $formula_before = "SELECT 
                                   a.overtime_code,
                                   a.factor_no,
                                   a.step,
                                   CASE 
                                          WHEN '$overtime_before' > a.step*60 THEN (a.step*60)*a.`value`
                                          ELSE IFNULL('$overtime_before'*a.`value` , '0') 
                                   END AS step1,
                                   CASE 
                                          WHEN '$overtime_before' > a.step*60 AND ('$overtime_before' - a.step*60) > b.step*60 THEN (b.step*60)*b.`value` -- kalo jumlah menit lebih dari 483 dan 483-483 > 60 
                                          WHEN '$overtime_before' > a.step*60 AND ('$overtime_before' - a.step*60) <= b.step*60 THEN ('$overtime_before' - a.step*60)*b.`value`
                                          ELSE IFNULL('0'*b.`value`  , '0') 
                                   END AS step2,
                                   CASE 
                                          WHEN '$overtime_before' > a.step*60 AND '$overtime_before' > b.step*60 AND ('$overtime_before' - b.step*60) > c.step*60 THEN (c.step*60)*c.`value` -- kalo jumlah menit lebih dari 483 dan 483-483 > 60 
                                          WHEN '$overtime_before' > a.step*60 AND '$overtime_before' > b.step*60 AND ('$overtime_before' - b.step*60) <= c.step*60 THEN ('483' - (a.step*60+b.step*60))*c.`value`
                                          ELSE IFNULL('0'*c.`value`  , '0')    
                                   END AS step3                                   
                                   FROM hrmovertimefactor a
                                   LEFT JOIN 
                                          (
                                                 SELECT
                                                        sub1.overtime_code,
                                                        sub1.`value`,
                                                        sub1.factor_no,
                                                        sub1.step
                                                 FROM hrmovertimefactor sub1
                                                 WHERE
                                                        sub1.overtime_code = '$qGet_RecordedTime_4' AND
                                                        sub1.factor_no = '2'
                                          ) b ON a.overtime_code=b.overtime_code
                                   LEFT JOIN 
                                          (
                                                 SELECT
                                                        sub2.overtime_code,
                                                        sub2.`value`,
                                                        sub2.factor_no,
                                                        sub2.step
                                                 FROM hrmovertimefactor sub2
                                                 WHERE
                                                        sub2.overtime_code = '$qGet_RecordedTime_4' AND
                                                        sub2.factor_no = '3'
                                          ) c ON a.overtime_code=c.overtime_code
                                   WHERE 
                                          a.overtime_code = '$qGet_RecordedTime_4' AND
                                          a.factor_no = '1'
                                   ORDER BY factor_no ASC";

       $calc_first   = mysqli_fetch_array(mysqli_query($connect, $formula_before));
       $sum_first    = $calc_first[3] + $calc_first[4] + $calc_first[5];



       $formula_break = "SELECT 

                            a.overtime_code,

                            a.factor_no,

                            a.step,

                            CASE 

                                   WHEN '$overtime_break' > a.step*60 THEN (a.step*60)*a.`value`

                                   ELSE IFNULL('$overtime_break'*a.`value` , '0') 

                            END AS step1,

                            CASE 

                                   WHEN '$overtime_break' > a.step*60 AND ('$overtime_break' - a.step*60) > b.step*60 THEN (b.step*60)*b.`value` -- kalo jumlah menit lebih dari 483 dan 483-483 > 60 

                                   WHEN '$overtime_break' > a.step*60 AND ('$overtime_break' - a.step*60) <= b.step*60 THEN ('$overtime_break' - a.step*60)*b.`value`

                                   ELSE IFNULL('0'*b.`value`  , '0') 

                            END AS step2,

                            CASE 

                                   WHEN '$overtime_break' > a.step*60 AND '$overtime_break' > b.step*60 AND ('$overtime_break' - b.step*60) > c.step*60 THEN (c.step*60)*c.`value` -- kalo jumlah menit lebih dari 483 dan 483-483 > 60 

                                   WHEN '$overtime_break' > a.step*60 AND '$overtime_break' > b.step*60 AND ('$overtime_break' - b.step*60) <= c.step*60 THEN ('483' - (a.step*60+b.step*60))*c.`value`

                                   ELSE IFNULL('0'*c.`value`  , '0')    

                            END AS step3

                            

                            FROM hrmovertimefactor a

                            LEFT JOIN 

                                   (

                                          SELECT

                                                 sub1.overtime_code,

                                                 sub1.`value`,

                                                 sub1.factor_no,

                                                 sub1.step

                                          FROM hrmovertimefactor sub1

                                          WHERE

                                                 sub1.overtime_code = '$qGet_RecordedTime_4' AND

                                                 sub1.factor_no = '2'

                                   ) b ON a.overtime_code=b.overtime_code

                            LEFT JOIN 

                                   (

                                          SELECT

                                                 sub2.overtime_code,

                                                 sub2.`value`,

                                                 sub2.factor_no,

                                                 sub2.step

                                          FROM hrmovertimefactor sub2

                                          WHERE

                                                 sub2.overtime_code = '$qGet_RecordedTime_4' AND

                                                 sub2.factor_no = '3'

                                   ) c ON a.overtime_code=c.overtime_code

                            WHERE 

                                   a.overtime_code = '$qGet_RecordedTime_4' AND

                                   a.factor_no = '1'

                            ORDER BY factor_no ASC";

       $calc_second   = mysqli_fetch_array(mysqli_query($connect, $formula_break));

       $sum_second    = $calc_second[3] + $calc_second[4] + $calc_second[5];







       $formula_after = "SELECT 

                            a.overtime_code,

                            a.factor_no,

                            a.step,

                            CASE 

                                   WHEN '$overtime_after' > a.step*60 THEN IFNULL((a.step*60)*a.`value` , '0') 

                                   ELSE IFNULL('$overtime_after'*a.`value` , '0') 

                            END AS step1,

                            CASE 

                                   WHEN '$overtime_after' > a.step*60 AND ('$overtime_after' - a.step*60) > b.step*60 THEN IFNULL((b.step*60)*b.`value` , '0')  -- kalo jumlah menit lebih dari 483 dan 483-483 > 60 

                                   WHEN '$overtime_after' > a.step*60 AND ('$overtime_after' - a.step*60) <= b.step*60 THEN IFNULL(('$overtime_after' - a.step*60)*b.`value` , '0')

                                   ELSE IFNULL('0'*b.`value`  , '0') 

                            END AS step2,

                            CASE 

                                   WHEN '$overtime_after' > a.step*60 AND '$overtime_after' > b.step*60 AND ('$overtime_after' - b.step*60) > c.step*60 THEN IFNULL((c.step*60)*c.`value` , '0') -- kalo jumlah menit lebih dari 483 dan 483-483 > 60 

                                   WHEN '$overtime_after' > a.step*60 AND '$overtime_after' > b.step*60 AND ('$overtime_after' - b.step*60) <= c.step*60 THEN IFNULL(('483' - (a.step*60+b.step*60))*c.`value` , '0')

                                   ELSE IFNULL('0'*c.`value`  , '0')    

                            END AS step3

                            

                            FROM hrmovertimefactor a

                            LEFT JOIN 

                                   (

                                          SELECT

                                                 sub1.overtime_code,

                                                 sub1.`value`,

                                                 sub1.factor_no,

                                                 sub1.step

                                          FROM hrmovertimefactor sub1

                                          WHERE

                                                 sub1.overtime_code = '$qGet_RecordedTime_4' AND

                                                 sub1.factor_no = '2'

                                   ) b ON a.overtime_code=b.overtime_code

                            LEFT JOIN 

                                   (

                                          SELECT

                                                 sub2.overtime_code,

                                                 sub2.`value`,

                                                 sub2.factor_no,

                                                 sub2.step

                                          FROM hrmovertimefactor sub2

                                          WHERE

                                                 sub2.overtime_code = '$qGet_RecordedTime_4' AND

                                                 sub2.factor_no = '3'

                                   ) c ON a.overtime_code=c.overtime_code

                            WHERE 

                                   a.overtime_code = '$qGet_RecordedTime_4' AND

                                   a.factor_no = '1'

                            ORDER BY factor_no ASC";

       $calc_three   = mysqli_fetch_array(mysqli_query($connect, $formula_after));

       $sum_three    = $calc_three[3] + $calc_three[4] + $calc_three[5];



       $accepted_minutes_index = $sum_first + $sum_second + $sum_three;



       $query_ovt = "UPDATE hrdattovtdetail SET 

                                          `accepted_min`              = '$accepted_minutes'

                                          ,`accepted_min_index`       = '$accepted_minutes_index'

                                          ,`modified_by`              = '$inp_requestee'

                                          ,`modified_date`            = '$SFdatetime' 

                                          ,`before`                   = '$overtime_before'

                                          ,`index_before`             = '$sum_first'

                                          ,`break1`                   = '$overtime_break'

                                          ,`index_break1`             = '$sum_second'

                                          ,`after`                    = '$overtime_after'

                                          ,`index_after`              = '$sum_three'

                                   WHERE attend_id = '$sel_attend_id'";



       $insert_overtime = mysqli_query($connect, $query_ovt);



       $update_attendance = mysqli_query($connect, "UPDATE hrdattendance SET 

                                                               total_ot = '$accepted_minutes',

                                                               total_otindex = '$accepted_minutes_index'

                                                        WHERE attend_id = '$get_attendance_attend_id'");

}

