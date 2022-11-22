<?php
	require_once '../../application/config.php';


  $temp = "../../asset/request.file.whistleblower.attachment/";
  if (!file_exists($temp))
    mkdir($temp);
  

 	$nama_file = $_GET['id_whistle_upload'];
	$username = $_GET['username'];


  $file_update      = $_FILES['file_update']['tmp_name'];
  $ImageName       = $_FILES['file_update']['name'];
  $ImageType       = $_FILES['file_update']['type'];
  $ImageSize       = $_FILES['file_update']['size'];
  
  if (!empty($file_update)){
    $ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
    $ImageExt       = str_replace('.','',$ImageExt); // Extension
    $ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
    $NewImageName   = str_replace(' ', '', $username.$nama_file.$ImageName.'.'.$ImageExt);


  
    move_uploaded_file($_FILES["file_update"]["tmp_name"], $temp.$NewImageName); // Menyimpan file

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
										'$nama_file', 
										'$NewImageName', 
										'$Imagesize', 
										'$ImageType',
										'$SFdatetime', 
										'$username', 
										'$SFdatetime', 
										'$username', 
										'upload', 
										'15135')");
	
  
  
  } else {
    echo "Data Gagal Diupload";
  }
?>