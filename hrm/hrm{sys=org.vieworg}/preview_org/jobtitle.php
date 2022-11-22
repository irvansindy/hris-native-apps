<?php
include "../../../application/config.php";


$query_jobtittle    = mysqli_query($connect, "SELECT * FROM od_job_tittle a 
 ORDER BY a.order ASC");

if ($height != 0) {
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
    if ($order1 >= $data_height_min && $order1 <= $data_height_max) {
        $order = 1;
    }
    if ($order2 >= $data_height_min && $order2 <= $data_height_max) {
        $order = 2;
    }
    if ($order3 >= $data_height_min && $order3 <= $data_height_max) {
        $order = 3;
    }
    if ($order4 >= $data_height_min && $order4 <= $data_height_max) {
        $order = 4;
    }
    if ($order5 >= $data_height_min && $order5 <= $data_height_max) {
        $order = 5;
    }
    if ($order6 >= $data_height_min && $order6 <= $data_height_max) {
        $order = 6;
    }
    if ($order7 >= $data_height_min && $order7 <= $data_height_max) {
        $order = 7;
    }
    if ($order8 >= $data_height_min && $order8 <= $data_height_max) {
        $order = 8;
    }
    if ($order9 >= $data_height_min && $order9 <= $data_height_max) {
        $order = 9;
    }
    if ($order10 >= $data_height_min && $order10 <= $data_height_max) {
        $order = 10;
    }
    if ($order11 >= $data_height_min && $order11 <= $data_height_max) {
        $order = 11;
    }
    if ($order12 >= $data_height_min && $order12 <= $data_height_max) {
        $order = 12;
    }
    if ($order13 >= $data_height_min && $order13 <= $data_height_max) {
        $order = 13;
    }
    if ($order14 >= $data_height_min && $order14 <= $data_height_max) {
        $order = 14;
    }
} else {
    $order = 0;
}
?>


<table>
    <?php
    $num = 0;
    while ($jobtitle = mysqli_fetch_assoc($query_jobtittle)) {
    ?>


        <tr>
            <td align=left>
                <div style="margin-left:20px;font-size: 11px;font-family: verdana;"><b><?php echo $jobtitle['job_tittle_name'] ?></b></div>
            </td>
        </tr>
        <tr>
            <td>
                <div class="garistittle" style="height:110px; width:4px; background-color: #555454; margin-left:15px"></div>
            </td>
            <td>
                <div class="garistittle" style="height:1px; width:1000000000%; background-color: #5554541a; margin-left:15px;margin-top: 102px;"></div>
            </td>
        </tr>


    <?php

    }  ?>
</table>

<tr>
    <td>
        <div class="garistittle" style="height:4px; width:100000000%; background-color: #555454; margin-left:18px;margin-top: -8px;"></div>
    </td>
</tr>