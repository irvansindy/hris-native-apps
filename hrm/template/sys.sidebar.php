<!-- ============================================================== -->
<!-- Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->
<?php
$req_app             = mysqli_fetch_array(mysqli_query($connect, "SELECT emp_no, 
                                                                                   REPLACE(GROUP_CONCAT(formula ORDER BY formula ASC SEPARATOR ','),',','`,`') AS formula 
                                                                                    FROM users_menu_access
                                                                                      WHERE 
                                                                                    emp_no = '$username'
                                                                                    GROUP BY emp_no"));
$var1 = array("`");
$var2 = array("'");
if ($req_app) {
    $conversion_formula = str_replace($var1, $var2, $req_app['formula']);
} else {
    $conversion_formula = "";
}

$forumla_used = "'" . $conversion_formula . "'";
?>

<?php
$menu = mysqli_query($connect, "SELECT * FROM hrmmenu where menu_id IN ($forumla_used) and submenu_id ='0' ORDER BY order_id ASC");
while ($dataMenu = mysqli_fetch_assoc($menu)) {
    $menu_id = $dataMenu['menu_id'];
    $submenu = mysqli_query($connect, "SELECT * FROM hrmmenu WHERE submenu_id='$menu_id' and menu_id IN ($forumla_used) and is_active = '1' ORDER BY order_id ASC");
?>

    <li class="sidebar-item"> <a onclick="RefreshPages();" class="sidebar-link has-arrow waves-effect waves-dark" aria-expanded="false">
            <div class="menu-round">
                <?php echo $dataMenu['svg_icon']; ?>
            </div>
            <span class="hide-menu" style="font-weight: bold;">&nbsp;&nbsp;<?php echo $dataMenu['menu']; ?> </span>
        </a>

        <ul aria-expanded="false" class="collapse  first-level">


            <?php
            $submenu = mysqli_query($connect, "SELECT * FROM hrmmenu WHERE submenu_id='$menu_id' and menu_id IN ($forumla_used) and is_active = '1' and ul_submenu_id ='0' ORDER BY order_id ASC");
            while ($dataSubmenu = mysqli_fetch_assoc($submenu)) {
                $dataSubmenu_id = $dataSubmenu['menu_id'];
            ?>
                <li class="sidebar-item">
                    <a onclick="RefreshPage<?php echo $dataSubmenu_id; ?>();" href="<?php echo $dataSubmenu['hyperlink']; ?>" class="sidebar-link"> &nbsp;&nbsp; <span class="hide-menu"> <?php echo $dataSubmenu['menu']; ?> </span>
                    </a>

                </li>
                <script>
                    function RefreshPage<?php echo $dataSubmenu_id; ?>() {
                        datatable.ajax.reload(null, true);

                        setTimeout(function() {
                            mymodalss.style.display = "none";
                            document.getElementById("msg").innerHTML = "Data refreshed";
                            return false;
                        }, 2000);

                        mymodalss.style.display = "block";
                        document.getElementById("msg").innerHTML = "Data refreshed";
                        return false;
                    }
                </script>
            <?php } ?>

            <?php
            $submenu = mysqli_query($connect, "SELECT * FROM hrmmenu WHERE submenu_id='$menu_id' and menu_id IN ($forumla_used) and is_active = '1' and ul_submenu_id <> '0' ORDER BY order_id ASC");
            while ($dataSubmenu = mysqli_fetch_assoc($submenu)) {
                $dataSubmenu_id = $dataSubmenu['menu_id'];
            ?>
                <li class="sidebar-item">
                    <a onclick="RefreshPage<?php echo $dataSubmenu_id; ?>();" class="has-arrow sidebar-link active" href="javascript:void(0)" aria-expanded="false"> &nbsp;
                        <span class="hide-menu"><?php echo $dataSubmenu['menu']; ?></span></a>
                    <ul aria-expanded="false" class="collapse second-level in">
                        <?php
                        $ul_submenu = mysqli_query($connect, "SELECT * FROM hrmmenu WHERE menu_id <> '$dataSubmenu_id' and ul_submenu_id='$dataSubmenu_id' and menu_id IN ($forumla_used) and is_active = '1' ORDER BY order_id ASC");
                        while ($dataSubmenu_ulaa = mysqli_fetch_assoc($ul_submenu)) {
                        ?>
                            <li class="sidebar-item">
                                <a onclick="RefreshPage<?php echo $dataSubmenu_id; ?>();" href="<?php echo $dataSubmenu_ulaa['hyperlink']; ?>" class="sidebar-link">&nbsp;&nbsp; <span class="hide-menu"> <?php echo $dataSubmenu_ulaa['menu']; ?></span></a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            
                <script>
                    function RefreshPage<?php echo $dataSubmenu_id; ?>() {
                        datatable.ajax.reload(null, true);

                        setTimeout(function() {
                            mymodalss.style.display = "none";
                            document.getElementById("msg").innerHTML = "Data refreshed";
                            return false;
                        }, 2000);

                        mymodalss.style.display = "block";
                        document.getElementById("msg").innerHTML = "Data refreshed";
                        return false;
                    }
                </script>

            <?php } ?>
        </ul>
    </li>
<?php
}
?>
</ul>
</nav>
<!-- End Sidebar navigation -->




</ul>
</nav>
</div>
<!-- End Sidebar scroll-->
</aside>

<style>
    /* //MOBILE */
    @media only screen and (max-width: 500px) {
        .mobile {
            background: grey;
        }

        .sidebar-nav ul {
            padding: 8px;
        }
    }

    /* //MOBILE */
    @media only screen and (max-width: 991px) {
        .mobile {
            background: grey;
        }

        .sidebar-nav ul {
            padding: 8px;
        }
    }

    /* //WEBSITE */
    @media (min-width: 991px) {
        .mobile {
            background: #259dd4;
        }
    }

    /* //WEBSITE */
    @media (min-width: 1080px) {
        .mobile {
            background: #259dd4;
        }
    }
</style>

<!-- ============================================================== -->
<!-- End Left Sidebar - style you can find in sidebar.scss  -->
<!-- ============================================================== -->

<?php
$get_auth = mysqli_fetch_array(mysqli_query($connect, "SELECT COUNT(*) as access FROM hrmmenu where menu_id IN ($forumla_used) and menu_id = '$page' ORDER BY order_id ASC"));
?>