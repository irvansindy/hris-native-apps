<?php 
require_once '../../../application/config.php';
$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {

	$sel_whistle_requestno	= addslashes($_POST['sel_whistle_requestno']); 
	$sel_emp_id			= addslashes($_POST['sel_emp_id']);
	$sel_title			= addslashes($_POST['sel_title']);
	$sel_category			= $_POST['sel_category'];
	$sel_startdate		= date("Y-m-d", strtotime($_POST['sel_startdate']));
	$sel_emp_no			= substr($_POST['employee'],1,7);

	

	$validator = array('success' => false, 'messages' => array());

	

	if(isset($_POST['sel_anonymous'])) {
		$sel_anonymous			= 'Y';
	} else {
		$sel_anonymous			= 'N';
	}
	

	$sql_0 			= "UPDATE whstd_request SET 
							category = '$sel_category',
							`anonymous` = '$sel_anonymous'
							WHERE _id_whistle = '$sel_whistle_requestno'";

	$get_attachment = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS total FROM whstm_attachment WHERE request_id = '$sel_whistle_requestno'"));
	
	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE && $get_attachment['total'] > 0) {						
		$validator['success'] = true;
		$validator['code'] = "success_message_update";
		$validator['messages'] = "Successfully update whistle blowing";
		
	} else if($query_0 == TRUE && $get_attachment['total'] == 0) {						
		$validator['success'] = false;
		$validator['code'] = "failed_message_without_attachment";
		$validator['messages'] = "Please upload your attachment before";
		
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data";	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
