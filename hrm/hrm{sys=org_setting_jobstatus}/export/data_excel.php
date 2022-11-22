<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Status Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Job Status Name</th>
                                                                                                    
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
  a.jobstatuscode,
  a.jobstatusname_en
  FROM teomjobstatus a
  WHERE
  a.jobstatuscode LIKE '%$search%' 
  AND a.company_id = '13576'

  ORDER BY a.jobstatuscode ASC
  ");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["jobstatuscode"]; ?></td>
            <td class='fontCustom'><?php echo $r["jobstatusname_en"]; ?></td>
	
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
