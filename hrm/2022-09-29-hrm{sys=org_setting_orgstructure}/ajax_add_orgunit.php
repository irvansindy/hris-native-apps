<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../application/session/session.php";
$username           = $_SESSION['username'];

$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '6'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '7'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);


$unit_code              = $_POST['unit_code'];
$parent_code            = $_POST['parent_code'];
$unit_name_en           = $_POST['unit_name_en'];
$unit_name_id           = $_POST['unit_name_id'];
$org_level              = $_POST['org_level'];
$status                 = $_POST['status'];
$acting_as              = $_POST['acting_as'];
$chart_level            = $_POST['chart_level'];
$chart_order            = $_POST['chart_order'];

// Validasi 
$sql_validasi_poscode   = mysqli_query($connect, "SELECT * FROM hrmorgstruc WHERE pos_code = '$unit_code'");
$validasi_poscode       = mysqli_num_rows($sql_validasi_poscode);
// Validasi

// Mencari position id terakhir
$sql_position_id        = mysqli_query($connect, "SELECT 
a.position_id
FROM hrmorgstruc a 
ORDER BY a.created_date DESC
LIMIT 1");

$data_position_id       = mysqli_fetch_assoc($sql_position_id);
$position_id            = $data_position_id['position_id'] + 1;
// Mencari position id terakhir

// Mengambil data pos level posisi yang dijadikan parent
$sql_pos_level          = mysqli_query($connect, "SELECT 
a.pos_level,
a.parent_path
FROM 
hrmorgstruc a
WHERE a.position_id = '$parent_code'");
$data_pos_level         = mysqli_fetch_assoc($sql_pos_level);
$pos_level              = $data_pos_level['pos_level'] + 1;
$parent_path            = $data_pos_level['parent_path'].','.$parent_code;
// Mengambil data pos level posisi yang dijadikan parent

if($validasi_poscode == '0'){



$insert     = mysqli_query($connect, "INSERT INTO `hrmorgstruc`
(`position_id`,   
`pos_code`, 
`company_id`, 
`parent_id`, 
`pos_name_en`, 
`pos_name_id`,
`pos_name_my`, 
`pos_name_th`,
`jobdesc_en`, 
`jobdesc_id`,
`jobdesc_my`, 
`jobdesc_th`,
`pos_level`, 
`parent_path`,
`pos_flag`, 
`pos_active`,
`dept_id`, 
`dorder`,
`report_topos`, 
`clevel`,
`corder`, 
`changeflag`,
`report_postype`, 
`created_date`,
`created_by`,
`modified_date`,
`modified_by`,
`org_level`,
`lstworklocation`, 
`lstgradecode`,
`head_div`, 
`jobtitle_code`,
`jobstatuscode`, 
`costcenter_code`,
`require_successor`, 
`filename`,
`backup_position`, 
`skip_approver`) 
VALUES (
'$position_id',
'$unit_code',
'13576',
'$parent_code',
'$unit_name_en',
'$unit_name_id',
'',
'',
'',
'',
'',
'',
'$pos_level',
'$parent_path',
'1',
'$status',
'$parent_code',
'99',
'0',
'$chart_level',
'$chart_order',
'',
'$acting_as',
'$SFdatetime',
'$username',
'$SFdatetime',
'$username',
'$org_level',
'',
'',
'',
'',
'',
'',
'N',
'',
'',
''
)");

if($insert){
    echo $date_alert_success['alert'];
}else{
    echo $date_alert_failed['alert'];
}


}else{
    echo $date_alert_failed['alert'].', there is same unit code used before!';
}




?>