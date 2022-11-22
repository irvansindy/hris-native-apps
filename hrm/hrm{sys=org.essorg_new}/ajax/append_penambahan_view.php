<?php 
include "../../../application/session/session_ess.php";
$i      = $_POST['i'];
$row    = 'row'.$i;
?>
<tr id="<?php echo $row; ?>" class="dynamic-added">
                                                        <td>
                                                               <select class="input--style-6" name="penambahan_orgorpos_view[]" id="penambahan_orgorpos_view" style="width: ;height: 30px;">
                                                                      <option value="">Choose</option>
                                                                      <option value="1">ORG UNIT</option>
                                                                      <option value="2">POSITION</option>
                                                               </select>
                                                        </td>
                                                        <td>
                                                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_leader_pos_view[]" id="penambahan_leader_pos_view<?php echo $i; ?>" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_pos_name_view[]" id="penambahan_pos_name_view" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_cost_center_view[]" id="penambahan_cost_center_view" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_cost_center        = mysqli_query($connect, "SELECT 
                                                            a.costcenter_code,
                                                            a.costcenter_name_en
                                                            FROM teomcostcenter a");
                                                            while($data_cc  = mysqli_fetch_assoc($sql_cost_center)){
                                                        ?>
                                                                <option value="<?php echo $data_cc['costcenter_code'] ?>"><?php echo $data_cc['costcenter_name_en'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_work_location_view[]" id="penambahan_work_location_view" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_work_location      = mysqli_query($connect, "SELECT 
                                                            a.worklocation_code,
                                                            a.worklocation_name
                                                            FROM teomworklocation a");
                                                            while($data_wc  = mysqli_fetch_assoc($sql_work_location)){
                                                        ?>
                                                                <option value="<?php echo $data_wc['worklocation_code'] ?>"><?php echo $data_wc['worklocation_name'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_job_status_view[]" id="penambahan_job_status_view" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_job_status         = mysqli_query($connect, "SELECT 
                                                            a.jobstatuscode,
                                                            a.jobstatusname_en
                                                            FROM teomjobstatus a");
                                                            while($data_js  = mysqli_fetch_assoc($sql_job_status)){
                                                        ?>
                                                                <option value="<?php echo $data_js['jobstatuscode'] ?>"><?php echo $data_js['jobstatusname_en'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td width="9%">
                                                            <select class="input--style-6" name="penambahan_job_title_view[]" id="penambahan_job_title_view" style="width: ;height: 30px;">
                                                                <option value="0">Choose</option>
                                                        <?php 
                                                            $sql_job_title          = mysqli_query($connect, "SELECT 
                                                            a.jobtitle_code,
                                                            a.jobtitle_name_en
                                                            FROM teomjobtitle a");
                                                            while($data_jt  = mysqli_fetch_assoc($sql_job_title)){
                                                        ?>
                                                                <option value="<?php echo $data_jt['jobtitle_code'] ?>"><?php echo $data_jt['jobtitle_name_en'] ?></option>
                                                        <?php } ?>
                          
                                                            </select>
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_reason_view[]" id="penambahan_reason_view" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="penambahan_remarks_view[]" id="penambahan_remarks_view" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                        </td>
                                                        <td>
                                                        <button type="button" name="remove" id="<?php echo $i ?>" class="btn btn-danger btn_remove btn-sm">X</button>
                                                        </td>
                                                 </tr>