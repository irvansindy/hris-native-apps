<?php 
$qListRenderSrvSide = "SELECT
                            *
                        FROM hrmtshiftregroup a
                        $where_srv
                        ORDER BY a.modified_date DESC";