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

$insert     = mysqli_query($connect, "INSERT INTO `teomjf`
(`jf_code`,
`jf_name_en`, 
`jf_name_id`, 
`jf_name_my`, 
`jf_name_th`, 
`jf_desc_en`,
`jf_desc_id`,
`jf_desc_my`,
`jf_desc_th`,
`created_by`,
`created_date`,
`modified_by`,
`modified_date`) 
VALUES (
'$jf_code',
'$jf_name_en',
'$jf_name_id',
'',
'',
'$jf_desc_en',
'$jf_desc_id',
'',
'',
'$username',
'$SFdatetime',
'$username',
'$SFdatetime')");

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