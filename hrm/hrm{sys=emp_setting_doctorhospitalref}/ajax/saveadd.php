<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$code               = $_POST['code'];
$name               = $_POST['name'];
$type               = $_POST['type'];
$address            = $_POST['address'];
$phone              = $_POST['phone'];

$insert     = mysqli_query($connect, "INSERT INTO `hrmdoctorhospital`
(`doctorhospital_code`,
`doctorhospital_name`, 
`doctorhospital_address`, 
`doctorhospital_phone`,
`doctorhospital_type`,
`company_id`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$code',
'$name',
'$address',
'$phone',
'$type',
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