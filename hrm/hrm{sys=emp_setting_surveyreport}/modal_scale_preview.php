<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<?php $pageauthorized = "9";?>
<?php
    include "../../application/session/session.php";


    $id_event   = $_POST['id1'];
    $id_group   = $_POST['id2'];
    $target     = $_POST['id3'];
    $count_jawaban  =   $_POST['id4'];

    $query_pertanyaan    = mysqli_query($connect, "SELECT 
    b.* 
    FROM hrmsurveygrouppertanyaan a
    LEFT JOIN hrmsurveytgroup b ON a.id_group = b.groupId
    WHERE a.id_event = '$id_event' AND a.id_group = '$id_group'");
    $data_pertanyaan    = mysqli_fetch_assoc($query_pertanyaan);
?>





<div class="modal-dialog modal-bg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">DETAIL SCALE</h4>
            <button type="button" onclick='return stopload()' class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -15px;"><span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
            <div class="panel-body">
                <table>
                    <tbody>
                            <tr>
                                <td width="150px" ><b>Responden</b></td>
                                <td width="20px"><b>:</b></td>
                                <td><?php echo $count_jawaban ?></td>
                            </tr>
                            <tr height="50px">
                                <td><b>Target (Index)</b></td>
                                <td><b>:</b></td>
                                <td><?php echo $target ?></td>
                            </tr>
                            <tr>
                                <td><b>Total (R x l)</b></td>
                                <td><b>:</b></td>
                                <td><?php echo $target*$count_jawaban ?></td>
                            </tr>
                    </tbody>
                </table>
			</div>

<div class="row">
<div class="col-sm-10"></div>
<div class="col-sm-2">
<form action="export/scale_preview_export.php" method="POST" target="_blank">
                                          
                                          <input type="hidden" name="id_event" value="<?php echo $id_event; ?>">
                                          <input type="hidden" name="id_group" value="<?php echo $id_group; ?>">
                                          <input type="hidden" name="target" value="<?php echo $target; ?>">
                                          <input type="hidden" name="count_jawaban" value="<?php echo $count_jawaban; ?>">

                                                
                                                        <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="print_excel" value="submit" >
                                                        </button>
														&nbsp
														<button type="submit" class="toolbar sprite-toolbar-print" id="EXCEL" style="border: 0;background-color: white;" name="print_cetak" value="submit" >
                                                        </button>


                                                  
                                          </form>
</div>
</div>
            <br>
            <div class="card-body table-responsive p-0" style="width: 100vw; width: 98.8%; margin: 5px;">
                <!-- <form method="post" action="controller/aksi_tambah.php" onSubmit="return validasi(this)" class="form-horizontal" > -->
                <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover">
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
                <!-- </form> -->
                <br>
                <figure class="highcharts-figure">
					<div id="container1"></div>
				</figure>
            </div>
    </div>
    <div class="modal-footer">
            <div class="form-group">
                <button onclick='return stopload()' type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
                                                               
</div>

<!-- Spider Scale Summary-->
<script>
Highcharts.chart('container1', {

chart: {
  polar: true,
  type: 'line'
},

accessibility: {
  description: ''
},

title: {
  text: 'Peta <?php echo substr($data_pertanyaan['groupName'],8) ?> (Indikator <?php echo substr($data_pertanyaan['groupName'],4,2) ?>)',
  x: 0
},

pane: {
  size: '90%'
},
<?php 
// $id_event   = $_POST['id1'];
// $id_group   = $_POST['id2'];
$query_detail_pertanyaan   = mysqli_query($connect, "SELECT 
b.groupName,
c.*
FROM hrmsurveygrouppertanyaan a
LEFT JOIN hrmsurveytgroup b ON a.id_group = b.groupId
LEFT JOIN hrmsurveytdescription c ON b.groupId = c.groupId
WHERE a.id_event = '$id_event' AND a.id_group = '$id_group' order by c.descriptionId ASC");

?>
xAxis: {
  categories: [<?php $n1= 1; while($detail_pertanyaan_garfik = mysqli_fetch_assoc($query_detail_pertanyaan)){?>'<?php echo $n1; ?>',<?php $n1++; } ?>],
  tickmarkPlacement: 'on',
  lineWidth: 0
},

yAxis: {
  gridLineInterpolation: 'polygon',
  lineWidth: 0,
  min: 0
},

tooltip: {
  shared: true,
  pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f}</b><br/>'
},

legend: {
  align: 'right',
  verticalAlign: 'middle',
  layout: 'vertical'
},
<?php 
// $id_event   = $_POST['id1'];
// $id_group   = $_POST['id2'];
$query_detail_pertanyaan   = mysqli_query($connect, "SELECT 
b.groupName,
c.*
FROM hrmsurveygrouppertanyaan a
LEFT JOIN hrmsurveytgroup b ON a.id_group = b.groupId
LEFT JOIN hrmsurveytdescription c ON b.groupId = c.groupId
WHERE a.id_event = '$id_event' AND a.id_group = '$id_group' order by c.descriptionId ASC");
?>
series: [{
  name: 'Hasil',
  data: [
    <?php 
		  while($data_pertanyaan_garfik = mysqli_fetch_assoc($query_detail_pertanyaan)){
								
			$sum_query	= mysqli_query($connect, "SELECT 
								SUM(jawaban1) AS total1,
								SUM(jawaban2) AS total2,
								SUM(jawaban3) AS total3,
								SUM(jawaban4) AS total4
								FROM hrmsurveytanswer1 WHERE id_event = '$id_event' AND groupId = '$id_group' AND descriptionId = '$data_pertanyaan_garfik[descriptionId]'");
			$data_sum	= mysqli_fetch_assoc($sum_query);

			// Skor total
			$skor_total	= (($data_sum['total3'] * 3) + ($data_sum['total4'] * 4))-(($data_sum['total1'] * 1) + ($data_sum['total2'] * 2));
			// Skor total
			// Hasil
      if($skor_total > 0){

     
			$hasil		= ($skor_total / ($count_jawaban * $target )) * $target;
    }else{
      $hasil    = 0;
    }
			// Hasil
		?>
	  	<?php echo $hasil ?>,<?php } ?>
  ],
  pointPlacement: 'on'
}, {
  name: 'Target',
  data: [
    <?php 
			// $id_event   = $_POST['id1'];
            // $id_group   = $_POST['id2'];
            $query_detail_pertanyaan   = mysqli_query($connect, "SELECT 
            b.groupName,
            c.*
            FROM hrmsurveygrouppertanyaan a
            LEFT JOIN hrmsurveytgroup b ON a.id_group = b.groupId
            LEFT JOIN hrmsurveytdescription c ON b.groupId = c.groupId
            WHERE a.id_event = '$id_event' AND a.id_group = '$id_group' order by c.descriptionId ASC");
		  while($data_pertanyaan_garfik = mysqli_fetch_assoc($query_detail_pertanyaan)){ ?>
		<?php echo $target ?>,<?php } ?>
  ],
  pointPlacement: 'on'
}],

responsive: {
  rules: [{
    condition: {
      maxWidth: 500
    },
    chartOptions: {
      legend: {
        align: 'center',
        verticalAlign: 'bottom',
        layout: 'horizontal'
      },
      pane: {
        size: '70%'
      }
    }
  }]
}

});
</script>
<!-- Spider Scale Summary-->


