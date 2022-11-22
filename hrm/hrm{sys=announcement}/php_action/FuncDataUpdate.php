<?php 
require_once '../../../application/config.php';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$update_id_berita	= addslashes($_POST['update_id_berita']);
	$update_subject	= addslashes($_POST['update_subject']);
	$editor_update	= addslashes($_POST['editor_update']);
	$inp_emp_no		= $_POST['inp_emp_no'];

	$temp = "../../../asset/request.file.news/";
	if (isset($_FILES['update_fileToUpload']['tmp_name'])) {
	

		$fileupload     = $_FILES['update_fileToUpload']['tmp_name'];
		$ImageName      = $_FILES['update_fileToUpload']['name'];
		$acak           = rand(111111111111111111, 999999999999999999);
		$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt       = str_replace('.','',$ImageExt);
		$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
		$NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);

		move_uploaded_file($fileupload, $temp.$NewImageName);

		if(move_uploaded_file($fileupload, $temp.$NewImageName)){			  
	
				 compressImage($_FILES['update_fileToUpload']['tmp_name'],$temp.$NewImageName,60);	 
		}	

		$update_subject		= strtoupper($_POST['update_subject']);
		$sql_0 = "UPDATE `berita` SET
					
							`judul` 		= '$update_subject',
							`isi_berita`		= '$editor_update',
							`keterangan_gambar`	= '$NewImageName', 
							`gambar`		= '$NewImageName'

						WHERE `id_berita`		= '$update_id_berita'";

	} else {
		$sql_0 = "UPDATE `berita` SET
					
							`judul` 		= '$update_subject',
							`isi_berita`		= '$editor_update'

						WHERE `id_berita`		= '$update_id_berita'";


	}

	
	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message_update";
		$validator['messages'] = "Successfully saved data";			
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data";	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}