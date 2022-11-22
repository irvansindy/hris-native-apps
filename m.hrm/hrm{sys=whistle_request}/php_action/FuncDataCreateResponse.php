<?php 
require_once '../../../application/config.php';
$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_whistle_request			= addslashes($_POST['inp_whistle_request']);
	$inp_emp_no			= addslashes($_POST['inp_emp_no']);
	$inp_address			= addslashes($_POST['inp_address']);
	$inp_status			= addslashes($_POST['inp_status']);

	$status = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM hrmstatus WHERE code = '$inp_status'"));


	// $inp_title			= addslashes($_POST['inp_title']);
	// $inp_category			= $_POST['inp_category'];
	// $inp_startdate		= date("Y-m-d", strtotime($_POST['inp_startdate']));
	// $inp_emp_no			= substr($_POST['employee'],1,7);
	// $SFnumbercon         	= $_POST['inp_whistle_requestno'];
	

	// if(isset($_POST['anonymous'])) {
	// 	$anonymous			= 'Y';
	// } else {
	// 	$anonymous			= 'N';
	// }
	

	$sql_0 			= "INSERT INTO `whstm_pic_response` 
						(
							`_id_whistle`, 
							`messages`
						) VALUES 
							(
								'$inp_whistle_request', 
								'$inp_address')";

	$sql_1 			= "UPDATE whstd_request SET whistle_status = '$inp_status' WHERE _id_whistle='$inp_whistle_request'";
	$sql_2 			= "INSERT INTO `whstm_chat` 
							(
								`id_chat`, 
								`_whistle_id`, 
								`message`, 
								`flag`, 
								`created_date`, 
								`company_id`, 
								`created_by`
							) VALUES (
								'$inp_whistle_request', 
								'$inp_whistle_request', 
								'Your request status change to $status[name_en]', 
								'3', 
								'$SFdatetime', 
								'15135' , 
								'$username')";






	
	
	// condition start
	$query_0 = $connect->query($sql_0);
	$query_1 = $connect->query($sql_1);
	$query_2 = $connect->query($sql_2);

	if($query_0 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully submit whistle blowing";
		
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
