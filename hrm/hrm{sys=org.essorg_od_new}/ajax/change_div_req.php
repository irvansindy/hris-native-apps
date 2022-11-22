<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../../application/session/session_ess.php";
$req_id           = $_POST['req_id'];
$div_id           = $_POST['div_id'];


// ALERT
$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);
// ALERT


// Proses update
$update     = mysqli_query($connect, "UPDATE `hrmorgessrequest` SET 
`request_division`='$div_id',
`modified_date`='$SFdatetime',
`modified_by`='$username'
WHERE `request_no` = '$req_id'");

if($update){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}
?>