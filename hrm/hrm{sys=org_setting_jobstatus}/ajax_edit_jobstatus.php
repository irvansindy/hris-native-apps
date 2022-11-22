<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$job_status_code          = $_POST['job_status_code'];
$job_statusname_en        = $_POST['job_statusname_en'];
$job_statusname_id        = $_POST['job_statusname_id'];


// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `teomjobstatus` SET 
    `jobstatusname_en`='$job_statusname_en',
    `jobstatusname_id`='$job_statusname_id',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `jobstatuscode` = '$job_status_code'");
// Update di job Grade Category


$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($update){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}


?>