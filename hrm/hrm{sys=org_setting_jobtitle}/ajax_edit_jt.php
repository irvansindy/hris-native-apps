<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


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

if(isset($_FILES['attch']['name'])){
    move_uploaded_file($_FILES["attch"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
$update     = mysqli_query($connect, "UPDATE `teomjobtitle` SET 
    `jobtitle_name_en`='$jt_name_en',
    `jobtitle_name_id`='$jt_name_id',
    `jfl_code`='$jfl_code',
    `filename`='$nama_gambar',
    `jobtitle_desc_en`='$jt_desc_en',
    `jobtitle_desc_id`='$jt_desc_id',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `jobtitle_code` = '$jt_code'");
}else{
    $update     = mysqli_query($connect, "UPDATE `teomjobtitle` SET 
    `jobtitle_name_en`='$jt_name_en',
    `jobtitle_name_id`='$jt_name_id',
    `jfl_code`='$jfl_code',
    `jobtitle_desc_en`='$jt_desc_en',
    `jobtitle_desc_id`='$jt_desc_id',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `jobtitle_code` = '$jt_code'");
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