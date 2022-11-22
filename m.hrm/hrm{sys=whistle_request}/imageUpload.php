<?php 
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}


	if (!empty($_FILES['file'])) {

	    $id = $_GET['id_whitle'];
	    $username = $_GET['username'];


	    $target = "../../asset/request.file.whistleblower.attachment/". $_FILES["file"]["name"];
	    $imageFileType = pathinfo($target,PATHINFO_EXTENSION);
	    $imageFileType = strtolower($imageFileType);

	    $filenames =  $_FILES["file"]["name"];
	    $filesized = $_FILES['file']['size'];

	    move_uploaded_file($_FILES['file']['tmp_name'], $target);

	    echo json_encode(['uploaded' => $target]);

	    $query = mysqli_query($connect, "INSERT INTO `whstm_attachment` 
	    							(
									`request_id`, 
									`file_name`, 
									`file_size`, 
									`file_type`, 
									`created_date`, 
									`created_by`, 
									`modified_date`, 
									`modified_by`, 
									`file_place`, 
									`company_id`
								) VALUES 
									(
										'$id', 
										'$filenames', 
										'$filesized', 
										'$imageFileType',
										'$SFdatetime', 
										'$username', 
										'$SFdatetime', 
										'$username', 
										'upload', 
										'15135')");

	// } else if (!empty($_FILES['file_update'])) {

	// 	$id = $_GET['id_whistle'];
	// 	$username = $_GET['username'];

	//     	$temp = "../../asset/request.file.whistleblower.attachment/";
	// 	if (!file_exists($temp))
	// 	mkdir($temp);
		
	// 	$nama_file       = $_POST[$id];
	// 	$file_update      = $_FILES['file_update']['tmp_name'];
	// 	$ImageName       = $_FILES['file_update']['name'];
	// 	$ImageType       = $_FILES['file_update']['type'];
	// 	$Imagesize       = $_FILES['file_update']['size'];
		
	// 	if (!empty($file_update)){
	// 	$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
	// 	$ImageExt       = str_replace('.','',$ImageExt); // Extension
	// 	$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
	// 	$NewImageName   = str_replace(' ', '', $SFdatetime.'.'.$ImageExt);
		
	// 	move_uploaded_file($_FILES["file_update"]["tmp_name"], $temp.$NewImageName); // Menyimpan file
		
	// 	$query = mysqli_query($connect, "INSERT INTO `whstm_attachment` 
	//     							(
	// 								`request_id`, 
	// 								`file_name`, 
	// 								`file_size`, 
	// 								`file_type`, 
	// 								`created_date`, 
	// 								`created_by`, 
	// 								`modified_date`, 
	// 								`modified_by`, 
	// 								`file_place`, 
	// 								`company_id`
	// 							) VALUES 
	// 								(
	// 									'$id', 
	// 									'$NewImageName', 
	// 									'$Imagesize', 
	// 									'$ImageType',
	// 									'$SFdatetime', 
	// 									'$username', 
	// 									'$SFdatetime', 
	// 									'$username', 
	// 									'upload', 
	// 									'15135')");
	// 	}


	} else {


		echo json_encode(['error'=>'No files found for upload.']); 


	}


?>