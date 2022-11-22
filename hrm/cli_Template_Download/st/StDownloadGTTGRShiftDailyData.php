<?php 
       include "../../../../application/session/sessionlv2.php";
       include "../../../../application/config.php";
       include "../../../../model/st/GMShiftDailySettingSearchGen.php";
       include "../../../../model/st/GMShiftDailySetting.php";
?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                <th class="fontCustom" style="z-index: 1;">Shift Daily Code</th>
                                                                <th class="fontCustom" style="z-index: 1;">Start Time</th>
                                                                <th class="fontCustom" style="z-index: 1;">End Time</th>
                                                                <th class="fontCustom" style="z-index: 1;">Break Time</th>
                                                                <th class="fontCustom" style="z-index: 1;">Day Type</th>
                                                                <th class="fontCustom" style="z-index: 1;">Flexible Shift</th>
                                                                <th class="fontCustom" style="z-index: 1;">Remark</th>
                                                            
                                                        </tr>

                                                </thead>

         

				
<?php 
  //menampilkan data mysqli
  $no 			= 0;
  $var1 		= array('LIMIT 10, 0'); // untuk limit dihilangkan untuk mode excel MAKA DI REPLACE SAJA
  $var2 		= array('');
  $conversion 	= str_replace($var1, $var2, $qListRender);
			  
  $modal		=mysqli_query($connect, $conversion);
  while($r=mysqli_fetch_array($modal)){
  $no++;
       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["shiftdailycode"]; ?></td>
                     <td class='fontCustom'><?php echo $r["starttime"]; ?></td>
			<td class='fontCustom'><?php echo $r["endtime"]; ?></td>
			<td class='fontCustom'><?php echo $r["break_no"]; ?></td>
			<td class='fontCustom'><?php echo $r["daytype"]; ?></td>
                     <td class='fontCustom'><img src="<?php echo $r["flexibleshift"]; ?>"></td>
			<td class='fontCustom'><?php echo $r["remark"]; ?></td>
	              </tr>

        
             
  </tr>
 

<?php } ?>
</table>