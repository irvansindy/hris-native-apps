<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';


!empty($_GET['username']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
	$user = $username;
} else {
	$user = $_GET['username'];
}

require_once '../../../model/eo/GMAuthorizedUserList.php';

$query_list_menu = "SELECT * FROM hrmmenu WHERE submenu_id = 0;";

$output = ['data' => []];

$sql = $query_fetch_authorize_user;

$query = mysqli_query($connect, $query_list_menu);

$number = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$code = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#DetailForm" data-backdrop="static" onclick="DetailAuthorizedUser(`'.$row['menu_id'].'`)">'.$row['menu_id'].'</a>';

	$output['data'][] = array(
		$number,
		$code,
		$row['menu'],
		$row['module'],
		'<a type="button" nowrap="nowrap" id="get_list_sub_menu" data-menuid = "' . $row['menu_id'] . '" data-toggle="modal" data-target="#list_data_sub_menu" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer"> <input type="image" src="../../asset/dist/img/icons/icon-addinfo.png" title="List data sub menu" width="22px"/></a>',
		// '<a type="button" nowrap="nowrap" id="create_sub_menu" data-menuid = "' . $row[$i]['menu_id'] . '" data-toggle="modal" data-target="#form_create_sub_menu" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer"> <input type="image" src="../../asset/dist/img/icons/acticon-note.png" title="Add data sub menu" width="22px"/></a>',
	);
	$number++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP