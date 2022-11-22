<?php 
$qListRender = "SELECT 
                     a.*
                            FROM hrmondutyallowcat a
                     $WHERE
                     GROUP BY a.category_code
";
?>