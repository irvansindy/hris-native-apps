<?php include "../../application/session/session.php";?>
<?php include "../template/sys.header.php";?>
<?php include "../template/sys.sidebar.php";?>

<?php 
$page   = '2'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '2'
$footer = 'yes'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

<?php include "../../application/auth_page/sys.page.php";?>

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
                    <h3 class="text-themecolor mb-0">Employee</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                        <li ><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Employee Information</li>
                    </ol>
                </div>
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
                            <!-- KONDISI UNTUK MENDAPATKAN AKSES HALAMAN -->
                            <!-- NOTE : MEMBUTUHKAN DECLARING PAGE DI $PAGE DIATAS DIHALAMAN YANG SAMA -->
                            <?php
                                $hrmmenu = mysqli_query($connect, "SELECT * FROM hrmmenu a WHERE a.menu_id IN ($qSequence_r) and a.menu_id = $page");
                                if(mysqli_num_rows($hrmmenu) == '0') {
                                    include "../../application/unauthorized/index.php";
                                } else if (mysqli_num_rows($hrmmenu) > '0') {
                                    include "data.php";
                                }
                            ?>

                            


                            <!-- KONDISI UNTUK MENDAPATKAN AKSES HALAMAN -->
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