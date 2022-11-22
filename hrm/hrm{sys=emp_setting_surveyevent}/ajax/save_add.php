<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];

$n1         = $_POST['n1'];
$n2         = $_POST['n2'];
$n3         = $_POST['n3'];
$n4         = $_POST['n4'];
$n5         = $_POST['n5'];
$essay      = $_POST['essay'];
$judul      = $_POST['judul'];
$tahun      = $_POST['tahun'];
$divisi     = $_POST['divisi'];
$departemen = $_POST['departemen'];
$target     = $_POST['target'];
$start      = $_POST['start'];
$end        = $_POST['end'];
$all_anggota = $_POST['all_anggota'];

// Membuat Id Event
$sql_max_id = mysqli_query($connect, "SELECT 
a.id_event AS maksimal
FROM hrmsurveyevent a
ORDER BY a.id DESC
LIMIT 1");
$max_id     = mysqli_fetch_assoc($sql_max_id);
$potong1    = substr($max_id['maksimal'], 0, 5);
$poting2    = substr($max_id['maksimal'], 5)+1;
$id_event   = $potong1.$poting2;
// Membuat Id Event

// Konversi data gpertanyaan
$array      = str_replace('% ]', '', $n1);
$array_1    = str_replace('% ', ' ', $array);
$plode      = explode(" ", $array_1);

$count_fac  = count($plode);
// Konversi data gpertanyaan

// Konversi data tipejawaban
$array1      = str_replace('% ]', '', $n2);
$array_11    = str_replace('% ', ' ', $array1);
$plode1      = explode(" ", $array_11);

$count_fac1  = count($plode1);
// Konversi data tipejawaban

// Konversi data orderpertanyaan
$array2      = str_replace('% ]', '', $n3);
$array_12    = str_replace('% ', ' ', $array2);
$plode2      = explode(" ", $array_12);

$count_fac2  = count($plode2);
// Konversi data orderpertanyaan

// Konversi data gessay
$array3      = str_replace('% ]', '', $n4);
$array_13    = str_replace('% ', ' ', $array3);
$plode3      = explode(" ", $array_13);

$count_fac3  = count($plode3);
// Konversi data gessay

// Konversi data orderessay
$array4      = str_replace('% ]', '', $n5);
$array_14    = str_replace('% ', ' ', $array4);
$plode4      = explode(" ", $array_14);

$count_fac4  = count($plode4);
// Konversi data orderessay

// Insert table event
$insert     = mysqli_query($connect, "INSERT INTO `hrmsurveyevent`
    (`id_event`,
    `judul`, 
    `tahun`, 
    `divisi`, 
    `dept`,
    `start_date`,
    `end_date`,
    `created_date`, 
    `createdby`,
    `modified_by`, 
    `modified_date`,
    `target`,
    `status`) 
    VALUES (
    '$id_event',
    '$judul',
    '$tahun',
    '$divisi',
    '$departemen',
    '$start',
    '$end',
    '$SFdatetime',
    '$username',
    '$username',
    '$SFdatetime',
    '$target',
    '1')");

// Update Table group pertanyaan dan group essay
if($essay == 1){

    $anggota    = $_POST['anggota'];
    // Konversi anggota
    $count_anggota  = count($anggota);
    // Konversi anggota

    for($y=0; $y<$count_fac ;$y++){
        $update_gpertanyaan = mysqli_query($connect, "INSERT INTO `hrmsurveygrouppertanyaan`(`id_group`, `id_event`, `created_date`, `modified_date`, `createdby`, `tipejawaban`, `order`) 
        VALUES('$plode[$y]','$id_event','$SFdatetime','$SFdatetime','$username','$plode1[$y]','$plode2[$y]')");
    }

    for($y=0; $y<$count_fac3 ;$y++){
        $update_gessay      = mysqli_query($connect, "INSERT INTO `hrmsurveygroupessay`(`id_group`, `id_event`, `created_date`, `modified_date`, `createdby`, `order`) 
        VALUES('$plode3[$y]','$id_event','$SFdatetime','$SFdatetime','$username','$plode4[$y]')");
    }
}else{

    for($y=0; $y<$count_fac ;$y++){
        $update_gpertanyaan = mysqli_query($connect, "INSERT INTO `hrmsurveygrouppertanyaan`(`id_group`, `id_event`, `created_date`, `modified_date`, `createdby`, `tipejawaban`, `order`) 
        VALUES('$plode[$y]','$id_event','$SFdatetime','$SFdatetime','$username','$plode1[$y]','$plode2[$y]')");
    }
}

// Update anggota event
if($all_anggota == 0){
    
    for($y=0; $y<$count_anggota ;$y++){
        $update_anggota = mysqli_query($connect, "INSERT INTO `hrmsurveyanggotaevent`(`id_event`, `nip`, `created_date`, `modified_date`, `createdby`, `aksi`) 
        VALUES('$id_event','$anggota[$y]','$SFdatetime','$SFdatetime','$username','0')");
    }
}else{
    
    $update_anggota     = mysqli_query($connect, "INSERT INTO `hrmsurveyanggotaevent` 
                            (`id_event`, `nip`, `created_date`, `modified_date`, `createdby`, `aksi`)
                        SELECT 
                            '$id_event' as id_event, username as nip, '$SFdatetime' as created_date, '$SFdatetime' as modified_date, '$username' as createdby, '0' as aksi
                        FROM 
                            `users`");
}


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