<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$cf_name_en          = $_POST['cf_name_en'];
$cf_name_id          = $_POST['cf_name_id'];
$cf_string           = $_POST['cf_string'];

// Max order
$sql_get_order       = mysqli_query($connect, "SELECT 
MAX(a.order_no) AS maxorder
FROM hrmcustomfield a ");
$get_order           = mysqli_fetch_assoc($sql_get_order);
$max_order           = $get_order['maxorder']+1;


$insert     = mysqli_query($connect, "INSERT INTO `hrmcustomfield`
(`customfield_name_en`, 
`customfield_name_id`, 
`customfield_name_my`, 
`customfield_name_th`,
`status`,
`order_no`,
`config_string`,
`customfield_name_mm`,
`customfield_name_vn`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$cf_name_en',
'$cf_name_id',
'',
'',
'0',
'$max_order',
'$cf_string',
'',
'',
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