<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);


$unit_code              = $_POST['unit_code'];
$parent_code            = $_POST['parent_code'];
$unit_name_en           = $_POST['unit_name_en'];
$unit_name_id           = $_POST['unit_name_id'];
$status_pos             = $_POST['status_pos'];
$job_status_pos         = $_POST['job_status_pos'];
$job_title_pos          = $_POST['job_title_pos'];
$grade_list             = $_POST['grade_list'];
$work_location          = $_POST['work_location'];
$job_desc_en            = $_POST['job_desc_en'];
$job_desc_id            = $_POST['job_desc_id'];
$cost_center            = $_POST['cost_center'];
$require_suc            = $_POST['require_suc'];
$acting_as_pos          = $_POST['acting_as_pos'];
$chart_level_pos        = $_POST['chart_level_pos'];
$chart_order_pos        = $_POST['chart_order_pos'];

// Validasi 
$sql_validasi_poscode   = mysqli_query($connect, "SELECT * FROM hrmorgstruc WHERE pos_code = '$unit_code'");
$validasi_poscode       = mysqli_num_rows($sql_validasi_poscode);
// Validasi

// Mencari position id terakhir
$sql_position_id        = mysqli_query($connect, "SELECT 
a.position_id
FROM hrmorgstruc a 
ORDER BY a.created_date DESC
LIMIT 1");

$data_position_id       = mysqli_fetch_assoc($sql_position_id);
$position_id            = $data_position_id['position_id'] + 1;
// Mencari position id terakhir

// Mengambil data pos level posisi yang dijadikan parent
$sql_pos_level          = mysqli_query($connect, "SELECT 
a.pos_level,
a.parent_path
FROM 
hrmorgstruc a
WHERE a.position_id = '$parent_code'");
$data_pos_level         = mysqli_fetch_assoc($sql_pos_level);
$pos_level              = $data_pos_level['pos_level'] + 1;
$parent_path            = $data_pos_level['parent_path'].','.$parent_code;
// Mengambil data pos level posisi yang dijadikan parent

// Insert File
$temp            = "file/";
if(isset($_FILES['attch']['name'])){
    $ImageName       = $_FILES['attch']['name'];
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $nama_gambar    = "attch".$date_logo.".".$ImageExt;
}else{
    $ImageName       = 0;
}
// Insert File

if($validasi_poscode == '0'){

if(isset($_FILES['attch']['name'])){
    move_uploaded_file($_FILES["attch"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
$insert     = mysqli_query($connect, "INSERT INTO `hrmorgstruc`
(`position_id`,   
`pos_code`, 
`company_id`, 
`parent_id`, 
`pos_name_en`, 
`pos_name_id`,
`pos_name_my`, 
`pos_name_th`,
`jobdesc_en`, 
`jobdesc_id`,
`jobdesc_my`, 
`jobdesc_th`,
`pos_level`, 
`parent_path`,
`pos_flag`, 
`pos_active`,
`dept_id`, 
`dorder`,
`report_topos`, 
`clevel`,
`corder`, 
`changeflag`,
`report_postype`, 
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
`require_successor`, 
`filename`,
`backup_position`, 
`skip_approver`) 
VALUES (
'$position_id',
'$unit_code',
'13576',
'$parent_code',
'$unit_name_en',
'$unit_name_id',
'$unit_name_en',
'$unit_name_en',
'$job_desc_en',
'$job_desc_id',
'$job_desc_en',
'$job_desc_en',
'$pos_level',
'$parent_path',
'2',
'$status_pos',
'$parent_code',
'99',
'0',
'$chart_level_pos',
'$chart_order_pos',
'',
'$acting_as_pos',
'$SFdatetime',
'$username',
'$SFdatetime',
'$username',
'',
'$work_location',
'$grade_list',
'',
'$job_title_pos',
'$job_status_pos',
'$cost_center',
'$require_suc',
'$nama_gambar',
'',
'')");

}else{
    $insert     = mysqli_query($connect, "INSERT INTO `hrmorgstruc`
(`position_id`,   
`pos_code`, 
`company_id`, 
`parent_id`, 
`pos_name_en`, 
`pos_name_id`,
`pos_name_my`, 
`pos_name_th`,
`jobdesc_en`, 
`jobdesc_id`,
`jobdesc_my`, 
`jobdesc_th`,
`pos_level`, 
`parent_path`,
`pos_flag`, 
`pos_active`,
`dept_id`, 
`dorder`,
`report_topos`, 
`clevel`,
`corder`, 
`changeflag`,
`report_postype`, 
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
`require_successor`, 
`filename`,
`backup_position`, 
`skip_approver`) 
VALUES (
'$position_id',
'$unit_code',
'13576',
'$parent_code',
'$unit_name_en',
'$unit_name_id',
'$unit_name_en',
'$unit_name_en',
'$job_desc_en',
'$job_desc_id',
'$job_desc_en',
'$job_desc_en',
'$pos_level',
'$parent_path',
'2',
'$status_pos',
'$parent_code',
'99',
'0',
'$chart_level_pos',
'$chart_order_pos',
'',
'$acting_as_pos',
'$SFdatetime',
'$username',
'$SFdatetime',
'$username',
'',
'$work_location',
'$grade_list',
'',
'$job_title_pos',
'$job_status_pos',
'$cost_center',
'$require_suc',
'',
'',
'')");
}


if($insert){
    // Update Head Div
    $sql_update_head_div    = mysqli_query($connect, "UPDATE hrmorgstruc head_div = '$position_id' WHERE position_id = '$parent_code'");
    // Update Head Div

    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

}else{

    echo $date_alert_failed['alert'].', there is same unit code used before!';

}




?>