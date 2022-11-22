<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$gname              = $_POST['gname'];
$gstatus            = $_POST['gstatus'];



    $insert     = mysqli_query($connect, "INSERT INTO `hrmsurveytgroup`
    (`groupName`,
    `CreatedDate`, 
    `CreatedUser`, 
    `ModifiedDate`, 
    `ModifiedUser`,
    `status`,
    `required`) 
    VALUES (
    '$gname',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username',
    '$gstatus',
    '1')");

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