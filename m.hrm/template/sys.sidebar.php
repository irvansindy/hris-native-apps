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

