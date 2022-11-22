<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_reject_spvup			= $_POST['sel_reject_spvup'];
$sel_emp_no_approver			= $_POST['sel_emp_no_approver'];

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
$get_data_print_0    = $get_data_0['position_id'];
	
$sql = "UPDATE `hrmrequestapproval` SET
					`status` 		= '1'
				WHERE
					`request_no` 		= '$sel_reject_spvup'";


$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '23'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '24'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);

if($query == TRUE) {

	$get_any_request = mysqli_query($connect, "SELECT 
							a.ipp_reqno
							FROM hrdperf_ipprequest a
							LEFT JOIN (
												SELECT 
												request_no,
												MAX(request_status) AS sts
												FROM
												hrmrequestapproval
												WHERE request_status IN ('1')
												GROUP BY request_no
											) rests ON rests.request_no = a.ipp_reqno
											LEFT JOIN hrmstatus d ON d.code = rests.sts
							WHERE ipp_reqno = '$sel_reject_spvup'
							AND rests.sts IN ('1')");
	
	if(mysqli_num_rows($get_any_request) < 1 ){
		$sql1 = "UPDATE hrmrequestapprovalX";
		$sql0 = "UPDATE hrmperf_ipprequestX";
	} else {
		$sql1 = "UPDATE hrmrequestapproval SET request_status = '8' WHERE request_no = '$sel_reject_spvup'";
		$sql0 = "UPDATE hrmperf_ipprequest SET `status` = '8', `token` = '$SFdatetime' WHERE ipp_reqno = '$sel_reject_spvup'";
	}
	$query = $connect->query($sql1);
	$query = $connect->query($sql0);

	$validator['success'] = true;
	$validator['code'] = "success_message_cancel_spv_up";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1;			
}

// close database connection
$connect->close();
echo json_encode($validator);