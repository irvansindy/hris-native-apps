<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$grade_code        = $_POST['grade_code'];
$grade_name        = $_POST['grade_name'];
$grade_category        = $_POST['grade_category'];
$order_no     = $_POST['order_no'];

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

// Validasi
$sql_validasi       = mysqli_query($connect, "SELECT 
a.grade_code
FROM teomjobgrade a WHERE a.grade_code = '$grade_code'");

$num_rows           = mysqli_num_rows($sql_validasi);

if($num_rows == '0' ){


// Validasi

$insert     = mysqli_query($connect, "INSERT INTO `teomjobgrade`
(`grade_code`,
`company_id`, 
`gradecategory_code`, 
`grade_order`, 
`minpay`, 
`maxpay`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`,
`grade_name`,
`currency_id`,
`midpay`) 
VALUES (
'$grade_code',
'13576',
'$grade_category',
'$order_no',
'1',
'10',
'$SFdatetime',
'$username',
'$SFdatetime',
'$username',
'$grade_name',
'IDR',
'5')");




if($insert){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

}else{
    echo $date_alert_failed['alert'].', there is same grade code used before!';
}
?>