<?php 
include "../../../application/session/session_ess.php";

$username           = $_SESSION['username'];

$n1     = $_POST['n1'];
$n2     = $_POST['n2'];
$n3     = $_POST['n3'];
$n4     = $_POST['n4'];
$n5     = $_POST['n5'];
$essay  = $_POST['essay'];


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

// Kirim group pertanyaan ke midtemp
for($y=0; $y<$count_fac ;$y++){
    $kirim      =  mysqli_query($connect, "INSERT INTO `hrmsurveygrouppertanyaan_mid`(`id_group`, `tipejawaban`, `order`, `created_by`) 
                   VALUES('$plode[$y]','$plode1[$y]','$plode2[$y]','$username')");
}
// Kirim group pertanyaan ke midtemp

// Kirim group essay ke midtemp
if($essay == 1){
    for($y=0; $y<$count_fac3 ;$y++){
        $kirim1      =  mysqli_query($connect, "INSERT INTO `hrmsurveygroupessay_mid`(`id_group`, `order`, `created_by`) 
                       VALUES('$plode3[$y]','$plode4[$y]','$username')");
    }
}

// Kirim group essay ke midtemp

// Melihat data sama gpertanyaan
$sql_val_gpertanyaan    = mysqli_query($connect, "SELECT 
a.id_group,
COUNT(a.id_group) AS total
FROM hrmsurveygrouppertanyaan_mid a
WHERE a.created_by = '$username'
GROUP BY a.id_group
HAVING COUNT(a.id_group) > 1");

$val_gpertanyaan        = mysqli_num_rows($sql_val_gpertanyaan);
// Melihat data sama gpertanyaan

// Melihat data sama tipejawaban
$sql_val_tipejawaban    = mysqli_query($connect, "SELECT 
a.tipejawaban,
COUNT(a.tipejawaban) AS total
FROM hrmsurveygrouppertanyaan_mid a
WHERE a.created_by = '$username'
GROUP BY a.tipejawaban
HAVING COUNT(a.tipejawaban) >= 1");

$val_tipejawaban        = mysqli_num_rows($sql_val_tipejawaban);
// Melihat data sama tipejawaban

// Melihat data sama order
$sql_val_order    = mysqli_query($connect, "SELECT 
a.order,
COUNT(a.order) AS total
FROM hrmsurveygrouppertanyaan_mid a
WHERE a.created_by = '$username'
GROUP BY a.order
HAVING COUNT(a.order) > 1");

$val_order        = mysqli_num_rows($sql_val_order);
// Melihat data sama order

if($essay == 1){
    // Melihat data sama gessay
    $sql_val_gessay    = mysqli_query($connect, "SELECT 
    a.id_group,
    COUNT(a.id_group) AS total
    FROM hrmsurveygroupessay_mid a
    WHERE a.created_by = '$username'
    GROUP BY a.id_group
    HAVING COUNT(a.id_group) > 1");

    $val_gessay        = mysqli_num_rows($sql_val_gessay);
    // Melihat data sama gessay

    // Melihat data sama orderessay
    $sql_val_orderessay    = mysqli_query($connect, "SELECT 
    a.order,
    COUNT(a.order) AS total
    FROM hrmsurveygroupessay_mid a
    WHERE a.created_by = '$username'
    GROUP BY a.order
    HAVING COUNT(a.order) > 1");

    $val_orderessay        = mysqli_num_rows($sql_val_orderessay);
    // Melihat data sama order
}


$validasi         = 0;
if($val_order > 0){
    $validasi     = 3;
}
if($val_tipejawaban == 0){
    $validasi     = 2;
}
if($val_tipejawaban > 1){
    $validasi     = 2;
}
if($val_gpertanyaan > 0){
    $validasi     = 1;
}

if($essay == 1){
    if($val_orderessay > 0){
        $validasi   = 5;
    }
    if($val_gessay > 0){
        $validasi   = 4;
    }
}

$truncate           = mysqli_query($connect, "DELETE FROM hrmsurveygroupessay_mid WHERE created_by = '$username'");
$truncate1          = mysqli_query($connect, "DELETE FROM hrmsurveygrouppertanyaan_mid WHERE created_by = '$username'");

echo $validasi;

?>