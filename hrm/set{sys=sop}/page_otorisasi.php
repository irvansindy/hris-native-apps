<?php include "../../application/session/session.php";?>

<link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
<script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
<script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>

<?php
$sql = "SELECT a.nama, 
CASE WHEN b.emp_id IS NOT NULL then 'selected'
END AS selected

FROM users a
LEFT JOIN hrdgroupemp b ON a.username = b.emp_id";
$sql1 = mysqli_query($connect, $sql);
?>

<h4>Employee with Access</h4>
<div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;">

<select id="select1" multiple="multiple">
<?php
        for($i=0; $i<mysqli_num_rows($sql1); $i++) {
            $array = mysqli_fetch_array($sql1);
            $tes = $array['nama'];
            $selected = $array['selected'];
            echo '<option value = "'.$tes.'" '.$selected.'>'.$tes.'</option>';
        }
    ?>
</select>
</div>

<br>

<?php
$sql22 = "SELECT a.nama, 
CASE WHEN b.emp_id IS NOT NULL then 'selected'
END AS selected

FROM users a
LEFT JOIN hrdgroupotorisasidata b ON a.username = b.emp_id
LEFT JOIN hrdgroupemp c ON b.emp_id = c.emp_id
WHERE c.emp_id IS NULL";

$sql2 = mysqli_query($connect, $sql22);
?>

<h4>Employee Access To</h4>
<div class="card-body table-responsive p-0" style="width: 100vw;height: 30vh; width: 100%; overflow: scroll;overflow-x: hidden;">
<select id="select2" multiple="multiple">
<?php
        for($p=0; $p<mysqli_num_rows($sql2); $p++) {
            $array2 = mysqli_fetch_array($sql2);
            $tes2 = $array2['nama'];
            $selected2 = $array2['selected'];
            echo '<option value = "'.$tes2.'" '.$selected2.'>'.$tes2.'</option>';
        }
    ?>
</select>
</div>

<script type="text/javascript">
var tree4 = $("#select1").treeMultiselect({
       allowBatchSelection: true,
       enableSelectAll: true,
       searchable: true,
       sortable: true,
       startCollapsed: false,
});
</script>

<script type="text/javascript">
var tree4 = $("#select2").treeMultiselect({
       allowBatchSelection: true,
       enableSelectAll: true,
       searchable: true,
       sortable: true,
       startCollapsed: false,
});
</script>