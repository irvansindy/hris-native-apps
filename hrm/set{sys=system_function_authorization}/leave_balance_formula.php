<?php
// $key_0 = $SFnumbercon; --------------- LEAVE REQUEST
// $key_1 = $modal_leave; --------------- ANNUAL LEAVE EXAMPLE
// $key_2 = $r_detail['total_days'];----- TOTAL DAYS 
// $key_3 = $r_detail['emp_id']; -------- EMP_ID
// $key_4 = $inp_emp_no; ---------------- EMP_NO
$connect->query("DELETE FROM `sys_deducted_leave` WHERE `leave_request_no` = '$key_0'");

$sql = "SELECT
                                          a.emp_id,
                                          a.empgetleave_id,
                                          a.leave_code, 
                                          YEAR(a.startvaliddate) AS period,
                                          a.remaining,
                                          b.total_active_leave,
                                          a.startvaliddate,
                                          c.remaining_old,
                                          d.remaining_new,
                                          e.remaining_all_old,
                                          f.remaining_all_new,
                                          CASE
                                   
                                                 WHEN b.total_active_leave > 1 AND c.remaining_old > 0 AND c.remaining_old >= '$key_2' THEN '$key_2'
                                                
                                                 WHEN b.total_active_leave > 1 AND c.remaining_old IS NULL AND e.remaining_all_old >= '$key_2' THEN '0'
                               
                                                 WHEN b.total_active_leave > 1 AND c.remaining_old > 0 AND c.remaining_old < '$key_2' THEN REPLACE(c.remaining_old, '.0000', '')
                                       
                                                 WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND e.remaining_all_old < '$key_2' AND e.remaining_all_old = 0 THEN '$key_2' - e.remaining_all_old
                                                 WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND e.remaining_all_old < '$key_2' AND e.remaining_all_old < 0 THEN '$key_2'
                                                 WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND e.remaining_all_old < '$key_2' THEN '$key_2' - e.remaining_all_old
                              
                                                 WHEN b.total_active_leave > 1 AND (c.remaining_old <= 0  OR c.remaining_old < 0) THEN '0'
                                          
                                          WHEN b.total_active_leave > 1 AND d.remaining_new > 0 AND c.remaining_old < '$key_2' AND e.remaining_all_old < 0 THEN '$key_2'
                                          WHEN b.total_active_leave = 1 AND c.remaining_old > 0 AND c.remaining_old >= '$key_2' THEN '$key_2'
                                          WHEN b.total_active_leave = 1 AND c.remaining_old < '$key_2' THEN c.remaining_old-'$key_2'
                                          END AS 
                                          total_amount_yang_dipake
                                   FROM hrmempleavebal a
                                   LEFT JOIN 
                                                        (
                                                               SELECT
                                                               sub1.leave_code,
                                                               COUNT(*) AS total_active_leave
                                                               FROM hrmempleavebal sub1
                                                               WHERE sub1.emp_id='$key_3' AND sub1.leave_code='$key_1' AND sub1.active_status='1'
                                                        ) b ON a.leave_code=b.leave_code
                                   LEFT JOIN 
                                                        (
                                                               SELECT
                                                                      sub2.empgetleave_id,
                                                                      sub2.emp_id,
                                                                      sub2.remaining AS remaining_old
                                                               FROM hrmempleavebal sub2
                                                               WHERE sub2.emp_id='$key_3' AND sub2.leave_code='$key_1' AND sub2.active_status='1'
                                                               ORDER BY sub2.empgetleave_id ASC LIMIT 1
                                                        ) c ON a.empgetleave_id=c.empgetleave_id
                                   LEFT JOIN 
                                                        (
                                                               SELECT
                                                                      sub3.empgetleave_id,
                                                                      sub3.emp_id,
                                                                      sub3.remaining AS remaining_new
                                                               FROM hrmempleavebal sub3
                                                               WHERE sub3.emp_id='$key_3' AND sub3.leave_code='$key_1' AND sub3.active_status='1'
                                                               ORDER BY sub3.empgetleave_id DESC LIMIT 1
                                                        ) d ON a.empgetleave_id=d.empgetleave_id
                                   LEFT JOIN 
                                                        (
                                                               SELECT
                                                                      sub4.empgetleave_id,
                                                                      sub4.emp_id,
                                                                      sub4.remaining AS remaining_all_old
                                                               FROM hrmempleavebal sub4
                                                               WHERE sub4.emp_id='$key_3' AND sub4.leave_code='$key_1' AND sub4.active_status='1'
                                                               ORDER BY sub4.empgetleave_id ASC LIMIT 1
                                                        ) e ON a.emp_id=e.emp_id
                                   LEFT JOIN 
                                                        (
                                                               SELECT
                                                                      sub5.empgetleave_id,
                                                                      sub5.emp_id,
                                                                      sub5.remaining AS remaining_all_new
                                                               FROM hrmempleavebal sub5
                                                               WHERE sub5.emp_id='$key_3' AND sub5.leave_code='$key_1' AND sub5.active_status='1'
                                                               ORDER BY sub5.empgetleave_id DESC LIMIT 1
                                                        ) f ON a.emp_id=f.emp_id
                                   WHERE a.emp_id='$key_3' AND a.leave_code='$key_1' AND a.active_status='1'
                                   ORDER BY empgetleave_id ASC";

$get_Formula = mysqli_query($connect, $sql);
?>
<?php if (mysqli_num_rows($get_Formula) > 0) { ?>
<?php while ($row = mysqli_fetch_array($get_Formula)) { ?>

       
<?php
              $condition = $row['total_amount_yang_dipake'];
              if ($condition > 0) {
                     $att_formula = "INSERT INTO `sys_deducted_leave` (`empgetleave_bal`, `leave_request_no`, `total_usage`,`created_by`) VALUES ('$row[empgetleave_id]', '$key_0', '$row[total_amount_yang_dipake]','$key_4')";
                     $empgetleave_formula_process = mysqli_query($connect, $att_formula);
              }
?>       
<?php
       }
}
?>