<?php 
	error_reporting(0);
	date_default_timezone_set('Asia/Jakarta');
	require_once '../../../application/config.php';

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

	//if form is submitted
	if($_POST) {
		$input_emp_no 	= $_POST['input_emp_no'];
		$input_title = $_POST['input_title'];
		$input_sub_title = $_POST['input_sub_title'];
		$input_seo_title = $_POST['input_seo_title'];
		$input_active_headline = $_POST['input_active_headline'];
		$result_active_headline = $input_active_headline != null ? 1 : 0;
		$input_active_status = $_POST['input_active_status'];
		$result_active_status = $input_active_status != null ? 1 : 0;
		$input_content = $_POST['input_content'];
		$input_information = $_POST['input_information'];
		$get_date = date_create(date());
		$result_day = date_format($get_date,"l");
		$image_news_thumbnail = $_FILES['image_news_thumbnail'];

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
		
		// query create data
		$query_create_news = "INSERT INTO `berita` (
			`id_kategori`,
			`username`,
			`judul`,
			`sub_judul`,
			`youtube`,
			`judul_seo`,
			`headline`,
			`aktif`,
			`utama`,
			`isi_berita`,
			`keterangan_gambar`,
			`hari`,
			`tanggal`,
			`jam`,
			`gambar`,
			`dibaca`,
			`tag`,
			`status`,
			`created_date`,
			`company_id`
		) VALUES (
			0,
			'$input_emp_no',
			'$input_title',
			'$input_sub_title',
			'https://www.youtube.com/',
			'$input_seo_title',
			'$result_active_headline',
			'$result_active_status',
			'Y',
			'$input_content',
			'$input_information',
			'$result_day',
			'$date',
			'$time',
			'$result_file_thumbnail',
			0,
			'0',
			'Y',
			'$date_time',
			'13576'
		)
		";
		$exe_query_master = $connect->query($query_create_news);
		
		if($exe_query_master == TRUE) {						
			$response['success'] = true;
			$response['code'] = "success_message";
			$response['messages'] = "Successfully saved data";			
		} else {		
			$response['success'] = false;
			$response['code'] = "failed_message";
			$response['messages'] = "Failed create news data";
		}

		// close the database connection
		$connect->close();
		header('Content-Type: application/json');
		echo json_encode($response);
		// echo json_encode($data_room);
	}