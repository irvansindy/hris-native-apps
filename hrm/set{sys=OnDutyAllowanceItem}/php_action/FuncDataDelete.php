<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_item_codeS			= $_POST['sel_item_codeS'];

$get_any_request = mysqli_query($connect, "SELECT item_code FROM hrrondutypurposecomp WHERE item_code = '$sel_item_codeS'");

if(mysqli_num_rows($get_any_request) > 0 ){
	$sql = "DELETE FROM hrmondutyallowitemX";
} else {
	$sql = "DELETE FROM hrmondutyallowitem WHERE item_code = '$sel_item_codeS'";
}

$alert_0          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '8'"));
$alert_print_0    = $alert_0['alert'];
$alert_1          = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '9'"));
$alert_print_1    = $alert_1['alert'];

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

// close database connection
$connect->close();
echo json_encode($validator);