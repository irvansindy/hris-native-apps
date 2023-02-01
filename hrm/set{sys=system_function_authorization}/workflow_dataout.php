<table cellpadding="1" cellspacing="1" style="width:100%">
    <?php
    // $request_type = $SFReqtype;
    // $employee     = $inp_requestfor;
    // $username     = $inp_emp_no;
    include "../../application/config.php";

    $request_type = $_GET['SFReqtype'];
    $employee     = $_GET['requester'];

    $get_Formula = mysqli_query($connect, "SELECT
            a.order_no,
            a.empno_appvr1,
            a.empno_appvr2,
            a.empno_appvr3,
            a.request_type,
            a.formula as attformula
        FROM tclcdreqappsetting_formula a
        WHERE a.request_type = '$request_type'");
    ?>

    <?php if (mysqli_num_rows($get_Formula) > 0) { ?>

        <?php while ($row = mysqli_fetch_array($get_Formula)) { ?>

            <?php
            $var1 = array(
                "cost_code",
                "parent_path",
                "pos_code"
            );

            $var2 = array(
                "(a.cost_code)",
                "(h.parent_path)",
                "(h.pos_code)"
            );
            $conversion_formula = str_replace($var1, $var2, $row['attformula']);
            ?>

            <?php

            $att_formula = "SELECT '$row[order_no]' , 

            a.emp_no, 
            a.Full_Name,
            a.pos_name_en,
            a.cost_code, 
            
            c.empno_appvr1, 
            c1.Full_Name,
            c1.pos_name_en,
            c1.cost_code, 
            
            c.empno_appvr2 , 
            c2.Full_Name,
            c2.pos_name_en,
            c2.cost_code, 
            
            c.empno_appvr3,
            c3.Full_Name,
            c3.pos_name_en,
            c3.cost_code
            
            FROM view_employee a 
            LEFT JOIN hrmorgstruc h on a.emp_no=h.emp_no 
            LEFT JOIN tclcdreqappsetting_formula c ON c.order_no = '$row[order_no]' 
            
            LEFT JOIN view_employee c1 ON c.empno_appvr1 = c1.emp_no 
            LEFT JOIN view_employee c2 ON c.empno_appvr2 = c2.emp_no 
            LEFT JOIN view_employee c3 ON c.empno_appvr3 = c3.emp_no 
            
            
            WHERE $conversion_formula";

            echo $att_formula . "UNION ALL <br>";

            $formula_process = mysqli_num_rows(mysqli_query($connect, $att_formula));

            if ($formula_process > 0) {

                $key_0 = $row['order_no'];
                $key_1 = $row['request_type'];

                $sql_approval = mysqli_query($connect, "SELECT 
                                                                'Step1' as step,
                                                                a.empno_appvr1 as approver,
                                                                '$employee' as seq_id,
                                                                a.workflow_name,
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
                                                                x2.emp_no,
                                                                x2.Full_Name
                                                            FROM tclcdreqappsetting_formula a
                                                            LEFT JOIN view_employee x1 on '$employee'=x1.emp_no
                                                            LEFT JOIN view_employee x2 on a.empno_appvr1=x2.emp_no
                                                            WHERE a.order_no = '$key_0' and
                                                                a.empno_appvr1 is not null and
                                                                a.empno_appvr1 <> '' and
                                                                a.request_type = '$request_type'

                                                            UNION ALL      
                                                            SELECT 
                                                                        'Step2' as step,
                                                                        a.empno_appvr2 as approver,
                                                                        '$employee' as seq_id,
                                                                        a.workflow_name,
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
                                                                        x2.emp_no,
                                                                        x2.Full_Name
                                                                FROM tclcdreqappsetting_formula a
                                                                LEFT JOIN view_employee x1 on '$employee'=x1.emp_no
                                                                LEFT JOIN view_employee x2 on a.empno_appvr2=x2.emp_no
                                                                WHERE a.order_no = '$key_0' and
                                                                        a.empno_appvr2 is not null and
                                                                        a.empno_appvr2 <> '' and
                                                                        a.request_type = '$request_type'  
                                                                UNION ALL      
                                                                SELECT 
                                                                                'Step3' as step,
                                                                                a.empno_appvr3 as approver,
                                                                                '$employee' as seq_id,
                                                                                a.workflow_name,
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
                                                                                x2.emp_no,
                                                                                x2.Full_Name
                                                                        FROM tclcdreqappsetting_formula a
                                                                        LEFT JOIN view_employee x1 on '$employee'=x1.emp_no
                                                                        LEFT JOIN view_employee x2 on a.empno_appvr3=x2.emp_no
                                                                        WHERE a.order_no = '$key_0' and
                                                                                a.empno_appvr3 is not null and
                                                                                a.empno_appvr3 <> '' and
                                                                                a.request_type = '$request_type'");



                while ($row_APP = mysqli_fetch_array($sql_approval)) {
            ?>

                    <tr>
                        <td width="10px" colspan="2" align='left' style="color:white; background-color: #a29e9e;">
                            <?php echo $row_APP['step']; ?></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 12px; font-weight: bold;font-size: x-small;" align='left'>
                            <?php echo $row_APP['workflow_name'] ?><br>
                            <?php echo $row_APP['approver']; ?>
                        </td>

                        <td style="padding-left: 12px; font-weight: bold;font-size: x-small;" align='left'>
                            <?php echo $row_APP['Full_Name'] ?>
                            <?php echo $row_APP['emp_no']; ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
                <?php
            }
        }
    }
    ?>

</table>