<?php
date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");

define('API_ACCESS_KEY','AAAAWJj5kOQ:APA91bG3yQn6l19B-IFBgH3BW3mwp7AGe896u-Dm5hDpszC5ysmhEBhhUSYepZlFRaj5RxGnVylSsus4qXRxm8WGgFizqm6vxTLO7htOAQrEqEbJp4-Lkjo3hSqhayvIpMz6xA8Oz9Ap');

$fcmUrl = 'https://fcm.googleapis.com/fcm/send';

include '../../config.php';

$modal 	=   mysqli_query($connect, "SELECT
                                        e.emp_no,
                                        e.Full_Name,
                                        d.process_code,
                                        d.remark,
                                        c.token,
                                        a.created_date,
                                        DATE_FORMAT(a.starttime , '%d %b %Y %H:%i:%s') as starttime,
                                        a.attend_id
                                    FROM ttadattendancetemp a
                                    LEFT JOIN user_pushnotification_token c ON a.emp_no=c.emp_no
                                    LEFT JOIN sys_scheduler d ON d.process_code = '1D'
                                    LEFT JOIN view_employee e ON a.emp_no=e.emp_no
                                    WHERE a.created_date >= d.last_process AND a.attend_id <> d.last_id");

while($r=mysqli_fetch_array($modal)){

        $fcmNotification = array(
            'registration_ids' => array($r['token']),
            'notification' => array(
                'title' => 'Your time has been recorded : '.$r['Full_Name'].' ['.$r['emp_no'].']', 
                'body' => 'Start Time : '. $r['starttime'] ,
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
            
        mysqli_query($connect, "UPDATE sys_scheduler SET last_process='$r[created_date]',  last_id = '$r[attend_id]' WHERE process_code = '1D'");
    }
?>