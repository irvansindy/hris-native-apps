<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");
$month                  = date("m");
$year                   = date("Y");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$receiver             = $_POST['id'];
$sql_employee = mysqli_query($connect, "SELECT emp_id FROM view_employee WHERE emp_no = '$receiver'");
$employee = mysqli_fetch_assoc($sql_employee);

$signed          = $_POST['signed'];
$letter_template_post          = $_POST['letter_template'];
$refdate          = $_POST['refdate'];

$sql_ambi_type = mysqli_query($connect, "SELECT 
a.pattern_group
FROM tsfmlettertemplate a WHERE a.template_code = '$letter_template_post'");

$ambil_type = mysqli_fetch_assoc($sql_ambi_type);

$letter_template = $ambil_type['pattern_group'];

// Validasi
$sql_letter_template = mysqli_query($connect, "SELECT 
a.code_pattern,
CONCAT('9000000000',b.lastnumber) AS lastnumber,
b.lastnumber AS nomorakhir,
b.period_month,
b.period_year
FROM tclmdocnumber a 
LEFT JOIN tclldocnumberlog b ON a.code_type = b.code_type
WHERE a.code_type = '$letter_template'");

$template = mysqli_fetch_assoc($sql_letter_template);
$nomor_akhir = $template['nomorakhir'] + 1;

if($letter_template == 'SK' || $letter_template == 'SURAT'){

$number = $template['lastnumber'] + 1;
$future_number = substr($number, -4);

$replace_number = str_replace("XXXX", $future_number, $template['code_pattern']);
$replace_month  = str_replace("MM", $month, $replace_number);
$replace_year   = str_replace("YYYY", $year, $replace_month);
$replace_awal   = str_replace("[", "", $replace_year);
$replace_akhir  = str_replace("]", "", $replace_awal);

}else if($letter_template == 'DISCIPLINE_HISTORY'){
    $number = $template['lastnumber'] + 1;
$future_number = substr($number, -5);

$replace_number = str_replace("XXXXX", $future_number, $template['code_pattern']);
$replace_month  = str_replace("MM", $month, $replace_number);
$replace_year   = str_replace("YYYY", $year, $replace_month);
$replace_awal   = str_replace("[", "", $replace_year);
$replace_akhir  = str_replace("]", "", $replace_awal);
}else if($letter_template == 'BRANCHMOVEMENTLETTER' || $letter_template == 'MOVEMENTLETTER'){
    $number = $template['lastnumber'] + 1;
$future_number = substr($number, -7);

$replace_number = str_replace("XXXXXXX", $future_number, $template['code_pattern']);
$replace_month  = str_replace("MM", $month, $replace_number);
$replace_year   = str_replace("YYYY", $year, $replace_month);
$replace_awal   = str_replace("[", "", $replace_year);
$replace_akhir  = str_replace("]", "", $replace_awal);
}

    $insert     = mysqli_query($connect, "INSERT INTO `tclmletterdocument`
    (`letter_no`,
    `template_code`, 
    `letter_date`, 
    `letter_signee`, 
    `letter_receiver`,
    `letter_file`, 
    `company_id`,
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$replace_akhir',
    '$letter_template_post',
    '$refdate',
    '$signed',
    '$employee[emp_id]',
    '',
    '13576',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username')");

$update     = mysqli_query($connect, "UPDATE `tclldocnumberlog` SET 
    `lastnumber`='$nomor_akhir',
    `period_month`='$month',
    `period_year`='$year',
    `modified_by`='$username',
    `modified_date`='$SFdatetime'
    WHERE `code_type` = '$letter_template'");

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