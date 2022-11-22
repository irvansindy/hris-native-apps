<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Title Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Title Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family Level Name</th>
                                                                                                    
                                                        </tr>

                                                </thead>

         

				
<?php 
$no = 1;
  //menampilkan data mysqli
  $search       = $_POST['data_search'];

 
// if($js_code <> '0'){
//     $where  = "WHERE a.jobstatuscode = '".$js_code."' AND a.company_id = '13576'";
// }else{
//     $where  = "WHERE a.company_id = '13576'";
// }

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
  a.jobtitle_code,
  a.jobtitle_name_en,
  CONCAT(b.jfl_name_en, ' [', b.jfl_code, ']') AS jfl_name
  FROM teomjobtitle a
  LEFT JOIN teorjfl b ON a.jfl_code = b.jfl_code
  WHERE a.jobtitle_code LIKE '%$search%'
  OR a.jobtitle_name_en LIKE '%$search%'
  OR b.jfl_name_en LIKE '%$search%'
  ");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["jobtitle_code"]; ?></td>
            <td class='fontCustom'><?php echo $r["jobtitle_name_en"]; ?></td>
            <td class='fontCustom'><?php echo $r["jfl_name"]; ?></td>

	
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
