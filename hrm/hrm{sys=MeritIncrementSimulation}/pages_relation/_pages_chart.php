<?php
include "../../../application/config.php";
$period = $_GET['ip_period'];
$get_budget = mysqli_fetch_array(mysqli_query($connect, "SELECT total_value FROM hrmperf_comparatio_annual_budget WHERE ip_period = '$period'"));
$get_avg = mysqli_fetch_array(mysqli_query($connect, "SELECT AVG(total_value) AS total_value FROM hrmperf_comparatio WHERE ip_period = '$period'"));
?>

<div class="col-md-6" >

<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(248deg, #348ac7, #7474bf);color: white;">
    <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.26)">
        <h4 class="card-title mb-0 digital">Annual Salary Increment Budget </h4>
    </div>
    <div class="digital" style="font-weight: bold;text-align: center;font-size: 25px;cursor: pointer;" data-toggle="modal" data-target="#UpdateForm" onclick="UpdateForm(`<?php echo $period; ?>`)">
        <?php echo number_format($get_budget['total_value'],2); ?><span style="font-size: 17px;">%</span>
        <a class="waves-effect waves-dark" style="position: absolute;cursor: pointer;" >
            <img alt="Porto" style="margin-top: -28px;width: 17px;" src="../../asset/img/icons/acticon-note.png">
            <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
        </a>
    </div>
</div>


</div>

<div class="col-md-6">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #8edead, #43c6ac);color: white;">
       <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.26)">
                     <h4 class="card-title mb-0 digital">Matrix Average</h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 25px;">
       <?php echo number_format($get_avg['total_value'],2); ?><span style="font-size: 17px;">%</span>
       </div>
</div>
</div>



