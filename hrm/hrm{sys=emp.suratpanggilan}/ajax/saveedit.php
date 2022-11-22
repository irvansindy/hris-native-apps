<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$year_now               = date("Y");
$bulan                  = date("m");
$bulan_min              = $bulan - 1;

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

$romawi_bulan       = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];


$noref             = $_POST['noref'];
$validasi          = $_POST['validasi'];
$letter_to          = $_POST['letter_to'];
// $letter_hari          = $_POST['letter_hari'];
$letter_tanggal          = $_POST['letter_tanggal'];
$letter_waktu_start          = $_POST['letter_waktu_start'];
$letter_waktu_end          = $_POST['letter_waktu_end'];
$letter_tempat          = $_POST['letter_tempat'];
$letter_masalah          = $_POST['letter_masalah'];
$letter_signee          = $_POST['letter_signee'];

$konseling_tanggal          = $_POST['konseling_tanggal'];
$konseling_conselor          = $_POST['konseling_conselor'];
$konseling_penaltytype          = $_POST['konseling_penaltytype'];
$konseling_penaltydate          = $_POST['konseling_penaltydate'];
$konseling_status          = $_POST['konseling_status'];

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



// Membuat nomor letter
$sql_last_letter = mysqli_query($connect, "SELECT 
a.code_type,
a.lastnumber,
CONCAT('90000', a.lastnumber) AS nomor_terakhir,
a.period_month,
a.period_year 
FROM tclldocnumberlog a WHERE a.code_type = 'EMP_SURATPANGGILAN'");

$last_letter = mysqli_fetch_assoc($sql_last_letter);
$count_letter = mysqli_num_rows($sql_last_letter);

if($count_letter > 0){
    $tahun_last_lette = $last_letter['period_year'];
    if($tahun_last_lette == $year_now){
        $last_number    = $last_letter['nomor_terakhir'] + 1;
        $get_last_number = substr($last_number, -4);
        $letter_no = $get_last_number.'/SANKSI/HR-OPS/'.$romawi_bulan[$bulan_min].'/'.$year_now;
        $nomor_terakhir = $last_letter['lastnumber'] + 1;
    }else{
        $letter_no = '0001/SANKSI/HR-OPS/'.$romawi_bulan[$bulan_min].'/'.$year_now;
        $nomor_terakhir = 1;
    }
}else{
    $letter_no = '0001/SANKSI/HR-OPS/'.$romawi_bulan[$bulan_min].'/'.$year_now;
}

if($validasi == 0){
    $update_letter  = mysqli_query($connect, "UPDATE `hrddisciplineshistory` SET 
    `to_empno`='$letter_to',
    `hari`='$letter_hari',
    `tanggal`='$letter_tanggal',
    `waktu`='$letter_waktu',
    `tempat`='$letter_tempat',
    `masalah`='$letter_masalah',
    `signee_by`='$letter_signee',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `noref` = '$noref'");

    $insert     = mysqli_query($connect, "INSERT INTO `hrmcouseling`
    (`noref`,
    `letter_no`,
    `coounseling_date`, 
    `conselor`, 
    `penalty_type`, 
    `penalty_date`,
    `status`,
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$noref',
    '$letter_no',
    '$konseling_tanggal',
    '$konseling_conselor',
    '$konseling_penaltytype',
    '$konseling_penaltydate',
    '$konseling_status',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username')");

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($insert){

    $update_number  = mysqli_query($connect, "UPDATE `tclldocnumberlog` SET 
    `lastnumber`='$nomor_terakhir',
    `period_year`='$year_now',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `code_type` = 'EMP_SURATPANGGILAN'");

    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

}else{

    $update_letter  = mysqli_query($connect, "UPDATE `hrddisciplineshistory` SET 
    `to_empno`='$letter_to',
    `hari`='$letter_hari',
    `tanggal`='$letter_tanggal',
    `waktu`='$letter_waktu',
    `tempat`='$letter_tempat',
    `masalah`='$letter_masalah',
    `signee_by`='$letter_signee',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `noref` = '$noref'");

    $update_konseling   = mysqli_query($connect, "UPDATE `hrmcouseling` SET 
    `coounseling_date`='$konseling_tanggal',
    `conselor`='$konseling_conselor',
    `penalty_type`='$konseling_penaltytype',
    `penalty_date`='$konseling_penaltydate',
    `status`='$konseling_status',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `noref` = '$noref'");

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($update_konseling){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

}


?>