<script>
$(document).ready(function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_revised_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_revised_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });

       
       $(".subTotal1_revised_spv_up").val(sum);
       $(".subTotal1_revised_spv_up").val(sum1);
       document.getElementById("total_revised_spv_up_print").innerHTML = sum+sum1;
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
$(document).on("change", ".kpi_revised_spv_up", function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_revised_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_revised_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });
       $(".subTotal1_revised_spv_up").val(sum);
       $(".subTotal1_revised_spv_up").val(sum1);
       document.getElementById("total_revised_spv_up_print").innerHTML = sum+sum1;
});
$(document).on("change", ".kpi_revised_spv_up_plus", function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_revised_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_revised_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });
       $(".subTotal1_revised_spv_up").val(sum);
       $(".subTotal1_revised_spv_up").val(sum1);
       document.getElementById("total_revised_spv_up_print").innerHTML = sum+sum1;
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

       <?php
              include "../../../application/config.php";
              $rfid = $_GET['rfid'];
              $data_on = mysqli_fetch_array(mysqli_query($connect, "SELECT revised_remark FROM hrmrequestapproval WHERE request_no = '$rfid' AND revised_remark IS NOT NULL ORDER BY revised_remark LIMIT 1"));
       ?>
        
       <div class="form-row">
               <div class="col-4 name">Revised Remark <span class="required">*</span></div>
               <div class="col-sm-7 name">
                      <div class="input-group">
                             <input type="text" value="<?php echo $data_on['revised_remark']; ?>"
                                    style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;width: 256px;padding-left: 10px;background: #1e88e521;"
                                    readonly name="inp_SpvUPManpower" id="inp_SpvUPManpower">
                      </div>
               </div>
       </div>



<table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts_four">
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
                     <th nowrap="nowrap">LG</th>
                     <th nowrap="nowrap"><a class="add-record_four" style="margin-right: 7px;" data-added="0"><img src="../../asset/img/icons/acssadd.png"></a></th>
              </tr>
       </thead>
       
       <tbody id="tbl_posts_body_four">
              <?php
                          
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
              <tr id="recfour-<?php echo $no; ?>">
                     <td><span class="sn"><?php echo $no; ?></span>.</td>
                     <td><select id="inp_performance_spvup_revised0" name="inp_performance_spvup_revised0[]"
                                   onfocus="hlentry(this)" onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_perspektif_id']; ?>">
                                          <?php echo $row_performance['perspektif_name']; ?></option>
                                          <?php
                                                 $sql = mysqli_query($connect, "SELECT perspektif_id,perspektif_name FROM hrmperf_set_kpiperspektif");
                                                 $row = mysqli_num_rows($sql);
                                                 while ($row = mysqli_fetch_array($sql)) {
                                                        echo "<option value='". $row['perspektif_id'] ."'>" .$row['perspektif_name'] ."</option>";
                                                 }
                                          ?>
                            </select></td>
                     <td><textarea class="form-control" type="text" value="" name="inp_performance_spvup_revised1[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['kpi_name']; ?></textarea>
                     </td>
                     <td><select id="inp_performance_spvup_revised2" name="inp_performance_spvup_revised2[]"
                                   onfocus="hlentry(this)" onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_unit']; ?>">
                                          <?php echo $row_performance['kpiunit_name']; ?></option>
                                          <?php
                                                 $sql = mysqli_query($connect, "SELECT kpiunit_id,kpiunit_name FROM hrmperf_set_kpiunit");
                                                 $row = mysqli_num_rows($sql);
                                                 while ($row = mysqli_fetch_array($sql)){
                                                        echo "<option value='". $row['kpiunit_id'] ."'>" .$row['kpiunit_name'] ."</option>" ;
                                                 }
                                          ?>
                            </select></td>
                     <td><input type="text" class="form-control kpi_revised_spv_up"
                                   value="<?php echo $row_performance['kpi_bobot']; ?>"
                                   name="inp_performance_spvup_revised3[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><select id="inp_performance_spvup_revised4" name="inp_performance_spvup_revised4[]"
                                   onfocus="hlentry(this)" onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_type_id']; ?>">
                                          <?php echo $row_performance['orgkpitype_name']; ?></option>
                                          <?php
                                          $sql = mysqli_query($connect, "SELECT orgkpitype_id,orgkpitype_name FROM hrmperf_set_orgkpitype");
                                          $row = mysqli_num_rows($sql);
                                          while ($row = mysqli_fetch_array($sql))
                                          {
                                                 echo "<option value='". $row['orgkpitype_id'] ."'>" .$row['orgkpitype_name'] ."</option>" ;
                                          }
                                          ?>
                            </select></td>
                     <td><input class="form-control" type="text"
                                   value="<?php echo $row_performance['kpi_midyear_trg']; ?>"
                                   name="inp_performance_spvup_revised5[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input class="form-control" type="text"
                                   value="<?php echo $row_performance['kpi_fullyear_trg']; ?>"
                                   name="inp_performance_spvup_revised6[]"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><select class="form-control" id="inp_performance_spvup_revised7"
                                   name="inp_performance_spvup_revised7[]" onfocus="hlentry(this)"
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
                            </select></td>
                     <td><textarea class="form-control" type="text" value="" name="inp_performance_spvup_revised8[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['remark']; ?></textarea>
                     </td>

                     <td><select class="form-control" id="inp_performance_spvup_revised9"
                                   name="inp_performance_spvup_revised9[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_lg']; ?>">
                                          <?php echo $row_performance['var1']; ?></option>
                                   <?php
                                                                                                         $sql = mysqli_query($connect, "SELECT var1 FROM db_config_str WHERE id IN ('15','16')");
                                                                                                         $row = mysqli_num_rows($sql);
                                                                                                         while ($row = mysqli_fetch_array($sql)){
                                                                                                         echo "<option value='". $row['var1'] ."'>" .$row['var1'] ."</option>" ;
                                                                                                         }
                                                                                                         ?>
                            </select></td>
                     <td><a class="delete-record_four_parent" data-id="<?php echo $no++; ?>" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
              </tr>
