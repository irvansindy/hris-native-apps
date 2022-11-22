<script>
$(document).ready(function() {
       var sum = 0;
       $(".kpi_revised_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
       document.getElementById("total_revised_spv_down_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_revised_spv_down_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_revised_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpi_revised_spv_down", function() {
       var sum = 0;
       $(".kpi_revised_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal1").val(sum);
       document.getElementById("total_revised_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgmidyear_spv_down", function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_revised_spv_down_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgfullyear_spv_down", function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_down").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_revised_spv_down_print").innerHTML = sum;
});
</script>




<fieldset id="fset_1">
       
        <legend>KPI Detail</legend>

        <?php
              include "../../../application/config.php";
              $rfid = $_GET['rfid'];
              $data = mysqli_fetch_array(mysqli_query($connect, "SELECT revised_remark FROM hrmrequestapproval WHERE request_no = '$rfid' AND revised_remark IS NOT NULL ORDER BY revised_remark LIMIT 1"));
        ?>

       <div class="form-row">
               <div class="col-4 name">Revised Remark <span class="required">*</span></div>
               <div class="col-sm-7 name">
                      <div class="input-group">
                             <input type="text" value="<?php echo $data['revised_remark']; ?>"
                                    style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;width: 256px;padding-left: 10px;background: #1e88e521;"
                                    readonly name="inp_SpvUPManpower" id="inp_SpvUPManpower">
                      </div>
               </div>
       </div>


        <div class="card-body table-responsive p-0" style="width: 99%; margin: 1px;overflow: scroll;">
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
                    
                     $row_no = 0;
                     
                     $sql_attitude = mysqli_query($connect, "SELECT
                                                               b.*,
                                                               a.att_name,
                                                               c.kpi_perspektif_type
                                                               FROM 
                                                               hrmperf_parequest_stfsc b
                                                               LEFT JOIN hrdperf_set_period c ON b.requester=c.emp_no AND b.ip_period=c.period_id
                                                               LEFT JOIN hrmperf_set_attitude a ON b.att_item=a.att_item AND c.kpi_perspektif_type=a.kpi_perspektif_type
                                                               WHERE b.pa_reqno = '$rfid'");

                     $row_attitude = mysqli_num_rows($sql_attitude);
                                   while ($row_attitude = mysqli_fetch_array($sql_attitude)){
                                                 $row_no++ ;
              ?>


                             <tr id="recs-1">
                                    <td><?php echo $row_no; ?>.</td>
                                    <td align="center"><select class="form-control" id="sel_currency_code"
                                                  name="inp_attitude_revised0[]" onfocus="hlentry(this)"
                                                  onchange="formodified(this);"
                                                  style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                                  <option value="<?php echo $row_attitude['att_item']; ?>">
                                                         <?php echo $row_attitude['att_name']; ?></option>
                                                  <?php
                                                                             $sql = mysqli_query($connect, "SELECT att_item,att_name FROM hrmperf_set_attitude");
                                                                             $row = mysqli_num_rows($sql);
                                                                             while ($row = mysqli_fetch_array($sql)){
                                                                             echo "<option value='". $row['att_item'] ."'>" .$row['att_name'] ."</option>" ;
                                                                             }
                                                                             ?>
                                           </select></td>
                                    <td align="center"><input class="form-control kpi_revised_spv_down" type="text" autocomplete="off"
                                                  id="spv_down<?php echo $row_no; ?>" onchange="addspv_down()"
                                                  value="<?php echo $row_attitude['kpi_bobot'];?>" readonly
                                                  name="inp_attitude_revised1[]"
                                                  style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                    <td align="center"><textarea class="form-control" type="text" name="inp_attitude_revised2[]"
                                                  style="border: 1px solid #d7d7d7;"><?php echo $row_attitude['kpi_target'];?></textarea>
                                    </td>
                                    <td align="center"><input class="form-control" type="text" autocomplete="off"
                                                  value="<?php echo $row_attitude['kpi_midyear_trg'];?>"
                                                  name="inp_attitude_revised3[]"
                                                  style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                    <td align="center"><input class="form-control" type="text" autocomplete="off"
                                                  value="<?php echo $row_attitude['kpi_fullyear_trg'];?>"
                                                  name="inp_attitude_revised4[]"
                                                  style="border: 1px solid #d7d7d7;text-align: right;"></td>
                             </tr>
                             <script type='text/javascript'>
                             function addspv_down() {
                                    var spv_down1, spv_down2, spv_down3, spv_down4, spv_down5, spv_down6, spv_down7;
                                    spv_down1 = document.getElementById('spv_down1').value;
                                    spv_down2 = document.getElementById('spv_down2').value;
                                    spv_down3 = document.getElementById('spv_down3').value;
                                    spv_down4 = document.getElementById('spv_down4').value;
                                    spv_down5 = document.getElementById('spv_down5').value;
                                    spv_down6 = document.getElementById('spv_down6').value;
                                    spv_down7 = document.getElementById('spv_down7').value;
                                    spv_downTotal =
                                           parseFloat(spv_down1.replace(/,/g, '')) +
                                           parseFloat(spv_down2.replace(/,/g, '')) +
                                           parseFloat(spv_down3.replace(/,/g, '')) +
                                           parseFloat(spv_down4.replace(/,/g, '')) +
                                           parseFloat(spv_down5.replace(/,/g, '')) +
                                           parseFloat(spv_down6.replace(/,/g, '')) +
                                           parseFloat(spv_down7.replace(/,/g, ''));

                                    document.getElementById('spv_downGrandTotal').value = spv_downTotal.toString()
                                           .replace(/\B(?=(\d{3})+(?!\d))/g, ',');

                             }
                             </script>

                             <?php } ?>
                             <tr id="recs-1" style="background: #eee;border: 1px solid #0869bd;">
                                    <td colspan="2">Total</td>
                                    <td align="center"><div id="total_revised_spv_down_print" style="font-weight: bold;text-align: right;color: #056805;">
                                                               10</div>
                                                        <input type="hidden" name="total_revised_spv_down" id="total_revised_spv_down"
                                                               class="form-control subTotal1 subTotal"
                                                               style="border: 1px solid #d7d7d7;text-align: right;"></td>
                                    <td colspan="3">&nbsp;</td>
                             </tr>

                      </tbody>
               </table>

           
               <div>

                      <div>
                      </div>
 </fieldset>
