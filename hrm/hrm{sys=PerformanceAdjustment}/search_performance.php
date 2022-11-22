<?php 
$key      = $_POST["query"];
?>

<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="others/css/jquery.dynameter.css">
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="others/js/jquery.dynameter.js"></script>




<?php
include '../../application/config.php';
date_default_timezone_set('Asia/Bangkok');

$datetime        = date('Y-m-d h:i:s');
$date           = date('Y-m-d');
$year           = date('Y');
$dateprint         = date('d M Y');
$time           = date('h:i:s');
$request          = date('Ydhis');

if (isset($_POST["query"])) {
  $output = '';

  $key      = $_POST["query"];

  $query = mysqli_query($connect, "SELECT * FROM hrmperf_range a WHERE $key BETWEEN a.score_start AND a.score_end");



  if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {

	$do .= $row['id_range'];
      $output .= '<div><div style="position: absolute;margin-top: -71px;" id="fuelMeterDiv"></div></div>';
    }
  } else {
    $output .= '<div style="white-space: nowrap;margin-top: 6px;">Invalid Performance Value</div>';
  }
  echo $output;
}
?>

<script type="text/javascript">
	var $myFuelMeter;
	$(function () {
		// Initialize score meter and slider.
		$myFuelMeter = $("div#fuelMeterDiv").dynameter({
			width: 400,
			label: '<?php echo $do; ?>',
			value: <?php echo $key; ?>,
			min: 0.0,
			max: 4.0,
			unit: 'Performance',
			regions: {
				0: 'error',
				.60: 'warn',
				1.5: 'normal'
			}
		});
		$('div#fuelSliderDiv').slider({
			min: 0.0,
			max: 4.1,
			value: <?php echo $key; ?>,
			step: .01,
			slide: function (evt, ui) {
				$myFuelMeter.changeValue((ui.value).toFixed(1));
			}
		});
	});
</script>