<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$edit_emp_no = $_POST['edit_emp_no'];
	$edit_certificate_code = $_POST['edit_certificate_code'];
	$edit_certificate_title_en = strtoupper($_POST['edit_certificate_title_en']);
	$edit_certificate_title_id = strtoupper($_POST['edit_certificate_title_id']);
	$edit_certificate_title_th = strtoupper($_POST['edit_certificate_title_th']);
	$edit_certificate_editor_wysiwyg_en = $_POST['edit_certificate_editor_wysiwyg_en'];
	$edit_certificate_editor_wysiwyg_id = $_POST['edit_certificate_editor_wysiwyg_id'];
	$edit_certificate_editor_wysiwyg_th = $_POST['edit_certificate_editor_wysiwyg_th'];
	$date = date('Y-m-d H:i:s');

	$query_update_master_certificate = "UPDATE ttamcertification_template SET 
		`certificate_title_en` = '$edit_certificate_title_en',
		`certificate_title_id` = '$edit_certificate_title_id',
		`certificate_title_th` = '$edit_certificate_title_th',
		`certificate_template_en` = '$edit_certificate_editor_wysiwyg_en',
		`certificate_template_id` = '$edit_certificate_editor_wysiwyg_id',
		`certificate_template_th` = '$edit_certificate_editor_wysiwyg_th',
		`created_by` = '$edit_emp_no',
		`created_date` = '$date',
		`modified_by` = '$edit_emp_no',
		`modified_date` = '$date'
		WHERE certificate_code = '$edit_certificate_code'";

	// $exe_query_master = $connect->query($query_update_master_certificate);

	if($exe_query_master == TRUE) {
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully Update data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed Update data";	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}