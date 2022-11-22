<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$jfgrade_code           = $_POST['jfgrade_code'];
$jfgrade_name_en        = $_POST['jfgrade_name_en'];
$jfgrade_name_id        = $_POST['jfgrade_name_id'];

$insert     = mysqli_query($connect, "INSERT INTO `teomjfgrade`
(`jfgrade_code`,
`created_by`, 
`created_date`, 
`modified_by`, 
`modified_date`, 
`order_no`,
`jfgrade_name_en`,
`jfgrade_name_id`,
`jfgrade_name_my`,
`jfgrade_name_th`,
`jfgrade_name`) 
VALUES (
'$jfgrade_code',
'$username',
'$SFdatetime',
'$username',
'$SFdatetime',
'',
'$jfgrade_name_en',
'$jfgrade_name_id',
'',
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