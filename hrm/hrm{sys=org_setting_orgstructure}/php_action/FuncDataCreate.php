<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	include "../../../application/session/sessionlv2.php";
} else {
	include "../../../application/session/mobile.session.php";
}

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if ($_POST) {

	$validator = array('success' => false, 'messages' => array());

	$SFdate         		= date("Y-m-d");
	$SFtime         		= date('h:i:s');
	$SFdatetime     		= date("Y-m-d H:i:s");
	$SFnumber       		= date("YmdHis");
	$SFnumber_1       		= date("Ymd");

	$inp_parent				= addslashes($_POST['inp_parent']);
	$inp_parent_arrays 		= explode("#",$inp_parent);

	$inp_employee			= addslashes($_POST['inp_employee']);
	$inp_employee_arrays 	= explode("#",$inp_employee);

	//OBJECT ORIENTED STYLE
	$query 					= "SELECT max(position_id)+1 as rn, max(pos_code)+1 as pn FROM hrmorgstrucdev";
	$result 				= $connect->query($query);
	$row 					= $result->fetch_array(MYSQLI_ASSOC);
	$arr_0 					= $row["rn"];
	$arr_1 					= $row["pn"];
	//OBJECT ORIENTED STYLE

	//OBJECT ORIENTED STYLE
	$query_pp 				= "SELECT parent_path FROM hrmorgstrucdev WHERE position_id = $inp_parent_arrays[0]";
	$result_pp 				= $connect->query($query_pp);
	$row_pp 				= $result_pp->fetch_array(MYSQLI_ASSOC);
	$arr_pp_0 				= $row_pp["parent_path"] . "," . $inp_parent_arrays[0] . "," . $arr_0;
	//OBJECT ORIENTED STYLE

	if($_POST['inp_pos_flag'] == '1') {
		$flag_add 				= '1';
		$inp_unit_name			= addslashes($_POST['inp_unit_name'] . ' (' . $arr_0 . ')');
		$org_status					= 'Add';
	} else if ($_POST['inp_pos_flag'] == '2') {
		$flag_add 				= '0';
		$inp_unit_name			= addslashes($_POST['inp_unit_name'] . ' (' . $arr_0 . ')');
		$org_status					= 'Vacant';
	} else {
		$flag_add 				= '0';
		$inp_unit_name			= addslashes($_POST['inp_unit_name'] . ' (' . $arr_0 . ')');
		$org_status					= '';
	}

	$sql_0 = "INSERT INTO `hrmorgstrucdev`
								(
									`position_id`, 
									`pos_code`, 
									`pos_name_en`, 
									`parent_id`, 
									`parent_path`, 
									`emp_no`,
									`flag_add`, 
									`org_status`
								) 
									VALUES 
										(
											'$arr_0', 
											'$arr_1',
											'$inp_unit_name',
											'$inp_parent_arrays[0]', 
											'$arr_pp_0', 
											'$inp_employee_arrays[0]', 
											'$flag_add', 
											'$org_status'
										)";

	$query_0 = $connect->query($sql_0);

	if ($query_0 == TRUE) {
		$validator['success'] = false;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully submit request";
	} else {
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Wrong approval formula for some employee ";
	}

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}
