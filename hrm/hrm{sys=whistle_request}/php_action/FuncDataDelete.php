<?php 
require_once '../../../application/config.php';

$validator = array('success' => false, 'messages' => array());

$sel_id_berita			= $_POST['sel_id_berita'];

$sql = "DELETE FROM berita WHERE id_berita = '$sel_id_berita'";

$query = $connect->query($sql);

if($query == TRUE) {						
	$validator['success'] = true;
	$validator['code'] = "success_message_delete";
	$validator['messages'] = "Successfully delete data";			
} else {		
	$validator['success'] = false;
	$validator['code'] = "failed_message_delete";
	$validator['messages'] = "Failed to delete data";	
}

// close database connection
$connect->close();
echo json_encode($validator);