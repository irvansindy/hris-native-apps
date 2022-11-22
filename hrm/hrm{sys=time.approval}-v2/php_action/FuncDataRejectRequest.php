<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_reject_request			= $_POST['sel_reject_request'];
$sel_emp_no_approver			= $_POST['sel_emp_no_approver'];

$get_data_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT position_id FROM view_employee WHERE emp_no = '$sel_emp_no_approver'"));
$get_data_print_0    = $get_data_0['position_id'];
	
$sql = "UPDATE `hrmrequestapproval` SET
					`status` 		= '1'
				WHERE
					`request_no` 		= '$sel_reject_request' AND
					`position_id`		= '$get_data_print_0'";

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '23'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '24'"));
$alert_print_1    = $alert_1['alert'];

$query = $connect->query($sql);

if($query == TRUE) {

	$get_any_request = mysqli_query($connect, "SELECT 
							a.request_no
							FROM hrmleaverequest a
							LEFT JOIN (
												SELECT 
												request_no,
												MAX(request_status) AS sts
												FROM
												hrmrequestapproval
												WHERE request_status NOT IN ('0','4','8','5')
												GROUP BY request_no
											) rests ON rests.request_no = a.request_no
											LEFT JOIN hrmstatus d ON d.code = rests.sts
							WHERE a.request_no = '$sel_reject_request'
							AND rests.sts IN ('1','2')");
	
	if(mysqli_num_rows($get_any_request) < 1 ){
		$sql1 = "UPDATE hrmrequestapprovalX";
	} else {
		$sql1 = "UPDATE hrmrequestapproval SET request_status = '5' WHERE request_no = '$sel_reject_request'";
	}
	$query = $connect->query($sql1);

	$validator['success'] = true;
	$validator['code'] = "success_message_reject_request";
	$validator['messages'] = $alert_print_0;			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message";
	$validator['messages'] = $alert_print_1;			
}

// close database connection
$connect->close();
echo json_encode($validator);