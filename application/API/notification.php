<?php


define('API_ACCESS_KEY','AAAASQFXj24:APA91bGpVycf-S2n7BhWieIQCZhwsCzv4mMErQpvZRFC9-gZtHuR3EGjRbnrX8qiLw7OWq7BPJWsFsEMhT5qzG7Kvmz5avyilS8IXvjB2RYA40h1KywaWAqX--AbIkF4DCzVp6R8oSWI');

$fcmUrl = 'https://fcm.googleapis.com/fcm/send';

$token = 'fxk1DDR7QS6vv4lPU-_VM6:APA91bFKX2yhhFktw47j_CEzCJ560kf7ACX9lvxTdwZ2acKHjRCNEFSeKHDDXs877jyZZyf5idHuAKBofQbsz2wKUXdqmdgXVJfayasjtdwcQtLU21LRAJsz_adtfY4jbdt5Ne912jl4';


$notification = [
//write title, description and so on
];

$extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

$fcmNotification = [
//'registration_ids' => $tokenList, //multple token array
'to'        =>'write token here', //single token
'notification' => $notification,
'data' => $extraNotificationData
];

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

?>