<?php

if(isset($_POST["submit_add"]))
{
    $id                     = $_POST['id'];
    $nama                   = $_POST['modal_name'];
    $alamat                 = $_POST['inp_address'];
    // $modal_email            = $_POST['modal_email'];
    $modal_hp               = $_POST['modal_hp'];
    // $modal_asal             = $_POST['modal_asal'];
    // $modal_gender           = $_POST['modal_gender'];
    // $modal_tempatlahir      = $_POST['modal_tempatlahir'];
    // $modal_tanggallahir     = $_POST['modal_tanggallahir'];
    // $modal_provinsi         = $_POST['modal_provinsi'];
    // $modal_kota             = $_POST['modal_kota'];
    
    
    $inp_refdoc_arr         = array();
    foreach($_FILES['inp_refdoc']['name'] as $key=>$val){
        
		$image_name         = $_FILES['inp_refdoc']['name'][$key]; //mengambil nama gambar
		$tmp_name 	        = $_FILES['inp_refdoc']['tmp_name'][$key]; //mengambil tpm/path
		$size 		        = $_FILES['inp_refdoc']['size'][$key]; //mengambil size atau aukuran gambar
		$type 		        = $_FILES['inp_refdoc']['type'][$key]; //mengambil type gambar
		$error 		        = $_FILES['inp_refdoc']['error'][$key];
		
	 $target_dir = "../../asset/emp_photos/"; // tempat menyimpan gambar yang telah di upload
                                    $target_file = $target_dir.$newfilename.$_FILES['inp_refdoc']['name'][$key]; //memanggil data di dalam tempat penyimpanan
                                    $target_file_save = $newfilename.$_FILES['inp_refdoc']['name'][$key]; //memanggil data di dalam tempat penyimpanan
                                    
                                    
	
	if(move_uploaded_file($_FILES['inp_refdoc']['tmp_name'][$key],$target_file)){
                                          $inp_refdoc_arr[] = $target_file; //menyimpan gambar yang telah di simpan ke dalam array $inp_refdoc_array
                        
                                            $query = "UPDATE view_employee SET 
                                                                Full_Name       = '$nama', 
                                                                address         = '$alamat',
                                                                phone           = '$modal_hp',
                                                                photo           = '$target_file_save'
                                                            WHERE emp_no = '$id'";
                                            $query = "UPDATE users SET 
                                                                avatar          = '$target_file_save'
                                       
                                                            WHERE username = '$id'";
                                            $result = mysqli_query($con, $query);
                                    } else {
                                            $query = "UPDATE view_employee SET 
                                                                Full_Name       = '$nama',
                                                                phone           = '$modal_hp',
                                                                address         = '$alamat'
                                                            WHERE emp_no = '$id'";
                                            $result = mysqli_query($con, $query);
                                    }
	
if($query){
  echo"<script type='text/javascript'>
            window.alert('data saved');
            window.location.replace('index.php?userid=$id');         
      </script>";
}
}}
?>