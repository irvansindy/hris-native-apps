<?php
    include "../../../application/session/session_ess.php";

    $id_event   = $_POST['id_event'];
    $id_group   = $_POST['id_group'];
    $target     = $_POST['target'];
    $count_jawaban  =   $_POST['count_jawaban'];

    $query_pertanyaan    = mysqli_query($connect, "SELECT 
    b.* 
    FROM hrmsurveygrouppertanyaan a
    LEFT JOIN hrmsurveytgroup b ON a.id_group = b.groupId
    WHERE a.id_event = '$id_event' AND a.id_group = '$id_group'");
    $data_pertanyaan    = mysqli_fetch_assoc($query_pertanyaan);
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
                        <td colspan="6" bgcolor='#1f65b5' class="fontCustom" align="center" ><b align="center" style="color:white;"><?php echo substr($data_pertanyaan['groupName'],4) ?></b></td>
                        <td colspan="4" bgcolor='#5b1f8c' class="fontCustom" align="center" ><b align="center" style="color:white;">PERHITUNGAN</b></td>
                    </thead>
                    <tbody>
                        <tr>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">NO</b></td>
                            <td align="center" bgcolor='#1f65b5'><b style="color:white;">PERNYATAAN</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">1 (STS)</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">2 (TS)</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">3 (S)</b></td>
                            <td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">4 (SS)</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Skor Total</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Hasil</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Target</b></td>
                            <td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Gap</b></td>
                        </tr>
                            <?php
                            $query_detail_pertanyaan   = mysqli_query($connect, "SELECT 
                            b.groupName,
                            c.*
                            FROM hrmsurveygrouppertanyaan a
                            LEFT JOIN hrmsurveytgroup b ON a.id_group = b.groupId
                            LEFT JOIN hrmsurveytdescription c ON b.groupId = c.groupId
                            WHERE a.id_event = '$id_event' AND a.id_group = '$id_group' order by c.descriptionId ASC");

                            $no = 1;
                            while($detail_pertanyaan = mysqli_fetch_assoc($query_detail_pertanyaan)){
                                $query_nilai    = mysqli_query($connect, "SELECT 
								SUM(jawaban1) AS total1,
								SUM(jawaban2) AS total2,
								SUM(jawaban3) AS total3,
								SUM(jawaban4) AS total4
								FROM hrmsurveytanswer1 WHERE id_event = '$id_event' AND groupId = '$id_group' AND descriptionId = '$detail_pertanyaan[descriptionId]'");
                                $nilai  = mysqli_fetch_assoc($query_nilai);

                                // Skor total
								$skor_total	= (($nilai['total3'] * 3) + ($nilai['total4'] * 4))-(($nilai['total1'] * 1) + ($nilai['total2'] * 2));
								// Skor total
								// Hasil
                if($skor_total > 0){

                
								$hasil		= ($skor_total / ($count_jawaban * $target )) * $target;
              }else{
                $hasil    = 0;
              }
								// Hasil
								// Gap
								$gap		= $hasil - $target;
								// Gap
                            ?>
                        <tr>
                            <td align="center"><?php echo $no; ?></td>
                            <td><?php echo $detail_pertanyaan['description'] ?></td>
                            <td align="center"><?php echo $nilai['total1'] ?></td>
                            <td align="center"><?php echo $nilai['total2'] ?></td>
                            <td align="center"><?php echo $nilai['total3'] ?></td>
                            <td align="center"><?php echo $nilai['total4'] ?></td>
                            <td><?php echo $skor_total ?></td>
                            <td><?php echo round($hasil,2) ?></td>
                            <td><?php echo $target ?></td>
                            <td><?php echo round($gap,2) ?></td>
                        </tr>
                            <?php $no++; } 
                            $query_data_pertanyaan = mysqli_query($connect, "SELECT
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
                                WHERE a.id_event = '$id_event' AND a.groupId = '$id_group'
                                GROUP BY a.id_event,a.groupid,t2.totalemp,t3.target,a.descriptionId
                                ) Dall");
                            $data_average_pertanyaan = mysqli_fetch_assoc($query_data_pertanyaan);
                            ?>
                        <tr>
                            <td colspan="1" ></td>
                            <td align="center" bgcolor='#d1be13'><b style="color:;">AVERAGE</b></td>
                            <td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($data_average_pertanyaan['avgj1'],2) ?></p></td>
                            <td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($data_average_pertanyaan['avgj2'],2) ?></p></td>
                            <td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($data_average_pertanyaan['avgj3'],2) ?></p></td>
                            <td align="center" bgcolor='#d1be13'><p style="color:;"><?php echo round($data_average_pertanyaan['avgj4'],2) ?></p></td>
                            <td colspan="1" ></td>
                            <td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo round($data_average_pertanyaan['avghasil'],2) ?></p></td>
                            <td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo $target ?></p></td>
                            <td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo round($data_average_pertanyaan['avghasil'],2)-$target ?></p></td>
						</tr>
                    </tbody>
        
                </table>