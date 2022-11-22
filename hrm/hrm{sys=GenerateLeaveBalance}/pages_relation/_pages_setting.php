<?php include "../../../application/session/session.php";?>
<?php
    include "../../../application/config.php";
	$rfid = $_GET['rfid'];
       $rfid1 = $_GET['rfid1'];
       $rfid2 = $_GET['rfid2'];
       $rfid3 = $_GET['rfid3'];
       $token = $_GET['token'];
       if($rfid3 == '3') {
              $where_active = "(b.end_date IS NOT NULL OR b.end_date = '0000-00-00 00:00:00')";
       } elseif($rfid3 == '2') {
              $where_active = "(b.end_date IS NOT NULL AND b.end_date <> '0000-00-00 00:00:00')";
       } else {
              $where_active = "(b.end_date IS NULL OR b.end_date = '0000-00-00 00:00:00')";
       }


       if(!empty($rfid2)) {
              $where = " WHERE b.cost_code LIKE '%$rfid2%' AND $where_active";
       } else {
              $where = " WHERE $where_active";
       }

	// //$modal_id = '1';
	$modal=mysqli_query($connect, "SELECT
                                                 b.emp_no,
                                                 b.Full_Name
                                          FROM view_employee b
                                          $where
                                          GROUP BY b.emp_no
                                          ORDER BY b.Full_Name");
	while($r=mysqli_fetch_array($modal)){
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
                      <?php echo $row['Full_Name'] ?> <?php echo $row['emp_no'] ?></option>
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