<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$fc             = $_POST['fc'];
$fm             = $_POST['fm'];
$fd             = $_POST['fd'];

// Validasi
$sql_data_before        = mysqli_query($connect, "SELECT 
a.facility_code
FROM hrmfacility a 
WHERE a.facility_code = '$fc'");

$count      = mysqli_num_rows($sql_data_before);

if($count == 0){

    $insert     = mysqli_query($connect, "INSERT INTO `hrmfacility`
    (`facility_code`,
    `facility_name`, 
    `facility_desc`, 
    `company_id`,
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$fc',
    '$fm',
    '$fd',
    '13576',
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
    echo 'Facility code has been used before!';
}



?>