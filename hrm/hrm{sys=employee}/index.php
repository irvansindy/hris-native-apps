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
                <h3 class="text-themecolor mb-0">Employee Information</h3>
            </div>

            <div class="col-md-12 col-12 align-self-center">
            <div title="Please update your employment data" 
                                                        
                                                        data-toggle="modal" data-target="#modalSettlement" onclick="settlement(`<?php echo $username; ?>`)"

                                                        class="open_modal_search card-header d-flex align-items-center" style="border-bottom: 1px solid white;margin-left: -12px;margin-right: -12px;">
                <div class="alert alert-blue" style="width: 100%;cursor: pointer;">
                    <img src="../../asset/dist/img/favicon.png" style="width: 17px;">
                    <strong>Announcement</strong> - Please update your employment data.
                </div>
            </div>


  

            
            <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                <div class="d-flex mt-2 justify-content-end">
                        <!-- <div class="d-flex mr-3 ml-2">
                                <div class="chart-text mr-2">
                                    <h6 class="mb-0"><small>Employee Active</small></h6>
                                    <h4 class="mt-0 text-info">16000</h4>
                                </div>
                                <div class="spark-chart">
                                    <div id="monthchart"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;" width="60" height="35"></canvas></div>
                                </div>
                            </div> -->
                        <!-- <div class="d-flex ml-2">
                                <div class="chart-text mr-2">
                                    <h6 class="mb-0"><small>LAST MONTH</small></h6>
                                    <h4 class="mt-0 text-primary">$48,356</h4>
                                </div>
                                <div class="spark-chart">
                                    <div id="lastmonthchart"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;" width="60" height="35"></canvas></div>
                                </div>
                            </div> -->
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
    <script  src="../../asset/dev.multistep.form/script.js"></script>

    <?php include "../template/sys.footer.php"; ?>