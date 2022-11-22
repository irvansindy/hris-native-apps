<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

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

// Making request no
$sql_req_no         = mysqli_query($connect, "SELECT * FROM hrdorgessrequest a
ORDER BY a.request_date DESC LIMIT 1");
$count_data_hrmorgreq   = mysqli_num_rows($sql_req_no);

if($count_data_hrmorgreq > 0){
$data_reqno         = mysqli_fetch_assoc($sql_req_no);
$sub_str            = substr($data_reqno['request_no'], 5);
$req_no             = $sub_str+1;
$req_no_now         = 'OD'.$yea.$req_no;
}else{
    $req_no_now         = 'OD'.$year.'00001';
}
// Making request no

// Persiapan buat upload file
$temp            = "../../../asset/upload/attachmentessod/";
if(isset($_FILES['file']['name'])){
    $ImageName       = $_FILES['file']['name'];
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $size           = $_FILES['file']['size'];
    $nama_gambar    = $req_no_now.$date_logo."_".$ImageName;


    if(empty($text_chat)){
        $chat   = 'File terlampir';
    }

}else{
    $ImageName       = 0;
}
// Persiapan buat upload file

// Persiapan approval
$sql_approval = mysqli_query($connect, "SELECT 
'Notification' AS stepapprv,
a.empno_appvr1 AS emp_no,
b.position_id,
b.pos_code
FROM tclcdreqappsettingessod a 
LEFT JOIN view_employee b ON b.emp_no = a.empno_appvr1
WHERE a.emp_no = '$username'
UNION
SELECT
'Sequence' AS stepapprv,
a.empno_appvr2 AS emp_no,
b.position_id,
b.pos_code
FROM tclcdreqappsettingessod a 
LEFT JOIN view_employee b ON b.emp_no = a.empno_appvr2
WHERE a.emp_no = '$username'
UNION
SELECT
'Required' AS stepapprv,
a.empno_appvr3 AS emp_no,
b.position_id,
b.pos_code
FROM tclcdreqappsettingessod a
LEFT JOIN view_employee b ON b.emp_no = a.empno_appvr3 
WHERE a.emp_no = '$username'");

$count_approval = mysqli_num_rows($sql_approval);


if($count_approval > 0){

// Insert ke table chat
$insert_chat        = mysqli_query($connect, "INSERT INTO `hrmorgesschat` 
(`id_chat`, 
`ticketing_id`, 
`message`, 
`notification`, 
`flag`, 
`readflag`, 
`created_date`, 
`created_by`) 
VALUES (
'Create', 
'$req_no_now', 
'Message Create', 
'0', 
'', 
'1', 
'$SFdatetime', 
'$username')
");
// Insert ke table chat

// Insert Process to approval STEP 0
$order = 1;
while($data_approval = mysqli_fetch_assoc($sql_approval)){
    if(!empty($data_approval['position_id'])){

        $insert_hrmrequestapprovalessod = mysqli_query($connect, "INSERT INTO `hrmrequestapprovalessod`
        (`request_no`,
        `position_id`, 
        `approval_list`, 
        `seq_id`, 
        `req`,
        `status`,
        `ordering`,
        `request_status`,
        `revised_remark`,
        `created_date`,
        `modified_date`) 
        VALUES (
        '$req_no_now',
        '$data_approval[position_id]',
        '$data_approval[pos_code]',
        '$username',
        '$data_approval[stepapprv]',
        '0',
        '$order',
        '1',
        '',
        '$SFdatetime',
        '$SFdatetime')");

        $order++;
    }
}

// Insert Process to table hrdorgessrequest STEP 1
if(isset($_FILES['file']['name'])){

    move_uploaded_file($_FILES["file"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
    
    $insert_hrdorgessrequest     = mysqli_query($connect, "INSERT INTO `hrmorgessrequest`
        (`request_no`,
        `request_by`, 
        `request_date`, 
        `request_division`, 
        `request_department`,
        `request_type`,
        `status_approval`,
        `request_status`,
        `attch`,
        `modified_date`,
        `modified_by`) 
        VALUES (
        '$req_no_now',
        '$username',
        '$SFdatetime',
        '$division',
        '$department',
        '$tipe_pengajuan',
        '1',
        '1',
        '$nama_gambar',
        '$SFdatetime',
        '$username')");
    
    }else{
    $insert_hrdorgessrequest     = mysqli_query($connect, "INSERT INTO `hrmorgessrequest`
        (`request_no`,
        `request_by`, 
        `request_date`, 
        `request_division`, 
        `request_department`,
        `request_type`,
        `status_approval`,
        `request_status`,
        `modified_date`,
        `modified_by`) 
        VALUES (
        '$req_no_now',
        '$username',
        '$SFdatetime',
        '$division',
        '$department',
        '$tipe_pengajuan',
        '1',
        '1',
        '$SFdatetime',
        '$username')");
}
// Insert Process to table hrdorgessrequest STEP 1

    if($insert_hrdorgessrequest){

        for($i = 0; $i< $count_pos_code_array; $i++){

            $unique = $req_no_now.$date_logo.$i+1;

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
            '$req_no_now',
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
            '$req_no_now',
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

}else{
    echo 'Wrong Approval Setting!';
}
?>