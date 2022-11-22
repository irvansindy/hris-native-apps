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


$insert     = mysqli_query($connect, "INSERT INTO `teomworklocation`
(`worklocation_code`,
`company_id`, 
`worklocation_name`, 
`worklocation_address`, 
`country_id`, 
`state_id`,
`city_id`,
`email`,
`fax`,
`phone`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`,
`worklocation_type`) 
VALUES (
'$wl_code',
'13576',
'$wl_name',
'$wl_address',
'$country_val',
'$state_val',
'$city_val',
'$email',
'$fax',
'$phone',
'$SFdatetime ',
'$username',
'$SFdatetime',
'$username',
'$wl_type')");

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