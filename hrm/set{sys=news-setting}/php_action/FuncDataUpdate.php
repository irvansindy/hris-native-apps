<?php 
require_once '../../../application/config.php';

//if form is submitted
if($_POST) {

	// format response json
	$response = [
        'success' => false,
        'code' => [],
        'messages' => []
    ];

	// set time
    $date = date("Y-m-d");
    $time = date('h:i:s');
    $date_time = date("Y-m-d H:i:s");
    $random_number = date("YmdHis");

	// directory file
	$directory_file = '../../../asset/request.file.attachment/';
	// allowed file types
    $allow_types = array('jpg', 'png', 'jpeg');

	$edit_emp_no = $_POST['edit_emp_no'];
	$edit_id_berita = $_POST['edit_id_berita'];
	$edit_title = $_POST['edit_title'];
	$edit_sub_title = $_POST['edit_sub_title'];
	$edit_seo_title = $_POST['edit_seo_title'];
	$edit_active_headline = $_POST['edit_active_headline'];
	$result_active_headline = $edit_active_headline != null ? 1 : 0;
	$edit_active_status = $_POST['edit_active_status'];
	$result_active_status = $edit_active_status != null ? 1 : 0;
	$edit_content = $_POST['edit_content'];
	$edit_information = $_POST['edit_information'];
	$get_date = date_create(date());
	$result_day = date_format($get_date,"l");
	$image_news_thumbnail = $_FILES['image_news_thumbnail'];
	// $date = date('Y-m-d H:i:s');

	if (!empty($image_news_thumbnail)) {
		$file_name = $_FILES['image_news_thumbnail']['name'];
		$file_upload = $_FILES['image_news_thumbnail']['tmp_name'];
		
		// get uploaded file's extension
		$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

		// can upload same image using rand function
		$final_image = rand(1000,1000000).$file_name;

		if (in_array($ext, $allow_types)) {
			$final_file = $directory_file.strtolower($final_image);
	
			$info_file = getimagesize($file_upload);
		}
		// destination upload file
		$upload_file = move_uploaded_file($file_upload, $final_file);
	}

	$result_file_thumbnail = $final_file != '' ? $final_file : NULL;

	$query_update_data = "UPDATE berita SET 
		`id_kategori` = 0,
		`username` = '$edit_emp_no',
		`judul` = '$edit_title',
		`sub_judul` = '$edit_sub_title',
		`youtube` = 'https://www.youtube.com/',
		`judul_seo` = '$edit_seo_title',
		`headline` = '$result_active_headline',
		`aktif` = '$result_active_status',
		`utama` = 'Y',
		`isi_berita` = '$edit_content',
		`keterangan_gambar` = '$edit_information',
		`hari` = '$result_day',
		`tanggal` = '$date',
		`jam` = '$time',
		`gambar` = '$result_file_thumbnail',
		`dibaca` = '0',
		`tag` = '0',
		`status` = 'Y',
		`created_date` = '$date_time',
		`company_id` = '13576'
	WHERE id_berita = '$edit_id_berita'";

	$exe_query_data = $connect->query($query_update_data);

	if($exe_query_data == TRUE) {
		$response['success'] = true;
		$response['code'] = "success_message";
		$response['messages'] = "Successfully Update data";			
	} else {		
		$response['success'] = false;
		$response['code'] = "failed_message";
		$response['messages'] = "Failed Update data";	
	}
	// condition ends

	// close the database connection
	$connect->close();
	// header('Content-Type: application/json');
	echo json_encode($response);
}