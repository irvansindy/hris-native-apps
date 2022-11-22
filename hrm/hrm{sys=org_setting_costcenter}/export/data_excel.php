<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Cost Center</th>
                                                               <th class="fontCustom" style="z-index: 1;">Cost Center Name</th>


                                                                                                    
                                                        </tr>

                                                </thead>

         

				
<?php 
$no = 1;
  //menampilkan data mysqli
//   $grade_name       = $_POST['grade_name'];
//   $jf_grade       = $_POST['jf_grade'];
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
  a.costcenter_code,
  a.costcenter_name_en
  FROM teomcostcenter a
  WHERE a.costcenter_code LIKE '%$search%'
  OR a.costcenter_name_en LIKE '%$search%'
  
  ");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["costcenter_code"]; ?></td>
            <td class='fontCustom'><?php echo $r["costcenter_name_en"]; ?></td>

	
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
