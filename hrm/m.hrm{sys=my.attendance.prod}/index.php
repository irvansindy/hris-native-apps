<?php
include "../../application/config.php";
$username = $_GET['userid'];
?>





<!DOCTYPE html>
<html dir="ltr" lang="en"><head>
    <meta name="google-site-verification" content="uswxPWsb_XBEHWdcUnUw6wAanU7mw61XzZc_xAXYZA4" />
    <meta name="google-site-verification" content="uswxPWsb_XBEHWdcUnUw6wAanU7mw61XzZc_xAXYZA4" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" 
      type="image/png" 
      href="http://demo.sdmkita.com/asset/dist/img/favicon-96x96.png">
    <title>Human Resource Information System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="uswxPWsb_XBEHWdcUnUw6wAanU7mw61XzZc_xAXYZA4" />
    <meta name="keywords" content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, material admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, material design, material dashboard bootstrap 4 dashboard template">

    <script src="../../asset/gt_developer/jquery.min.js"></script>
    <link href="../../asset/admus/chartist.css" rel="stylesheet">
    <link href="../../asset/admus/chartist-init.css" rel="stylesheet">
    <link href="../../asset/admus/chartist-plugin-tooltip.css" rel="stylesheet">
    <link href="../../asset/admus/c3.css" rel="stylesheet">
    <link href="../../asset/admus/style.css" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="../../asset/vendor/bootstrap/css/modal.css">

    <link rel="stylesheet" href="../../asset/gt_developer/adminlte.css">

    <link rel="stylesheet" type="text/css" href="../../asset/gt_developer/vc-toggle-switch.css" />

    <link rel="stylesheet" href="../../asset/vendor/font-awesome/css/font-awesome.min.css">

    <script src="../../asset/gt_developer/jquery.min.js"></script>



      <!-- Developer css -->
      <link rel="stylesheet" href="../../asset/gt_developer/developer_hris.css">
      <link rel="stylesheet" href="../../asset/gt_developer/forms.css">
      <link rel="stylesheet" href="../../asset/gt_developer/loader.css">

      <style>
      .divBlockSpace {
      position: fixed;
      overflow: hidden;
      background:url("../../asset/dist/img/loading.gif") no-repeat center center;
      background-color: #fdfdfd;
      opacity: .75;
      filter: alpha(opacity=85);
      z-index: 100;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      border: 0 solid blue;
      
      }
      </style>
      
      <style>
          .float{
            	position:fixed;
            	width:60px;
            	height:60px;
            	bottom:40px;
            	right:40px;
            	background-color:#25d366;
            	color:#FFF;
            	border-radius:50px;
            	text-align:center;
              font-size:30px;
            	box-shadow: 2px 2px 3px #999;
              z-index:100;
            }
            
            .my-float{
            	margin-top:16px;
            }
      </style>
</head>

   



















 <!-- Developer css TOAST ALL JS CSS -->
        <link href="../../asset/admus/toastr.css" rel="stylesheet">
        <script src="../../asset/admus/jquery.js"></script>
        <script src="../../asset/admus/toastr.js"></script>

        <script type="text/javascript">
        $(function() {
        // Position Bottom Right
        $('#pos-bottom-right').on('click', function() {
            toastr.info('SuccessFully Saved.', 'Bottom Right!', { positionClass: 'toastr toast-bottom-right', containerId: 'toast-bottom-right' });
        });
        });
        </script>


<script src="../../asset/vendor/jquery/jquery.min.js"></script> 




<!-- LOADER -->
<div onclick='return stopload()' id="divBlockSpace" class="divBlockSpace"></div>
<div onclick='return stopload()' id="loading-circle"></div>
<div id="contents"></div>
<!-- LOADER -->

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;overflow: hidden;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Time & Attendance</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home&nbsp;&nbsp;</a></li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i>
                                &nbsp;Attendance Data</li>
                    </ol>
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
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
           

