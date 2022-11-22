<table id="datatable" class="table table-bordered table-striped table-hover table-head-fixed dataTable no-footer" role="grid" aria-describedby="datatable_info" style="border-right: 4px solid #f2f2f2; width: 100%;" width="100%" border="1" align="left">
  <thead>
  <tr>
    <th  colspan="2" class="digital" style="font-weight: bold;vertical-align: middle; text-align: center; z-index: 1; width: 407.867px; background-color: rgb(66, 133, 197); color: white; height: 24px; vertical-align: middle;">Performance</th>
    <th class="digital" style="font-weight: bold;vertical-align: middle; text-align: center; z-index: 1; width: 407.867px; background-color: rgb(66, 133, 197); color: white; height: 24px; vertical-align: middle;">Score Start</th>
    <th class="digital" style="font-weight: bold;vertical-align: middle; text-align: center; z-index: 1; width: 407.867px; background-color: rgb(66, 133, 197); color: white; height: 24px; vertical-align: middle;">Score End</th>
  </tr>


</thead>

<?php
include "../../../application/config.php";
$sql = mysqli_query($connect, "SELECT * FROM hrmperf_range ORDER BY order_no DESC");

while ($r = mysqli_fetch_array($sql)) {
    ?>
<tr>
    <td><?Php echo $r['order_no'];?></td>
    <td><?Php echo $r['id_range'];?></td>
    <td align="center"><?Php echo $r['score_start'];?>%</td>
    <td align="center"><?Php echo $r['score_end'];?>%</td>
  </tr>

<?php } ?>
</table>    