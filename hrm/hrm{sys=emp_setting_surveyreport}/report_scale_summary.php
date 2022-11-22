<!-- Grafik -->
<script type="text/javascript" src="../../asset/vendor/grafik/accessibility.js"></script>
<script type="text/javascript" src="../../asset/vendor/grafik/highcharts.js"></script>
<link href="../../asset/vendor/grafik/style.css" rel="stylesheet">
<script src="../../asset/vendor/grafik/highcharts-more.js"></script>
<script src="../../asset/vendor/grafik/exporting.js"></script>
<script src="../../asset/vendor/grafik/export-data.js"></script>
<!-- Grafik -->
<?php
    $query_ambil_event   = mysqli_query($connect, "SELECT target FROM hrmsurveyevent WHERE id_event = '$id_event'");
    $ambil_event         = mysqli_fetch_assoc($query_ambil_event);
    $target              = $ambil_event['target'];

    // Ambil data jawaban
    $query_jawaban	= mysqli_query($connect, "SELECT * FROM hrmsurveytjawaban where id_event = '$id_event'");
	$count_jawaban	= mysqli_num_rows($query_jawaban);
    // Ambil data jawaban
?>
<form method="" action="" onSubmit="" class="form-horizontal" >

    <br>
                            <div class="form-row">
                                   <div class="col-sm-1">Responden</div>
                                   <div class="col-sm-2">
                                        <div class="input-group">
                                            <input class="input--style-6"
                                                onkeyup=""
                                                autocomplete="off" autofocus="on" id="modal_groupname"
                                                name="modal_groupname" type="Text" value="<?php echo $count_jawaban ?>"
                                                onfocus="hlentry(this)" size="30" maxlength="50" 
                                                validate="NotNull:Invalid Form Entry"
                                                onchange="formodified(this);" title="" disabled>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-row">
                                   <div class="col-sm-1">Target (index)</div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                                <input class="input--style-6"
                                                onkeyup=""
                                                autocomplete="off" autofocus="on" id="modal_groupname"
                                                name="modal_groupname" type="Text" value="<?php echo $target ?>"
                                                onfocus="hlentry(this)" size="30" maxlength="50" 
                                                validate="NotNull:Invalid Form Entry"
                                                onchange="formodified(this);" title="" disabled>
                                          </div>
                                   </div>
                            </div>
                            <div class="form-row">
                                   <div class="col-sm-1">Total (R x l)</div>
                                   <div class="col-sm-2">
                                          <div class="input-group">
                                            <input class="input--style-6"
                                                onkeyup=""
                                                autocomplete="off" autofocus="on" id="modal_groupname"
                                                name="modal_groupname" type="Text" value="<?php echo $count_jawaban*$target ?>"
                                                onfocus="hlentry(this)" size="30" maxlength="50" 
                                                validate="NotNull:Invalid Form Entry"
                                                onchange="formodified(this);" title="" disabled>
                                          </div>
                                   </div>
                            </div>
                            <br>
                            
</form>
<div class="row">
<div class="col-sm-6"></div>
<div class="col-sm-2">
<form action="export/scale_summary_export.php" method="POST" target="_blank">
                                          
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

    <div class="col-sm-7">
        <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover">
            <thead>
                <!-- <tr> -->
                    <td colspan="5" bgcolor='#1f65b5' class="fontCustom"  ><p align="center" style="color:white;">HASIL SURVEY</p></td>
                    <td colspan="5" bgcolor='#1f65b5' class="fontCustom"  ><p align="center" style="color:white;">PERHITUNGAN</p></td>
                <!-- </tr> -->

            </thead>
            <tbody>
							<tr>
								<td align="center" bgcolor='#1f65b5'><p style="color:white;">INDIKATOR</p></td>
								<td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">1 (STS)</b></td>
								<td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">2 (TS)</b></td>
								<td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">3 (S)</b></td>
								<td align="center" bgcolor='#1f65b5' width='3%'><b style="color:white;">4 (SS)</b></td>
								<td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Skor Total</b></td>
								<td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Hasil</b></td>
								<td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Target</b></td>
								<td align="center" bgcolor='#5b1f8c' width='8%'><b style="color:white;">Gap</b></td>
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
								<td><a href="#" onclick='return startload()' class='open_modal_preview' id1="<?php echo $id_event ?>" id2="<?php echo $data_pertanyaan['groupId'] ?>" id3="<?php echo $target ?>" id4="<?php echo $count_jawaban ?>"><?php echo substr($data_pertanyaan['groupName'],4) ?></a></td>
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
									((((((((SUM(a.jawaban3))*3) + ((SUM(a.jawaban4))*4))) - ((((SUM(a.jawaban1))*1) + ((SUM(a.jawaban2))*2))))/(dtjawab.duserjawab*t3.target))*t3.target)/dsoal.totalsoal) as idxtotal,
									t2.totalemp,
									t3.target
									FROM hrmsurveytanswer1 a
									LEFT JOIN (SELECT b.id_event,COUNT(b.nip) AS totalemp FROM hrmsurveytjawaban b GROUP BY b.id_event) t2 ON t2.id_event = a.id_event
									LEFT JOIN hrmsurveyevent t3 ON t3.id_event = a.id_event
									LEFT JOIN (SELECT a.groupId,COUNT(a.groupid) AS totalsoal FROM hrmsurveytdescription a GROUP BY a.groupId) dsoal ON dsoal.groupId = a.groupId
									LEFT JOIN (SELECT a.id_event,COUNT(a.nip) AS duserjawab FROM hrmsurveytjawaban a GROUP BY a.id_event) dtjawab ON dtjawab.id_event = a.id_event
									WHERE a.id_event = '$id_event'
									GROUP BY a.id_event,a.groupid,t2.totalemp,t3.target
								) Dall");
							$data_average	= mysqli_fetch_assoc($query_average);
							?>
							<tr>
								<td colspan="5" ></td>
								<td align="center" bgcolor='#5b1f8c'><b style="color:white;">AVERAGE</b></td>
								<td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo round($data_average['idxtotal'],2) ?></p></td>
								<td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo $target; ?></p></td>
								<td align="center" bgcolor='#5b1f8c'><p style="color:white;"><?php echo round($data_average['idxtotal'],2)-$target ?></p></td>
							</tr>            </tbody>
        </table>
    </div>
    <div class="col-sm-4">
		<figure class="highcharts-figure">
			<div id="container"></div>
		</figure>
	</div>

