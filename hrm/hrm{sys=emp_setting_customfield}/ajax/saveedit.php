<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$id                  = $_POST['id'];
$cf_name_en          = $_POST['cf_name_en'];
$cf_name_id          = $_POST['cf_name_id'];
$cf_string           = $_POST['cf_string'];


// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `hrmcustomfield` SET 
    `customfield_name_en`='$cf_name_en',
    `customfield_name_id`='$cf_name_id',
    `config_string`='$cf_string',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `customfield_no` = '$id'");
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