<table id="datatable" class="table table-bordered table-striped table-hover table-head-fixed dataTable no-footer" role="grid" aria-describedby="datatable_info" style="border-right: 4px solid #f2f2f2; width: 100%;" width="100%" border="1" align="left">
    <?php
    

    echo '<tr>
            <th rowspan="2" colspan="2" class="digital" style="font-weight: bold;vertical-align: middle; text-align: center; z-index: 1; width: 407.867px; background-color: rgb(66, 133, 197); color: white; height: 24px; vertical-align: middle;" href="#">Performance</th> ';

    $sql = mysqli_query($connect, "SELECT * FROM hrmperf_comparatio WHERE ip_period = '$period' GROUP BY index_percentage_horizontal, compa_ratio_id ORDER BY index_percentage_horizontal DESC");
    while ($r = mysqli_fetch_array($sql)) {
        echo '<th align="center" class="digital"  data-toggle="modal" data-target="#HoriAxis" onclick="HoriAxis(`'.$r['index_percentage_horizontal'].'#'.$r['ip_period'].'#'.$r['compa_ratio_id'].'`)" style="cursor: pointer;font-weight: bold;vertical-align: middle; text-align: center; z-index: 1; width: 407.867px; background-color: rgb(66, 133, 197); color: white; height: 24px;" href="#">' . $r['index_percentage_horizontal'] . '% <img alt="Porto" style="margin-top: -7px;width: 17px;" src="../../asset/img/icons/acticon-note.png"></th>';
        $x1 .= $r['index_percentage_horizontal'];
    }

    echo '</tr>';

    echo '<tr>
             ';

    $sql = mysqli_query($connect, "SELECT * FROM hrmperf_comparatio WHERE ip_period = '$period' GROUP BY index_percentage_horizontal, compa_ratio_id ORDER BY index_percentage_horizontal DESC");
    while ($r = mysqli_fetch_array($sql)) {
        echo '<th nowrap="nowrap" class="digital" align="center" style="font-weight: bold;vertical-align: middle; text-align: center; z-index: 1; width: 407.867px; background-color: rgb(66, 133, 197); color: white; height: 24px;" href="#">' . $r['compa_ratio_name'] . '</th>';
        $x1 .= $r['index_percentage_horizontal'];
    }

    echo '</tr>';



    $sql = mysqli_query($connect, "SELECT * FROM hrmperf_comparatio WHERE ip_period = '$period' GROUP BY index_percentage_vertical , performance ORDER BY performance DESC");

    while ($r = mysqli_fetch_array($sql)) {

        // $key0   .= $r['ip_period'];
        // $key1   .= $r['index_percentage_horizontal'];
        // $key2   .= $r['index_percentage_vertical'];

        $key00   = $r['ip_period'];
        $key01   = $r['index_percentage_horizontal'];
        $key02   = $r['index_percentage_vertical'];
        $key03   = $r['compa_ratio_id'];
        $key04   = $r['performance'];


        $sql_1  = "SELECT * FROM hrmperf_comparatio WHERE 
                                        ip_period = '$period' AND 
                                        compa_ratio_id = '1' AND
                                        index_percentage_vertical = '$key02'  
                                        GROUP BY index_percentage_vertical 
                                        ORDER BY index_percentage_vertical DESC";
        $sql_x1 = mysqli_query($connect, $sql_1);
        $r_x1 = mysqli_fetch_array($sql_x1);

        $sql_2  = "SELECT * FROM hrmperf_comparatio WHERE 
                                        ip_period = '$period' AND 
                                        compa_ratio_id = '2' AND
                                        index_percentage_vertical = '$key02'  
                                        GROUP BY index_percentage_vertical 
                                        ORDER BY index_percentage_vertical DESC";
        $sql_x2 = mysqli_query($connect, $sql_2);
        $r_x2 = mysqli_fetch_array($sql_x2);

        $sql_3  = "SELECT * FROM hrmperf_comparatio WHERE 
                                        ip_period = '$period' AND 
                                        compa_ratio_id = '3' AND
                                        index_percentage_vertical = '$key02'  
                                        GROUP BY index_percentage_vertical 
                                        ORDER BY index_percentage_vertical DESC";
        $sql_x3 = mysqli_query($connect, $sql_3);
        $r_x3 = mysqli_fetch_array($sql_x3);

        $sql_4  = "SELECT * FROM hrmperf_comparatio WHERE 
                                        ip_period = '$period' AND 
                                        compa_ratio_id = '4' AND
                                        index_percentage_vertical = '$key02'  
                                        GROUP BY index_percentage_vertical 
                                        ORDER BY index_percentage_vertical DESC";
        $sql_x4 = mysqli_query($connect, $sql_4);
        $r_x4 = mysqli_fetch_array($sql_x4);

        $sql_5  = "SELECT * FROM hrmperf_comparatio WHERE 
                                        ip_period = '$period' AND 
                                        compa_ratio_id = '5' AND
                                        index_percentage_vertical = '$key02'  
                                        GROUP BY index_percentage_vertical 
                                        ORDER BY index_percentage_vertical DESC";
        $sql_x5 = mysqli_query($connect, $sql_5);
        $r_x5 = mysqli_fetch_array($sql_x5);
    ?>
        <tr>
            <td href="#" nowrap class="digital" style="cursor: pointer;font-weight: bold;vertical-align: middle;" align="center" data-toggle="modal" data-target="#VertAxis" onclick="VertAxis(`<?php echo $r['index_percentage_vertical'];  ?>#<?php echo $key00;  ?>#<?php echo $key04;  ?>`)"><?php echo $r['index_percentage_vertical']; ?>% <img alt="Porto" style="margin-top: -7px;width: 17px;" src="../../asset/img/icons/acticon-note.png"></td>
            <td href="#" nowrap class="digital" align="center" data-toggle="modal" data-target="#VertAxis" onclick="VertAxis(`<?php echo $r['index_percentage_vertical'];  ?>#<?php echo $key00; ?>#<?php echo $key04;  ?>`)"><?php echo $r['performance']; ?></td>
            <td href="#" nowrap class="digital" align="center"><?php echo number_format($r_x1['total_value'],2) ; ?> %</td>
            <td href="#" nowrap class="digital" align="center"><?php echo number_format($r_x2['total_value'],2); ?> %</td>
            <td href="#" nowrap class="digital" align="center"><?php echo number_format($r_x3['total_value'],2); ?> %</td>
            <td href="#" nowrap class="digital" align="center"><?php echo number_format($r_x4['total_value'],2); ?> %</td>
            <td href="#" nowrap class="digital" align="center"><?php echo number_format($r_x5['total_value'],2); ?> %</td>
    </tr>
    <?php
    }
    ?>
    </tbody>