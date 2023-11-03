<?php
!empty($_GET['emp_id']) ? $getdata = '1' : $getdata = '0';
if ($getdata == 0) {
    include "../../application/session/session.php";
    $getPackage = "?";
    $platform = '';
} else {
    include "../../application/session/mobile.session.php";
    $getPackage = "?emp_id=$username&";
    $platform = $_GET['platform'];
}
?>

<?php include "../template/sys.header$platform.php"; ?>

<!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->
<?php
$page   = '8'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'ss
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<?php
include "../template/sys.sidebar$platform.php";
?>

<?php
$get_auth = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) as access FROM hrmmenu where menu_id IN ($forumla_used) and menu_id = '$page' ORDER BY order_id ASC"));
?>

<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div style="width: 100vw;height: 100vh;overflow-x: hidden;">
    <div class="page-wrapper" style="display: block;">
        <?php
        if ($platform != 'mobile') {
        ?>

        <div class="row page-titles">
            <div class="col-md-5 col-12 align-self-center">
                <h3 class="text-themecolor mb-0">Organization Structure</h3>
                <ol class="breadcrumb mb-0 p-0 bg-transparent">
                    <li class="breadcrumb-item"><a href="../hrm{sys=emp.dashboard}/">Home&nbsp;&nbsp;</a></li>
                    <li><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Leave Request</li>
                </ol>
            </div>
        </div>

        <?php } else if ($platform == 'mobile') { ?>


        <?php } ?>



        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- Row -->
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="row">

                        <!-- Column -->
                        <form name="myForm" id="myForm" action="data.php" method="post" target="popupwindow"
                            onsubmit=" return validateForm(), window.open('data.php', 'popupwindow', 'scrollbars=yes,toolbar=no,width=800,height=400');">
                            <fieldset id="fset_1">
                                <legend>View Structure</legend>


                                <div class="form-row">
                                    <div class="col-4 name"> </div>
                                    <div class="col-sm-8" style="text-align: right;">
                                        <div class="input-group">
                                            <input class="btn btn-rounded btn-warning btn-sm text-white d-inline-block"
                                                type="button" value="Open a Popup Window"
                                                onclick="window.open('data','popUpWindow','width=800,height=400,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');">
                                        </div>
                                    </div>
                                </div>




                            </fieldset>
                        </form>
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