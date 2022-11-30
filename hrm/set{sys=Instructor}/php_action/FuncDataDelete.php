<?php 
	require_once '../../../application/config.php';

	$validator = array('success' => false, 'messages' => array());

	$instructor_code = $_POST['delete_instructor_code'];

	$query_delete_instructor_master = "DELETE FROM `trninstructor` WHERE `instructor_code` = '$instructor_code'";
	$query_delete_instructor_detail = "DELETE FROM `trndinstructor` WHERE `instructor_code` = '$instructor_code'";

	$execute_delete_master = $connect->query($query_delete_instructor_master);
	$execute_delete_detail = $connect->query($query_delete_instructor_detail);

	// if(mysqli_num_rows($get_any_request) > 0 ){
	// 	$sql = "DELETE FROM hrmondutypurposetypeX";
	// } else {
	// 	$sql = "DELETE FROM hrmondutypurposetype WHERE purpose_code = '$sel_purpose_codeS'";
	// 	$sqls = mysqli_query($connect, "DELETE FROM hrrondutypurposecomp WHERE purpose_code = '$sel_purpose_codeS'");
	// }

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
	$alert_print_1    = $alert_1['alert'];

	// $query = $connect->query($sql);

	if($execute_delete_master == TRUE && $execute_delete_detail == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1;			
	}

	// close database connection
	$connect->close();
	echo json_encode($validator);