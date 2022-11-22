<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];

$position_id            = $_POST['position_id'];
$unit_code              = $_POST['unit_code'];
$parent_code            = $_POST['parent_code'];
$unit_name_en           = $_POST['unit_name_en'];
$unit_name_id           = $_POST['unit_name_id'];
$org_level              = $_POST['org_level'];
$status                 = $_POST['status'];
$head_pos               = $_POST['head_pos'];
$acting_as              = $_POST['acting_as'];
$chart_level            = $_POST['chart_level'];
$chart_order            = $_POST['chart_order'];


// Update di job Grade Category
$update     = mysqli_query($connect, "UPDATE `hrmorgstruc` SET 
    `pos_code`='$unit_code',
    `parent_id`='$parent_code',
    `pos_name_en`='$unit_name_en',
    `pos_name_id`='$unit_name_id',
    `org_level`='$org_level',
    `pos_active`='$status',
    `head_div`='$head_pos',
    `report_postype`='$acting_as',
    `clevel`='$chart_level',
    `corder`='$chart_order',
    `modified_date`='$SFdatetime',
    `modified_by`='$username'
    WHERE `position_id` = '$position_id'");
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