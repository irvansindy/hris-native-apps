<?php 
$qListRender = "SELECT 
                     a.*,
                     GROUP_CONCAT(c.item_name_en ORDER BY c.item_code ASC SEPARATOR ' . ') AS group_item
                            FROM hrmondutypurposetype a
                            LEFT JOIN hrrondutypurposecomp b on a.purpose_code=b.purpose_code
                            LEFT JOIN hrmondutyallowitem c on b.item_code=c.item_code
                     $WHERE
                     GROUP BY a.purpose_code
";
?>