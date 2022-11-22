<?php
include "../../application/config.php";
$username = $_GET['userid'];
?>
<!-- DEFINISIKAN ALL PAGE use reference 'hrmmenu' -->
<?php $this_page = '2';?>
<!-- DEFINISIKAN ALL PAGE use reference 'hrmmenu' -->


<!DOCTYPE html>
<html dir="ltr" lang="en"><head>
    <meta name="google-site-verification" content="uswxPWsb_XBEHWdcUnUw6wAanU7mw61XzZc_xAXYZA4" />
    <meta name="google-site-verification" content="uswxPWsb_XBEHWdcUnUw6wAanU7mw61XzZc_xAXYZA4" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
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
</head>







<style>
.loader {
  border: 3px solid #f3f3f3;
  border-radius: 50%;
  border-top: 3px solid grey;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 1s linear infinite; /* Safari */
  animation: spin 1s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The modals (background) */
.modals {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* modals Content */
/* KALO VIEW MOBILE */
@media (max-width:960px) { 
    .modals-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                min-height: 370px;
                margin-top: 70px;
    }
    .modals-content-loader {
                background-color: #02020270;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 80%;
                margin-top: 150px;
                border-radius: 5px;
    }
    .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }
    .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }
    
}
/* KALO VIEW WEB */
@media (min-width:960px) { 
    .modals-content {
                background-color: #fefefe;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 25%

    }
    .modals-content-loader {
                background-color: #02020270;
                margin: auto;
                padding: 20px;
                border: 1px solid #888;
                width: 20%;
                margin-top: 150px;
                border-radius: 5px;
    }
    .button_bot {
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }
    .button_bot[disabled]{
              background-color: #F68A22;
              border: solid 1px #DCDFDE;
              font-weight: bold;
              color: #E1E1E1;
              width: 100%;
              height: 40px;
              cursor: no-drop;
              padding: 12px;
              text-align: center;
              text-decoration: none;
              display: inline-block;
              font-size: 14px;
              margin: 1px 1px;
              cursor: pointer;
              border-radius: 40px;
    }

    .dataTables_paginate{
        float: left !important;
        margin-top: 10px;
    }
}
/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.sub_div {
    position: absolute;
    bottom: 20px;
}
span.required {
    color: red;
}
</style>





</head>

   










<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- <a href="https://api.whatsapp.com/send?phone=6281296290235&text=Halo tim sdmkita, saya ingin berdiskusi me<!==ngenai aplikasi HRIS ini" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a> 

 <link rel="icon" 
      type="image/png" 
      href="http://demo.sdmkita.com/asset/dist/img/favicon-96x96.png">
-->















<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader" style="display: none;">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
   












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

        
        <!-- Developer css TOAST ALL JS CSS -->


<!-- FUNGSI UNTUK MENGAMBIL FUNGSI OTORISASI  -->

<!-- FUNGSI UNTUK MENGAMBIL FUNGSI OTORISASI  -->

<script src="../../asset/vendor/jquery/jquery.min.js"></script> 















<!-- TRELLO LOADER -->
<!-- TRELLO LOADER -->
<style>
@-webkit-keyframes spinnerframes {
       0% {
              height: 25%
       }

       50% {
              height: 40%
       }

       100% {
              height: 100%
       }
}

@keyframes spinnerframes {
       0% {
              height: 25%
       }

       50% {
              height: 40%
       }

       100% {
              height: 100%
       }
}

.spinner {
       display: block;
       margin: 50px auto;
       position: relative;
       height: 18px;
       width: 18px
}

.spinner.large {
       height: 32px;
       width: 32px
}

.spinner .bar {
       border-radius: 2px;
       background: hsl(0, 0%, 83%);
       display: block;
       width: 30%;
       position: absolute;
       height: 0;
       -webkit-animation-name: spinnerframes;
       -webkit-animation-direction: alternate;
       -webkit-animation-duration: .35s;
       -webkit-animation-timing-function: linear;
       -webkit-animation-iteration-count: infinite;
       animation-name: spinnerframes;
       animation-direction: alternate;
       animation-duration: .35s;
       animation-timing-function: linear;
       animation-iteration-count: infinite
}

.spinner .bar.bar1 {
       top: 0;
       left: 0
}

.spinner .bar.bar2 {
       top: 0;
       left: 35%;
       -webkit-animation-delay: .1s;
       animation-delay: .1s
}

.spinner .bar.bar3 {
       top: 0;
       left: 70%;
       -webkit-animation-delay: .2s;
       animation-delay: .2s
}
</style>
<!-- TRELLO LOADER -->
<!-- TRELLO LOADER -->






<style>
       

	.modal.left .modal-dialog,
	.modal.right .modal-dialog {
		position: fixed;
		margin: auto;
		width: 420px;
		height: 100%;
		-webkit-transform: translate3d(0%, 0, 0);
		    -ms-transform: translate3d(0%, 0, 0);
		     -o-transform: translate3d(0%, 0, 0);
		        transform: translate3d(0%, 0, 0);
	}


	.modal.right .modal-content {
		height: 100%;
		overflow-y: auto;
	}

	.modal.right .modal-body {
		padding: 40px 20px 100px;
	}

        
	.modal.right.fade .modal-dialog {
		right: -420px;
		-webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
		   -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
		     -o-transition: opacity 0.3s linear, right 0.3s ease-out;
		        transition: opacity 0.3s linear, right 0.3s ease-out;
	}
	
	.modal.right.fade.in .modal-dialog {
		right: 0;
	}
</style>



<style type="text/css">
              div.dataTables_processing {
              position: absolute;
              top: 50%;
              left: 50%;
              width: 100%;
              height: 100px;
              margin-left: -50%;
              margin-top: -25px;
              padding-top: 20px;
              padding-bottom: 20px;
              text-align: center;
              font-size: 1px;
              color:white;
              background-image: url("../../asset/dist/img/index.gif");
              background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255,255,255,0)), color-stop(25%, rgba(255,255,255,0.9)), color-stop(75%, rgba(255,255,255,0.9)), color-stop(100%, rgba(255,255,255,0)));
              background: -webkit-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
              background: -moz-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
              background: -ms-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
              background: -o-linear-gradient(left, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
              background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.9) 25%, rgba(255,255,255,0.9) 75%, rgba(255,255,255,0) 100%);
              }

       </style>

<style>

</style>




<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<link href="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/datatables/datatables.min.css" rel="stylesheet">
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->



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
                        <li ><i class="fa fa-angle-right" aria-hidden="true"></i>&nbsp;Attendance Correction</li>
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
                            <?php include "data.php"; ?>
                            <!-- Column -->
                        </div>
                    </div>
                </div>
                <!-- Row -->
    
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->

<?php include "../template/sys.footer_mobile.php";?>