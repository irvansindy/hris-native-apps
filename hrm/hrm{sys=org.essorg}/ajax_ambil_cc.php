<?php

// Deklarasi variable untuk koneksi ke database.
include "../../application/session/session.php";

// Deklarasi variable keyword buah.
$pos_code = $_POST['pos_code'];

// Query ke database.
$sql_get_cc  = mysqli_query($connect, "SELECT 
a.costcenter_code
FROM hrmorgstruc a WHERE a.position_id = '$pos_code'");

// Fetch hasil query.
$get_cc     = mysqli_fetch_assoc($sql_get_cc);

$sql_cc     = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a
WHERE a.costcenter_code NOT IN ('$get_cc[costcenter_code]')");

$sql_cc_selected     = mysqli_query($connect, "SELECT 
a.costcenter_code,
a.costcenter_name_en
FROM teomcostcenter a
WHERE a.costcenter_code = '$get_cc[costcenter_code]'");

$data_cc_selected   = mysqli_fetch_assoc($sql_cc_selected);

$output      = "";
$output     .= "<select class='input--style-6' name='peleburan_cost_center' id='peleburan_cost_center' style='width: ;height: 30px;'>";

while($data_sql = mysqli_fetch_assoc($sql_cc)){

    $output .= "<option value='".$data_sql['costcenter_code']."'>".$data_sql['costcenter_name_en']."</option>";
}
    $output .= "<option value='".$data_cc_selected['costcenter_code']."' selected>".$data_cc_selected['costcenter_name_en']."</option>";


$output     .= "</select>";

echo $output;

?>

    
