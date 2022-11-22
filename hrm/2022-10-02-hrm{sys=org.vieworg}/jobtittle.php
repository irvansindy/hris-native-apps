<?php 
include "../../application/config.php"; 
$height     = isset($_POST['height']) ? $_POST['height'] : 0;
$table      = $_POST['valpage'];
$level      = isset($_POST['level']) ? $_POST['level'] : 0;
$bisa       = isset($_POST['bisa']) ? $_POST['bisa'] : 'x';

$filter     = $_POST['filter'];



// $query_data_order   = mysqli_query($connect, "SELECT 
// MAX(a.orderId) AS ordermax,
// MIN(a.orderId) AS ordermin 
// FROM simposisi a");
// if($level == '2'){

// if($filter == '1'){
//     $query_data_order   = mysqli_query($connect, "SELECT 
//     MAX(a.orderId) AS ordermax,
//     MIN(a.orderId) AS ordermin 
//     FROM simposisi a
//     WHERE a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%'");
// }elseif($filter == '2'){
//     $query_data_order   = mysqli_query($connect, "SELECT 
//     MAX(a.orderId) AS ordermax,
//     MIN(a.orderId) AS ordermin 
//     FROM simposisi a
//     WHERE a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%'");
// }elseif($filter == '3'){
//     if($level != '1'){
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         MAX(a.orderId) AS ordermax,
//         MIN(a.orderId) AS ordermin 
//         FROM simposisi a
//         WHERE a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%'");
//     }else{
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         MAX(a.orderId) AS ordermax,
//         MIN(a.orderId) AS ordermin 
//         FROM simposisi a
//         WHERE a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%'");
//     }
// }

