<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$rc             = $_POST['rc'];
$rm_en          = $_POST['rm_en'];
$rm_id          = $_POST['rm_id'];


$insert     = mysqli_query($connect, "INSERT INTO `hrmreligion`
(`religion_code`,
`religion_name_en`, 
`religion_name_id`, 
`religion_name_th`, 
`religion_name_my`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$rc',
'$rm_en',
'$rm_id',
'$rm_en',
'$rm_en',
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