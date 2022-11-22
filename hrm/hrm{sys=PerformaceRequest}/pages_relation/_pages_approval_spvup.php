<script>
$(document).ready(function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_requestform_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_requestform_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });

       
       $(".subTotal1_requestform").val(sum);
       $(".subTotal1_requestform").val(sum+sum1);
       document.getElementById("total_request_spv_up_print").innerHTML = sum+sum1;
       document.getElementById("total_request_spv_up").innerHTML = sum+sum1;
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
$(document).on("change", ".kpi_requestform_spv_up", function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_requestform_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_requestform_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });
       $(".subTotal1_requestform").val(sum);
       $(".subTotal1_requestform").val(sum+sum1);
       document.getElementById("total_request_spv_up_print").innerHTML = sum+sum1;
       document.getElementById("total_request_spv_up").innerHTML = sum+sum1;
});
$(document).on("change", ".kpi_requestform_spv_up_plus", function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_requestform_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_requestform_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });
       $(".subTotal1_requestform").val(sum);
       $(".subTotal1_requestform").val(sum+sum1);
       document.getElementById("total_request_spv_up_print").innerHTML = sum+sum1;
       document.getElementById("total_request_spv_up").innerHTML = sum+sum1;
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





<fieldset id="fset_1">
       <legend>KPI Detail</legend>
       <div class="card-body table-responsive p-0" style="width: 100%; height: 400px; margin: 1px;overflow: scroll;">


              <table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts_spv_up">
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
                                   <th nowrap="nowrap"><a class=" add-record" style="margin-right: 7px;"
                                                 data-added="0"><img src="../../asset/img/icons/acssadd.png"></a></th>
                            </tr>
                     </thead>
                     <?php
                                                               include "../../../application/config.php";
                                                               ?>
                     <tbody id="tbl_posts_spv_up_body">
                            <tr id="rec_spvup-1">
                                    <td><span class="sn">1</span>.</td>
                                   <td><select required class="form-control" id="inp_performance0"
                                                 name="inp_performance0[]" onfocus="hlentry(this)"
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
                                   <td><textarea required class="form-control" type="text" value=""
                                                 name="inp_performance1[]"
                                                 style="border: 1px solid #d7d7d7;width: 200px;"></textarea></td>
                                   <td><select required class="form-control" id="inp_performance2"
                                                 name="inp_performance2[]" onfocus="hlentry(this)"
                                                 onchange="formodified(this);"
                                                 style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                                 <option value="">--Select unit--</option>
                                                 <?php
                                                                                           $sql = mysqli_query($connect, "SELECT kpiunit_id,kpiunit_name FROM hrmperf_set_kpiunit");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['kpiunit_id'] ."'>" .$row['kpiunit_name'] ."</option>" ;
                                                                                           }
                                                                                           ?>
                                          </select></td>
                                   <td><input required class="form-control kpi_requestform_spv_up" id="inp_performance3" type="text" value="" onkeypress="return onlyNumberKey(event)"
                                                 name="inp_performance3[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                   <td><select required class="form-control" id="inp_performance4"
                                                 name="inp_performance4[]" onfocus="hlentry(this)"
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
                                   <td><input required class="form-control" type="text" value="" onkeypress="return onlyNumberKey(event)"
                                                 name="inp_performance5[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;width: 100px;width: 100px;">
                                   </td>
                                   <td><input required class="form-control" type="text" value="" onkeypress="return onlyNumberKey(event)"
                                                 name="inp_performance6[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;width: 100px;width: 100px;">
                                   </td>
                                   <td><select required class="form-control" id="inp_performance7"
                                                 name="inp_performance7[]" onfocus="hlentry(this)"
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
                                   <td><textarea required class="form-control" type="text" value=""
                                                 name="inp_performance8[]"
                                                 style="border: 1px solid #d7d7d7;width: 200px;"></textarea>
                                   </td>
                                   <td><select required class="form-control" id="inp_performance9"
                                                 name="inp_performance9[]" onfocus="hlentry(this)"
                                                 onchange="formodified(this);"
                                                 style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                                 <option value="">--Select low is good--</option>
                                                 <?php
                                                                                           $sql = mysqli_query($connect, "SELECT remark,var1 FROM db_config_str WHERE id IN ('15','16')");
                                                                                           $row = mysqli_num_rows($sql);
                                                                                           while ($row = mysqli_fetch_array($sql)){
                                                                                           echo "<option value='". $row['remark'] ."'>" .$row['var1'] ."</option>";
                                                                                           }
                                                                                           ?>
                                          </select></td>
                                   <td><a class="delete-record" data-added="0"><img
                                                        src="../../asset/img/icons/minus.png"></a></td>
                            </tr>
                           
                     </tbody>
              </table>







              <div style="display:none;">
                     <table id="sample_table" class="table table-bordered table-striped table-hover table-head-fixed">
                            <tr id="" class="reset-delete-record-spv-up">
                                   <td><span class="sn"></span>.</td>
                                   <td><select class="form-control" id="inp_performance0" name="inp_performance0[]"
                                                 onfocus="hlentry(this)" onchange="formodified(this);"
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
                                   <td><textarea class="form-control" type="text" value="" name="inp_performance1[]"
                                                 style="border: 1px solid #d7d7d7;width: 200px;"></textarea></td>
                                   <td><select class="form-control" id="inp_performance2" name="inp_performance2[]"
                                                 onfocus="hlentry(this)" onchange="formodified(this);"
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
                                   <td><input class="form-control kpi_requestform_spv_up_plus" type="text" value="" id="inp_performance3" name="inp_performance3[]" onkeypress="return onlyNumberKey(event)"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                   <td><select class="form-control" id="inp_performance4" name="inp_performance4[]"
                                                 onfocus="hlentry(this)" onchange="formodified(this);"
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
                                   <td><input class="form-control" type="text" value="" name="inp_performance5[]" onkeypress="return onlyNumberKey(event)"
                                                 style="border: 1px solid #d7d7d7;text-align: right;width: 100px;"></td>
                                   <td><input class="form-control" type="text" value="" name="inp_performance6[]" onkeypress="return onlyNumberKey(event)"
                                                 style="border: 1px solid #d7d7d7;text-align: right;width: 100px;"></td>
                                   <td><select class="form-control" id="inp_performance7" name="inp_performance7[]"
                                                 onfocus="hlentry(this)" onchange="formodified(this);"
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
                                   <td><textarea class="form-control" type="text" value="" name="inp_performance8[]"
                                                 style="border: 1px solid #d7d7d7;width: 200px;"></textarea>
                                   </td>
                                   <td><select class="form-control" id="inp_performance9" name="inp_performance9[]"
                                                 onfocus="hlentry(this)" onchange="formodified(this);"
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
                                   <td><a class="delete-record" data-added="0"><img
                                                        src="../../asset/img/icons/minus.png"></a></td>
                            </tr>
                           
                     </table>






  </div>
   </div>
              <table class="table table-bordered table-striped table-hover table-head-fixed" id="">
       
                     
                            <tr id="">
                                   <td style="width: 30%; font-weight: bold;color: green;text-align: center;"><span class="sn">Total Bobot </span>:</td>
                                   <td nowrap="nowrap"  align="center">
                                                 <div id="total_request_spv_up_print" style="font-weight: bold;text-align: right;color: #056805;">0</div>
                                                 <input type="hidden" name="total_request_spv_up" id="total_request_spv_up"
                                                        class="form-control subTotal1_requestform"
                                                        style="border: 1px solid #d7d7d7;text-align: right;">
                                          </td>
                                   <td colspan="5" style="width: 72%;"></td>
                            </tr>
                           

              </table>
            

    
       </div>

       
</fieldset>

<script>
    function onlyNumberKey(evt) {
          
        // Only ASCII character in that range allowed
        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }
</script>