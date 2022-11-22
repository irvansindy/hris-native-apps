<script>
$(document).ready(function() {
       var sum = 0;
       $(".kpi_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
       document.getElementById("total_request_spv_up_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_request_spv_up_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_request_spv_up_print").innerHTML = sum;
});
$(document).on("change", ".kpi_spv_up", function() {
       var sum = 0;
       $(".kpi_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
       document.getElementById("total_request_spv_up_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgmidyear_spv_up", function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_request_spv_up_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgfullyear_spv_up", function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_request_spv_up_print").innerHTML = sum;
});
</script>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts">
       <thead>
              <tr>
                     <th nowrap="nowrap">No. </th>
                     <th nowrap="nowrap">Perspektif </th>
                     <th nowrap="nowrap">KPI </th>
                     <th nowrap="nowrap">Unit </th>
                     <th nowrap="nowrap">Bobot KPI / KPI Weight (%) (B)</th>
                     <th nowrap="nowrap">Improvement / Regular Activity</th>
                     <th nowrap="nowrap">Target Mid Year</th>
                     <th nowrap="nowrap">Full Year</th>
                     <th nowrap="nowrap">Periodical Review</th>
                     <th nowrap="nowrap">Desc/Remarks</th>
                     <th nowrap="nowrap">KPI Valuation</th>

              </tr>
       </thead>
       <?php
                                                                      include "../../../application/config.php";
                                                                      $rfid = $_GET['rfid'];
                                                                      //$modal_id = '1';
                                                                      $no = 1;
                                                                      $modal=mysqli_query($connect, "SELECT 
                                                                                                         a.*,
                                                                                                         b.perspektif_name,
                                                                                                         c.kpiunit_name,
                                                                                                         d.orgkpitype_name,
                                                                                                         e.reviewperiod_name,
                                                                                                         f.var1
                                                                                                                FROM 
                                                                                                         hrdperf_ipprequest a
                                                                                                         LEFT JOIN hrmperf_set_kpiperspektif b on a.kpi_perspektif_id=b.perspektif_id
                                                                                                         LEFT JOIN hrmperf_set_kpiunit c on a.kpi_unit=c.kpiunit_id
                                                                                                         LEFT JOIN hrmperf_set_orgkpitype d on a.kpi_type_id=d.orgkpitype_id
                                                                                                         LEFT JOIN hrmperf_set_reviewperiod e on a.kpi_reviewperiod_id=e.reviewperiod_id
                                                                                                         LEFT JOIN db_config_str f on a.kpi_lg=f.remark AND f.id IN ('15','16')
                                                                                                         WHERE a.ipp_reqno = '$rfid'");

                                                                      while($row_performance = mysqli_fetch_array($modal)){
                                                               ?>
       <tbody id="tbl_posts_body">
              <tr id="rec-1">
                     <td><span class="sn"><?php echo $no++; ?></span>.</td>
                     <td><select readonly id="inp_performance0" name="inp_performance_spvup_approver0[]"
                                   onfocus="hlentry(this)" onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_perspektif_id']; ?>">
                                          <?php echo $row_performance['perspektif_name']; ?></option>
                                   <!-- <php
                                                                                           $sql = mysqli_query($connect, "SELECT perspektif_id,perspektif_name FROM hrmperf_set_kpiperspektif");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['perspektif_id'] ."'>" .$row['perspektif_name'] ."</option>" ;
                                                                                           }
                                                                                           ?> -->
                            </select></td>
                     <td><textarea readonly type="text" value="" class="form-control"
                                   name="inp_performance_spvup_approver1[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;height: 50px;"><?php echo $row_performance['kpi_name']; ?></textarea>
                     </td>
                     <td><select readonly class="form-control" id="inp_performance2"
                                   name="inp_performance_spvup_approver2[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_unit']; ?>">
                                          <?php echo $row_performance['kpiunit_name']; ?></option>
                                   <!-- <php
                                                                                           $sql = mysqli_query($connect, "SELECT kpiunit_id,kpiunit_name FROM hrmperf_set_kpiunit");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['kpiunit_id'] ."'>" .$row['kpiunit_name'] ."</option>" ;
                                                                                           }
                                                                                           ?> -->
                            </select></td>
                     <td><input readonly class="form-control kpi_spv_up" type="text"
                                   value="<?php echo $row_performance['kpi_bobot']; ?>"
                                   name="inp_performance_spvup_approver3[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><select readonly class="form-control" id="inp_performance4"
                                   name="inp_performance_spvup_approver4[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_type_id']; ?>">
                                          <?php echo $row_performance['orgkpitype_name']; ?></option>
                                   <!-- <php
                                                                                           $sql = mysqli_query($connect, "SELECT orgkpitype_id,orgkpitype_name FROM hrmperf_set_orgkpitype");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['orgkpitype_id'] ."'>" .$row['orgkpitype_name'] ."</option>" ;
                                                                                           }
                                                                                           ?> -->
                            </select></td>
                     <td><input readonly class="form-control" type="text"
                                   value="<?php echo $row_performance['kpi_midyear_trg']; ?>"
                                   name="inp_performance_spvup_approver5[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input readonly class="form-control" type="text"
                                   value="<?php echo $row_performance['kpi_fullyear_trg']; ?>"
                                   name="inp_performance_spvup_approver6[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <!-- <td><input readonly class="form-control" type="text"
                                   value="<php echo $row_performance['kpi_reviewperiod_id']; ?>"
                                   name="inp_performance_spvup_approver7[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td> -->
                     <td><select readonly class="form-control" id="inp_performance_spvup_approver7"
                                   name="inp_performance_spvup_approver7[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_reviewperiod_id']; ?>">
                                          <?php echo $row_performance['reviewperiod_name']; ?></option>
                                          <?php
                                                 $sql = mysqli_query($connect, "SELECT reviewperiod_id,reviewperiod_name FROM hrmperf_set_reviewperiod");
                                                 $row = mysqli_num_rows($sql);
                                                 while ($row = mysqli_fetch_array($sql)){
                                                 echo "<option value='". $row['reviewperiod_id'] ."'>" .$row['reviewperiod_name'] ."</option>" ;
                                          }
                                          ?>
                            </select>
                     </td>
                     <td>
                            <textarea readonly class="form-control" type="text" value=""
                                   name="inp_performance_spvup_approver8[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['remark']; ?></textarea>
                     </td>
                     <td>
                            <select readonly class="form-control" id="inp_performance_spvup_approver9"
                                   name="inp_performance_spvup_approver9[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_lg']; ?>">
                                          <?php echo $row_performance['var1']; ?></option>
                                   <!-- <php
                                                                                           $sql = mysqli_query($connect, "SELECT var1 FROM db_config_str WHERE var1 <> '$row_performance[var1]' AND id IN ('15','16')");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                                  echo "<option value='". $row['var1'] ."'>" .$row['var1'] ."</option>" ;
                                                                                           }
                                                                                    ?> -->
                            </select>
                     </td>
              </tr>
       </tbody>
       <?php } ?>
</table>


</div>

</div>
       <table class="table table-bordered table-striped table-hover table-head-fixed" id="">
              <tr id="">
                     <td style="width: 30%; font-weight: bold;color: green;text-align: center;"><span class="sn">Total Bobot
                            </span>:</td>
                     <td nowrap="nowrap" align="center">
                            <div id="total_request_spv_up_print" style="font-weight: bold;text-align: right;color: #056805;">
                                   10</div>
                            <input type="hidden" name="total_request_spv_up" id="total_request_spv_up"
                                   class="form-control subTotal1 subTotal"
                                   style="border: 1px solid #d7d7d7;text-align: right;">
                     </td>
                     <td colspan="5" style="width: 72%;"></td>
              </tr>
       </table>
</div>