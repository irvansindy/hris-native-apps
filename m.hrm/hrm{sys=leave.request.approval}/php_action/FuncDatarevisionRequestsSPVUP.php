<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}


$validator = array('success' => false, 'messages' => array());

$sel_revision_spvup			= $_POST['sel_revision_spvup'];
$sel_revision_remark_spvup		= $_POST['sel_revision_remark_spvup'];

$get_any_request = mysqli_query($connect, "SELECT 
							a.ipp_reqno
							FROM hrdperf_ipprequest a
							LEFT JOIN (
									SELECT 
									request_no,
									MAX(request_status) AS sts
									FROM
									hrmrequestapproval
									WHERE request_status NOT IN ('0','4','8','5')
									GROUP BY request_no
								) rests ON rests.request_no = a.ipp_reqno
								LEFT JOIN hrmstatus d ON d.code = rests.sts
							WHERE a.ipp_reqno = '$sel_revision_spvup'
							AND rests.sts IN ('1','2','3')");

if(mysqli_num_rows($get_any_request) < 1 ){
	$sql = "UPDATE hrmrequestapprovalX";
} else {
	$sql = "UPDATE hrmrequestapproval SET request_status = '4', revised_remark = '$sel_revision_remark_spvup' WHERE request_no = '$sel_revision_spvup'";
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '21'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '22'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);
$query1 = $connect->query($sql1);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message_revision_spv_up";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1  . $sql;			
}

// close database connection
$connect->close();
echo json_encode($validator);