<?php
if (isset($_POST['submit_edit'])) {

$modal_id_education     = $_POST['id_education'];
$modal_institute        = $_POST['institute'];
$modal_start_month      = $_POST['employer_start_month'];
$modal_start_year       = $_POST['employer_start_year'];
$modal_end_month        = $_POST['employer_start_month'];
$modal_end_year         = $_POST['employer_end_year'];
$modal_typeofschool     = $_POST['typeofschool'];
$modal_areaofstudy      = $_POST['areaofstudy'];


$process = mysqli_query($connect, "UPDATE 
						employer_education SET 
							`institute`='$modal_institute', 
							`startmonth`='$modal_start_month', 
							`startyear`='$modal_start_year', 
							`endmonth`='$modal_end_month', 
							`endyear`='$modal_end_year', 
							`typeofschool`='$modal_typeofschool', 
							`areaofstudy`='$modal_areaofstudy'
							WHERE  
							`id_education` = '$modal_id_education'
                              ");

if($process)
	{
                  echo "
                        <script type='text/javascript'>
				setTimeout(function () {  
				swal({
					title: 'education Successfully added',
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
					window.location.replace('profile-education');
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
                  
                  </script>";
      }
}
?>
<?php
//DEBUG
// echo $modal_id . '<br>';
// echo $modal_name . '<br>';
// echo $modal_address . '<br>';
// echo $modal_start . '<br>';
// echo $modal_end . '<br>';
// echo $modal_position . '<br>';
// echo $modal_major . '<br>';
// echo $modal_salary . '<br>';
// echo $modal_benefits . '<br>';
// echo $modal_reason . '<br>';
// ?>