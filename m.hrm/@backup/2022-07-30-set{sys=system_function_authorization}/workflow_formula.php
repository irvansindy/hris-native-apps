<?php
// require_once '../../application/config.php';
$SFnumbercon  = $SFnumbercon;
$request_type = $SFReqtype;
$employee     = $inp_requestfor;
$username     = $inp_emp_no;

$get_Formula = mysqli_query($connect, "SELECT
                                                 order_no,
                                                 empno_appvr1,
                                                 empno_appvr2,
                                                 empno_appvr3,
                                                 a.formula as attformula
                                          FROM tclcdreqappsetting_formula a
                                          WHERE a.request_type = '$request_type'");
?>
<?php if (mysqli_num_rows($get_Formula) > 0) { ?>
<?php while ($row = mysqli_fetch_array($get_Formula)) { ?>

              <?php
              $var1 = array(
                     "cost_code",
                     "parent_path"
              );
              $var2 = array(
                     "(a.cost_code)",
                     "(a.parent_path)"
              );
              $conversion_formula = str_replace($var1, $var2, $row['attformula']);
              ?>
<?php
              $att_formula = "SELECT * FROM view_employee a WHERE a.emp_no = '$employee' AND $conversion_formula";
              $formula_process = mysqli_num_rows(mysqli_query($connect, $att_formula));

              if ($formula_process > 0) {
                     // echo $att_formula."<br>";
                     // echo $row['order_no']."<br>";
                     $key_0 = $row['order_no'];

                     $sql_approval = "INSERT INTO hrmrequestapproval 
                     (
                            `request_no`, 
                            `approval_list`,
                            `seq_id`,
                            `req`,
                            `status`,
                            `ordering`,
                            `request_status`,
                            `position_id`,
                            `modified_by`
                     ) SELECT 
                                   '$SFnumbercon',
                                   a.empno_appvr1,
                                   '$employee' as seq_id,
                                   'Notification' as req,
                                   CASE 
                                          WHEN empno_appvr1 = '$employee' THEN '1'
                                          ELSE '0'
                                   END,
                                   '0' as ordering,
                                   CASE 
                                          WHEN empno_appvr1 = '$employee' THEN '2'
                                          WHEN empno_appvr2 = '$employee' THEN '2'
                                          WHEN empno_appvr3 = '$employee' THEN '2'
                                          ELSE '1'
                                   END,
                                   x2.position_id,
                                   '$username'
                            FROM tclcdreqappsetting_formula a
                            LEFT JOIN view_employee x1 on '$employee'=x1.emp_no
                            LEFT JOIN view_employee x2 on a.empno_appvr1=x2.emp_no
                            WHERE a.order_no = '$key_0' and
                                  a.empno_appvr1 is not null and
                                  a.empno_appvr1 <> '' and
                                  a.request_type = '$request_type'
                            UNION ALL      
                            SELECT 
                                          '$SFnumbercon',
                                          a.empno_appvr2,
                                          '$employee' as seq_id,
                                          'Sequence' as req,
                                          CASE 
                                                 WHEN empno_appvr2 = '$employee' THEN '1'
                                                 ELSE '0'
                                          END,
                                          '1' as ordering,
                                          CASE 
                                                 WHEN empno_appvr1 = '$employee' THEN '2'
                                                 WHEN empno_appvr2 = '$employee' THEN '2'
                                                 WHEN empno_appvr3 = '$employee' THEN '2'
                                                 ELSE '1'
                                          END,
                                          x2.position_id,
                                          '$username'
                                   FROM tclcdreqappsetting_formula a
                                   LEFT JOIN view_employee x1 on '$employee'=x1.emp_no
                                   LEFT JOIN view_employee x2 on a.empno_appvr2=x2.emp_no
                                   WHERE a.order_no = '$key_0' and
                                         a.empno_appvr2 is not null and
                                         a.empno_appvr2 <> '' and
                                         a.request_type = '$request_type'  
                                   UNION ALL      
                                   SELECT 
                                                 '$SFnumbercon',
                                                 a.empno_appvr3,
                                                 '$employee' as seq_id,
                                                 'Required' as req,
                                                 CASE 
                                                        WHEN empno_appvr3 = '$employee' THEN '1'
                                                        ELSE '0'
                                                 END,
                                                 '2' as ordering,
                                                 CASE 
                                                        WHEN empno_appvr1 = '$employee' THEN '2'
                                                        WHEN empno_appvr2 = '$employee' THEN '2'
                                                        WHEN empno_appvr3 = '$employee' THEN '2'
                                                        ELSE '1'
                                                 END,
                                                 x2.position_id,
                                                 '$username'
                                          FROM tclcdreqappsetting_formula a
                                          LEFT JOIN view_employee x1 on '$employee'=x1.emp_no
                                          LEFT JOIN view_employee x2 on a.empno_appvr3=x2.emp_no
                                          WHERE a.order_no = '$key_0' and
                                                a.empno_appvr3 is not null and
                                                a.empno_appvr3 <> '' and
                                                a.request_type = '$request_type'
                                  ";

                     $list_approval_process = mysqli_query($connect, $sql_approval);
?>       


<?php
              }
       }
}
?>