<?php
	include "../../../application/session/sessionlv2.php";
	require_once '../../../application/config.php';


	!empty($_GET['username']) ? $getdata = '1' : $getdata = '0';
	if ($getdata == 0) {
		$user = $username;
	} else {
		$user = $_GET['username'];
	}

	// require_once '../../../model/eo/GMAuthorizedUserList.php';

	$output = [
		'data' => []
	];

	$query_get_data = "SELECT a.*, b.admin_type_name,
						CASE
							WHEN a.active_status = '1' THEN 'tick.png'
							ELSE 'inactive.png'
						END AS authorize_status,
						CASE
							WHEN a.verification = '1' THEN 'tick.png'
							ELSE 'inactive.png'
						END AS authorize_verify
	
						FROM hrmfunctionauthorization a
							LEFT JOIN hrmadmintype b
							ON a.id_admin_type = b.id";

	$query = mysqli_query($connect, $query_get_data);

	$number = 1;
	while ($row = mysqli_fetch_assoc($query)) {

		$code = '<a type="button" href="" nowrap="nowrap" data-toggle="modal" data-target="#DetailForm" data-backdrop="static" onclick="DetailFunctionAuthorization(`'.$row['id'].'`)">'.$row['name'].'</a>';

		$output['data'][] = array(
			$number,
			$code,
			$row['description'],
			$row['admin_type_name'],
			"<img src='../../asset/dist/img/$row[authorize_status]'/>",
			"<img src='../../asset/dist/img/$row[authorize_verify]'/>",
			"<img src='../../asset/dist/img/$row[authorize_status]'/>",
			"<img src='../../asset/dist/img/$row[authorize_verify]'/>",
		);

		$number++;
	}

	// database connection close
	$connect->close();
	// header('Content-Type: application/json');
	echo json_encode($output);

	// KASIH KUTIP TUH DI NIP