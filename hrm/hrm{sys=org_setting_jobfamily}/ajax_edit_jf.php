<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$jf_code           = $_POST['jf_code'];
$jf_name_en        = $_POST['jf_name_en'];
$jf_name_id        = $_POST['jf_name_id'];
$jf_desc_en        = $_POST['jf_desc_en'];
$jf_desc_id        = $_POST['jf_desc_id'];

$update     = mysqli_query($connect, "UPDATE `teomjf` SET 
    `jf_name_en`='$jf_name_en',
    `jf_name_id`='$jf_name_id',
    `jf_desc_en`='$jf_desc_en',
    `jf_desc_id`='$jf_desc_id',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `jf_code` = '$jf_code'");

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