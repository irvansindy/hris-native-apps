<table id="example1">
      <tr>
            <td>
                  Poscode
            </td>
            <td>
                  Query
            </td>
            <td>
                  Query Name
            </td>
      </tr>
      <?php
		include "../config.php";
		$no = 0;
		
		$var=mysqli_query($connect, "SELECT a.* FROM tclcreqappsetting a");
		$truncate=mysqli_query($connect, "TRUNCATE tclcreqappsetting_final");
		while($r=mysqli_fetch_array($var)){
		$no++;	
	?>

      <?php		
		$req_app 		= $r['requestee'];
		$req_app_name 	= $r['request_approval_name'];
		$req_seq_id 		= $r['seq_id'];
		$req_app_code 	= $r['request_approval_code'];
		$DataRows		= str_replace("'", "`", $req_app);
		  
		$var1 = array('grade_code','worklocation_code','emp_no');
              $var2 = array('b.grade_code','b.work_location_code','b.emp_no');

              $conversion = str_replace($var1, $var2, $req_app);
	?>

      <?php
		$vars=mysqli_query($connect, "
		SELECT 
		pos_code,
		'$req_seq_id' as req_seq_id, 
		'$req_app_name' as req_app_name, 
		'$req_app_code' as req_app_code,
		'$DataRows' as query 
		FROM hrmorgstruc a
		LEFT JOIN teodempcompany b on a.position_id=b.position_id

		where $conversion
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

      <?php
	$data1 		= $rs['req_seq_id'];
	$data2 		= $rs['query'];
	$data3 		= $rs['pos_code'];
	$data4 		= $rs['req_app_name'];
	$data5 		= $rs['req_app_code'];
	$DataRows2		= addslashes(str_replace("`", "'", $data2));

	$varpo=mysqli_query($connect, "INSERT INTO tclcreqappsetting_final (
									seq_id,
									position_id,
									request_approval_name,
									request_approval_code,
									request_approval_formula) 
										values (
											'$data1',
											'$data3',
											'$data4',
											'$data5',
											'$DataRows2')");
	
	?>
      <?php } ?>
      <?php } ?>
      <tr>
            <td colspan="4" style="color:red">
                  Data Successfully Upload
            </td>
      </tr>
</table>