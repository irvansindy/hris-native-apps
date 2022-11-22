<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$nc             = $_POST['nc'];
$nm_en          = $_POST['nm_en'];
$nm_id          = $_POST['nm_id'];

// Validasi
$sql_data_before    = mysqli_query($connect, "SELECT 
a.nationality_code
FROM hrmnationality a 
WHERE a.nationality_code = '$nc'");

$count              = mysqli_num_rows($sql_data_before);

if($count == 0){

    $insert     = mysqli_query($connect, "INSERT INTO `hrmnationality`
    (`nationality_code`,
    `nationality_name_en`, 
    `nationality_name_id`, 
    `nationality_name_th`, 
    `nationality_name_my`,
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$nc',
    '$nm_en',
    '$nm_id',
    '$nm_en',
    '$nm_en',
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

}else{
    echo 'Nationality code has been used before!';
}



?>