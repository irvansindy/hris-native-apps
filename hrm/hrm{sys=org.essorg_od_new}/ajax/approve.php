<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../../application/session/session_ess.php";

$req_type           = $_POST['req_type'];
$req_id           = $_POST['req_id'];
$position     = $_POST['position'];
if($req_type == '1'){
$orgpos    = $_POST['orgpos'];
// Making array orgpos
$orgpos_praarray = str_replace('-]', '', $orgpos);
$orgpos_array = explode('-', $orgpos_praarray);
$count_orgpos_array = count($orgpos_array);
}
$cost_center     = $_POST['cost_center'];
$work_location      = $_POST['work_location'];
$job_status     = $_POST['job_status'];
$job_title        = $_POST['job_title'];
$unique        = $_POST['unique'];


$username         = $_SESSION['username'];

// Making array position
$position_praarray = str_replace('-]', '', $position);
$position_array = explode('-', $position_praarray);
$count_position_array = count($position_array);



// Making array cost_center
$cost_center_praarray = str_replace('-]', '', $cost_center);
$cost_center_array = explode('-', $cost_center_praarray);
$count_cost_center_array = count($cost_center_array);

// Making array work_location
$work_location_praarray = str_replace('-]', '', $work_location);
$work_location_array = explode('-', $work_location_praarray);
$count_work_location_array = count($work_location_array);

// Making array job_status
$job_status_praarray = str_replace('-]', '', $job_status);
$job_status_array = explode('-', $job_status_praarray);
$count_job_status_array = count($job_status_array);

// Making array job_title
$job_title_praarray = str_replace('-]', '', $job_title);
$job_title_array = explode('-', $job_title_praarray);
$count_job_title_array = count($job_title_array);

// Making array unique
$unique_praarray = str_replace('-]', '', $unique);
$unique_array = explode('-', $unique_praarray);
$count_unique_array = count($unique_array);

// ALERT
$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);
// ALERT

// get data previous
$sql_data_prev      = mysqli_query($connect, "SELECT * FROM hrmorgessrequest a WHERE a.request_no = '$req_id'");
$data_prev          = mysqli_fetch_assoc($sql_data_prev);
// get data previous

// get pos code
$sql_pos_code       = mysqli_query($connect, "SELECT a.pos_code FROM view_employee a WHERE a.emp_no = '$username'");
$data_pos_code      = mysqli_fetch_assoc($sql_pos_code);
// get pos code

// Proses update
$update     = mysqli_query($connect, "UPDATE `hrmorgessrequest` SET 
`status_approval`='3',
`request_status`='6',
`modified_date`='$SFdatetime',
`modified_by`='$username'
WHERE `request_no` = '$req_id'");

if($req_type == '1'){
for($i = 0; $i < $count_position_array; $i++){
    $update_hrd     = mysqli_query($connect, "UPDATE `hrdorgessrequest` SET 
    `orgpos`='$orgpos_array[$i]',
    `position_name`='$position_array[$i]',
    `cost_center`='$cost_center_array[$i]',
    `work_location`='$work_location_array[$i]',
    `jobtitle_code`='$job_title_array[$i]',
    `jobstatus_code`='$job_status_array[$i]',
    `status_approval`='3',
    `request_status`='6',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `unique` = '$unique_array[$i]'");
}
}else{
    for($i = 0; $i < $count_position_array; $i++){
        $update_hrd     = mysqli_query($connect, "UPDATE `hrdorgessrequest` SET 
        `position_name`='$position_array[$i]',
        `cost_center`='$cost_center_array[$i]',
        `work_location`='$work_location_array[$i]',
        `jobtitle_code`='$job_title_array[$i]',
        `jobstatus_code`='$job_status_array[$i]',
        `status_approval`='3',
        `request_status`='6',
        `modified_date`='$SFdatetime',
        `modified_by`='$username'
        WHERE `unique` = '$unique_array[$i]'");
    }
}

// // Proses Insert log
// $insert     = mysqli_query($connect, "INSERT INTO `hrmorgessrequestlog`
// (`request_no`,   
// `request_by`, 
// `request_date`, 
// `request_division`, 
// `request_department`, 
// `leader_pos`,
// `position_name`,
// `request_type`, 
// `status_approval`,
// `request_status`,
// `request_reason`,
// `request_remark`, 
// `modified_date`,
// `modified_by`) 
// VALUES (
// '$req_id',
// '$data_prev[request_by]',
// '$data_prev[request_date]',
// '$div_position',
// '$dept_position',
// '$data_prev[leader_pos]',
// '$req_position',
// '$data_prev[request_type]',
// '3',
// '6',
// '$data_prev[request_reason]',
// '$data_prev[request_remark]',
// '$SFdatetime',
// '$username'
// )");

$update_req_approval        = mysqli_query($connect, "UPDATE `hrmrequestapprovalessod` SET
`status`='1',
`request_status`='3',
`modified_date`='$SFdatetime'
WHERE `request_no` = '$req_id'
AND `approval_list` = '$data_pos_code[pos_code]'");

if($update_hrd){

    echo $date_alert_success['alert'];

}else{
    echo $date_alert_failed['alert'];
}
 ?>