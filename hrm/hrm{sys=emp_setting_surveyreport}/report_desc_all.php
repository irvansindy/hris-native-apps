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
<div class="col-sm-10"></div>
<div class="col-sm-2">
<form action="export/desc_all_export.php" method="POST" target="_blank">
                                          
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
 <br>
<div class="row">   
    <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover">
        <thead>
                <tr>
                    <td colspan="" bgcolor='#1f65b5' class="fontCustom"><p align="center"><b style="color:white;">NO</b></p></td>
                    <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">PERTANYAAN</b></p></td>
                    <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">EMP NO</b></p></td>  
                    <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">FULLNAME</b></p></td>
                    <td colspan="" bgcolor='#5b1f8c' class="fontCustom"><p align="center"><b style="color:white;">PERNYATAAN</b></p></td>
				</tr>
        </thead>
        <tbody>
            <?php 
                        $query_essay    = mysqli_query($connect, "SELECT
						c.*
						FROM hrmsurveygroupessay a
						LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
						LEFT JOIN hrmsurveytdescription c ON b.groupId = c.groupId
						WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
                        $no = 0;
						$nomor = '';
                        while($data_essay = mysqli_fetch_assoc($query_essay)){
							
							$desc	= $data_essay['description'];
							$query_description	= mysqli_query($connect, "SELECT a.*,
							b.nama 
							FROM hrmsurveytansweressay a 
							LEFT JOIN users b  ON a.nip = b.username
							WHERE groupId = '$data_essay[groupId]' AND descriptionId = '$data_essay[descriptionId]' AND id_event = '$id_event'");
                            
							while($data_description = mysqli_fetch_assoc($query_description)){
								
								if($data_description['descriptionId'] == $nomor){
									$no = '';
									$desc = '';
								}elseif($data_description['descriptionId'] != $nomor){
									$no++; 
								}
								$nomor = $data_description['descriptionId'];
                ?>
				<tr>
					<td align="center" width="5%" class="fontCustom"><?php echo substr($desc,0,2); ?></td>
					<td width="38%" class="fontCustom"><?php echo substr($desc,4) ?></td>
					<td align="center" width="7%" class="fontCustom"><?php echo $data_description['nip'] ?></td>
					<td width="16%" class="fontCustom"><?php echo $data_description['nama'] ?></td>
					<td class="fontCustom"><?php echo $data_description['jawaban'] ?></td>
				</tr>
				<?php } ?>
				<?php } ?>
        </tbody>
    </table>
</div>