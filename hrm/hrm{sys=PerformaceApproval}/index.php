<?php include "../../application/session/session.php";?>
<?php include "../template/sys.header.php";?>

<!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->

<?php include "../template/sys.sidebar.php";?>

<?php 
$page   = '47'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'
$footer = 'yes'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>


        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Performance</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Performance&nbsp;&nbsp;</a></li>
                        <li ><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;IPP Approval</li>
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