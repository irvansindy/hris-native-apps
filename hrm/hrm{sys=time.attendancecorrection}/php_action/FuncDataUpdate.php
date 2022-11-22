<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp			= strtoupper($_POST['sel_emp']);
	$sel_attend_id		= strtoupper($_POST['sel_attend_id']);
	$sel_remark 			= strtoupper($_POST['sel_remark']);
	

	$sql = "INSERT INTO `hrdattcorrection` 
					(
						`attend_id`, 
						`remark_in`, 
						`remark_out`, 
						`created_date`, 
						`created_by`, 
						`modified_date`,
						`modified_by`
					)
					 	VALUES 
						 	(
								 '$sel_attend_id', 
								 '$sel_remark', 
								 '$sel_remark', 
								 '$SFdatetime', 
								 'sel_emp', 
								 '$SFdatetime',
								 'sel_emp'
							)
							ON DUPLICATE KEY UPDATE
								`remark_in`		= '$sel_remark', 
								`remark_out`		= '$sel_remark', 
								`modified_date`	= '$SFdatetime',
								`modified_by`		= '$sel_emp'
							";

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '10'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '11'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query = $connect->query($sql);

	if($query == TRUE) {
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = $alert_print_0;			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = $alert_print_1 . $sql;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}