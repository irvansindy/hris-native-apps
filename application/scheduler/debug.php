<?php
		include "../application/config.php";
		
	?>

      <?php		
		$req_app 		= "work_location_code in ('PLTB','PLTI','PLTH') AND parent_path like '%6056%' AND grade_code IN ('12','11','10','9','8','7','6','5','4','3C','3B','3A','2','1')";
		$req_app_name 	= "ENG3 OPERATION JOIN PLT E_M_R FOR DH KE BWH";
		$req_seq_id 		= "2477";
		$req_app_code 	= "worklocation_code in ('PLTM','PLTE','PLTR') AND parent_path like '%7391%' AND grade_code IN ('12','11','10','9','8','7','6','5','4','3C','3B','3A','2','1')";
              $DataRows		= str_replace("'", "`", $req_app);
                
              $var1 = array('grade_code','worklocation_code');
              $var2 = array('b.grade_code','b.work_location_code');

              $conversion = str_replace($var1, $var2, $req_app);


	?>
<?php
		$vars=mysqli_query($connect, "
		SELECT 
		pos_code,
		'$req_seq_id' as req_seq_id, 
		'$req_app_name' as req_app_name
              FROM hrmorgstruc a
              LEFT JOIN teodempcompany b on a.position_id=b.position_id
		
		where Parent_path like '%,16757%' and pos_name_en like 'ASST. PLANT HEAD%' 

		GROUP BY pos_code
		");
		while($rs=mysqli_fetch_array($vars)){
	?>

      <tr>
            <td>
                  <?php echo $rs['pos_code']; ?>
            </td>
            <td>
                  <?php echo $rs['query']; ?>
            </td>
            <td>
                  <?php echo $rs['req_app_name']; ?>
            </td>
            <td>
                  <?php echo $rs['req_seq_id']; ?>
            </td>
      </tr>


      <?php } ?>