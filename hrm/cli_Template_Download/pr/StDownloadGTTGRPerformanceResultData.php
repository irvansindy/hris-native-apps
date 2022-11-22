<?php 
       include "../../../../application/session/sessionlv2.php";
       include "../../../../application/config.php";
       include "../../../../model/pr/GMPerformancePlanSearchGen.php";
       include "../../../../model/pr/GMPerformancePlan.php";
?>


<table border="1" cellspacing="0" style="border-collapse:collapse; border:0.5pt solid #a6a6a6; width:875pt">
	<tbody>
		<tr>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:17pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">No</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:41pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">KPI Code</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:53pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">KPI Period</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:71pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Employee No.</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:83pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Employee Name</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:98pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Performance Result</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:98pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Performance Grade</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:157pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Performance Grade Adjustment</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:65pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Created date</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:56pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Created By</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:74pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Modified Date</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:#a6a6a6; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap; width:62pt"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Modified By</span></strong></span></span></td>
		</tr>
	</tbody>


         

				
<?php 
  //menampilkan data mysqli
  $no 			= 0;
  $var1 		= array('LIMIT 10, 0'); // untuk limit dihilangkan untuk mode excel MAKA DI REPLACE SAJA
  $var2 		= array('');
  $conversion 	= str_replace($var1, $var2, $qListRenderPerformanceFinalResult);
			  
  $modal		=mysqli_query($connect, $conversion);
  while($r=mysqli_fetch_array($modal)){
  $no++;
       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
                     <td class="fontCustom">$r['ipp_reqno']</td>      
                     <td class="fontCustom">$r['period_name']</td>      
                     <td class="fontCustom">$r['request_for']</td>      
                     <td class="fontCustom">$r['Full_Name']</td>      
                     <td class="fontCustom">$r['pa_result']</td>      
                     <td class="fontCustom">$r['pa_result_adjust']</td>      
                     <td class="fontCustom">$r['pa_grade']</td>      
                     <td class="fontCustom">$r['created_date']</td>      
                     <td class="fontCustom">$r['created_by']</td>      
                     <td class="fontCustom">$r['modified_date']</td>      
                     <td class="fontCustom">$r['created_by']</td>      
</tr>

        
             
</tr>
 

<?php } ?>
</table>