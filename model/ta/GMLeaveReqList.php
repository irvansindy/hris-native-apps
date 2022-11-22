<?php 
$qListRender = "SELECT 
                a.*,
                            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
                            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
                        h.file_name,
                        b.full_name,
                        b.emp_no,
                        d.name_en
                        FROM hrmleaverequest a
                        LEFT JOIN view_employee b on a.emp_id=b.emp_id
                        -- LEFT JOIN hrmrequest c on a.request_no=c.request_no
                        LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
                        
                        LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                        LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                        LEFT JOIN view_employee g on f.position_id=g.position_id
                        LEFT JOIN hrmattachment h on a.request_no=h.request_no
                                    
                                    $where
                                    GROUP BY a.request_no
                        ORDER BY a.created_date DESC
                        LIMIT $limit, $page";

$qListRender_For_Leave = "SELECT 
                a.*,
                            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
                            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
                h.file_name,
                b.emp_no,
                d.name_en
                FROM hrmleaverequest a
                LEFT JOIN view_employee b on a.emp_id=b.emp_id
                -- LEFT JOIN hrmrequest c on a.request_no=c.request_no
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

                LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                LEFT JOIN view_employee g on f.position_id=g.position_id
                LEFT JOIN hrmattachment h on a.request_no=h.request_no
                            
                            $where
                            AND a.leave_code IN ('ANL', 'AWLV', 'MNLV','MTLV')
                            GROUP BY a.request_no
                ORDER BY a.created_date DESC
                LIMIT $limit, $page";

$qListRender_For_Permit = "SELECT 
                a.*,
                            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
                            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
                h.file_name,
                b.emp_no,
                d.name_en
                FROM hrmleaverequest a
                LEFT JOIN view_employee b on a.emp_id=b.emp_id
                -- LEFT JOIN hrmrequest c on a.request_no=c.request_no
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

                LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                LEFT JOIN view_employee g on f.position_id=g.position_id
                LEFT JOIN hrmattachment h on a.request_no=h.request_no
                            
                            $where
                            AND a.leave_code IN ('PDPR','PERMIT','PERMITHALF')
                            GROUP BY a.request_no
                ORDER BY a.created_date DESC
                LIMIT $limit, $page";

$qListRender_For_Sickness = "SELECT 
                a.*,
                            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
                            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
                h.file_name,
                b.emp_no,
                d.name_en
                FROM hrmleaverequest a
                LEFT JOIN view_employee b on a.emp_id=b.emp_id
                -- LEFT JOIN hrmrequest c on a.request_no=c.request_no
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

                LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                LEFT JOIN view_employee g on f.position_id=g.position_id
                LEFT JOIN hrmattachment h on a.request_no=h.request_no
                            
                            $where
                            AND a.leave_code IN ('HOSP','OSIC','SICK','SICKHALF')
                            GROUP BY a.request_no
                ORDER BY a.created_date DESC
                LIMIT $limit, $page";

$qListRender_For_Dispensation = "SELECT 
                a.*,
                            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
                            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
                h.file_name,
                b.emp_no,
                d.name_en
                FROM hrmleaverequest a
                LEFT JOIN view_employee b on a.emp_id=b.emp_id
                -- LEFT JOIN hrmrequest c on a.request_no=c.request_no
                LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

                LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                LEFT JOIN view_employee g on f.position_id=g.position_id
                LEFT JOIN hrmattachment h on a.request_no=h.request_no
                            
                            $where
                            AND a.leave_code IN ('BPT','CCM','DCF','DOR','DSCI','ECB','EML','EWMCL','GRD','GRDC','HCF','PLG','UMR','UMRCMP')
                            GROUP BY a.request_no
                ORDER BY a.created_date DESC
                LIMIT $limit, $page";
                

$qListRenderSrvSide = "SELECT 
                a.*,
                            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
                            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
                        h.file_name,
                        b.full_name,
                        b.emp_no,
                        d.name_en
                        FROM hrmleaverequest a
                        LEFT JOIN view_employee b on a.emp_id=b.emp_id
                        -- LEFT JOIN hrmrequest c on a.request_no=c.request_no
                        LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code
                        
                        LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
                        LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
                        LEFT JOIN view_employee g on f.position_id=g.position_id
                        LEFT JOIN hrmattachment h on a.request_no=h.request_no
                                    
                        $where_srv
                                    GROUP BY a.request_no
                        ORDER BY a.created_date DESC";
?>