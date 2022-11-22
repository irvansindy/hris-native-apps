<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 

	include "../../application/session/mobile.session.php";	

?>
<?php include "../template/sys.header.php";?>




<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- LOADER -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block; overflow:hidden">
            


            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="row">
                            <!-- Column -->
                            <?php include "summarized_data.php"; ?>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>


             <?php include "../template/sys.footer.php";?>

<script type='text/javascript' src='../../asset/gt_developer/jquery.redirect.js'></script>