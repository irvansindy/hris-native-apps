<?php
    include "../../../application/config.php";
	$rfid = $_GET['rfid'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, "SELECT category_code,category_name_en FROM hrmondutyallowcat");

	while($r=mysqli_fetch_array($modal)){


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


<div class="input-group">
                                                 <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
                                                 <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
                                                 <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>


                                                 <?php
                                                 $modal=mysqli_query($connect, "SELECT a.purpose_code, a.purpose_name_en,
                                                                                           (SELECT 'selected' FROM hrrondutypurposecomp x1 WHERE x1.purpose_code=a.purpose_code AND x1.item_code='$rfid') as selected
                                                                                    FROM hrmondutypurposetype a");

                                                 ?>
                                                 <select id="test-select-4s" multiple="multiple" class="framework" id="sel_purposed_code" name="sel_purposed_code[]" >
                                                        <?php if (mysqli_num_rows($modal) > 0) { ?>
                                                               <?php while ($row = mysqli_fetch_array($modal)) { ?>
                                                                      <option value="<?php echo $row['purpose_code'] ?>"
                                                                      data-section="<?php echo $rfid; ?>"
                                                                      data-index="1" <?php echo $row['selected'] ?>><?php echo $row['purpose_name_en'] ?></option>
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