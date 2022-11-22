<?php
include "../../../application/session/sessionlv2.php";
require_once '../../../application/config.php';
$user = $_GET['username'];
require_once '../../../model/gen_auth_data/_auth_data.php';
require_once '../../../model/eo/GMEmployeeList.php';

$output = array('data' => array());

$sql = $qListRender_srvside;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<img src="../../asset/emp_photos/'.$row['photo'].'" alt="user" class="profile-pic rounded-circle" width="30"> <a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;" onclick="editMember(`'.$row['emp_no'].'`)">'.$row['emp_no'].'</a>  <br> <label style="padding-top: 4px;color: #A5B0B7 !important;">'.$row['Full_Name'].' </label>';

	$output['data'][] = array(
		$rmintf
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP