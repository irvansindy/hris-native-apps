<?php 
$qListRender = "SELECT

                     a.machine_code,
                     a.company_id,
                     a.method,
                     a.in_status,
                     a.out_status,
                     a.fileext,
                     a.datasource,
                     a.table_name,
                     a.attend_code,
                     a.created_by,
                     a.created_date,
                     a.modified_by,
                     a.modified_date,
                     CASE
                            WHEN a.inoutflag = 'Y' THEN '../../asset/dist/img/tick.png'
                            WHEN a.inoutflag = 'N' THEN '../../asset/dist/img/inactive.png'
                     ELSE '../../asset/dist/img/inactive.png'
                     END as inoutflag,
                     a.file_type,
                     a.breakstart_code,
                     a.breakend_code,
                     a.datemask

                FROM hrmattmachine a

              --   $where
       
                ORDER BY a.machine_code asc
                
                LIMIT $limit, $page";
?>