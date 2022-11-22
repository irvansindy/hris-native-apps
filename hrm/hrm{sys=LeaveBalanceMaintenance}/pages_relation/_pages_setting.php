<?php include "../../../application/session/session.php"; ?>
<?php
include "../../../application/config.php";
$rfid = $_GET['rfid'];
$rfid1 = $_GET['rfid1'];
$rfid2 = $_GET['rfid2'];
$token = $_GET['token'];
if ($rfid == '2') {
       $where_active = "AND a.active_status IN ('0','1')";
} else {
       $where_active = "AND a.active_status = '$rfid'";
}
if (!empty($rfid2)) {
       $where = "AND b.cost_code LIKE '%$rfid2%'";
} else {
       $where;
}
// //$modal_id = '1';
$modal = mysqli_query($connect, "SELECT 
                                                 b.emp_no,
                                                 b.Full_Name 
                                          FROM hrmempleavebal a
                                          LEFT JOIN view_employee b ON a.emp_id = b.emp_id 
                                          WHERE a.leave_code = '$rfid1' $where_active $where AND (b.end_date IS NULL or b.end_date = '0000-00-00 00:00:00')
                                          GROUP BY b.emp_no
                                          ORDER BY b.Full_Name");
while ($r = mysqli_fetch_array($modal)) {
?>

       <link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


       <div class="input-group">
              <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
              <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
              <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>

              <select id="test-select-4s<?php echo $token; ?>" multiple="multiple" class="framework" id="sel_parameter" name="sel_parameter[]">
                     <?php if (mysqli_num_rows($modal) > 0) { ?>
                            <?php while ($row = mysqli_fetch_array($modal)) { ?>
                                   <option value="<?php echo $row['emp_no'] ?>" data-section="<?php echo $rfid1; ?>" data-index="1">
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