if($filter == '1'){
    $query_data_order   = mysqli_query($connect, "SELECT 
    MAX(a.orderId) AS ordermax,
    MIN(a.orderId) AS ordermin 
    FROM od_simposisi a
    WHERE a.departemen_id = '$table'");
}elseif($filter == '2'){
     if($table == '30145'){
        $query_data_order   = mysqli_query($connect, "SELECT 
        MAX(a.orderId) AS ordermax,
        '2' AS ordermin 
        FROM od_simposisi a
        WHERE a.division_id = '$table'");
    }else{
    $query_data_order   = mysqli_query($connect, "SELECT 
    MAX(a.orderId) AS ordermax,
    MIN(a.orderId) AS ordermin 
    FROM od_simposisi a
    WHERE a.division_id = '$table'");
    }
}elseif($filter == '3'){
    if($table == 'all'){
        $query_data_order   = mysqli_query($connect, "SELECT 
            MAX(a.orderId) AS ordermax,
            MIN(a.orderId) AS ordermin 
            FROM od_simposisidir a");

    }else{

    
        if($level != '1'){
            $query_data_order   = mysqli_query($connect, "SELECT 
            MAX(a.orderId) AS ordermax,
            MIN(a.orderId) AS ordermin 
            FROM od_simposisi a
            WHERE a.direktorat_id = '$table'");
        }else{
            $query_data_order   = mysqli_query($connect, "SELECT 
            MAX(a.orderId) AS ordermax,
            MIN(a.orderId) AS ordermin 
            FROM od_simposisi a
            WHERE a.direktorat_id = '$table'
            ");
        }
    }
}

// if($filter == '1'){
//     $query_data_order   = mysqli_query($connect, "SELECT 
//     a.orderId AS ordera,
//     b.orderId AS orderb
//     FROM simposisi a 
//     LEFT JOIN simposisi b ON b.posisi_id = a.parent
//     WHERE (a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%')
//     ORDER BY a.orderId ASC");
// }elseif($filter == '2'){
//     $query_data_order   = mysqli_query($connect, "SELECT 
//     a.orderId AS ordera,
//     b.orderId AS orderb
//     FROM simposisi a 
//     LEFT JOIN simposisi b ON b.posisi_id = a.parent
//     WHERE (a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%')
//     ORDER BY a.orderId ASC");
// }elseif($filter == '3'){
//     if($level != '1'){
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         a.orderId AS ordera,
//         b.orderId AS orderb
//         FROM simposisi a 
//         LEFT JOIN simposisi b ON b.posisi_id = a.parent
//         WHERE (a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%')
//         ORDER BY a.orderId ASC");
//     }else{
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         a.orderId AS ordera,
//         b.orderId AS orderb
//         FROM simposisi a 
//         LEFT JOIN simposisi b ON b.posisi_id = a.parent
//         WHERE (a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%')
//         ORDER BY a.orderId ASC");
//     }
// }

$count_row  = mysqli_num_rows($query_data_order);
// $data_order = mysqli_fetch_array($query_data_order);
// }elseif($level == '1'){
//     if($bisa == '0'){
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         MAX(a.orderId) AS ordermax,
//         MIN(a.orderId) AS ordermin 
//         FROM simposisi a");
//     }else{
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         MAX(a.orderId) AS ordermax,
//         MIN(a.orderId) AS ordermin 
//         FROM simposisi a
//         WHERE a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%'");
//     }
// }elseif($level == '0'){
//     if($bisa == '0'){
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         MAX(a.orderId) AS ordermax,
//         MIN(a.orderId) AS ordermin 
//         FROM simposisi a");
//     }else{
//         $query_data_order   = mysqli_query($connect, "SELECT 
//         MAX(a.orderId) AS ordermax,
//         MIN(a.orderId) AS ordermin 
//         FROM simposisi a
//         WHERE a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%'");
//     }
// }

$data_order         = mysqli_fetch_assoc($query_data_order);
$data_min           = $data_order['ordermin'];
$data_max           = $data_order['ordermax'];

$query_jobtittle    = mysqli_query($connect, "SELECT * FROM od_job_tittle a 
WHERE (a.`order` >= '$data_min' AND a.`order`<= '$data_max') ORDER BY a.order ASC");

// $query_jobtittle_sama   = mysqli_query($connect, "SELECT 
// a.nama_posisi,
// (a.orderId) AS ordera,
// b.orderId AS orderb
// FROM simposisi a 
// LEFT JOIN simposisi b ON b.posisi_id = a.parent
// WHERE ((a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%')
// AND (b.parent_path LIKE '%$table%' OR b.parent_path_reference LIKE '%$table%'))
// AND a.orderId = b.orderId
// ORDER BY a.orderId ASC");
// $data_jobtittle     = mysqli_fetch_assoc($query_jobtittle);

if($height != 0){
    $order1             = 190.37;
    $order2             = 417;
    $order3             = 643.68;
    $order4             = 870.26;
    $order5             = 1096.89;
    $order6             = 1323.52;
    $order7             = 1550.15;
    $order8             = 1776.78;
    $order9             = 2003.41;
    $order10            = 2230.04;
    $order11            = 2456.67;
    $order12            = 2683.3;
    $order13            = 2909.93;
    $order14            = 3136.56;
    $data_height_max    = $height + 85;
    $data_height_min    = $height - 85;
    // $order              = 0; 
    if($order1 >= $data_height_min && $order1 <= $data_height_max){
        $order = 1;
    }
    if($order2 >= $data_height_min && $order2 <= $data_height_max){
        $order = 2;
    }
    if($order3 >= $data_height_min && $order3 <= $data_height_max){
        $order = 3;
    }
    if($order4 >= $data_height_min && $order4 <= $data_height_max){
        $order = 4;
    }
    if($order5 >= $data_height_min && $order5 <= $data_height_max){
        $order = 5;
    }
    if($order6 >= $data_height_min && $order6 <= $data_height_max){
        $order = 6;
    }
    if($order7 >= $data_height_min && $order7 <= $data_height_max){
        $order = 7;
    }
    if($order8 >= $data_height_min && $order8 <= $data_height_max){
        $order = 8;
    }
    if($order9 >= $data_height_min && $order9 <= $data_height_max){
        $order = 9;
    }
    if($order10 >= $data_height_min && $order10 <= $data_height_max){
        $order = 10;
    }
    if($order11 >= $data_height_min && $order11 <= $data_height_max){
        $order = 11;
    }
    if($order12 >= $data_height_min && $order12 <= $data_height_max){
        $order = 12;
    }
    if($order13 >= $data_height_min && $order13 <= $data_height_max){
        $order = 13;
    }
    if($order14 >= $data_height_min && $order14 <= $data_height_max){
        $order = 14;
    }
}else{
    $order = 0;
}
?>




<table>
<?php
$num = 0;
while($jobtitle = mysqli_fetch_assoc($query_jobtittle)){

    // if(isset($_POST['height'])){
        if($num == $order){
            break;
        }
    // }
?>

<tr>
                                <td>
                                    <div class="garistittle" style="height:85px; width:4px; background-color: black; margin-left:15px"></div>
                                </td>
                            </tr>
                            <tr>
                                <td align=left>
                                    <div style="margin-left:20px"><b><?php echo $jobtitle['job_tittle_name'] ?></b></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="garistittle" style="height:120.5px; width:4px; background-color: black; margin-left:15px"></div>
                                </td>
                            </tr>

<?php

    $query_jobtittle_sama   = mysqli_query($connect, "SELECT 
    a.nama_posisi,
    a.orderId AS ordera,
    b.orderId AS orderb
    FROM od_simposisi a 
    LEFT JOIN od_simposisi b ON b.posisi_id = a.parent
    WHERE ((a.parent_path LIKE '%$table%' OR a.parent_path_reference LIKE '%$table%')
    AND (b.parent_path LIKE '%$table%' OR b.parent_path_reference LIKE '%$table%'))
    AND a.orderId = b.orderId
    AND a.orderId = '$jobtitle[order]'
    ORDER BY a.orderId ASC");

    $num_sama   = mysqli_num_rows($query_jobtittle_sama);
    
if($num_sama == '0'){
?>

<?php }else{ 

$num++; 

// if(isset($_POST['height'])){
    if($num == $order){
        break;
    }
// }

?>
    <tr>
                                <td>
                                    <div class="garistittle" style="height:85px; width:4px; background-color: black; margin-left:15px"></div>
                                </td>
                            </tr>
                            <tr>
                                <td align=left>
                                    <div style="width:4px; background-color: black; margin-left:15px"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="garistittle" style="height:120.5px; width:4px; background-color: black; margin-left:15px"></div>
                                </td>
                            </tr>
<?php 

} $num++; } ?>
</table>



                    
               