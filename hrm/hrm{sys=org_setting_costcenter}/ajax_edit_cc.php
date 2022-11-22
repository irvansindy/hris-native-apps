<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$cc_path            = $_POST['cc_path'];
$parent_code        = $_POST['parent_code'];
$cc_code            = $_POST['cc_code'];
$cc_name_en         = $_POST['cc_name_en'];
$cc_name_id         = $_POST['cc_name_id'];
$status             = $_POST['status'];

$update     = mysqli_query($connect, "UPDATE `teomcostcenter` SET 
    `parent_code`='$parent_code',
    `costcenter_name_en`='$cc_name_en',
    `costcenter_name_id`='$cc_name_id',
    `status`='$status',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `costcenter_code` = '$cc_code'");

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