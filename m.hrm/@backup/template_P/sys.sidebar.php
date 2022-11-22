
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar ps-container ps-theme-default ps-active-y" data-ps-id="e68914b7-815e-2188-9980-e5b2f4acf489">
                <!-- User profile -->
                <!-- <div class="user-profile position-relative" style="background-color: #b5b7bf;"> -->
                <div class="user-profile position-relative" style="background: url(../../asset/img/dashboard.png) no-repeat;">

                
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="../../asset/emp_photos/<?php echo $avatar; ?>" alt="user" class="w-100"> </div>
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

                    <?php
                                           
                    $req_app 			= mysqli_fetch_array(mysqli_query($connect, "SELECT emp_no, 
                                                                                   REPLACE(GROUP_CONCAT(formula ORDER BY formula ASC SEPARATOR ','),',','`,`') AS formula 
                                                                                    FROM users_menu_access
                                                                                      WHERE 
                                                                                    emp_no = '$username'
                                                                                    GROUP BY emp_no"));
                    $var1 = array("`");
                    $var2 = array("'");
                    if($req_app){
                            $conversion_formula = str_replace($var1, $var2, $req_app['formula']);
                    } else {
                            $conversion_formula = "";
                    }
                                                                      
                    $forumla_used = "'".$conversion_formula."'";
                    ?>

                    <?php
					$menu = mysqli_query($connect, "SELECT * FROM hrmmenu where menu_id IN ($forumla_used) and submenu_id ='0' ORDER BY order_id ASC");
					while($dataMenu = mysqli_fetch_assoc($menu)){
						$menu_id = $dataMenu['menu_id'];
						$submenu = mysqli_query($connect,"SELECT * FROM hrmmenu WHERE submenu_id='$menu_id' and menu_id IN ($forumla_used) and is_active = '1' ORDER BY order_id ASC");
						?>

                        <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false">
                            <div class="menu-round">
                                <?php echo $dataMenu['svg_icon']; ?>
                            </div>


                        <span class="hide-menu">&nbsp;&nbsp;<?php echo $dataMenu['menu']; ?> </span></a>

                            <ul aria-expanded="false" class="collapse  first-level">
                                <?php 
                                $submenu = mysqli_query($connect,"SELECT * FROM hrmmenu WHERE submenu_id='$menu_id' and menu_id IN ($forumla_used) and is_active = '1' and ul_submenu_id ='0' ORDER BY order_id ASC");
                                while($dataSubmenu = mysqli_fetch_assoc($submenu)){
                                    $dataSubmenu_id = $dataSubmenu['menu_id'];
                                ?> 
                                <li class="sidebar-item">
                                    <a href="<?php echo $dataSubmenu['hyperlink']; ?>" class="sidebar-link"><?php echo $dataMenu['svg_icon']; ?> &nbsp;&nbsp; <span class="hide-menu"> <?php echo $dataSubmenu['menu']; ?> </span>
                                    </a>
                                
                                </li>
                                <?php } ?>

                                <?php 
                                $submenu = mysqli_query($connect,"SELECT * FROM hrmmenu WHERE submenu_id='$menu_id' and menu_id IN ($forumla_used) and is_active = '1' and ul_submenu_id <> '0' ORDER BY order_id ASC");
                                while($dataSubmenu = mysqli_fetch_assoc($submenu)){
                                    $dataSubmenu_id = $dataSubmenu['menu_id'];
                                ?>

                                

                                <li class="sidebar-item">
                                    <a class="has-arrow sidebar-link active" href="javascript:void(0)" aria-expanded="false"><?php echo $dataMenu['svg_icon']; ?> &nbsp; 
                                    <span class="hide-menu"><?php echo $dataSubmenu['menu']; ?></span></a>
                                    <ul aria-expanded="false" class="collapse second-level in">

                                    <?php 
                                    $ul_submenu = mysqli_query($connect,"SELECT * FROM hrmmenu WHERE menu_id <> '$dataSubmenu_id' and ul_submenu_id='$dataSubmenu_id' and menu_id IN ($forumla_used) and is_active = '1' ORDER BY order_id ASC");
                                    while($dataSubmenu_ulaa = mysqli_fetch_assoc($ul_submenu)){
                                    ?> 
                             

                                            
                                            <li class="sidebar-item">
                                                <a href="<?php echo $dataSubmenu_ulaa['hyperlink']; ?>" class="sidebar-link"><?php echo $dataSubmenu_ulaa['svg_icon']; ?>&nbsp;&nbsp; <span class="hide-menu"> <?php echo $dataSubmenu_ulaa['menu']; ?></span></a>
                                            </li>
                                        
                                   
                                  
                                    <?php } ?>

                                    </ul>
                                </li>
                                
                                <?php } ?>

                               

                            </ul>



                        </li>

                        <?php
                            }
                        ?>
                   
                

                       </ul>
                </nav>
                <!-- End Sidebar navigation -->
            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 448px; right: 3px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 62px;"></div></div></div>
            <!-- End Sidebar scroll-->
            <!-- Bottom points-->
            <div class="sidebar-footer" style="text-align: center;background-color: #079378;">
            <!-- <table width="100%">
                <td align="Center">
                <font color="white">Human Resource Information System</font>
                </td>
            </table> -->
            </div>
            <!-- End Bottom points-->
        </aside>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->