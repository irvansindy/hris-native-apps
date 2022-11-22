<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Company Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Company Code</th>
                                                               <th class="fontCustom" style="z-index: 1;">Base Currency</th>
                                                               <th class="fontCustom" style="z-index: 1;">Company Type</th>
                                                               <th class="fontCustom" style="z-index: 1;">Phone</th>
                                                               <th class="fontCustom" style="z-index: 1;">FAX</th>
                                                               <th class="fontCustom" style="z-index: 1;">Corporate Email</th>
                                                               <th class="fontCustom" style="z-index: 1;">Status</th>


                                                                                                    
                                                        </tr>

                                                </thead>

         

				
<?php 
$no = 1;
  //menampilkan data mysqli
//   $value       = $_POST['value'];
  if(isset($_POST['value'])){
    $value     = $_POST['value'];
}elseif(isset($_GET['value'])){
    $value     = $_GET['value'];
}
//   $wl_type       = $_POST['wl_type'];

 
// if($wl_code == '0' && $wl_type <> '0'){
//     if($wl_type == ''){
//         $where    = "";  
//     }else{
//         $where    = "WHERE a.worklocation_type = '".$wl_type."'";
//     }
    
// }elseif($wl_code <> '0' && $wl_type == '0'){
//     if($wl_code == ''){
//         $where    = "";  
//     }else{
//         $where    = "WHERE a.worklocation_code = '".$wl_code."'";
//     }
// }elseif($wl_code <> '0' && $wl_type <> '0'){
//     if($wl_code <> '' && $wl_type <> ''){
//         $where    = "WHERE a.worklocation_code = '".$wl_code."' AND a.worklocation_type = '".$wl_type."'";
//     }elseif($wl_code <> '' && $wl_type == ''){
//         $where    = "WHERE a.worklocation_code = '".$wl_code."'";
//     }elseif($wl_code == '' && $wl_type <> ''){
//         $where    = "WHERE a.worklocation_type = '".$wl_type."'";
//     }
// }else{
//     $where    = "";  
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
// $sql = "SELECT 
// a.company_id,
// a.worklocation_code,
// a.worklocation_name,
// a.worklocation_type,
// a.worklocation_address
// FROM teomworklocation a
// WHERE a.worklocation_code LIKE '%$search%'
// OR a.worklocation_name LIKE '%$search%'
// OR a.worklocation_type LIKE '%$search%'
// ORDER BY a.worklocation_code

// }

  $sql_export   = mysqli_query($connect, "SELECT 
  a.company_id,
  a.company_name,
  a.company_code,
  a.currency_code,
  a.company_type,
  a.company_phone,
  a.company_fax,
  a.company_email,
  a.`status`
  FROM teomcompany a");

  while($r= mysqli_fetch_assoc($sql_export)){
    if($r['status'] == '1'){
      $status = 'Active';
    }elseif($r['status'] == '0'){
      $status = 'Inactive';
    }elseif($r['status'] == '2'){
      $status = 'Account';
    }
       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["company_name"]; ?></td>
            <td class='fontCustom'><?php echo $r["company_code"]; ?></td>
			<td class='fontCustom'><?php echo $r["currency_code"]; ?></td>
			<td class='fontCustom'><?php echo $r["company_type"]; ?></td>
      <td class='fontCustom'><?php echo $r["company_phone"]; ?></td>
			<td class='fontCustom'><?php echo $r["company_fax"]; ?></td>
      <td class='fontCustom'><?php echo $r["company_email"]; ?></td>
			<td class='fontCustom'><?php echo $status; ?></td>
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
