<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$jfl_code           = $_POST['jfl_code'];
$jfl_name_en        = $_POST['jfl_name_en'];
$jfl_name_id        = $_POST['jfl_name_id'];

$update     = mysqli_query($connect, "UPDATE `teorjfl` SET 
    `jfl_name_en`='$jfl_name_en',
    `jfl_name_id`='$jfl_name_id',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `jfl_code` = '$jfl_code'");

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