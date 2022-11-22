<?php 
require_once '../../../application/config.php';

define('API_ACCESS_KEY','AAAAWJj5kOQ:APA91bG3yQn6l19B-IFBgH3BW3mwp7AGe896u-Dm5hDpszC5ysmhEBhhUSYepZlFRaj5RxGnVylSsus4qXRxm8WGgFizqm6vxTLO7htOAQrEqEbJp4-Lkjo3hSqhayvIpMz6xA8Oz9Ap');

$fcmUrl = 'https://fcm.googleapis.com/fcm/send';

$years		   	= date("Y");
$flag		   	= date("his");
//if form is submitted
if($_POST) {	

	$validator = array('success' => false, 'messages' => array());

	$inp_news		= addslashes($_POST['inp_news']);
	$editor		= addslashes($_POST['editor']);
	$inp_emp_no		= $_POST['inp_emp_no'];

	$temp = "../../../asset/request.file.news/";
	if (isset($_FILES['inp_fileToUpload']['tmp_name'])) {
	

		$fileupload     = $_FILES['inp_fileToUpload']['tmp_name'];
		$ImageName      = $_FILES['inp_fileToUpload']['name'];
		$acak           = rand(111111111111111111, 999999999999999999);
		$ImageExt       = substr($ImageName, strrpos($ImageName, '.'));
		$ImageExt       = str_replace('.','',$ImageExt);
		$ImageName      = preg_replace("/\.[^.\s]{3,4}$/", "", $ImageName);
		$NewImageName   = str_replace(' ', '', $acak.'.'.$ImageExt);

		move_uploaded_file($fileupload, $temp.$NewImageName);

		if(move_uploaded_file($fileupload, $temp.$NewImageName)){			  
	
				 compressImage($_FILES['inp_fileToUpload']['tmp_name'],$temp.$NewImageName,60);	 
		}	

		$inp_news		= strtoupper($_POST['inp_news']);
		$sql_0 = "INSERT INTO `berita` 
						(
							`id_kategori`, 
							`username`, 
							`judul`, 
							`sub_judul`, 
							`youtube`, 
							`judul_seo`, 
							`isi_berita`, 
							`keterangan_gambar`, 
							`hari`, 
							`tanggal`, 
							`jam`, 
							`gambar`, 
							`dibaca`, 
							`tag`, 
							`created_date`
						) 
							VALUES 
								(
									'0', 
									'$inp_emp_no', 
									'$inp_news', 
									'$inp_news', 
									'hjh', 
									'jhjh', 
									'$editor', 
									'$NewImageName', 
									'hjj', 
									'2022-01-30', 
									'06:17:01', 
									'$NewImageName', 
									'hj', 
									'', 
									'$SFdatetime'
								)";

	} else {
		$inp_news		= strtoupper($_POST['inp_news']);
		$sql_0 = "INSERT INTO `berita` 
						(
							`id_kategori`, 
							`username`, 
							`judul`, 
							`sub_judul`, 
							`youtube`, 
							`judul_seo`, 
							`isi_berita`, 
							`keterangan_gambar`, 
							`hari`, 
							`tanggal`, 
							`jam`, 
							`gambar`, 
							`dibaca`, 
							`tag`, 
							`created_date`
						) 
							VALUES 
								(
									'jh', 
									'jhj', 
									'jhj', 
									'jjhjj', 
									'hjh', 
									'jhjh', 
									'hj', 
									'hjj', 
									'hjj', 
									'2022-01-30', 
									'06:17:01', 
									'hjj', 
									'hj', 
									'jjhjh', 
									'2022-01-30 06:17:05'
								)";

		$inp_fileToUpload = "../../../API/uploads";
	}

	
	// condition start
	$query_0 = $connect->query($sql_0);

	if($query_0 == TRUE) {						
		$validator['success'] = true;
		$validator['code'] = "success_message";
		$validator['messages'] = "Successfully saved data";		
		
		$modal=mysqli_query($con, "SELECT token FROM user_pushnotification_token WHERE status = 'Y'");
		while($r=mysqli_fetch_array($modal)){

		
		$fcmNotification = array(
			'registration_ids' => array($r['token']),
			'notification' => array(
				'title' => 'New Information', 
				'body' => 'New Information',
				'vibrate' => 1,

				'image' => 'https://firebase.google.com/downloads/brand-guidelines/PNG/logo-standard.png?hl=id',
				'sound' => 1)
		);

		$headers = [
		'Authorization: key=' . API_ACCESS_KEY,
		'Content-Type: application/json'
		];


		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$fcmUrl);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
		$result = curl_exec($ch);
		curl_close($ch);

		echo $result;
		} 
	} else {		
		$validator['success'] = false;
		$validator['code'] = "failed_message";
		$validator['messages'] = "Failed saved data" . $sql_0;	
	}
	// condition ends

	// close the database connection
	$connect->close();
	echo json_encode($validator);
}