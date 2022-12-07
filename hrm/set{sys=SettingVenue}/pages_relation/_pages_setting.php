<?php
include "../../../application/config.php";
$rfid = $_GET['rfid'];
//$modal_id = '1';
$modal = mysqli_query($connect, "SELECT 
                                   a.menu_id,
                                   a.menu,
                                   GROUP_CONCAT(b.formula ORDER BY b.formula ASC SEPARATOR ' . ') AS group_item
                                          FROM hrmmenu a
                                          LEFT JOIN users_menu_access b ON a.menu_id=b.formula
                                   -- WHERE b.emp_no='$rfid'
                                   GROUP BY a.menu_id
                                   ORDER BY a.menu_id ASC
");

while ($r = mysqli_fetch_array($modal)) {
       $menu_id =  $r['menu_id'];
?>

       <link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


       <div class="input-group">
              <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
              <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
              <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>


              <?php
              $modal = mysqli_query($connect, "SELECT a.menu_id,a.menu,a.module,
                                                 (SELECT 'selected' FROM users_menu_access x WHERE x.formula=a.menu_id AND x.emp_no='$rfid') as selected
                                                 FROM hrmmenu a ");

              ?>
              <select id="test-select-4s" multiple="multiple" class="framework" id="sel_application_menu" name="sel_application_menu[]">
                     <?php if (mysqli_num_rows($modal) > 0) { ?>
                            <?php while ($row = mysqli_fetch_array($modal)) { ?>
                                   <option value="<?php echo $row['menu_id'] ?>" data-section="<?php echo $row['module'] ?>" data-index="1" <?php echo $row['selected'] ?>><?php echo $row['menu'] ?></option>
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
       var tree4 = $("#test-select-4s").treeMultiselect({
              allowBatchSelection: true,
              enableSelectAll: true,
              searchable: true,
              sortable: true,
              startCollapsed: false,
       });
</script>