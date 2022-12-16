<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$input_emp_no 	= $_POST['input_emp_no'];
	$input_certificate_code = $_POST['input_certificate_code'];
	$input_certificate_title_en = strtoupper($_POST['input_certificate_title_en']);
	$input_certificate_title_id = strtoupper($_POST['input_certificate_title_id']);
	$input_certificate_title_th = strtoupper($_POST['input_certificate_title_th']);
	$input_certificate_editor_wysiwyg_en = $_POST['input_certificate_editor_wysiwyg_en'];
	$input_certificate_editor_wysiwyg_id = $_POST['input_certificate_editor_wysiwyg_id'];
	$input_certificate_editor_wysiwyg_th = strtoupper($_POST['input_certificate_editor_wysiwyg_th']);

	$date = date('Y-m-d H:i:s');

	$query_master_certificate = "INSERT INTO `ttamcertification_template` (
		`certificate_code`,
		`certificate_title_en`,
		`certificate_title_id`,
		`certificate_title_th`,
		`certificate_template_en`,
		`certificate_template_id`,
		`certificate_template_th`,
		`created_by`,
		`created_date`,
		`modified_by`,
		`modified_date`
	) VALUES (
		'$input_certificate_code',
		'$input_certificate_title_en',
		'$input_certificate_title_id',
		'$input_certificate_title_th',
		'$input_certificate_editor_wysiwyg_en',
		'$input_certificate_editor_wysiwyg_id',
		'$input_certificate_editor_wysiwyg_th',
		'$input_emp_no',
		'$date',
		'$input_emp_no',
		'$date'
	)
	";
	$exe_query_master = $connect->query($query_master_certificate);
	
	if($exe_query_master == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data";
	}

	// close the database connection
	$connect->close();
	echo json_encode($validator);
	// echo json_encode($data_room);
}