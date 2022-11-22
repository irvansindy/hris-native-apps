<?php
$qListRender = "SELECT
                     a.ipp_reqno,
                     DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                     a.created_by,
                     DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                     a.modified_by,
                     b.period_name,
                     'SPV-Up' as kpi_type,
                     c.emp_no,
                     c.Full_Name,
                     c.pos_name_en,
                     c.cost_code,
                     xdec1.name_en
                            FROM hrmperf_ipprequest a
                            INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                            INNER JOIN view_employee c on a.requester=c.emp_no
                     LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        GROUP BY dt1.request_no) xdec1 ON xdec1.request_no=a.ipp_reqno

                     $WHERE_SPV_UP

                   UNION ALL

                   SELECT
                     a.pa_reqno as ipp_reqno,
                     DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                     a.created_by,
                     DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                     a.modified_by,
                     b.period_name,
                     'SPV-Down' as kpi_type,
                     c.emp_no,
                     c.Full_Name,
                     c.pos_name_en,
                     c.cost_code,
                     xdec1.name_en
                            FROM hrmperf_parequest_stfsc a
                            INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                            INNER JOIN view_employee c on a.requester=c.emp_no
                            LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        ) xdec1 ON xdec1.request_no=a.pa_reqno
                     $WHERE
                     
                     GROUP BY a.pa_reqno
                     ORDER BY created_date DESC
";

$qListRenderApproval = "SELECT
                            a.ipp_reqno,
                            DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                            a.created_by,
                            DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                            a.modified_by,
                            b.period_name,
                            'SPV-Up' as kpi_type,
                            c.emp_no,
                            c.Full_Name,
                            c.pos_name_en,
                            c.cost_code,
                            xdec1.name_en,
                            xdec1.sts
                                   FROM hrmperf_ipprequest a
                                   INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                                   INNER JOIN view_employee c on a.requester=c.emp_no
                                   INNER JOIN hrmstatus d on a.status=d.code
                                   LEFT JOIN (SELECT
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        GROUP BY dt1.request_no
                                                        ) xdec1 ON xdec1.request_no=a.ipp_reqno

                            LEFT JOIN view_employee e ON e.emp_no = '$username'
                            INNER JOIN hrmrequestapproval f ON f.request_no=a.ipp_reqno AND f.position_id = e.position_id

                     $WHERE_APP_SPV_UP

                   UNION ALL

                   SELECT
                     a.pa_reqno as ipp_reqno,
                     DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                     a.created_by,
                     DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                     a.modified_by,
                     b.period_name,
                     'SPV-Down' as kpi_type,
                     c.emp_no,
                     c.Full_Name,
                     c.pos_name_en,
                     c.cost_code,
                     xdec1.name_en,
                     xdec1.sts as name__appraisal
                            FROM hrmperf_parequest_stfsc a
                            INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                            INNER JOIN view_employee c on a.requester=c.emp_no
                            INNER JOIN hrmstatus d on a.status=d.code
                    		LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        ) xdec1 ON xdec1.request_no=a.pa_reqno
										
                            LEFT JOIN view_employee e ON e.emp_no = '$username'
				INNER JOIN hrmrequestapproval f ON f.request_no=a.pa_reqno AND f.position_id = e.position_id

                     $WHERE_APP
                     
                     GROUP BY a.pa_reqno
                     ORDER BY created_date DESC";

$qListRenderApprraisalRequest = "SELECT
                                   a.ipp_reqno,
                                   DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                                   a.created_by,
                                   DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                                   a.modified_by,
                                   b.period_name,
                                   'SPV-Up' as kpi_type,
                                   c.emp_no,
                                   c.Full_Name,
                                   c.pos_name_en,
                                   c.cost_code,
                                   xdec1.name_en,
                                   xdec1.sts,
                                   g.name_id as name_id_appraisal
                                          FROM hrmperf_ipprequest a
                                          INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                                          INNER JOIN view_employee c on a.requester=c.emp_no
                                          INNER JOIN hrmstatus d on a.status=d.code
                                          LEFT JOIN (SELECT
                                                               dt1.sts,
                                                               dt1.request_no,
                                                               dty.req,
                                                               x2.name_en
                                                               FROM
                                                                      (
                                                                             SELECT MAX(x1.request_status) AS sts, 
                                                                             x1.request_no 
                                                                             FROM hrmrequestapproval x1 
                                                                             GROUP BY x1.request_no
                                                                      )dt1
                                                               INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                               LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                               GROUP BY dt1.request_no
                                                               ) xdec1 ON xdec1.request_no=a.ipa_reqno
                                          LEFT JOIN (SELECT
                                                               dt1.sts,
                                                               dt1.request_no,
                                                               dty.req,
                                                               x2.name_en
                                                               FROM
                                                                      (
                                                                             SELECT MAX(x1.request_status) AS sts, 
                                                                             x1.request_no 
                                                                             FROM hrmrequestapproval x1 
                                                                             GROUP BY x1.request_no
                                                                      )dt1
                                                               INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                               LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                               GROUP BY dt1.request_no
                                                               ) xdec2 ON xdec2.request_no=a.ipp_reqno
                                          INNER JOIN hrmstatus g on a.appraisal_status=g.code
                                          -- LEFT JOIN view_employee e ON e.emp_no = '$username'
                                          -- INNER JOIN hrmrequestapproval f ON f.request_no=a.ipp_reqno AND f.position_id = e.position_id

                     $WHERE_APPRAISAL_REQUEST_SPV_UP

                   UNION ALL

                   SELECT
                     a.pa_reqno as ipp_reqno,
                     DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                     a.created_by,
                     DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                     a.modified_by,
                     b.period_name,
                     'SPV-Down' as kpi_type,
                     c.emp_no,
                     c.Full_Name,
                     c.pos_name_en,
                     c.cost_code,
                     xdec1.name_en,
                     xdec1.sts,
                     g.name_id
                            FROM hrmperf_parequest_stfsc a
                            INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                            INNER JOIN view_employee c on a.requester=c.emp_no
                            INNER JOIN hrmstatus d on a.status=d.code
                    		LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code ) xdec1 ON xdec1.request_no=a.ipa_reqno
				LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        ) xdec2 ON xdec2.request_no=a.pa_reqno						
                            -- LEFT JOIN view_employee e ON e.emp_no = '$username'
				-- INNER JOIN hrmrequestapproval f ON f.request_no=a.pa_reqno AND f.position_id = e.position_id
                            INNER JOIN hrmstatus g on a.appraisal_status=g.code

                     $WHERE_APPRAISAL_REQUEST
                     
                     GROUP BY a.pa_reqno
                     ORDER BY created_date DESC";



$qListRenderAppraisalApproval = "SELECT
                                   a.ipp_reqno,
                                   a.ipa_reqno,
                                   DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                                   a.created_by,
                                   DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                                   a.modified_by,
                                   b.period_name,
                                   'SPV-Up' as kpi_type,
                                   c.emp_no,
                                   c.Full_Name,
                                   c.pos_name_en,
                                   c.cost_code,
                                   xdec1.name_en,
                                   xdec1.sts
                                          FROM hrmperf_ipprequest a
                                          INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                                          INNER JOIN view_employee c on a.requester=c.emp_no
                                          INNER JOIN hrmstatus d on a.status=d.code
                                          LEFT JOIN (SELECT
                                                               dt1.sts,
                                                               dt1.request_no,
                                                               dty.req,
                                                               x2.name_en
                                                               FROM
                                                                      (
                                                                             SELECT MAX(x1.request_status) AS sts, 
                                                                             x1.request_no 
                                                                             FROM hrmrequestapproval x1 
                                                                             GROUP BY x1.request_no
                                                                      )dt1
                                                               INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                               LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                               GROUP BY dt1.request_no
                                                               ) xdec1 ON xdec1.request_no=a.ipa_reqno
                                                                             
                                          LEFT JOIN (SELECT
                                                               dt1.sts,
                                                               dt1.request_no,
                                                               dty.req,
                                                               x2.name_en
                                                               FROM
                                                                      (
                                                                             SELECT MAX(x1.request_status) AS sts, 
                                                                             x1.request_no 
                                                                             FROM hrmrequestapproval x1 
                                                                             GROUP BY x1.request_no
                                                                      )dt1
                                                               INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                               LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                               GROUP BY dt1.request_no
                                                               ) xdec2 ON xdec2.request_no=a.ipp_reqno      

                                          LEFT JOIN view_employee e ON e.emp_no = '$username'
                                          INNER JOIN hrmrequestapproval f ON f.request_no=a.ipa_reqno AND f.position_id = e.position_id

                     $WHERE_APP_APPRAISAL_SPV_UP



                   UNION ALL

                   SELECT
                     a.pa_reqno as ipp_reqno,
                     a.ipa_reqno,
                     DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                     a.created_by,
                     DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                     a.modified_by,
                     b.period_name,
                     'SPV-Down' as kpi_type,
                     c.emp_no,
                     c.Full_Name,
                     c.pos_name_en,
                     c.cost_code,
                     xdec1.name_en,
                     xdec1.sts as name__appraisal
                            FROM hrmperf_parequest_stfsc a
                            INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                            INNER JOIN view_employee c on a.requester=c.emp_no
                            INNER JOIN hrmstatus d on a.status=d.code
                    		LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        ) xdec1 ON xdec1.request_no=a.ipa_reqno

                            LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        ) xdec2 ON xdec2.request_no=a.pa_reqno	
										
                            LEFT JOIN view_employee e ON e.emp_no = '$username'
				INNER JOIN hrmrequestapproval f ON f.request_no=a.ipa_reqno AND f.position_id = e.position_id

                     $WHERE_APP_APPRAISAL
                     
                     GROUP BY a.pa_reqno
                     ORDER BY created_date DESC";


