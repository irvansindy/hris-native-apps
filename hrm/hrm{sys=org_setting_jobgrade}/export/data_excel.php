<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Grade Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Grade Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Grade Category</th>


                                                                                                    
                                                        </tr>

                                                </thead>

         

				
<?php 
$no = 1;
  //menampilkan data mysqli
  $search           = $_POST['data_search'];

 
// if($grade_name <> '0' && $jf_grade <> '0'){
//     $where  = "WHERE a.grade_code = '$grade_name' AND a.gradecategory_code = '$jf_grade' AND a.company_id = '13576'";
// }else if ($grade_name <> '0' && $jf_grade != '0'){
//     $where  = "WHERE a.gradecategory_code = '$jf_grade' AND a.company_id = '13576'";
// }else if($grade_name != '0' && $jf_grade <> '0'){
//     $where  = "WHERE a.grade_code = '$grade_name' AND a.company_id = '13576'";
// }else if($grade_name == '0' && $jf_grade == '0'){
//     $where = "WHERE a.company_id = '13576'";
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
  a.grade_code,
  a.grade_name,
  a.gradecategory_code,
  b.gradecategory_name
  FROM teomjobgrade a 
  LEFT JOIN teomgradecategory b ON a.gradecategory_code = b.gradecategory_code
  WHERE (a.grade_code LIKE '%$search%'
  OR a.grade_name LIKE '%$search%'
  OR a.gradecategory_code LIKE '%$search%'
  OR b.gradecategory_name LIKE '%$search%')
  AND a.company_id = '13576'
  ORDER BY a.grade_order
  
  ");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["grade_code"]; ?></td>
            <td class='fontCustom'><?php echo $r["grade_name"]; ?></td>
            <td class='fontCustom'><?php echo $r["gradecategory_code"]; ?></td>
            <td class='fontCustom'><?php echo $r["gradecategory_name"]; ?></td>
	
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
