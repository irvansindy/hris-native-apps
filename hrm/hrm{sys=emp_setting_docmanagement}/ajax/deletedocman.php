<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

$dc   = $_POST['dc'];


$delete     = mysqli_query($connect, "DELETE FROM `hrmdoctype` WHERE doc_code = '$dc'");

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '8'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '9'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($delete){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

?>