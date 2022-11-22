<?php include "../../../../application/session/sessionlv2.php";?>
<?php include "../../../../application/config.php";?>
<?php include "../../../../model/ta/GMAttendanceSearchGen.php";?>
<?php include "../../../../model/ta/GMAttendanceList.php";?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                <tr bordercolor="#000000">
								<td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" nowrap="nowrap" align="center">No.</td>
								<td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" nowrap="nowrap" align="center">Employee No.</td>
								<td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" nowrap="nowrap" align="center">Employee Name</td>
                                                        <td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" nowrap="nowrap" align="center">Date</td>
                                                        <td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Shift</td>
                                                        <td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Day Type</td>
                                                        <td rowspan="2" colspan="2" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Shift Daily</td>
                                                        <td colspan="4" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Actual Time</td>
                                                        <td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Status</td>
                                                        <td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Other Status</td>
                                                        <td rowspan="3" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Remark</td>
                                                 </tr>
                                                 <tr bordercolor="#000000">
                                                        <td colspan="2" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center"> in </td>
                                                        <td colspan="2" class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center"> Out</td>
                                                 </tr>
                                                 <tr bordercolor="#000000">
                                                        <td class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center"> in </td>
                                                        <td class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center"> Out</td>
                                                        <td class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Time</td>
                                                        <td class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">+/-Minute(s)</td>
                                                        <td class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">Time</td>
                                                        <td class="header-data" style="z-index: 1;background-color: #e2e3e3;" align="center">+/-Minute(s)</td>
                                                 
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
                            <td class='fontCustom'><?php echo $r["emp_no"]?></td>
                            <td align='center' class='fontCustom'><?php echo $r["Full_name"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["shiftstarttime"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["shiftdaily_code"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["daytype"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["shiftin"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["shiftout"]; ?></td>
				<td align='center' class='fontCustom'><?php echo $r["starttime"]; ?></td>
				<td align='center' class='fontCustom'><?php echo $r["actual_in"]; ?></td>
				<td align='center' class='fontCustom'><?php echo $r["endtime"]; ?></td>
				<td align='center' class='fontCustom'><?php echo $r["actual_out"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["attend_code"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["other_status"]; ?></td>
                            <td align='center' class='fontCustom'><?php echo $r["remark"]; ?></td>
                           
	              </tr>

        
             
  </tr>
 

<?php } ?>
</table>