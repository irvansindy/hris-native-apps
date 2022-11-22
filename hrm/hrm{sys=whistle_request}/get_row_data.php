<?php 
include "../../application/session/session.php";

$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;
//if form is submitted
if($_POST) {	

	

	//========================POST VALUE FORM========================//
	$inp_id              = $_POST['id_chat'];
	//========================POST VALUE FORM========================//


       $whstd_records = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) AS total FROM whstm_chat WHERE _whistle_id = '$inp_id'"));
	$whstd_records_from = mysqli_fetch_array(mysqli_query($connect, "SELECT created_by FROM whstm_chat WHERE _whistle_id = '$inp_id' ORDER BY created_by DESC LIMIT 1"));

	$validator['success'] = false;
	$validator['code'] = "success";
	$validator['messages'] = $whstd_records['total'];
	$validator['whois'] = $whstd_records_from['created_by'];	


	// close the database connection
	$connect->close();
	echo json_encode($validator);
}