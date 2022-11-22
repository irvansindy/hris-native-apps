<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


// $attch              = $_POST['attch'];
$jt_code            = $_POST['jt_code'];
$jt_name_en         = $_POST['jt_name_en'];
$jt_name_id         = $_POST['jt_name_id'];
$jfl_code           = $_POST['jfl_code'];
$jt_desc_en         = $_POST['jt_desc_en'];
$jt_desc_id         = $_POST['jt_desc_id'];

// Mengambil gambar yang diupload
$temp            = "file/";
if(isset($_FILES['attch']['name'])){
    $ImageName       = $_FILES['attch']['name'];
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $nama_gambar    = "attch".$date_logo.".".$ImageExt;
}else{
    $ImageName       = 0;
}

// GET JF CODE and JFGRADE CODE
$sql_jfl            = mysqli_query($connect, "SELECT a.jf_code, a.jfgrade_code FROM teorjfl a WHERE a.jfl_code = '$jfl_code'");
$data_jfl           = mysqli_fetch_assoc($sql_jfl);


if(isset($_FILES['attch']['name'])){
move_uploaded_file($_FILES["attch"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
$insert     = mysqli_query($connect, "INSERT INTO `teomjobtitle`
(`jobtitle_code`,
`jobtitle_name_en`, 
`jobtitle_name_id`, 
`jobtitle_name_th`, 
`jobtitle_name_my`,
`jobtitle_desc_en`,
`jobtitle_desc_id`,
`jobtitle_desc_th`,
`jobtitle_desc_my`,
`type_code`,
`created_date`,
`created_by`,
`modified_date`,
`modified_by`,
`jfl_code`,
`jf_code`,
`jfgrade_code`,
`filename`) 
VALUES (
'$jt_code',
'$jt_name_en',
'$jt_name_id',
'$jt_name_en',
'$jt_name_en',
'$jt_desc_en',
'$jt_desc_id',
'$jt_desc_en',
'$jt_desc_en',
'FUNCT',
'$SFdatetime',
'$username',
'$SFdatetime',
'$username',
'$jfl_code',
'$data_jfl[jf_code]',
'$data_jfl[jfgrade_code]',
'$nama_gambar')");
}else{
    $insert     = mysqli_query($connect, "INSERT INTO `teomjobtitle`
    (`jobtitle_code`,
    `jobtitle_name_en`, 
    `jobtitle_name_id`, 
    `jobtitle_name_th`, 
    `jobtitle_name_my`,
    `jobtitle_desc_en`,
    `jobtitle_desc_id`,
    `jobtitle_desc_th`,
    `jobtitle_desc_my`,
    `type_code`,
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`,
    `jfl_code`,
    `jf_code`,
    `jfgrade_code`,
    `filename`) 
    VALUES (
    '$jt_code',
    '$jt_name_en',
    '$jt_name_id',
    '$jt_name_en',
    '$jt_name_en',
    '$jt_desc_en',
    '$jt_desc_id',
    '$jt_desc_en',
    '$jt_desc_en',
    'FUNCT',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username',
    '$jfl_code',
    '$data_jfl[jf_code]',
    '$data_jfl[jfgrade_code]',
    '')");
}

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