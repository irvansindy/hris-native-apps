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


// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `hrmdoctorhospital` SET 
    `doctorhospital_name`='$name',
    `doctorhospital_address`='$address',
    `doctorhospital_phone`='$phone',
    `doctorhospital_type`='$type',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `doctorhospital_code` = '$code'");
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