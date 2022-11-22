<?php include "../../../../application/session/sessionlv2.php";?>
<?php include "../../../../application/config.php";?>
<?php include "../../../../model/ta/GMLeaveApprovalSearchGen.php";?>
<?php include "../../../../model/ta/GMLeaveApprovalList.php";?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Number</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request For</th>
                                                               <th class="fontCustom" style="z-index: 1;">Type of Leave</th>
                                                               <th class="fontCustom" style="z-index: 1;">Start Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">End Date</th>
                                                               <th class="fontCustom" style="z-index: 1;">Total Days</th>
                                                               <th class="fontCustom" style="z-index: 1;">Remark</th>
                                                               <th class="fontCustom" style="z-index: 1;">Request Status</th>
                                                            
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
			<td class='fontCustom'><?php echo $r["request_no"]; ?></td>
                     <td class='fontCustom'><?php echo $r["emp_no"]; ?></td>
			<td class='fontCustom'><?php echo $r["leave_code"]; ?></td>
			<td class='fontCustom'><?php echo $r["leave_startdates"]; ?></td>
			<td class='fontCustom'><?php echo $r["leave_enddates"]; ?></td>
			<td class='fontCustom'><?php echo $r["totaldays"]; ?></td>
			<td class='fontCustom'><?php echo $r["remark"]; ?></td>
			<td class='fontCustom'><span class='badge badge-secondary'><?php echo $r["name_en"]; ?></span></td>
	              </tr>

        
             
  </tr>
 

<?php } ?>
</table>