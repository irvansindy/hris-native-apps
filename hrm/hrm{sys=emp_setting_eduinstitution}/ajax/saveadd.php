<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$eic            = $_POST['eic'];
$eim            = $_POST['eim'];

// Validasi
$sql_validasi   = mysqli_query($connect, "SELECT 
a.edu_code
FROM hrmeduinstitution a 
WHERE a.edu_code = '$eic'");

$count_validasi = mysqli_num_rows($sql_validasi);

if($count_validasi == 0){

    $insert     = mysqli_query($connect, "INSERT INTO `hrmeduinstitution`
    (`edu_code`,
    `edu_name`, 
    `created_date`, 
    `created_by`, 
    `modified_date`,
    `modified_by`,
    `status`) 
    VALUES (
    '$eic',
    '$eim',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username',
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

}else{
    echo 'Educational Institution code been used before!';
}

?>