<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$desc_id            = $_POST['desc_id'];
$desc               = $_POST['desc'];
$gpertanyaan        = $_POST['gpertanyaan'];

// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `hrmsurveytdescription` SET 
    `description`='$desc',
    `groupId`='$gpertanyaan',
    `ModifiedUser`='$username',
    `ModifiedDate`='$SFdatetime'
    WHERE `descriptionId` = '$desc_id'");
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