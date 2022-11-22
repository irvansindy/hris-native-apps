<?php 

date_default_timezone_set('Asia/Bangkok'); 
$SFdatetime             = date("Y-m-d H:i:s");
$date_logo              = date("YmdHis");

include "../../../application/session/session_ess.php";
$username           = $_SESSION['username'];


$gtmo             = $_POST['gtmo'];
$pltac          = $_POST['pltac'];
$pltbhi          = $_POST['pltbhi'];
$pltdk          = $_POST['pltdk'];
$pltrem          = $_POST['pltrem'];

$gtmo_array = explode(",", $gtmo);
$pltac_array = explode(",", $pltac);
$pltbhi_array = explode(",", $pltbhi);
$pltdk_array = explode(",", $pltdk);
$pltrem_array = explode(",", $pltrem);

$count_gtmo = count($gtmo_array);
$count_pltac = count($pltac_array);
$count_pltbhi = count($pltbhi_array);
$count_pltdk = count($pltdk_array);
$count_pltrem = count($pltrem_array);

$truncate = mysqli_query($connect, "UPDATE `hrmconselor` SET 
`status`='0'");

for($i = 0; $i<$count_gtmo; $i++){
    $insert_gtmo = mysqli_query($connect, "UPDATE `hrmconselor` SET 
    `status`='1'
    WHERE pos_code = $gtmo_array[$i]");
}

for($i = 0; $i<$count_pltac; $i++){
    $insert_pltac = mysqli_query($connect, "UPDATE `hrmconselor` SET 
    `status`='1'
    WHERE pos_code = $pltac_array[$i]");
}

for($i = 0; $i<$count_pltbhi; $i++){
    $insert_pltbhi = mysqli_query($connect, "UPDATE `hrmconselor` SET 
    `status`='1'
    WHERE pos_code = $pltbhi_array[$i]");
}

for($i = 0; $i<$count_pltdk; $i++){
    $insert_pltdk = mysqli_query($connect, "UPDATE `hrmconselor` SET 
    `status`='1'
    WHERE pos_code = $pltdk_array[$i]");
}

for($i = 0; $i<$count_pltrem; $i++){
    $insert_pltrem = mysqli_query($connect, "UPDATE `hrmconselor` SET 
    `status`='1'
    WHERE pos_code = $pltrem_array[$i]");
}


$sql_alert_success  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '10'");
$date_alert_success = mysqli_fetch_assoc($sql_alert_success);

$sql_alert_failed  = mysqli_query($connect, "SELECT * FROM hrmalert WHERE id_alert = '11'");
$date_alert_failed = mysqli_fetch_assoc($sql_alert_failed);

if($insert_gtmo){
    if($insert_pltac){
        if($insert_pltbhi){
            if($insert_pltdk){
                if($insert_pltrem){
                    echo $date_alert_success['alert'];
                }else{
                    echo 'Ada plant yang belum dipilih konselor!';
                }
            }else{
                echo 'Ada plant yang belum dipilih konselor!';
            }
        }else{
            echo 'Ada plant yang belum dipilih konselor!';
        }
    }else{
        echo 'Ada plant yang belum dipilih konselor!';
    }
}else{
    echo 'Ada plant yang belum dipilih konselor!';
}



?>