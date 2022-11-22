<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$bank_name      = $_POST['bank_name'];
$bank_account   = $_POST['bank_account'];
$account_name   = $_POST['account_name'];
$alias          = $_POST['alias'];
$bank_default   = $_POST['bank_default'];


// Menghapus default jika sebelumnya ada data yang di setting default
if($bank_default == '1'){
    $update     = mysqli_query($connect, "UPDATE `teorcompbank` SET `default_bank`='0' WHERE `default_bank` = '1'");
}
// Menghapus default jika sebelumnya ada data yang di setting default


$insert     = mysqli_query($connect, "INSERT INTO `teorcompbank`
(`company_id`,
`bank_code`, 
`bank_account`, 
`account_name`, 
`alias_name`, 
`default_bank`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'13576',
'$bank_name',
'$bank_account',
'$account_name',
'$alias',
'$bank_default',
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