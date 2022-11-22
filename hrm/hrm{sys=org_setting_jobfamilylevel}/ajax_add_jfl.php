<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$jfl_code           = $_POST['jfl_code'];
$jfl_name_en        = $_POST['jfl_name_en'];
$jfl_name_id        = $_POST['jfl_name_id'];
$jf_code            = $_POST['jf_code'];
$jf_grade           = $_POST['jf_grade'];

$insert     = mysqli_query($connect, "INSERT INTO `teorjfl`
(`jfl_code`,
`jf_code`, 
`jfgrade_code`, 
`created_by`, 
`created_date`, 
`modified_by`,
`modified_date`,
`jfl_name_en`,
`jfl_name_id`,
`jfl_name_my`,
`jfl_name_th`) 
VALUES (
'$jfl_code',
'$jf_code',
'$jf_grade',
'$username',
'$SFdatetime',
'$username',
'$SFdatetime',
'$jfl_name_en',
'$jfl_name_id',
'',
'')");

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