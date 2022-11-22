<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$job_status_code          = $_POST['job_status_code'];
$job_statusname_en        = $_POST['job_statusname_en'];
$job_statusname_id        = $_POST['job_statusname_id'];

$insert     = mysqli_query($connect, "INSERT INTO `teomjobstatus`
(`jobstatuscode`,
`jobstatusname_en`, 
`jobstatusname_id`, 
`jobstatusname_th`, 
`jobstatusname_my`, 
`company_id`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$job_status_code',
'$job_statusname_en',
'$job_statusname_id',
'',
'',
'13576',
'$SFdatetime',
'$username',
'$SFdatetime',
'$username')");

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($insert){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}
?>