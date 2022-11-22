<?php
  include "../../application/config.php";
  $modals=mysql_fetch_array(mysql_query("SELECT period FROM kpperiod order by id desc limit 1"));
  $modal=mysql_query("SELECT * FROM kptrans where tahap = '$modals[period]'");
?>
<!DOCTYPE html5>
<html>
  <head>
    <title>Tree Multiselect test</title>

    <meta charset="UTF-8">

    <style>
      * {
        font-family: sans-serif;
      }
    </style>
    <link rel="stylesheet" href="dist/jquery.tree-multiselect.min.css">

    <script src="vendor/jquery-1.11.3.min.js"></script>
    <script src="vendor/jquery-ui.min.js"></script>
    <script src="dist/jquery.tree-multiselect.js"></script>
  </head>

  <body>


    <div id="testDiv" style="overflow-x:hidden;width:900px;height:500px;border-bottom:2px solid lightgrey;border-right:2px solid lightgrey">
    <form action="insert.php" method="post" target="_blank framename">
    <select id="framework" name="framework[]" multiple class="form-control">
        <?php if (mysql_num_rows($modal) > 0) { ?>
        <?php while ($row = mysql_fetch_array($modal)) { ?>
           <option value="<?php echo $row['nokpt'] ?>" data-section="<?php echo $row['time'] ?>" selected data-index="1">[<?php echo $row['tahap'] ?>] <?php echo $row['nokpt'] ?></option>
        <?php } ?>
      <?php } ?>
    </select>
    </div>
    </form>
  </div>

    <script type="text/javascript">
      var tree4 = $("#framework").treeMultiselect({
        allowBatchSelection: true,
        enableSelectAll: true,
        searchable: true,
        sortable: true,
        startCollapsed: true
      });


    </script>
  </body>
</html>
