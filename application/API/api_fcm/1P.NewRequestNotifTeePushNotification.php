<?php
date_default_timezone_set('Asia/Bangkok'); 
	
$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;

define('API_ACCESS_KEY','AAAAfOkgITc:APA91bGYJFTm2ICmNpM6s-NSkbUiDLzcSrG1Z4PtdtUB4VpFq0yRCDehJ9lDL2yCpEvv05w2us2PqiNbX0-pQ5W46MSTZGjiuE1d6rlm-7gdVq7zwb2a7yxKB1xwzxCrGfSJnwSem9CZ');

$fcmUrl = 'https://fcm.googleapis.com/fcm/send';

include '../../config.php';

$getlast 		= mysqli_fetch_array(mysqli_query($connect, "SELECT last_process FROM sys_scheduler WHERE process_code = 'NewRequestNotifTeePushNotification'"));
$getlast_r 		= $getlast['last_process'];

$getticketnew 	=   mysqli_query($connect, "SELECT
												d.emp_no as req_emp_no,
												d.Full_Name,
                                                c.emp_no,
												a.request_no,
                                                a.created_date,
                                                (SELECT token FROM user_pushnotification_token WHERE emp_no=c.emp_no ORDER BY `timestamp` DESC LIMIT 1) AS token
                                            FROM hrmleaverequest a
                                            LEFT JOIN hrmrequestapproval b on a.request_no=b.request_no
                                            INNER JOIN view_employee c on b.position_id=c.position_id
											INNER JOIN view_employee d on a.emp_id=d.emp_id
                                            WHERE a.created_date > '$getlast_r' AND 
                                            (SELECT token FROM user_pushnotification_token WHERE emp_no=c.emp_no ORDER BY `timestamp` DESC LIMIT 1) IS NOT NULL
                                            ORDER BY a.created_date ASC");

$rowcount		=   mysqli_num_rows($getticketnew);
while($rnew     =   mysqli_fetch_array($getticketnew)){


        $fcmNotification = array(
            'registration_ids' => array($rnew['token']),
            'notification' => array(
                'title' => 'New Request Notification '.$rnew['Full_Name'].' ['.$rnew['req_emp_no'].']', 
                'body' => 'Pengajuan Leave Request '.$rnew['request_no'].'',
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

        echo $result;
            
        mysqli_query($connect, "UPDATE sys_scheduler SET last_process='$rnew[created_date]' WHERE process_code = 'NewRequestNotifTeePushNotification'");
        mysqli_query($connect, "INSERT INTO sys_notification_log (`process_code`,`send_to`,`date_id`,`message`) VALUES ('NewRequestNotifTeePushNotification','$rnew[emp_no]','$rnew[created_date]','$rnew[request_no]')");
        
    
} 
?>