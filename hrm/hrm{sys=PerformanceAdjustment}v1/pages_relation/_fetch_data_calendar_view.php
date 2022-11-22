<?php
include "../../../application/config.php";
$rfid = $_GET['rfid'];

?>


<table id="example3LOAD" width="100%">
  <thead>
    <tr>
      <th class="fontCustom" style="z-index: 1;background-color: #d5d5d5;padding: 10px;text-align: center;color: #6b6b6b" nowrap="nowrap">Month.</th>
      <th class="fontCustom" style="z-index: 1;background-color: #d5d5d5;padding: 10px;text-align: center;color: #6b6b6b">Date Shift</th>
      <th class="fontCustom" style="z-index: 1;background-color: #d5d5d5;padding: 10px;text-align: center;color: #6b6b6b">Shift Group</th>
      <th class="fontCustom" style="z-index: 1;background-color: #d5d5d5;padding: 10px;text-align: center;color: #6b6b6b">Shift Daily</th>
      <th class="fontCustom" style="z-index: 1;background-color: #d5d5d5;padding: 10px;text-align: center;color: #6b6b6b">Day Type</th>
      <th class="fontCustom" style="z-index: 1;background-color: #d5d5d5;padding: 10px;text-align: center;color: #6b6b6b">Years</th>
      <th class="fontCustom" style="z-index: 1;background-color: #d5d5d5;padding: 10px;text-align: center;color: #6b6b6b">Premi Check</th>
    </tr>
    <?php
    $sql = mysqli_query($connect, "SELECT
                                    CASE WHEN DATE_FORMAT(sub1.pls , '%b') = DATE_FORMAT(a.dateshift, '%b') then ''
                                    ELSE DATE_FORMAT(a.dateshift, '%M %Y')
                                    END AS 'DATEH',
                                    DATE_FORMAT(a.dateshift, '%b') as dateshift,
                                    DATE_FORMAT(a.dateshift, '%a, %d %b %Y') as dateshift,
                                    a.shiftgroupcode,
                                    a.shiftdailycode,
                                    a.daytype,
                                    a.scheduleyear,
                                    a.premicheck,
                                    CASE 
                                      WHEN  a.premicheck = '1' THEN '<img src=../../asset/dist/img/tick.png>'
                                      ELSE '<img src=../../asset/dist/img/inactive.png>'
                                    END as premi_flag,
                                    CASE 
                                          WHEN a.daytype LIKE '%PH%' THEN 'style=background:pink'
                                          ELSE ''
                                      END AS style
                                    
                                    FROM hrmgroupsheduledetail a
                                    LEFT JOIN 
                                        (
                                        SELECT 
                                          sub1.dateshift,
                                          ADDDATE(sub1.dateshift, INTERVAL -1 DAY) AS pls
                                        FROM hrmgroupsheduledetail sub1
                                        ) sub1 ON a.dateshift=sub1.dateshift
                                      
                                    WHERE a.shiftgroupname = '$rfid'
                                    
                                    GROUP BY MONTH(a.dateshift) ASC, a.dateshift ASC
                                    ");
    $no = 0;
    $no++;
    while ($r = mysqli_fetch_array($sql)) {
    ?>
      <tr>
        <td href="#" style="padding: 6px;" nowrap="nowrap"><?php echo $r['DATEH']; ?></td>
        <td href="#" style="padding: 6px;" <?php echo $r['style']; ?> nowrap="nowrap"><?php echo $r['dateshift']; ?></td>
        <td href="#" style="padding: 6px;" <?php echo $r['style']; ?> nowrap="nowrap"><?php echo $r['shiftgroupcode']; ?></td>
        <td href="#" style="padding: 6px;" <?php echo $r['style']; ?> nowrap="nowrap"><?php echo $r['shiftdailycode']; ?></td>
        <td href="#" style="padding: 6px;" <?php echo $r['style']; ?> nowrap="nowrap"><?php echo $r['daytype']; ?></td>
        <td href="#" style="padding: 6px;" <?php echo $r['style']; ?> nowrap="nowrap"><?php echo $r['scheduleyear']; ?></td>
        <td align="center" style="padding: 6px;" href="#" <?php echo $r['style']; ?> nowrap="nowrap"><?php echo $r['premi_flag']; ?></td>

      <?php
    }
      ?>
      </tr>
  </thead>
</table>