<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$grade_code        = $_POST['grade_code'];
$grade_name        = $_POST['grade_name'];
$grade_category    = $_POST['grade_category'];

$update     = mysqli_query($connect, "UPDATE `teomjobgrade` SET 
    `grade_name`='$grade_name',
    `gradecategory_code`='$grade_category'
    WHERE `grade_code` = '$grade_code'");

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