$qListRenderEntryRecords = "SELECT
                            a.ipp_reqno,
                            DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                            a.created_by,
                            DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                            a.modified_by,
                            b.period_name,
                            'SPV-Up' as kpi_type,
                            c.emp_no,
                            c.Full_Name,
                            c.pos_name_en,
                            c.cost_code,
                            xdec1.name_en,
                            xdec1.sts
                                   FROM hrmperf_ipprequest a
                                   INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                                   INNER JOIN view_employee c on a.requester=c.emp_no
                                   INNER JOIN hrmstatus d on a.status=d.code
                                   LEFT JOIN (SELECT
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        GROUP BY dt1.request_no
                                                        ) xdec1 ON xdec1.request_no=a.ipp_reqno

                            LEFT JOIN view_employee e ON e.emp_no = '$username'
                            INNER JOIN hrmrequestapproval f ON f.request_no=a.ipp_reqno AND f.position_id = e.position_id

                     $WHERE_RECORD_ENTRY_SPV_UP

              --      UNION ALL

              --      SELECT
              --        a.pa_reqno as ipp_reqno,
              --        DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
              --        a.created_by,
              --        DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
              --        a.modified_by,
              --        b.period_name,
              --        'SPV-Down' as kpi_type,
              --        c.emp_no,
              --        c.Full_Name,
              --        c.pos_name_en,
              --        c.cost_code,
              --        xdec1.name_en,
              --        xdec1.sts as name__appraisal
              --               FROM hrmperf_parequest_stfsc a
              --               INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
              --               INNER JOIN view_employee c on a.requester=c.emp_no
              --               INNER JOIN hrmstatus d on a.status=d.code
              --       		LEFT JOIN (SELECT 
              --                                           dt1.sts,
              --                                           dt1.request_no,
              --                                           dty.req,
              --                                           x2.name_en
              --                                           FROM
              --                                                  (
              --                                                         SELECT MAX(x1.request_status) AS sts, 
              --                                                         x1.request_no 
              --                                                         FROM hrmrequestapproval x1 
              --                                                         GROUP BY x1.request_no
              --                                                  )dt1
              --                                           INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
              --                                           LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
              --                                           ) xdec1 ON xdec1.request_no=a.pa_reqno
										
              --               LEFT JOIN view_employee e ON e.emp_no = '$username'
		-- 		INNER JOIN hrmrequestapproval f ON f.request_no=a.pa_reqno AND f.position_id = e.position_id

              --        $WHERE_RECORD_ENTRY
                     
              --        GROUP BY a.pa_reqno
              --        ORDER BY created_date DESC
                     ";


