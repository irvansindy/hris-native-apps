<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$signedby_gtmo            = $_POST['signedby_gtmo'];
$signedby_pltapltc        = $_POST['signedby_pltapltc'];
$signedby_pltbplthplti    = $_POST['signedby_pltbplthplti'];
$signedby_pltdpltk        = $_POST['signedby_pltdpltk'];
$signedby_pltrpltepltm    = $_POST['signedby_pltrpltepltm'];

// Update GTMO
$update_gtmo     = mysqli_query($connect, "UPDATE `hrdsignedby` SET 
    `poscode`='$signedby_gtmo'
    WHERE `worklocation` = 'GTMO'");
// Update GTMO

// Update PLTA dan PLTC
$update_gtmo     = mysqli_query($connect, "UPDATE `hrdsignedby` SET 
    `poscode`='$signedby_pltapltc'
    WHERE `worklocation` = 'PLTA,PLTC'");
// Update PLTA dan PLTC

// Update PLTB, PLTH dan PLTI
$update_gtmo     = mysqli_query($connect, "UPDATE `hrdsignedby` SET 
    `poscode`='$signedby_pltbplthplti'
    WHERE `worklocation` = 'PLTB,PLTH,PLTI'");
// Update PLTB, PLTH dan PLTI

// Update PLTD dan PLTK
$update_gtmo     = mysqli_query($connect, "UPDATE `hrdsignedby` SET 
    `poscode`='$signedby_pltdpltk'
    WHERE `worklocation` = 'PLTD,PLTK'");
// Update PLTD dan PLTK

// Update PLTR, PLTE dan PLTM
$update_gtmo     = mysqli_query($connect, "UPDATE `hrdsignedby` SET 
    `poscode`='$signedby_pltrpltepltm'
    WHERE `worklocation` = 'PLTR,PLTE,PLTM'");
// Update PLTR, PLTE dan PLTM


$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($update_gtmo){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}


?>