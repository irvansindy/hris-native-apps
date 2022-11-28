<?php 
	require_once '../../../application/config.php';
	include "../../../model/st/GMOndtPurposeTypeSearchGen.php";
	include "../../../model/st/GMOndtPurposeType.php";

	$output = array('data' => array());

	// $sql = $qListRender;
	$getDataInstructor = "SELECT * FROM trninstructor";

	$query = mysqli_query($connect, $getDataInstructor);

	$x = 1;
	while ($row = mysqli_fetch_assoc($query)) {

		$rmintf = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editMember(`'.$row['instructor_code'].'`)"><u>'.$row['instructor_code'].'</u></a>   ';

		$prn = '<a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FormDisplayDelete" data-backdrop="static" style="color: blue; border: 5px; cursor:pointer" onclick="editdelMember(`'.$row['instructor_code'].'`)"> <input type="image" src="../../asset/dist/img/ios7-close-outline.png" title="delete" width="22px"/></a>';

		$output['data'][] = array(
			$x,
			$rmintf,
			$row['instructor_name'],
			// $row['instructorcodeext'],
			$prn
			// instructor_code,instructor_name,instructorcodeext
		);

		$x++;
	}

	// database connection close
	$connect->close();
	echo json_encode($output);

// KASIH KUTIP TUH DI NIP