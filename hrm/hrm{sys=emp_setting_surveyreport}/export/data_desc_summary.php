<?php 

include "../../../application/session/session_ess.php";

$id_event   =   $_POST['id_event'];
$target     =   $_POST['target'];

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

        $query_event	= mysqli_query($connect, "SELECT * FROM hrmsurveyevent WHERE id_event = '$id_event'");
        $data_event		= mysqli_fetch_assoc($query_event);

?>

<style type="text/css" media="print">

table {border: solid 1px #000; border-collapse: collapse; width: 100%}

tr { border: solid 2px #000}

td { border: solid 2px #000; padding: 0px 3px; font-family:Arial; font-size: 15px;}

h3 { margin-bottom: 10px }

h2 { margin-bottom: 10px }

</style>

<style type="text/css" media="screen">

  table {border: solid 1px #000; border-collapse: collapse; width: 50%}

  tr { border: solid 1px #000}

  td { padding: 0px 5px; font-family:Arial; font-size: 15px;}

  h3 { margin-bottom: 0px}

  h2 { margin-bottom: 0px }

</style>

<center>
<h3><?php echo $data_event['judul'] ?></h3>
</center>

    <table border="1">
            <thead>
                <tr>
                    <td rowspan="2" bgcolor='#1f65b5' class="fontCustom" align="center"><b  style="color:white;">ESSAY</b></td>
                    <td colspan="2" bgcolor='#5b1f8c' class="fontCustom" align="center" ><b style="color:white;">JUMLAH RESPONDEN</b></td>
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
									<td align="center" class="fontCustom"><?php echo substr($data_essay['description'],0,2) ?></td>
									<td align="center" class="fontCustom"><?php echo $data_anggota ?></td>
									<td align="center" class="fontCustom"><?php echo $count_desc_essay ?></td>
								</tr>
							<?php } ?>
							
							
            </tbody>
        </table>
