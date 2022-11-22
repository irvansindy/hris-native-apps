<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$parent_code        = $_POST['parent_code'];
$cc_code            = $_POST['cc_code'];
$cc_name_en         = $_POST['cc_name_en'];
$cc_name_id         = $_POST['cc_name_id'];
$status             = $_POST['status'];


$insert     = mysqli_query($connect, "INSERT INTO `teomcostcenter`
(`costcenter_code`,
`company_id`, 
`costcenter_name_en`, 
`costcenter_name_id`, 
`costcenter_name_my`, 
`costcenter_name_th`,
`status`,
`depth`,
`flag`,
`parent_code`,
`parent_path`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$cc_code',
'13576',
'$cc_name_en',
'$cc_name_id',
'$cc_name_en',
'$cc_name_en',
'$status',
'0',
'3',
'$parent_code',
'0',
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