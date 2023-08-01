<?php
    error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';
?>
    <link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
    <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
    <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
    <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>
    <?php
        $user_menu = $_GET['user_menu'];

        $modal=mysqli_query($connect, "SELECT ve.emp_id, ve.Full_Name, ve.user_id, ve.emp_no,
        DATE_FORMAT(start_date,'%Y-%m-%d') as start_date, DATE_FORMAT(end_date,'%Y-%m-%d') as end_date,
		(SELECT 'selected' FROM users_menugroup_setting_employee e WHERE e.emp_no = ve.emp_no AND e.users_menu_name = '$user_menu') as selected
        from view_employee ve
        where end_date = '0000-00-00' OR end_date = '' OR end_date = NULL
        -- ORDER BY emp_no ASC
        GROUP BY ve.Full_Name
        ");
    ?>
    <select multiple="multiple" class="framework" id="list_employee"
        name="list_employee[]">
        <?php if (mysqli_num_rows($modal) > 0) { ?>
        <?php while ($row = mysqli_fetch_array($modal)) { ?>
        <option class="checked-employee" value="<?php echo $row['emp_no'] ?>" data-section="Employees"
            data-index="1" <?php echo $row['selected'] ?>><?php echo $row['Full_Name'] ?></option>
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
