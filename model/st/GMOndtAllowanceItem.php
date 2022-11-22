<?php 
$qListRender = "SELECT 
                     a.*,
                     b.category_name_en,
                     (SELECT 
                            GROUP_CONCAT(x3.purpose_name_en ORDER BY x3.purpose_name_en ASC SEPARATOR ' /  ') AS item_code
                                   FROM hrmondutyallowitem x1
                                   LEFT JOIN hrrondutypurposecomp x2 ON x2.item_code=x1.item_code
                                                 LEFT JOIN  hrmondutypurposetype x3 ON x2.purpose_code=x3.purpose_code
                                   WHERE x1.item_code=a.item_code
                                   GROUP BY x1.item_code) as purpose_code
                            FROM hrmondutyallowitem a
                            LEFT JOIN hrmondutyallowcat b on a.category_code=b.category_code
                     $WHERE
                     GROUP BY a.item_code
";
?>