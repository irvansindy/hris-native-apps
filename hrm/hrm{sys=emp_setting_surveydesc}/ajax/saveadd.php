<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$desc               = $_POST['desc'];
$gpertanyaan        = $_POST['gpertanyaan'];



    $insert     = mysqli_query($connect, "INSERT INTO `hrmsurveytdescription`
    (`description`,
    `groupId`,
    `CreatedDate`, 
    `CreatedUser`, 
    `ModifiedDate`, 
    `ModifiedUser`) 
    VALUES (
    '$desc',
    '$gpertanyaan',
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