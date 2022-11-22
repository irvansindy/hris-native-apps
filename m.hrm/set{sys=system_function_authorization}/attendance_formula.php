<?php
       $get_Formula = mysqli_query($connect, "SELECT * FROM hrmattformula 
                                                       -- WHERE process_order = '6' 
                                                        ORDER BY process_order ASC");
?>
<?php if (mysqli_num_rows($get_Formula) > 0) { ?>
<?php while ($row = mysqli_fetch_array($get_Formula)) { ?>

              <?php
              $var1 = array(
                                   "{STARTTIME} EQ 0",
                                   "{ENDTIME} EQ 0", 
                                   "{STARTTIME} NEQ 0",
                                   "{ENDTIME} NEQ 0",              
                                   // "{STARTTIME} IS NULL",
                                   // "{ENDTIME} IS NULL",
                                   // "{STARTTIME} IS NOT NULL",
                                   // "{ENDTIME} IS NOT NULL",
                                   "{STARTTIME}",
                                   "{ENDTIME}",
                                   "{DAYTYPE}",
                                   "{SHIFTSTARTTIME}",
                                   "{SHIFTENDTIME}",
                                   "LSTATTENDCODE",
                                   "{SHIFTCODE}",
                                   "NEQ 0",
                                   "[",
                                   "]"
                            );
              $var2 = array(
                                   "(a.starttime IS NULL OR a.starttime = '0000-00-00 00:00:00')",
                                   "(a.endtime IS NULL OR a.endtime = '0000-00-00 00:00:00')",
                                   "(a.starttime IS NOT NULL AND a.starttime <> '0000-00-00 00:00:00')",
                                   "(a.endtime IS NOT NULL AND a.endtime <> '0000-00-00 00:00:00')",
                                   // "(a.starttime IS NULL AND a.starttime = '0000-00-00 00:00:00')",
                                   // "(a.endtime IS NULL AND a.endtime = '0000-00-00 00:00:00')",
                                   // "(a.starttime IS NOT NULL AND a.starttime <> '0000-00-00 00:00:00')",
                                   // "(a.endtime IS NOT NULL AND a.endtime <> '0000-00-00 00:00:00')",
                                   "a.starttime",
                                   "a.endtime",
                                   "a.daytype",
                                   "a.shiftstarttime",
                                   "a.shiftendtime",
                                   "(SELECT COUNT(*) AS total_value FROM `hrdattstatusdetail` WHERE `attend_id`='$get_attendance_attend_id' AND attend_code = ",
                                   "a.shiftdaily_code",
                                   "<> '0000-00-00 00:00:00'",
                                   "'",
                                   "')"
                            );
              $conversion_formula = str_replace($var1, $var2, $row['attformula']); 
              ?>
<?php  $att_formula = "INSERT INTO hrdattstatusdetail
                                   SELECT
                                          a.attend_id,
                                          a.emp_id,
                                          a.shiftstarttime,
                                          '13576',
                                          $conversion_formula,
                                          null,
                                          '$username',
                                          '$SFdatetime',
                                          '$username',
                                          '$SFdatetime'
                                   FROM hrdattendance a WHERE a.attend_id = '$get_attendance_attend_id'";
       $count_formula = mysqli_fetch_array(mysqli_query($connect, "SELECT           
                                   $conversion_formula
                            FROM hrdattendance a WHERE a.attend_id = '$get_attendance_attend_id'"));

       if($count_formula['formula'] != NULL) {
            $formula_process = mysqli_query($connect, $att_formula);
       } else {
              $delete_process = "DELETE FROM `hrdattstatusdetail` WHERE 
                                   `attend_id`='$get_attendance_attend_id' AND
                                   `attend_code` IN ('$row[listattendcode]')";
              mysqli_query($connect, $delete_process);
       }
?>       
<?php }} ?>