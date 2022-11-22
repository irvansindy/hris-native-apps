<?php
if (isset($_POST['submit_add_attachment'])) {

date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;

$get_db_requestno       = $_POST['db_requestno'];

$inp_refdoc_arr         = array();
	//looping data gambar
foreach($_FILES['inp_refdoc']['name'] as $key=>$val){
		$image_name       = $_FILES['inp_refdoc']['name'][$key]; //mengambil nama gambar
		$tmp_name 	      = $_FILES['inp_refdoc']['tmp_name'][$key]; //mengambil tpm/path
		$size 		= $_FILES['inp_refdoc']['size'][$key]; //mengambil size atau aukuran gambar
		$type 		= $_FILES['inp_refdoc']['type'][$key]; //mengambil type gambar
		$error 		= $_FILES['inp_refdoc']['error'][$key]; //menggambil error gambil bila ada

		$newfilename      = date('dmYHis');

/**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE
$val_max_upload               = mysqli_fetch_array(mysqli_query($connect, "SELECT var2 FROM db_config_str WHERE id = '12'"));
$val_max_upload_print         = $val_max_upload['var2'];

$alert5                       = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '5'"));
$alert_print5                 = $alert5['alert'];

$var1 = array("#max_upload_size");
$var2 = array("$val_max_upload_print");
$conversion = str_replace($var1, $var2, $alert_print5);


if($size > $val_max_upload_print)
            {
                  echo "<script type='text/javascript'>
                              window.alert('$conversion your file Size $size KByte');     
                        </script>";   
           
} else {
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE
//VALIDASI APAKAH FILE DIIJINKAN SECARA SIZE
$target_dir = "../../asset/request.file.attachment/"; // tempat menyimpan gambar yang telah di upload
                                    $target_file = $target_dir.$_FILES['inp_refdoc']['name'][$key]; //memanggil data di dalam tempat penyimpanan
                                    $target_file_save = $_FILES['inp_refdoc']['name'][$key]; //memanggil data di dalam tempat penyimpanan
                                    
                                    if(move_uploaded_file($_FILES['inp_refdoc']['tmp_name'][$key],$target_file)){
                                          $inp_refdoc_arr[] = $target_file; //menyimpan gambar yang telah di simpan ke dalam array $inp_refdoc_array
                        
                                          $query = "INSERT INTO hrmattachment (request_no,file_name,file_size,file_type) VALUES
                                                      ('$get_db_requestno','$target_file_save','$size','$type')";
                                          $result = mysqli_query($connect, $query);
                                    }


}
}
}
?>