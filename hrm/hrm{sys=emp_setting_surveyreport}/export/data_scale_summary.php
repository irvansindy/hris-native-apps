<?php 

include "../../../application/session/session_ess.php";

$id_event   =   $_POST['id_event'];
$target     =   $_POST['target'];

// Ambil data jawaban
$query_jawaban	= mysqli_query($connect, "SELECT * FROM hrmsurveytjawaban where id_event = '$id_event'");
$count_jawaban	= mysqli_num_rows($query_jawaban);
$query_event	= mysqli_query($connect, "SELECT * FROM hrmsurveyevent WHERE id_event = '$id_event'");
$data_event		= mysqli_fetch_assoc($query_event);
// Ambil data jawaban
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
                    <td colspan="5" align="center" bgcolor='#1f65b5'><b style="color:white;">HASIL SURVEY</b></td>
                    <td colspan="4" align="center" bgcolor='#1f65b5'><b style="color:white;">PERHITUNGAN</b></td>
                </tr>

            </thead>
            <tbody>
							<tr>
								<td align="center" bgcolor='#1f65b5' ><b style="color:white;">INDIKATOR</b></td>
								<td align="center"  width='3%' bgcolor='#1f65b5'><b style="color:white;">1<br>(STS)</b></td>
								<td align="center"  width='3%' bgcolor='#1f65b5'><b style="color:white;">2<br>(TS)</b></td>
								<td align="center"  width='3%' bgcolor='#1f65b5'><b style="color:white;">3<br>(S)</b></td>
								<td align="center"  width='3%' bgcolor='#1f65b5'><b style="color:white;">4<br>(SS)</b></td>
								<td align="center"  width='8%' bgcolor='#5b1f8c'><b style="color:white;">Skor Total</b></td>
								<td align="center"  width='8%' bgcolor='#5b1f8c'><b style="color:white;">Hasil</b></td>
								<td align="center"  width='8%' bgcolor='#5b1f8c'><b style="color:white;">Target</b></td>
								<td align="center"  width='8%' bgcolor='#5b1f8c'><b style="color:white;">Gap</b></td>
							</tr>

                            <!-- Query untuk ambil data pertanyaan -->
							<?php 
								$query_ambil_pertanyaan	= mysqli_query($connect, "SELECT
								b.*,
								a.tipejawaban 
								FROM hrmsurveygrouppertanyaan a
								LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
								WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
								while($data_pertanyaan = mysqli_fetch_assoc($query_ambil_pertanyaan)){
								
								$sum_query	= mysqli_query($connect, "SELECT 
								SUM(jawaban1) AS total1,
								SUM(jawaban2) AS total2,
								SUM(jawaban3) AS total3,
								SUM(jawaban4) AS total4
								FROM hrmsurveytanswer1 WHERE id_event = '$id_event' AND groupId = '$data_pertanyaan[groupId]'");
								$data_sum	= mysqli_fetch_assoc($sum_query);

								// Skor total
								
								$skor_total	= (($data_sum['total3'] * 3) + ($data_sum['total4'] * 4))-(($data_sum['total1'] * 1) + ($data_sum['total2'] * 2));
								// Skor total
								// Hasil
								if($skor_total > 0){

								

									$hasil1		= ($skor_total / ($count_jawaban * $target )) * $target;

									// Mengambil jumlah pertanyaan dalam group pertanyaan
									$sql_jumlah_pertanyaan	= mysqli_query($connect, "SELECT a.descriptionId FROM hrmsurveytdescription a WHERE a.groupId = '$data_pertanyaan[groupId]'");
									$count_jumlah_pertanyaan	= mysqli_num_rows($sql_jumlah_pertanyaan);
									// Mengambil jumlah pertanyaan dalam group pertanyaan
	
									$hasil		= $hasil1 / $count_jumlah_pertanyaan;
								if(is_nan($hasil)) $hasil = 0;
								}else{
									$hasil = 0;
								}
								
								// Gap
								$gap		= $hasil - $target;
								// Gap
							?>
							<tr>
								<td><?php echo substr($data_pertanyaan['groupName'],4) ?></td>
								<td align="center"><?php echo $data_sum['total1']; ?></td>
								<td align="center"><?php echo $data_sum['total2']; ?></td>
								<td align="center"><?php echo $data_sum['total3']; ?></td>
								<td align="center"><?php echo $data_sum['total4']; ?></td>
								<td align="center"><?php echo $skor_total; ?></td>
								<td align="center"><?php echo round($hasil,2); ?></td>
								<td align="center"><?php echo $target; ?></td>
								<td align="center"><?php echo round($gap,2); ?></td>
							</tr>
							<?php } 
							
							$query_average	= mysqli_query($connect, "SELECT Dall.id_event, 
							(SUM(Dall.total)/COUNT(Dall.groupid)) AS total, 
							(SUM(Dall.idxtotal)/COUNT(Dall.groupid)) AS idxtotal 
							FROM
								(
									SELECT 
									a.id_event,
									a.groupId,
									((((SUM(a.jawaban3))*3) + ((SUM(a.jawaban4))*4))) - ((((SUM(a.jawaban1))*1) + ((SUM(a.jawaban2))*2))) AS total,
									((((((SUM(a.jawaban3))*3) + ((SUM(a.jawaban4))*4))) - ((((SUM(a.jawaban1))*1) + ((SUM(a.jawaban2))*2))))/(t2.totalemp*t3.target))*t3.target AS idxtotal,
									t2.totalemp,
									t3.target
									FROM hrmsurveytanswer1 a
									LEFT JOIN (SELECT b.id_event,COUNT(b.nip) AS totalemp FROM hrmsurveytjawaban b GROUP BY b.id_event) t2 ON t2.id_event = a.id_event
									LEFT JOIN hrmsurveyevent t3 ON t3.id_event = a.id_event
									WHERE a.id_event = '$id_event'
									GROUP BY a.id_event,a.groupid,t2.totalemp,t3.target
								) Dall");
							$data_average	= mysqli_fetch_assoc($query_average);
							?>
							<tr>
								<td colspan="5" ></td>
								<td align="center"><b>AVERAGE</b></td>
								<td align="center"><p><?php echo round($data_average['idxtotal'],2) ?></p></td>
								<td align="center"><p><?php echo $target; ?></p></td>
								<td align="center"><p><?php echo round($data_average['idxtotal'],2)-$target ?></p></td>
							</tr>
            </tbody>
        </table>
