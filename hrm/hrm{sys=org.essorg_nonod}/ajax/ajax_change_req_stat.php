<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


// ALERT
$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);
// ALERT


$req_id     = $_POST['req_id'];
$code       = $_POST['code'];

// get data previous
$sql_data_prev      = mysqli_query($connect, "SELECT * FROM hrmorgessrequest a WHERE a.request_no = '$req_id'");
$data_prev          = mysqli_fetch_assoc($sql_data_prev);
// get data previous

$update     = mysqli_query($connect, "UPDATE `hrmorgessrequest` SET 
`request_status`='$code',
`modified_date`='$SFdatetime',
`modified_by`='$username'
WHERE `request_no` = '$req_id'");

if($update){
    $insert_log = mysqli_query($connect, "INSERT INTO `hrmorgessrequestlog`
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
    '$req_id',
    '$data_prev[request_by]',
    '$data_prev[request_date]',
    '$data_prev[request_division]',
    '$data_prev[request_department]',
    '$data_prev[leader_pos]',
    '$data_prev[position_name]',
    '$data_prev[request_type]',
    '$data_prev[status_approval]',
    '$code',
    '$data_prev[request_reason]',
    '$data_prev[request_remark]',
    '$SFdatetime',
    '$username'
    )");

    if($insert_log){
        


            echo $date_alert_success['alert'];

        

    }else{
        echo $date_alert_failed['alert'];
    }
}else{
    echo $date_alert_failed['alert'];
}
?>