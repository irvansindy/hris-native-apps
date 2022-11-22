<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$rc             = $_POST['rc'];
$rm_en          = $_POST['rm_en'];
$rm_id          = $_POST['rm_id'];


// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `hrmreligion` SET 
    `religion_name_en`='$rm_en',
    `religion_name_id`='$rm_id',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `religion_code` = '$rc'");
// Update di job Grade Category


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