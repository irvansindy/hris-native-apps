
<!DOCTYPE html>
<html dir="ltr" lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Human Resource Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

    <link rel="stylesheet" href="../../asset/gt_developer/modal_popup_on_popup.css">

    <link rel="stylesheet" type="text/css" href="../../asset/gt_developer/vc-toggle-switch.css" />

    <link rel="stylesheet" href="../../asset/vendor/font-awesome/css/font-awesome.min.css">


        <script src="../../asset/gt_developer/jquery.min.js"></script>

        <!-- Developer css -->
        <link rel="stylesheet" href="../../asset/gt_developer/developer_hris.css">
        <link rel="stylesheet" href="../../asset/gt_developer/forms.css">
        <link rel="stylesheet" href="../../asset/gt_developer/loader.css">

        <!-- MAIN DATATABLE SERVERSIDE CSS -->
        <!-- MAIN DATATABLE SERVERSIDE CSS -->
        <link href="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/datatables/datatables.min.css" rel="stylesheet">
        <!-- MAIN DATATABLE SERVERSIDE CSS -->
        <!-- MAIN DATATABLE SERVERSIDE CSS -->

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











































<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->

      












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