$qListRenderEntry = "SELECT
                            a.ipp_reqno,
                            DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
                            a.created_by,
                            DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
                            a.modified_by,
                            b.period_name,
                            'SPV-Up' as kpi_type,
                            c.emp_no,
                            c.Full_Name,
                            c.pos_name_en,
                            c.cost_code,
                            xdec1.name_en,
                            xdec1.sts
                                   FROM hrmperf_ipprequest a
                                   INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
                                   INNER JOIN view_employee c on a.requester=c.emp_no
                                   INNER JOIN hrmstatus d on a.status=d.code
                                   LEFT JOIN (SELECT
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, 
                                                                      x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
                                                        GROUP BY dt1.request_no
                                                        ) xdec1 ON xdec1.request_no=a.ipp_reqno

                            LEFT JOIN view_employee e ON e.emp_no = '$username'
                            INNER JOIN hrmrequestapproval f ON f.request_no=a.ipp_reqno AND f.position_id = e.position_id

                     $WHERE_RECORD_SPV_UP

              --      UNION ALL

              --      SELECT
              --        a.pa_reqno as ipp_reqno,
              --        DATE_FORMAT(a.created_date, '%d-%b-%Y %H:%i:%s') as created_date,
              --        a.created_by,
              --        DATE_FORMAT(a.modified_date, '%d-%b-%Y %H:%i:%s') as modified_date,
              --        a.modified_by,
              --        b.period_name,
              --        'SPV-Down' as kpi_type,
              --        c.emp_no,
              --        c.Full_Name,
              --        c.pos_name_en,
              --        c.cost_code,
              --        xdec1.name_en,
              --        xdec1.sts as name__appraisal
              --               FROM hrmperf_parequest_stfsc a
              --               INNER JOIN hrmperf_set_period b on a.ip_period=b.period_id
              --               INNER JOIN view_employee c on a.requester=c.emp_no
              --               INNER JOIN hrmstatus d on a.status=d.code
              --       		LEFT JOIN (SELECT 
              --                                           dt1.sts,
              --                                           dt1.request_no,
              --                                           dty.req,
              --                                           x2.name_en
              --                                           FROM
              --                                                  (
              --                                                         SELECT MAX(x1.request_status) AS sts, 
              --                                                         x1.request_no 
              --                                                         FROM hrmrequestapproval x1 
              --                                                         GROUP BY x1.request_no
              --                                                  )dt1
              --                                           INNER JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
              --                                           LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code
              --                                           ) xdec1 ON xdec1.request_no=a.pa_reqno
										
              --               LEFT JOIN view_employee e ON e.emp_no = '$username'
		-- 		INNER JOIN hrmrequestapproval f ON f.request_no=a.pa_reqno AND f.position_id = e.position_id

              --        $WHERE_RECORD_ENTRY
                     
              --        GROUP BY a.pa_reqno
              --        ORDER BY created_date DESC
                     ";

$qListRenderRevisedRemark = "SELECT       a.*,
                                          b.Full_Name,
                                          DATE_FORMAT(a.created_date, '%d %b %Y %h:%i:%s') as tgl
                                   FROM hrmperf_remark_revised a
                                   LEFT JOIN view_employee b on a.created_by=b.emp_no
                                   WHERE a.ipp_reqno = '$rfid'
                                   ORDER BY a.id_revised DESC";

$qListRenderPerformanceFinalResult = "SELECT       
                                                 a.*,
                                                 b.emp_no,
                                                 b.Full_Name,
                                                 c.period_name
                                          FROM hrmperf_finalresult a
                                          LEFT JOIN view_employee b on a.request_for=b.emp_no
                                          LEFT JOIN hrmperf_set_period c on a.ip_period=c.period_id
                                          LEFT JOIN users d ON d.username = '$username'
                                          $WHERE_FINAL_RESULT
                                          ORDER BY a.ipp_reqno ASC";


$qListRenderPerformanceFinalComparatioResult = "SELECT       
                                                 a.*,
                                                 b.emp_no,
                                                 b.Full_Name,
                                                 c.period_name
                                          FROM hrmperf_finalresult a
                                          LEFT JOIN view_employee b on a.request_for=b.emp_no
                                          LEFT JOIN hrmperf_set_period c on a.ip_period=c.period_id
                                          LEFT JOIN users d ON d.username = '$username'
                                          $WHERE
                                          ORDER BY a.ipp_reqno ASC";

$qListRenderPerformanceComparatio = "SELECT 
                                          A.*,
                                          D.Full_Name,
                                          B.index_range,
                                          B.range_name,
                                          C.total_value as SIM,
                                          (A.basic_salary*C.total_value)/100 AS diff
                                          FROM v_hrmperf_comparatio_calc A
                                          LEFT JOIN 
                                                        (
                                                        SELECT 
                                                               sub1.index_range,
                                                               sub1.range_name,
                                                               sub1.range_start,
                                                               sub1.range_end 
                                                               FROM hrmperf_comparatio_range sub1 
                                          GROUP BY sub1.range_name
                                                        ) B ON (ROUND(A.basic_salary/A.avg_salary , 2)*100) BETWEEN 
                                                                             B.range_start AND B.range_end
                                          LEFT JOIN hrmperf_comparatio C ON B.index_range=C.compa_ratio_id AND A.order_no=C.performance
                                          LEFT JOIN view_employee D ON A.emp_no=D.emp_no
                                          WHERE A.ip_period = '2022'";


?>