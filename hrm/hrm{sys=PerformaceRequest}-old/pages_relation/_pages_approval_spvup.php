<fieldset id="fset_1">
       <legend>KPI Detail</legend>
       <div class="card-body table-responsive p-0" style="width: 100%; height: 300px; margin: 1px;overflow: scroll;">


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
                                   <th nowrap="nowrap">LG</th>
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
                                   <td><input required class="form-control" type="text" value=""
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
                                   <td><input required class="form-control" type="text" value=""
                                                 name="inp_performance5[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;width: 100px;width: 100px;">
                                   </td>
                                   <td><input required class="form-control" type="text" value=""
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
                                   <td><input class="form-control" type="text" value="" name="inp_performance3[]"
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
                                   <td><input class="form-control" type="text" value="" name="inp_performance5[]"
                                                 style="border: 1px solid #d7d7d7;text-align: right;width: 100px;"></td>
                                   <td><input class="form-control" type="text" value="" name="inp_performance6[]"
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
       </div>
</fieldset>