<?php } ?>
       </tbody>
       
</table>





<div style="display:none;">
       <table id="sample_table_four" class="table table-bordered table-striped table-hover table-head-fixed">
              <tr id="" class="reset-delete-record">
                     <td><span class="sn"></span>.</td>
                     <td><select class="form-control" id="inp_performance_spvup_revised0"
                                   name="inp_performance_spvup_revised0[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="">--Select perspective--</option>
                                   <?php
                                                                                           $sql = mysqli_query($connect, "SELECT perspektif_id,perspektif_name FROM hrmperf_set_kpiperspektif");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['perspektif_id'] ."'>" .$row['perspektif_name'] ."</option>" ;
                                                                                           }
                                                                                           ?>
                            </select></td>
                     <td><textarea class="form-control" type="text" value="" name="inp_performance_spvup_revised1[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"></textarea></td>
                     <td><select class="form-control" id="inp_performance_spvup_revised2"
                                   name="inp_performance_spvup_revised2[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="">--Select unit --</option>
                                   <?php
                                                                                           $sql = mysqli_query($connect, "SELECT kpiunit_id,kpiunit_name FROM hrmperf_set_kpiunit");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['kpiunit_id'] ."'>" .$row['kpiunit_name'] ."</option>" ;
                                                                                           }
                                                                                           ?>
                            </select></td>
                     <td><input class="form-control kpi_revised_spv_up_plus" type="text" value="" id="inp_performance_spvup_revised3"
                                   name="inp_performance_spvup_revised3[]" onkeypress="return onlyNumberKey(event)"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><select class="form-control" id="inp_performance_spvup_revised4"
                                   name="inp_performance_spvup_revised4[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="">--Select activity--</option>
                                   <?php
                                                                                           $sql = mysqli_query($connect, "SELECT orgkpitype_id,orgkpitype_name FROM hrmperf_set_orgkpitype");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['orgkpitype_id'] ."'>" .$row['orgkpitype_name'] ."</option>" ;
                                                                                           }
                                                                                           ?>
                            </select></td>
                     <td><input class="form-control" type="text" value="" name="inp_performance_spvup_revised5[]"
                                   onkeypress="return onlyNumberKey(event)"
                                   style="border: 1px solid #d7d7d7;text-align: right;width: 100px;"></td>
                     <td><input class="form-control" type="text" value="" name="inp_performance_spvup_revised6[]"
                                   onkeypress="return onlyNumberKey(event)"
                                   style="border: 1px solid #d7d7d7;text-align: right;width: 100px;"></td>
                     <td><select class="form-control" id="inp_performance_spvup_revised7"
                                   name="inp_performance_spvup_revised7[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="">--Select review--</option>
                                   <?php
                                                                                           $sql = mysqli_query($connect, "SELECT reviewperiod_id,reviewperiod_name FROM hrmperf_set_reviewperiod");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['reviewperiod_id'] ."'>" .$row['reviewperiod_name'] ."</option>" ;
                                                                                           }
                                                                                           ?>
                            </select></td>
                     <td><textarea class="form-control" type="text" value="" name="inp_performance_spvup_revised8[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"></textarea>
                     </td>
                     <td><select class="form-control" id="inp_performance_spvup_revised9"
                                   name="inp_performance_spvup_revised9[]" onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="">--Select low is good--</option>
                                   <?php
                                                                                           $sql = mysqli_query($connect, "SELECT remark,var1 FROM db_config_str WHERE id IN ('15','16')");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['remark'] ."'>" .$row['var1'] ."</option>" ;
                                                                                           }
                                                                                           ?>
                            </select></td>
                     <td><a class="delete-record_four" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
              </tr>

       </table>
</div>
       <table class="table table-bordered table-striped table-hover table-head-fixed" id="">
              <tr id="">
                     <td style="width: 30%; font-weight: bold;color: green;text-align: center;"><span class="sn">Total Bobot
                            </span>:</td>
                     <td nowrap="nowrap" align="center">
                            <div id="total_revised_spv_up_print" style="font-weight: bold;text-align: right;color: #056805;">0
                            </div>
                            <input type="hidden" name="total_request_spv_up" id="total_request_spv_up"
                                   class="form-control subTotal1_revised_spv_up subTotal"
                                   style="border: 1px solid #d7d7d7;text-align: right;">
                     </td>
                     <td colspan="5" style="width: 72%;"></td>
              </tr>
       </table>
</div>



<script>
function onlyNumberKey(evt) {

       // Only ASCII character in that range allowed
       var ASCIICode = (evt.which) ? evt.which : evt.keyCode
       if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
              return false;
       return true;
}
</script>