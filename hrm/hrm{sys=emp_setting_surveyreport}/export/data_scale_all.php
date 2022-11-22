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

    <?php 
	$query_event	= mysqli_query($connect, "SELECT
						b.*,
						a.tipejawaban 
						FROM hrmsurveygrouppertanyaan a
						LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
						WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
					
	while($data_event = mysqli_fetch_assoc($query_event)){ 
	?>
    
    <div class="col-sm-7">
    <br>
        <table border="1">
                    <thead>
                        <td colspan="6" bgcolor='#1f65b5' class="fontCustom" align="center" ><b align="center" style="color:white;"><?php echo substr($data_event['groupName'],4) ?></b></td>
                        <td colspan="4" bgcolor='#5b1f8c' class="fontCustom" align="center" ><b align="center" style="color:white;">PERHITUNGAN</b></td>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">NO</b></td>
                            <td align="center" bgcolor='#1f65b5'><b style="color:white;">PERNYATAAN</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">1<br>(STS)</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">2<br>(TS)</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">3<br>(S)</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">4<br>(SS)</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Skor Total</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Hasil</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Target</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Gap</b></td>
                        </tr>

                        <?php
									$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_event[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
									$no = 1;
									while($data_hasil = mysqli_fetch_assoc($hasil)){

										$query_nilai    = mysqli_query($connect, "SELECT 
										SUM(jawaban1) AS total1,
										SUM(jawaban2) AS total2,
										SUM(jawaban3) AS total3,
										SUM(jawaban4) AS total4
										FROM hrmsurveytanswer1 WHERE id_event = '$id_event' AND groupId = '$data_hasil[groupId]' AND descriptionId = '$data_hasil[descriptionId]'");
										$nilai  = mysqli_fetch_assoc($query_nilai);

										// Skor total
										$skor_total	= (($nilai['total3'] * 3) + ($nilai['total4'] * 4))-(($nilai['total1'] * 1) + ($nilai['total2'] * 2));
										// Skor total
										// Hasil
										$hitung1	= $count_jawaban * $target;
										$hitung2	= $skor_total/$hitung1;
										$hitung3	= $hitung2 * $target;
										if(is_nan($hitung3)) $hitung3 = 0;
										// $hasil		= ( $skor_total / ($count_jawaban * $target )) * $target;
										// Hasil
										// Gap
										$gap		= $hitung3 - $target;
										// Gap
								?>
								<tr>
									<td align="center"><?php echo $no; ?></td>
									<td><?php echo $data_hasil['description'] ?></td>
									<td align="center"><?php echo $nilai['total1'] ?></td>
									<td align="center"><?php echo $nilai['total2'] ?></td>
									<td align="center"><?php echo $nilai['total3'] ?></td>
									<td align="center"><?php echo $nilai['total4'] ?></td>
									<td align="center"><?php echo $skor_total ?></td>
									<td align="center"><?php echo round($hitung3,2) ?></td>
									<td align="center"><?php echo $target ?></td>
									<td align="center"><?php echo round($gap,2) ?></td>
								</tr>
								<?php $no++; } 
								
								$query_hasil_pertanyaan = mysqli_query($connect, "SELECT
								Dall.id_event,
								(SUM(Dall.j1)/Dall.totalpertanyaan) AS avgj1,
								(SUM(Dall.j2)/Dall.totalpertanyaan) AS avgj2,
								(SUM(Dall.j3)/Dall.totalpertanyaan) AS avgj3,
								(SUM(Dall.j4)/Dall.totalpertanyaan) AS avgj4,
								SUM(Dall.idxtotal) AS totalhasil,
								(SUM(Dall.idxtotal)/Dall.totalpertanyaan) AS avghasil
								FROM(
										SELECT 
										a.id_event,
										a.groupId,
										a.descriptionId,
										(SELECT COUNT(c.descriptionId) FROM hrmsurveytdescription c WHERE c.groupId = a.groupId ) AS totalpertanyaan,
										SUM(a.jawaban1) AS j1,
										SUM(a.jawaban2) AS j2,
										SUM(a.jawaban3) AS j3,
										SUM(a.jawaban4) AS j4,
										((((SUM(a.jawaban3))*3) + ((SUM(a.jawaban4))*4))) - ((((SUM(a.jawaban1))*1) + ((SUM(a.jawaban2))*2))) AS total,
										((((((SUM(a.jawaban3))*3) + ((SUM(a.jawaban4))*4))) - ((((SUM(a.jawaban1))*1) + ((SUM(a.jawaban2))*2))))/(t2.totalemp*t3.target))*t3.target AS idxtotal,
										t2.totalemp,
										t3.target
										FROM hrmsurveytanswer1 a
										LEFT JOIN (SELECT b.id_event,COUNT(b.nip) AS totalemp FROM hrmsurveytjawaban b GROUP BY b.id_event) t2 ON t2.id_event = a.id_event
										LEFT JOIN hrmsurveyevent t3 ON t3.id_event = a.id_event
										WHERE a.id_event = '$id_event' AND a.groupId = '$data_event[groupId]'
										GROUP BY a.id_event,a.groupid,t2.totalemp,t3.target,a.descriptionId
										) Dall");
								$hasil_pertanyaan = mysqli_fetch_assoc($query_hasil_pertanyaan);
								?>
								<tr>
									<td colspan="1" ></td>
									<td align="center" bgcolor='#d1be13'><b style="color:;">AVERAGE</b></td>
									<td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($hasil_pertanyaan['avgj1'],2) ?></p></td>
									<td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($hasil_pertanyaan['avgj2'],2) ?></p></td>
									<td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($hasil_pertanyaan['avgj3'],2) ?></p></td>
									<td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($hasil_pertanyaan['avgj4'],2) ?></p></td>
									<td colspan="1" ></td>
									<td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo round($hasil_pertanyaan['avghasil'],2) ?></p></td>
									<td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo $target ?></p></td>
									<td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo round($hasil_pertanyaan['avghasil'],2)-$target ?></p></td>
						            </tr>
                                <tr>
                                    <td colspan="10"></td>
                                </tr>
            </tbody>
        </table>
    </div>
    
<?php } ?>


