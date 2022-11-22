<?php include "../../../../application/session/sessionlv2.php";?>
<?php include "../../../../application/config.php";?>
<?php include "../../../../model/eo/GMEmployeeSearchGen.php";?>
<?php include "../../../../model/eo/GMEmployeeList.php";?>


<table id="example1" border="1" width="99%" class="table table-bordered table-striped table-hover table-head-fixed">
                <thead>
                  <tr>
				  <th class="fontCustom"  style="z-index: 1;background-color: #e2e3e3;" nowrap="nowrap">No.</th>
					<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;" nowrap="nowrap">Employee No.</th>
                	<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Employee Name</th>
                	<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Gender</th>
                	<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Cost Code</th>
                	<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Work Location</th>
                    <th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Position</th>
                	<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Grade</th>
                	<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Join Date</th>
                	<th class="fontCustom" style="z-index: 1;background-color: #e2e3e3;">Employment Code</th>
                  </tr>
                </thead>

				
<?php 
  //menampilkan data mysqli
  $no 			= 0;
  $var1 		= array('LIMIT 10, 0'); // untuk limit dihilangkan untuk mode excel MAKA DI REPLACE SAJA
  $var2 		= array('');
  $conversion 	= str_replace($var1, $var2, $qListRender);
			  
  $modal		=mysqli_query($connect, $conversion);
  while($r		=mysqli_fetch_array($modal)){
  $no++;
       
?>

              <tr>
			  	<td class="fontCustom"><?php echo $no ?></td>      
				<td class='fontCustom'><?php echo $r["emp_no"]?></td>
				<td class='fontCustom'><?php echo $r["Full_Name"]?></td>
				<td class='fontCustom'><?php echo $r["gender"]?></td>
				<td class='fontCustom'><?php echo $r["cost_code"]?></td>
				<td class='fontCustom'><?php echo $r["worklocation_code"]?></td>
				<td class='fontCustom'><?php echo $r["pos_name_id"]?></td>
				<td class='fontCustom'><?php echo $r["grade_code"]?></td>
				<td class='fontCustom'><?php echo $r["join_date"]?></td>
				<td class='fontCustom'><?php echo $r["employ_code"]?></td>
	


	     </tr>
             
  </tr>
 

<?php } ?>
</table>