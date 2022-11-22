<?php include "../../../application/config.php";?>



<table id="tableOTSetting" border="1"  width="100%"
                                                class="table table-bordered table-striped table-hover table-head-fixed">
                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No.</th>
                                                               <th class="fontCustom" style="z-index: 1;">Company Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Bank Name</th>
                                                               <th class="fontCustom" style="z-index: 1;">Bank Account</th>
                                                               <th class="fontCustom" style="z-index: 1;">Account Name</th>

                                                                                                    
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
  a.bank_code,
  b.company_name,
  c.bank_name,
  a.bank_account,
  a.account_name
  FROM teorcompbank a
  LEFT JOIN teomcompany b ON a.company_id = b.company_id
  LEFT JOIN tpymbank c ON a.bank_code = c.bank_code
  WHERE a.company_id = '13576' AND
  ( a.bank_code LIKE '%$value%'
  OR b.company_name LIKE '%$value%'
  OR c.bank_name LIKE '%$value%'
  OR a.bank_account LIKE '%$value%'
  OR a.account_name LIKE '%$value%')");

  while($r= mysqli_fetch_assoc($sql_export)){

       
?>

<tr>
			<td class="fontCustom"><?php echo $no; ?></td>      
			<td class='fontCustom'><?php echo $r["company_name"]; ?></td>
            <td class='fontCustom'><?php echo $r["bank_name"]; ?></td>
			<td class='fontCustom'><?php echo $r["bank_account"]; ?></td>
			<td class='fontCustom'><?php echo $r["account_name"]; ?></td>
           





		
	              </tr>

        
             
  </tr>
 

<?php   $no++; } ?>
</table>
