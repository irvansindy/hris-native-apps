<?php

// Deklarasi variable untuk koneksi ke database.
include "../../application/session/session.php";

// Deklarasi variable keyword buah.
$pos_code = $_POST['pos_code'];
$number   = $_POST['number'];
$view     = $_POST['view'];

if($number == '0'){
    if($view == '1'){
        $name = "peleburan_work_location[]";
        $id = "peleburan_work_location";
    }else{
        $name = "peleburan_work_location_view[]";
        $id = "peleburan_work_location_view";
    }
}else{
    if($view == '1'){
        $name = "peleburan_work_location[]";
        $id = "peleburan_work_location".$number;
    }else{
        $name = "peleburan_work_location_view[]";
        $id = "peleburan_work_location_view".$number;
    }
}

// Query ke database.
$sql_get_wl  = mysqli_query($connect, "SELECT 
a.lstworklocation
FROM hrmorgstruc a WHERE a.pos_code = '$pos_code'");

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

$count_wl_selected  = mysqli_num_rows($sql_wl_selected);

$data_wl_selected   = mysqli_fetch_assoc($sql_wl_selected);

$output      = "";
$output     .= "<select class='input--style-6' name='".$name."' id='".$id."' style='width: ;height: 30px;'>";
$output     .= "<option value=''>Choose Work Location</option>";

while($data_sql = mysqli_fetch_assoc($sql_wl)){

    $output .= "<option value='".$data_sql['worklocation_code']."'>".$data_sql['worklocation_name']."</option>";
}
if($count_wl_selected != 0){
    $output .= "<option value='".$data_wl_selected['worklocation_code']."' selected>".$data_wl_selected['worklocation_name']."</option>";
}

$output     .= "</select>";

echo $output;

?>

    
