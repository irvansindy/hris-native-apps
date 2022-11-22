<?php 
       include "../../../../application/session/sessionlv2.php";
       include "../../../../application/config.php";
       include "../../../../model/st/GMOndtAllowanceItemSearchGen.php";
       include "../../../../model/st/GMOndtAllowanceItem.php";
?>


<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom"
                                                                        style="z-index: 1;vertical-align: ce;vertical-align: middle;"
                                                                        nowrap="nowrap">No.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                                <th class="fontCustom"
                                                                        style="z-index: 1;vertical-align: ce;vertical-align: middle;">
                                                                        Item Code&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                                <th class="fontCustom"
                                                                        style="z-index:1;vertical-align: ce;vertical-align: middle;">Item Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                <th class="fontCustom"
                                                                        style="z-index:1;vertical-align: ce;vertical-align: middle;">Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                <th class="fontCustom"
                                                                        style="z-index:1;vertical-align: ce;vertical-align: middle;">Purpose Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                <th class="fontCustom"
                                                                        style="z-index:1;vertical-align: ce;vertical-align: middle;">Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                </th>
                                                                <th class="fontCustom"
                                                                        style="z-index:1;vertical-align: ce;vertical-align: middle;">Currency&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
			<td class='fontCustom'><?php echo $row["item_code"]; ?></td>
			<td class='fontCustom'><?php echo $row["item_name_en"]; ?></td>
                        <td class='fontCustom'><?php echo $row["category_name_en"]; ?></td>
                        <td class='fontCustom'><?php echo $row["purpose_code"]; ?></td>
                        <td class='fontCustom'><?php echo $row["type"]; ?></td>
                        <td class='fontCustom'><?php echo $row["currency_code"]; ?></td>
	       </tr>

        
             
  </tr>
 

<?php } ?>
</table>