
        <!--
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css"/>
        -->

		<link rel="stylesheet" href="assets/materialDateTimePicker.css" />
		<!-- <link href='//fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
		<link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

		<script type="text/javascript"  src="assets/jquery-1.12.3.min.js"></script>


		<script type="text/javascript" src="assets/moment.js"></script>
		<script type="text/javascript" src="assets/materialDateTimePicker.js"></script>

		
		<div class="container well">
			<div class="row">
				<div class="col-md-6">
					<h2>Date Picker</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-control-wrapper">
						<input type="text" id="date" class="form-control floating-label" placeholder="Date">
					</div>
				</div>
				
			</div>
		</div>
		<script type="text/javascript">
            $(document).ready(function() {
                $('#date').bootstrapMaterialDatePicker({
                    time: false,
                    clearButton: true
                });	
            });
		</script>
	</body>
</html>
