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
<?php include "../template/sys.sidebar.php"; ?>

<link rel="stylesheet" href="../../asset/dev.multistep.form/style.css">

<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- LOADER -->

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div style="width: 100vw;height: 100vh;overflow-x: hidden;">
    <div class="page-wrapper" style="display: block;">
        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">MY Training</h3>
            </div>

            <div class="col-md-12 col-12 align-self-center">
   

                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                    </div>
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
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <script src="../../asset/dev.multistep.form/script.js"></script>

        <?php include "../template/sys.footer.php"; ?>