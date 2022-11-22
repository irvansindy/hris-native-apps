<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";
}
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
    a.jobtitle_code,
    a.jobtitle_name_en,
    CONCAT(b.jfl_name_en, ' [', b.jfl_code, ']') AS jfl_name
    FROM teomjobtitle a
    LEFT JOIN teorjfl b ON a.jfl_code = b.jfl_code";
    }else{
        $search  = $_POST['search'];
        $sql = "SELECT 
        a.jobtitle_code,
        a.jobtitle_name_en,
        CONCAT(b.jfl_name_en, ' [', b.jfl_code, ']') AS jfl_name
        FROM teomjobtitle a
        LEFT JOIN teorjfl b ON a.jfl_code = b.jfl_code
        WHERE a.jobtitle_code LIKE '%$search%'
        OR a.jobtitle_name_en LIKE '%$search%'
        OR b.jfl_name_en LIKE '%$search%'";
    }
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {

            

              
    $job_title        = "<td class='fontCustom'><a href='#' id='{$row["jobtitle_code"]}' onclick='' class='open_modaljob_title'>{$row["jobtitle_code"]}</a></td>";    
        $competency       = "<td class='fontCustom'><a href='#' id='{$row["jobtitle_code"]}' onclick='' class='open_modal_competency'><u>Competency</u></a></td>";       
      
    $set_career_path  = "<td class='fontCustom'><a href='#' id='{$row["jobtitle_code"]}' onclick='' class='open_modal_path'><u>Set Career Path</u></a></td>";       

              

              

              

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>	
                     $job_title	
			<td class='fontCustom'>{$row["jobtitle_name_en"]}</td>
                     <td class='fontCustom'>{$row["jfl_name"]}</td>
                     $competency
                     $set_career_path
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
       $(".open_modaljob_title").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_setting_jt.php",
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
                     url: "modal_add_jt.php",
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
       $(".open_modal_competency").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_competency.php",
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

<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_path").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_path.php",
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