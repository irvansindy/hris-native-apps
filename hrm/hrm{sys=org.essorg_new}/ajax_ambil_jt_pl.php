<?php

// Deklarasi variable untuk koneksi ke database.
include "../../application/session/session.php";

// Deklarasi variable keyword buah.
$pos_code = $_POST['pos_code'];
$number   = $_POST['number'];
$view     = $_POST['view'];

if($number == '0'){
    if($view == '1'){
        $name = "peleburan_job_title[]";
        $id = "peleburan_job_title";
    }else{
        $name = "peleburan_job_title_view[]";
        $id = "peleburan_job_title_view";
    }
}else{
    if($view == '1'){
        $name = "peleburan_job_title[]";
        $id = "peleburan_job_title".$number;
    }else{
        $name = "peleburan_job_title_view[]";
        $id = "peleburan_job_title_view".$number;
    }
}

// Query ke database.
$sql_get_jt  = mysqli_query($connect, "SELECT 
a.jobtitle_code
FROM hrmorgstruc a WHERE a.pos_code = '$pos_code'");

// Fetch hasil query.
$get_jt     = mysqli_fetch_assoc($sql_get_jt);

$sql_jt     = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a
WHERE a.jobtitle_code NOT IN ( '$get_jt[jobtitle_code]' )");

$sql_jt_selected     = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a
WHERE a.jobtitle_code = '$get_jt[jobtitle_code]'");

$data_jt_selected   = mysqli_fetch_assoc($sql_jt_selected);

$output      = "";
$output     .= "<select class='input--style-6' name='".$name."' id='".$id."' style='width: ;height: 30px;'>";

while($data_sql = mysqli_fetch_assoc($sql_jt)){

    $output .= "<option value='".$data_sql['jobtitle_code']."'>".$data_sql['jobtitle_name_en']."</option>";
}
    $output .= "<option value='".$data_jt_selected['jobtitle_code']."' selected>".$data_jt_selected['jobtitle_name_en']."</option>";


$output     .= "</select>";

echo $output;

?>

    
