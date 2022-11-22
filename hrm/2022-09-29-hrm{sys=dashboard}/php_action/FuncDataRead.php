<?php
include "../../../application/session/sessionlv2.php";
require_once '../../../application/config.php';
require_once '../../../model/eo/GMEmployeeList.php';

$output = array('data' => array());

$sql = "SELECT *,
			CASE 
				WHEN LENGTH(sub_judul) > 70 THEN CONCAT(SUBSTRING(sub_judul, 1, 70) , '...')
				ELSE sub_judul
			END AS view_content
			FROM berita";

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#NewsDetail" data-backdrop="static" style="color: #9f9f9f; border: 5px; cursor:pointer;font-weight: ;font-size: 11px;font-family: verdana;" onclick="NewsDetail(`'.$row['id_berita'].'`)">'.$row['view_content'].'</a>';

	$output['data'][] = array(
		$rmintf
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);
// KASIH KUTIP TUH DI NIP