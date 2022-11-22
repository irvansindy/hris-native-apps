<?php
include "../../../application/config.php";
$rfid = $_GET['rfid'];
$period = '3';
//$modal_id = '1';
$total_mpp = mysqli_fetch_array(mysqli_query($connect , "SELECT COUNT(*) AS total_value FROM view_employee WHERE cost_code LIKE '%HHA_350504_8001000000%'"));
$total_rat = mysqli_fetch_array(mysqli_query($connect , "SELECT ROUND(COUNT(*)/$total_mpp[total_value]) AS total_value FROM view_employee"));
$total_Ida = mysqli_fetch_array(mysqli_query($connect , "SELECT total_value FROM hrmperf_composite WHERE cost_code LIKE '%HHA_350504_8001000000%' AND pa_grade = 'A'"));
$total_Idb = mysqli_fetch_array(mysqli_query($connect , "SELECT total_value FROM hrmperf_composite WHERE cost_code LIKE '%HHA_350504_8001000000%' AND pa_grade = 'B'"));
$total_Idc = mysqli_fetch_array(mysqli_query($connect , "SELECT total_value FROM hrmperf_composite WHERE cost_code LIKE '%HHA_350504_8001000000%' AND pa_grade = 'C'"));
$total_Idd = mysqli_fetch_array(mysqli_query($connect , "SELECT total_value FROM hrmperf_composite WHERE cost_code LIKE '%HHA_350504_8001000000%' AND pa_grade = 'D'"));
$total_Ide = mysqli_fetch_array(mysqli_query($connect , "SELECT total_value FROM hrmperf_composite WHERE cost_code LIKE '%HHA_350504_8001000000%' AND pa_grade = 'E'"));
$total_Fra = mysqli_fetch_array(mysqli_query($connect , "SELECT COUNT(*) AS total_value FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'A'"));
$total_Frb = mysqli_fetch_array(mysqli_query($connect , "SELECT COUNT(*) AS total_value FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'B'"));
$total_Frc = mysqli_fetch_array(mysqli_query($connect , "SELECT COUNT(*) AS total_value FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'C'"));
$total_Frd = mysqli_fetch_array(mysqli_query($connect , "SELECT COUNT(*) AS total_value FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'D'"));
$total_Fre = mysqli_fetch_array(mysqli_query($connect , "SELECT COUNT(*) AS total_value FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'E'"));
$total_Pra = mysqli_fetch_array(mysqli_query($connect , "SELECT ROUND(COUNT(*)/$total_Ida[total_value]*100) AS percent FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'A'"));
$total_Prb = mysqli_fetch_array(mysqli_query($connect , "SELECT ROUND(COUNT(*)/$total_Idb[total_value]*100) AS percent FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'B'"));
$total_Prc = mysqli_fetch_array(mysqli_query($connect , "SELECT ROUND(COUNT(*)/$total_Idc[total_value]*100) AS percent FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'C'"));
$total_Prd = mysqli_fetch_array(mysqli_query($connect , "SELECT ROUND(COUNT(*)/$total_Idd[total_value]*100) AS percent FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'D'"));
$total_Pre = mysqli_fetch_array(mysqli_query($connect , "SELECT ROUND(COUNT(*)/$total_Ide[total_value]*100) AS percent FROM hrmperf_finalresult a LEFT JOIN view_employee b on a.request_for=b.emp_no WHERE b.cost_code LIKE '%HHA_350504_8001000000%' AND a.pa_grade = 'E'"));
?>

<div class="col-md-1">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(248deg, #348ac7, #7474bf);color: white;width: 117px;">
       <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.26)">
                     <h4 class="card-title mb-0 digital">Total Manpower </h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 33px;">
              <?php echo $total_mpp['total_value']; ?>
       </div>
</div>
</div>

<div class="col-md-1">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #8edead, #43c6ac);color: white;width: 117px;">
       <div class="card-header d-flex align-items-center" style="border-bottom: 1px solid rgba(255, 255, 255, 0.26)">
                     <h4 class="card-title mb-0 digital">Total Ratio </h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 33px;">
              <?php echo $total_rat['total_value']; ?>%
       </div>
</div>
</div>

<div class="col-md-2">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd);">
       <div class="card-header d-flex align-items-center digital">
                     <h4 class="card-title mb-0">Grade A | Quota : <?php echo $total_Ida['total_value']; ?> </h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 33px;">
            <?php echo $total_Fra['total_value']; ?>
              <div class="progress-container" style="margin-top: -70px;width: 105px;text-align: right;margin-left: 114px;">                         
                     <div class="progress">
                            <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="<?php echo $total_Pra['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_Pra['percent']; ?>%;cursor: pointer;">
                            </div>
                     </div>
              </div>
       </div>
       <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
</div>
</div>
<div class="col-md-2">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd);">
       <div class="card-header d-flex align-items-center digital">
                     <h4 class="card-title mb-0">Grade B | Quota : <?php echo $total_Idb['total_value']; ?> </h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 33px;">
              <?php echo $total_Frb['total_value']; ?>
              <div class="progress-container" style="margin-top: -70px;width: 105px;text-align: right;margin-left: 114px;">                         
                     <div class="progress">
                            <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="<?php echo $total_Prb['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_Prb['percent']; ?>%;cursor: pointer;">
                            </div>
                     </div>
              </div>
       </div>
       <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
</div>
</div>
<div class="col-md-2">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd);">
       <div class="card-header d-flex align-items-center digital">
                     <h4 class="card-title mb-0">Grade C | Quota : <?php echo $total_Idc['total_value']; ?> </h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 33px;">
              <?php echo $total_Frc['total_value']; ?>
              <div class="progress-container" style="margin-top: -70px;width: 105px;text-align: right;margin-left: 114px;">                         
                     <div class="progress">
                            <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="<?php echo $total_Prc['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_Prc['percent']; ?>%;cursor: pointer;">
                            </div>
                     </div>
              </div>
       </div>
       <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
</div>
</div>
<div class="col-md-2">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd);">
       <div class="card-header d-flex align-items-center digital">
                     <h4 class="card-title mb-0">Grade D | Quota : <?php echo $total_Idd['total_value']; ?> </h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 33px;">
       <?php echo $total_Frd['total_value']; ?>
       <div class="progress-container" style="margin-top: -70px;width: 105px;text-align: right;margin-left: 114px;">                         
                     <div class="progress">
                            <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="<?php echo $total_Prd['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_Prd['percent']; ?>%;cursor: pointer;">
                            </div>
                     </div>
              </div>
       </div>
       <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
</div>
</div>
<div class="col-md-2">
<div class="card" style="padding-right: 5px;padding-left: 5px; height: 74px;border-radius: 1px;background: linear-gradient(229deg, #e4e4e424, #ddd);">
       <div class="card-header d-flex align-items-center digital">
                     <h4 class="card-title mb-0">Grade E | <strong>Quota : <?php echo $total_Ide['total_value']; ?></strong> </h4>
       </div>
       <div class="digital" style="font-weight: bold;text-align: center;font-size: 33px;">
       <?php echo $total_Fre['total_value']; ?>
       <div class="progress-container" style="margin-top: -70px;width: 105px;text-align: right;margin-left: 114px;">                         
                     <div class="progress">
                            <div class="progress-bar progress-bar-info1" role="progressbar" aria-valuenow="<?php echo $total_Pre['percent']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $total_Pre['percent']; ?>%;cursor: pointer;">
                            </div>
                     </div>
              </div>
       </div>
       <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
</div>
</div>