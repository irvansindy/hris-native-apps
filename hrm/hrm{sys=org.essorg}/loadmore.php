<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";
}

$limit  = $_POST['limit'];
$start  = $_POST['start'];

?>


<!-- CODE;NAME_EN
0;Draft
1;Unverified
2;Partially Approved
3;Fully Approved
4;Revised
5;Rejected
8;Cancelled
9;Closed -->

<?php	
	$no = 0;

       if(!isset($_POST['search'])){
              $sql = "SELECT 
              a.request_no,
              a.request_by,
              CONCAT('[', a.request_by, '] ', b.Full_Name) AS fullname,
              DATE_FORMAT(a.request_date, '%d %M %Y') AS req_date,
              c.pos_name_en AS req_division,
              d.pos_name_en AS req_department,
              a.request_position,
              a.request_type,
              e.name_en AS status_approval,
              f.name_en AS req_status
              FROM hrmorgessrequest a
              LEFT JOIN view_employee b ON b.emp_no = a.request_by
              LEFT JOIN teomposition c ON c.position_id = a.request_division
              LEFT JOIN teomposition d ON d.position_id = a.request_department
              LEFT JOIN hrmstatus e ON e.code = a.status_approval
              LEFT JOIN hrmorgreqstatus f ON f.code = a.request_status
              ORDER BY a.request_date DESC
              LIMIT $start,$limit";
           }else{
               $search  = $_POST['search'];
               $sql = "SELECT 
               a.request_no,
               a.request_by,
               CONCAT('[', a.request_by, '] ', b.Full_Name) AS fullname,
               DATE_FORMAT(a.request_date, '%d %M %Y') AS req_date,
               c.pos_name_en AS req_division,
               d.pos_name_en AS req_department,
               a.request_position,
               a.request_type,
               e.name_en AS status_approval,
               f.name_en AS req_status
               FROM hrmorgessrequest a
               LEFT JOIN view_employee b ON b.emp_no = a.request_by
               LEFT JOIN teomposition c ON c.position_id = a.request_division
               LEFT JOIN teomposition d ON d.position_id = a.request_department
               LEFT JOIN hrmstatus e ON e.code = a.status_approval
               LEFT JOIN hrmorgreqstatus f ON f.code = a.request_status
               WHERE (a.request_no LIKE '%$search%'
               OR b.Full_Name LIKE '%$search%'
               OR a.request_date LIKE '%$search%'
               OR c.pos_name_en LIKE '%$search%'
               OR d.pos_name_en LIKE '%$search%'
               OR a.request_position LIKE '%$search%'
               OR e.name_en LIKE '%$search%'
               OR f.name_en LIKE '%$search%')
               ORDER BY a.request_date DESC
               LIMIT $start,$limit";
           }

// 	$sql = "SELECT 
//        a.company_id,
//        a.worklocation_code,
//        a.worklocation_name,
//        a.worklocation_type,
//        a.worklocation_address
//        FROM teomworklocation a
//        ORDER BY a.worklocation_code
//     ";
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";


	while ($row = $query->fetch_assoc()) {

            

              
    // $company_name   = "<td class='fontCustom'><a href='#' id='{$row["request_no"]}' onclick='' class='open_modal_reqno'>{$row["request_no"]}</a></td>";        
        $action     = "<td nowrap='nowrap'>
                    <a href='#' id='{$row["request_no"]}' class='open_modal_reqno'><img src='../../asset/img/icons/acticon-note.png'></a>
                    <a href='#' id='{$row["request_no"]}' class='open_modal_reqno'><img src='../../asset/img/icons/glasses.png'></a>
                    </td>";
              

              

              

	$no++;
	$output.="<tr>
		
				
            <td class='fontCustom'>{$row["request_no"]}</td>
			<td class='fontCustom'>{$row["fullname"]}</td>
			<td class='fontCustom'>{$row["req_date"]}</td>
            <td class='fontCustom'>{$row["req_division"]}</td>
			<td class='fontCustom'>{$row["req_department"]}</td>
			<td class='fontCustom'>{$row["request_position"]}</td>
            <td class='fontCustom'>{$row["request_type"]}</td>
			<td class='fontCustom'>{$row["status_approval"]}</td>
			<td class='fontCustom'>{$row["req_status"]}</td>
            $action
	     </tr>";
	}

			
	$output .= "";
	echo $output;	  
	}

?>


<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_worklocationsetting").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_setting_worklocation.php",
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
                     url: "modal_add_request.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#tampil_request").html(ajaxData);
                            // $("#ModalEdit").modal({
                            //        backdrop: 'static',
                            //        keyboard: 'false'
                            // });
                     }
              });
       });
});
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_excel").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_export.php",
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
       $(".open_modal_appsetting_lvu").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "../hrm{sys=time.attendance}/modal_appsetting_lvu.php?emp_id=<?php echo $username; ?>",
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
       $(".open_modal_revised").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_revised.php?emp_id=<?php echo $username; ?>",
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