<!-- /**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//NOTIFIKASI
//NOTIFIKASI -->
<script>
                            $(document).ready(function() {
                                   var limit = 100;
                                   var start = 0;
                                   var action = 'inactive';

                                   function load_country_data_s(limit, start) {
                                          $.ajax({
                                                 url: "../../view/no/VMNotificationList.php",
                                                 method: "POST",
                                                 data: {
                                                        limit: limit,
                                                        start: start <?php echo $frameworks; ?>
                                                 },
                                                 cache: false,
                                                 success: function(data) {
                                                        $('#notifications').append(
                                                               data);
                                                        if (data == '') {
                                                               $('#example3_message')
                                                                      .html(
                                                                             "<button type='button' class='btn btn-info'>No Data Found</button>"
                                                                             );
                                                               action = 'active';
                                                        } else {
                                                               $('#example3_message')
                                                                      .html(
                                                                             "<button type='button' class='btn btn-warning'>Please Wait....</button>"
                                                                             );
                                                               action = "inactive";
                                                        }
                                                 }
                                          });
                                   }

                                          if (action == 'inactive') {
                                                 action = 'active';
                                                 load_country_data_s(limit, start);
                                          }
                                          $(window).scroll(function() {
                                                 if ($(window).scrollTop() + $(window).height() >
                                                        420 && action == 'inactive') {
                                                        action = 'active';
                                                        start = start + limit;
                                                        setTimeout(function() {
                                                               load_country_data_s(
                                                                      limit,
                                                                      start);
                                                        }, 1000);
                                                 }
                                          });

                                   });
                            </script>
<!-- /**
 *
 * '||''|.                            '||
 *  ||   ||    ....  .... ...   ....   ||    ...   ... ...  ... ..
 *  ||    || .|...||  '|.  |  .|...||  ||  .|  '|.  ||'  ||  ||' ''
 *  ||    || ||        '|.|   ||       ||  ||   ||  ||    |  ||
 * .||...|'   '|...'    '|     '|...' .||.  '|..|'  ||...'  .||.
 *                                                  ||
 * --------------- By Display:inline ------------- '''' -----------
 */
//NOTIFIKASI
//NOTIFIKASI -->





 <!-- footer -->
            <!-- ============================================================== -->
         
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- customizer Panel -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    
    <script src="../../asset/admus/jquery.js"></script>
    <script src="../../asset/admus/popper.js"></script>
    <script src="../../asset/admus/bootstrap.js"></script>
    <script src="../../asset/admus/app.js"></script>
    <script src="../../asset/admus/app_002.js"></script>
    <script src="../../asset/admus/app-style-switcher.js"></script>
    <script src="../../asset/admus/perfect-scrollbar.js"></script>
    <script src="../../asset/admus/sparkline.js"></script>
    <script src="../../asset/admus/waves.js"></script>
    <script src="../../asset/admus/sidebarmenu.js"></script>
    <script src="../../asset/admus/custom.js"></script>
    <script src="../../asset/admus/chartist.js"></script>
    <script src="../../asset/admus/chartist-plugin-tooltip.js"></script>
    <script src="../../asset/admus/d3.js"></script>
    <script src="../../asset/admus/c3.js"></script>
    <script src="../../asset/admus/dashboard6.js"></script>


</body>
</html>


<script>
       document.onreadystatechange = function () {
            var state = document.readyState
            if (state == 'interactive') {
                  document.getElementById('contents').style.visibility="hidden";
            } else if (state == 'complete') {
                  setTimeout(function(){
                  document.getElementById('interactive');
                  document.getElementById('divBlockSpace').style.visibility="hidden";
                  document.getElementById('contents').style.visibility="visible";
                  },100);
            }
            }
       </script>
       <script>
       function startloadmore() {
              $(document).ready(function() {
                     const lockModal = $("#lock-modal");
                     const loadingCircle = $("#loading-circle");
                     const form = $("#my-form");

                     // lock down the form
                     lockModal.css("display", "block");
                     loadingCircle.css("display", "block");

                     form.children("input").each(function() {
                            $(this).attr("readonly", true);
                     });

                     setTimeout(function() {
                            // re-enable the form
                            lockModal.css("display", "none");
                            loadingCircle.css("display", "none");

                            
                     }, 500);
              });
       };
       </script>
       <script>
       function startload() {
              $(document).ready(function() {
                     const lockModal = $("#lock-modal");
                     const loadingCircle = $("#loading-circle");
                     const form = $("#my-form");

                     // lock down the form
                     lockModal.css("display", "block");
                     loadingCircle.css("display", "block");

                     form.children("input").each(function() {
                            $(this).attr("readonly", true);
                     });

                     setTimeout(function() {
                            // re-enable the form
                            lockModal.css("display", "none");
                            loadingCircle.css("display", "none");

                            
                     }, 35000);
              });
       };
       </script>
       <script>
       function stopload() {
              $(document).ready(function() {
                     const lockModal = $("#lock-modal");
                     const loadingCircle = $("#loading-circle");
                     const form = $("#my-form");

                     // lock down the form
                     lockModal.css("display", "none");
                     loadingCircle.css("display", "none");

                     
              });
       };
       </script>
       <script>
       $(function () {
       $("#example1").DataTable();
       $("#example3").DataTable({ 
       "ordering" : false,
       "sort": false });
       $('#example2').DataTable({
       "paging": false,
       "lengthChange": false,
       "searching": false,
       "ordering": false,
       "info": true,
       "autoWidth": true,
       });
       });

       $('.toastsDefaultFull').click(function() {
       $(document).Toasts('create', {
       body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.',
       title: 'Toast Title',
       subtitle: 'Subtitle',
       icon: 'fas fa-envelope fa-lg',
       })
       });
       </script>

       <script type="text/javascript">
       $(document).ready(function () {
       bsCustomFileInput.init();
       });
       </script>


       <script src="../../asset/vendor/bootstrap/js/bootstrap.min.js"></script>