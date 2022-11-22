<?php
include "config.php";


// STEP 4

                            // DELETE TABLE tempmigratefinaldata
                            $delete_tempmigratefinaldata    = mysqli_query($masuk, "TRUNCATE od_tempmigratefinaldata");
                            // DELETE TABLE tempmigratefinaldata

                            $insert_tempmigratefinaldata    = mysqli_query($masuk, "INSERT INTO od_tempmigratefinaldata
                            select 
                            a.posisi_id as pos_child,
                            a.parent as org_child,
                            a.kode_posisi as child_pos_code,
                            a.nama_posisi as child_pos_name,
                            a.jobtitle_code as child_jobtitle_code,
                            pathx.parent_path as child_parent_path,
                            f.orderid as child_orderid,
                            a.parent as pos_parent,
                            e.parent as org_parent,
                            e.nama_posisi as parent_posname,
                            e.jobtitle_code as parent_jobtitle,
                            g.orderid as parent_orderid,
                            pathy.parent_path as parent_parentpath,
                            e.people_id as  parent_empno,
                            i.full_name as parent_name,
                            h.work_location_code as parent_plant,
                            h.cost_code as parent_costcenter,
                            CASE 
                                WHEN Ngap.posisi_id is not null AND (CAST(x1.orderid as SIGNED) - CAST(IFNULL(f.orderid,'0') as SIGNED) = 1) 
                                    THEN (CAST(f.orderid as SIGNED) - CAST(IFNULL(g.orderid,'0') as SIGNED)) + CAST(x1.orderid as SIGNED) - CAST(IFNULL(f.orderid,'0') as SIGNED)
                                ELSE CAST(f.orderid as SIGNED) - CAST(IFNULL(g.orderid,'0') as SIGNED)
                            END AS gap,
                            a.Direktorat_id,
                            a.Division_id,
                            a.Departemen_id
                            from od_tempmigrateposition a
                            left join (select distinct departemen_id,departemen_name from od_tempmigrateorgunit) b on b.departemen_id = a.departemen_id
                            left join (select distinct division_id,division_name from od_tempmigrateorgunit) c on c.division_id = a.division_id
                            left join (select distinct direktorat_id,direktorat_name from od_tempmigrateorgunit) d on d.direktorat_id = a.direktorat_id
                            left join od_tempmigrateposition e on e.posisi_id = a.parent
                            left join od_orglevel f on f.level_cat = a.jobtitle_code
                            left join od_orglevel g on g.level_cat = e.jobtitle_code
                            left join teodempcompany h on h.emp_no = e.people_id
                            left join teomemppersonal i on i.emp_id = h.emp_id
                            left join od_tempmigrateposition Ngap on Ngap.parent = a.parent and Ngap.jobtitle_code = e.jobtitle_code  
                            left join od_orglevel x1 on x1.level_cat = Ngap.jobtitle_code
                            left join od_tempmigratepositionpath pathx on pathx.position_id = a.posisi_id
                            left join od_tempmigratepositionpath pathy on pathy.position_id = a.parent
                            where a.posisi_id <> '0'
                            order by a.parent,a.posisi_id ASC");

                            if($insert_tempmigratefinaldata){

                                echo"<script type='text/javascript'>
                                window.alert('Silahkan Tekan Lanjutkan!'); 
                        
								
								window.open('https://tm.dev.gthris.com/hrm/hrm{sys=org.vieworg}/interface_od/BuatOji.php', '_blank');
                                </script>"; 

                                
             
                               
	



                           
                                

                            }else{
                                echo"<script type='text/javascript'>
                                window.alert('Gagal insert_tempmigratefinaldata!'); 
                                window.redirect('/interface-od');
                                </script>"; 
                            }

?>