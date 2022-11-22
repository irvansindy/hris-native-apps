<?php
include "../../../application/config.php";
$period = $_GET['ip_period'];
$get_annual_budget = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                    A.total_value
                                                                FROM hrmperf_comparatio_annual_budget A
                                                                WHERE A.ip_period = '$period'"));
                                                            
$get_budget = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                            SUM(A.basic_salary)*($get_annual_budget[total_value]/100) AS total_value
                                                            FROM v_hrmperf_comparatio_calc A
                                                            WHERE A.ip_period = '$period'"));
                                                            
$get_realize = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                            SUM((A.basic_salary*C.total_value)/100) AS total_value
                                                            FROM v_hrmperf_comparatio_calc A
                                                            LEFT JOIN 
                                                            (
                                                            SELECT 
                                                            sub1.index_range,
                                                            sub1.range_name,
                                                            sub1.range_start,
                                                            sub1.range_end
                                                            FROM hrmperf_comparatio_range sub1
                                                            GROUP BY sub1.range_name
                                                            ) B ON (ROUND(A.basic_salary/A.avg_salary, 2)*100) BETWEEN 
                                                            B.range_start AND B.range_end
                                                            LEFT JOIN hrmperf_comparatio C ON B.index_range=C.compa_ratio_id AND A.order_no=C.performance
                                                            LEFT JOIN view_employee D ON A.emp_no=D.emp_no
                                                            WHERE A.ip_period = '$period'"));
?>

<div class="col-md-4" >

<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd); ">
    <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.26)">
        <h4 class="card-title mb-0 digital">Total Increase Merit Budget IDR </h4>
    </div>
    <div class="digital" style="font-weight: bold;text-align: center;font-size: 25px;cursor: pointer;color: #7a7878;">
        <?php echo number_format($get_budget['total_value'],2); ?>
        <a class="waves-effect waves-dark" style="position: absolute;cursor: pointer;" >
        <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-3.svg">
         
        </a>
    </div>
</div>
</div>


<div class="col-md-4" >

<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd); ">
    <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.26)">
        <h4 class="card-title mb-0 digital">Total Increase Merit Spend </h4>
    </div>
    <div class="digital" style="font-weight: bold;text-align: center;font-size: 25px;cursor: pointer;color: #7a7878;">
        <?php echo number_format($get_realize['total_value'],2); ?>
        <a class="waves-effect waves-dark" style="position: absolute;cursor: pointer;" >
        <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
         
        </a>
    </div>
</div>
</div>

<div class="col-md-4" >

<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd); ">
    <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.26)">
        <h4 class="card-title mb-0 digital">GAP </h4>
    </div>
    <div class="digital" style="font-weight: bold;text-align: center;font-size: 25px;cursor: pointer;color: #7a7878;">
        <?php echo number_format($get_budget['total_value']-$get_realize['total_value'],2); ?>
        <a class="waves-effect waves-dark" style="position: absolute;cursor: pointer;" >
        <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
         
        </a>
    </div>
</div>
</div>