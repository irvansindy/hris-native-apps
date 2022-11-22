<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../application/session/session.php";

// alert
$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '12'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '13'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);
// alert

$username               = $_SESSION['username'];
$to                     = $_POST['to'];
$subject                = $_POST['subject'];
$time_start             = $_POST['time_start'];
$time_end               = $_POST['time_end'];
$content                = $_POST['content'];
$req_id                 = $_POST['req_id'];

$chat_id                = 'CHAT'.$date_logo;


$insert_chat    = mysqli_query($connect, "INSERT INTO `hrmorgesschat` 
    (`id_chat`, 
    `ticketing_id`, 
    `message`, 
    `notification`, 
    `flag`, 
    `readflag`, 
    `created_date`, 
    `created_by`) 
    VALUES (
    '$chat_id', 
    '$req_id', 
    'Meeting created', 
    '0', 
    '', 
    '0', 
    '$SFdatetime', 
    '$username')
");

$insert_meeting    = mysqli_query($connect, "INSERT INTO `hrmorgessmeeting` 
    (`id_chat`, 
    `request_id`, 
    `to`, 
    `subject`, 
    `time_start`, 
    `time_end`, 
    `content`, 
    `created_date`, 
    `created_by`) 
    VALUES (
    '$chat_id', 
    '$req_id', 
    '$to', 
    '$subject', 
    '$time_start',
    '$time_end',
    '$content', 
    '$SFdatetime', 
    '$username')
");



if($insert_chat){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}


?>