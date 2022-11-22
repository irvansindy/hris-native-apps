<?php

// Deklarasi variable untuk koneksi ke database.
include "../../application/session/session.php";

// Deklarasi variable keyword buah.
$pos_code = $_POST['pos_code'];

// Query ke database.
$sql_get_wl  = mysqli_query($connect, "SELECT 
a.lstworklocation
FROM hrmorgstruc a WHERE a.position_id = '$pos_code'");

// Fetch hasil query.
$get_wl     = mysqli_fetch_assoc($sql_get_wl);

$sql_wl     = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a WHERE a.worklocation_code NOT IN ('$get_wl[lstworklocation]')");

$sql_wl_selected     = mysqli_query($connect, "SELECT 
a.worklocation_code,
a.worklocation_name
FROM teomworklocation a WHERE a.worklocation_code = '$get_wl[lstworklocation]'");

$data_wl_selected   = mysqli_fetch_assoc($sql_wl_selected);

$output      = "";
$output     .= "<select class='input--style-6' name='pemisahan_work_location' id='pemisahan_work_location' style='width: ;height: 30px;'>";

while($data_sql = mysqli_fetch_assoc($sql_wl)){

    $output .= "<option value='".$data_sql['worklocation_code']."'>".$data_sql['worklocation_name']."</option>";
}
    $output .= "<option value='".$data_wl_selected['worklocation_code']."' selected>".$data_wl_selected['worklocation_name']."</option>";


$output     .= "</select>";

echo $output;

?>

    
