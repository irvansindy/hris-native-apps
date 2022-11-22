<?php include "../../application/session/session.php";?>
<?php include "../../model/st/GMAccessGroupList.php";?>
<?php	

	$sql = $qListRender;

	$query = $connect->query($sql);

	if ($query->num_rows > 0) {

	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {
		
	$deductedleave = '';
	if($row["deductedleave"] == 'Y') {
		$deductedleave = "<img src='../../asset/dist/img/tick.png'>";
	} elseif($row["deductedleave"] == 'N') {
		$deductedleave = "<img src='../../asset/dist/img/inactive.png'>";
	}

	$repeatperiod = '';
	if($row["repeatperiod"] == '1') {
		$repeatperiod = "<img src='../../asset/dist/img/tick.png'>";
	} elseif($row["repeatperiod"] == '0') {
		$repeatperiod = "<img src='../../asset/dist/img/inactive.png'>";
	}

	

	$output.="<tr>
					<td class='fontCustom'><a href='leave_auth?rfid={$row["leave_code"]}&group_set=emp'>{$row["leave_code"]}</a></td>
					<td class='fontCustom'><small>{$row["leavename_en"]}</small></td>
					<td class='fontCustom'><small>{$row["eligibility_formula"]}</small></td>
					<td class='fontCustom'><small>{$row["daytype"]}</small></td>
					<td class='fontCustom'><small>{$deductedleave}</small></td>
					<td class='fontCustom'><small>{$row["daycount"]}</small></td>
					<td class='fontCustom'><small>{$deductedleave}</small></td>
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
