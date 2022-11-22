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

	$sql = "SELECT 
            a.company_id,
            a.company_name,
            a.company_code,
            a.currency_code,
            a.company_type,
            a.company_phone,
            a.company_fax,
            a.company_email,
            a.`status`
            FROM teomcompany a";
	
	$query = $connect->query($sql);

	if ($query->num_rows > 0) {
		
	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {

            
       if($row["status"] == '1'){
              $status       = 'Active';
       }elseif($row["status"] == '0'){
              $status       = 'Inactive';
       }elseif($row["status"] == '2'){
              $status       = 'Account';
       }
              
    $company_name   = "<td class='fontCustom'><a href='#' id='{$row["company_id"]}' onclick='' class='open_modal_companysetting'>{$row["company_name"]}</a></td>";        

              

              

              

	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>		
			$company_name
			<td class='fontCustom'>{$row["company_code"]}</td>
			<td class='fontCustom'>{$row["currency_code"]}</td>
			<td class='fontCustom'>{$row["company_type"]}</td>
			<td class='fontCustom'>{$row["company_phone"]}</td>
			<td class='fontCustom'>{$row["company_fax"]}</td>
            <td class='fontCustom'>{$row["company_email"]}</td>
			<td class='fontCustom'>{$status}</td>         
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
       $(".open_modal_companysetting").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_setting_company.php",
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
       $(".open_modal_attch").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_setting_company.php",
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