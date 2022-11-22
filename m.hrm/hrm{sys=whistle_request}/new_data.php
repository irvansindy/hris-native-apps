<?php 
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}

$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;

if(isset($_FILES['file']['name'])){

   $inp_id = $_GET['identity'];

   $whstd_request_own = mysqli_fetch_array(mysqli_query($connect, "SELECT created_by FROM whstd_request WHERE _id_whistle = '$inp_id'"));

       if($whstd_request_own['created_by'] == $username)  {
              $flag = '1';
              $send_to = $username;
       } else {
              $flag = '0';
              $send_to = $whstd_request_own['created_by'];
       }

   /* Getting file name */
   $filename = $_FILES['file']['name'];

   /* Location */
   $location = "../../asset/request.file.whistleblower.attachment/".$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg","png");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $response = $location;

         $sql = "INSERT INTO `whstm_chat` (`id_chat`, `_whistle_id`, `message`, `flag`, `created_date`, `company_id`, `image` , `created_by`) VALUES ('$inp_id', '$inp_id', 'image', '$flag', '$SFdatetime', '15135', '$filename' , '$username')";

              // condition start
              $query_0 = $connect->query($sql);
              
      }
   }

   echo $response;
   exit;

} 


//if form is submitted
if($_POST) {

	

	//========================POST VALUE FORM========================//
	$inp_messageng       = $_POST['messageng'];
	$inp_id              = $_POST['id_chat'];
	//========================POST VALUE FORM========================//


       $whstd_request_own = mysqli_fetch_array(mysqli_query($connect, "SELECT created_by FROM whstd_request WHERE _id_whistle = '$inp_id'"));

       if($whstd_request_own['created_by'] == $username)  {
              $flag = '1';
              $send_to = $username;
       } else {
              $flag = '0';
              $send_to = $whstd_request_own['created_by'];
       }

	
	$sql = "INSERT INTO `whstm_chat` (`id_chat`, `_whistle_id`, `message`, `flag`, `created_date`, `company_id`, `created_by`) VALUES ('$inp_id', '$inp_id', '$inp_messageng', '$flag', '$SFdatetime', '15135' , '$username')";

	// condition start
	$query_0 = $connect->query($sql);
	$connect->close();

}


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

$modal=mysqli_query($connect, "SELECT token FROM user_pushnotification_token WHERE status = 'Y' AND emp_no = '$send_to'");
  while($r=mysqli_fetch_array($modal)){

 
$fcmNotification = array(
    'registration_ids' => array($r['token']),
    'notification' => array(
        'title' => 'Whistle blower messages reply', 
        'body' => $inp_messageng,
        'vibrate' => 1,

       //  'image' => 'https://internship.gthris.com/API/information/02. info.png',
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
