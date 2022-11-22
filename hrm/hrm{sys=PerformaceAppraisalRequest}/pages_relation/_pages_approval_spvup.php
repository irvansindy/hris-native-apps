<script>
$(document).ready(function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_appraisalform_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_appraisalform_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });

       
       $(".subTotal1_appraisalform_spv_up").val(sum);
       $(".subTotal1_appraisalform_spv_up").val(sum1);
       document.getElementById("total_appraisalform_spv_up_print").innerHTML = sum+sum1;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_appraisalform_spv_up_print").innerHTML = sum;
});
$(document).ready(function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_appraisalform_spv_up_print").innerHTML = sum;
});
$(document).on("change", ".kpi_appraisalform_spv_up", function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_appraisalform_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_appraisalform_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });
       $(".subTotal1_appraisalform_spv_up").val(sum);
       $(".subTotal1_appraisalform_spv_up").val(sum1);
       document.getElementById("total_appraisalform_spv_up_print").innerHTML = sum+sum1;
});
$(document).on("change", ".kpi_appraisalform_spv_up_plus", function() {
       var sum = 0;
       var sum1 = 0;
       $(".kpi_appraisalform_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".kpi_appraisalform_spv_up_plus").each(function() {
              sum1 += +$(this).val();
       });
       $(".subTotal1_appraisalform_spv_up").val(sum);
       $(".subTotal1_appraisalform_spv_up").val(sum1);
       document.getElementById("total_appraisalform_spv_up_print").innerHTML = sum+sum1;
});
$(document).on("change", ".kpitrgmidyear_spv_up", function() {
       var sum = 0;
       $(".kpitrgmidyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal2").val(sum);
       document.getElementById("total_trgmidyear_appraisalform_spv_up_print").innerHTML = sum;
});
$(document).on("change", ".kpitrgfullyear_spv_up", function() {
       var sum = 0;
       $(".kpitrgfullyear_spv_up").each(function() {
              sum += +$(this).val();
       });
       $(".subTotal3").val(sum);
       document.getElementById("total_trgfullyear_appraisalform_spv_up_print").innerHTML = sum;
});
</script>


<?php
              include "../../../application/config.php";
              $rfid = $_GET['rfid'];
              // $data_on = mysqli_fetch_array(mysqli_query($connect, "SELECT revised_remark FROM hrmrequestapproval WHERE request_no = '$rfid' AND revised_remark IS NOT NULL ORDER BY revised_remark LIMIT 1"));
              $data_of = mysqli_fetch_array(mysqli_query($connect, "SELECT ipa_reqno FROM hrmperf_ipprequest WHERE ipp_reqno = '$rfid'"));
              $data_of_r = $data_of['ipa_reqno'];

              $data_on = mysqli_fetch_array(mysqli_query($connect, "SELECT revised_remark FROM hrmrequestapproval WHERE request_no = '$data_of_r' AND revised_remark IS NOT NULL ORDER BY revised_remark LIMIT 1"));
              if($data_on['revised_remark'] == '') {
                     $style = 'display:none;';
              } else {
                     $style = '';
              }
       ?>
        
       <div class="form-row" style="<?php echo $style; ?>">
               <div class="col-4 name">Revised Remark <span class="required">*</span></div>
               <div class="col-sm-7 name">
                      <div class="input-group">
                             <input type="text" value="<?php echo $data_on['revised_remark']; ?>"
                                    style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;width: 256px;padding-left: 10px;background: #1e88e521;"
                                    readonly name="inp_SpvUPManpower" id="inp_SpvUPManpower">
                      </div>
               </div>
       </div>



