<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../application/session/session.php";

// alert
$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '12'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '13'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

$success            = str_replace('#param', 'Chat', $date_alert_success['alert']);
$failed             = str_replace('#param', 'Chat', $date_alert_failed['alert']);

// alert

$username           = $_SESSION['username'];

$text_chat          = $_POST['text_chat'];
$req_id             = $_POST['req_id'];
$place_chat         = $_POST['place_chat'];
$chat_id            = 'CHAT'.$date_logo;
$chat               = $text_chat;
$free_chat          = str_replace($chat, "                                                                    
", "-");

// Persiapan buat upload file
$temp            = "../../asset/upload/attachmentessod/";
if(isset($_FILES['file']['name'])){
    $ImageName       = $_FILES['file']['name'];
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $size           = $_FILES['file']['size'];
    $nama_gambar    = $req_id.$date_logo.".".$ImageExt;
}else{
    $ImageName       = 0;
}
// Persiapan buat upload file

// Jika ada file yang diupload
if(isset($_FILES['file']['name'])){

    move_uploaded_file($_FILES["file"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file

    // if($text_chat == ''){
    //     $chat   = 'File terlampir';
    // }

    if($place_chat == '1'){

        $insert_attch   = mysqli_query($connect, "INSERT INTO `hrmorgesschatattachment` 
        (`request_id`,
        `chat_id`, 
        `file_name`, 
        `file_size`, 
        `file_type`, 
        `created_date`, 
        `created_by`, 
        `modified_date`, 
        `modified_by`,
        `file_place`) 
        VALUES (
        '$req_id',
        '$chat_id', 
        '$nama_gambar', 
        '$size', 
        '$ImageExt', 
        '$SFdatetime', 
        '$username', 
        '$SFdatetime', 
        '$username',
        '$place_chat')
        ");

    }else if($place_chat == '2'){

        $insert_attch   = mysqli_query($connect, "INSERT INTO `hrmorgesschatattachment` 
        (`request_id`,
        `chat_id`, 
        `file_name`, 
        `file_size`, 
        `file_type`, 
        `created_date`, 
        `created_by`, 
        `modified_date`, 
        `modified_by`,
        `file_place`) 
        VALUES (
        '$req_id',
        '$chat_id', 
        '$nama_gambar', 
        '$size', 
        '$ImageExt', 
        '$SFdatetime', 
        '$username', 
        '$SFdatetime', 
        '$username',
        '$place_chat')
        ");

    }else if($place_chat == '3'){

        $insert_attch   = mysqli_query($connect, "INSERT INTO `hrmorgesschatattachment` 
        (`request_id`,
        `chat_id`, 
        `file_name`, 
        `file_size`, 
        `file_type`, 
        `created_date`, 
        `created_by`, 
        `modified_date`, 
        `modified_by`,
        `file_place`) 
        VALUES (
        '$req_id',
        '$chat_id', 
        '$nama_gambar', 
        '$size', 
        '$ImageExt', 
        '$SFdatetime', 
        '$username', 
        '$SFdatetime', 
        '$username',
        '$place_chat')
        ");

    }

}

$insert_chat    = mysqli_query($connect, "INSERT INTO `hrmorgesschat` 
    (`id_chat`, 
    `ticketing_id`, 
    `message`, 
    `notification`, 
    `flag`, 
    `readflag`, 
    `created_date`, 
    `created_by`) 
    VALUES (
    '$chat_id', 
    '$req_id', 
    '$chat', 
    '0', 
    '', 
    '0', 
    '$SFdatetime', 
    '$username')
");

if($insert_chat){
    echo $success;
}else{
    echo $failed;
}

?>