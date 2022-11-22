<?php 
require_once '../../../application/config.php';
include "../../../model/etc/GMOtherMediaListSearchGen.php";
include "../../../model/etc/GMOtherMediaList.php";

$output = array('data' => array());

$sql = $qListRenderAll;

$query = mysqli_query($connect, $sql);

$x = 1;
while ($row = mysqli_fetch_assoc($query)) {

	$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['id_berita'].'`)"><u>'.$row['judul'].'</u></a>   ';

	$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['id_berita'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" style="width: 20px;" title="delete" width="22px"/></a>';

	$output['data'][] = array(
		$x,
		$rmintf,
		$prn
	);

	$x++;
}

// database connection close
$connect->close();
echo json_encode($output);

// KASIH KUTIP TUH DI NIP