<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$sel_employee		= strtoupper($_POST['sel_employee']);
	

	$get_company			= mysqli_fetch_array(mysqli_query($connect, "SELECT company_id FROM view_employee WHERE emp_no = '$sel_employee'"));

	
	
	$sql_0 = "DELETE FROM `users_menu_access` WHERE `emp_no` = '$sel_employee'";
	$query_0 = $connect->query($sql_0);	

	for($iemg=0;$iemg<count($_POST['sel_application_menu']);$iemg++){
		$iemg_plus = $iemg+1;
		$sel_application_menu	= $_POST['sel_application_menu'][$iemg];
		
		if($sel_application_menu!==''){
	 
			$sql_1 = "INSERT INTO `users_menu_access` 
										(
											`emp_no`, 
											`formula`, 
											`company_id`
										) 
											VALUES 
												(
													'$sel_employee',
													'$sel_application_menu', 
													'$get_company[company_id]'
													
												)
			";

			
			$query_1 = $connect->query($sql_1);	

			$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
			$alert_print_0    = $alert_0['alert'];
			$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
			$alert_print_1    = $alert_1['alert'];

				if($query_1 == TRUE) {						
					$validator['success'] = true;
					$validator['code'] = "success_message";
					$validator['messages'] = $alert_print_0;			
				} else {		
					$validator['success'] = false;
					$validator['code'] = "failed_message";
					$validator['messages'] = $alert_print_1.  $sql_0;
				}
	 
		} else {	
			
			$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
			$alert_print_0    = $alert_0['alert'];
			$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '7'"));
			$alert_print_1    = $alert_1['alert'];
			
			$validator['success'] = false;
			$validator['code'] = "failed_message";
			$validator['messages'] = $alert_print_1 . $sql_0;	
		}
	}

	
	// close the database connection
	$connect->close();
	echo json_encode($validator);
}