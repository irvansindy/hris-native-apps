<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>


<?php	
	// Include the database configuration file

       // AgusPrass 04/03/2021 Mengganti logic IF pada search

       if (!empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username' or b.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND  
                                          (a.request_no like '$inp_req') AND
                                          (DATE(a.requestdate) >= '$inp_date' AND DATE(a.requestdate) <= '$inp_enddate')";
       } elseif (!empty($_POST['inp_req']) && !empty($_POST['inp_date'])) {
              $inp_req             = $_POST['inp_req'];
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((g.emp_no='$username' or b.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND  
                                          (a.request_no like '$inp_req') AND
                                          DATE(a.requestdate) = '$inp_date'";

       } elseif (!empty($_POST['inp_req'])) {
              $inp_req             = $_POST['inp_req'];
              $where               = "WHERE ((g.emp_no='$username' or b.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND  
                                                                      (a.request_no like '$inp_req')";
                                   
       // AgusPrass 04/03/2021 Menambahkan Logic untuk search jika request number tidak terisi
       } elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date']) && !empty($_POST['inp_enddate'])){
              $inp_date            = $_POST['inp_date'];
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username' or b.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND 
                                          (DATE(a.requestdate) >= '$inp_date' AND DATE(a.requestdate) <= '$inp_enddate')";
       
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_date'])){
              $inp_date            = $_POST['inp_date'];
              $where               = "WHERE ((g.emp_no='$username' or b.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND DATE(a.requestdate) LIKE '$inp_date'";
                                                                      
       }elseif(empty($_POST['inp_req']) && !empty($_POST['inp_enddate'])){
              $inp_enddate         = $_POST['inp_enddate'];
              $where               = "WHERE ((g.emp_no='$username' or b.emp_no='$username')) and (d.code NOT IN ('0','4','8','5')) AND DATE(a.requestdate) LIKE '$inp_enddate'";
       

       // if (!empty($_POST['empnip']) && !empty($_POST['empname'])) {
       //        $identitynip = $_POST['empnip'];
       //        $identityname = $_POST['empname'];
       //        $where = "WHERE (a.request_no like '$identitynip') AND (b.full_name like '%$identityname%') AND g.emp_no='$username'";
       // } elseif (!empty($_POST['empnip']) && empty($_POST['empname'])) {
       //        $identitynip = $_POST['empnip'];
       //        $where = "WHERE (a.request_no like '$identitynip')";
       // } elseif (!empty($_POST['empname'])) {
       //        $identityname = $_POST['empname'];
       //        $where = "WHERE (b.full_name like '%$identityname%')";
       // } 

       // AgusPrass 04/03/2021 Mengganti logic IF pada search
       } else {
              $where = "WHERE (g.emp_no='$username' or b.emp_no='$username') and (d.code NOT IN ('0','4','8','5'))";
       }


	if (isset($_POST["limit"], $_POST["start"])) {
		$page = $_POST["limit"];
		$limit = $_POST["start"];
	}else{
		$page = 0;
		$limit = 10;
	}

	$no = 0;
                     // $sql = "SELECT 
                     // a.*,
                     // DATE_FORMAT(a.requestdate, '%d %b %Y') as leave_startdates,
                    
                     // b.emp_no,
                     // d.name_en     
                     // FROM hrmleavecancelrequest a
                     // LEFT JOIN teodempcompany b on a.requestfor=b.emp_id
                     // -- LEFT JOIN hrmrequest c on a.request_no=c.request_no

                     // LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

                     // LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                     // LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                     // LEFT JOIN teodempcompany g on f.position_id=g.position_id
                     // $where
                     // ORDER BY a.created_date DESC
                     // LIMIT $limit, $page";

			$sql = "SELECT 
                     a.*,
                     DATE_FORMAT(a.requestdate, '%d %b %Y') as leave_startdates,
                    
                     b.emp_no,
                     d.name_en     
                     FROM hrmleavecancelrequest a
                     LEFT JOIN teodempcompany b on a.requestfor=b.emp_id
                     -- LEFT JOIN hrmrequest c on a.request_no=c.request_no

                     LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

                     LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                     LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                     LEFT JOIN teodempcompany g on f.position_id=g.position_id

				$where

                            GROUP BY a.request_no

                            
				ORDER BY a.created_date DESC
                           
                            LIMIT $limit, $page
                            
                            
                   ";
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {
              // AgusPrass 01/03/2021
              $activebadge = '';
              if($row['name_en'] == "Draft") {
                     $activebadge = "badge-draft";
              } elseif($row['name_en'] == "Unverified") {
                     $activebadge = "badge-Unverified";  
              } elseif($row['name_en'] == "Partially Approved") {
                     $activebadge = "badge-Partially-Approved"; 
              } elseif($row['name_en'] == "Fully Approved") {
                     $activebadge = "badge-Fully-Approved";
              } elseif($row['name_en'] == "Revised") {
                     $activebadge = "badge-Revised";
              } elseif($row['name_en'] == "Rejected") {
                     $activebadge = "badge-Rejected"; 
              } elseif($row['name_en'] == "Cancelled") {
                     $activebadge = "badge-Cancelled";                
              } else {
                     $activebadge = "badge-Closed";
              }
              // AgusPrass 01/03/2021

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>		
			<td class='fontCustom'>{$row["request_no"]}</td>
			<td class='fontCustom'>{$row["emp_no"]}</td>
			<td class='fontCustom'>{$row["leave_code"]}</td>
			<td class='fontCustom'>{$row["leave_startdates"]}</td>
	
			<td class='fontCustom'>{$row["totaldays"]}</td>
                     <td class='fontCustom'>{$row["remark"]}</td>
			<td class='fontCustom'><span class='badge {$activebadge}'>{$row["name_en"]}</span></td>
			<td class='fontCustom'>
			<a href='#' onclick='return startload()' class='open_modal_appsetting' id={$row["request_no"]}><img src='../../asset/dist/img/icons/icon-addinfo.png' data-toggle='tooltip' title='approval'></a>
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
                     url: "modal_edit.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_add").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_add.php?emp_id=<?php echo $username; ?>",
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
                     url: "modal_search.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_appsetting").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_appsetting.php?emp_id=<?php echo $username; ?>",
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