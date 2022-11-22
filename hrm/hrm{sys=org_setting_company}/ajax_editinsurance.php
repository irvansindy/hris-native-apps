<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$insurance_number      = $_POST['insurance_number'];
$insurance_name        = $_POST['insurance_name'];
$insurance_date        = $_POST['insurance_date'];
$branch_code           = $_POST['branch_code'];
$branch_name           = $_POST['branch_name'];
$branch_account        = $_POST['branch_account'];
$branch_address        = $_POST['branch_address'];
$branch_phone          = $_POST['branch_phone'];
$company_name          = $_POST['company_name'];
$insurance_address     = $_POST['insurance_address'];
$insurance_phone       = $_POST['insurance_phone'];
$business_unit         = $_POST['business_unit'];
$insurance_default     = $_POST['insurance_default'];

// Menghapus default jika sebelumnya ada data yang di setting default
if($insurance_default == '1'){
    $update     = mysqli_query($connect, "UPDATE `teorcompinsurance` SET `default_insurance`='0' WHERE `default_insurance` = '1'");
}
// Menghapus default jika sebelumnya ada data yang di setting default

$update     = mysqli_query($connect, "UPDATE `teorcompinsurance` SET 
    `institution_code`='$insurance_name',
    `register_date`='$insurance_date',
    `branch_name`='$branch_name',
    `branch_account`='$branch_account',
    `branch_address`='$branch_address',
    `branch_phone`='$branch_phone',
    `branchcompany_name`='$company_name',
    `insurance_address`='$insurance_address',
    `insurance_phone`='$insurance_phone',
    `default_insurance`='$insurance_default'
    WHERE `register_no` = '$insurance_number'");

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