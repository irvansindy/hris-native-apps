<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$wl_code        = $_POST['wl_code'];
$wl_name        = $_POST['wl_name'];
$wl_type        = $_POST['wl_type'];
$wl_address     = $_POST['wl_address'];
$city_val       = $_POST['city_val'];
$state_val      = $_POST['state_val'];
$country_val    = $_POST['country_val'];
$phone          = $_POST['phone'];
$fax            = $_POST['fax'];
$email          = $_POST['email'];


$update     = mysqli_query($connect, "UPDATE `teomworklocation` SET 
    `worklocation_name`='$wl_name',
    `worklocation_type`='$wl_type',
    `worklocation_address`='$wl_address',
    `city_id`='$city_val',
    `state_id`='$state_val',
    `country_id`='$country_val',
    `phone`='$phone',
    `fax`='$fax',
    `email`='$email'
    WHERE `worklocation_code` = '$wl_code'");

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