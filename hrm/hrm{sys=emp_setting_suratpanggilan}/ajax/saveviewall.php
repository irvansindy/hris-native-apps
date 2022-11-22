<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$view_all             = $_POST['view_all'];
$in_view_all          = "'".$view_all."'";
$str_replace          = str_replace(",", "','", $in_view_all);

$sql_to_inactive      = mysqli_query($connect, "UPDATE `hrmconselor` SET `view_all`='0'");

$sql_to_active        = mysqli_query($connect, "UPDATE `hrmconselor` SET `view_all`='1' WHERE `pos_code` IN ($str_replace)");

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($sql_to_active){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}
?>