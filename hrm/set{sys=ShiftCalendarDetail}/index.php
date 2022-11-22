<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
    include "../../application/session/session.php";
    $getPackage = "?";
} else {
    include "../../application/session/mobile.session.php";
    $getPackage = "?emp_id=$username&";
}
?>

<?php include "../template/sys.header.php"; ?>

<!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->
<?php
$page   = '111'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<?php include "../template/sys.sidebar.php"; ?>

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div style="width: 100vw;height: 100vh;overflow-x: hidden;">
    <div class="page-wrapper" style="display: block;">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Time & Attendance</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="../hrm{sys=emp.dashboard}/">Home&nbsp;&nbsp;</a></li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Calendar Schedule Detail</li>
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
                        <?php
                        if ($get_auth['access'] > 0) {
                            include "data.php";
                        } else {
                            include "../saas.error/index.php";
                        }
                        ?>
                        <!-- Column -->
                    </div>
                </div>
            </div>
            <!-- Row -->
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->

    <?php include "../template/sys.footer.php"; ?>