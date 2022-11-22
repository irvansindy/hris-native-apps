<?php
if (isset($_POST['submit_add'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;

$modal_emp              = $_POST['modal_emp'];
$modal_remark           = $_POST['inp_remark'];
$modal_leave            = $_POST['modal_leave'];

$modal_lvb              = $_POST['inp_leavebalance'];
$modal_leave_start      = date ("Y-m-d", strtotime ($_POST['modal_leave_start']));
$modal_leave_end        = date ("Y-m-d", strtotime ($_POST['modal_leave_end']));

$var_lv_total      = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                  count(a.daytype) as total
                                                                  FROM hrdattendance a
                                                                  LEFT JOIN teodempcompany b on a.emp_id=b.emp_id
                                                                  WHERE 
                                                                  b.emp_no = '$modal_emp' and
                                                                  a.daytype IN ('WD','PHWD') and
                                                                  DATE(a.shiftstarttime) between '$modal_leave_start' and '$modal_leave_end'"));

$var_emp_id       = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_id FROM teodempcompany WHERE emp_no = '$modal_emp'"));

$modal            = mysqli_query($connect, 
                        "SELECT 
                        REPLACE(a.request_approval_formula, '*', '') as request_approval_formula,
                        b.seq_id,
                        a.request_approval_name,
                        a.req,
                        a.ordering
                        FROM tclcreqappsetting_final_fantasy_final a
                        LEFT JOIN tclcreqappsetting_final b on a.seq_id=b.seq_id
                        LEFT JOIN hrmorgstruc c on b.position_id=c.pos_code
                        LEFT JOIN teodempcompany d on c.position_id=d.position_id

                        WHERE d.emp_no='$modal_emp'
                        ");

      while($r=mysqli_fetch_array($modal)){  
?>



<?php
$printf = mysqli_num_rows($modal);
$total = $var_lv_total['total'];

if($total > 0){

      if($printf > 0)
            {
            $var1 = $r['request_approval_formula'];
            $var2 = mysqli_fetch_array(mysqli_query($connect, 
                                                "SELECT 
                                                b.pos_code 
                                                FROM 
                                                teodempcompany a 
                                                LEFT JOIN hrmorgstruc b on a.position_id=b.position_id 
                                                WHERE a.emp_no = '$username'"));
            
                  if ($var1 == $var2['pos_code']) {
                        $lvsts = '1';
                  } else {
                        $lvsts = '0';
                  }
            
            $var3 = mysqli_fetch_array(mysqli_query($connect, "SELECT
                                                a.emp_no,
                                                b.position_id,
                                                e.pos_code,
                                                c.seq_id,
                                                d.req,
                                                f.emp_no
                                                FROM teodempcompany a
                                                LEFT JOIN hrmorgstruc b on a.position_id=b.position_id
                                                LEFT JOIN tclcreqappsetting_final c on b.pos_code=c.position_id
                                                LEFT JOIN tclcreqappsetting_final_fantasy_final d on c.seq_id=d.seq_id and d.req IN ('Sequence','Required')
                                                LEFT JOIN hrmorgstruc e on REPLACE(d.request_approval_formula, '*', '')=e.pos_code
                                                LEFT JOIN teodempcompany f on e.position_id=f.position_id
                                                WHERE a.emp_no = '$modal_emp' and f.emp_no='$username'"));
            
            if ($var1 == $var3['pos_code']) {
                  $lvreqsts = '2';
            } else {
                  $lvreqsts = '1';
            }
            
            $process = mysqli_query($connect, "INSERT INTO hrmrequestapproval 
                                                      (
                                                            `request_no`, 
                                                            `approval_list`,
                                                            `seq_id`,
                                                            `req`,
                                                            `status`,
                                                            `ordering`,
                                                            `request_status`
                                                      ) 
                                                            VALUES 
                                                                  (
                                                                        '$SFnumbercon', 
                                                                        '$r[request_approval_formula]', 
                                                                        '$r[seq_id]',  
                                                                        '$r[req]',
                                                                        '$lvsts',
                                                                        '$r[ordering]',
                                                                        '$lvreqsts'
                                                                  )");


            $process = mysqli_query($connect, "INSERT INTO hrmleaverequest
                                    (
                                          `request_no`, 
                                          `company_id`,
                                          `requestedby`, 
                                          `emp_id`, 
                                          `requestdate`, 
                                          `leave_code`,
                                          `leave_startdate`, 
                                          `leave_enddate`, 
                                          `totaldays`, 
                                          `remark`, 
                                          `approval_status`, 
                                          `created_by`, 
                                          `created_date`,
                                          `modified_by`, 
                                          `modified_date`, 
                                          `refdoc`) 
                                                VALUES 
                                                (
                                                      '$SFnumbercon', 
                                                      '13576', 
                                                      '$var_emp_id[emp_id]', 
                                                      '$var_emp_id[emp_id]', 
                                                      '2020-12-11 11:23:55', 
                                                      '$modal_leave', 
                                                      '$modal_leave_start', 
                                                      '$modal_leave_end', 
                                                      '$var_lv_total[total]', 
                                                      '$modal_remark', 
                                                      '0', 
                                                      '$username', 
                                                      '$SFdatetime', 
                                                      '$username', 
                                                      '$SFdatetime', 
                                                      '0')
                                    ");
            
            $process_two = mysqli_query($connect, "INSERT INTO hrmrequest
                                    (
                                          `request_no`, 
                                          `code`) 
                                                VALUES 
                                                (
                                                      '$SFnumbercon', 
                                                      '1')
                                    ");

            echo"<script type='text/javascript'>
                        window.alert('Successfully Added Leave Transaction Request');
                        window.location.replace('../hrm{sys=time.attendance}');       
                  </script>";
            }
            else
            {
                  echo"<script type='text/javascript'>
                              window.alert('Wrong Approval Formula');     
                        </script>";
            } 
} else {
      echo"<script type='text/javascript'>
            window.alert('0 Days Request'); 
            window.location.replace('../hrm{sys=time.attendance}');         
      </script>";
}
}
?><?php } ?>