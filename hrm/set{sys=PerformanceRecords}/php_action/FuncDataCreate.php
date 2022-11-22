<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	
	// $period		= $_POST['period'].'_'.$_POST['nip'].$flag;
	// $nip		= $_POST['nip'];
	// $org		= $_POST['org'];
	// $emp		= $_POST['emp'];
	// $grp		= $_POST['grp'];
	// $jobstatus	= $_POST['jobstatus'];
	// $amount 	= str_replace("." , "", $_POST['amount']);
	// $note		= $_POST['note'];
	$inp_emp_no 			= strtoupper($_POST['inp_emp_no']);
	$inp_token 			= strtoupper($_POST['inp_token']);

	$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$inp_emp_no'"));

	$inp_category_code		= strtoupper($_POST['inp_category_code']);
	$inp_category_name_en 	= strtoupper($_POST['inp_category_name_en']);
	$inp_category_name_id 	= strtoupper($_POST['inp_category_name_id']);

	$sql_0 = "INSERT INTO `hrmondutyallowcat` 
					(
						`category_code`, 
						`category_name_en`,
						`category_name_id`,
						`category_name_my`,
						`category_name_th`,
						`category_order`,
						`company_id`,
						`created_by`,
						`created_date`,
						`modified_by`,
						`modified_date`
					)
						VALUES
							(
								'$inp_category_code',
								'$inp_category_name_en',
								'$inp_category_name_id',
								'$inp_category_name_en',
								'$inp_category_name_en',
								NULL,
								'$get_company[company_id]',
								'$inp_emp_no',
								'$SFdatetime',
								'$inp_emp_no',
								'$SFdatetime'
							)";

	$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
	$alert_print_0    = $alert_0['alert'];
	$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
	$alert_print_1    = $alert_1['alert'];

	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {						
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