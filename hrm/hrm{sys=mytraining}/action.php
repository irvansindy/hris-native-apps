<?php include "../../application/session/session.php"; ?>
<?php
date_default_timezone_set('Asia/Bangkok');
$datetime            = date('Y-m-d H:i:s');
$date               = date('Y-m-d');
$dateprint             = date('d M Y');
$time               = date('h:i:s');
$request            = date('Ydhis');
$attend_id            = $username . $request;

//mendefinisikan folder
define('UPLOAD_DIR', '../../application/API/uploads/');


$img                = $_POST['image'];
$username           = $_POST['emp_no'];
$emp_no             = $_POST['emp_no'];
$geolocation        = $_POST['geolocation'];
$geolocation2       = $_POST['geolocation2'];

$requestno         = $_POST['request_no'];
$employee           = $_POST['emp_id'];

$tipe               = $_POST['tipe'];
$whats              = $_POST['tipe'] == '2' ? $getdata = '0' : $getdata = '1';

$img                = str_replace('data:image/jpeg;base64,', '', $img);
$img                = str_replace(' ', '+', $img);

$data               = base64_decode($img);
$file               = $_POST['emp_no'] . $request . uniqid() . '.png';
file_put_contents(UPLOAD_DIR . $file, $data);

if ($emp_no == '' || $img == '' || $geolocation == '' || $geolocation2 == '') {

    echo "<script type='text/javascript'>
                        window.alert('failed'); 
                </script>";
} else {

    $checkQuery = "SELECT (6371 * acos( 
                            cos( radians(a.latitude) ) 
                            * cos( radians($geolocation) ) 
                            * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
                            + sin( radians(a.latitude) ) 
                            * sin( radians($geolocation) )
                                )) as distance 
                            
                        FROM users a
                        LEFT JOIN teomdistance b on b.id = '1'
                                WHERE
                                a.username = '$username' and
                                ROUND((6371 * acos( 
                                                cos( radians(a.latitude) ) 
                                            * cos( radians($geolocation) ) 
                                            * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
                                            + sin( radians(a.latitude) ) 
                                            * sin( radians($geolocation) )
                                                )),1) <= b.distance_km";

    $query = mysqli_query($connect, $checkQuery);
    $check_query_count = mysqli_num_rows($query);

    $having_location = mysqli_fetch_array(mysqli_query($connect, "SELECT latitude FROM users WHERE username = '$username'"));
    $having_location_print = $having_location['latitude'];

    if (empty($check_query_count)) {
        $checkQuery = mysqli_fetch_array(mysqli_query($connect, "SELECT (6371 * acos( 
                                                                        cos( radians(a.latitude) ) 
                                                                        * cos( radians($geolocation) ) 
                                                                        * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
                                                                        + sin( radians(a.latitude) ) 
                                                                        * sin( radians($geolocation) )
                                                                        )) as distance 
                                                                    FROM users a WHERE a.username = '$username'"));
        $printcheckQuery = $checkQuery['distance'];

        $save_outzone = mysqli_query($connect, "INSERT INTO `ttadattendancetemp` 
                                                            (
                                                                `attend_id`,
                                                                `latitude`,
                                                                `longlatitude`,
                                                                `emp_no`,
                                                                `status`,
                                                                `distance`,
                                                                `photos`,
                                                                `distance_flag`,
                                                                `created_date`,
                                                                `modified_date`,
                                                                `task`
                                                            ) 
                                                                VALUE 
                                                                    (
                                                                        '$attend_id',
                                                                        '$geolocation',
                                                                        '$geolocation2',
                                                                        '$username',
                                                                        '$tipe',
                                                                        '$printcheckQuery',
                                                                        '$file',
                                                                        'out',
                                                                        '$datetime',
                                                                        '$datetime',
                                                                        'Training-$request_no'
                                                                    )");

        $save_outzone = mysqli_query($connect, "UPDATE `trndrequest` SET 
                                                        `starttime` = '$datetime',
                                                        `attendance_image` = '$file'
                                                    WHERE 	
                                                        `emp_id` = '$employee' AND 
                                                        `request_no` = '$requestno'");
    } else {
        $checkQuery = mysqli_fetch_array(mysqli_query($connect, "SELECT (6371 * acos( 
                                                                            cos( radians(a.latitude) ) 
                                                                            * cos( radians($geolocation) ) 
                                                                            * cos( radians(a.longlatitude ) - radians($geolocation2) ) 
                                                                            + sin( radians(a.latitude) ) 
                                                                            * sin( radians($geolocation) )
                                                                            )) as distance 
                                                                        FROM users a WHERE a.username = '$username'"));
        $printcheckQuery = $checkQuery['distance'];

        $save = mysqli_query($connect, "INSERT INTO `ttadattendancetemp` 
                                                    (
                                                        `attend_id`,
                                                        `latitude`,
                                                        `longlatitude`,
                                                        `emp_no`,
                                                        `status`,
                                                        `distance`,
                                                        `photos`,
                                                        `distance_flag`,
                                                        `created_date`,
                                                        `modified_date`,
                                                        `task`,
                                                        `debug`
                                                    )
                                                        VALUE 
                                                            (
                                                                '$attend_id',
                                                                '$geolocation',
                                                                '$geolocation2',
                                                                '$username',
                                                                '$tipe',
                                                                '$printcheckQuery',
                                                                '$file',
                                                                'in',
                                                                '$datetime',
                                                                '$datetime',
                                                                'Training-$request_no'
                                                            )");


        $save_outzone = mysqli_query($connect, "UPDATE `trndrequest` SET
                                                        `starttime` = '$datetime',
                                                        `attendance_image` = '$file'
                                                    WHERE 	
                                                        `emp_id` = '$employee' AND 
                                                        `request_no` = '$requestno'");
    }
}
exit();
?>