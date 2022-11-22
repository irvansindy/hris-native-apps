<?php 
       include "../../../../application/session/sessionlv2.php";
       include "../../../../application/config.php";
       include "../../../../model/st/GMAttMachineSettingSearchGen.php";
       include "../../../../model/st/GMAttMachineSetting.php";
?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Machine Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Method</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">File Type</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">File Extension</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Use In/Out Flag</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Datasource</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Table Name</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">In Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Out Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Break Start Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Break End Code</th>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">Attendance ID based on</th>
                                                            
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
				<td class='fontCustom'><<?php echo $row["machine_code"]; ?></td>
				<td class='fontCustom'><?php echo $row["method"]; ?></td>
                            <td class='fontCustom'><?php echo $row["file_type"]; ?></td>
                            <td class='fontCustom'><?php echo $row["fileext"]; ?></td>
                            <td class='fontCustom'><img src=<?php echo $row["inoutflag"]; ?>></td>
                            <td class='fontCustom'><?php echo $row["datasource"]; ?></td>
                            <td class='fontCustom'><?php echo $row["table_name"]; ?></td>
                            <td class='fontCustom'><?php echo $row["in_status"]; ?></td>
                            <td class='fontCustom'><?php echo $row["out_status"]; ?></td>
                            <td class='fontCustom'><?php echo $row["breakstart_code"]; ?></td>
                            <td class='fontCustom'><?php echo $row["breakend_code"]; ?></td>
                            <td class='fontCustom'><?php echo $row["attend_code"]; ?></td>
	       </tr>

        
             
  </tr>
 

<?php } ?>
</table>