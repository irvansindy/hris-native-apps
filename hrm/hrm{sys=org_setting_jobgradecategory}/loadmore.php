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
                     a.gradecategory_code,
                     a.gradecategory_name 
                     FROM teomgradecategory a
                     WHERE a.company_id = '13576'
                     ORDER BY a.order_id ASC
                     LIMIT $start,$limit";
           }else{
               $search  = $_POST['search'];
               $sql = "SELECT 
               a.gradecategory_code,
               a.gradecategory_name 
               FROM teomgradecategory a
               WHERE 
               (a.gradecategory_code LIKE '%$search%'
               OR a.gradecategory_name LIKE '%$search%')
               AND a.company_id = '13576'
               ORDER BY a.order_id ASC
               LIMIT $start,$limit";
           }

	// $sql = "SELECT 
       // a.gradecategory_code,
       // a.gradecategory_name 
       // FROM teomgradecategory a
       // WHERE a.company_id = '13576'
       // ORDER BY a.order_id ASC";
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";


	while ($row = $query->fetch_assoc()) {

            

              
    $grade_category_code   = "<td class='fontCustom'><a href='#' id='{$row["gradecategory_code"]}' onclick='' class='open_modalgradecategory_code'>{$row["gradecategory_code"]}</a></td>";        

              

              

              

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>	
                     $grade_category_code	
			<td class='fontCustom'>{$row["gradecategory_name"]}</td>
	     </tr>";
	}

			
	$output .= "";
	echo $output;	  
	}

?>




<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modalgradecategory_code").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_setting_jobgradecategory.php",
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
                     url: "modal_add_jobgradecategory.php",
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