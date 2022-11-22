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

// MENDAPATKAN TANGGAL DIBUAT------------------------------>
// MENDAPATKAN TANGGAL DIBUAT------------------------------>
$get_leave_startdate   		= mysqli_fetch_array(mysqli_query($connect, "SELECT leave_startdate,leave_code,urgent_request,urgent_reason FROM hrmleaverequest WHERE request_no='$get_db_requestno'"));
$get_leave_startdate_print 	= $get_leave_startdate['leave_startdate'];
$get_leave_type_print 		= $get_leave_startdate['leave_code'];
$get_leave_urgent_print 	= $get_leave_startdate['urgent_request'];
$get_leave_urgent_reason_print = $get_leave_startdate['urgent_reason'];
// MENDAPATKAN TANGGAL DIBUAT------------------------------>
// MENDAPATKAN TANGGAL DIBUAT------------------------------>

// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
$val_start_to_current = mysqli_fetch_array(mysqli_query($connect, "SELECT datediff('$get_leave_startdate_print', current_date()) as days"));
$val_start_to_current_print = $val_start_to_current['days'];
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE
// MENDAPATKAN SELISIH ANTARA TANGGAL DIBUAT DAN START LEAVE

//MENDAPATKAN BATAS PENGAJUAN DOKUMEN ATTACHMENT
//MENDAPATKAN BATAS PENGAJUAN DOKUMEN ATTACHMENT
$val_max_upload_day = mysqli_fetch_array(mysqli_query($connect, "SELECT max_upload_file_day FROM hrmvalleaveurgreason WHERE reason_code = '$get_leave_urgent_reason_print'"));
$val_max_upload_day_print = $val_max_upload_day['max_upload_file_day'];
//MENDAPATKAN BATAS PENGAJUAN DOKUMEN ATTACHMENT
//MENDAPATKAN BATAS PENGAJUAN DOKUMEN ATTACHMENT

$alert6                       = mysqli_fetch_array(mysqli_query($connect, "SELECT alert FROM hrmalert WHERE id_alert = '6'"));
$alert_print6                 = $alert6['alert'];

$var1 = array("#request_no");
$var2 = array("$get_db_requestno");
$conversion6 = str_replace($var1, $var2, $alert_print6);

// if($val_start_to_current_print+$val_max_upload_day_print < $val_max_upload_day_print) {
// UPDATE 2021-11-02
if($val_start_to_current_print > $val_max_upload_day_print) {
            echo "<script type='text/javascript'>
                        window.alert('$conversion6');     
                  </script>";  
} else if($size > $val_max_upload_print)
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
                                    
                                                      $query = "INSERT INTO hrmattachment (request_no,`file_name`,file_size,file_type) VALUES
                                                                  ('$get_db_requestno','$target_file_save','$size','$type')";
                                                      $result = mysqli_query($connect, $query);

                                                      echo "<script type='text/javascript'>
                                                                  window.alert('Successfully added attachment');    
                                                            </script>";   
                                                }

            }
      }
}
?>