<?php

define('API_ACCESS_KEY','AAAAWJj5kOQ:APA91bG3yQn6l19B-IFBgH3BW3mwp7AGe896u-Dm5hDpszC5ysmhEBhhUSYepZlFRaj5RxGnVylSsus4qXRxm8WGgFizqm6vxTLO7htOAQrEqEbJp4-Lkjo3hSqhayvIpMz6xA8Oz9Ap');



$fcmUrl = 'https://fcm.googleapis.com/fcm/send';

$host 			= "localhost";
$user 			= "gthrisco";
$port 			= "3306";
$pwd 			= "il!4Pj39";
$dbname 		= "gthrisco_tm";

$connect = mysqli_connect($host, $user, $pwd, $dbname);
if (mysqli_connect_errno()){
	echo "we are sorry your connection is failed" . mysqli_connect_error();
}

$modal=mysqli_query($connect, "SELECT token FROM user_pushnotification_token WHERE status = 'Y' AND emp_no = '13-0299'");
  while($r=mysqli_fetch_array($modal)){

 
$fcmNotification = array(
    'registration_ids' => array($r['token']),
    'notification' => array(
        'title' => 'HRIS Announcement', 
        'body' => 'Selalu Pastikan Status Lokasi Absen Anda Dalam Posisi IN ZONE',
        'vibrate' => 1,

        'image' => 'https://internship.gthris.com/API/information/02. info.png',
        'sound' => 1,
		'click_action' => 'https://yoururl.here'),
	'data' => array(
      
        'link' => 'href://www.symulti.com'
    )
	
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
?>