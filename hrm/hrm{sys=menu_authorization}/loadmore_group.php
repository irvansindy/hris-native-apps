<?php include "../../application/session/session.php";?>

<?php include "../../model/st/GMAccessGroupList.php";?>
<?php	

	$sql = $qListRender;

	$query = $connect->query($sql);

	if ($query->num_rows > 0) {

	$output = "";

	$output .= "<tbody>";

	while ($row = $query->fetch_assoc()) {
			

	$output.="<tr>
			<td class='fontCustom'><a href='menu_auth_grp?rfid={$row["access_code"]}&group_set=GRP'>{$row["access_code"]}</a></td>
			<td class='fontCustom'><small>{$row["access_code"]}</small></td>
			<td class='fontCustom'><a href='menu_auth_member?rfid={$row["access_code"]}&group_set=GRP'><img src='../../asset/dist/img/usergroup.png'></a></td>
			<td class='fontCustom'><small>{$row["status"]}</small></td>
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