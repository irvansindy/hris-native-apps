<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$grade_category_code        = $_POST['grade_category_code'];
$grade_category_name        = $_POST['grade_category_name'];
$order_no                   = $_POST['order_no'];

// Validasi Order
$sql_ambil_order            = mysqli_query($connect, "SELECT gradecategory_code,order_id FROM teomgradecategory WHERE order_id ='$order_no'");
$check_order                = mysqli_num_rows($sql_ambil_order);
$data_ambil_order           = mysqli_fetch_assoc($sql_ambil_order);

$sql_jobgrade   = mysqli_query($connect, "SELECT * FROM teomgradecategory");
$job_rows       = mysqli_num_rows($sql_jobgrade);
$next_rows      = $job_rows+1;

if($check_order > 0){
    $change_order   = mysqli_query($connect, "UPDATE `teomgradecategory` SET 
    `order_id`='$next_rows'
    WHERE `gradecategory_code` = '$data_ambil_order[gradecategory_code]'");
}
// Validasi Order

$insert     = mysqli_query($connect, "INSERT INTO `teomgradecategory`
(`gradecategory_code`,
`company_id`, 
`gradecategory_name`, 
`order_id`, 
`created_date`,
`created_by`,
`modified_date`,
`modified_by`) 
VALUES (
'$grade_category_code',
'13576',
'$grade_category_name',
'$order_no',
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