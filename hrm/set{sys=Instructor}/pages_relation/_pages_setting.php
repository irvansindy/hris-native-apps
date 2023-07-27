<?php
    include "../../../application/config.php";
	$instructor_code = $_GET['instructor_code'];
?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


<div class="input-group">
	<link rel="stylesheet"
		href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
	<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
	<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
	<?php
		$get_data_detail = mysqli_query($connect, "SELECT a.provider_code, a.provider_name, (SELECT 'selected' FROM trndinstructor b
		WHERE b.provider=a.provider_code AND b.instructor_code = '$instructor_code') AS selected 
		FROM trnprovider a");
	?>
	<select name="edit_instructor_code_detail[]" class="multiple_edit_provider" id="edit_instructor_code_detail">
	<?php if (mysqli_num_rows($get_data_detail) > 0) { ?>
		<?php while ($row = mysqli_fetch_array($get_data_detail)) { ?>
		<option value="<?php echo $row['provider_code'] ?>" data-section="provider item" data-index="1"
			<?php echo $row['selected'] ?>><?php echo $row['provider_name'] ?></option>
		<?php } ?>
	<?php } ?>
	</select>

</div>


<script type="text/javascript">
	var tree4 = $(".multiple_edit_provider").treeMultiselect({
		allowBatchSelection: true,
		enableSelectAll: true,
		searchable: true,
		sortable: true,
		startCollapsed: false,
	});
</script>