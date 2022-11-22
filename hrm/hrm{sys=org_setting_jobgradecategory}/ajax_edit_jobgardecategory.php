<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];


$grade_list         = $_POST['grade_list'];
$array_gradelist    = '['.$grade_list.']';
$array_test         = explode(',',$grade_list);
$json_decode        = json_decode($array_gradelist, TRUE);
$len                = count($array_test);

$grade_category_code        = $_POST['grade_category_code'];
$grade_category_name        = $_POST['grade_category_name'];

// Update di job grade
for($i = 0; $i<$len; $i++){
    $update_jobgrade    = mysqli_query($connect, "UPDATE `teomjobgrade` SET 
    `gradecategory_code`='$grade_category_code',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `grade_code` = '$array_test[$i]'");
}
// Update di job grade

// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `teomgradecategory` SET 
    `gradecategory_name`='$grade_category_name',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `gradecategory_code` = '$grade_category_code'");
// Update di job Grade Category


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