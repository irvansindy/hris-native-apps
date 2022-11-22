<style>
body {
       font-family: Arial;
       margin: 0;
}

.header {
       padding-bottom: 5px;
       text-align: center;
       background: #3d8ad9;
       font-weight: 200px;
       color: white;
       height: 25px;
       border-bottom: 3px solid #FFF;
}
</style>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<?php require_once '../../../application/config.php'; ?>
<?php require_once '../../../application/session/session.php'; ?>
<?php
date_default_timezone_set('Asia/Bangkok');
?>


       <?php
                     for($iemg=0;$iemg<count($_POST['sel_parameter']);$iemg++){
                            $iemg_plus = $iemg+1;

                            $sel_parameters	= $_POST['sel_parameter'][$iemg];

                            $list_ofleave		= $_POST['list_ofleave'];
           
                            if($rfid == '2') {
                                   $where_active = "AND a.active_status IN ('0','1')";
                            } else {
                                   $where_active = "AND a.active_status = '$rfid'";
                            }

                            $valid_period = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                                           a.validperiod,
                                                                                           a.eligibility_formula, 
                                                                                           CASE 
                                                                                                  WHEN a.entitlement_specificdate = '1' THEN DATE_FORMAT(CONCAT('2013-','01-', a.entitlement_specificdate), '%d')
                                                                                                  WHEN a.entitlement_specificdate = '0' AND a.available_after <> '0' THEN DATE_FORMAT(CONCAT('2013-','01-', DAY(b.start_date)-1 ), '%d') 
                                                                                           ELSE '0'
                                                                                           END AS entitlement_specificdate, 
                                                                                           DATE_FORMAT(CONCAT('2013-', a.entitlement_specificmonth, '-01'), '%m') AS entitlement_specificmonth,
                                                                                           a.repeatperiod,
                                                                                           a.available_after,
                                                                                           a.validcriteria
                                                                                           FROM ttamleavetype a
                                                                                           LEFT JOIN view_employee b ON b.emp_no='$sel_parameters'
                                                                                           WHERE a.leave_code = '$list_ofleave'"));

                            $valid_period_r1 = $valid_period['validperiod'];
                            $valid_period_r2 = $valid_period['eligibility_formula'];
                            $valid_period_r3 = $valid_period['entitlement_specificdate'];
                            $valid_period_r4 = $valid_period['entitlement_specificmonth'];
                            $valid_period_r5 = $valid_period['repeatperiod'];
                            $valid_period_r6 = $valid_period['available_after'];
                            $valid_period_r7 = $valid_period['validcriteria'];
                            
                            //Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion  
                            //Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion
                            $var_r1_1 = array("#COSTCENTER","#GRADE","#JOINDATE","#WORKLOCATION","#RELIGION","#GENDER"); //-----------Formula Conversion -- Formula Conversion
				$var_r1_2 = array("a.cost_code","a.grade_code","a.start_date","a.worklocation_code","a.religion","b.gender_name"); //-- Conversion -- Formula Conversion
				$conversion_formula_r1 = str_replace($var_r1_1, $var_r1_2, $valid_period_r1); //ersion -- Formula Conversion
                            //Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion
                            $var_r2_1 = array("#COSTCENTER","#GRADE","#JOINDATE","#WORKLOCATION","#RELIGION","#GENDER"); //-----------Formula Conversion -- Formula Conversion
				$var_r2_2 = array("a.cost_code","a.grade_code","a.start_date","a.worklocation_code","a.religion","b.gender_name"); //-- Conversion -- Formula Conversion
				$conversion_formula_r2 = str_replace($var_r2_1, $var_r2_2, $valid_period_r2); //ersion -- Formula Conversion
                            //Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion
                            //Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion -- Formula Conversion 

                            


                            
       ?>


                     
<?php
              $data_employee = mysqli_query($connect, "SELECT 
                                                               $conversion_formula_r1,
                                                               $conversion_formula_r2,
                                                               a.emp_id,
                                                               a.company_id,
                                                               a.Full_Name,
                                                               a.start_date
                                                               FROM view_employee a
                                                               LEFT JOIN ttamgender b ON a.gender=b.id
                                                        WHERE a.emp_no = '$sel_parameters'");


              while($r=mysqli_fetch_array($data_employee)){
                     $formula1 = $r['validity_period'];
                     $formula2 = $r['eligibility_formula'];
                     $id = $r['emp_id'];
                     $fname = $r['Full_Name'];
                     $company_id = $r['company_id'];
                     $start_date = $r['start_date'];
                     $empgetleave_id = "LVB".$list_ofleave.$SFyear.$id;

                     if($valid_period_r6 == '0' && $valid_period_r3 != '0'){
                            $startvaliddate = $SFyear."-".$valid_period_r4."-".$valid_period_r3." 00:00:00";
                     } else if($valid_period_r6 == '0' && $valid_period_r3 == '0'){
                            $startvaliddate = $start_date." 00:00:00";
                     } else {
                            $get_startvaliddate = "SELECT DATE_ADD('$start_date', INTERVAL $valid_period_r6 $valid_period_r7) AS startvaliddate";
                            $Qstartvaliddate = mysqli_fetch_array(mysqli_query($connect, $get_startvaliddate));
                            $startvaliddate = $Qstartvaliddate['startvaliddate'];
                     }

                     if($valid_period_r3 == '1'){
                            $get_endvaliddate = "SELECT CONCAT(LAST_DAY('$startvaliddate' + INTERVAL $formula1 $valid_period_r7) , ' 00:00:00') AS endvaliddate";
                            $Qendvaliddate = mysqli_fetch_array(mysqli_query($connect, $get_endvaliddate));
                            $endvaliddate = "'".$Qendvaliddate['endvaliddate']."'";
                     } else if ($formula1 == '999') {
                            $endvaliddate = 'null';
                     } else {
                            $get_endvaliddate = "SELECT (('$startvaliddate' + INTERVAL $formula1 $valid_period_r7) + INTERVAL -1 DAY) AS endvaliddate ";
                            $Qendvaliddate = mysqli_fetch_array(mysqli_query($connect, $get_endvaliddate));
                            $endvaliddate = "'".$Qendvaliddate['endvaliddate']."'";
                     }

                     // echo $get_endvaliddate;
                     if($valid_period_r5 != '999'){
                            $get_nextvaliddate = "SELECT DATE_ADD('$startvaliddate', INTERVAL $valid_period_r5 YEAR) AS nextvaliddate";
                            $Qnextvaliddate = mysqli_fetch_array(mysqli_query($connect, $get_nextvaliddate));
                            $nextvaliddate = "'".$Qnextvaliddate['nextvaliddate']."'";
                     } else {
                            $nextvaliddate = 'null';
                     }
                     

?>

<?php
       $process = mysqli_query($connect, "INSERT INTO hrmempleavebal (
                                                                      empgetleave_id,
                                                                      emp_id,
                                                                      company_id,
                                                                      startvaliddate,
                                                                      endvaliddate,
                                                                      nextvaliddate,
                                                                      leave_code,
                                                                      remaining,
                                                                      active_status,
                                                                      remark,
                                                                      modified_by,
                                                                      modified_date,
                                                                      created_by,
                                                                      created_date
                                                                   ) 
                                                                      VALUES 
                                                                             (
                                                                                     '$empgetleave_id',
                                                                                     '$id',
                                                                                     '$company_id',
                                                                                     '$startvaliddate',
                                                                                     $endvaliddate,
                                                                                     $nextvaliddate,
                                                                                     '$list_ofleave',
                                                                                     '$formula2',
                                                                                     '1',
                                                                                     '$formula1',
                                                                                     '$username',
                                                                                     '$SFdatetime',
                                                                                     '$username',
                                                                                     '$SFdatetime'
                                                                             )");


       if($process){
              echo "<script>alert('successfully generate leave balance')</script>";
              echo "<script>window.close();</script>";
       } else {
              echo "<script>alert('Some data failed to generate leave balance')</script>";
              echo "<script>window.close();</script>";

              $process_failed = mysqli_query($connect, "INSERT INTO hrmempleavebal_failed (
                                                                      empgetleave_id,
                                                                      emp_id,
                                                                      company_id,
                                                                      startvaliddate,
                                                                      endvaliddate,
                                                                      nextvaliddate,
                                                                      leave_code,
                                                                      remaining,
                                                                      active_status,
                                                                      remark,
                                                                      modified_by,
                                                                      modified_date,
                                                                      created_by,
                                                                      created_date
                                                                   ) 
                                                                      VALUES 
                                                                             (
                                                                                     '$empgetleave_id',
                                                                                     '$id',
                                                                                     '$company_id',
                                                                                     '$startvaliddate',
                                                                                     '$endvaliddate[endvaliddate]',
                                                                                     '$nextvaliddate[nextvaliddate]',
                                                                                     '$list_ofleave',
                                                                                     '$formula2',
                                                                                     '1',
                                                                                     'Duplicate for empgetleave_id{$empgetleave_id}',
                                                                                     '$username',
                                                                                     '$SFdatetime',
                                                                                     '$username',
                                                                                     '$SFdatetime'
                                                                             )");
       }
?>

<?php }} ?>