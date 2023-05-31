<?php
require_once '../../../application/config.php';
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
       include "../../../application/session/sessionlv2.php";
} else {
       include "../../../application/session/mobile.session.php";
}
?>

<div class="input-group">
       <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
       <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
       <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
       <link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css"/>
                                   <select id="test-select-4s" multiple="multiple" class="framework" id="sel_parameter" name="sel_parameter[]">

                                          <?php
                                          $user         = $username;
                                          $rfid         = $_GET['rfid'];
                                          $sel_shiftgroup = mysqli_fetch_array(mysqli_query($connect, "SELECT shiftgroup_id FROM hrmtshiftregroup WHERE shiftregroup_name = '$rfid'"));
         

                                          // //$modal_id = '1';
                                          $modal = mysqli_query($connect, "SELECT 
                                                                                    a.emp_id,
                                                                                    a.Full_Name,
                                                                                    (SELECT 'selected' FROM hrmempperiod b WHERE b.emp_id=a.emp_id AND b.period_code='$rfid') as selected
                                                                             FROM view_employee a");

                                          while ($r = mysqli_fetch_array($modal)) {

                                                 

                                          ?>
                                           
                                                
                                                               <option value="<?php echo $r['emp_id'] ?>"
                                                                      
                                                                      data-index="1" <?php echo $r['selected'] ?>>
                                                                      <?php echo $r['Full_Name'] ?></option>
                                        
                                          <?php 
                                          } ?>
                                   </select>
                            </div>
                     </div>
              </div>
       </div>
</div>

<script type="text/javascript">
       var tree4 = $("#test-select-4s<?php echo $token; ?>").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>