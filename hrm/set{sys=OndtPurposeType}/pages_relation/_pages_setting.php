<?php
    include "../../../application/config.php";
	$rfid = $_GET['rfid'];
	//$modal_id = '1';
	$modal=mysqli_query($connect, "SELECT 
		a.*,
		GROUP_CONCAT(c.item_name_en ORDER BY c.item_code ASC SEPARATOR ' . ') AS group_item
				FROM hrmondutypurposetype a
				LEFT JOIN hrrondutypurposecomp b on a.purpose_code=b.purpose_code
				LEFT JOIN hrmondutyallowitem c on b.item_code=c.item_code
		WHERE a.purpose_code='$rfid'
		GROUP BY a.purpose_code");

	while($r=mysqli_fetch_array($modal)){

	$purpose_code =  $r['purpose_code'];
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


<div class="input-group">
	<link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
	<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
	<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>


	<?php
		$modal=mysqli_query($connect, "SELECT a.item_code,a.item_name_en,
		(SELECT 'selected' FROM hrrondutypurposecomp x WHERE x.item_code=a.item_code AND x.purpose_code='$rfid') as selected
		FROM hrmondutyallowitem a ");

		?>
	<select multiple="multiple" class="framework" id="sel_allowance_item"
		name="sel_allowance_item[]">
		<?php if (mysqli_num_rows($modal) > 0) { ?>
		<?php while ($row = mysqli_fetch_array($modal)) { ?>
		<option value="<?php echo $row['item_code'] ?>" data-section="allowance item" data-index="1"
			<?php echo $row['selected'] ?>><?php echo $row['item_name_en'] ?></option>
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
	$("#sel_allowance_item").treeMultiselect({
		allowBatchSelection: true,
		enableSelectAll: true,
		searchable: true,
		sortable: true,
		startCollapsed: false,
	});
</script>