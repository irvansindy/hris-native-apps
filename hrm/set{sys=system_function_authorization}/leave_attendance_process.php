<?php
// $key_0 = $SFnumbercon; --------------- LEAVE REQUEST
$sql_attendance_code = "SELECT 
                a.*,
                c.attend_code,
                d.attend_id,
                b.emp_id,
                e.emp_no
            FROM 
                hrdleaverequest a
                LEFT JOIN hrmleaverequest b ON a.request_no=b.request_no
                LEFT JOIN ttamleavetype c ON b.leave_code=c.leave_code
                LEFT JOIN hrdattendance d on b.emp_id=d.emp_id AND DATE(a.leave_date)=DATE(d.dateforcheck)
                LEFT JOIN view_employee e on b.emp_id=e.emp_id
            WHERE a.request_no = '$key_0'";

$get_Formula = mysqli_query($connect, $sql_attendance_code);
?>
<?php if (mysqli_num_rows($get_Formula) > 0) { ?>
<?php while ($row = mysqli_fetch_array($get_Formula)) { ?>

<?php
$get_attendance_attend_id       = $row['attend_id'];
$emp_id                         = $row['emp_id'];
$emp_no                         = $row['emp_no'];
$leave_starttime                = $row['leave_starttime'];
$attend_code                    = $row['attend_code'];

       $att_formula_from_sys_function_auth = "INSERT INTO `hrdattstatusdetail` 
                                        (
                                            `attend_id`, 
                                            `emp_id`, 
                                            `attend_date`, 
                                            `company_id`, 
                                            `attend_code`, 
                                            `created_by`, 
                                            `created_date`, 
                                            `modified_by`, 
                                            `modified_date`
                                        ) 
                                            VALUES 
                                                (
                                                    '$get_attendance_attend_id', 
                                                    '$emp_id', 
                                                    '$leave_starttime', 
                                                    '13576', 
                                                    '$attend_code', 
                                                    '$emp_no', 
                                                    '$SFdatetime', 
                                                    '$emp_no', 
                                                    '$SFdatetime'
                                                )";

       $formula_process_from_sys_function_auth = mysqli_query($connect, $att_formula_from_sys_function_auth);


    
        // 
   
?>       
<?php 
    }
    include "../../set{sys=system_function_authorization}/attendance_formula.php";
} 
?>