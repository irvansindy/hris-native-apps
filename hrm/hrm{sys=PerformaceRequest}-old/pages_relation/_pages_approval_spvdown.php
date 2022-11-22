<script>
$(document).ready(function() {
       var sum = 0;
       $(".kpi_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
        document.getElementById("total_request_spv_down_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_request_spv_down_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_request_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpi_spv_down", function() {
       var sum = 0;
       $(".kpi_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
       document.getElementById("total_request_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgmidyear_spv_down", function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_request_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgfullyear_spv_down", function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_request_spv_down_print").innerHTML = sum;
});
</script>




<fieldset id="fset_1">
       <legend>KPI Detail load</legend>

       <div class="card-body table-responsive p-0" style="width: 100%; height:300px; margin: 1px;overflow: scroll;">
              <link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
              <table class="table table-bordered table-hover table-head-fixed">
                     <thead>
                            <tr>
                                   <th>No.</th>
                                   <th>Attitude </th>
                                   <th>Bobot (B)</th>
                                   <th>Target</th>
                                   <th>Target Mid Year</th>
                                   <th>Full Year</th>
                            </tr>
                     </thead>
                     <tbody>

                            <?php
                     include "../../../application/config.php";
                     $row_no = 0;
                     $rfid = $_GET['rfid'];
                     $sql_attitude = mysqli_query($connect, "SELECT 
                                                               a.att_item,
                                                               a.att_name,
                                                               a.bobot
                                                               FROM 
                                                               hrdperf_set_period b
                                                               LEFT JOIN hrmperf_set_attitude a ON b.kpi_perspektif_type=a.kpi_perspektif_type
                                                               WHERE b.emp_no='$rfid' AND
                                                               b.period_id = (SELECT MAX(x1.period_id) FROM hrdperf_set_period x1 WHERE x1.emp_no = '$rfid')");
                     $row_attitude = mysqli_num_rows($sql_attitude);
                                   while ($row_attitude = mysqli_fetch_array($sql_attitude)){
                                                 $row_no++ ;
              ?>


                            <tr id="recs-1">
                                   <td><?php echo $row_no; ?>.</td>
                                   <td align="center"><select readonly required class="form-control" id="sel_currency_code"
                                                               name="inp_attitude0[]" onfocus="hlentry(this)"
                                                               onchange="formodified(this);"
                                                               style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                                        <option value="<?php echo $row_attitude['att_item']; ?>">
                                                        <?php echo $row_attitude['att_name']; ?></option>
                                                 <!-- <php
                                                                             $sql = mysqli_query($connect, "SELECT att_item,att_name FROM hrmperf_set_attitude");
                                                                             $row = mysqli_num_rows($sql);
                                                                             while ($row = mysqli_fetch_array($sql)){
                                                                             echo "<option value='". $row['att_item'] ."'>" .$row['att_name'] ."</option>" ;
                                                                             }
                                                                             ?> -->
                                          </select></td>
                                   <td align="center"><input readonly required class="form-control kpi_spv_down" type="text"
                                                 autocomplete="off" id="spv_down<?php echo $row_no; ?>"
                                                 onchange="addspv_down()" value="<?php echo $row_attitude['bobot']; ?>" name="inp_attitude1[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                   <td align="center"><textarea required class="form-control" type="text" 
                                                 name="inp_attitude2[]" style="border: 1px solid #d7d7d7;"></textarea>
                                   </td>
                                   <td align="center"><input required class="form-control kpitrgmidyear_spv_down"
                                                 type="text" autocomplete="off" value="" name="inp_attitude3[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                   <td align="center"><input required class="form-control kpitrgfullyear_spv_down" type="text"
                                                 autocomplete="off" value="" name="inp_attitude4[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;"></td>
                            </tr>

                            <?php } ?>
                      
                                   <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                          <td colspan="2" style="font-weight: bold;color: green;text-align: center;">Total</td>
                                          <td align="center">
                                                 <div id="total_request_spv_down_print" style="font-weight: bold;text-align: right;color: #056805;">0</div>
                                                 <input type="hidden" name="total_request_spv_down" id="total_request_spv_down"
                                                        class="form-control subTotal1 subTotal"
                                                        style="border: 1px solid #d7d7d7;text-align: right;">
                                          </td>
                                          <td colspan="1">&nbsp;</td>
                                          <td align="center">
                                                 <div id="total_trgmidyear_request_spv_down_print" style="font-weight: bold;text-align: right;color: #056805;">0</div>
                                                 <input type="hidden" name="total_trgmidyear_request_spv_down"
                                                        class="form-control subTotal2 subTotal"
                                                        style="border: 1px solid #d7d7d7;text-align: right;">
                                          </td>
                                          <td align="center">
                                                 <div id="total_trgfullyear_request_spv_down_print" style="font-weight: bold;text-align: right;color: #056805;">0</div>
                                                 <input type="hidden" name="total_trgfullyear_request_spv_down"
                                                        class="form-control subTotal3 subTotal"
                                                        style="border: 1px solid #d7d7d7;text-align: right;">
                                          </td>
                                   </tr>

                     </tbody>
              </table>
              <div>
       <div>
</div>



</fieldset>