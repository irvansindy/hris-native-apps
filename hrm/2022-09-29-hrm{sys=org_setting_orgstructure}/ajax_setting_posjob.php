<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

$position_id            = $_POST['position_id'];
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

// Update di job Grade Category
if(isset($_FILES['attch']['name'])){
    move_uploaded_file($_FILES["attch"]["tmp_name"], $temp.$nama_gambar); // Menyimpan file
$update     = mysqli_query($connect, "UPDATE `hrmorgstruc` SET 
    `pos_code`='$unit_code',
    `parent_id`='$parent_code',
    `pos_name_en`='$unit_name_en',
    `pos_name_id`='$unit_name_id',
    `pos_active`='$status_pos',
    `jobstatuscode`='$job_status_pos',
    `jobtitle_code`='$job_title_pos',
    `lstgradecode`='$grade_list',
    `lstworklocation`='$work_location',
    `jobdesc_en`='$job_desc_en',
    `jobdesc_id`='$job_desc_id',
    `costcenter_code`='$cost_center',
    `require_successor`='$require_suc',
    `report_postype`='$acting_as_pos',
    `clevel`='$chart_level_pos',
    `corder`='$chart_order_pos',
    `filename` = '$nama_gambar',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `position_id` = '$position_id'");
}else{
    $update     = mysqli_query($connect, "UPDATE `hrmorgstruc` SET 
    `pos_code`='$unit_code',
    `parent_id`='$parent_code',
    `pos_name_en`='$unit_name_en',
    `pos_name_id`='$unit_name_id',
    `pos_active`='$status_pos',
    `jobstatuscode`='$job_status_pos',
    `jobtitle_code`='$job_title_pos',
    `lstgradecode`='$grade_list',
    `lstworklocation`='$work_location',
    `jobdesc_en`='$job_desc_en',
    `jobdesc_id`='$job_desc_id',
    `costcenter_code`='$cost_center',
    `require_successor`='$require_suc',
    `report_postype`='$acting_as_pos',
    `clevel`='$chart_level_pos',
    `corder`='$chart_order_pos',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `position_id` = '$position_id'");
}
// Update di job Grade Category




if($update){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}


?>