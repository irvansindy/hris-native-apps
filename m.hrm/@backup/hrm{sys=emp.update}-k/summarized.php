<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0'; 
if($getdata == 0) {
	include "../../application/session/session.php";
} else {
	include "../../application/session/mobile.session.php";	
}
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
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Employee Information <?php 
$page = '19'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '19'}
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
!empty($_POST['rfid']) ? $getdata = $_POST['rfid'] : $getdata = '0';


?></h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                        <li ><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Konfirmasi Pemutakhiran Data</li>
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
                            <?php include "summarized_data.php"; ?>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>


             <?php include "../template/sys.footer.php";?>

            <?php include "js/search_nat.php";?>
            <?php include "js/search_bank.php";?>
            <?php include "js/search_edutype.php";?>
            <?php include "js/search_city_state_country.php";?>

             <link href="../../asset/gt_developer/select2-ajax/css/select2.css" rel="stylesheet" />
            <script src="../../asset/gt_developer/jquery.min.js"></script>
            <script src="../../asset/gt_developer/select2-ajax/js/select2.min.js"></script>


<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<script type='text/javascript' src='../../asset/gt_developer/jquery.redirect.js'></script>