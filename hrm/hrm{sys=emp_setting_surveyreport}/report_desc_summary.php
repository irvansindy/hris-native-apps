<?php 

		// Ambil data event
		$query_event	= mysqli_query($connect, "SELECT target FROM hrmsurveyevent WHERE id_event = '$id_event'");
		$data_event		= mysqli_fetch_assoc($query_event);
		$target			= $data_event['target'];
		// Ambil data event
		// Ambil data tjawaban
		$query_jawaban	= mysqli_query($connect, "SELECT * FROM hrmsurveytjawaban where id_event = '$id_event'");
		$count_jawaban	= mysqli_num_rows($query_jawaban);
		// Ambil data tjawaban
		// Query Pertanyaan
		$query_script    = mysqli_query($connect, "SELECT 
		b.* 
		FROM hrmsurveygrouppertanyaan a
		LEFT JOIN hrmsurveytgroup b ON a.id_group = b.groupId
		WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
		$data_script    = mysqli_fetch_assoc($query_script);
?>

<div class="row">
<div class="col-sm-6"></div>
<div class="col-sm-2">
<form action="export/desc_summary_export.php" method="POST" target="_blank">
                                          
                                          <input type="hidden" name="id_event" value="<?php echo $id_event; ?>">
                                          <input type="hidden" name="target" value="<?php echo $target; ?>">

                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="print_excel" value="submit" >
                                                        </button>
														&nbsp
														<button type="submit" class="toolbar sprite-toolbar-print" id="EXCEL" style="border: 0;background-color: white;" name="print_cetak" value="submit" >
                                                        </button>


                                                  
                                          </form>
</div>
</div>

<div class="row">

    <div class="col-sm-7">
    <br>
        <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <td rowspan="2" bgcolor='#1f65b5' class="fontCustom"  ><p align="center"><b style="color:white;">ESSAY</b></p></td>
                    <td colspan="5" bgcolor='#5b1f8c' class="fontCustom"  ><p align="center"><b style="color:white;">JUMLAH RESPONDEN</b></p></td>
                </tr>
                <tr>
					<td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">TARGET</b></p></td>
					<td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">ACTUAL</b></p></td>
				</tr>

            </thead>
            <tbody>
                <?php
							$query_data_anggota	= mysqli_query($connect, "SELECT * FROM hrmsurveyanggotaevent WHERE id_event = '$id_event'");
							$data_anggota		= mysqli_num_rows($query_data_anggota);
							$query_data_essay	= mysqli_query($connect, "SELECT
							c.*
							FROM hrmsurveygroupessay a
							LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
							LEFT JOIN hrmsurveytdescription c ON b.groupId = c.groupId
							WHERE a.id_event = '$id_event' ORDER BY a.order ASC");

							while($data_essay = mysqli_fetch_assoc($query_data_essay)){
								$query_desc_essay	= mysqli_query($connect, "SELECT * FROM hrmsurveytansweressay WHERE groupId = '$data_essay[groupId]' AND descriptionId = '$data_essay[descriptionId]' AND id_event = '$id_event'");
								$count_desc_essay	= mysqli_num_rows($query_desc_essay);
							?>
								<tr>
									<td align="center" class="fontCustom"><a href="#" onclick='return startload()' class='open_modal_preview_essay' 
													   id1="<?php echo $id_event ?>" 
													   id2="<?php echo $data_essay['groupId'] ?>" 
													   id3="<?php echo $data_essay['descriptionId'] ?>" 
													   id4="<?php echo $data_anggota ?>"
													   id5="<?php echo $data_essay['description'] ?>"><?php echo substr($data_essay['description'],0,2) ?></a></td>
									<td align="center" class="fontCustom"><?php echo $data_anggota ?></td>
									<td align="center" class="fontCustom"><?php echo $count_desc_essay ?></td>
								</tr>
							<?php } ?>
							
							
            </tbody>
        </table>
    </div>

</div>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_preview_essay").click(function(e) {
              var m = $(this).attr("id1");
			  var n = $(this).attr("id2");
			  var o = $(this).attr("id3");
			  var p = $(this).attr("id4");
			  var q = $(this).attr("id5");
              $.ajax({
                     url: "modal_essay_preview.php",
                     type: "POST",
                     data: {
                            id1: m,
							id2: n,
							id3: o,
							id4: p,
							id5: q,
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