</div>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_preview").click(function(e) {
              var m = $(this).attr("id1");
			  var n = $(this).attr("id2");
			  var o = $(this).attr("id3");
			  var p = $(this).attr("id4");
              $.ajax({
                     url: "modal_scale_preview.php",
                     type: "POST",
                     data: {
                            id1: m,
							id2: n,
							id3: o,
							id4: p,
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

<script>
Highcharts.chart('container', {

chart: {
  polar: true,
  type: 'line'
},

accessibility: {
  description: ''
},

title: {
  text: 'PETA KEPUASAN KARYAWAN',
  x: 0
},

pane: {
  size: '90%'
},
<?php
// $id_event = '';
// $id_event = $_POST['event'];
$query_ambil_pertanyaan	= mysqli_query($connect, "SELECT
b.*,
a.tipejawaban 
FROM hrmsurveygrouppertanyaan a
LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
?>
xAxis: {
  categories: [<?php while($data_pertanyaan_garfik = mysqli_fetch_assoc($query_ambil_pertanyaan)){?>'<?php echo substr($data_pertanyaan_garfik['groupName'],4,2) ?>',<?php } ?>],
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
// $id_event = '';
// $id_event = $_POST['event'];
$query_ambil_pertanyaan	= mysqli_query($connect, "SELECT
b.*,
a.tipejawaban 
FROM hrmsurveygrouppertanyaan a
LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
?>
series: [{
  name: 'Hasil',
  data: [
	  	<?php 
		  while($data_pertanyaan_garfik = mysqli_fetch_assoc($query_ambil_pertanyaan)){
								
			$sum_query	= mysqli_query($connect, "SELECT 
			SUM(jawaban1) AS total1,
			SUM(jawaban2) AS total2,
			SUM(jawaban3) AS total3,
			SUM(jawaban4) AS total4
			FROM hrmsurveytanswer1 WHERE id_event = '$id_event' AND groupId = '$data_pertanyaan_garfik[groupId]'");
			$data_sum	= mysqli_fetch_assoc($sum_query);

			// Skor total
			$skor_total	= (($data_sum['total3'] * 3) + ($data_sum['total4'] * 4))-(($data_sum['total1'] * 1) + ($data_sum['total2'] * 2));
			// Skor total
			// Hasil
			$hasil1		= ($skor_total / ($count_jawaban * $target )) * $target;

			// Mengambil jumlah pertanyaan dalam group pertanyaan
			$sql_jumlah_pertanyaan	= mysqli_query($connect, "SELECT a.descriptionId FROM hrmsurveytdescription a WHERE a.groupId = '$data_pertanyaan_garfik[groupId]'");
			$count_jumlah_pertanyaan	= mysqli_num_rows($sql_jumlah_pertanyaan);
			// Mengambil jumlah pertanyaan dalam group pertanyaan

			$hasil		= $hasil1 / $count_jumlah_pertanyaan;
			// Hasil
		?>
	  	<?php echo $hasil ?>,<?php } ?>],
  pointPlacement: 'on'
}, {
  name: 'Target',
  data: [
		<?php 
			// $id_event = '';
			// $id_event = $_POST['event'];
			$query_ambil_pertanyaan	= mysqli_query($connect, "SELECT
			b.*,
			a.tipejawaban 
			FROM hrmsurveygrouppertanyaan a
			LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
			WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
		  while($data_pertanyaan_garfik = mysqli_fetch_assoc($query_ambil_pertanyaan)){ ?>
		<?php echo $target ?>,<?php } ?>],
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