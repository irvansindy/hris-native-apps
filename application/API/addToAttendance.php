<?php 
date_default_timezone_set('Asia/Bangkok'); 

include('config.php');

$datetime		      = date('Y-m-d H:i:s');
$date   		      = date('Y-m-d');
$dateprint 		    = date('d M Y');
$time   		      = date('h:i:s');
$request	        = date('Ydhis');

$con = mysqli_connect($server,$username,$password,$db);
$requestno        = "ATD".$request;

if($con)
{
  
  $userid   = $_POST['userid'];
  $foodid   = $_POST['foodid'];
  $lat      = $_POST['lat'];
  $long     = $_POST['long'];
  $token    = $_POST['token'];
  $title    = $_POST['title'];
  $taskin   = $_POST['taskin'];

  if($title == '1'){
    $column = "task,";
    $fill = "'$taskin',";
    $persentage   = 'notuse';
  } else if($title == '2')  {
    $column = "realize,";
    $fill = "'$taskin',";
    $persentage   = $_POST['taskinpersentage'];
  } else {
    $column = "";
    $fill = "";
    $persentage   = 'notuse';
  }
	
	// $image = $_POST['image'];
  // $name = $_POST['name'];
 
  $image = $_FILES['image']['name'];
  $imagePath="uploads/".$image;

  move_uploaded_file($_FILES['image']['tmp_name'],$imagePath);

           
  $checkQuery="SELECT (6371 * acos( 
    cos( radians(a.latitude) ) 
  * cos( radians($lat) ) 
  * cos( radians(a.longlatitude ) - radians($long) ) 
  + sin( radians(a.latitude) ) 
  * sin( radians($lat) )
    )) as distance 
    
FROM users a
LEFT JOIN teomdistance b on b.id = '1'

        WHERE
        a.username = '$userid' and
        
        ROUND((6371 * acos( 
                        cos( radians(a.latitude) ) 
                      * cos( radians($lat) ) 
                      * cos( radians(a.longlatitude ) - radians($long) ) 
                      + sin( radians(a.latitude) ) 
                      * sin( radians($lat) )
                        )),1) <= b.distance_km";
                        
$query=mysqli_query($con,$checkQuery);
$check_query_count=mysqli_num_rows($query);

$persen = "SELECT 
CASE 
  WHEN '$persentage' BETWEEN '0' AND '100' THEN 'BENAR'
  WHEN '$persentage' LIKE '%notuse%' THEN 'BENAR'
ELSE 'SALAH'
END AS 'VAL'";
$Qpersen=mysqli_fetch_array(mysqli_query($con,$persen));

if(empty($check_query_count) && $Qpersen['VAL'] == 'BENAR') {
        $checkQuery = mysqli_fetch_array(mysqli_query($con, "SELECT (6371 * acos( 
                                                            cos( radians(a.latitude) ) 
                                                          * cos( radians($lat) ) 
                                                          * cos( radians(a.longlatitude ) - radians($long) ) 
                                                          + sin( radians(a.latitude) ) 
                                                          * sin( radians($lat) )
                                                            )) as distance 
                                                            
                                                FROM users a WHERE a.username = '$userid'"));
                                                            
                                                            
                                                $printcheckQuery = $checkQuery['distance'];
                                                
                                                if($time >= '06:00:00' && $time < '12:04:33'){
                                                    $status = '1';
                                                } else {
                                                    $status = '2';
                                                }
                                              
                                              $insertQuery="INSERT INTO ttadattendancetemp(
                                                                          attend_id,
                                                                          emp_no,
                                                                          status,
                                                                          starttime,
                                                                          latitude,
                                                                          longlatitude,
                                                                          distance,
                                                                          distance_flag
                                                                          ,photos,
                                                                          remark,
                                                                          persentage,
                                                                          $column
                                                                          created_date) 
                                                                  values 
                                                                                      (
                                                                                          '$requestno',
                                                                                          '$userid',
                                                                                          '$title',
                                                                                          '$datetime',
                                                                                          '$lat',
                                                                                          '$long',
                                                                                          '$printcheckQuery',
                                                                                          'out',
                                                                                          '$image',
                                                                                          '$time',
                                                                                          '$persentage',
                                                                                          $fill
                                                                                          '$datetime')";
                                                       
                                                        $results=mysqli_query($con,$insertQuery);
                                                        if($results)
                                                        {
                                                            echo "outofz";
                                                        }
} else if(!empty($check_query_count) && $Qpersen['VAL'] == 'BENAR') {
        
        $checkQuery = mysqli_fetch_array(mysqli_query($con, "SELECT (6371 * acos( 
                      cos( radians(a.latitude) ) 
                    * cos( radians($lat) ) 
                    * cos( radians(a.longlatitude ) - radians($long) ) 
                    + sin( radians(a.latitude) ) 
                    * sin( radians($lat) )
                      )) as distance 
                      
          FROM users a WHERE a.username = '$userid'"));
                      
                      
          $printcheckQuery = $checkQuery['distance'];
          
          if($time >= '06:00:00' && $time < '12:04:33'){
              $status = '1';
          } else {
              $status = '2';
          }
        
        $insertQuery="INSERT INTO ttadattendancetemp(
                                    attend_id,
                                    emp_no,
                                    status,
                                    starttime,
                                    latitude,
                                    longlatitude,
                                    distance,
                                    distance_flag,
                                    photos,
                                    remark,
                                    persentage,
                                    $column
                                    created_date) 
                            values 
                                                (
                                                    '$requestno',
                                                    '$userid',
                                                    '$title',
                                                    '$datetime',
                                                    '$lat',
                                                    '$long',
                                                    '$printcheckQuery',
                                                    'in',
                                                    '$image',
                                                    '$time',
                                                    '$persentage',
                                                    $fill
                                                    '$datetime')";
                 
                  $result=mysqli_query($con,$insertQuery);
                  if($result)
                  {
                      echo "Successfully Record Attendance";
                      define('API_ACCESS_KEY','AAAAWJj5kOQ:APA91bG3yQn6l19B-IFBgH3BW3mwp7AGe896u-Dm5hDpszC5ysmhEBhhUSYepZlFRaj5RxGnVylSsus4qXRxm8WGgFizqm6vxTLO7htOAQrEqEbJp4-Lkjo3hSqhayvIpMz6xA8Oz9Ap');
      
                      $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
      
                      $modal=mysqli_query($con, "SELECT token FROM user_pushnotification_token WHERE emp_no = '$userid'");
                        while($r=mysqli_fetch_array($modal)){
      
                      
                      $fcmNotification = array(
                          'registration_ids' => array($r['token']),
                          'notification' => array(
                              'title' => 'Successfully Recorded Attendance', 
                              'body' => $datetime_print.' '.$lat.'-'.$long,
                              'vibrate' => 1,
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
      
                      //echo $result;
                        
            }
        }
        
  } else {
      echo "failed persentage";
  }
}
?>