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
$id_event   = $_POST['id_event'];
$anggota    = $_POST['anggota'];
$all_anggota = $_POST['all_anggota'];

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

// Konversi anggota
$count_anggota  = count($anggota);
// Konversi anggota

// Update table event
$update     = mysqli_query($connect, "UPDATE `hrmsurveyevent` SET 
    `judul`='$judul',
    `tahun`='$tahun',
    `divisi`='$divisi',
    `dept`='$departemen',
    `start_date`='$start',
    `end_date`='$end',
    `modified_by`='$username',
    `modified_date`='$SFdatetime',
    `target`='$target'
    WHERE `id_event` = '$id_event'");

// Update Table group pertanyaan dan group essay
if($essay == 1){
    $delete1    = mysqli_query($connect, "DELETE FROM hrmsurveygrouppertanyaan WHERE id_event = '$id_event'");
    $delete2    = mysqli_query($connect, "DELETE FROM hrmsurveygroupessay WHERE id_event = '$id_event'");

    for($y=0; $y<$count_fac ;$y++){
        $update_gpertanyaan = mysqli_query($connect, "INSERT INTO `hrmsurveygrouppertanyaan`(`id_group`, `id_event`, `created_date`, `modified_date`, `createdby`, `tipejawaban`, `order`) 
        VALUES('$plode[$y]','$id_event','$SFdatetime','$SFdatetime','$username','$plode1[$y]','$plode2[$y]')");
    }

    for($y=0; $y<$count_fac3 ;$y++){
        $update_gessay      = mysqli_query($connect, "INSERT INTO `hrmsurveygroupessay`(`id_group`, `id_event`, `created_date`, `modified_date`, `createdby`, `order`) 
        VALUES('$plode3[$y]','$id_event','$SFdatetime','$SFdatetime','$username','$plode4[$y]')");
    }
}else{
    $delete1    = mysqli_query($connect, "DELETE FROM hrmsurveygrouppertanyaan WHERE id_event = '$id_event'");
    $delete2    = mysqli_query($connect, "DELETE FROM hrmsurveygroupessay WHERE id_event = '$id_event'");

    for($y=0; $y<$count_fac ;$y++){
        $update_gpertanyaan = mysqli_query($connect, "INSERT INTO `hrmsurveygrouppertanyaan`(`id_group`, `id_event`, `created_date`, `modified_date`, `createdby`, `tipejawaban`, `order`) 
        VALUES('$plode[$y]','$id_event','$SFdatetime','$SFdatetime','$username','$plode1[$y]','$plode2[$y]')");
    }
}

// Update anggota event
if($all_anggota == 0){
    $delete_anggota     = mysqli_query($connect, "DELETE FROM hrmsurveyanggotaevent WHERE id_event = '$id_event'");
    for($y=0; $y<$count_anggota ;$y++){
        $update_anggota = mysqli_query($connect, "INSERT INTO `hrmsurveyanggotaevent`(`id_event`, `nip`, `created_date`, `modified_date`, `createdby`, `aksi`) 
        VALUES('$id_event','$anggota[$y]','$SFdatetime','$SFdatetime','$username','0')");
    }
}else{
    $delete_anggota     = mysqli_query($connect, "DELETE FROM hrmsurveyanggotaevent WHERE id_event = '$id_event'");
    $update_anggota     = mysqli_query($connect, "INSERT INTO `hrmsurveyanggotaevent` 
                            (`id_event`, `nip`, `created_date`, `modified_date`, `createdby`, `aksi`)
                        SELECT 
                            '$id_event' as id_event, username as nip, '$SFdatetime' as created_date, '$SFdatetime' as modified_date, '$username' as createdby, '0' as aksi
                        FROM 
                            `users`");
}


$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($update){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}

?>