
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar ps-container ps-theme-default ps-active-y" data-ps-id="e68914b7-815e-2188-9980-e5b2f4acf489">
                <!-- User profile -->
                <div class="user-profile position-relative" style="background-color: #b5b7bf;">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../../asset/emp_photos/<?php echo $avatar; ?>.png" alt="user" class="w-100"> </div>
                    <!-- User profile text-->
                    <div class="profile-text pt-1"> 
                        <a href="#" class="dropdown-toggle u-dropdown w-100 text-white d-block position-relative" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $username; ?> <?php echo $nama; ?></a>
                        <div class="dropdown-menu animated flipInY"> 
                            <a href="../hrm{sys=emp.profile}" class="dropdown-item"><i class="fa fa-user"></i>
                                My Profile</a> 
                            
                            <div class="dropdown-divider"></div> 
                            <a href="../../application/logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
                <!-- End User profile text-->
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav" class="in">
                      
                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false">


                        <div class="menu-round">

                        
                        <svg-icon class="main-menu" _nghost-c1=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45.99 45.99" style="width: 24px; height: 24px; fill: rgb(255, 255, 255);"><defs><style>.cls-1{fill:none;stroke:#FFF;stroke-width:2;stroke-miterlimit:10;}</style></defs><title>Icons Great Day New</title><g id="CONTENT">
                        <path class="cls-1" d="M30.49,6.81v5a4.29,4.29,0,0,0,4.29,4.29h4.29"></path>

                        <path class="cls-1" d="M39.2,15.77V34.71a4.49,4.49,0,0,1-4.49,4.49H11.27a4.5,4.5,0,0,1-4.49-4.49V11.27a4.49,4.49,0,0,1,4.49-4.49H30.46Z"></path>

                        <polyline class="cls-1" points="32.76 19.7 27.98 24.47 21.11 17.59 13.21 25.49"></polyline><line class="cls-1" x1="13.75" y1="34.17" x2="13.75" y2="29.67"></line><line class="cls-1" x1="17.55" y1="34.17" x2="17.55" y2="27.18"></line><line class="cls-1" x1="25.15" y1="34.17" x2="25.15" y2="27.18"></line><line class="cls-1" x1="21.35" y1="34.17" x2="21.35" y2="23.61"></line><line class="cls-1" x1="28.95" y1="34.17" x2="28.95" y2="29.29"></line><line class="cls-1" x1="32.76" y1="34.17" x2="32.76" y2="26.1"></line></g></svg></svg-icon>
                        </div>


                        <span class="hide-menu">&nbsp;&nbsp;Employee </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="../hrm{sys=emp.inf}" class="sidebar-link"><span class="hide-menu"> Employee Information </span></a></li>
                                <li class="sidebar-item"><a href="../hrm{sys=emp.dashboard}" class="sidebar-link"><span class="hide-menu"> Employee Dashboard </span></a></li>
                                <!-- <li class="sidebar-item"><a href="#" class="sidebar-link"><span class="hide-menu"> Employee Request </span></a></li> -->
                            </ul>
                        </li>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false">
                            
                        
                        <div class="menu-round">
                        <svg-icon class="main-menu" _nghost-c1=""><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45.99 45.99" style="width: 24px; height: 24px; fill: rgb(255, 255, 255);"><defs><style>.cls-1{fill:none;stroke:#FFF;stroke-width:2;stroke-miterlimit:10;}</style></defs><title>Icons Great Day New</title><g id="CONTENT"><circle class="cls-1" cx="23.04" cy="26.02" r="16.21"></circle><path class="cls-1" d="M28.22,6.9l0,.07,11.4,7.22,0-.07A6.75,6.75,0,1,0,28.22,6.9Z"></path><path class="cls-1" d="M17.77,6.9l0,.07L6.4,14.19l0-.07A6.75,6.75,0,1,1,17.77,6.9Z"></path><polyline class="cls-1" points="22.82 20.22 22.82 27.61 29.14 31.28"></polyline></g></svg></svg-icon>
                        </div>

                       <span class="hide-menu">&nbsp;&nbsp;Time & Attendance </span></a>
                            <ul aria-expanded="false" class="collapse  first-level">
                                <li class="sidebar-item"><a href="../hrm{sys=my.attendance}" class="sidebar-link"><span class="hide-menu"> Attendance Data </span></a></li>    
                                <li class="sidebar-item"><a href="../hrm{sys=time.attendance}" class="sidebar-link"><span class="hide-menu"> Leave Request </span></a></li>
                                <li class="sidebar-item"><a href="../hrm{sys=time.approval}" class="sidebar-link"><span class="hide-menu"> Leave Approval </span></a></li>
                                <li class="sidebar-item"><a href="../hrm{sys=leave.cancellation}" class="sidebar-link"><span class="hide-menu"> Leave Cancellation Request </span></a></li>
                                <li class="sidebar-item"><a href="../hrm{sys=leave.cancellation.approval}" class="sidebar-link"><span class="hide-menu"> Leave Cancellation Approval </span></a></li>
                            </ul>
                        </li>
                       </ul>
                </nav>
                <!-- End Sidebar navigation -->
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 448px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 62px;"></div></div></div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer" style="text-align: center;background-color: #079378;">
            <table width="100%">
                <td align="Center">
                <font color="white">Human Resource Information System</font>
                </td>
            </table>

            </div>
            <!-- End Bottom points-->
        </aside>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->