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


