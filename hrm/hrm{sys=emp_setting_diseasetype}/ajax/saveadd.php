<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$dc             = $_POST['dc'];
$dm_en          = $_POST['dm_en'];
$dm_id          = $_POST['dm_id'];


$insert     = mysqli_query($connect, "INSERT INTO `hrmdisease`
(`disease_code`,
`disease_name_en`, 
`disease_name_id`, 
`disease_name_th`, 
`disease_name_my`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$dc',
'$dm_en',
'$dm_id',
'$dm_en',
'$dm_en',
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