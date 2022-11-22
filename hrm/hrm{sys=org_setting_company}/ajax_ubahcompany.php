<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];

$company_id         = $_POST['company_id'];
$company_code       = $_POST['company_code'];
$company_type       = $_POST['company_type'];
$company_name       = $_POST['company_name'];
$short_name       = $_POST['short_name'];
$company_level       = $_POST['company_level'];
$tax_country       = $_POST['tax_country'];
$base_currency       = $_POST['base_currency'];
$secbase_currency       = $_POST['secbase_currency'];
$time_setting       = $_POST['time_setting'];
$status       = $_POST['status'];
$address1       = $_POST['address1'];
$address2       = $_POST['address2'];
$city_val       = $_POST['city_val'];
$state_val       = $_POST['state_val'];
$country_val       = $_POST['country_val'];
$postal_code       = $_POST['postal_code'];
$phone       = $_POST['phone'];
$fax       = $_POST['fax'];
$email       = $_POST['email'];
$vision_en       = $_POST['vision_en'];
$vision_id       = $_POST['vision_id'];
$mission_en       = $_POST['mission_en'];
$mission_id       = $_POST['mission_id'];

// Mengambil gambar yang diupload
$temp            = "../../asset/upload/img/";
if(isset($_FILES['picture']['name'])){
    $ImageName       = $_FILES['picture']['name'];
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $nama_gambar    = "company_logo".$date_logo.".".$ImageExt;
}else{
    $ImageName       = 0;
}
// $ImageName       = $_FILES['picture']['name'];

if(isset($_FILES['picture']['name'])){
    move_uploaded_file($_FILES["picture"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file

    $update     = mysqli_query($connect, "UPDATE `teomcompany` SET 
    `company_name`='$company_name',
    `nick_name`='$short_name',
    `company_level`='$company_level',
    `status`='$status',
    `company_type`='$company_type',
    `company_logo`='$nama_gambar',
    `company_address`='$address1',
    `company_address2`='$address2',
    `company_phone`='$phone',
    `company_fax`='$fax',
    `company_email`='$email',
    `company_zipcode`='$postal_code',
    `currency_code`='$base_currency',
    `city_id`='$city_val',
    `state_id`='$state_val',
    `country_id`='$country_val',
    `vision_en`='$vision_en',
    `vision_id`='$vision_id',
    `mission_en`='$mission_en',
    `mission_id`='$mission_id',
    `modified_date`='$SFdatetime',
    `modified_by`='$username',
    `gmt_id`='$time_setting'
    WHERE `company_id` = '$company_id'");
}else{
    $update     = mysqli_query($connect, "UPDATE `teomcompany` SET 
    `company_name`='$company_name',
    `nick_name`='$short_name',
    `company_level`='$company_level',
    `status`='$status',
    `company_type`='$company_type',
    `company_address`='$address1',
    `company_address2`='$address2',
    `company_phone`='$phone',
    `company_fax`='$fax',
    `company_email`='$email',
    `company_zipcode`='$postal_code',
    `currency_code`='$base_currency',
    `city_id`='$city_val',
    `state_id`='$state_val',
    `country_id`='$country_val',
    `vision_en`='$vision_en',
    `vision_id`='$vision_id',
    `mission_en`='$mission_en',
    `mission_id`='$mission_id',
    `modified_date`='$SFdatetime',
    `modified_by`='$username',
    `gmt_id`='$time_setting'
    WHERE `company_id` = '$company_id'");
}


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