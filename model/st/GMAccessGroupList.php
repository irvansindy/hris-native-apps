<?php 
if (isset($_POST["limit"], $_POST["start"])) {
       $page = $_POST["limit"];
       $limit = $_POST["start"];
} else {
       $page = 0;
       $limit = 10;
}

$qListRender = "SELECT 
                a.*

                FROM ttamleavetype a

                GROUP BY a.leave_code
       
                ORDER BY a.leave_code asc
                

                LIMIT $limit, $page";
?>