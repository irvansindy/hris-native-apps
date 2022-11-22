<?php include "../../application/session/session.php";?>
<?php	
			
	$req 		= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
	 $req_app 		= mysqli_query($connect, "SELECT emp_no, 
									GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ' or ') AS formula 
											FROM hrmgroupdata
											WHERE emp_no = '$username'
											GROUP BY emp_no");

	 
	$check_having_formula = mysqli_num_rows($req_app);
	$var_having_formula = mysqli_fetch_array($req_app);
	
		if($check_having_formula < 1) {
			$conversion = "a.emp_no='$username'"; 
		} else {
			$var1 = array("emp_no","worklocation_code","cost_code","parent_path","grade_code","AND","OR","|","`");
			$var2 = array("a.emp_no","a.work_location_code","a.cost_code","c.parent_path"," a.grade_code"," AND "," OR ","','","'");
			$conversion = str_replace($var1, $var2, $var_having_formula['formula']); 
		}
		
	
		if (!empty($_POST['empnip']) && !empty($_POST['empname'])) {
			$identitynip = $_POST['empnip'];
			$identityname = $_POST['empname'];
			$where = "WHERE (a.emp_no like '$identitynip') AND (b.full_name like '%$identityname%') AND ($conversion)";
		} elseif (!empty($_POST['empnip']) && empty($_POST['empname'])) {
			$identitynip = $_POST['empnip'];
			$where = "WHERE (a.emp_no like '$identitynip') AND ($conversion)";
		} elseif (!empty($_POST['empname'])) {
			$identityname = $_POST['empname'];
			$where = "WHERE (b.full_name like '%$identityname%') AND ($conversion)";
		} else {
			$where = "WHERE ($conversion)";
	
		}


	if (isset($_POST["limit"], $_POST["start"])) {
		$page = $_POST["limit"];
		$limit = $_POST["start"];
	}else{
		$page = 0;
		$limit = 10;
	}

			$sql = "SELECT 
				a.*,
				b.full_name,
				 (SELECT p.seq_id
				FROM tclcreqappsetting_final as P
				WHERE P.position_id = c.pos_code
				LIMIT 1) as seq_id
				FROM teodempcompany a
				LEFT JOIN teomemppersonal b on a.emp_id=b.emp_id
				LEFT JOIN hrmorgstruc c on a.position_id=c.position_id
				$where 

				AND a.status='1'

				
				
				LIMIT $limit, $page

		

				
				
				
				";
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {
			
	$last_id = $row['position_id'];





	$output.="<tr>
		
			<td class='fontCustom'>{$row["emp_no"]}</td>
			<td class='fontCustom'><small>{$row["full_name"]}</small></td>
			<td class='fontCustom'><small>{$row["cost_code"]}</small></td>
			<td class='fontCustom'>
			
			<a href='#' onclick='return startload()' class='open_modal' id={$row["seq_id"]}><img src='../../asset/dist/img/icons/icon-addinfo.png' data-toggle='tooltip' title='approval'></a>
			
			</td>


	     </tr>";
	}

	$output .= "<tbody>";
			
	$output .= "";
	echo $output;	  
	}

?>



<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_edit.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>