<?php

// Deklarasi variable untuk koneksi ke database.
include "../../application/session/session.php";

// Deklarasi variable keyword buah.
$pos_code = $_POST['pos_code'];

// Query ke database.
$sql_get_js  = mysqli_query($connect, "SELECT 
a.jobstatuscode
FROM hrmorgstruc a WHERE a.position_id = '$pos_code'");

// Fetch hasil query.
$get_js     = mysqli_fetch_assoc($sql_get_js);

$sql_js     = mysqli_query($connect, "SELECT 
a.jobstatuscode,
a.jobstatusname_en
FROM teomjobstatus a
WHERE a.jobstatuscode NOT IN ( '$get_js[jobstatuscode]' )");

$sql_js_selected     = mysqli_query($connect, "SELECT 
a.jobstatuscode,
a.jobstatusname_en
FROM teomjobstatus a
WHERE a.jobstatuscode = '$get_js[jobstatuscode]'");

$data_js_selected   = mysqli_fetch_assoc($sql_js_selected);

$output      = "";
$output     .= "<select class='input--style-6' name='pemisahan_job_status' id='pemisahan_job_status' style='width: ;height: 30px;'>";

while($data_sql = mysqli_fetch_assoc($sql_js)){

    $output .= "<option value='".$data_sql['jobstatuscode']."'>".$data_sql['jobstatusname_en']."</option>";
}
    $output .= "<option value='".$data_js_selected['jobstatuscode']."' selected>".$data_js_selected['jobstatusname_en']."</option>";


$output     .= "</select>";

echo $output;

?>

    
