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
$pos_code = $_POST['pos_code'];
$reason = $_POST['reason'];
$remarks = $_POST['remarks'];

// Making array poscode
$pos_code_praarray = str_replace('-]', '', $pos_code);
$pos_code_array = explode('-', $pos_code_praarray);
$count_pos_code_array = count($pos_code_array);

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

        for($i = 0; $i< $count_pos_code_array; $i++){

            $iplus = $i+1;
            $unique = $req_no.$date_logo.$iplus;

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
            FROM hrmorgstruc a WHERE a.pos_code = '$pos_code_array[$i]'");

            $data_pos               = mysqli_fetch_assoc($sql_ambil_datapos);
            // Ambil data dari table position

            // Process Insert to table hrmorgessrequest STEP 2
            $insert_hrdorgessrequest     = mysqli_query($connect, "INSERT INTO `hrdorgessrequest`
            (`request_no`,   
            `request_by`, 
            `request_date`, 
            `request_division`, 
            `request_department`, 
            `leader_pos`, 
            `position_name`,
            `pos_code`,
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
            '$data_pos[parent_id]',
            '$data_pos[pos_name_en]',
            '$pos_code_array[$i]',
            '$data_pos[costcenter_code]',
            '$data_pos[lstworklocation]',
            '$data_pos[jobtitle_code]',
            '$data_pos[jobstatuscode]',
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
            $insert_hrmorgessrequest_log     = mysqli_query($connect, "INSERT INTO `hrdorgessrequestlog`
            (`request_no`,   
            `request_by`, 
            `request_date`, 
            `request_division`, 
            `request_department`, 
            `leader_pos`, 
            `position_name`,
            `pos_code`,
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
            '$data_pos[parent_id]',
            '$data_pos[pos_name_en]',
            '$pos_code_array[$i]',
            '$data_pos[costcenter_code]',
            '$data_pos[lstworklocation]',
            '$data_pos[jobtitle_code]',
            '$data_pos[jobstatuscode]',
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