<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_emp_no			= strtoupper($_POST['sel_emp_no']);
	$sel_category_code		= strtoupper($_POST['sel_category_code']);
	$sel_category_name_en 	= strtoupper(addslashes($_POST['sel_category_name_en']));
	$sel_category_name_id 	= strtoupper(addslashes($_POST['sel_category_name_id']));
	


	$sql = "UPDATE hrmondutyallowcat SET 
					`category_name_en`	= '$sel_category_name_en',
					`category_name_id` 	= '$sel_category_name_id',
					`category_name_my`	= '$sel_category_name_en',
					`category_name_th`	= '$sel_category_name_en'
				WHERE category_code 		= '$sel_category_code'";

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
		$validator['messages'] = $alert_print_1;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}