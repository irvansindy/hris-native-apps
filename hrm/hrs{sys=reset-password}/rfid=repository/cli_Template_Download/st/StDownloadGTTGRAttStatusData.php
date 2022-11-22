<?php 
       include "../../../../application/session/sessionlv2.php";
       include "../../../../application/config.php";
       include "../../../../model/st/GMAttStatusSettingSearchGen.php";
       include "../../../../model/st/GMAttStatusSetting.php";
?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                <th class="fontCustom" style="z-index: 1;">Status Code</th>
                                                                <th class="fontCustom" style="z-index: 1;">Status Description</th>
                                                                <th class="fontCustom" style="z-index: 1;">Present Flag</th>
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
			<td class='fontCustom'><?php echo $r["attend_code"]; ?></td>
                     <td class='fontCustom'><?php echo $r["attend_name_id"]; ?></td>
                     <td class='fontCustom'><img src="<?php echo $r["present_flag"]; ?>"></td>
	       </tr>
 

<?php } ?>
</table>