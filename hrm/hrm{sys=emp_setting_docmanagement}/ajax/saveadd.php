<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$dm                 = $_POST['dm'];
$day                = $_POST['day'];
$daytype            = $_POST['daytype'];

// Code
$sql_max_code       = mysqli_query($connect, "SELECT MAX(a.doc_code) as hehe FROM 
hrmdoctype a");

$max_code           = mysqli_fetch_assoc($sql_max_code);
$cut                = substr($max_code['hehe'], 6);
$tambah             = $cut+1;
$jadi               = substr($max_code['hehe'], 0, 6).$tambah;


$insert     = mysqli_query($connect, "INSERT INTO `hrmdoctype`
(`doc_code`,
`doc_name`, 
`doc_type`, 
`company_id`, 
`remind_befnum`,
`remind_beftype`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$jadi',
'$dm',
'Additional',
'13576',
'$day',
'$daytype',
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