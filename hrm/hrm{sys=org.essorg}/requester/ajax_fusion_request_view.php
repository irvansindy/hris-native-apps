<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

// ALERT
$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);
// ALERT

// POST DATA
$req_no                 = $_POST['req_no'];
$division               = $_POST['division'];
$department             = $_POST['department'];
$type                   = $_POST['type'];

$leader_pos             = $_POST['leader_pos'];
$pos_name               = $_POST['pos_name'];
$pos_code               = $_POST['pos_code'];
$cost_center            = $_POST['cost_center'];
$work_location          = $_POST['work_location'];
$job_status             = $_POST['job_status'];
$jobtitle_code          = $_POST['jobtitle_code'];
$reason                 = $_POST['reason'];
$remarks                = $_POST['remarks'];

// Persiapan buat upload file
$temp            = "../../../asset/upload/attachmentessod/";
if(isset($_FILES['file']['name'])){
    $ImageName       = $_FILES['file']['name'];
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $size           = $_FILES['file']['size'];
    $nama_gambar    = $req_no.$date_logo."_".$ImageName;


    if(empty($text_chat)){
        $chat   = 'File terlampir';
    }

}else{
    $ImageName       = 0;
}
// Persiapan buat upload file
// POST DATA


// Ambil data dari table position
$sql_ambil_datapos      = mysqli_query($connect, "SELECT 
a.position_id,
a.pos_name_en,
a.parent_id,
a.jobdesc_en,
a.pos_level,
a.parent_path,
a.pos_flag,
a.dept_id,
a.org_level,
a.lstworklocation,
a.lstgradecode,
a.head_div,
a.jobtitle_code,
a.jobstatuscode,
a.costcenter_code
FROM hrmorgstruc a WHERE a.pos_code = '$pos_code'");

$data_pos               = mysqli_fetch_assoc($sql_ambil_datapos);
// Ambil data dari table position


// PROSES UPDATE KE DB hrmorgessrequest
// Jika ada file yang diupload
if(isset($_FILES['file']['name'])){

    move_uploaded_file($_FILES["file"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
$update_req     = mysqli_query($connect, "UPDATE `hrmorgessrequest` SET 
    `request_division`='$division',
    `request_department`='$department',
    `leader_pos`='$leader_pos',
    `position_name`='$pos_name',
    `status_approval`='1',
    `request_status`='1',
    `request_reason`='$reason',
    `request_remark`='$remarks',
    `attch`='$nama_gambar',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `request_no` = '$req_no'");
}else{
    $update_req     = mysqli_query($connect, "UPDATE `hrmorgessrequest` SET 
    `request_division`='$division',
    `request_department`='$department',
    `leader_pos`='$leader_pos',
    `position_name`='$pos_name',
    `status_approval`='1',
    `request_status`='1',
    `request_reason`='$reason',
    `request_remark`='$remarks',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `request_no` = '$req_no'");
}// PROSES UPDATE KE DB hrmorgessrequest

if($update_req){
// PROSES INSERT KE DB hrmorgessrequestlog
// Jika ada file yang diupload
if(isset($_FILES['file']['name'])){

    move_uploaded_file($_FILES["file"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
$insert_log     = mysqli_query($connect, "INSERT INTO `hrmorgessrequestlog`
    (`request_no`,   
    `request_by`, 
    `request_date`, 
    `request_division`, 
    `request_department`, 
    `leader_pos`,
    `position_name`,
    `request_type`, 
    `status_approval`,
    `request_status`,
    `request_reason`,
    `request_remark`,
    `attch`, 
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$req_no',
    '$username',
    '$SFdatetime',
    '$division',
    '$department',
    '$leader_pos',
    '$pos_name',
    '$type',
    '1',
    '1',
    '$reason',
    '$remarks',
    '$nama_gambar',
    '$SFdatetime',
    '$username'
    )");
}else{
    $insert_log     = mysqli_query($connect, "INSERT INTO `hrmorgessrequestlog`
    (`request_no`,   
    `request_by`, 
    `request_date`, 
    `request_division`, 
    `request_department`, 
    `leader_pos`,
    `position_name`,
    `request_type`, 
    `status_approval`,
    `request_status`,
    `request_reason`,
    `request_remark`, 
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$req_no',
    '$username',
    '$SFdatetime',
    '$division',
    '$department',
    '$leader_pos',
    '$pos_name',
    '$type',
    '1',
    '1',
    '$reason',
    '$remarks',
    '$SFdatetime',
    '$username'
    )");
}
// PROSES INSERT KE DB hrmorgessrequestlog


if($insert_log){
// PROSES UPDATE KE DB hrmorgessrequeststruc
    $update_reqstruc     = mysqli_query($connect, "UPDATE `hrmorgessrequeststruc` SET 
        `position_id`='$data_pos[position_id]',
        `pos_code`='$pos_code',
        `parent_id`='$leader_pos',
        `pos_name_en`='$data_pos[pos_name_en]',
        `dept_id`='$department',
        `modified_date`='$SFdatetime',
        `modified_by`='$username',
        `lstworklocation`='$work_location',
        `head_div`='$division',
        `jobtitle_code`='$jobtitle_code',
        `jobstatuscode`='$job_status',
        `costcenter_code`='$cost_center'
        WHERE `req_no` = '$req_no'");
    // PROSES UPDATE
if($update_req){

    echo $date_alert_success['alert'];

}else{
    echo $date_alert_failed['alert'];
}
 
}else{
    echo $date_alert_failed['alert'];
}

}else{
    echo $date_alert_failed['alert'];
}
// echo $pos_code;