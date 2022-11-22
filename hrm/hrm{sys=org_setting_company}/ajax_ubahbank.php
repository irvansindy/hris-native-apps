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

$update     = mysqli_query($connect, "UPDATE `teorcompbank` SET 
    `bank_code`='$bank_name',
    `account_name`='$account_name',
    `alias_name`='$alias',
    `default_bank`='$bank_default'
    WHERE `bank_account` = '$bank_account'");

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