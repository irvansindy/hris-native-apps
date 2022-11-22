<?php 
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
?>
<?php include "../template/sys.header.php";?>

<!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->

<!-- <php include "../template/sys.sidebar.php";?> -->

<?php 
$page   = '17'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'
$footer = 'yes'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>


        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;overflow: hidden;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Whistle Blower</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    </ol>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <div class="row">
                           
                            <!-- Column -->
                            <?php include "data.php"; ?>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
      
<?php include "../template/sys.footer.php";?>

<?php include "js/search_pos.php";?>
<?php include "js/search_cos.php";?>
<?php include "js/search_nat.php";?>
<?php include "js/search_cit.php";?>

<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>