<?php 
       include "../../../../application/session/sessionlv2.php";
       include "../../../../application/config.php";
       include "../../../../model/st/GMOndtcategoryTypeSearchGen.php";
       include "../../../../model/st/GMOndtcategoryType.php";
?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom"
                                                                        style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                                        nowrap="nowrap"><br>No.</th>
                                                                <th class="fontCustom"
                                                                        style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                                        Category Code</th>
                                                                <th class="fontCustom"
                                                                        style="z-index:1;vertical-align: ce;vertical-align: middle;">Category Name
                                                                </th>
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
			<td class='fontCustom'><?php echo $row["category_code"]; ?></td>
			<td class='fontCustom'><?php echo $row["category_name_en"]; ?></td>
	       </tr>

        
             
  </tr>
 

<?php } ?>
</table>