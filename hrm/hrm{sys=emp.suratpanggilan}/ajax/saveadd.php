<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("Y");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

$letter_to          = $_POST['letter_to'];
// $letter_hari          = $_POST['letter_hari'];
$letter_tanggal          = $_POST['letter_tanggal'];
$letter_waktu_start          = $_POST['letter_waktu_start'];
$letter_waktu_end          = $_POST['letter_waktu_end'];
$letter_tempat          = $_POST['letter_tempat'];
$letter_masalah          = $_POST['letter_masalah'];
$letter_signee          = $_POST['letter_signee'];

$letter_waktu = $letter_waktu_start.'-'.$letter_waktu_end;

$day = date('D', strtotime($letter_tanggal));
$dayList = array(
    'Sun' => 'Minggu',
    'Mon' => 'Senin',
    'Tue' => 'Selasa',
    'Wed' => 'Rabu',
    'Thu' => 'Kamis',
    'Fri' => "Jum'at",
    'Sat' => 'Sabtu'
);

$letter_hari = addslashes($dayList[$day]);

// Mendapatkan noref
$sql_last_request = mysqli_query($connect, "SELECT 
a.noref
FROM hrddisciplineshistory a ORDER BY a.created_date DESC LIMIT 1");

// Mendapatkan worklocation code
$sql_work_location = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM view_employee a WHERE a.emp_no = '$username'");

$work_location = mysqli_fetch_assoc($sql_work_location);

$last_request = mysqli_fetch_assoc($sql_last_request);
$last_request_year = substr($last_request['noref'], 3, 4);
$last_request_plus = substr($last_request['noref'], 3) + 1;
$request_plus = substr($last_request_plus, 4);

if($last_request_year == $date_logo){
    $years = $last_request_year;
    $noref = 'DIS'.$years.$request_plus;
}else{
    $years = $date_logo;
    $noref = 'DIS'.$years.'0000001';
}


$insert     = mysqli_query($connect, "INSERT INTO `hrddisciplineshistory`
    (`noref`,
    `to_empno`,
    `hari`, 
    `tanggal`, 
    `waktu`, 
    `tempat`,
    `masalah`,
    `signee_by`,
    `work_location`,
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$noref',
    '$letter_to',
    '$letter_hari',
    '$letter_tanggal',
    '$letter_waktu',
    '$letter_tempat',
    '$letter_masalah',
    '$letter_signee',
    '$work_location[worklocation_code]',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username')");

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($insert){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

?>