<?php
    include "../../../application/config.php";
	$rfid = $_GET['rfid'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, "SELECT emp_no,Full_Name FROM view_employee");
	while($r=mysqli_fetch_array($modal)){
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


<div class="input-group">
       <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
       <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
       <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>


       <?php
              $modal=mysqli_query($connect, "SELECT a.emp_no, a.Full_Name,
                                               (SELECT 'selected' FROM hrdvalmargin x1 WHERE x1.emp_no=a.emp_no AND x1.request_type='$rfid') as selected
                                               FROM view_employee a");

       ?>
       <select id="test-select-4s" multiple="multiple" class="framework" id="sel_parameter"
              name="sel_parameter[]">
              <?php if (mysqli_num_rows($modal) > 0) { ?>
              <?php while ($row = mysqli_fetch_array($modal)) { ?>
              <option value="<?php echo $row['emp_no'] ?>" data-section="<?php echo $rfid; ?>" data-index="1"
                     <?php echo $row['selected'] ?>><?php echo $row['Full_Name'] ?></option>
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