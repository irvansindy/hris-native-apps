<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';
?>
    <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
    <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
    <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
    <?php
        $modal=mysqli_query($connect, "SELECT emp_id, Full_Name, user_id, emp_no,
        DATE_FORMAT(start_date,'%Y-%m-%d') as start_date, DATE_FORMAT(end_date,'%Y-%m-%d') as end_date 
        from view_employee
        where end_date = '0000-00-00' OR end_date = '' OR end_date = NULL
        ORDER BY emp_no ASC");
    ?>
    <select multiple="multiple" class="framework" id="list_employee"
        name="list_employee[]">
        <?php if (mysqli_num_rows($modal) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($modal)) { ?>
        <option class="checked-employee" value="<?php echo $row['emp_no'] ?>" data-section="Employees"
            data-index="1"><?php echo $row['Full_Name'] ?></option>
        <?php } ?>
        <?php } ?>
    </select>

    <script>
        $("#list_employee").treeMultiselect({
            allowBatchSelection: true,
            enableSelectAll: true,
            searchable: true,
            sortable: true,
            startCollapsed: false,
        })
    </script>

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