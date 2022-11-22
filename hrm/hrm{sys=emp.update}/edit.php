

<?php include "../../application/session/session.php";?>
<?php include "../template/sys.header.php";?>
<?php include "../template/sys.sidebar.php";?>

<?php 
$page = '19'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '19'}
$footer = 'yes'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>







                                                      


<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- LOADER -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Employee Information</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                        <li ><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Ubah Data Pemutakhiran Data</li>
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
                            <?php include "data.edit.php"; ?>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>


             <?php include "../template/sys.footer.php";?>

            <?php include "js/search_nats.php";?>
            <?php include "js/search_bank.php";?>
            <?php include "js/search_edutype.php";?>
            <?php include "js/search_city.php";?>
            <?php include "js/search_institution.php";?>

             <link href="../../asset/gt_developer/select2-ajax/css/select2.css" rel="stylesheet" />

            <!-- UPDATE 2021-09-10 Karena tidak bisa panggil fungsi modal dan tidak dapat dijalankan,
            belum diketahui ini untuk apa -->
            <!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->
            <!-- UPDATE 2021-09-10 Karena tidak bisa panggil fungsi modal dan tidak dapat dijalankan,
            belum diketahui ini untuk apa -->

            <script src="../../asset/gt_developer/select2-ajax/js/select2.min.js"></script>


<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<script type='text/javascript' src='../../asset/gt_developer/jquery.redirect.js'></script>