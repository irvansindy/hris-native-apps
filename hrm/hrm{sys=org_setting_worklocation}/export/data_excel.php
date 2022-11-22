<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Work Location Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Work Location</th>
                                                               <th class="fontCustom" style="z-index: 1;">Work Location Type</th>
                                                                                                    
                                                        </tr>

                                                </thead>

         

				
<?php 
$no = 1;
  //menampilkan data mysqli
  

  $search       = $_POST['data_search'];

//   if($wl_code <> '' && $wl_type <> ''){
//     $where    = "WHERE a.worklocation_code = '".$wl_code."' AND a.worklocation_type = '".$wl_type."'";
//   }elseif($wl_code <> '' && $wl_type == ''){
//     $where    = "WHERE a.worklocation_code = '".$wl_code."'";
//   }elseif($wl_code == '' && $wl_type <> ''){
//     $where    = "WHERE a.worklocation_type = '".$wl_type."'";
//   }
//   else{
//     $where    = "";  
  

// }

   $sql_export   = mysqli_query($connect, "SELECT 
a.company_id,
a.worklocation_code,
a.worklocation_name,
a.worklocation_type,
a.worklocation_address
FROM teomworklocation a
WHERE a.worklocation_code LIKE '%$search%'
OR a.worklocation_name LIKE '%$search%'
OR a.worklocation_type LIKE '%$search%'
ORDER BY a.worklocation_code");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["worklocation_code"]; ?></td>
            <td class='fontCustom'><?php echo $r["worklocation_name"]; ?></td>
			<td class='fontCustom'><?php echo $r["worklocation_type"]; ?></td>
			<!-- <td class='fontCustom'><?php echo $where; ?></td> -->
			<!-- <td class='fontCustom'><?php echo $r["divisi"]; ?></td> -->
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
