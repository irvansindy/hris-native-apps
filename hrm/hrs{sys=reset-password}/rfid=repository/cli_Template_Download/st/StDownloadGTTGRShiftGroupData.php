<?php 
       include "../../../../application/session/sessionlv2.php";
       include "../../../../application/config.php";
       include "../../../../model/st/GMShiftGroupSettingSearchGen.php";
       include "../../../../model/st/GMShiftGroupSetting.php";
?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                <th class="fontCustom" style="z-index: 1;">Group Code</th>
                                                                <th class="fontCustom" style="z-index: 1;">Group Name</th>
                                                                <th class="fontCustom" style="z-index: 1;">Total Days</th>
                                                                <th class="fontCustom" style="z-index: 1;">Shift Detail</th>
                                                                <th class="fontCustom" style="z-index: 1;">Overtime Based On</th>
                                                        </tr>

                                                </thead>

         

				
<?php 
  //menampilkan data mysqli
  $no 			= 0;
  $var1 		= array('LIMIT 10, 0'); // untuk limit dihilangkan untuk mode excel MAKA DI REPLACE SAJA
  $var2 		= array('');
  $conversion 	= str_replace($var1, $var2, $qListRender);
			  
  $modal		=mysqli_query($connect, $conversion);
  while($row=mysqli_fetch_array($modal)){
  $no++;
       
?>

              <tr>
                        <td class='fontCustom'><?php echo $no; ?></td>				
			<td class='fontCustom'><?php echo $row["shiftgroupcode"]; ?></td>
			<td class='fontCustom'><?php echo $row["shiftgroupname"]; ?></td>
                        <td class='fontCustom'><?php echo $row["totaldays"]; ?></td>
                        <td class='fontCustom'><?php echo $row["formula"]; ?></td>
                        <td class='fontCustom'><?php echo $row["overtime_calculation"]; ?></td>
	       </tr>

        
             
  </tr>
 

<?php } ?>
</table>