<table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts_spvup_appraisal_one">
       <thead>
           
              <tr>
                     <th style="text-align: center;" rowspan="2">Perspektif</th>
                     <th style="text-align: center;" rowspan="2">KPI</th>
                     <th style="text-align: center;" rowspan="2">Unit</th>
                     <th nowrap="nowrap" style="text-align: center;" rowspan="2">Improvement / Regular Activity</th>
                     <th style="text-align: center;" nowrap="nowrap" rowspan="2">Bobot KPI / KPI<br />Weight (%) (B)</th>
                     <th style="text-align: center;" nowrap="nowrap" rowspan="2">Target Mid<br>Year</th>
                     <th style="text-align: center;" nowrap="nowrap" rowspan="2">Target Full<br>Year</th>
                     <th style="text-align: center;background: #fff2cc;color:black;font-weight:bold;" nowrap="nowrap"colspan="2" rowspan="1">Performance Review (Mid Year)</th>
                     <th style="text-align: center;background: #d6dce4;color:black;font-weight:bold;" nowrap="nowrap"colspan="2" rowspan="1">Performance Review (Full Year)</th>
                     <th style="text-align: center;" rowspan="2">Periodical Review</th>
                     <th style="text-align: center;" rowspan="2">Attachment</th>
                     <th style="text-align: center;" rowspan="2">Upload</th>
                     <th style="text-align: center;" rowspan="2">Remarks</th>
                     <th style="text-align: center;" rowspan="2">LG</th>
                     <th style="text-align: center;" rowspan="2"><a class="add-record_spvup_appraisal_one" style="margin-right: 7px;" data-added="0"><img
                                          src="../../asset/img/icons/acssadd.png"></a></th>
              </tr>
              <tr>
                     <th style="text-align: center;background: #fff2cc;black;font-weight:bold;">Realisasi/
                            <br>Realization</th>
                     <th style="text-align: center;background: #fff2cc;black;font-weight:bold;">Realization <br>vs
                            Target</th>
                     <th style="text-align: center;background: #d6dce4;black;font-weight:bold;">Realisasi/
                            <br>Realization</th>
                     <th style="text-align: center;background: #d6dce4;black;font-weight:bold;">Realization <br>vs
                            Target</th>
              </tr>
       </thead>
       
       <tbody id="tbl_posts_body_spvup_appraisal_one">
              <?php
              $rfid = $_GET['rfid'];
              //$modal_id = '1';
              $no = 1;
              $modal=mysqli_query($connect, "SELECT
                                                 a.*,
                                                 b.perspektif_id,
                                                 b.perspektif_name,
                                                 b.perspektif_code,
                                                 c.kpiunit_name,
                                                 d.orgkpitype_name,
                                                 e.reviewperiod_name,
                                                 f.filename,
                                                 g.ip_period,
                                                 h.pa_midyear_realisasi,
                                                 h.pa_midyear_rvt,
                                                 h.pa_fullyear_realisasi,
                                                 h.pa_fullyear_rvt,
                                                 i.var1
                                                 FROM
                                                        hrdperf_ipprequest a
                                                        LEFT JOIN hrmperf_set_kpiperspektif b on a.kpi_perspektif_id=b.perspektif_id
                                                        LEFT JOIN hrmperf_set_kpiunit c on a.kpi_unit=c.kpiunit_id
                                                        LEFT JOIN hrmperf_set_orgkpitype d on a.kpi_type_id=d.orgkpitype_id
                                                        LEFT JOIN hrmperf_set_reviewperiod e on e.reviewperiod_id=a.kpi_reviewperiod_id
                                                        LEFT JOIN hrmperf_iprecord f ON a.ipp_reqno=f.ipp_reqno AND a.ipp_id=f.ipp_id
                                                        LEFT JOIN hrmperf_ipprequest g ON a.ipp_reqno=g.ipp_reqno
                                                        LEFT JOIN hrmperf_parequest h ON a.ipp_reqno=h.ipp_reqno AND a.kpi_perspektif_id=h.ipp_id
                                                        LEFT JOIN db_config_str i on a.kpi_lg=i.remark AND i.id IN ('15','16')
                                                        WHERE a.ipp_reqno = '$rfid'
                                                        GROUP BY a.ipp_id
                                                        ORDER BY a.ipp_id ASC");

                                                        while($row_performance = mysqli_fetch_array($modal)){
                                                        $data = $row_performance['filename'];
                                                        if($data != ''){
                                                               $dataOn = '<a href="../../../asset/request.file.appraisal.attachment/'.$row_performance['filename'].'"><img style="width: 100%;" src="../../../asset/request.file.appraisal.attachment/excel.png" height="425" width="425" class="img-thumbnail"/></a>';
                                                        } else {
                                                               $dataOn = '<span id="uploaded_image'.$row_performance['ipp_id'].'" style="15%";></span>';
                                                        }
       ?>
              <tr id="rec-1" style="display:none;">
                     <td style="text-align: center;"><input type="text"
                                   value="<?php echo $row_performance['ip_period']; ?>"
                                   name="inp_performance_spvup_approver00[]"></td>
                     <td style="text-align: center;"><input type="text"
                                   value="<?php echo $row_performance['ipp_reqno']; ?>"
                                   name="inp_performance_spvup_approver01[]"></td>
                     <td style="text-align: center;"><input type="text"
                                   value="<?php echo $row_performance['ipp_id']; ?>"
                                   name="inp_performance_spvup_approver02[]"></td>
              </tr>
              <tr id="recspvup_appraisal_one-<?php echo $no; ?>">     
                     <!-- <td style="text-align: center;"><php echo $row_performance['perspektif_name']; ?><br>(<php echo $row_performance['perspektif_code']; ?> )</td> -->
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver0"
                                   name="inp_performance_spvup_approver0[]" 
                                   onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['perspektif_id']; ?>"><?php echo $row_performance['perspektif_name']; ?></option>
                                   <?php
                                          $sql = mysqli_query($connect, "SELECT perspektif_id,perspektif_name FROM hrmperf_set_kpiperspektif WHERE perspektif_id <> '$row_performance[perspektif_id]'");
                                          $row = mysqli_num_rows($sql);
                                          while ($row = mysqli_fetch_array($sql)){
                                          echo "<option value='". $row['perspektif_id'] ."'>" .$row['perspektif_name'] ."</option>" ;
                                          }
                                   ?>
                            </select></td>
                     <td><textarea class="form-control" 
                                   type="text"
                                   id="inp_performance_spvup_approver1"
                                   name="inp_performance_spvup_approver1[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['kpi_name']; ?></textarea></td>
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver2" 
                                   name="inp_performance_spvup_approver2[]"
                                   onfocus="hlentry(this)" onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_unit']; ?>"><?php echo $row_performance['kpiunit_name']; ?></option>
                                   <?php
                                          $sql = mysqli_query($connect, "SELECT kpiunit_id,kpiunit_name FROM hrmperf_set_kpiunit");
                                          $row = mysqli_num_rows($sql);
                                          while ($row = mysqli_fetch_array($sql)){
                                          echo "<option value='". $row['kpiunit_id'] ."'>" .$row['kpiunit_name'] ."</option>" ;
                                          }
                                   ?>
                            </select></td>
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver12" 
                                   name="inp_performance_spvup_approver12[]" 
                                   onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_type_id']; ?>"><?php echo $row_performance['orgkpitype_name']; ?></option>
                                   <?php
                                          $sql = mysqli_query($connect, "SELECT orgkpitype_id,orgkpitype_name FROM hrmperf_set_orgkpitype");
                                          $row = mysqli_num_rows($sql);
                                          while ($row = mysqli_fetch_array($sql)){
                                          echo "<option value='". $row['orgkpitype_id'] ."'>" .$row['orgkpitype_name'] ."</option>" ;
                                          }
                                   ?>
                            </select></td>
                     <td><input type="text"
                                   id="inp_performance_spvup_approver"              
                                   name="inp_performance_spvup_approver3[]"
                                   class="form-control kpi_appraisalform_spv_up"
                                   value="<?php echo $row_performance['kpi_bobot']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input class="form-control"
                                   id="inp_performance_spvup_approver4"
                                   name="inp_performance_spvup_approver4[]"
                                   type="text"
                                   value="<?php echo $row_performance['kpi_midyear_trg']; ?>" 
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input class="form-control"
                                   id="inp_performance_spvup_approver5"
                                   name="inp_performance_spvup_approver5[]"
                                   type="text"
                                   value="<?php echo $row_performance['kpi_fullyear_trg']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text"
                                   id="inp_performance_spvup_approver6"
                                   name="inp_performance_spvup_approver6[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_midyear_realisasi']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text" 
                                   id="inp_performance_spvup_approver7"
                                   name="inp_performance_spvup_approver7[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_midyear_rvt']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text" 
                                   id="inp_performance_spvup_approver8"
                                   name="inp_performance_spvup_approver8[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_fullyear_realisasi']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text"
                                   id="inp_performance_spvup_approver9"
                                   name="inp_performance_spvup_approver9[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_fullyear_rvt']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>

                     <td align="center"><?php echo $row_performance['reviewperiod_name']; ?></td>
                     <td align="center" style="width: 10px;"><?php echo $dataOn; ?></span></td>
                     <td align="center">
                            <form action="#">
                                   <div class="input-file-container">
                                          <input  class="input-file"
                                                 id="file<?php echo $row_performance['ipp_id']; ?>"
                                                 name="file<?php echo $row_performance['ipp_id']; ?>" type="file">
                                          <br>
                                   </div>
                                   <p class="file-return"></p>
                            </form>

                            <span class="badge badge-Fully-Approved"
                                   style="width: 100%;background: #ffc107;font-weight: bold;color: black;text-align: left;font-size: 10px;">1.
                                   Only for Excel and document type (.xls)<br>2. 3MB Max file size</span>
                     </td>
                     <td><textarea class="form-control" 
                                   type="text" 
                                   id="inp_performance_spvup_approver10[]"
                                   name="inp_performance_spvup_approver10[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['remark']; ?></textarea>
                     </td>
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver11"
                                   name="inp_performance_spvup_approver11[]" 
                                   onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_lg']; ?>">
                                          <?php echo $row_performance['var1']; ?></option>
                                          <?php
                                                 $sql = mysqli_query($connect, "SELECT var1 FROM db_config_str WHERE id IN ('15','16') AND var1 <> '$row_performance[var1]'");
                                                 $row = mysqli_num_rows($sql);
                                                 while ($row = mysqli_fetch_array($sql)){
                                                 echo "<option value='". $row['var1'] ."'>" .$row['var1'] ."</option>" ;
                                                 }
                                          ?>
                            </select></td>
                     <td><a class="delete-record_spvup_appraisal_one_parent" data-id="<?php echo $no++; ?>" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
              </tr>
              <script>
              $(document).ready(function() {
                     $(document).on("change", "#file<?php echo $row_performance['ipp_id']; ?>",
              function() {
                            var name = document.getElementById(
                                          "file<?php echo $row_performance['ipp_id']; ?>")
                                   .files[0].name;
                            var form_data = new FormData();
                            var ext = name.split(".").pop().toLowerCase();
                            var oFReader = new FileReader();
                            oFReader.readAsDataURL(document.getElementById(
                                   "file<?php echo $row_performance['ipp_id']; ?>"
                                   ).files[0]);
                            var f = document.getElementById(
                                          "file<?php echo $row_performance['ipp_id']; ?>")
                                   .files[0];
                            var fsize = f.size || f.fileSize;
                            if (jQuery.inArray(ext, ["xls"]) == -1) {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML =
                                          "Invalid type of file";
                                   document.getElementById(
                                          "file<?php echo $row_performance['ipp_id']; ?>"
                                          ).value = "";
                            } else if (fsize > 2000000) {
                                   modals.style.display = "block";
                                   document.getElementById("msg").innerHTML =
                                          "File to large, size : " + fsize +
                                          " is not allowed";
                                   document.getElementById(
                                          "file<?php echo $row_performance['ipp_id']; ?>"
                                          ).value = "";
                            } else {
                                   form_data.append(
                                          "file<?php echo $row_performance['ipp_id']; ?>",
                                          document.getElementById(
                                                 "file<?php echo $row_performance['ipp_id']; ?>"
                                                 ).files[0]);
                                   $.ajax({
                                          url: "uploader/index.php?&code=22&token=&token=<?php echo $row_performance['ipp_id']; ?>&req_no=<?php echo $rfid; ?>",
                                          method: "POST",
                                          data: form_data,
                                          contentType: false,
                                          cache: false,
                                          processData: false,
                                          beforeSend: function() {
                                                 mymodalss.style
                                                        .display =
                                                        "block";
                                          },
                                          success: function(data) {
                                                 mymodalss.style
                                                        .display =
                                                        "none";
                                                 $("#uploaded_image<?php echo $row_performance['ipp_id']; ?>")
                                                        .html(data);
                                          }
                                   });
                            }
                     });
              });
              </script>
<?php } ?>
       </tbody>
       
</table>


















<div style="display:none;">
       <table id="sample_table_spvup_appraisal_one" class="table table-bordered table-striped table-hover table-head-fixed">
              <tr id="" class="reset-delete-record">
              
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver0"
                                   name="inp_performance_spvup_approver0[]" 
                                   onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['perspektif_name']; ?>"><?php echo $row_performance['perspektif_name']; ?></option>
                                   <?php
                                          $sql = mysqli_query($connect, "SELECT perspektif_id,perspektif_name FROM hrmperf_set_kpiperspektif");
                                          $row = mysqli_num_rows($sql);
                                          while ($row = mysqli_fetch_array($sql)){
                                          echo "<option value='". $row['perspektif_id'] ."'>" .$row['perspektif_name'] ."</option>" ;
                                          }
                                   ?>
                            </select></td>
                     <td><textarea class="form-control" 
                                   type="text"
                                   id="inp_performance_spvup_approver1"
                                   name="inp_performance_spvup_approver1[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['kpi_name']; ?></textarea></td>
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver2" 
                                   name="inp_performance_spvup_approver2[]"
                                   onfocus="hlentry(this)" onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_unit']; ?>"><?php echo $row_performance['kpiunit_name']; ?></option>
                                   <?php
                                          $sql = mysqli_query($connect, "SELECT kpiunit_id,kpiunit_name FROM hrmperf_set_kpiunit");
                                          $row = mysqli_num_rows($sql);
                                          while ($row = mysqli_fetch_array($sql)){
                                          echo "<option value='". $row['kpiunit_id'] ."'>" .$row['kpiunit_name'] ."</option>" ;
                                          }
                                   ?>
                            </select></td>
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver12" 
                                   name="inp_performance_spvup_approver12[]" 
                                   onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_type_id']; ?>"><?php echo $row_performance['orgkpitype_name']; ?></option>
                                   <?php
                                          $sql = mysqli_query($connect, "SELECT orgkpitype_id,orgkpitype_name FROM hrmperf_set_orgkpitype");
                                          $row = mysqli_num_rows($sql);
                                          while ($row = mysqli_fetch_array($sql)){
                                          echo "<option value='". $row['orgkpitype_id'] ."'>" .$row['orgkpitype_name'] ."</option>" ;
                                          }
                                   ?>
                            </select></td>
                     <td><input type="text"
                                   id="inp_performance_spvup_approver"              
                                   name="inp_performance_spvup_approver3[]"
                                   class="form-control kpi_appraisalform_spv_up"
                                   value="<?php echo $row_performance['kpi_bobot']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input class="form-control"
                                   id="inp_performance_spvup_approver4"
                                   name="inp_performance_spvup_approver4[]"
                                   type="text"
                                   value="<?php echo $row_performance['kpi_midyear_trg']; ?>" 
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input class="form-control"
                                   id="inp_performance_spvup_approver5"
                                   name="inp_performance_spvup_approver5[]"
                                   type="text"
                                   value="<?php echo $row_performance['kpi_fullyear_trg']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text"
                                   id="inp_performance_spvup_approver6"
                                   name="inp_performance_spvup_approver6[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_midyear_realisasi']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text" 
                                   id="inp_performance_spvup_approver7"
                                   name="inp_performance_spvup_approver7[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_midyear_rvt']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text" 
                                   id="inp_performance_spvup_approver8"
                                   name="inp_performance_spvup_approver8[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_fullyear_realisasi']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>
                     <td><input  type="text"
                                   id="inp_performance_spvup_approver9"
                                   name="inp_performance_spvup_approver9[]"
                                   class="form-control" 
                                   onkeypress="return onlyNumberKey(event)"
                                   value="<?php echo $row_performance['pa_fullyear_rvt']; ?>"
                                   style="border: 1px solid #d7d7d7;text-align: right;"></td>

                     <td align="center"><?php echo $row_performance['reviewperiod_name']; ?></td>
                     <td align="center" style="width: 10px;"><?php echo $dataOn; ?></span></td>
                     <td align="center">
                            <form action="#">
                                   <div class="input-file-container">
                                          <input  class="input-file"
                                                 id="file<?php echo $row_performance['ipp_id']; ?>"
                                                 name="file<?php echo $row_performance['ipp_id']; ?>" type="file">
                                          <br>
                                   </div>
                                   <p class="file-return"></p>
                            </form>

                            <span class="badge badge-Fully-Approved"
                                   style="width: 100%;background: #ffc107;font-weight: bold;color: black;text-align: left;font-size: 10px;">1.
                                   Only for Excel and document type (.xls)<br>2. 3MB Max file size</span>
                     </td>
                     <td><textarea class="form-control" 
                                   type="text" 
                                   id="inp_performance_spvup_approver10[]"
                                   name="inp_performance_spvup_approver10[]"
                                   style="border: 1px solid #d7d7d7;width: 200px;"><?php echo $row_performance['remark']; ?></textarea>
                     </td>
                     <td><select class="form-control" 
                                   id="inp_performance_spvup_approver11"
                                   name="inp_performance_spvup_approver11[]" 
                                   onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['kpi_lg']; ?>">
                                          <?php echo $row_performance['var1']; ?></option>
                                          <?php
                                                 $sql = mysqli_query($connect, "SELECT var1 FROM db_config_str WHERE id IN ('15','16') AND var1 <> '$row_performance[var1]'");
                                                 $row = mysqli_num_rows($sql);
                                                 while ($row = mysqli_fetch_array($sql)){
                                                 echo "<option value='". $row['var1'] ."'>" .$row['var1'] ."</option>" ;
                                                 }
                                          ?>
                            </select></td>
                     <td><a class="delete-record_spvup_appraisal_one" data-added="0"><img src="../../asset/img/icons/minus.png"></a></td>
              </tr>
       </table>
</div>
       <table class="table table-bordered table-striped table-hover table-head-fixed" id="">
              <tr id="">
                     <td style="width: 30%; font-weight: bold;color: green;text-align: center;"><span class="sn">Total Bobot
                            </span>:</td>
                     <td nowrap="nowrap" align="center">
                            <div id="total_appraisalform_spv_up_print" style="font-weight: bold;text-align: right;color: #056805;">0
                            </div>
                            <input type="hidden" name="total_appraisalform_spv_up" id="total_appraisalform_spv_up"
                                   class="form-control subTotal1_appraisalform_spv_up subTotal"
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