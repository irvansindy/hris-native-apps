<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
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
            background: url("../../asset/dist/img/loading.gif") no-repeat center center;
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
        -webkit-animation: spin 1s linear infinite;
        /* Safari */
        animation: spin 1s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% {
            -webkit-transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
        }
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<style type="text/css">
   @font-face {
         font-family: "Font Digital";
         src: url('../../asset/font-fams/SourceSansPro-Light.otf');
         }
 
   .digital {
         font-family: "Font Digital";
         }
</style>

<style>
    body {
        font-family: "Font Digital";
    }

    /* The modals (background) */
    .modals {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 99;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
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

        .button_bot[disabled] {
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
            width: 20%
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

        .button_bot[disabled] {
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

        .dataTables_paginate {
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


<style>
.shine {
  background: #f6f7f8;
  background-image: linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
  background-repeat: no-repeat;
  background-size: 800px 104px; 
  display: inline-block;
  position: relative; 
  
  -webkit-animation-duration: 1s;
  -webkit-animation-fill-mode: forwards; 
  -webkit-animation-iteration-count: infinite;
  -webkit-animation-name: placeholderShimmer;
  -webkit-animation-timing-function: linear;
  }

box {
    height: 30px;
width: 188px;
}


lines {
  height: 10px;
  margin-top: 10px;
  width: 200px; 
}

@-webkit-keyframes placeholderShimmer {
  0% {
    background-position: -468px 0;
  }
  
  100% {
    background-position: 468px 0; 
  }
}
</style>








































<body style="overflow: hidden;">
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
    <!-- <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="mini-sidebar" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full" class=""> -->
    <div id="main-wrapper" data-layout="horizontal" data-navbarbg="skin1" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="../hrm{sys=dashboard}">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <!-- <img src="../../asset/admus/logo-icon.png" alt="homepage" class="dark-logo"> -->
                            <!-- Light Logo icon -->
                            <!-- <img src="../../asset/admus/logo-pralon_white-1024x422.png" alt="homepage" class="light-logo"> -->
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="../../asset/admus/logo-pralon_white-1024x422.png" alt="homepage" style="width: 115px;" class="dark-logo">
                            <!-- Light Logo text -->
                            <img src="../../asset/admus/logo-pralon_white-1024x422.png" class="light-logo" alt="homepage">
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light collapsed" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search"></div>
                    </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6">

                    <table>
                        <tr>
                            <td>Company <strong style="font: 12px Verdana, Geneva, sans-serif;font-size: 12px;font-weight: bold; ">&nbsp;Sdmkita&nbsp;</strong> | Language&nbsp; <img src="../../asset/dist/img/flag-en.png"><strong style="font: 12px Verdana, Geneva, sans-serif;font-size: 12px;font-weight: bold; ">&nbsp;&nbsp;English&nbsp;&nbsp;</strong>
                            </td>
                        </tr>
                     
                        <tr>
                            <td><strong style="font: 12px Verdana, Geneva, sans-serif;font-weight: bold;color: #ed1a24;<?php echo $style; ?>"><?php echo $account; ?> <?php echo $account_name; ?></strong></td>
                        </tr>
                    </table>




                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto ismobile">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="fa fa-bars"></i></a> </li>

                    </ul>
                    <ul class="navbar-nav mr-auto isweb">

                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img alt="Porto" style="margin-top: -1px;" src="../../asset/img/notification-pngrepo-com.png" width="29" height="19">
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right mailbox scale-up">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <h5 class="mb-0 font-weight-medium">Notifications</h5>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center notifications position-relative ps-container ps-theme-default" style="height:250px;" data-ps-id="d0de8b35-41bd-1357-d51c-1610c473f09b">
                                        
                                            <a class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-danger rounded-circle btn-circle"><i class="fa fa-link"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Luanch Admin</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my new admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span> </div>
                                            </a>
                               
                                            <a class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success rounded-circle btn-circle"><i class="ti-calendar"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Event today</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just a reminder that you have event</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span> </div>
                                            </a>
                                           
                                            <a class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i class="ti-settings"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Settings</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">You can customize this template as you want</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span> </div>
                                            </a>
                                        
                                            <a class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-primary rounded-circle btn-circle"><i class="ti-user"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                            </a>
                                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);"> <strong>Check all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Searchbox -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">

                            <div class="form-row search_box">

                                <div class="col-sm-10 name">
                                    <div class="input-group">
                                        Search
                                        <input type="text" autocomplete="off" onfocus="this.value=''" value="" style="font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" name="employeess" id="employeess" class="search-input">

                                        <!-- <input type="text" name="inp_SpvUPManpower" id="inp_SpvUPManpower" style="width: 70%;font-size: 11px;border: 1px solid #aaa6a6;border-radius: 8px;height: 20px;padding-left: 10px;background: #1e88e521;" class="form-control" placeholder="employees" />   -->
                                        <div id="employeesList"></div>

                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Searchbox -->
                        <!-- ============================================================== -->

                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <img alt="Porto" style="margin-top: -1px;" src="../../asset/img/active-inboxrequest.png">
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li style="background: #eee;">
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <h5 class="font-weight-medium mb-0">Active Request</h5>
                                        </div>
                                    </li>
                                    <li>
                                        <div id="notifications" class="message-center message-body position-relative ps-container ps-theme-default" style="height:250px;" data-ps-id="10edfe0c-4bc2-a957-f11b-b0f04f3db0a4">
                                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;">
                                                <div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                            </div>
                                            <div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;">
                                                <div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3" href="../hrm{sys=time.approval}"> <b>See all</b> <i class="fa fa-angle-right"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a style="color: #717171;" class=" dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div style="color: #717171;" class="
                                d-flex
                                no-block
                                align-items-center
                                p-3
                        
                                text-grey
                                mb-2
                                ">
                                    <div class="">
                                        <img src="../../asset/emp_photos/<?php echo $avatar; ?>" alt="user" class="profile-pic rounded-circle" width="30" style="height: 30px;margin-right: 4px;">

                                    </div>
                                    <div class="ms-2">
                                        <h4 class="mb-0 text-grey">
                                            <?php
                                            function ubah_huruf_awal($pemisah, $paragrap)
                                            {
                                                $pisahkalimat = explode($pemisah, $paragrap);
                                                $kalimatbaru = array();


                                                foreach ($pisahkalimat as $kalimat) {
                                                    $kalimatawalhurufbesar = ucwords(strtolower($kalimat));
                                                    $kalimatbaru[] = $kalimatawalhurufbesar;
                                                }

                                                $textgood = implode($pemisah, $kalimatbaru);
                                                return $textgood;
                                            }

                                            $kalimat = $nama;
                                            $textbaru = ubah_huruf_awal(". ", $kalimat);
                                            echo $textbaru;
                                            ?>
                                        </h4>
                                        <p class="mb-0"><?php echo $username; ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                                <ul class="dropdown-user list-style-none">
                                    <li>
                                        <div class="dw-user-box p-3 d-flex">
                                            <div class="u-img"><img src="../../asset/emp_photos/<?php echo $avatar; ?>" alt="user" class="rounded" width="80"></div>
                                            <div class="u-text ml-2">
                                                <h4 class="mb-0"><?php echo $nama; ?></h4>
                                                <p class="text-muted mb-1 font-14"><?php echo $username; ?></p>
                                                <a href="../hrm{sys=emp.profile}" class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </li>


                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list"><a class="px-3 py-2" href="../../application/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>

                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
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
                color: white;
                background-image: url("../../asset/dist/img/index.gif");
                background: -webkit-gradient(linear, left top, right top, color-stop(0%, rgba(255, 255, 255, 0)), color-stop(25%, rgba(255, 255, 255, 0.9)), color-stop(75%, rgba(255, 255, 255, 0.9)), color-stop(100%, rgba(255, 255, 255, 0)));
                background: -webkit-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
                background: -moz-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
                background: -ms-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
                background: -o-linear-gradient(left, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
                background: linear-gradient(to right, rgba(255, 255, 255, 0) 0%, rgba(255, 255, 255, 0.9) 25%, rgba(255, 255, 255, 0.9) 75%, rgba(255, 255, 255, 0) 100%);
            }
        </style>

        <style>
            /* //MOBILE */
            @media only screen and (max-width: 500px) {
                .search_box {
                    top: 10px;
                    margin-top: 15px;
                    margin-right: -105px;
                }
            }

            /* //MOBILE */
            @media only screen and (max-width: 991px) {
                .search_box {
                    margin-top: -3px;
                    margin-right: -34px;
                }
            }

            /* //WEBSITE */
            @media (min-width: 991px) {
                .search_box {
                    margin-top: 15px;
                    margin-right: -127px;
                    width: 401px;
                }

                .isweb {
                    display: block;
                }

                .ismobile {
                    display: none;
                }
            }

            /* //WEBSITE */
            @media (min-width: 1080px) {
                .search_box {
                    margin-top: 15px;
                    margin-right: -127px;
                    width: 401px;
                }

                .isweb {
                    display: block;
                }

                .ismobile {
                    display: none;
                }
            }

        </style>



        <script src="js/jquery.min.js"></script>
        <script>
            $(document).ready(function() {

                $('#employeess').focus(function() {
                    var query = $(this).val();
                    if (query != '') {
                        $.ajax({
                            url: "../template/search.php?userid=<?php echo $username; ?>&period=<?php echo $qPeriod_r; ?>",
                            method: "POST",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                $('#employeesList').fadeIn();
                                $('#employeesList').html(data);
                            }
                        });
                    }
                });
                $('#employeess').keyup(function() {
                    var query = $(this).val();
                    if (query != '') {
                        $.ajax({
                            url: "../template/search.php?userid=<?php echo $username; ?>&period=<?php echo $qPeriod_r; ?>",
                            method: "POST",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                $('#employeesList').fadeIn();
                                $('#employeesList').html(data);
                            }
                        });
                    }
                });

            });
        </script>

        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->










        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in mobile" style="border-bottom: 4px solid #eceaea;color: white;">


                        <li class="sidebar-item" style="background: #c6c6c6;">
                            <a href="../hrm{sys=emp.dashboard}/" class="sidebar-link waves-effect waves-dark" style="padding: 8px 5px 8px 5px;" href="javascript:void(0)" aria-expanded="false">
                                <i class="fa fa-th-large" aria-hidden="true"></i>
                                <span class="hide-menu"> </span></a>
                            <ul aria-expanded="false" class="collapse first-level">
                            </ul>
                        </li>