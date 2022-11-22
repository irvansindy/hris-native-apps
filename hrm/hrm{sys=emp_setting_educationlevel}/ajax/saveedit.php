<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$etc             = $_POST['etc'];
$etm_en          = $_POST['etm_en'];
$etm_id          = $_POST['etm_id'];
$etl             = $_POST['etl'];
$ets             = $_POST['ets'];

// Validasi
$sql_get_databefore     = mysqli_query($connect, "SELECT a.edutype_code, a.edutype_level FROM hrmedulevel a WHERE a.edutype_level = '$etl'");
$count                  = mysqli_num_rows($sql_get_databefore);
$databefore             = mysqli_fetch_assoc($sql_get_databefore);

$sql_data_edutype       = mysqli_query($connect, "SELECT 
MAX(a.edutype_level) AS level_max
FROM teomedulevel a 
");

$data_edutype           = mysqli_fetch_assoc($sql_data_edutype);
$max                    = $data_edutype['level_max'] + 1;

if($count > 0){ 
    $update1 = mysqli_query($connect, "UPDATE `teomedulevel` SET 
    `edutype_level`='$max'
    WHERE `edutype_code` = '$databefore[edutype_code]'");
}

// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `teomedulevel` SET 
    `edutype_name_en`='$etm_en',
    `edutype_name_id`='$etm_id',
    `edutype_level`='$etl',
    `status`='$ets',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `edutype_code` = '$etc'");
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