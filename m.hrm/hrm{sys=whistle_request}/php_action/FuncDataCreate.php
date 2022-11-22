<?php 
require_once '../../../application/config.php';
$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_emp_id			= addslashes($_POST['inp_emp_id']);
	$inp_title			= addslashes($_POST['inp_title']);
	$inp_category			= $_POST['inp_category'];
	$inp_startdate		= date("Y-m-d", strtotime($_POST['inp_startdate']));
	$inp_emp_no			= substr($_POST['employee'],1,7);
	$SFnumbercon         	= $_POST['inp_whistle_requestno'];
	$inp_address			= addslashes($_POST['inp_address']);

	if(isset($_POST['anonymous'])) {
		$anonymous			= 'Y';
	} else {
		$anonymous			= 'N';
	}
	

	$sql_0 			= "INSERT INTO `whstd_request` 
						(
							`_id_whistle`, 
							`category`, 
							`title`, 
							`whistle_description`, 
							`suspecter`, 
							`spectator`, 
							`reported_date`, 
							`created_by`,
							`created_date`, 
							`modified_by`, 
							`modified_date`,
							`anonymous`
						) VALUES 
							(
								'$SFnumbercon', 
								'$inp_category', 
								'$inp_title', 
								'$inp_address', 
								'$inp_emp_no', 
								'$inp_emp_id', 
								'$inp_startdate', 
								'$inp_emp_id', 
								'$SFdatetime', 
								'$inp_emp_id', 
								'$SFdatetime',
								'$anonymous')";

	$get_attachment = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS total FROM whstm_attachment WHERE request_id = '$SFnumbercon'"));

	
	
	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE && $get_attachment['total'] > 0) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully submit whistle blowing";
		
	} else if($query_0 == TRUE && $get_attachment['total'] == 0) {						
		$validator['success'] = false;
		$validator['code'] = "failed_message_without_attachment";
		$validator['messages'] = "Please upload your attachment before";

		$delete = mysqli_query($connect, "DELETE FROM whstd_request WHERE _id_whistle = '$SFnumbercon'");
		
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
