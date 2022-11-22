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
// $branch_company_name   = $_POST['branch_company_name'];
// $register_name         = $_POST['register_name'];
$branch_phone          = $_POST['branch_phone'];
$company_name          = $_POST['company_name'];
$company_address       = $_POST['company_address'];
$company_phone         = $_POST['company_phone'];
$business_unit         = $_POST['business_unit'];
$insurance_default     = $_POST['insurance_default'];

// Menghapus default jika sebelumnya ada data yang di setting default
if($insurance_default == '1'){
    $update     = mysqli_query($connect, "UPDATE `teorcompinsurance` SET `default_insurance`='0' WHERE `default_insurance` = '1'");
}
// Menghapus default jika sebelumnya ada data yang di setting default


$insert     = mysqli_query($connect, "INSERT INTO `teorcompinsurance`
(`company_id`, 
`register_no`, 
`register_date`, 
`institution_code`, 
`default_insurance`, 
`branch_code`, 
`branch_name`, 
`branch_account`, 
`branch_address`,
`branch_phone`,
`created_date`, 
`created_by`, 
`modified_date`, 
`modified_by`, 
`insurance_address`, 
`subdistrict_id`, 
`district_id`, 
`city_id`, 
`insurance_zipcode`, 
`insurance_phone`, 
`insurance_fax`, 
`branchcompany_name`) 
VALUES (
'13576',
'$insurance_number',
'$insurance_date',
'$insurance_name',
'$insurance_default',
'$branch_code',
'$branch_name',
'$branch_account',
'$branch_address',
'$branch_phone',
'$SFdatetime',
'$username',
'$SFdatetime',
'$username',
'$company_address',
'',
'',
'',
'',
'$company_phone',
'',
'$company_name')");

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