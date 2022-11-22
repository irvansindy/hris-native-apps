<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../application/session/session.php";
$username           = $_SESSION['username'];

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

$success            = str_replace('#param', 'Organization Structure', $date_alert_success['alert']);
$failed             = str_replace('#param', 'Organization Structure', $date_alert_failed['alert']);

// Membuat request no
$sql_req_no         = mysqli_query($connect, "SELECT * FROM hrmorgessrequest a
ORDER BY a.request_date DESC LIMIT 1");
$data_reqno         = mysqli_fetch_assoc($sql_req_no);
$sub_str            = substr($data_reqno['request_no'], 5);
$req_no             = $sub_str+1;
$req_no_now         = 'OD'.$yea.$req_no;
// Membuat request no

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

$button                 = $_POST['button'];

// Persiapan buat upload file
$temp            = "../../asset/upload/attachmentessod/";
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

// Validasi Req Status
if($button  == '2'){
    $req_status     = '0';
}elseif($button == '1'){
    $req_status     = '1';
}
// Validasi Req Status

// Jika ada file yang diupload
if(isset($_FILES['file']['name'])){

    move_uploaded_file($_FILES["file"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
$insert     = mysqli_query($connect, "INSERT INTO `hrmorgessrequest`
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
'$req_no_now',
'$username',
'$SFdatetime',
'$division',
'$department',
'$leader_pos',
'$pos_name',
'$type',
'1',
'$req_status',
'$reason',
'$remarks',
'$nama_gambar',
'$SFdatetime',
'$username'
)");
}else{
    $insert     = mysqli_query($connect, "INSERT INTO `hrmorgessrequest`
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
    '$req_no_now',
    '$username',
    '$SFdatetime',
    '$division',
    '$department',
    '$leader_pos',
    '$pos_name',
    '$type',
    '1',
    '$req_status',
    '$reason',
    '$remarks',
    '$SFdatetime',
    '$username'
    )");
}

// Mengambil data approval
$sql_data_approval      = mysqli_query($connect, "SELECT 
a.emp_no,
a.empno_appvr1,
a.empno_appvr2,
a.empno_appvr3,
b.position_id AS pos_id1,
c.position_id AS pos_id2,
d.position_id AS pos_id3,
b.pos_code AS pos_code1,
c.pos_code AS pos_code2,
d.pos_code AS pos_code3,
CONCAT('[', '%', a.empno_appvr1, '%', ',', '%', a.empno_appvr2, '%', ']') AS list_approval,
CONCAT('[', '%', b.position_id, '%', ',', '%', c.position_id, '%', ']') AS list_approval1
FROM tclcdreqappsettingessod a 
LEFT JOIN view_employee b ON a.empno_appvr1 = b.emp_no
LEFT JOIN view_employee c ON a.empno_appvr2 = c.emp_no
LEFT JOIN view_employee d ON a.empno_appvr3 = d.emp_no
WHERE a.emp_no = '$username'");

$data_approval          = mysqli_fetch_assoc($sql_data_approval);

$array_data_approval    = array(
    "$data_approval[empno_appvr1]",
    "$data_approval[empno_appvr2]",
    // "$data_approval[empno_appvr3]"
);

$array_data_posid    = array(
    "$data_approval[pos_id1]",
    "$data_approval[pos_id2]",
    "$data_approval[pos_id3]"
);

$array_data_poscode    = array(
    "$data_approval[pos_code1]",
    "$data_approval[pos_code2]",
    "$data_approval[pos_code3]"
);

$count                  = count($array_data_approval);
// Mengambil data approval

// Insert ke hrmrequestapproval
for($i = 0; $i <= $count-1; $i++){
    $no = $i + 1;
    $req    = '';
    if($i == 0){
        $req    = 'Sequence';
    }elseif($i == 1){
        $req    = 'Required';
    }

    if($array_data_approval[$i] == $username){
        $status     = '1';
    }else{
        $status     = '0';
    }

    $insert_approval    = mysqli_query($connect, "INSERT INTO `hrmrequestapprovalessod`
    (`request_no`,   
    `position_id`, 
    `approval_list`, 
    `seq_id`, 
    `req`, 
    `status`, 
    `ordering`,
    `request_status`, 
    `revised_remark`,
    `created_date`) 
    VALUES (
    '$req_no_now',
    '$array_data_posid[$i]',
    '$array_data_poscode[$i]',
    '$username',
    '$req',
    '$status',
    '$no',
    '1',
    '',
    '$SFdatetime'
    )");
}

if($insert){
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
    '$req_no_now',
    '$username',
    '$SFdatetime',
    '$division',
    '$department',
    '$leader_pos',
    '$pos_name',
    '$type',
    '1',
    '$req_status',
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
    '$req_no_now',
    '$username',
    '$SFdatetime',
    '$division',
    '$department',
    '$leader_pos',
    '$pos_name',
    '$type',
    '1',
    '$req_status',
    '$reason',
    '$remarks',
    '$SFdatetime',
    '$username'
    )");
}
    
    if($insert_log){

        $insert_struc     = mysqli_query($connect, "INSERT INTO `hrmorgessrequeststruc`
                        (`req_no`,   
                        `position_id`, 
                        `pos_code`, 
                        `parent_id`, 
                        `pos_name_en`, 
                        `jobdesc_en`,
                        `pos_level`, 
                        `parent_path`,
                        `pos_flag`, 
                        `dept_id`,
                        `created_date`,
                        `created_by`, 
                        `modified_date`,
                        `modified_by`, 
                        `org_level`,
                        `lstworklocation`, 
                        `lstgradecode`,
                        `head_div`,
                        `jobtitle_code`,
                        `jobstatuscode`, 
                        `costcenter_code`,
                        `req_type`, 
                        `approver`) 
                        VALUES (
                        '$req_no_now',
                        '$data_pos[position_id]',
                        '$pos_code',
                        '$leader_pos',
                        '$pos_name',
                        '$data_pos[jobdesc_en]', 
                        '$data_pos[pos_level]',
                        '$data_pos[parent_path]',
                        '$data_pos[pos_flag]',
                        '$department',
                        '$SFdatetime',
                        '$username',
                        '$SFdatetime',
                        '$username',
                        '$data_pos[org_level]',
                        '$work_location',
                        '$data_pos[lstgradecode]',
                        '$division',
                        '$jobtitle_code',
                        '$job_status',
                        '$cost_center',
                        '$type',
                        '1'
                        )");
                        
        if($insert_struc){
            echo $success;
        }else{
            echo $failed;
        }
    }else{
        echo $failed;
    }
}else{
    echo $failed;
}



