<?php include "sys.header.php";?>



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
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="mini-sidebar" data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full" class="">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin6">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- This is for the sidebar toggle which is visible on mobile only -->
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="#">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Dark Logo icon -->
                            <img src="assets/logo-icon.png" alt="homepage" class="dark-logo">
                            <!-- Light Logo icon -->
                            <img src="assets/logo-light-icon.png" alt="homepage" class="light-logo">
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="assets/logo-text.png" alt="homepage" class="dark-logo">
                            <!-- Light Logo text -->
                            <img src="assets/logo-light-text.png" class="light-logo" alt="homepage">
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- Toggle which is visible on mobile only -->
                    <!-- ============================================================== -->
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light collapsed" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin6" >
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link sidebartoggler d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item d-none d-md-block search-box"> <a class="nav-link d-none d-md-block waves-effect waves-dark" href="javascript:void(0)"><i class="ti-search"></i></a>
                            <form class="app-search">
                                <input type="text" class="form-control" placeholder="Search &amp; enter"> 
                                <a class="srh-btn"><i class="ti-close"></i></a> 
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Mega Menu -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                            <div class="dropdown-menu scale-up-left">
                                <ul class="mega-dropdown-menu row p-0 m-0 list-inline">
                                    <li class="col-lg-3 col-xlg-2 mb-4">
                                        <h4 class="mb-3">CAROUSEL</h4>
                                        <!-- CAROUSEL -->
                                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner" role="listbox">
                                                <div class="carousel-item">
                                                    <div class="container"> <img class="d-block img-fluid" src="assets/img1.jpg" alt="First slide"></div>
                                                </div>
                                                <div class="carousel-item active">
                                                    <div class="container"><img class="d-block img-fluid" src="assets/img2.jpg" alt="Second slide">
                                                    </div>
                                                </div>
                                                <div class="carousel-item">
                                                    <div class="container"><img class="d-block img-fluid" src="assets/img3.jpg" alt="Third slide"></div>
                                                </div>
                                            </div>
                                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span> </a>
                                            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span> </a>
                                        </div>
                                        <!-- End CAROUSEL -->
                                    </li>
                                    <li class="col-lg-3 mb-4">
                                        <h4 class="mb-3">ACCORDION</h4>
                                        <!-- Accordian -->
                                        <div id="accordion" class="nav-accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card mb-1">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Collapsible Group Item #1
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                                                        eiusmod high. </div>
                                                </div>
                                            </div>
                                            <div class="card mb-1">
                                                <div class="card-header" role="tab" id="headingTwo">
                                                    <h5 class="mb-0">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                            Collapsible Group Item #2
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                                                        eiusmod high life accusamus terry richardson ad squid. </div>
                                                </div>
                                            </div>
                                            <div class="card mb-0">
                                                <div class="card-header" role="tab" id="headingThree">
                                                    <h5 class="mb-0">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                            Collapsible Group Item #3
                                                        </a>
                                                    </h5>
                                                </div>
                                                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                    <div class="card-body"> Anim pariatur cliche reprehenderit, enim
                                                        eiusmod high life accusamus terry richardson ad squid. </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="col-lg-3  mb-4">
                                        <h4 class="mb-3">CONTACT US</h4>
                                        <!-- Contact -->
                                        <form>
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="exampleInputname1" placeholder="Enter Name"> </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" placeholder="Enter email">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Message"></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-info">Submit</button>
                                        </form>
                                    </li>
                                    <li class="col-lg-3 col-xlg-4 mb-4">
                                        <h4 class="mb-3">List style</h4>
                                        <!-- List style -->
                                        <ul class="list-style-none">
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    You can give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Another Give link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Forth link</a></li>
                                            <li><a href="javascript:void(0)"><i class="fa fa-check text-success"></i>
                                                    Another fifth link</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Mega Menu -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav">
                        <!-- ============================================================== -->
                        <!-- Comment -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-message"></i>
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
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-danger rounded-circle btn-circle"><i class="fa fa-link"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Luanch Admin</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my new admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-success rounded-circle btn-circle"><i class="ti-calendar"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Event today</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just a reminder that you have event</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="btn btn-info rounded-circle btn-circle"><i class="ti-settings"></i></span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Settings</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">You can customize this template as you want</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
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
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Comment -->
                        <!-- ============================================================== -->
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-email"></i>
                                <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up" aria-labelledby="2">
                                <ul class="list-style-none">
                                    <li>
                                        <div class="border-bottom rounded-top py-3 px-4">
                                            <h5 class="font-weight-medium mb-0">You have 4 new messages</h5>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="message-center message-body position-relative ps-container ps-theme-default" style="height:250px;" data-ps-id="10edfe0c-4bc2-a957-f11b-b0f04f3db0a4">
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="user-img position-relative d-inline-block"> <img src="assets/1.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle online"></span> </span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="user-img position-relative d-inline-block"> <img src="assets/2.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle busy"></span> </span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Sonu Nigam</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">I've sung a song! See you at</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="user-img position-relative d-inline-block"> <img src="assets/3.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle away"></span> </span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Arijit Sinh</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">I am a singer!</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span> </div>
                                            </a>
                                            <!-- Message -->
                                            <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2">
                                                <span class="user-img position-relative d-inline-block"> <img src="assets/4.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                                <div class="w-75 d-inline-block v-middle pl-2">
                                                    <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                            </a>
                                        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                                    </li>
                                    <li>
                                        <a class="nav-link border-top text-center text-dark pt-3" href="javascript:void(0);"> <b>See all e-Mails</b> <i class="fa fa-angle-right"></i> </a>
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
                            <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="assets/1.jpg" alt="user" class="profile-pic rounded-circle" width="30">
                            </a>
                            <div class="dropdown-menu mailbox dropdown-menu-right scale-up">
                                <ul class="dropdown-user list-style-none">
                                    <li>
                                        <div class="dw-user-box p-3 d-flex">
                                            <div class="u-img"><img src="assets/1.jpg" alt="user" class="rounded" width="80"></div>
                                            <div class="u-text ml-2">
                                                <h4 class="mb-0">Steave Jobs</h4>
                                                <p class="text-muted mb-1 font-14">varun@gmail.com</p>
                                                <a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/pages-profile.html" class="btn btn-rounded btn-danger btn-sm text-white d-inline-block">View
                                                    Profile</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list"><a class="px-3 py-2" href="#"><i class="ti-user"></i> My Profile</a></li>
                                    <li class="user-list"><a class="px-3 py-2" href="#"><i class="ti-wallet"></i> My Balance</a></li>
                                    <li class="user-list"><a class="px-3 py-2" href="#"><i class="ti-email"></i> Inbox</a></li>
                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list"><a class="px-3 py-2" href="#"><i class="ti-settings"></i> Account Setting</a></li>
                                    <li role="separator" class="dropdown-divider"></li>
                                    <li class="user-list"><a class="px-3 py-2" href="#"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-us"></i></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up"> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-in"></i> India</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-fr"></i> French</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-cn"></i> China</a> <a class="dropdown-item" href="#"><i class="flag-icon flag-icon-de"></i> Dutch</a> </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar ps-container ps-theme-default ps-active-y" data-ps-id="e68914b7-815e-2188-9980-e5b2f4acf489">
                <!-- User profile -->
                <div class="user-profile position-relative" style="background: url(../assets//images/background/user-info.jpg) no-repeat;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="assets/profile.png" alt="user" class="w-100"> </div>
                    <!-- User profile text-->
                    <div class="profile-text pt-1"> 
                        <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Markarn Doe</a>
                        <div class="dropdown-menu animated flipInY"> 
                            <a href="#" class="dropdown-item"><i class="ti-user"></i>
                                My Profile</a> 
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My
                                Balance</a>
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> 
                            <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div> 
                            <a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/authentication-login1.html" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in">
                        <li class="nav-small-cap">
                            <i class="mdi mdi-dots-horizontal"></i>
                            <span class="hide-menu">Personal</span>
                        </li>
                      
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-content-copy"></i><span class="hide-menu">Page Layouts </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/layout-inner-fixed-left-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-align-left"></i><span class="hide-menu"> Inner Fixed Left Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/layout-inner-fixed-right-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-align-right"></i><span class="hide-menu"> Inner Fixed Right Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/layout-inner-left-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-float-left"></i><span class="hide-menu"> Inner Left Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/layout-inner-right-sidebar.html" class="sidebar-link"><i class="mdi mdi-format-float-right"></i><span class="hide-menu"> Inner Right Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/page-layout-fixed-header.html" class="sidebar-link"><i class="mdi mdi-view-quilt"></i><span class="hide-menu"> Fixed Header
                                        </span></a></li>
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/page-layout-fixed-sidebar.html" class="sidebar-link"><i class="mdi mdi-view-parallel"></i><span class="hide-menu"> Fixed Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/page-layout-fixed-header-sidebar.html" class="sidebar-link"><i class="mdi mdi-view-column"></i><span class="hide-menu">
                                            Fixed Header &amp; Sidebar </span></a></li>
                                <li class="sidebar-item"><a href="https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/page-layout-boxed-layout.html" class="sidebar-link"><i class="mdi mdi-view-carousel"></i><span class="hide-menu"> Box Layout
                                        </span></a></li>
                            </ul>
                        </li>
                       </ul>
                </nav>
                <!-- End Sidebar navigation -->
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 448px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 62px;"></div></div></div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer">
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ti-settings"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="mdi mdi-gmail"></i></a>
                <!-- item-->
                <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="mdi mdi-power"></i></a>
            </div>
            <!-- End Bottom points-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
                    <h3 class="text-themecolor mb-0">Dashboard 6</h3>
                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard 6</li>
                    </ol>
                </div>
                <div class="col-md-7 col-12 align-self-center d-none d-md-block">
                    <div class="d-flex mt-2 justify-content-end">
                        <div class="d-flex mr-3 ml-2">
                            <div class="chart-text mr-2">
                                <h6 class="mb-0"><small>THIS MONTH</small></h6>
                                <h4 class="mt-0 text-info">$58,356</h4>
                            </div>
                            <div class="spark-chart">
                                <div id="monthchart"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;" width="60" height="35"></canvas></div>
                            </div>
                        </div>
                        <div class="d-flex ml-2">
                            <div class="chart-text mr-2">
                                <h6 class="mb-0"><small>LAST MONTH</small></h6>
                                <h4 class="mt-0 text-primary">$48,356</h4>
                            </div>
                            <div class="spark-chart">
                                <div id="lastmonthchart"><canvas style="display: inline-block; width: 60px; height: 35px; vertical-align: top;" width="60" height="35"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <!-- Row -->
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Product A Sales</h4>
                                        <div class="d-flex flex-row">
                                            <div class="p-2 border-right">
                                                <h6 class="font-weight-light">Montly</h6><b>20.40%</b>
                                            </div>
                                            <div class="p-2">
                                                <h6 class="font-weight-light">Daily</h6><b>5.40%</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="spark1" class="sparkchart"><canvas style="display: inline-block; width: 248.65px; height: 50px; vertical-align: top;" width="248" height="50"></canvas></div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Product B Sales</h4>
                                        <div class="d-flex flex-row">
                                            <div class="p-2 border-right">
                                                <h6 class="font-weight-light">Montly</h6><b>20.40%</b>
                                            </div>
                                            <div class="p-2">
                                                <h6 class="font-weight-light">Daily</h6><b>5.40%</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="spark2" class="sparkchart"><canvas style="display: inline-block; width: 248.65px; height: 50px; vertical-align: top;" width="248" height="50"></canvas></div>
                                </div>
                            </div>
                            <!-- Column -->
                            <!-- Column -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Product C Sales</h4>
                                        <div class="d-flex flex-row">
                                            <div class="p-2 border-right">
                                                <h6 class="font-weight-light">Montly</h6><b>20.40%</b>
                                            </div>
                                            <div class="p-2">
                                                <h6 class="font-weight-light">Daily</h6><b>5.40%</b>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="spark3" class="sparkchart"><canvas style="display: inline-block; width: 248.65px; height: 50px; vertical-align: top;" width="248" height="50"></canvas></div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                        <!-- Row -->
                        <!-- Row -->
                        <div class="row">
                            <!-- Column -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="d-flex flex-wrap">
                                                    <div>
                                                        <h3 class="card-title">Sales Overview</h3>
                                                        <h6 class="card-subtitle">Ample Admin Vs Pixel Admin</h6>
                                                    </div>
                                                    <div class="ml-auto">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item px-2">
                                                                <h6 class="text-success"><i class="fa fa-circle font-10 mr-2"></i>Ample</h6>
                                                            </li>
                                                            <li class="list-inline-item px-2">
                                                                <h6 class=" text-info"><i class="fa fa-circle font-10 mr-2"></i>Pixel</h6>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="amp-pxl" style="height: 360px;"><div class="chartist-tooltip"></div><svg ct="http://gionkunz.github.com/chartist-js/ct" width="100%" height="100%" class="ct-chart-bar" style="width: 100%; height: 100%;"><g class="ct-grids"><line y1="325" y2="325" x1="50" x2="794.3333129882812" class="ct-grid ct-vertical"></line><line y1="263" y2="263" x1="50" x2="794.3333129882812" class="ct-grid ct-vertical"></line><line y1="201" y2="201" x1="50" x2="794.3333129882812" class="ct-grid ct-vertical"></line><line y1="139" y2="139" x1="50" x2="794.3333129882812" class="ct-grid ct-vertical"></line><line y1="77" y2="77" x1="50" x2="794.3333129882812" class="ct-grid ct-vertical"></line><line y1="15" y2="15" x1="50" x2="794.3333129882812" class="ct-grid ct-vertical"></line></g><g><g class="ct-series ct-series-a"><line x1="95.66666521344865" x2="95.66666521344865" y1="325" y2="101.80000000000001" class="ct-bar" value="9"></line><line x1="201.99999564034596" x2="201.99999564034596" y1="325" y2="201" class="ct-bar" value="5"></line><line x1="308.33332606724326" x2="308.33332606724326" y1="325" y2="250.6" class="ct-bar" value="3"></line><line x1="414.6666564941406" x2="414.6666564941406" y1="325" y2="151.4" class="ct-bar" value="7"></line><line x1="520.9999869210379" x2="520.9999869210379" y1="325" y2="201" class="ct-bar" value="5"></line><line x1="627.3333173479353" x2="627.3333173479353" y1="325" y2="77" class="ct-bar" value="10"></line><line x1="733.6666477748327" x2="733.6666477748327" y1="325" y2="250.6" class="ct-bar" value="3"></line></g><g class="ct-series ct-series-b"><line x1="110.66666521344865" x2="110.66666521344865" y1="325" y2="176.2" class="ct-bar" value="6"></line><line x1="216.99999564034596" x2="216.99999564034596" y1="325" y2="250.6" class="ct-bar" value="3"></line><line x1="323.33332606724326" x2="323.33332606724326" y1="325" y2="101.80000000000001" class="ct-bar" value="9"></line><line x1="429.6666564941406" x2="429.6666564941406" y1="325" y2="201" class="ct-bar" value="5"></line><line x1="535.9999869210379" x2="535.9999869210379" y1="325" y2="225.8" class="ct-bar" value="4"></line><line x1="642.3333173479353" x2="642.3333173479353" y1="325" y2="176.2" class="ct-bar" value="6"></line><line x1="748.6666477748327" x2="748.6666477748327" y1="325" y2="225.8" class="ct-bar" value="4"></line></g></g><g class="ct-labels"><foreignObject style="overflow: visible;" x="50" y="330" width="106.33333042689732" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 106px; height: 20px;">Mon</span></foreignObject><foreignObject style="overflow: visible;" x="156.3333304268973" y="330" width="106.33333042689732" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 106px; height: 20px;">Tue</span></foreignObject><foreignObject style="overflow: visible;" x="262.6666608537946" y="330" width="106.33333042689733" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 106px; height: 20px;">Wed</span></foreignObject><foreignObject style="overflow: visible;" x="368.999991280692" y="330" width="106.3333304268973" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 106px; height: 20px;">Thu</span></foreignObject><foreignObject style="overflow: visible;" x="475.3333217075893" y="330" width="106.33333042689736" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 106px; height: 20px;">Fri</span></foreignObject><foreignObject style="overflow: visible;" x="581.6666521344866" y="330" width="106.3333304268973" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 106px; height: 20px;">Sat</span></foreignObject><foreignObject style="overflow: visible;" x="687.999982561384" y="330" width="106.3333304268973" height="20"><span class="ct-label ct-horizontal ct-end" xmlns="http://www.w3.org/2000/xmlns/" style="width: 106px; height: 20px;">Sun</span></foreignObject><foreignObject style="overflow: visible;" y="263" x="10" height="62" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 62px; width: 30px;">0</span></foreignObject><foreignObject style="overflow: visible;" y="201" x="10" height="62" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 62px; width: 30px;">2.5</span></foreignObject><foreignObject style="overflow: visible;" y="139" x="10" height="62" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 62px; width: 30px;">5</span></foreignObject><foreignObject style="overflow: visible;" y="77" x="10" height="62" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 62px; width: 30px;">7.5</span></foreignObject><foreignObject style="overflow: visible;" y="15" x="10" height="62" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 62px; width: 30px;">10</span></foreignObject><foreignObject style="overflow: visible;" y="-15" x="10" height="30" width="30"><span class="ct-label ct-vertical ct-start" xmlns="http://www.w3.org/2000/xmlns/" style="height: 30px; width: 30px;">12.5</span></foreignObject></g></svg></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h3 class="card-title">Product Sales</h3>
                                        <div id="visitor" class="mt-2 c3" style="height: 280px; width: 100%; max-height: 280px; position: relative;"><svg style="overflow: hidden;" width="348" height="280"><defs><clipPath id="c3-1610202755757-clip"><rect width="348" height="256"></rect></clipPath><clipPath id="c3-1610202755757-clip-xaxis"><rect x="-31" y="-20" width="410" height="40"></rect></clipPath><clipPath id="c3-1610202755757-clip-yaxis"><rect x="-29" y="-4" width="20" height="280"></rect></clipPath><clipPath id="c3-1610202755757-clip-grid"><rect width="348" height="256"></rect></clipPath><clipPath id="c3-1610202755757-clip-subchart"><rect width="348" height="0"></rect></clipPath></defs><g transform="translate(0.5,4.5)"><text class="c3-text c3-empty" text-anchor="middle" dominant-baseline="middle" x="174" y="128" style="opacity: 0;"></text><g clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip)" class="c3-regions" style="visibility: hidden;"></g><g clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip-grid)" class="c3-grid" style="visibility: hidden;"><g class="c3-xgrid-focus"><line class="c3-xgrid-focus" x1="-10" x2="-10" y1="0" y2="256" style="visibility: hidden;"></line></g></g><g clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip)" class="c3-chart"><g class="c3-stanford-elements"><g class="c3-stanford-lines" style="shape-rendering: geometricprecision;"></g><g class="c3-stanford-texts"></g><g class="c3-stanford-regions"></g></g><g class="c3-event-rects" style="fill-opacity: 0;"><rect class="c3-event-rect" x="0" y="0" width="348" height="256"></rect></g><g class="c3-chart-bars"><g class="c3-chart-bar c3-target c3-target-Other" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-Other c3-bars c3-bars-Other" style="cursor: pointer;"></g></g><g class="c3-chart-bar c3-target c3-target-Desktop" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-Desktop c3-bars c3-bars-Desktop" style="cursor: pointer;"></g></g><g class="c3-chart-bar c3-target c3-target-Tablet" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-Tablet c3-bars c3-bars-Tablet" style="cursor: pointer;"></g></g><g class="c3-chart-bar c3-target c3-target-Mobile" style="pointer-events: none;"><g class=" c3-shapes c3-shapes-Mobile c3-bars c3-bars-Mobile" style="cursor: pointer;"></g></g></g><g class="c3-chart-lines"><g class="c3-chart-line c3-target c3-target-Other" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-Other c3-lines c3-lines-Other"></g><g class=" c3-shapes c3-shapes-Other c3-areas c3-areas-Other"></g><g class=" c3-selected-circles c3-selected-circles-Other"></g><g class=" c3-shapes c3-shapes-Other c3-circles c3-circles-Other" style="cursor: pointer;"></g></g><g class="c3-chart-line c3-target c3-target-Desktop" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-Desktop c3-lines c3-lines-Desktop"></g><g class=" c3-shapes c3-shapes-Desktop c3-areas c3-areas-Desktop"></g><g class=" c3-selected-circles c3-selected-circles-Desktop"></g><g class=" c3-shapes c3-shapes-Desktop c3-circles c3-circles-Desktop" style="cursor: pointer;"></g></g><g class="c3-chart-line c3-target c3-target-Tablet" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-Tablet c3-lines c3-lines-Tablet"></g><g class=" c3-shapes c3-shapes-Tablet c3-areas c3-areas-Tablet"></g><g class=" c3-selected-circles c3-selected-circles-Tablet"></g><g class=" c3-shapes c3-shapes-Tablet c3-circles c3-circles-Tablet" style="cursor: pointer;"></g></g><g class="c3-chart-line c3-target c3-target-Mobile" style="opacity: 1; pointer-events: none;"><g class=" c3-shapes c3-shapes-Mobile c3-lines c3-lines-Mobile"></g><g class=" c3-shapes c3-shapes-Mobile c3-areas c3-areas-Mobile"></g><g class=" c3-selected-circles c3-selected-circles-Mobile"></g><g class=" c3-shapes c3-shapes-Mobile c3-circles c3-circles-Mobile" style="cursor: pointer;"></g></g></g><g class="c3-chart-arcs" transform="translate(174,123)"><text class="c3-chart-arcs-title" style="text-anchor: middle; opacity: 1;">Yearly Sales</text><g class="c3-chart-arc c3-target c3-target-Other"><g class=" c3-shapes c3-shapes-Other c3-arcs c3-arcs-Other"><path class=" c3-shape c3-shape c3-arc c3-arc-Other" style="fill: rgb(236, 239, 241); cursor: pointer;" transform="" d="M-109.2566479577907,41.43558105092031A116.85,116.85,0,0,1,-54.30290265331442,-103.46553659757754L-45.008439212439036,-85.75641608451335A96.85,96.85,0,0,0,-90.55632310408241,34.343483310069594Z"></path></g><text dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" class="" transform="translate(-87.40531836623258,-33.14846484073623)"></text></g><g class="c3-chart-arc c3-target c3-target-Desktop"><g class=" c3-shapes c3-shapes-Desktop c3-arcs c3-arcs-Desktop"><path class=" c3-shape c3-shape c3-arc c3-arc-Desktop" style="fill: rgb(116, 90, 242); cursor: pointer;" transform="" d="M-54.30290265331442,-103.46553659757754A116.85,116.85,0,0,1,-1.2524864511401484e-13,-116.85L-1.0381113632257028e-13,-96.85A96.85,96.85,0,0,0,-45.008439212439036,-85.75641608451335Z"></path></g><text dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" class="" transform="translate(-22.371228297600982,-90.76364109298733)"></text></g><g class="c3-chart-arc c3-target c3-target-Tablet"><g class=" c3-shapes c3-shapes-Tablet c3-arcs c3-arcs-Tablet"><path class=" c3-shape c3-shape c3-arc c3-arc-Tablet" style="fill: rgb(38, 198, 218); cursor: pointer;" transform="" d="M77.48588261543694,87.46348092379313A116.85,116.85,0,0,1,-109.2566479577907,41.43558105092031L-90.55632310408241,34.343483310069594A96.85,96.85,0,0,0,64.22342945062103,72.49326596037112Z"></path></g><text dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" class="" transform="translate(-22.371228297600872,90.76364109298734)"></text></g><g class="c3-chart-arc c3-target c3-target-Mobile"><g class=" c3-shapes c3-shapes-Mobile c3-arcs c3-arcs-Mobile"><path class=" c3-shape c3-shape c3-arc c3-arc-Mobile" style="fill: rgb(30, 136, 229); cursor: pointer;" transform="" d="M7.154998924018411e-15,-116.85A116.85,116.85,0,0,1,77.48588261543694,87.46348092379313L64.22342945062103,72.49326596037112A96.85,96.85,0,0,0,5.930352124871058e-15,-96.85Z"></path></g><text dy=".35em" style="opacity: 1; text-anchor: middle; pointer-events: none;" class="" transform="translate(87.40531836623258,-33.14846484073624)"></text></g></g><g class="c3-chart-texts"><g class="c3-chart-text c3-target c3-target-Other  " style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-Other"></g></g><g class="c3-chart-text c3-target c3-target-Desktop  " style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-Desktop"></g></g><g class="c3-chart-text c3-target c3-target-Tablet  " style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-Tablet"></g></g><g class="c3-chart-text c3-target c3-target-Mobile  " style="opacity: 1; pointer-events: none;"><g class=" c3-texts c3-texts-Mobile"></g></g></g></g><g clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip-grid)" class="c3-grid c3-grid-lines"><g class="c3-xgrid-lines"></g><g class="c3-ygrid-lines"></g></g><g class="c3-axis c3-axis-x" clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip-xaxis)" transform="translate(0,256)" style="visibility: visible; opacity: 0;"><text class="c3-axis-x-label" transform="" style="text-anchor: end;" x="348" dx="-0.5em" dy="-0.5em"></text><g class="tick" style="opacity: 1;" transform="translate(174, 0)"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><path class="domain" d="M0,6V0H348V6"></path></g><g class="c3-axis c3-axis-y" clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip-yaxis)" transform="translate(0,0)" style="visibility: visible; opacity: 0;"><text class="c3-axis-y-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="1.2em"></text><g class="tick" style="opacity: 1;" transform="translate(0,235)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">10</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,209)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">15</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,182)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">20</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,156)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">25</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,129)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">30</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,102)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">35</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,76)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">40</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,49)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">45</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,23)"><line x2="-6"></line><text x="-9" y="0" style="text-anchor: end;"><tspan x="-9" dy="3">50</tspan></text></g><path class="domain" d="M-6,1H0V256H-6"></path></g><g class="c3-axis c3-axis-y2" transform="translate(348,0)" style="visibility: hidden; opacity: 0;"><text class="c3-axis-y2-label" transform="rotate(-90)" style="text-anchor: end;" x="0" dx="-0.5em" dy="-0.5em"></text><g class="tick" style="opacity: 1;" transform="translate(0,256)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,231)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.1</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,205)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.2</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,180)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.3</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,154)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.4</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,129)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.5</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,103)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.6</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,78)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.7</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,52)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.8</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,27)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">0.9</tspan></text></g><g class="tick" style="opacity: 1;" transform="translate(0,1)"><line x2="6"></line><text x="9" y="0" style="text-anchor: start;"><tspan x="9" dy="3">1</tspan></text></g><path class="domain" d="M6,1H0V256H6"></path></g></g><g transform="translate(0.5,280.5)" style="visibility: hidden;"><g clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip-subchart)" class="c3-chart"><g class="c3-chart-bars"></g><g class="c3-chart-lines"></g></g><g clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip)" class="c3-brush" fill="none" pointer-events="all"><rect class="overlay" pointer-events="all" cursor="crosshair" x="0" y="0" width="356.9000244140625" height="0"></rect><rect class="selection" cursor="move" fill="#777" fill-opacity="0.3" stroke="#fff" shape-rendering="crispEdges" style="display: none;"></rect><rect class="handle handle--w" cursor="ew-resize" style="display: none;"></rect><rect class="handle handle--e" cursor="ew-resize" style="display: none;"></rect></g><g class="c3-axis-x" transform="translate(0,0)" clip-path="url(https://wrappixel.com/demos/admin-templates/materialpro-bootstrap-latest/material-pro/src/minisidebar/index6.html#c3-1610202755757-clip-xaxis)" style="opacity: 0;"><g class="tick" style="opacity: 1;" transform="translate(174, 0)"><line x1="0" x2="0" y2="6"></line><text x="0" y="9" transform="" style="text-anchor: middle; display: block;"><tspan x="0" dy=".71em" dx="0">0</tspan></text></g><path class="domain" d="M0,6V0H348V6"></path></g></g><g transform="translate(0,260)"><g class="c3-legend-item c3-legend-item-Other" style="visibility: hidden; cursor: pointer;"><text style="pointer-events: none;" x="14" y="9">Other</text><rect class="c3-legend-item-event" style="fill-opacity: 0;" x="0" y="-5" width="0" height="0"></rect><line class="c3-legend-item-tile" style="stroke: rgb(236, 239, 241); pointer-events: none;" x1="-2" y1="4" x2="8" y2="4" stroke-width="10"></line></g><g class="c3-legend-item c3-legend-item-Desktop" style="visibility: hidden; cursor: pointer;"><text style="pointer-events: none;" x="14" y="9">Desktop</text><rect class="c3-legend-item-event" style="fill-opacity: 0;" x="0" y="-5" width="0" height="0"></rect><line class="c3-legend-item-tile" style="stroke: rgb(116, 90, 242); pointer-events: none;" x1="-2" y1="4" x2="8" y2="4" stroke-width="10"></line></g><g class="c3-legend-item c3-legend-item-Tablet" style="visibility: hidden; cursor: pointer;"><text style="pointer-events: none;" x="14" y="9">Tablet</text><rect class="c3-legend-item-event" style="fill-opacity: 0;" x="0" y="-5" width="0" height="0"></rect><line class="c3-legend-item-tile" style="stroke: rgb(38, 198, 218); pointer-events: none;" x1="-2" y1="4" x2="8" y2="4" stroke-width="10"></line></g><g class="c3-legend-item c3-legend-item-Mobile" style="visibility: hidden; cursor: pointer;"><text style="pointer-events: none;" x="14" y="9">Mobile</text><rect class="c3-legend-item-event" style="fill-opacity: 0;" x="0" y="-5" width="0" height="0"></rect><line class="c3-legend-item-tile" style="stroke: rgb(30, 136, 229); pointer-events: none;" x1="-2" y1="4" x2="8" y2="4" stroke-width="10"></line></g></g><text class="c3-title" x="174" y="0"></text></svg><div class="c3-tooltip-container" style="position: absolute; pointer-events: none; display: none;"></div></div>
                                    </div>
                                    <div class="card-body text-center border-top">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item px-2">
                                                <h6 class="text-info"><i class="fa fa-circle font-10 mr-2"></i>Mobile
                                                </h6>
                                            </li>
                                            <li class="list-inline-item px-2">
                                                <h6 class=" text-primary"><i class="fa fa-circle font-10 mr-2"></i>Desktop</h6>
                                            </li>
                                            <li class="list-inline-item px-2">
                                                <h6 class=" text-success"><i class="fa fa-circle font-10 mr-2"></i>Tablet</h6>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-lg-6 col-md-12">
                                <div class="card bg-success">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="mr-3 align-self-center">
                                                <h1 class="text-white"><i class="icon-cloud-download"></i></h1>
                                            </div>
                                            <div>
                                                <h3 class="card-title text-white">Download count</h3>
                                                <h6 class="card-subtitle text-white op-5">March 2020</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4 align-self-center">
                                                <h2 class="font-weight-light text-white text-nowrap text-truncate">35487
                                                </h2>
                                            </div>
                                            <div class="col-8 pt-2 pb-3 text-right">
                                                <div class="spark-count" style="height:65px"><canvas style="display: inline-block; width: 146px; height: 70px; vertical-align: top;" width="146" height="70"></canvas></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <img class="" src="assets/weatherbg.jpg" alt="Card image cap">
                                    <div class="card-img-overlay" style="height:110px;">
                                        <div class="d-flex align-items-center">
                                            <h3 class="card-title text-white mb-0">New Delhi</h3>
                                            <div class="ml-auto">
                                                <small class="card-text text-white font-weight-light">Sunday 15
                                                    march</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body weather-small">
                                        <div class="row">
                                            <div class="col-8 border-right align-self-center">
                                                <div class="d-flex">
                                                    <div class="display-6 text-info"><i class="wi wi-day-rain-wind"></i>
                                                    </div>
                                                    <div class="ml-3">
                                                        <h1 class="font-weight-light text-info mb-0">32<sup>0</sup></h1>
                                                        <small>Sunny Rainy day</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 text-center">
                                                <h1 class="font-weight-light mb-0">25<sup>0</sup></h1>
                                                <small>Tonight</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">Product Overview</h4>
                                        <div class="card-actions ml-auto">
                                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                            <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body collapse show">
                                        <div class="table-responsive no-wrap">
                                            <table class="table product-overview v-middle">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0">Customer</th>
                                                        <th class="border-0">Photo</th>
                                                        <th class="border-0">Quantity</th>
                                                        <th class="border-0">Date</th>
                                                        <th class="border-0">Status</th>
                                                        <th class="border-0">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Steave Jobs</td>
                                                        <td>
                                                            <img src="assets/chair.jpg" alt="iMac" width="80">
                                                        </td>
                                                        <td>20</td>
                                                        <td>10-7-2020</td>
                                                        <td>
                                                            <span class="px-2 py-1 badge badge-success font-weight-100">Paid</span>
                                                        </td>
                                                        <td><a href="javascript:void(0)" class="text-muted pr-2" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-muted" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Varun Dhavan</td>
                                                        <td>
                                                            <img src="assets/chair2.jpg" alt="iPhone" width="80">
                                                        </td>
                                                        <td>25</td>
                                                        <td>09-7-2020</td>
                                                        <td>
                                                            <span class="px-2 py-1 badge badge-warning font-weight-100">Pending</span>
                                                        </td>
                                                        <td><a href="javascript:void(0)" class="text-muted pr-2" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-muted" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Ritesh Desh</td>
                                                        <td>
                                                            <img src="assets/chair3.jpg" alt="apple_watch" width="80">
                                                        </td>
                                                        <td>12</td>
                                                        <td>08-7-2020</td>
                                                        <td>
                                                            <span class="px-2 py-1 badge badge-success font-weight-100">Paid</span>
                                                        </td>
                                                        <td><a href="javascript:void(0)" class="text-muted pr-2" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-muted" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Hrithik</td>
                                                        <td>
                                                            <img src="assets/chair4.jpg" alt="mac_mouse" width="80">
                                                        </td>
                                                        <td>18</td>
                                                        <td>02-7-2020</td>
                                                        <td>
                                                            <span class="px-2 py-1 badge badge-danger font-weight-100">Failed</span>
                                                        </td>
                                                        <td><a href="javascript:void(0)" class="text-muted pr-2" data-toggle="tooltip" title="" data-original-title="Edit"><i class="ti-marker-alt"></i></a> <a href="javascript:void(0)" class="text-muted" title="" data-toggle="tooltip" data-original-title="Delete"><i class="ti-trash"></i></a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Column -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        <!-- Column -->
                        <div class="card earning-widget">
                            <div class="card-header d-flex align-items-center">
                                <h4 class="card-title mb-0">Earning</h4>
                                <div class="card-actions ml-auto">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                    <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                                </div>
                            </div>
                            <div class="card-body border-top collapse show table-responsive no-wrap">
                                <table class="table v-middle table-borderless">
                                    <tbody>
                                        <tr>
                                            <td style="width:40px"><img src="assets/1.jpg" class="rounded-circle" alt="logo" width="50"></td>
                                            <td>Andrew</td>
                                            <td align="right"><span class="badge px-2 py-1 badge-light-info text-info">$2300</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="assets/2.jpg" class="rounded-circle" alt="logo" width="50"></td>
                                            <td>Kristeen</td>
                                            <td align="right"><span class="badge px-2 py-1 badge-light-success text-success">$3300</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="assets/3.jpg" class="rounded-circle" alt="logo" width="50"></td>
                                            <td>Dany John</td>
                                            <td align="right"><span class="badge px-2 py-1 badge-light-primary text-primary">$4300</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="assets/4.jpg" class="rounded-circle" alt="logo" width="50"></td>
                                            <td>Chris gyle</td>
                                            <td align="right"><span class="badge px-2 py-1 badge-light-warning text-warning">$5300</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="assets/5.jpg" class="rounded-circle" alt="logo" width="50"></td>
                                            <td>Prabhas</td>
                                            <td align="right"><span class="badge px-2 py-1 badge-light-danger text-danger">$4567</span></td>
                                        </tr>
                                        <tr>
                                            <td><img src="assets/6.jpg" class="rounded-circle" alt="logo" width="50"></td>
                                            <td>Bahubali</td>
                                            <td align="right"><span class="badge px-2 py-1 badge-light-megna text-megna">$7889</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4 class="card-title mb-0">Discount</h4>
                                <div class="card-actions ml-auto">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                    <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                                </div>
                            </div>
                            <div class="card-body collapse show bg-info">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item flex-column">
                                            <i class="fa fa-shopping-cart fa-2x text-white"></i>
                                            <p class="text-white">25th Jan</p>
                                            <h3 class="text-white font-weight-light">Now Get <span class="font-bold">50%
                                                    Off</span><br>
                                                on buy</h3>
                                            <div class="text-white mt-3">
                                                <i>- Ecommerce site</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <i class="fa fa-shopping-cart fa-2x text-white"></i>
                                            <p class="text-white">25th Jan</p>
                                            <h3 class="text-white font-weight-light">Now Get <span class="font-bold">50%
                                                    Off</span><br>
                                                on buy</h3>
                                            <div class="text-white mt-3">
                                                <i>- Ecommerce site</i>
                                            </div>
                                        </div>
                                        <div class="carousel-item flex-column active">
                                            <i class="fa fa-shopping-cart fa-2x text-white"></i>
                                            <p class="text-white">25th Jan</p>
                                            <h3 class="text-white font-weight-light">Now Get <span class="font-bold">50%
                                                    Off</span><br>
                                                on buy</h3>
                                            <div class="text-white mt-3">
                                                <i>- Ecommerce site</i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <!-- Column -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4 class="card-title mb-0">Monthly Wineer</h4>
                                <div class="card-actions ml-auto">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                    <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                                </div>
                            </div>
                            <div class="card-body collapse show border-top">
                                <div class="mt-3 text-center"> <img src="assets/5.jpg" class="rounded-circle" width="150">
                                    <h4 class="card-title mt-2">Hanna Gover</h4>
                                    <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i>
                                                <font class="font-medium">254</font>
                                            </a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i>
                                                <font class="font-medium">54</font>
                                            </a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Column -->
                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <h4 class="card-title mb-0">New items</h4>
                                <div class="card-actions ml-auto">
                                    <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                                    <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                                    <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                                </div>
                            </div>
                            <div class="card-body p-0 collapse show text-center">
                                <div id="myCarousel2" class="carousel slide" data-ride="carousel">
                                    <!-- Carousel items -->
                                    <div class="carousel-inner">
                                        <div class="carousel-item flex-column">
                                            <img src="assets/chair.jpg" alt="user">
                                            <h4 class="mb-4">Brand New Chair</h4>
                                        </div>
                                        <div class="carousel-item flex-column active">
                                            <img src="assets/chair2.jpg" alt="user">
                                            <h4 class="mb-4">Brand New Chair</h4>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <img src="assets/chair3.jpg" alt="user">
                                            <h4 class="mb-4">Brand New Chair</h4>
                                        </div>
                                        <div class="carousel-item flex-column">
                                            <img src="assets/chair4.jpg" alt="user">
                                            <h4 class="mb-4">Brand New Chair</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2020 Material Pro Admin by wrappixel.com
            </footer>
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
    <aside class="customizer">
        <a href="javascript:void(0)" class="service-panel-toggle"><i class="fa fa-spin fa-cog"></i></a>
        <div class="customizer-body ps-container ps-theme-default ps-active-y" data-ps-id="94662a79-4abf-6b0d-8f72-13ab632afb54">
            <ul class="nav customizer-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"><i class="mdi mdi-wrench font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#chat" role="tab" aria-controls="chat" aria-selected="false"><i class="mdi mdi-message-reply font-20"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false"><i class="mdi mdi-star-circle font-20"></i></a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <!-- Tab 1 -->
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="p-3 border-bottom">
                        <!-- Sidebar -->
                        <h5 class="font-medium mb-2 mt-2">Layout Settings</h5>
                        <div class="checkbox checkbox-info mt-3">
                            <input type="checkbox" name="theme-view" class="material-inputs" id="theme-view">
                            <label for="theme-view"> <span>Dark Theme</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" class="sidebartoggler material-inputs" name="collapssidebar" id="collapssidebar">
                            <label for="collapssidebar"> <span>Collapse Sidebar</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="sidebar-position" class="material-inputs" id="sidebar-position" checked="checked">
                            <label for="sidebar-position"> <span>Fixed Sidebar</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="header-position" class="material-inputs" id="header-position" checked="checked">
                            <label for="header-position"> <span>Fixed Header</span> </label>
                        </div>
                        <div class="checkbox checkbox-info mt-2">
                            <input type="checkbox" name="boxed-layout" class="material-inputs" id="boxed-layout">
                            <label for="boxed-layout"> <span>Boxed Layout</span> </label>
                        </div> 
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium mb-2 mt-2">Logo Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin1"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin2"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin3"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin4"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin5"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-logobg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Navbar BG -->
                        <h5 class="font-medium mb-2 mt-2">Navbar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin1"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin2"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin3"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin4"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin5"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-navbarbg="skin6"></a></li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-3 border-bottom">
                        <!-- Logo BG -->
                        <h5 class="font-medium mb-2 mt-2">Sidebar Backgrounds</h5>
                        <ul class="theme-color m-0 p-0">
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin1"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin2"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin3"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin4"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin5"></a></li>
                            <li class="theme-item list-inline-item mr-1"><a href="javascript:void(0)" class="theme-link rounded-circle d-block" data-sidebarbg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
                <!-- End Tab 1 -->
                <!-- Tab 2 -->
                <div class="tab-pane fade" id="chat" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <ul class="mailbox list-style-none mt-3">
                        <li>
                            <div class="message-center chat-scroll position-relative ps-container ps-theme-default" data-ps-id="d2f5446c-492a-35a0-0fa1-0611f0039b93">
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_1" data-user-id="1">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/1.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle online"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:30 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_2" data-user-id="2">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/2.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle busy"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Sonu Nigam</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">I've sung a song! See you at</span> <span class="font-12 text-nowrap d-block text-muted">9:10 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_3" data-user-id="3">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/3.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle away"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Arijit Sinh</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">I am a singer!</span> <span class="font-12 text-nowrap d-block text-muted">9:08 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_4" data-user-id="4">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/4.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Nirav Joshi</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_5" data-user-id="5">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/5.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Sunil Joshi</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_6" data-user-id="6">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/6.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Akshay Kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_7" data-user-id="7">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/7.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Pavan kumar</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                                <!-- Message -->
                                <a href="javascript:void(0)" class="message-item d-flex align-items-center border-bottom px-3 py-2" id="chat_user_8" data-user-id="8">
                                    <span class="user-img position-relative d-inline-block"> <img src="assets/8.jpg" alt="user" class="rounded-circle w-100"> <span class="profile-status rounded-circle offline"></span> </span>
                                    <div class="w-75 d-inline-block v-middle pl-2">
                                        <h5 class="message-title mb-0 mt-1">Varun Dhavan</h5> <span class="font-12 text-nowrap d-block text-muted text-truncate">Just see the my admin!</span> <span class="font-12 text-nowrap d-block text-muted">9:02 AM</span> </div>
                                </a>
                                <!-- Message -->
                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
                        </li>
                    </ul>
                </div>
                <!-- End Tab 2 -->
                <!-- Tab 3 -->
                <div class="tab-pane fade p-3" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <h6 class="mt-3 mb-3">Activity Timeline</h6>
                    <div class="steamline">
                        <div class="sl-item">
                            <div class="sl-left bg-success"> <i class="ti-user"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="assets/2.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="assets/1.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-primary"> <i class="ti-user"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Meeting today <span class="sl-date"> 5pm</span></div>
                                <div class="desc">you can write anything </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left bg-info"><i class="fas fa-image"></i></div>
                            <div class="sl-right">
                                <div class="font-medium">Send documents to Clark</div>
                                <div class="desc">Lorem Ipsum is simply </div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="assets/4.jpg"> </div>
                            <div class="sl-right">
                                <div class="font-medium">Go to the Doctor <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Contrary to popular belief</div>
                            </div>
                        </div>
                        <div class="sl-item">
                            <div class="sl-left"> <img class="rounded-circle" alt="user" src="assets/6.jpg"> </div>
                            <div class="sl-right">
                                <div><a href="javascript:void(0)">Stephen</a> <span class="sl-date">5 minutes ago</span>
                                </div>
                                <div class="desc">Approve meeting with tiger</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Tab 3 -->
            </div>
        <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 568px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 563px;"></div></div></div>
    </aside>
    <div class="chat-windows hide-chat"></div>




<?php include "sys.footer.php";?>