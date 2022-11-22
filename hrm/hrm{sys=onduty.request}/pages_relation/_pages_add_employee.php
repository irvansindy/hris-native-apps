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
                                   <select id="test-select-4s<?php echo $token; ?>" multiple="multiple" class="framework" id="sel_parameter" name="sel_parameter[]">

                                          <?php
                                          $user         = $username;
                                          $rfid         = $_GET['rfid'];
                                          $module       = 'Training.request';

                                          require_once '../../../model/gen_auth_data/_auth_data.php';
                                          require_once '../../../model/eo/GMEmployeeList.php';

                                          // //$modal_id = '1';
                                          $modal = mysqli_query($connect, $qListRender_by_WORKFLOW);

                                          while ($r = mysqli_fetch_array($modal)) {

                                          ?>
                                                 <?php if (mysqli_num_rows($modal) > 0) { ?>
                                                        <?php while ($row = mysqli_fetch_array($modal)) { ?>
                                                               <option value="<?php echo $row['emp_no'] ?>" data-section="<?php echo $rfid1; ?>" data-index="1" <?php echo $row['selected'] ?>>
                                                                      <?php echo $row['Full_Name'] ?></option>
                                                        <?php } ?>
                                          <?php } ?>
                                   </select>
                            </div>
                     </div>
              </div>
       </div>
</div>
<?php } ?>

<script type="text/javascript">
       var tree4 = $("#test-select-4s<?php echo $token; ?>").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>