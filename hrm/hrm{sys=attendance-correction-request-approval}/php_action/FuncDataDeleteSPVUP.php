<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}


$validator = array('success' => false, 'messages' => array());

$sel_ipp_reqnoS			= $_POST['sel_ipp_reqnoS'];

$get_any_request = mysqli_query($connect, "SELECT ipp_reqno FROM hrrondutypurposecomp WHERE ipp_reqno = '$sel_ipp_reqnoS'");

if(mysqli_num_rows($get_any_request) > 0 ){
	$sql = "DELETE FROM hrmperf_ipprequestX";
} else {
	$sql = "DELETE FROM hrmperf_ipprequest WHERE ipp_reqno = '$sel_ipp_reqnoS'";
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message_delete_spv_up";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1;			
}

// close database connection
$connect->close();
echo json_encode($validator);