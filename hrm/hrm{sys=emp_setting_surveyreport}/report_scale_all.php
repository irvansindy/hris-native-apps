<!-- Grafik -->
<script type="text/javascript" src="../../asset/vendor/grafik/accessibility.js"></script>
<script type="text/javascript" src="../../asset/vendor/grafik/highcharts.js"></script>
<link href="../../asset/vendor/grafik/style.css" rel="stylesheet">
<script src="../../asset/vendor/grafik/highcharts-more.js"></script>
<script src="../../asset/vendor/grafik/exporting.js"></script>
<script src="../../asset/vendor/grafik/export-data.js"></script>
<!-- Grafik -->
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
<form action="export/scale_all_export.php" method="POST" target="_blank">
                                          
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
    <?php 
	$query_event	= mysqli_query($connect, "SELECT
						b.*,
						a.tipejawaban 
						FROM hrmsurveygrouppertanyaan a
						LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
						WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
					    $i	= 1;
					
	while($data_event = mysqli_fetch_assoc($query_event)){ 
	?>
    
    <div class="col-sm-7">
    <br>
        <table id="example3LOAD" width="99%" border="1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <td colspan="6" bgcolor='#1f65b5' class="fontCustom" align="center" ><b align="center" style="color:white;"><?php echo substr($data_event['groupName'],4) ?></b></td>
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
            </tbody>
        </table>
    </div>
    <?php 
	$spider = 'spider'.$i;
	?>
	<div class="col-sm-4">
		<figure class="highcharts-figure">
			<div id="<?php echo $spider; ?>"></div>
		</figure>
	</div>
	<?php $i++; } ?>

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

<!-- Spider Scale Summary-->
<?php
	// $id_event = '';
	// $id_event = $_POST['event']; 
	$query_event	= mysqli_query($connect, "SELECT
						b.*,
						a.tipejawaban 
						FROM hrmsurveygrouppertanyaan a
						LEFT JOIN hrmsurveytgroup b ON b.groupId = a.id_group
						WHERE a.id_event = '$id_event' ORDER BY a.order ASC");
	$no	= 1;
	
						while($data_event = mysqli_fetch_assoc($query_event)){ 
							$spider = 'spider'.$no;
					?>
<script>
Highcharts.chart('<?php echo $spider; ?>', {
	
chart: {
  polar: true,
  type: 'line'
},

accessibility: {
  description: ''
},

title: {
  text: 'Peta <?php echo substr($data_event['groupName'],8) ?> (Indikator <?php echo substr($data_event['groupName'],4,2) ?>)',
  x: 0
},

pane: {
  size: '100%'
},
<?php 

$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_event[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
?>
xAxis: {
  categories: [
	<?php 
	$c = 1;
	while($data_categori = mysqli_fetch_assoc($hasil)){	
	?>
	'<?php echo $c; ?>',
	<?php $c++; } ?>
  ],
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

series: [{
  name: 'Hasil',
  data: [
	<?php
	$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_event[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
	
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
			// Hasil
	?>
	<?php echo $hitung3 ?>,
	<?php } ?>
  ],
  pointPlacement: 'on'
}, {
  name: 'Target',
  data: [
	  <?php
	  	$hasil = mysqli_query($connect, "SELECT * FROM hrmsurveytdescription, hrmsurveytgroup WHERE hrmsurveytdescription.groupId = '$data_event[groupId]' AND hrmsurveytdescription.groupId = hrmsurveytgroup.groupId ORDER BY hrmsurveytgroup.groupId");
		while($data_grafik = mysqli_fetch_assoc($hasil)){
	  ?>
	  <?php echo $target ?>,
	  <?php } ?>
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
<?php $no++; } ?>
<!-- Spider Scale Summary-->
