<?php
              include "../../../application/config.php";
              $rfid = $_GET['rfid'];
              //$modal_id = '1';
              $no = 1;
              $modal=mysqli_query($connect, "SELECT * FROM hrdperf_ipprequest_review 
                                                 WHERE ipp_reqno = '$rfid'
                                                 GROUP BY rev_id
                                                 ORDER BY rev_id DESC");
                                   while($row_performance_head = mysqli_fetch_array($modal)){
?>




<label>Revision No : <?php echo $row_performance_head['rev_id'];?></label>
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
                     <th style="text-align: center;" rowspan="2">Remarks</th>
                     <th style="text-align: center;" rowspan="2">LG</th>
              </tr>
              <tr>
                     <th style="text-align: center;background: #fff2cc;black;font-weight:bold;">Realisasi/
                            <br>Realization</th>
                     <th style="text-align: center;background: #fff2cc;black;font-weight:bold;">Realization <br>vs
                            Target</th>
                     <th style="text-align: center;background: #d6dce4;black;font-weight:bold;">Realisasi/
                            <br>Realization</th>
                     <th style="text-align: center;background: #d6dce4;black;font-weight:bold;">Realization <br>vs
                            Target </th>
              </tr>
       </thead>
       
       <tbody id="tbl_posts_body_spvup_appraisal_one">
              <?php
                     $no = 1;
                     $modal_isi = mysqli_query($connect, "SELECT
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
                                                        hrdperf_ipprequest_review a
                                                        LEFT JOIN hrmperf_set_kpiperspektif b on a.kpi_perspektif_id=b.perspektif_id
                                                        LEFT JOIN hrmperf_set_kpiunit c on a.kpi_unit=c.kpiunit_id
                                                        LEFT JOIN hrmperf_set_orgkpitype d on a.kpi_type_id=d.orgkpitype_id
                                                        LEFT JOIN hrmperf_set_reviewperiod e on e.reviewperiod_id=a.kpi_reviewperiod_id
                                                        LEFT JOIN hrmperf_iprecord f ON a.ipp_reqno=f.ipp_reqno AND a.ipp_id=f.ipp_id
                                                        LEFT JOIN hrmperf_ipprequest g ON a.ipp_reqno=g.ipp_reqno
                                                        LEFT JOIN hrmperf_parequest_review h ON a.ipp_reqno=h.ipp_reqno AND a.kpi_perspektif_id=h.ipp_id AND h.rev_id='$row_performance_head[rev_id]'
                                                        LEFT JOIN db_config_str i on a.kpi_lg=i.remark AND i.id IN ('15','16')
                                                        WHERE a.ipp_reqno = '$rfid' and a.rev_id='$row_performance_head[rev_id]'");

                                                        while($row_performance = mysqli_fetch_array($modal_isi)){
              ?>
         
               <tr>     
                     <!-- <td style="text-align: center;"><php echo $row_performance['perspektif_name']; ?><br>(<php echo $row_performance['perspektif_code']; ?> )</td> -->
                     <td><select class="form-control"
                                   id="inp_performance_spvup_approver0"
                                   name="inp_performance_spvup_approver0[]"
                                   onfocus="hlentry(this)"
                                   onchange="formodified(this);"
                                   style="width:undefined;width: 160px;border: 1px solid #cac2c2;text-align: left;color: #484545;">
                                   <option value="<?php echo $row_performance['perspektif_id']; ?>"><?php echo $row_performance['perspektif_name']; ?></option>
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
              </tr>
              <?php } ?>
       </tbody>
       

</table>

<?php } ?>