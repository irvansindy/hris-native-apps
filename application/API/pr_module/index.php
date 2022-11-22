<link rel="stylesheet" href="adminlte.min.css">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

<br>

   
<style>
input {
  background-image: url("back.png"), url("back.png");
  background-size :200px;
  background-repeat: no-repeat;
  height: 200px;
  width: 100%;
  background-position: center; 
  font-size: 1px;
  border: #cccccc ;
  color: #FFF;
}

</style>







<section class="content">
      <div class="row">

      <div class="col-12">
      <div class="card card-warning">
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post"> 
                <div class="card-body">
                  <div class="form-group">
                  
                    <input type="password" name="data" maxlength="10" autofocus class="input" id="data" autocomplete="off">
                    </div>
              </form>
            </div></div>

<script type="text/javascript">
var alwaysFocusedInput = document.getElementById( "data" );

alwaysFocusedInput.addEventListener( "blur", function() {
  setTimeout(() =>{
    alwaysFocusedInput.focus();
  }, 0);
});
</script>  







    
<?php
if (isset($_POST['data'])) {

include "../config.php";
date_default_timezone_set('Asia/Bangkok'); 

	$datetime		    = date('Y-m-d h:i:s');
	$date   		    = date('Y-m-d');
	$dateprint 		    = date('d M Y');
	$time   		    = date('h:i:s');
	$request	        = date('Ydhis');
	
	$data	            = $_POST['data'];

	if (empty($data)) {
		echo "<script type='text/javascript'>

					window.setTimeout(function(){ 
						window.location.replace('index.php');
					} ,10)    
					</script>";
	}

	$sql = mysqli_fetch_array(mysqli_query($con, " 
						SELECT 
						tnbk,
						image
						FROM 
						card_number 
						WHERE card_number = '$data'
						"));
	$SFtnbk			    = $sql['tnbk'];			
	$SFimage			= $sql['image'];	
?>


	





        
<section class="content">
      <div class="row">

      <div class="col-12">
      <div class="card card-warning">
              <!-- /.card-header -->
              <!-- form start -->
              <form action="index.php"> 
                <div class="card-body">
                  <div class="form-group" style="font-size: 30px;line-height: 74px;letter-spacing: 0.063em;font-weight: 300;">
                    <label for="exampleInputEmail1"></label>
					<?php 
					if (empty($SFtnbk)) {
          $print  = 'Data not Found or not registered';
          $image = '';
					} else {
            $print = $SFtnbk;
            
            $image = '<img class="img-circle elevation-2" alt="User Image" width="90%" src="https://creatifku.com/api/pr_module/photos/'.$SFimage.'">';

						$query = "
						INSERT INTO log (
							card_number) VALUES
								(
								'$data')";
					
					
						$result = mysqli_query($con, $query);
					}
					?>
                    <td><?php echo $print; ?></td>
                    <div class="image">
                    <?php echo $image; ?>
                  </div>
                  </div>
                 
                </div>
              </form>
            </div>

       


		<!-- /.card -->
		</div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>

<?php mysqli_close($con); } ?>



<!-- /.card -->
</div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    </section>
