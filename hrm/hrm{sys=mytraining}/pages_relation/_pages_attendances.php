	
	<div id="my_camerass" class="kolp" style="width: 100%; height: 240px;"></div>
	

	<script type="text/javascript" src="plugin_attendance/webcam.js"></script>
	

	<script language="JavaScript">
		Webcam.set({
			// width: 500,
			// height: 500,
			image_format: 'jpeg',
			jpeg_quality: 90
		});
		Webcam.attach( '#my_camerass' );
	</script>
	
	
	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		function take_snapshot() {
				Webcam.snap( function(data_uri) {
	
				document.getElementById('results').innerHTML = 
					'<h2>Here is your image:</h2>' + 
					'<img src="'+data_uri+'"/>';
			} );
		}
	</script>
	