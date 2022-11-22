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
    a.position_id,
    a.pos_code,
    CONCAT(a.pos_name_en, ' (', a.pos_code, ')') AS pos_name,
    a.pos_flag
    FROM hrmorgstruc a
    ORDER BY a.position_id
    LIMIT $start,$limit";
    }else{
        $search  = $_POST['search'];
        $sql = "SELECT 
        a.position_id,
        a.pos_code,
        CONCAT(a.pos_name_en, ' (', a.pos_code, ')') AS pos_name,
        a.pos_flag
        FROM hrmorgstruc a
        WHERE a.pos_code LIKE '%$search%'
        OR a.pos_name_en LIKE '%$search%'
        ORDER BY a.position_id
        LIMIT $start,$limit";
    }
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	// $output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {

            

              
    $pos_code         = "<td class='fontCustom'><a href='#' id1='{$row["pos_flag"]}' id='{$row["position_id"]}' onclick='' class='open_modal_org'>{$row["pos_code"]}</a></td>";    
   

              

              

              

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>	
                     $pos_code	
			<td class='fontCustom'>{$row["pos_name"]}</td>
                  
	     </tr>";
	}

	// $output .= "<tbody>";
			
	$output .= "";
	echo $output;	  
	}

?>


<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_org").click(function(e) {
              var m = $(this).attr("id");
              var n = $(this).attr("id1");

              if(n == '1'){
                     $.ajax({
                     url: "modal_setting_org.php",
                     type: "POST",
                     data: {
                            id: m
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
              }
              else if(n == '2'){
                     $.ajax({
                     url: "modal_setting_pos.php",
                     type: "POST",
                     data: {
                            id: m
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
              }
              
       });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
       $(".open_modaljflcompetence").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_jfl_competence.php",
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
                     url: "modal_add_org.php",
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