<?php
include "../../../application/session/sessionlv2.php";
require_once '../../../application/config.php';


!empty($_GET['username']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	$user = $username;
} else {
	$user = $_GET['username'];
}

require_once '../../../model/eo/GMAuthorizedUserList.php';

$output = array('data' => array());

$sql = $query_fetch_authorize_user;

$query = mysqli_query($connect, $sql);

$number = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$code = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#DetailForm" data-backdrop="static" onclick="DetailAuthorizedUser(`'.$row['users_menu_name'].'`)">'.$row['users_menu_name'].'</a>';

	$output['data'][] = array(
		$number,
		$code,
		$row['group_type'],
		'<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#AddUserEmployee" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="AddEmployee(`' . $row['users_menu_name'] . '`)"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="add employee" width="22px"/></a>',
		"<img src='../../asset/dist/img/$row[authorize_status]'/>",
	);

	$number++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP