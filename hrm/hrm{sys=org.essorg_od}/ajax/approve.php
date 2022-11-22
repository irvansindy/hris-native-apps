<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year                   = date("Y");
$yea                    = substr($year, 0, 3);

include "../../../application/session/session_ess.php";
$req_id           = $_POST['req_id'];
$div_position     = $_POST['div_id'];
$dept_position    = $_POST['dept_id'];
$req_position     = $_POST['req_position'];
$cost_center      = $_POST['cc'];
$worklocation     = $_POST['worklocation'];
$jobstatus        = $_POST['jobstatus'];
$jobtitle         = $_POST['jobtitle'];
$username         = $_SESSION['username'];

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
`request_division`='$div_position',
`request_department`='$dept_position',
`position_name`='$req_position',
`status_approval`='3',
`request_status`='6',
`modified_date`='$SFdatetime',
`modified_by`='$username'
WHERE `request_no` = '$req_id'");

$update_struc    = mysqli_query($connect, "UPDATE `hrmorgessrequeststruc` SET 
`head_div`='$div_position',
`dept_id`='$dept_position',
`pos_name_en`='$req_position',
`costcenter_code`='$cost_center',
`lstworklocation`='$worklocation',
`jobstatuscode`='$jobstatus',
`jobtitle_code`='$jobtitle',
`approver`='3',
`modified_date`='$SFdatetime',
`modified_by`='$username'
WHERE `req_no` = '$req_id'");

// Proses Insert log
$insert     = mysqli_query($connect, "INSERT INTO `hrmorgessrequestlog`
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
'$div_position',
'$dept_position',
'$data_prev[leader_pos]',
'$req_position',
'$data_prev[request_type]',
'3',
'6',
'$data_prev[request_reason]',
'$data_prev[request_remark]',
'$SFdatetime',
'$username'
)");

$update_req_approval        = mysqli_query($connect, "UPDATE `hrmrequestapprovalessod` SET
`status`='1',
`request_status`='3',
`modified_date`='$SFdatetime'
WHERE `request_no` = '$req_id'
AND `approval_list` = '$data_pos_code[pos_code]'");

if($insert){

    echo $date_alert_success['alert'];

}else{
    echo $date_alert_failed['alert'];
}
 ?>