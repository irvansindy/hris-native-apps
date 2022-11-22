
<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>


<!-- alert -->
<link rel="stylesheet" href="../asset/gt_dev/sweetalert.css">
<script src="../asset/gt_dev/sweetalert.min.js"></script>
<script src="../asset/gt_dev/qunit-1.18.0.js"></script>

<?php

	$modal_id=$_GET['modal_id'];
	$process=mysqli_query($connect, "UPDATE employer_education set status = 'inactive' WHERE id_education='$modal_id'");
	

if($process)
	{
                  echo "
                        <script type='text/javascript'>
				setTimeout(function () {  
				swal({
					title: 'education Successfully delete',
					type: 'info',
					showCancelButton: false,
					closeOnConfirm: false,
					showLoaderOnConfirm: true
				}, 
				function () {
				setTimeout(function () {
				swal('Confirm finished!');
					}, 200);

				}); 
				},100);  
				window.setTimeout(function(){ 
					window.location.replace('../profile-education');
				} ,3000);	    
				</script>";
	} else{
            echo "
                  <script type='text/javascript'>
                  setTimeout(function () {  
                  swal({
                        title: 'Data Failed to saved',
                        type: 'info',
                        showCancelButton: false,
                        closeOnConfirm: false,
                        showLoaderOnConfirm: true
                  }, 
                  function () {
                  setTimeout(function () {
                  swal('Confirm finished!');
                        }, 200);

                  }); 
                  },100);  
                  window.setTimeout(function(){ 
				window.location.replace('../profile-education');
			} ,3000);	
                  </script>";
      }

?>