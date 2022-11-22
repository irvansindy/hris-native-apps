<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

$req_no = $_POST['req_no'];
$division = $_POST['division'];
$department = $_POST['department'];
$tipe_pengajuan = $_POST['tipe_pengajuan'];
$orgpos = $_POST['orgpos'];
$leader_pos = $_POST['leader_pos'];
$pos_name = $_POST['pos_name'];
$cost_center = $_POST['cost_center'];
$work_location = $_POST['work_location'];
$job_status = $_POST['job_status'];
$job_title = $_POST['job_title'];
$reason = $_POST['reason'];
$remarks = $_POST['remarks'];

// Making array orgpos
$orgpos_praarray = str_replace('-]', '', $orgpos);
$orgpos_array = explode('-', $orgpos_praarray);
$count_orgpos_array = count($orgpos_array);

// Making array leaderpos
$leader_pos_praarray = str_replace('-]', '', $leader_pos);
$leader_pos_array = explode('-', $leader_pos_praarray);
$count_leader_pos_array = count($leader_pos_array);

// Making array pos name
$pos_name_praarray = str_replace('-]', '', $pos_name);
$pos_name_array = explode('-', $pos_name_praarray);
$count_pos_name_array = count($pos_name_array);

// Making array cost center 
$cost_center_praarray = str_replace('-]', '', $cost_center);
$cost_center_array = explode('-', $cost_center_praarray);
$count_cost_center_array = count($cost_center_array);

// Making array work location
$work_location_praarray = str_replace('-]', '', $work_location);
$work_location_array = explode('-', $work_location_praarray);
$count_work_location_array = count($work_location_array);

// Making array job status
$job_status_praarray = str_replace('-]', '', $job_status);
$job_status_array = explode('-', $job_status_praarray);
$count_job_status_array = count($job_status_array);

// Making array job title
$job_title_praarray = str_replace('-]', '', $job_title);
$job_title_array = explode('-', $job_title_praarray);
$count_job_title_array = count($job_title_array);

// Making array reason
$reason_praarray = str_replace('-]', '', $reason);
$reason_array = explode('-', $reason_praarray);
$count_reason_array = count($reason_array);

// Making array remarks
$remarks_praarray = str_replace('-]', '', $remarks);
$remarks_array = explode('-', $remarks_praarray);
$count_remarks_array = count($remarks_array);


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


// Insert Process to table hrdorgessrequest STEP 1
if(isset($_FILES['file']['name'])){

move_uploaded_file($_FILES["file"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file

$update_hrdorgessrequest     = mysqli_query($connect, "UPDATE `hrmorgessrequest` SET 
    `request_division`='$division',
    `request_department`='$department',
    `status_approval`='1',
    `request_status`='1',
    `attch`='$nama_gambar',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `request_no` = '$req_no'");

}else{

$update_hrdorgessrequest     = mysqli_query($connect, "UPDATE `hrmorgessrequest` SET 
    `request_division`='$division',
    `request_department`='$department',
    `status_approval`='1',
    `request_status`='1',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `request_no` = '$req_no'");

}
// Insert Process to table hrdorgessrequest STEP 1

if($update_hrdorgessrequest){

    $delete_hrdorgessrequest = mysqli_query($connect, "DELETE FROM `hrdorgessrequest` WHERE request_no = '$req_no'");

    for($i = 0; $i< $count_orgpos_array; $i++){

        $iplus = $i+1;
            $unique = $req_no.$date_logo.$iplus;

        // Process Insert to table hrmorgessrequest STEP 2
        $insert_hrdorgessrequest     = mysqli_query($connect, "INSERT INTO `hrdorgessrequest`
        (`request_no`,   
        `request_by`, 
        `request_date`, 
        `request_division`, 
        `request_department`, 
        `orgpos`, 
        `leader_pos`, 
        `position_name`,
        `cost_center`,
        `work_location`,
        `jobtitle_code`,
        `jobstatus_code`,
        `request_type`, 
        `status_approval`,
        `request_status`,
        `request_reason`,
        `request_remark`,
        `modified_date`,
        `modified_by`,
        `unique`) 
        VALUES (
        '$req_no',
        '$username',
        '$SFdatetime',
        '$division',
        '$department',
        '$orgpos_array[$i]',
        '$leader_pos_array[$i]',
        '$pos_name_array[$i]',
        '$cost_center_array[$i]',
        '$work_location_array[$i]',
        '$job_title_array[$i]',
        '$job_status_array[$i]',
        '$tipe_pengajuan',
        '1',
        '1',
        '$reason_array[$i]',
        '$remarks_array[$i]',
        '$SFdatetime',
        '$username',
        '$unique'
        )");
        // Process Insert to table hrmorgessrequest STEP 2

        // Process Insert to table hrmorgessrequest STEP 3
        $insert_hrdorgessrequest_log     = mysqli_query($connect, "INSERT INTO `hrdorgessrequestlog`
        (`request_no`,   
        `request_by`, 
        `request_date`, 
        `request_division`, 
        `request_department`, 
        `orgpos`,
        `leader_pos`, 
        `position_name`,
        `cost_center`,
        `work_location`,
        `jobtitle_code`,
        `jobstatus_code`,
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
        '$orgpos_array[$i]',
        '$leader_pos_array[$i]',
        '$pos_name_array[$i]',
        '$cost_center_array[$i]',
        '$work_location_array[$i]',
        '$job_title_array[$i]',
        '$job_status_array[$i]',
        '$tipe_pengajuan',
        '1',
        '1',
        '$reason_array[$i]',
        '$remarks_array[$i]',
        '$SFdatetime',
        '$username'
        )");
        // Process Insert to table hrmorgessrequest STEP 3


    }

    if($insert_hrdorgessrequest){
        echo 'Berhasil';
    }else{
        echo 'Gagal';
    }

}else{
    echo 'Gagal';
}

?>