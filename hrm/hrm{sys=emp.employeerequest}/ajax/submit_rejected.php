<?php 
date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

$request_no     = $_POST['req_no'];

$sql_validasi = mysqli_query($connect, "SELECT a.req, a.approval_list FROM hrmrequestapproval a 
WHERE a.approval_list = (SELECT pos_code FROM view_employee WHERE emp_no = '$username') AND a.request_no = '$request_no'");

$validasi = mysqli_fetch_assoc($sql_validasi);

if($validasi['req'] == 'Notification'){
    $req_status = '2';
}elseif($validasi['req'] == 'Sequence'){
    $req_status = '2';
}elseif($validasi['req'] == 'Required'){
    $req_status = '3';
}

$update     = mysqli_query($connect, "UPDATE `hrmrequestapproval` SET 
    `request_status`='5'
    WHERE `request_no` = '$request_no'");

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($update){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

?>