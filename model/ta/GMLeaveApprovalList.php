<?php 
$qListRender = "SELECT 
a.*,
            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
            b.emp_no,
            b.full_name,
            d.name_en,

            h.file_name      
            FROM hrmleaverequest a
            LEFT JOIN view_employee b on a.emp_id=b.emp_id
            -- LEFT JOIN hrmrequest c on a.request_no=c.request_no

            -- LEFT JOIN hrmstatus d on (SELECT request_status FROM hrmrequestapproval WHERE request_no = a.request_no ORDER BY `request_status` DESC limit 1)=d.code

            LEFT JOIN (
												SELECT 
												request_no,
												MAX(request_status) AS sts
												FROM
												hrmrequestapproval
										
												GROUP BY request_no
											) rests ON rests.request_no = a.request_no
			LEFT JOIN hrmstatus d ON d.code = rests.sts

            LEFT JOIN hrmrequestapproval e on a.request_no=e.request_no
            LEFT JOIN hrmorgstruc f on f.pos_code=e.approval_list
            LEFT JOIN view_employee g on f.position_id=g.position_id
            LEFT JOIN hrmattachment h on a.request_no=h.request_no

            $where

            GROUP BY a.request_no

                        
            ORDER BY a.request_no DESC
           
            LIMIT $limit, $page
            
            
            ";

     





$qListRenderApproval = "SELECT
                            a.request_no as request_no,
                            a.created_date,
                            a.leave_code,
                            c.emp_no,
                            c.Full_Name,
                            DATE_FORMAT(a.leave_startdate, '%d %b %Y') as leave_startdates,
                            DATE_FORMAT(a.leave_enddate, '%d %b %Y') as leave_enddates,
                            a.totaldays,
                            a.remark,
                            a.created_by,
                            a.modified_date,
                            a.modified_by,
                            a.urgent_request,
                            h.file_name,
                            c.Full_Name,
                            c.pos_name_en,
                            c.cost_code,
                            xdec1.name_en,
                            xdec1.sts
                            FROM hrmleaverequest a
                            INNER JOIN view_employee c on a.emp_id=c.emp_id
                    			 LEFT JOIN (SELECT 
                                                        dt1.sts,
                                                        dt1.request_no,
                                                        dty.req,
                                                        x2.name_en
                                                        FROM
                                                               (
                                                                      SELECT MAX(x1.request_status) AS sts, x1.request_no 
                                                                      FROM hrmrequestapproval x1 
                                                                      GROUP BY x1.request_no
                                                               )dt1
                                                        inner JOIN hrmrequestapproval dty ON dty.request_no = dt1.request_no AND dty.request_status = dt1.sts
                                                        LEFT JOIN hrmstatus x2 ON dt1.sts=x2.code


                                                        ) xdec1 ON xdec1.request_no=a.request_no
										
                            LEFT JOIN view_employee e ON e.emp_no = '$username'
				INNER JOIN hrmrequestapproval f ON f.request_no=a.request_no AND f.position_id = e.position_id
                            LEFT JOIN hrmattachment h on a.request_no=h.request_no

                     $WHERE_APP                      
                     GROUP BY a.request_no
                     ORDER BY xdec1.name_en DESC, a.request_no DESC
                     
";
?>