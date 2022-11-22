<?php 
$qListRender = "SELECT 
                     a.*,
                     (SELECT 
                     GROUP_CONCAT(step , ' Hours x ' , value ORDER BY factor_no ASC SEPARATOR ', ') AS factor_no
                                                        FROM hrmovertimefactor
                                                        WHERE overtime_code=a.overtime_code
                                                        GROUP BY overtime_code) as factor
                     FROM hrmovertime a
                     $WHERE";
?>