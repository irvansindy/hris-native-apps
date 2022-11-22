
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

</style>
























