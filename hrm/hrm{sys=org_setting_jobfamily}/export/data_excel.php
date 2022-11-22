<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family Description</th>
                                    
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
  a.jf_code,
  a.jf_name_en,
  a.jf_desc_en
  FROM teomjf a 
  WHERE a.jf_code LIKE '%$search%'
  OR a.jf_name_en LIKE '%$search%'
  OR a.jf_desc_en LIKE '%$search%'
  
  ");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["jf_code"]; ?></td>
            <td class='fontCustom'><?php echo $r["jf_name_en"]; ?></td>
            <td class='fontCustom'><?php echo $r["jf_desc_en"]; ?></td>

           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
