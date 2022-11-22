<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family Level Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family Level Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Family Grade</th>


                                                                                                    
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
  a.jfl_code,
  a.jfl_name_en,
  CONCAT(b.jf_code, ' - ', b.jf_name_en) AS job_family,
  CONCAT(c.jfgrade_code, ' - ', c.jfgrade_name_en) AS job_grade
  FROM teorjfl a
  LEFT JOIN teomjf b ON a.jf_code = b.jf_code
  LEFT JOIN teomjfgrade c ON a.jfgrade_code = c.jfgrade_code
  
  ");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["jfl_code"]; ?></td>
            <td class='fontCustom'><?php echo $r["jfl_name_en"]; ?></td>
            <td class='fontCustom'><?php echo $r["job_family"]; ?></td>
            <td class='fontCustom'><?php echo $r["job_grade"]; ?></td>
	
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
