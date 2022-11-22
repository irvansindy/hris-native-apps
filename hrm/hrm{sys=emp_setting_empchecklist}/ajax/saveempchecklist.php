<?php

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

$checklistcode      = 'CL'.$date_logo;

// Parsing Data 
$var    = $_POST['k'];
$ou     = $_POST['ou'];
$cgc    = $_POST['cgc'];
$cgm    = $_POST['cgm'];
$new    = $_POST['n'];
$exit   = $_POST['o'];

// Konversi data facility
$array      = str_replace('% ]', '', $var);
$array_1    = str_replace('% ', ' ', $array);
$plode      = explode(" ", $array_1);

$count_fac  = count($plode);
// Konversi data facility

// konversi organization unit
$convert_ou = str_replace(',', ' ', $ou);
$array_ou   = explode(" ",$convert_ou);
$count_ou   = count($array_ou);
// konversi organization unit

// konversi new hire
$convert_new = str_replace('% ]', '', $new);
$array_new   = str_replace('% ', ' ', $convert_new);
$plode_new   = explode(" ",$array_new);
$count_new   = count($plode_new);
// konversi new hire

// konversi exite
$convert_exit = str_replace('% ]', '', $exit);
$array_exit   = str_replace('% ', ' ', $convert_exit);
$plode_exit   = explode(" ",$array_exit);
$count_exit   = count($plode_exit);
// konversi exite

// Proses Insert

// Insert to table tgemchecklistheader
$insert_tgemchecklistheader   = mysqli_query($connect, "INSERT INTO `hrmchecklistheader`
    (`checklistheader_code`,
    `company_code`, 
    `checklistgrp_name`, 
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$cgc',
    '13576',
    '$cgm',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username')");

// Insert to table tgemchecklistorgunit
for($i = 0; $i < $count_ou; $i++){
$insert_tgemchecklistorgunit   = mysqli_query($connect, "INSERT INTO `tgemchecklistorgunit`
    (`checklistheader_code`,
    `company_code`, 
    `dept_id`, 
    `created_date`,
    `created_by`,
    `modified_date`,
    `modified_by`) 
    VALUES (
    '$cgc',
    '13576',
    '$array_ou[$i]',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username')");
}

// Insert to table tgemchecklist
for($i = 0; $i < $count_fac; $i++){

    // Memecah fasilitas dengn anggota
    $array_pecah_fasilitas = explode("&", $plode[$i]);
    $fasilitas = $array_pecah_fasilitas[0];

    $array_pic = explode(",", $array_pecah_fasilitas[1]);
    $count_pic = count($array_pic);

    for($x = 0; $x < $count_pic; $x++){
    $insert_tgemchecklistpic   = mysqli_query($connect, "INSERT INTO `tgemchecklistpic`
    (`checklistheader_code`,
    `checklist_code`, 
    `company_code`, 
    `pic`) 
    VALUES (
    '$cgc',
    '$fasilitas',
    '13576',
    '$array_pic[$x]'
    )"); 
    }

    if($plode_new[$i] == '1'){
        
        $insert_tgemchecklist   = mysqli_query($connect, "INSERT INTO `tgemchecklist`
            (`checklist_code`,
            `company_code`, 
            `checklist_name_en`, 
            `checklistgroup_code`, 
            `comp_facility`,
            `order_no`, 
            `created_date`,
            `created_by`,
            `modified_date`,
            `modified_by`,
    `checklist_name_id`,
    `checklist_name_my`,
    `checklist_name_th`,
    `checklist_name_ph`,
    `checklistheader_code`) 
    VALUES (
    '$fasilitas',
    '13576',
    '$fasilitas',
    'NEWHIRE',
    '1',
    '1',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username',
    '$fasilitas',
    '$fasilitas',
    '$fasilitas',
    '$fasilitas',
    '$cgc')");
    }

    if($plode_exit[$i] == '1'){
        // Insert to table tgemchecklist
        $insert_tgemchecklist   = mysqli_query($connect, "INSERT INTO `tgemchecklist`
            (`checklist_code`,
            `company_code`, 
            `checklist_name_en`, 
            `checklistgroup_code`, 
            `comp_facility`,
            `order_no`, 
            `created_date`,
            `created_by`,
            `modified_date`,
            `modified_by`,
    `checklist_name_id`,
    `checklist_name_my`,
    `checklist_name_th`,
    `checklist_name_ph`,
    `checklistheader_code`) 
    VALUES (
    '$fasilitas',
    '13576',
    '$fasilitas',
    'EXIT',
    '1',
    '1',
    '$SFdatetime',
    '$username',
    '$SFdatetime',
    '$username',
    '$fasilitas',
    '$fasilitas',
    '$fasilitas',
    '$fasilitas',
    '$cgc')");
    }

}

// Proses insert

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($insert_tgemchecklistheader){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

?>