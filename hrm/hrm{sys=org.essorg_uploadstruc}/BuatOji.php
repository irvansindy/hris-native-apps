<!-- <table border="1" width="100%"> -->
  
<?php
echo '<script>
       window.alert("Masuk Pak Eko!");
</script>';
include "../../application/session/session.php";
		$no = 0;
		$SFdatetime             	= date("Y-m-d H:i:s");
              
              $process_DEL = mysqli_query($connect, "TRUNCATE od_teomposition_b1");
              $process_INS = mysqli_query($connect, "INSERT IGNORE INTO od_teomposition_b1 
                                                 

                                                 SELECT 
                                                        a.pos_child, 
                                                        a.child_pos_code,
                                                        a.pos_parent,
                                                        '-',
                                                        a.child_pos_name,
                                                        a.child_orderid,
                                                        a.child_parent_path,
                                                        '',
                                                        a.child_jobtitle_code,
                                                        a.gap,
                                                        '0',
                                                        '0',
                                                        d.people_id as emp_no,
                                                        c.parent_path,
                                                        a.departemen_id,
                                                        a.division_id,
                                                        a.direktorat_id
                                                 FROM od_tempmigratefinaldata a
                                                 LEFT JOIN hrmorgstruc c on a.pos_child=c.position_id
                                                 LEFT JOIN od_tempmigrateposition d on d.posisi_id=a.pos_child
                                                 
                                                 ");

		if($process_INS) {
                     $get_GT_JMGR	= mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp,a.* FROM od_teomposition_b1 a LEFT JOIN view_employee b on a.pos_code=b.pos_code WHERE a.gap > '1' ORDER BY a.parent_path ASC");
                     while($r=mysqli_fetch_array($get_GT_JMGR)){
                     $no++;

                     
       if($r['gap'] == '2'){
                                   $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                   $getExcecTop1 = mysqli_fetch_array($getTop1);
                                   
                                   
                                   
                                   $ext_dep_id = $getExcecTop1['departemen_id'];
                                   $ext_div_id = $getExcecTop1['division_id'];
                                   $ext_dir_id = $getExcecTop1['direktorat_id'];
                                   
                                   $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                   $upd_One_Parent_unik = $getExcecTop1['pos_child'];

                                   $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                   $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                   $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                   $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*2+22*$upd_One_Parent_unik;
                                   $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                   if(mysqli_num_rows($condition) > 0){
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                   } else {
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                   }
                                   $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                   $upd_One_Parent_Path_20211007 = $getExcecTop1['parent_parentpath'];

                                   $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                    (
                                                                                           `position_id`,
                                                                                           `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                           `pos_level`,
                                                                                           `parent_path`,
                                                                                           `parent_id`,
                                                                                           `flag_add`
                                                                                    ) VALUES 
                                                                                           (
                                                                                                  '$add_One_Create_Unique$upd_One_Parent_unik',
                                                                                                  'INSERT_GAP-2-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                  '$add_One_Parent',
                                                                                                  '$add_One_Parent_Path',
                                                                                                  '$getExcecTop1[pos_parent]',
                                                                                                  '1'
                                                                                           )");

                                                 if($process_INS_add_One){
                                                        $process_UPD_add_One = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                `parent_path` = '$upd_One_Parent_Path',
                                                                                                                `restruct_remark` = '{{UPDATE+GAP2-new}} UPDATE od_teomposition_b1 SET 
[parent_path] = {{$upd_One_Parent_Path}} | 
[parent_id] = {{$add_One_Create_Unique}} 
WHERE [pos_level] = {{$add_One_Up_Parent}} AND 
[parent_path] = {{$upd_One_Parent}}',
                                                                                                                `parent_id` = '$add_One_Create_Unique$upd_One_Parent_unik'
                                                                                                         WHERE 
                                                                                                                `pos_level` = $add_One_Up_Parent AND
                                                                                                                `parent_path` = '$upd_One_Parent'");
                                                                                                                
                                                 }
                                                 
                                                       
       } else if($r['gap'] == '3'){
                                   $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                   $getExcecTop1 = mysqli_fetch_array($getTop1);
                                   
                                                                     
                                   $ext_dep_id = $getExcecTop1['departemen_id'];
                                   $ext_div_id = $getExcecTop1['division_id'];
                                   $ext_dir_id = $getExcecTop1['direktorat_id'];
                                          
                                   $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                   $upd_One_Parent_unik = $getExcecTop1['pos_child'];

                                   $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                   $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                   $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",13497".$getExcecTop1['pos_parent'];
                                   $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*3+33*$upd_One_Parent_unik;
                                   $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                   if(mysqli_num_rows($condition) > 0){
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                   } else {
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                   }
                                   $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;

                                   $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                    (
                                                                                           `position_id`,
                                                                                           `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                           `pos_level`,
                                                                                           `parent_path`,
                                                                                           `parent_id`,
                                                                                           `flag_add`
                                                                                    ) VALUES 
                                                                                           (
                                                                                                  '$add_One_Create_Unique',
                                                                                                  'INSERT_GAP-3-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                  '$add_One_Parent',
                                                                                                  '$add_One_Parent_Path',
                                                                                                  '$getExcecTop1[pos_parent]',
                                                                                                  '1'
                                                                                           )");

                                                                                          

                                                 if($process_INS_add_One){

                                                        $ext_dep_id = $getExcecTop1['departemen_id'];
                                                        $ext_div_id = $getExcecTop1['division_id'];
                                                        $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                        $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                        $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                        
                                                        $add_Two_Parent = $getExcecTop1['parent_orderid']+2;
                                                        $add_Two_Up_Parent = $getExcecTop1['parent_orderid']+3;
                                                        $add_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                        $add_Two_Create_Unique_Declare = $getExcecTop1['pos_parent']*3+44*$upd_One_Parent_unik;
                                                        $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                        if(mysqli_num_rows($condition) > 0){
                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                        } else {
                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                        }
                                                        $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;

                                                        $process_INS_add_Two = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                    (
                                                                                           `position_id`,
                                                                                           `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                           `pos_level`,
                                                                                           `parent_path`,
                                                                                           `parent_id`,
                                                                                           `flag_add`
                                                                                    ) VALUES 
                                                                                           (
                                                                                                  '$add_Two_Create_Unique$upd_One_Parent_unik',
                                                                                                  'INSERT_GAP-3-2_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                  '$add_Two_Parent',
                                                                                                  '$add_Two_Parent_Path',
                                                                                                  '$add_One_Create_Unique',
                                                                                                  '1'
                                                                                           )");

                                                                                          
                                                        if($process_INS_add_Two){
                                                               $process_UPD_add_Two = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                       `parent_path` = '$upd_Two_Parent_Path',
                                                                                                                       `restruct_remark` = '{{UPDATE+GAP3-new}} UPDATE od_teomposition_b1 SET 
[parent_path] = {{$upd_Two_Parent_Path}},
[parent_id] = {{$add_Two_Create_Unique}}
WHERE 
[pos_level] = {{$add_Two_Up_Parent}} AND
[parent_path] = {{$upd_One_Parent}}',
                                                                                                                       `parent_id` = '$add_Two_Create_Unique$upd_One_Parent_unik'
                                                                                                                WHERE 
                                                                                                                       `pos_level` = $add_Two_Up_Parent AND
                                                                                                                       `parent_path` = '$upd_One_Parent'");
                                                               
                                                        }      
                                                 }
                            
       } else if($r['gap'] == '4'){
                                                 $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                 $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                 
                                                                                                         
                                                 $ext_dep_id = $getExcecTop1['departemen_id'];
                                                 $ext_div_id = $getExcecTop1['division_id'];
                                                 $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                 $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                 $upd_One_Parent_unik = $getExcecTop1['pos_child'];

                                                 $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                 $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                 $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                 $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*4+44*$upd_One_Parent_unik;
                                                 $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                 if(mysqli_num_rows($condition) > 0){
                                                        $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                 } else {
                                                        $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                 }
                                                 $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
              
                                                 $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                  (
                                                                                                         `position_id`,
                                                                                                         `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                         `pos_level`,
                                                                                                         `parent_path`,
                                                                                                         `parent_id`,
                                                                                                         `flag_add`
                                                                                                  ) VALUES 
                                                                                                         (
                                                                                                                '$add_One_Create_Unique',
                                                                                                                'INSERT_GAP-4-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                '$add_One_Parent',
                                                                                                                '$add_One_Parent_Path',
                                                                                                                '$getExcecTop1[pos_parent]',
                                                                                                                '1'
                                                                                                         )");
              
                                                                                                                    
                                                               if($process_INS_add_One){

                                                                      $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                      $ext_div_id = $getExcecTop1['division_id'];
                                                                      $ext_dir_id = $getExcecTop1['direktorat_id'];
              
                                                                      $upd_Two_Parent = $getExcecTop1['child_parent_path'];
                                                                      $upd_Two_Parent_unik = $getExcecTop1['pos_child'];

                                                                      $add_Two_Parent = $getExcecTop1['parent_orderid']+2;
                                                                      $add_Two_Up_Parent = $getExcecTop1['parent_orderid']+3;
                                                                      $add_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                      $add_Two_Create_Unique_Declare = $getExcecTop1['pos_parent']*4+55*$upd_Two_Parent_unik;
                                                                      $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                      if(mysqli_num_rows($condition) > 0){
                                                                             $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                      } else {
                                                                             $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                      }
                                                                      $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
              
                                                                      $process_INS_add_Two = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                  (
                                                                                                         `position_id`,
                                                                                                         `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                         `pos_level`,
                                                                                                         `parent_path`,
                                                                                                         `parent_id`,
                                                                                                         `flag_add`
                                                                                                  ) VALUES 
                                                                                                         (
                                                                                                                '$add_Two_Create_Unique',
                                                                                                                'INSERT_GAP-4-2_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                '$add_Two_Parent',
                                                                                                                '$add_Two_Parent_Path',
                                                                                                                '$add_One_Create_Unique',
                                                                                                                '1'
                                                                                                         )");
              
                                                                                                   
                                                                      if($process_INS_add_Two){
                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                             $ext_div_id = $getExcecTop1['division_id'];
                                                                             $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                             $upd_Three_Parent = $getExcecTop1['child_parent_path'];
                                                                             $upd_Three_Parent_unik = $getExcecTop1['pos_child'];

                                                                             $add_Three_Parent = $getExcecTop1['parent_orderid']+3;
                                                                             $add_Three_Up_Parent = $getExcecTop1['parent_orderid']+4;
                                                                             $add_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                             $add_Three_Create_Unique_Declare = $getExcecTop1['pos_parent']*4+66*$upd_Three_Parent_unik;
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                             }
                                                                             $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
              
                                                                             $process_INS_add_Three = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                         (
                                                                                                                `position_id`,
                                                                                                                `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                `pos_level`,
                                                                                                                `parent_path`,
                                                                                                                `parent_id`,
                                                                                                                `flag_add`
                                                                                                         ) VALUES 
                                                                                                                (
                                                                                                                       '$add_Three_Create_Unique$upd_One_Parent_unik',
                                                                                                                       'INSERT_GAP-4-3_$upd_One_Parent_unik $add_Three_Create_Unique$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                       '$add_Three_Parent',
                                                                                                                       '$add_Three_Parent_Path',
                                                                                                                       '$add_Two_Create_Unique',
                                                                                                                       '1'
                                                                                                                )");
              
                                                                                                 
              
              
                                                                             if($process_INS_add_Three){
                                                                                    $process_UPD_add_Three = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                                            `parent_path` = '$upd_Three_Parent_Path',
                                                                                                                                            `restruct_remark` = '{{UPDATE+GAP4-new}}  UPDATE od_teomposition_b1 SET 
[parent_path] = {{$upd_Three_Parent_Path}},
[parent_id] = {{$add_Three_Create_Unique}}
WHERE 
[pos_level] = {{$add_Three_Up_Parent}} AND
[parent_path] = {{$upd_One_Parent}}',

                                                                                                                                            `parent_id` = '$add_Three_Create_Unique$upd_One_Parent_unik'
                                                                                                                                     WHERE 
                                                                                                                                            `pos_level` = $add_Three_Up_Parent AND
                                                                                                                                            `parent_path` = '$upd_One_Parent'");
                                                                          
                                                                             }
                                                                      }      
                                                               }
                                                               
                                                               
       } else if($r['gap'] == '5'){
                                                               $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                               $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                               
                                                              

                                                               $ext_dep_id = $getExcecTop1['departemen_id'];
                                                               $ext_div_id = $getExcecTop1['division_id'];
                                                               $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                               $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                               $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                               
                                                               $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                               $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                               $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                              
                                                               $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*5+55*$upd_One_Parent_unik;
                                                               $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                               if(mysqli_num_rows($condition) > 0){
                                                                      $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                               } else {
                                                                      $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                               }
                                                               $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                            
                                                               $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                (
                                                                                                                       `position_id`,
                                                                                                                       `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                       `pos_level`,
                                                                                                                       `parent_path`,
                                                                                                                       `parent_id`,
                                                                                                                       `flag_add`
                                                                                                                ) VALUES 
                                                                                                                       (
                                                                                                                              '$add_One_Create_Unique',
                                                                                                                              'INSERT_GAP-5-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                              '$add_One_Parent',
                                                                                                                              '$add_One_Parent_Path',
                                                                                                                              '$getExcecTop1[pos_parent]',
                                                                                                                              '1'
                                                                                                                       )");
                            
                                                                                                           
                            
                                                                             if($process_INS_add_One){

                                                                                    $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                    $ext_div_id = $getExcecTop1['division_id'];
                                                                                    $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                    $upd_Two_Parent = $getExcecTop1['child_parent_path'];
                                                                                    $upd_Two_Parent_unik = $getExcecTop1['pos_child'];
                            
                                                                                    $add_Two_Parent = $getExcecTop1['parent_orderid']+2;
                                                                                    $add_Two_Up_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                    $add_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                                    $add_Two_Create_Unique_Declare = $getExcecTop1['pos_parent']*5+66*$upd_Two_Parent_unik;
                                                                                    $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                    if(mysqli_num_rows($condition) > 0){
                                                                                           $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                    } else {
                                                                                           $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                    }
                                                                                    $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                            
                                                                                    $process_INS_add_Two = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                (
                                                                                                                       `position_id`,
                                                                                                                       `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                       `pos_level`,
                                                                                                                       `parent_path`,
                                                                                                                       `parent_id`,
                                                                                                                       `flag_add`
                                                                                                                ) VALUES 
                                                                                                                       (
                                                                                                                              '$add_Two_Create_Unique',
                                                                                                                              'INSERT_GAP-5-2_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                              '$add_Two_Parent',
                                                                                                                              '$add_Two_Parent_Path',
                                                                                                                              '$add_One_Create_Unique',
                                                                                                                              '1'
                                                                                                                       )");
                            
                                                                                                    
                                                                                    if($process_INS_add_Two){
                                                                                           $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                           $ext_div_id = $getExcecTop1['division_id'];
                                                                                           $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                           $upd_Three_Parent = $getExcecTop1['child_parent_path'];
                                                                                           $upd_Three_Parent_unik = $getExcecTop1['pos_child'];
                            
                                                                                           $add_Three_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                           $add_Three_Up_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                           $add_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                                           $add_Three_Create_Unique_Declare = $getExcecTop1['pos_parent']*5+77*$upd_Two_Parent_unik;
                                                                                           $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                           if(mysqli_num_rows($condition) > 0){
                                                                                                  $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                           } else {
                                                                                                  $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                           }
                                                                                           $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                            
                                                                                           $process_INS_add_Three = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                       (
                                                                                                                              `position_id`,
                                                                                                                              `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                              `pos_level`,
                                                                                                                              `parent_path`,
                                                                                                                              `parent_id`,
                                                                                                                              `flag_add`
                                                                                                                       ) VALUES 
                                                                                                                              (
                                                                                                                                     '$add_Three_Create_Unique',
                                                                                                                                     'INSERT_GAP-5-3_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                     '$add_Three_Parent',
                                                                                                                                     '$add_Three_Parent_Path',
                                                                                                                                     '$add_Two_Create_Unique',
                                                                                                                                     '1'
                                                                                                                              )");
                            
                                                                                                     
                            
                            
                                                                                           if($process_INS_add_Three){

                                                                                                  $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                  $ext_div_id = $getExcecTop1['division_id'];
                                                                                                  $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                  $upd_Four_Parent = $getExcecTop1['child_parent_path'];
                                                                                                  $upd_Four_Parent_unik = $getExcecTop1['pos_child'];

                                                                                                  $add_Four_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                  $add_Four_Up_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                  $add_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                                                  $add_Four_Create_Unique_Declare = $getExcecTop1['pos_parent']*5+88*$upd_Two_Parent_unik;
                                                                                                  $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                  if(mysqli_num_rows($condition) > 0){
                                                                                                         $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                  } else {
                                                                                                         $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                  }
                                                                                                  $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                            
                                                                                                  $process_INS_add_Four = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                       (
                                                                                                                              `position_id`,
                                                                                                                              `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                              `pos_level`,
                                                                                                                              `parent_path`,
                                                                                                                              `parent_id`,
                                                                                                                              `flag_add`
                                                                                                                       ) VALUES 
                                                                                                                              (
                                                                                                                                     '$add_Four_Create_Unique$upd_One_Parent_unik',
                                                                                                                                     'INSERT_GAP-5-4_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                     '$add_Four_Parent',
                                                                                                                                     '$add_Four_Parent_Path',
                                                                                                                                     '$add_Three_Create_Unique',
                                                                                                                                     '1'
                                                                                                                              )");
                            
                                                                                                   if($process_INS_add_Four){
                                                                                                         $process_UPD_add_Four = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                                                                 `parent_path` = '$upd_Four_Parent_Path',
                                                                                                                                                                 `restruct_remark` = '{{UPDATE+GAP5-new}} UPDATE od_teomposition_b1 SET 
[parent_path] = {{$upd_Four_Parent_Path}} |
[parent_id] = {{$add_Four_Create_Unique}}
WHERE 
[pos_level] = {{$add_Four_Up_Parent}} AND
[parent_path] = {{$add_One_Parent_Path}}',
                                                                                                                                                                 `parent_id` = '$add_Four_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                          WHERE 
                                                                                                                                                                 `pos_level` = $add_Four_Up_Parent AND
                                                                                                                                                                 `parent_path` = '$upd_One_Parent'");

                                                                                                       
                                                                                                  }
                                                                                           }
                                                                                    }      
                                                                             }
                                                                             
       } else if($r['gap'] == '6'){
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                                             $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                                             
                                                                      

                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                             $ext_div_id = $getExcecTop1['division_id'];
                                                                             $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                             $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                             $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                             
                                                                             $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                                             $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                                             $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                             
                                                                             $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*6+66*$upd_One_Parent_unik;
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                          
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                              (
                                                                                                                                     `position_id`,
                                                                                                                                     `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                     `pos_level`,
                                                                                                                                     `parent_path`,
                                                                                                                                     `parent_id`,
                                                                                                                                     `flag_add`
                                                                                                                              ) VALUES 
                                                                                                                                     (
                                                                                                                                            '$add_One_Create_Unique',
                                                                                                                                            'INSERT_GAP-6-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                            '$add_One_Parent',
                                                                                                                                            '$add_One_Parent_Path',
                                                                                                                                            '$getExcecTop1[pos_parent]',
                                                                                                                                            '1'
                                                                                                                                     )");
                                          
                                                                                                                                                             
                                                                                           if($process_INS_add_One){

                                                                                                  $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                  $ext_div_id = $getExcecTop1['division_id'];
                                                                                                  $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                  $upd_Two_Parent = $getExcecTop1['child_parent_path'];
                                                                                                  $upd_Two_Parent_unik = $getExcecTop1['pos_child'];
                                          
                                                                                                  $add_Two_Parent = $getExcecTop1['parent_orderid']+2;
                                                                                                  $add_Two_Up_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                  $add_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                                      
                                                                                                  $add_Two_Create_Unique_Declare = $getExcecTop1['pos_parent']*6+77*$upd_Two_Parent_unik;
                                                                                                  $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                  if(mysqli_num_rows($condition) > 0){
                                                                                                         $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                  } else {
                                                                                                         $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                  }
                                                                                                  $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                          
                                                                                                  $process_INS_add_Two = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                              (
                                                                                                                                     `position_id`,
                                                                                                                                     `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                     `pos_level`,
                                                                                                                                     `parent_path`,
                                                                                                                                     `parent_id`,
                                                                                                                                     `flag_add`
                                                                                                                              ) VALUES 
                                                                                                                                     (
                                                                                                                                            '$add_Two_Create_Unique',
                                                                                                                                            'INSERT_GAP-6-2_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                            '$add_Two_Parent',
                                                                                                                                            '$add_Two_Parent_Path',
                                                                                                                                            '$add_One_Create_Unique',
                                                                                                                                            '1'
                                                                                                                                     )");
                                          
                                                                                                                         
                                                                                                  if($process_INS_add_Two){

                                                                                                         $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                         $ext_div_id = $getExcecTop1['division_id'];
                                                                                                         $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                         $upd_Three_Parent = $getExcecTop1['child_parent_path'];
                                                                                                         $upd_Three_Parent_unik = $getExcecTop1['pos_child'];
                                          
                                                                                                         $add_Three_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                         $add_Three_Up_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                         $add_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                                                        
                                                                                                         $add_Three_Create_Unique_Declare = $getExcecTop1['pos_parent']*6+88*$upd_Three_Parent_unik;
                                                                                                         $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                         if(mysqli_num_rows($condition) > 0){
                                                                                                                $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                         } else {
                                                                                                                $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                         }
                                                                                                         $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                          
                                                                                                         $process_INS_add_Three = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                     (
                                                                                                                                            `position_id`,
                                                                                                                                            `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                            `pos_level`,
                                                                                                                                            `parent_path`,
                                                                                                                                            `parent_id`,
                                                                                                                                            `flag_add`
                                                                                                                                     ) VALUES 
                                                                                                                                            (
                                                                                                                                                   '$add_Three_Create_Unique',
                                                                                                                                                   'INSERT_GAP-6-3_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                   '$add_Three_Parent',
                                                                                                                                                   '$add_Three_Parent_Path',
                                                                                                                                                   '$add_Two_Create_Unique',
                                                                                                                                                   '1'
                                                                                                                                            )");
                                          
                                                                                                      
                                          
                                                                                                         if($process_INS_add_Three){
                                                                                                                
                                                                                                                $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                $upd_Four_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                $upd_Four_Parent_unik = $getExcecTop1['pos_child'];
                                          
                                                                                                                $add_Four_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                                $add_Four_Up_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                $add_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                                                                $add_Four_Create_Unique_Declare = $getExcecTop1['pos_parent']*6+99*$upd_Four_Parent_unik;
                                                                                                                $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                if(mysqli_num_rows($condition) > 0){
                                                                                                                       $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                } else {
                                                                                                                       $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                }
                                                                                                                $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                          
                                                                                                                $process_INS_add_Four = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                     (
                                                                                                                                            `position_id`,
                                                                                                                                            `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                            `pos_level`,
                                                                                                                                            `parent_path`,
                                                                                                                                            `parent_id`,
                                                                                                                                            `flag_add`
                                                                                                                                     ) VALUES 
                                                                                                                                            (
                                                                                                                                                   '$add_Four_Create_Unique',
                                                                                                                                                   'INSERT_GAP-6-4_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                   '$add_Four_Parent',
                                                                                                                                                   '$add_Four_Parent_Path',
                                                                                                                                                   '$add_Three_Create_Unique',
                                                                                                                                                   '1'
                                                                                                                                            )");
                                          
                                                                                                               
                                                                                                                 if($process_INS_add_Four){
                                                                                                                       $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                       $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                       $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                       $upd_Five_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                       $upd_Five_Parent_unik = $getExcecTop1['pos_child'];
                                          
                                                                                                                       $add_Five_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                       $add_Five_Up_Parent = $getExcecTop1['parent_orderid']+6;
                                                                                                                       $add_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                                                                                                       $add_Five_Create_Unique = $getExcecTop1['pos_parent']*2+10;

                                                                                                                       $add_Five_Create_Unique_Declare = $getExcecTop1['pos_parent']*6+99*$upd_Five_Parent_unik;
                                                                                                                       $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Five_Create_Unique_Declare'");
                                                                                                                       if(mysqli_num_rows($condition) > 0){
                                                                                                                              $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                       } else {
                                                                                                                              $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                       }

                                                                                                                       $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                       
                                                                                                                       $process_INS_add_Six = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                        (
                                                                                                                                                                               `position_id`,
                                                                                                                                                                               `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                               `pos_level`,
                                                                                                                                                                               `parent_path`,
                                                                                                                                                                               `parent_id`,
                                                                                                                                                                               `flag_add`
                                                                                                                                                                        ) VALUES 
                                                                                                                                                                               (
                                                                                                                                                                                      '$add_Five_Create_Unique$upd_One_Parent_unik',
                                                                                                                                                                                      'INSERT_GAP-6-5_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                      '$add_Five_Parent',
                                                                                                                                                                                      '$add_Five_Parent_Path',
                                                                                                                                                                                      '$add_Four_Create_Unique',
                                                                                                                                                                                      '1'
                                                                                                                                                                               )");
                                          
                                                                                                                                                                     
                                                                                                                       
                                                                                                                       if($process_INS_add_Six){
                                                                                                                              $process_UPD_add_Seven = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                                                                                      `parent_path` = '$upd_Five_Parent_Path',
                                                                                                                                                                                      `restruct_remark` = '{{UPDATE+GAP6-new}} UPDATE od_teomposition_b1 SET 
                                                                                                                                                                                                           [parent_path] = {{$upd_Five_Parent_Path}} |
                                                                                                                                                                                                           [parent_id] = {{$add_Five_Create_Unique}}
                                                                                                                                                                                                           WHERE 
                                                                                                                                                                                                           [pos_level] = $add_Five_Up_Parent AND
                                                                                                                                                                                                           [parent_path] = {{$upd_One_Parent}}',
                                                                                                                                                                                      `parent_id` = '$add_Five_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                                               WHERE 
                                                                                                                                                                                      `pos_level` = $add_Five_Up_Parent AND
                                                                                                                                                                                      `parent_path` = '$upd_One_Parent'");
                                                                                                                     
                                                                                                                       }
                                                                                                                }
                                                                                                         }
                                                                                                  }      
                                                                                           }


       } else if($r['gap'] == '7'){
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                                             $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                                                           
                                                                    
                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                             $ext_div_id = $getExcecTop1['division_id'];
                                                                             $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                             $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                             $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                           
                                                                             $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                                             $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                                             $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                                             
                                                                             $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*7+77*$upd_One_Parent_unik;
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                        
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                            (
                                                                                                                                                   `position_id`,
                                                                                                                                                   `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                   `pos_level`,
                                                                                                                                                   `parent_path`,
                                                                                                                                                   `parent_id`,
                                                                                                                                                   `flag_add`
                                                                                                                                            ) VALUES 
                                                                                                                                                   (
                                                                                                                                                          '$add_One_Create_Unique',
                                                                                                                                                          'INSERT_GAP-7-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                          '$add_One_Parent',
                                                                                                                                                          '$add_One_Parent_Path',
                                                                                                                                                          '$getExcecTop1[pos_parent]',
                                                                                                                                                          '1'
                                                                                                                                                   )");
                                                        
                                                                                                                                               
                                                        
                                                                                                         if($process_INS_add_One){

                                                                                                                $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                        
                                                                                                                $add_Two_Parent = $getExcecTop1['parent_orderid']+2;
                                                                                                                $add_Two_Up_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                                $add_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                                                                $add_Two_Create_Unique_Declare = $getExcecTop1['pos_parent']*7+88*$upd_One_Parent_unik;
                                                                                                                $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                                if(mysqli_num_rows($condition) > 0){
                                                                                                                       $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                                } else {
                                                                                                                       $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                                }
                                                                                                                $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                        
                                                                                                                $process_INS_add_Two = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                            (
                                                                                                                                                   `position_id`,
                                                                                                                                                   `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                   `pos_level`,
                                                                                                                                                   `parent_path`,
                                                                                                                                                   `parent_id`,
                                                                                                                                                   `flag_add`
                                                                                                                                            ) VALUES 
                                                                                                                                                   (
                                                                                                                                                          '$add_Two_Create_Unique',
                                                                                                                                                          'INSERT_GAP-7-2_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                          '$add_Two_Parent',
                                                                                                                                                          '$add_Two_Parent_Path',
                                                                                                                                                          '$add_One_Create_Unique',
                                                                                                                                                          '1'
                                                                                                                                                   )");
                                                        
                                                                                                                                                 
                                                                                                                if($process_INS_add_Two){

                                                                                                                       $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                       $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                       $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                       $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                       $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                        
                                                                                                                       $add_Three_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                                       $add_Three_Up_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                                       $add_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;

                                                                                                                       $add_Three_Create_Unique_Declare = $getExcecTop1['pos_parent']*7+99*$upd_One_Parent_unik;
                                                                                                                       $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                                       if(mysqli_num_rows($condition) > 0){
                                                                                                                              $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                                       } else {
                                                                                                                              $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                                       }
                                                                                                                       $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                        
                                                                                                                       $process_INS_add_Three = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                   (
                                                                                                                                                          `position_id`,
                                                                                                                                                          `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                          `pos_level`,
                                                                                                                                                          `parent_path`,
                                                                                                                                                          `parent_id`,
                                                                                                                                                          `flag_add`
                                                                                                                                                   ) VALUES 
                                                                                                                                                          (
                                                                                                                                                                 '$add_Three_Create_Unique',
                                                                                                                                                                 'INSERT_GAP-7-3_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                 '$add_Three_Parent',
                                                                                                                                                                 '$add_Three_Parent_Path',
                                                                                                                                                                 '$add_Two_Create_Unique',
                                                                                                                                                                 '1'
                                                                                                                                                          )");
                                                        
                                                                                                                                                         
                                                        
                                                        
                                                                                                                       if($process_INS_add_Three){

                                                                                                                              $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                              $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                              $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                              $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                              $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                        
                                                                                                                              $add_Four_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                                              $add_Four_Up_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                              $add_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;

                                                                                                                              $add_Four_Create_Unique_Declare = $getExcecTop1['pos_parent']*7+1010*$upd_One_Parent_unik;
                                                                                                                              $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                              if(mysqli_num_rows($condition) > 0){
                                                                                                                                     $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                              } else {
                                                                                                                                     $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                              }
                                                                                                                              $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                                        
                                                                                                                              $process_INS_add_Four = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                   (
                                                                                                                                                          `position_id`,
                                                                                                                                                          `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                          `pos_level`,
                                                                                                                                                          `parent_path`,
                                                                                                                                                          `parent_id`,
                                                                                                                                                          `flag_add`
                                                                                                                                                   ) VALUES 
                                                                                                                                                          (
                                                                                                                                                                 '$add_Four_Create_Unique',
                                                                                                                                                                 'INSERT_GAP-7-4_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                 '$add_Four_Parent',
                                                                                                                                                                 '$add_Four_Parent_Path',
                                                                                                                                                                 '$add_Three_Create_Unique',
                                                                                                                                                                 '1'
                                                                                                                                                          )");
                                                        
                                                                                                                                                          // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                          // (
                                                                                                                                                          //        `position_id`,
                                                                                                                                                          //        `pos_level`,
                                                                                                                                                          //        `parent_path`,
                                                                                                                                                          //        `parent_id`,
                                                                                                                                                          //        `flag_add`
                                                                                                                                                          // ) VALUES 
                                                                                                                                                          //        (
                                                                                                                                                          //               '$add_Four_Create_Unique',
                                                                                                                                                          //               '$add_Four_Parent',
                                                                                                                                                          //               '$add_Four_Parent_Path',
                                                                                                                                                          //               '$add_Three_Create_Unique',
                                                                                                                                                          //               '1'
                                                                                                                                                          //        ) [GAP6]"."</p>";
                                                                                                                               if($process_INS_add_Four){

                                                                                                                                     $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                     $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                     $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                     $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                     $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                        
                                                                                                                                     $add_Five_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                                     $add_Five_Up_Parent = $getExcecTop1['parent_orderid']+6;
                                                                                                                                     $add_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;

                                                                                                                                     $add_Five_Create_Unique_Declare = $getExcecTop1['pos_parent']*7+1111*$upd_One_Parent_unik;
                                                                                                                                     $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                     if(mysqli_num_rows($condition) > 0){
                                                                                                                                            $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                                     } else {
                                                                                                                                            $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                                     }

                                                                                                                                     $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                                     
                                                                                                                                     $process_INS_add_Six = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                      (
                                                                                                                                                                                             `position_id`,
                                                                                                                                                                                             `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                             `pos_level`,
                                                                                                                                                                                             `parent_path`,
                                                                                                                                                                                             `parent_id`,
                                                                                                                                                                                             `flag_add`
                                                                                                                                                                                      ) VALUES 
                                                                                                                                                                                             (
                                                                                                                                                                                                    '$add_Five_Create_Unique',
                                                                                                                                                                                                    'INSERT_GAP-7-5_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                    '$add_Five_Parent',
                                                                                                                                                                                                    '$add_Five_Parent_Path',
                                                                                                                                                                                                    '$add_Four_Create_Unique',
                                                                                                                                                                                                    '1'
                                                                                                                                                                                             )");
                                                        
                                                                                                                                                                                             // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                             // (
                                                                                                                                                                                             //        `position_id`,
                                                                                                                                                                                             //        `pos_level`,
                                                                                                                                                                                             //        `parent_path`,
                                                                                                                                                                                             //        `parent_id`,
                                                                                                                                                                                             //        `flag_add`
                                                                                                                                                                                             // ) VALUES 
                                                                                                                                                                                             //        (
                                                                                                                                                                                             //               '$add_Five_Create_Unique',
                                                                                                                                                                                             //               '$add_Five_Parent',
                                                                                                                                                                                             //               '$add_Five_Parent_Path',
                                                                                                                                                                                             //               '$add_Four_Create_Unique',
                                                                                                                                                                                             //               '1'
                                                                                                                                                                                             //        )";
                                                                                                                                     
                                                                                                                                     if($process_INS_add_Six){

                                                                                                                                            $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                            $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                            $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                        
                                                                                                                                            $add_Six_Parent = $getExcecTop1['parent_orderid']+6;
                                                                                                                                            $add_Six_Up_Parent = $getExcecTop1['parent_orderid']+7;
                                                                                                                                            $add_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                                          
                                                                                                                                            $add_Six_Create_Unique_Declare = $getExcecTop1['pos_parent']*7+1212*$upd_One_Parent_unik;
                                                                                                                                            $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Six_Create_Unique_Declare'");
                                                                                                                                            if(mysqli_num_rows($condition) > 0){
                                                                                                                                                   $add_Six_Create_Unique = $add_Six_Create_Unique_Declare+$add_Six_Create_Unique_Declare;
                                                                                                                                            } else {
                                                                                                                                                   $add_Six_Create_Unique = $add_Six_Create_Unique_Declare;
                                                                                                                                            }

                                                                                                                                            $upd_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                            
                                                                                                                                            $process_INS_add_Sevent = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                             (
                                                                                                                                                                                                    `position_id`,
                                                                                                                                                                                                    `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                    `pos_level`,
                                                                                                                                                                                                    `parent_path`,
                                                                                                                                                                                                    `parent_id`,
                                                                                                                                                                                                    `flag_add`
                                                                                                                                                                                             ) VALUES 
                                                                                                                                                                                                    (
                                                                                                                                                                                                           '$add_Six_Create_Unique$upd_One_Parent_unik',
                                                                                                                                                                                                           'INSERT_GAP-7-6_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                           '$add_Six_Parent',
                                                                                                                                                                                                           '$add_Six_Parent_Path',
                                                                                                                                                                                                           '$add_Five_Create_Unique',
                                                                                                                                                                                                           '1'
                                                                                                                                                                                                    )");
                                                        
                                                                                                                                                                                                    // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                    // (
                                                                                                                                                                                                    //        `position_id`,
                                                                                                                                                                                                    //        `pos_level`,
                                                                                                                                                                                                    //        `parent_path`,
                                                                                                                                                                                                    //        `parent_id`,
                                                                                                                                                                                                    //        `flag_add`
                                                                                                                                                                                                    // ) VALUES 
                                                                                                                                                                                                    //        (
                                                                                                                                                                                                    //               '$add_Six_Create_Unique',
                                                                                                                                                                                                    //               '$add_Six_Parent',
                                                                                                                                                                                                    //               '$add_Six_Parent_Path',
                                                                                                                                                                                                    //               '$add_Five_Create_Unique',
                                                                                                                                                                                                    //               '1'
                                                                                                                                                                                                    //        )";
                                                                                                                                            if($process_INS_add_Sevent){
                                                        
                                                                                                                                                   $process_UPD_add_Seven = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                                                                                                           `parent_path` = '$upd_Six_Parent_Path',
                                                                                                                                                                                                           `restruct_remark` = '{{UPDATE+GAP7-new}} UPDATE od_teomposition_b1 SET 
[parent_path] = {{$upd_Six_Parent_Path}} |
[parent_id] = {{$add_Six_Create_Unique}}
WHERE 
[pos_level] = {{$add_Six_Up_Parent}} AND
[parent_path] = {{$upd_One_Parent}}',
                                                                                                                                                                                                           `parent_id` = '$add_Six_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                                                                    WHERE 
                                                                                                                                                                                                           `pos_level` = '$add_Six_Up_Parent' AND
                                                                                                                                                                                                           `parent_path` = '$upd_One_Parent'");
                                                                                                                                                   // echo "UPDATE od_teomposition_b1 SET 
                                                                                                                                                   //               `parent_path` = '$upd_Six_Parent_Path',
                                                                                                                                                   //               `parent_id` = '$add_Six_Create_Unique'
                                                                                                                                                   //        WHERE 
                                                                                                                                                   //               `pos_level` = $add_Six_Up_Parent AND
                                                                                                                                                   //               `parent_path` = '$upd_One_Parent' [GAP7]"."<br>";
                                                                                                                                                   }
                                                                                                                                     }
                                                                                                                              }
                                                                                                                       }
                                                                                                                }      
                                                                                                         }


       } else if($r['gap'] == '8'){
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                                             // echo "<hr style='border: 5px solid cyan'>------INSERT+GAP8------<br><p style='color: red;'>SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]</p> [GAP7]"."<br>";
                                                                             $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                                                                         
                                                                             // echo '<tr style="background: linear-gradient(248deg, #348ac7, #7474bf);color: white;">
                                                                             //                                           <td>'.$getExcecTop1['pos_parent'].'</td>
                                                                             //                                           <td>'.$getExcecTop1['child_pos_code'].'</td>
                                                                             //                                           <td>'.$getExcecTop1['emp'].'</td>
                                                                             //                                           <td>'.$getExcecTop1['parent_parentpath'].'</td>
                                                                             //                                           <td></td>
                                                                             //                                           <td>'.$getExcecTop1['parent_orderid'].'</td>
                                                                             //                                    </tr>';

                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];
                                                                                                         
                                                                             $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                             $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                
                                                                             $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                                             $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                                             $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                                             
                                                                             $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+88*$upd_One_Parent_unik;
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                      
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                          (
                                                                                                                                                                 `position_id`,
                                                                                                                                                                 `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                 `pos_level`,
                                                                                                                                                                 `parent_path`,
                                                                                                                                                                 `parent_id`,
                                                                                                                                                                 `flag_add`
                                                                                                                                                          ) VALUES 
                                                                                                                                                                 (
                                                                                                                                                                        '$add_One_Create_Unique',
                                                                                                                                                                        'INSERT_GAP-8-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                        '$add_One_Parent',
                                                                                                                                                                        '$add_One_Parent_Path',
                                                                                                                                                                        '$getExcecTop1[pos_parent]',
                                                                                                                                                                        '1'
                                                                                                                                                                 )");
                                                                      
                                                                                                                                                                 // echo "<p style='color: green;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                 // (
                                                                                                                                                                 //        `position_id`,
                                                                                                                                                                 //        `pos_level`,
                                                                                                                                                                 //        `parent_path`,
                                                                                                                                                                 //        `parent_id`,
                                                                                                                                                                 //        `flag_add`
                                                                                                                                                                 // ) VALUES 
                                                                                                                                                                 //        (
                                                                                                                                                                 //               '$add_One_Create_Unique',
                                                                                                                                                                 //               '$add_One_Parent',
                                                                                                                                                                 //               '$add_One_Parent_Path',
                                                                                                                                                                 //               '$getExcecTop1[pos_parent]',
                                                                                                                                                                 //               '1'
                                                                                                                                                                 //        ) [GAP7]"."</p>";
                                                                      
                                                                                                                       if($process_INS_add_One){

                                                                                                                              $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                              $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                              $upd_One_Parent_unik = $getExcecTop1['pos_child'];

                                                                                                                              $add_Two_Parent = $getExcecTop1['parent_orderid']+2;
                                                                                                                              $add_Two_Up_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                                              $add_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                                                                              
                                                                                                                              $add_Two_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+99*$upd_One_Parent_unik;
                                                                                                                              $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                                              if(mysqli_num_rows($condition) > 0){
                                                                                                                                     $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                                              } else {
                                                                                                                                     $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                                              }
                                                                                                                              $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                      
                                                                                                                              $process_INS_add_Two = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                          (
                                                                                                                                                                 `position_id`,
                                                                                                                                                                 `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                 `pos_level`,
                                                                                                                                                                 `parent_path`,
                                                                                                                                                                 `parent_id`,
                                                                                                                                                                 `flag_add`
                                                                                                                                                          ) VALUES 
                                                                                                                                                                 (
                                                                                                                                                                        '$add_Two_Create_Unique',
                                                                                                                                                                        'INSERT_GAP-8-2_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                        '$add_Two_Parent',
                                                                                                                                                                        '$add_Two_Parent_Path',
                                                                                                                                                                        '$add_One_Create_Unique',
                                                                                                                                                                        '1'
                                                                                                                                                                 )");
                                                                      
                                                                                                                                                                 // echo "<p style='color: #72bce8 ;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                 // (
                                                                                                                                                                 //        `position_id`,
                                                                                                                                                                 //        `pos_level`,
                                                                                                                                                                 //        `parent_path`,
                                                                                                                                                                 //        `parent_id`,
                                                                                                                                                                 //        `flag_add`
                                                                                                                                                                 // ) VALUES 
                                                                                                                                                                 //        (
                                                                                                                                                                 //               '$add_Two_Create_Unique',
                                                                                                                                                                 //               '$add_Two_Parent',
                                                                                                                                                                 //               '$add_Two_Parent_Path',
                                                                                                                                                                 //               '$add_One_Create_Unique',
                                                                                                                                                                 //               '1'
                                                                                                                                                                 //        ) [GAP7]"."</p>";
                                                                                                                              if($process_INS_add_Two){

                                                                                                                                     $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                     $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                     $upd_One_Parent_unik = $getExcecTop1['pos_child'];

                                                                                                                                     $add_Three_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                                                     $add_Three_Up_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                                                     $add_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                                                                                     
                                                                                                                                     $add_Three_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+110*$upd_One_Parent_unik;
                                                                                                                                     $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                                                     if(mysqli_num_rows($condition) > 0){
                                                                                                                                            $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                                                     } else {
                                                                                                                                            $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                                                     }

                                                                                                                                     $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                      
                                                                                                                                     $process_INS_add_Three = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                 (
                                                                                                                                                                        `position_id`,
                                                                                                                                                                        `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                        `pos_level`,
                                                                                                                                                                        `parent_path`,
                                                                                                                                                                        `parent_id`,
                                                                                                                                                                        `flag_add`
                                                                                                                                                                 ) VALUES 
                                                                                                                                                                        (
                                                                                                                                                                               '$add_Three_Create_Unique',
                                                                                                                                                                               'INSERT_GAP-8-3_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                               '$add_Three_Parent',
                                                                                                                                                                               '$add_Three_Parent_Path',
                                                                                                                                                                               '$add_Two_Create_Unique',
                                                                                                                                                                               '1'
                                                                                                                                                                        )");
                                                                      
                                                                                                                                                                        // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                        // (
                                                                                                                                                                        //        `position_id`,
                                                                                                                                                                        //        `pos_level`,
                                                                                                                                                                        //        `parent_path`,
                                                                                                                                                                        //        `parent_id`,
                                                                                                                                                                        //        `flag_add`
                                                                                                                                                                        // ) VALUES 
                                                                                                                                                                        //        (
                                                                                                                                                                        //               '$add_Three_Create_Unique',
                                                                                                                                                                        //               '$add_Three_Parent',
                                                                                                                                                                        //               '$add_Three_Parent_Path',
                                                                                                                                                                        //               '$add_Two_Create_Unique',
                                                                                                                                                                        //               '1'
                                                                                                                                                                        //        ) [GAP6]"."</p>";
                                                                      
                                                                      
                                                                                                                                     if($process_INS_add_Three){

                                                                                                                                            $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                            $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                            $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                                            
                                                                                                                                            $add_Four_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                                                            $add_Four_Up_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                                            $add_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                                                                      
                                                                                                                                            $add_Four_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+111*$upd_One_Parent_unik;
                                                                                                                                            $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                            if(mysqli_num_rows($condition) > 0){
                                                                                                                                                   $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                                            } else {
                                                                                                                                                   $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                                            }
                                                                                                                                            $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                                                      
                                                                                                                                            $process_INS_add_Four = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                 (
                                                                                                                                                                        `position_id`,
                                                                                                                                                                        `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                        `pos_level`,
                                                                                                                                                                        `parent_path`,
                                                                                                                                                                        `parent_id`,
                                                                                                                                                                        `flag_add`
                                                                                                                                                                 ) VALUES 
                                                                                                                                                                        (
                                                                                                                                                                               '$add_Four_Create_Unique',
                                                                                                                                                                               'INSERT_GAP-8-4_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                               '$add_Four_Parent',
                                                                                                                                                                               '$add_Four_Parent_Path',
                                                                                                                                                                               '$add_Three_Create_Unique',
                                                                                                                                                                               '1'
                                                                                                                                                                        )");
                                                                      
                                                                                                                                                                        // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                        // (
                                                                                                                                                                        //        `position_id`,
                                                                                                                                                                        //        `pos_level`,
                                                                                                                                                                        //        `parent_path`,
                                                                                                                                                                        //        `parent_id`,
                                                                                                                                                                        //        `flag_add`
                                                                                                                                                                        // ) VALUES 
                                                                                                                                                                        //        (
                                                                                                                                                                        //               '$add_Four_Create_Unique',
                                                                                                                                                                        //               '$add_Four_Parent',
                                                                                                                                                                        //               '$add_Four_Parent_Path',
                                                                                                                                                                        //               '$add_Three_Create_Unique',
                                                                                                                                                                        //               '1'
                                                                                                                                                                        //        ) [GAP6]"."</p>";
                                                                                                                                             if($process_INS_add_Four){

                                                                                                                                                   $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                                   $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                                   $ext_dir_id = $getExcecTop1['direktorat_id'];
                                                                      
                                                                                                                                                   $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                   $upd_One_Parent_unik = $getExcecTop1['pos_child'];

                                                                                                                                                   $add_Five_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                                                   $add_Five_Up_Parent = $getExcecTop1['parent_orderid']+6;
                                                                                                                                                   $add_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;

                                                                                                                                                   $add_Five_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+112*$upd_One_Parent_unik;
                                                                                                                                                   $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                                   if(mysqli_num_rows($condition) > 0){
                                                                                                                                                          $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                                                   } else {
                                                                                                                                                          $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                                                   }
                                                                                                                                                   
                                                                                                                                                   $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                                                   
                                                                                                                                                   $process_INS_add_Six = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                    (
                                                                                                                                                                                                           `position_id`,
                                                                                                                                                                                                           `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                           `pos_level`,
                                                                                                                                                                                                           `parent_path`,
                                                                                                                                                                                                           `parent_id`,
                                                                                                                                                                                                           `flag_add`
                                                                                                                                                                                                    ) VALUES 
                                                                                                                                                                                                           (
                                                                                                                                                                                                                  '$add_Five_Create_Unique',
                                                                                                                                                                                                                  'INSERT_GAP-8-5_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                  '$add_Five_Parent',
                                                                                                                                                                                                                  '$add_Five_Parent_Path',
                                                                                                                                                                                                                  '$add_Four_Create_Unique',
                                                                                                                                                                                                                  '1'
                                                                                                                                                                                                           )");
                                                                      
                                                                                                                                                                                                           // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                           // (
                                                                                                                                                                                                           //        `position_id`,
                                                                                                                                                                                                           //        `pos_level`,
                                                                                                                                                                                                           //        `parent_path`,
                                                                                                                                                                                                           //        `parent_id`,
                                                                                                                                                                                                           //        `flag_add`
                                                                                                                                                                                                           // ) VALUES 
                                                                                                                                                                                                           //        (
                                                                                                                                                                                                           //               '$add_Five_Create_Unique',
                                                                                                                                                                                                           //               '$add_Five_Parent',
                                                                                                                                                                                                           //               '$add_Five_Parent_Path',
                                                                                                                                                                                                           //               '$add_Four_Create_Unique',
                                                                                                                                                                                                           //               '1'
                                                                                                                                                                                                           //        )";
                                                                                                                                                   
                                                                                                                                                   if($process_INS_add_Six){

                                                                                                                                                          $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                                          $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                          $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                      
                                                                                                                                                          $add_Six_Parent = $getExcecTop1['parent_orderid']+6;
                                                                                                                                                          $add_Six_Up_Parent = $getExcecTop1['parent_orderid']+7;
                                                                                                                                                          $add_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;

                                                                                                                                                          $add_Six_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+113*$upd_One_Parent_unik;
                                                                                                                                                          $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Six_Create_Unique_Declare'");
                                                                                                                                                          if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                 $add_Six_Create_Unique = $add_Six_Create_Unique_Declare+$add_Six_Create_Unique_Declare;
                                                                                                                                                          } else {
                                                                                                                                                                 $add_Six_Create_Unique = $add_Six_Create_Unique_Declare;
                                                                                                                                                          }
                                                                                                                                            
                                                                                                                                                          $upd_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                                          
                                                                                                                                                          $process_INS_add_Sevent = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                           (
                                                                                                                                                                                                                  `position_id`,
                                                                                                                                                                                                                  `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                  `pos_level`,
                                                                                                                                                                                                                  `parent_path`,
                                                                                                                                                                                                                  `parent_id`,
                                                                                                                                                                                                                  `flag_add`
                                                                                                                                                                                                           ) VALUES 
                                                                                                                                                                                                                  (
                                                                                                                                                                                                                         '$add_Six_Create_Unique',
                                                                                                                                                                                                                         'INSERT_GAP-8-6_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                         '$add_Six_Parent',
                                                                                                                                                                                                                         '$add_Six_Parent_Path',
                                                                                                                                                                                                                         '$add_Five_Create_Unique',
                                                                                                                                                                                                                         '1'
                                                                                                                                                                                                                  )");
                                                                      
                                                                                                                                                                                                                  // echo "<p style='color: blue;'>"."ulala INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                  // (
                                                                                                                                                                                                                  //        `position_id`,
                                                                                                                                                                                                                  //        `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                  //        `pos_level`,
                                                                                                                                                                                                                  //        `parent_path`,
                                                                                                                                                                                                                  //        `parent_id`,
                                                                                                                                                                                                                  //        `flag_add`
                                                                                                                                                                                                                  // ) VALUES 
                                                                                                                                                                                                                  //        (
                                                                                                                                                                                                                  //               '$add_Six_Create_Unique',
                                                                                                                                                                                                                  //               'INSERT_GAP-8-6_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                  //               '$add_Six_Parent',
                                                                                                                                                                                                                  //               '$add_Six_Parent_Path',
                                                                                                                                                                                                                  //               '$add_Five_Create_Unique',
                                                                                                                                                                                                                  //               '1'
                                                                                                                                                                                                                  //        )";
                                                                                                                                                          if($process_INS_add_Sevent){

                                                                                                                                                                 $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                                                 $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                                                 $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                                                 $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                 $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                      
                                                                                                                                                                 $add_Seven_Parent = $getExcecTop1['parent_orderid']+7;
                                                                                                                                                                 $add_Seven_Up_Parent = $getExcecTop1['parent_orderid']+8;
                                                                                                                                                                 $add_Seven_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique.",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                                                 
                                                                                                                                                                 $add_Seven_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+114*$upd_One_Parent_unik;
                                                                                                                                                                 $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Seven_Create_Unique_Declare'");
                                                                                                                                                                 if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                        $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare+$add_Seven_Create_Unique_Declare;
                                                                                                                                                                 } else {
                                                                                                                                                                        $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare;
                                                                                                                                                                 }
                                                                                                                                                                 
                                                                                                                                                                 $upd_Seven_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Six_Create_Unique.",".$add_Seven_Create_Unique;
                                                                      
                                                                                                                                                                 $process_INS_add_Eight = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                           (
                                                                                                                                                                                                                  `position_id`,
                                                                                                                                                                                                                  `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                  `pos_level`,
                                                                                                                                                                                                                  `parent_path`,
                                                                                                                                                                                                                  `parent_id`,
                                                                                                                                                                                                                  `flag_add`
                                                                                                                                                                                                           ) VALUES 
                                                                                                                                                                                                                  (
                                                                                                                                                                                                                         '$add_Seven_Create_Unique$upd_One_Parent_unik',
                                                                                                                                                                                                                         'INSERT_GAP-8-7_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                         '$add_Seven_Parent',
                                                                                                                                                                                                                         '$add_Seven_Parent_Path',
                                                                                                                                                                                                                         '$add_Six_Create_Unique',
                                                                                                                                                                                                                         '1'
                                                                                                                                                                                                                  )");
                                                                      
                                                                                                                                                                                                                  // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                  // (
                                                                                                                                                                                                                  //        `position_id`,
                                                                                                                                                                                                                  //        `pos_level`,
                                                                                                                                                                                                                  //        `parent_path`,
                                                                                                                                                                                                                  //        `parent_id`,
                                                                                                                                                                                                                  //        `flag_add`
                                                                                                                                                                                                                  // ) VALUES 
                                                                                                                                                                                                                  //        (
                                                                                                                                                                                                                  //               '$add_Seven_Create_Unique',
                                                                                                                                                                                                                  //               '$add_Seven_Parent',
                                                                                                                                                                                                                  //               '$add_Seven_Parent_Path',
                                                                                                                                                                                                                  //               '$add_Five_Create_Unique',
                                                                                                                                                                                                                  //               '1'
                                                                                                                                                                                                                  //        )";
                                                                                                                                                                 
                                                                                                                                                                 if($process_INS_add_Eight){
                                                                      
                                                                                                                                                                        $process_UPD_add_Seven = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                                                                                                                                `parent_path` = '$upd_Seven_Parent_Path',
                                                                                                                                                                                                                                `restruct_remark` = '{{UPDATE+GAP8-new}} UPDATE od_teomposition_b1 SET 
[parent_path] = {{$upd_Seven_Parent_Path}}|
[parent_id] = {{$add_Seven_Create_Unique}}
WHERE 
[pos_level] = {{$add_Seven_Up_Parent}} AND
[parent_path] = {{$upd_One_Parent}}',
                                                                                                                                                                                                                                `parent_id` = '$add_Seven_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                                                                                         WHERE 
                                                                                                                                                                                                                                `pos_level` = '$add_Seven_Up_Parent' AND
                                                                                                                                                                                                                                `parent_path` = '$upd_One_Parent'");
                                                                                                                                                                        // echo "UPDATE od_teomposition_b1 SET 
                                                                                                                                                                        //               `parent_path` = '$upd_Seven_Parent_Path',
                                                                                                                                                                        //               `parent_id` = '$add_Seven_Create_Unique'
                                                                                                                                                                        //        WHERE 
                                                                                                                                                                        //               `pos_level` = $add_Seven_Up_Parent AND
                                                                                                                                                                        //               `parent_path` = '$upd_One_Parent' [GAP7]"."<br>";
                                                                                                                                                                 }
                                                                                                                                                          }
                                                                                                                                                   }
                                                                                                                                            }
                                                                                                                                     }
                                                                                                                              }      
                                                                                                                       }


       } else if($r['gap'] == '9'){
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                                             // echo "<hr style='border: 5px solid cyan'>------INSERT+GAP9------<br><p style='color: red;'>SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM od_tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]</p> [GAP7]"."<br>";
                                                                             $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                                                                                                                   
                                                                             // echo '<tr style="background: linear-gradient(248deg, #348ac7, #7474bf);color: white;">
                                                                             //                                                                                     <td>'.$getExcecTop1['pos_parent'].'</td>
                                                                             //                                                                                     <td>'.$getExcecTop1['child_pos_code'].'</td>
                                                                             //                                                                                     <td>'.$getExcecTop1['emp'].'</td>
                                                                             //                                                                                     <td>'.$getExcecTop1['parent_parentpath'].'</td>
                                                                             //                                                                                     <td></td>
                                                                             //                                                                                     <td>'.$getExcecTop1['parent_orderid'].'</td>
                                                                             //                                                                              </tr>';

                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];
                                                                             $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                             $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                                                          
                                                                             $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                                             $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                                             $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                                                                                       
                                                                             $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+99*$upd_One_Parent_unik;
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                                                                
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                    (
                                                                                                                                                                                                           `position_id`,
                                                                                                                                                                                                           `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                           `pos_level`,
                                                                                                                                                                                                           `parent_path`,
                                                                                                                                                                                                           `parent_id`,
                                                                                                                                                                                                           `flag_add`
                                                                                                                                                                                                    ) VALUES 
                                                                                                                                                                                                           (
                                                                                                                                                                                                                  '$add_One_Create_Unique',
                                                                                                                                                                                                                  'INSERT_GAP-9-1_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                  '$add_One_Parent',
                                                                                                                                                                                                                  '$add_One_Parent_Path',
                                                                                                                                                                                                                  '$getExcecTop1[pos_parent]',
                                                                                                                                                                                                                  '1'
                                                                                                                                                                                                           )");
                                                                                                                
                                                                                                                                                                                                           // echo "<p style='color: green;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                           // (
                                                                                                                                                                                                           //        `position_id`,
                                                                                                                                                                                                           //        `pos_level`,
                                                                                                                                                                                                           //        `parent_path`,
                                                                                                                                                                                                           //        `parent_id`,
                                                                                                                                                                                                           //        `flag_add`
                                                                                                                                                                                                           // ) VALUES 
                                                                                                                                                                                                           //        (
                                                                                                                                                                                                           //               '$add_One_Create_Unique',
                                                                                                                                                                                                           //               '$add_One_Parent',
                                                                                                                                                                                                           //               '$add_One_Parent_Path',
                                                                                                                                                                                                           //               '$getExcecTop1[pos_parent]',
                                                                                                                                                                                                           //               '1'
                                                                                                                                                                                                           //        ) [GAP7]"."</p>";
                                                                                                                
                                                                                                                                                                 if($process_INS_add_One){

                                                                                                                                                                        $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];
                                                                                                                                                                        $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                        $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                          
                                                                                                                                                                        $add_Two_Parent = $getExcecTop1['parent_orderid']+2;
                                                                                                                                                                        $add_Two_Up_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                                                                                        $add_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                                                                                                                        
                                                                                                                                                                        $add_Two_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+110*$upd_One_Parent_unik;
                                                                                                                                                                        $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                                                                                        if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                                                                                        } else {
                                                                                                                                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                                                                                        }
                                                                                                                                                                        $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                                                                
                                                                                                                                                                        $process_INS_add_Two = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                    (
                                                                                                                                                                                                           `position_id`,
                                                                                                                                                                                                           `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                           `pos_level`,
                                                                                                                                                                                                           `parent_path`,
                                                                                                                                                                                                           `parent_id`,
                                                                                                                                                                                                           `flag_add`
                                                                                                                                                                                                    ) VALUES 
                                                                                                                                                                                                           (
                                                                                                                                                                                                                  '$add_Two_Create_Unique',
                                                                                                                                                                                                                  'INSERT_GAP-9-2_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                  '$add_Two_Parent',
                                                                                                                                                                                                                  '$add_Two_Parent_Path',
                                                                                                                                                                                                                  '$add_One_Create_Unique',
                                                                                                                                                                                                                  '1'
                                                                                                                                                                                                           )");
                                                                                                                
                                                                                                                                                                                                           // echo "<p style='color: #72bce8 ;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                           // (
                                                                                                                                                                                                           //        `position_id`,
                                                                                                                                                                                                           //        `pos_level`,
                                                                                                                                                                                                           //        `parent_path`,
                                                                                                                                                                                                           //        `parent_id`,
                                                                                                                                                                                                           //        `flag_add`
                                                                                                                                                                                                           // ) VALUES 
                                                                                                                                                                                                           //        (
                                                                                                                                                                                                           //               '$add_Two_Create_Unique',
                                                                                                                                                                                                           //               '$add_Two_Parent',
                                                                                                                                                                                                           //               '$add_Two_Parent_Path',
                                                                                                                                                                                                           //               '$add_One_Create_Unique',
                                                                                                                                                                                                           //               '1'
                                                                                                                                                                                                           //        ) [GAP7]"."</p>";
                                                                                                                                                                        if($process_INS_add_Two){

                                                                                                                                                                               $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];
                                          
                                                                                                                                                                               $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                               $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                          
                                                                                                                                                                               $add_Three_Parent = $getExcecTop1['parent_orderid']+3;
                                                                                                                                                                               $add_Three_Up_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                                                                                               $add_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                                                                                                                               
                                                                                                                                                                               $add_Three_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+111*$upd_One_Parent_unik;
                                                                                                                                                                               $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                                                                                               if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                      $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                                                                                               } else {
                                                                                                                                                                                      $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                                                                                               }
                                          
                                                                                                                                                                               $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                                                                
                                                                                                                                                                               $process_INS_add_Three = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                           (
                                                                                                                                                                                                                  `position_id`,
                                                                                                                                                                                                                  `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                  `pos_level`,
                                                                                                                                                                                                                  `parent_path`,
                                                                                                                                                                                                                  `parent_id`,
                                                                                                                                                                                                                  `flag_add`
                                                                                                                                                                                                           ) VALUES 
                                                                                                                                                                                                                  (
                                                                                                                                                                                                                         '$add_Three_Create_Unique',
                                                                                                                                                                                                                         'INSERT_GAP-9-3_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                         '$add_Three_Parent',
                                                                                                                                                                                                                         '$add_Three_Parent_Path',
                                                                                                                                                                                                                         '$add_Two_Create_Unique',
                                                                                                                                                                                                                         '1'
                                                                                                                                                                                                                  )");
                                                                                                                
                                                                                                                                                                                                                  // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                  // (
                                                                                                                                                                                                                  //        `position_id`,
                                                                                                                                                                                                                  //        `pos_level`,
                                                                                                                                                                                                                  //        `parent_path`,
                                                                                                                                                                                                                  //        `parent_id`,
                                                                                                                                                                                                                  //        `flag_add`
                                                                                                                                                                                                                  // ) VALUES 
                                                                                                                                                                                                                  //        (
                                                                                                                                                                                                                  //               '$add_Three_Create_Unique',
                                                                                                                                                                                                                  //               '$add_Three_Parent',
                                                                                                                                                                                                                  //               '$add_Three_Parent_Path',
                                                                                                                                                                                                                  //               '$add_Two_Create_Unique',
                                                                                                                                                                                                                  //               '1'
                                                                                                                                                                                                                  //        ) [GAP6]"."</p>";
                                                                                                                
                                                                                                                
                                                                                                                                                                               if($process_INS_add_Three){

                                                                                                                                                                                      $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];
                                          
                                                                                                                                                                                      $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                                      $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                                                                                      
                                                                                                                                                                                      $add_Four_Parent = $getExcecTop1['parent_orderid']+4;
                                                                                                                                                                                      $add_Four_Up_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                                                                                      $add_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                                                                                                                
                                                                                                                                                                                      $add_Four_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+112*$upd_One_Parent_unik;
                                                                                                                                                                                      $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                                                                      if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                             $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                                                                                      } else {
                                                                                                                                                                                             $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                                                                                      }
                                                                                                                                                                                      $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                                                                                                
                                                                                                                                                                                      $process_INS_add_Four = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                           (
                                                                                                                                                                                                                  `position_id`,
                                                                                                                                                                                                                  `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                  `pos_level`,
                                                                                                                                                                                                                  `parent_path`,
                                                                                                                                                                                                                  `parent_id`,
                                                                                                                                                                                                                  `flag_add`
                                                                                                                                                                                                           ) VALUES 
                                                                                                                                                                                                                  (
                                                                                                                                                                                                                         '$add_Four_Create_Unique',
                                                                                                                                                                                                                         'INSERT_GAP-9-4_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                         '$add_Four_Parent',
                                                                                                                                                                                                                         '$add_Four_Parent_Path',
                                                                                                                                                                                                                         '$add_Three_Create_Unique',
                                                                                                                                                                                                                         '1'
                                                                                                                                                                                                                  )");
                                                                                                                
                                                                                                                                                                                                                  // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                  // (
                                                                                                                                                                                                                  //        `position_id`,
                                                                                                                                                                                                                  //        `pos_level`,
                                                                                                                                                                                                                  //        `parent_path`,
                                                                                                                                                                                                                  //        `parent_id`,
                                                                                                                                                                                                                  //        `flag_add`
                                                                                                                                                                                                                  // ) VALUES 
                                                                                                                                                                                                                  //        (
                                                                                                                                                                                                                  //               '$add_Four_Create_Unique',
                                                                                                                                                                                                                  //               '$add_Four_Parent',
                                                                                                                                                                                                                  //               '$add_Four_Parent_Path',
                                                                                                                                                                                                                  //               '$add_Three_Create_Unique',
                                                                                                                                                                                                                  //               '1'
                                                                                                                                                                                                                  //        ) [GAP6]"."</p>";
                                                                                                                                                                                       if($process_INS_add_Four){
                                                                                                                                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                                                                             $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                                             $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                          
                                                                                                                                                                                             $add_Five_Parent = $getExcecTop1['parent_orderid']+5;
                                                                                                                                                                                             $add_Five_Up_Parent = $getExcecTop1['parent_orderid']+6;
                                                                                                                                                                                             $add_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                          
                                                                                                                                                                                             $add_Five_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+113*$upd_One_Parent_unik;
                                                                                                                                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                    $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                                                                                             } else {
                                                                                                                                                                                                    $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                                                                                             }
                                                                                                                                                                                             
                                                                                                                                                                                             $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                                                                                             
                                                                                                                                                                                             $process_INS_add_Six = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                                              (
                                                                                                                                                                                                                                                     `position_id`,
                                                                                                                                                                                                                                                     `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                                                     `pos_level`,
                                                                                                                                                                                                                                                     `parent_path`,
                                                                                                                                                                                                                                                     `parent_id`,
                                                                                                                                                                                                                                                     `flag_add`
                                                                                                                                                                                                                                              ) VALUES 
                                                                                                                                                                                                                                                     (
                                                                                                                                                                                                                                                            '$add_Five_Create_Unique',
                                                                                                                                                                                                                                                            'INSERT_GAP-9-5_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                                                            '$add_Five_Parent',
                                                                                                                                                                                                                                                            '$add_Five_Parent_Path',
                                                                                                                                                                                                                                                            '$add_Four_Create_Unique',
                                                                                                                                                                                                                                                            '1'
                                                                                                                                                                                                                                                     )");
                                                                                                                
                                                                                                                                                                                                                                                     // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                                                     // (
                                                                                                                                                                                                                                                     //        `position_id`,
                                                                                                                                                                                                                                                     //        `pos_level`,
                                                                                                                                                                                                                                                     //        `parent_path`,
                                                                                                                                                                                                                                                     //        `parent_id`,
                                                                                                                                                                                                                                                     //        `flag_add`
                                                                                                                                                                                                                                                     // ) VALUES 
                                                                                                                                                                                                                                                     //        (
                                                                                                                                                                                                                                                     //               '$add_Five_Create_Unique',
                                                                                                                                                                                                                                                     //               '$add_Five_Parent',
                                                                                                                                                                                                                                                     //               '$add_Five_Parent_Path',
                                                                                                                                                                                                                                                     //               '$add_Four_Create_Unique',
                                                                                                                                                                                                                                                     //               '1'
                                                                                                                                                                                                                                                     //        )";
                                                                                                                                                                                             
                                                                                                                                                                                             if($process_INS_add_Six){

                                                                                                                                                                                                    $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                                                                                    $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                                                    $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                
                                                                                                                                                                                                    $add_Six_Parent = $getExcecTop1['parent_orderid']+6;
                                                                                                                                                                                                    $add_Six_Up_Parent = $getExcecTop1['parent_orderid']+7;
                                                                                                                                                                                                    $add_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                          
                                                                                                                                                                                                    $add_Six_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+114*$upd_One_Parent_unik;
                                                                                                                                                                                                    $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Six_Create_Unique_Declare'");
                                                                                                                                                                                                    if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                           $add_Six_Create_Unique = $add_Six_Create_Unique_Declare+$add_Six_Create_Unique_Declare;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                           $add_Six_Create_Unique = $add_Six_Create_Unique_Declare;
                                                                                                                                                                                                    }
                                                                                                                                                                                      
                                                                                                                                                                                                    $upd_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                                                                                    
                                                                                                                                                                                                    $process_INS_add_Sevent = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                                                     (
                                                                                                                                                                                                                                                            `position_id`,
                                                                                                                                                                                                                                                            `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                                                            `pos_level`,
                                                                                                                                                                                                                                                            `parent_path`,
                                                                                                                                                                                                                                                            `parent_id`,
                                                                                                                                                                                                                                                            `flag_add`
                                                                                                                                                                                                                                                     ) VALUES 
                                                                                                                                                                                                                                                            (
                                                                                                                                                                                                                                                                   '$add_Six_Create_Unique',
                                                                                                                                                                                                                                                                   'INSERT_GAP-9-6_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                                                                   '$add_Six_Parent',
                                                                                                                                                                                                                                                                   '$add_Six_Parent_Path',
                                                                                                                                                                                                                                                                   '$add_Five_Create_Unique',
                                                                                                                                                                                                                                                                   '1'
                                                                                                                                                                                                                                                            )");
                                                                                                                
                                                                                                                                                                                                                                                            // echo "<p style='color: blue;'>"."ulala INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                                                            // (
                                                                                                                                                                                                                                                            //        `position_id`,
                                                                                                                                                                                                                                                            //        `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                                                            //        `pos_level`,
                                                                                                                                                                                                                                                            //        `parent_path`,
                                                                                                                                                                                                                                                            //        `parent_id`,
                                                                                                                                                                                                                                                            //        `flag_add`
                                                                                                                                                                                                                                                            // ) VALUES 
                                                                                                                                                                                                                                                            //        (
                                                                                                                                                                                                                                                            //               '$add_Six_Create_Unique',
                                                                                                                                                                                                                                                            //               'INSERT_GAP-8-6_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                                                            //               '$add_Six_Parent',
                                                                                                                                                                                                                                                            //               '$add_Six_Parent_Path',
                                                                                                                                                                                                                                                            //               '$add_Five_Create_Unique',
                                                                                                                                                                                                                                                            //               '1'
                                                                                                                                                                                                                                                            //        )";
                                                                                                                                                                                                    if($process_INS_add_Sevent){

                                                                                                                                                                                                           $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                            $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                            $ext_dir_id = $getExcecTop1['direktorat_id'];
                                          
                                                                                                                                                                                                           $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                                                           $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                
                                                                                                                                                                                                           $add_Seven_Parent = $getExcecTop1['parent_orderid']+7;
                                                                                                                                                                                                           $add_Seven_Up_Parent = $getExcecTop1['parent_orderid']+8;
                                                                                                                                                                                                           $add_Seven_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique.",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                                                                                           
                                                                                                                                                                                                           $add_Seven_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+115*$upd_One_Parent_unik;
                                                                                                                                                                                                           $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Seven_Create_Unique_Declare'");
                                                                                                                                                                                                           if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                                  $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare+$add_Seven_Create_Unique_Declare;
                                                                                                                                                                                                           } else {
                                                                                                                                                                                                                  $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare;
                                                                                                                                                                                                           }
                                                                                                                                                                                                           
                                                                                                                                                                                                           $upd_Seven_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Six_Create_Unique.",".$add_Seven_Create_Unique;
                                                                                                                
                                                                                                                                                                                                           $process_INS_add_Eight = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                                                     (
                                                                                                                                                                                                                                                            `position_id`,
                                                                                                                                                                                                                                                            `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                                                            `pos_level`,
                                                                                                                                                                                                                                                            `parent_path`,
                                                                                                                                                                                                                                                            `parent_id`,
                                                                                                                                                                                                                                                            `flag_add`
                                                                                                                                                                                                                                                     ) VALUES 
                                                                                                                                                                                                                                                            (
                                                                                                                                                                                                                                                                   '$add_Seven_Create_Unique',
                                                                                                                                                                                                                                                                   'INSERT_GAP-9-7_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                                                                   '$add_Seven_Parent',
                                                                                                                                                                                                                                                                   '$add_Seven_Parent_Path',
                                                                                                                                                                                                                                                                   '$add_Six_Create_Unique',
                                                                                                                                                                                                                                                                   '1'
                                                                                                                                                                                                                                                            )");
                                                                                                                
                                                                                                                                                                                                                                                            // echo "<p style='color: blue;'>"."INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                                                            // (
                                                                                                                                                                                                                                                            //        `position_id`,
                                                                                                                                                                                                                                                            //        `pos_level`,
                                                                                                                                                                                                                                                            //        `parent_path`,
                                                                                                                                                                                                                                                            //        `parent_id`,
                                                                                                                                                                                                                                                            //        `flag_add`
                                                                                                                                                                                                                                                            // ) VALUES 
                                                                                                                                                                                                                                                            //        (
                                                                                                                                                                                                                                                            //               '$add_Seven_Create_Unique',
                                                                                                                                                                                                                                                            //               '$add_Seven_Parent',
                                                                                                                                                                                                                                                            //               '$add_Seven_Parent_Path',
                                                                                                                                                                                                                                                            //               '$add_Five_Create_Unique',
                                                                                                                                                                                                                                                            //               '1'
                                                                                                                                                                                                                                                            //        )";
                                                                                                                                                                                                           
                                                                                                                                                                                                           if($process_INS_add_Eight){

                                                                                                                                                                                                                  $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                                                                                                                                                                  $ext_div_id = $getExcecTop1['division_id'];
                                                                                                                                                                                                                  $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                                                                                                                                                                  $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                                                                                                                                                                  $upd_One_Parent_unik = $getExcecTop1['pos_child'];

                                                                                                                                                                                                                  $add_Eight_Parent = $getExcecTop1['parent_orderid']+8;
                                                                                                                                                                                                                  $add_Eight_Up_Parent = $getExcecTop1['parent_orderid']+9;
                                                                                                                                                                                                                  $add_Eight_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique.",".$add_Three_Create_Unique.",".$add_Four_Create_Unique.",".$add_Five_Create_Unique.",".$add_Six_Create_Unique.",".$add_Seven_Create_Unique;
                                                                                                                
                                                                                                                                                                                                                  $add_Eight_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+116*$upd_One_Parent_unik;
                                                                                                                                                                                                                  $condition = mysqli_query($connect, "SELECT position_id as total FROM od_teomposition_b1 WHERE position_id = 'add_Eight_Create_Unique_Declare'");
                                                                                                                                                                                                                  if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                                         $add_Eight_Create_Unique = $add_Eight_Create_Unique_Declare+$add_Eight_Create_Unique_Declare;
                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                         $add_Eight_Create_Unique = $add_Eight_Create_Unique_Declare;
                                                                                                                                                                                                                  }

                                                                                                                                                                                                                  $upd_Eight_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Six_Create_Unique.",".$add_Seven_Create_Unique.",".$add_Eight_Create_Unique;

                                                                                                                                                                                                                  $process_INS_add_Nine = mysqli_query($connect, "INSERT INTO od_teomposition_b1 
                                                                                                                                                                                                                                                     (
                                                                                                                                                                                                                                                            `position_id`,
                                                                                                                                                                                                                                                            `pos_code`,`ext_department_id`,`ext_division_id`,`ext_directorat_id`,
                                                                                                                                                                                                                                                            `pos_level`,
                                                                                                                                                                                                                                                            `parent_path`,
                                                                                                                                                                                                                                                            `parent_id`,
                                                                                                                                                                                                                                                            `flag_add`
                                                                                                                                                                                                                                                     ) VALUES 
                                                                                                                                                                                                                                                            (
                                                                                                                                                                                                                                                                   '$add_Eight_Create_Unique$upd_One_Parent_unik',
                                                                                                                                                                                                                                                                   'INSERT_GAP-9-8_$upd_One_Parent_unik','$ext_dep_id','$ext_div_id','$ext_dir_id',
                                                                                                                                                                                                                                                                   '$add_Eight_Parent',
                                                                                                                                                                                                                                                                   '$add_Eight_Parent_Path',
                                                                                                                                                                                                                                                                   '$add_Seven_Create_Unique',
                                                                                                                                                                                                                                                                   '1'
                                                                                                                                                                                                                                                            )");

                                                                                                                                                                                                           if($process_INS_add_Eight){
                                                                                                                                                                                                           
                                                                                                                                                                                                           $process_UPD_add_Seven = mysqli_query($connect, "UPDATE od_teomposition_b1 SET 
                                                                                                                                                                                                                                                                          `parent_path` = '$upd_Eight_Parent_Path',
                                                                                                                                                                                                                                                                          `restruct_remark` = '{{UPDATE+GAP9-new}} UPDATE od_teomposition_b1 SET 
                                          [parent_path] = {{$upd_Eight_Parent_Path}}|
                                          [parent_id] = {{$add_Eight_Create_Unique}}
                                          WHERE 
                                          [pos_level] = {{$add_Eight_Up_Parent}} AND
                                          [parent_path] = {{$upd_One_Parent}}',
                                                                                                                                                                                                                                                                          `parent_id` = '$add_Eight_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                                                                                                                                   WHERE 
                                                                                                                                                                                                                                                                          `pos_level` = '$add_Eight_Up_Parent' AND
                                                                                                                                                                                                                                                                          `parent_path` = '$upd_One_Parent'");
                                                                                                                                                                                                                  // echo "UPDATE od_teomposition_b1 SET 
                                                                                                                                                                                                                  //                      `parent_path` = '$upd_Eight_Parent_Path',
                                                                                                                                                                                                                  //                      `parent_id` = '$add_Eight_Create_Unique'
                                                                                                                                                                                                                  //               WHERE 
                                                                                                                                                                                                                  //                      `pos_level` = '$add_Eight_Up_Parent' AND
                                                                                                                                                                                                                  //                      `parent_path` = '$upd_One_Parent'"."<br>";
                                                                                                                                                                                                                  }
                                                                                                                                                                                                           }
                                                                                                                                                                                                    }
                                                                                                                                                                                             }
                                                                                                                                                                                      }
                                                                                                                                                                               }
                                                                                                                                                                        }      
                                                                                                                                                                 }
                                                        } 
                                                 }
                                                        if($get_GT_JMGR) {
                                                               {
                                                               
                                                                      $process_INS_SP = mysqli_query($connect,  'CALL delposisi()');

                                                                      if($process_INS_SP) {
                                                                             $process_INS_SIMPOSISI = mysqli_query($connect, "TRUNCATE `od_simposisi`");
                                                                             $process_INS_SIMPOSISI = mysqli_query($connect, "INSERT IGNORE INTO od_simposisi
                                                                                                                       (	
                                                                                                                              posisi_id,
                                                                                                                              kode_posisi,
                                                                                                                              nama_posisi,
                                                                                                                              parent,
                                                                                                                              parent_path,
                                                                                                                              flagadd,
                                                                                                                              people_id,
                                                                                                                              orderid,
                                                                                                                              parent_path_reference,
                                                                                                                              restruct_remark,
                                                                                                                              departemen_id,
                                                                                                                              division_id,
                                                                                                                              direktorat_id
                                                                                                                       ) 
                                                                                                                       
                                                                                                                       SELECT 
                                                                                                                              position_id,
                                                                                                                              pos_code,
                                                                                                                              pos_name_en,
                                                                                                                              parent_id,
                                                                                                                              parent_path,
                                                                                                                              flag_add,
                                                                                                                              emp_id,
                                                                                                                              pos_level,
                                                                                                                              parent_path_reference,
                                                                                                                              restruct_remark,
                                                                                                                              ext_department_id,
                                                                                                                              ext_division_id,
                                                                                                                              ext_directorat_id
                                                                                                                       FROM
                                                                                                                       od_teomposition_b1 where flag_del = '0'");
                                                                             $process_INS_SIMPOSISI = mysqli_query($connect, "UPDATE od_simposisi SET parent = '0' WHERE parent = '111122223333'");
                                                                             $process_INS_SIMPOSISI = mysqli_query($connect, "INSERT INTO `od_simposisi` 
                                                                                                                       (
                                                                                                                              `posisi_id`, 
                                                                                                                              `kode_posisi`, 
                                                                                                                              `nama_posisi`, 
                                                                                                                              `parent`, 
                                                                                                                              `parent_path`, 
                                                                                                                              `parent_path_reference`, 
                                                                                                                              `cabang_id`, 
                                                                                                                              `people_id`, 
                                                                                                                              `flagadd`, 
                                                                                                                              `orderId`
                                                                                                                       ) 
                                                                                                                              VALUES 
                                                                                                                                     (
                                                                                                                                            '0', 
                                                                                                                                            '0', 
                                                                                                                                            '0', 
                                                                                                                                            'X', 
                                                                                                                                            '0,5793', 
                                                                                                                                            '0,5793', 
                                                                                                                                            '0', 
                                                                                                                                            '', 
                                                                                                                                            '0', 
                                                                                                                                            '0'
                                                                                                                                     )");
                                                                             $process_INS_SIMPOSISI = mysqli_query($connect, "DELETE FROM `od_simposisi` WHERE  `people_id`='' AND `posisi_id`='0'");
                                                                             $process_INS_SIMPOSISI = mysqli_query($connect, "DELETE FROM od_simposisi WHERE posisi_id IN
                                                                                                                       (
                                                                                                                              SELECT
                                                                                                                              a.posisi_id
                                                                                                                              FROM
                                                                                                                              od_simposisi a
                                                                                                                              LEFT JOIN od_simposisi b ON a.posisi_id=b.parent
                                                                                                                              WHERE a.kode_posisi LIKE '%insert%' AND
                                                                                                                              b.parent IS NULL
                                                                                                                       )");                                          
                                                                             $process_INS_SIMPOSISI = mysqli_query($connect, "DELETE FROM `od_simposisi` WHERE  `people_id`='' AND `posisi_id`='0'");

                                                                             echo '<script type="text/javascript">
                                                                                    window.alert("Selesai Simposisi");
                                                                             </script>';

                                                                             if($process_INS_SIMPOSISI){


                                                                                    ///TEST HAPUS DULU      
                                                                                    // Step Update OJI

                                                                                    // Update Depertamen ID to 0, order 8
                                                                                    $updatedept_order8   = mysqli_query($connect, "UPDATE od_simposisi SET departemen_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '8' 
                                                                                    AND (a.departemen_id <> '' AND a.departemen_id <> '0'))");

                                                                                    // Update Depertamen ID to 0, order 7
                                                                                    $updatedept_order7   = mysqli_query($connect, "UPDATE od_simposisi SET departemen_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '7' 
                                                                                    AND (a.departemen_id <> '' AND a.departemen_id <> '0'))");

                                                                                    // Update Depertamen ID to 0, order 6
                                                                                    $updatedept_order6   = mysqli_query($connect, "UPDATE od_simposisi SET departemen_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '6' 
                                                                                    AND (a.departemen_id <> '' AND a.departemen_id <> '0'))");

                                                                                    // Update Depertamen ID to 0, order 5
                                                                                    $updatedept_order5   = mysqli_query($connect, "UPDATE od_simposisi SET departemen_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '5' 
                                                                                    AND (a.departemen_id <> '' AND a.departemen_id <> '0'))");

                                                                                    // Update Depertamen ID to 0, order 4
                                                                                    $updatedept_order4   = mysqli_query($connect, "UPDATE od_simposisi SET departemen_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '4' 
                                                                                    AND (a.departemen_id <> '' AND a.departemen_id <> '0'))");

                                                                                    // Update Depertamen ID to 0, order 3
                                                                                    $updatedept_order3   = mysqli_query($connect, "UPDATE od_simposisi SET departemen_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '3' 
                                                                                    AND (a.departemen_id <> '' AND a.departemen_id <> '0'))");

                                                                                    // Update Division ID to 0, order 6
                                                                                    $updatediv_order6   = mysqli_query($connect, "UPDATE od_simposisi SET division_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '6' 
                                                                                    AND (a.division_id <> '' AND a.division_id <> '0'))");

                                                                                    // Update Division ID to 0, order 5
                                                                                    $updatediv_order5   = mysqli_query($connect, "UPDATE od_simposisi SET division_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '5' 
                                                                                    AND (a.division_id <> '' AND a.division_id <> '0'))");

                                                                                    // Update Division ID to 0, order 4
                                                                                    $updatediv_order4   = mysqli_query($connect, "UPDATE od_simposisi SET division_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '4' 
                                                                                    AND (a.division_id <> '' AND a.division_id <> '0'))");

                                                                                    // Update Division ID to 0, order 3
                                                                                    $updatediv_order3   = mysqli_query($connect, "UPDATE od_simposisi SET division_id = '0' 
                                                                                    WHERE posisi_id IN (SELECT a.posisi_id FROM od_simposisi a 
                                                                                    WHERE a.flagadd = '1' 
                                                                                    AND a.orderId = '3' 
                                                                                    AND (a.division_id <> '' AND a.division_id <> '0'))");

                                                                                    // Step OJI
                                                                                    echo '<script>
                                                                                                  window.alert("Selesai Hapus garis od_simposisi");
                                                                                           </script>';

                                                                                    // Step Make od_Simposisi All Direktorat OJI
                                                                                    $process_del_simposisiall = mysqli_query($connect, "TRUNCATE od_simposisidir");
                                                                                    $insert_allsimposisi = mysqli_query($connect, "INSERT IGNORE INTO od_simposisidir                                                             
                                                                                                         
                                                                                    select                
                                                                                    a.posisi_id,          
                                                                                    a.kode_posisi,        
                                                                                    a.nama_posisi,        
                                                                                    a.parent,             
                                                                                    a.restruct_remark,    
                                                                                    a.parent_path,        
                                                                                    a.parent_path_reference,
                                                                                    a.cabang_id,          
                                                                                    a.active_status,      
                                                                                    a.people_id,          
                                                                                    a.pembinaan,          
                                                                                    a.hari,               
                                                                                    a.jam,                
                                                                                    a.flagadd,            
                                                                                    a.up,                 
                                                                                    a.down,               
                                                                                    a.orderId,            
                                                                                    a.departemen_id,      
                                                                                    a.division_id,        
                                                                                    a.direktorat_id       
                                                                                    FROM od_simposisi a      
                                                                                    WHERE a.orderId <= '7'

                                                                                                         
                                                                                                         ");
                                                                                    // Step Make od_Simposisi All Direktorat OJI
                                                                                    echo '<script>
                                                                                                  window.alert("Selesai insert od_simposisidir");
                                                                                           </script>';
                                                                                    // Step delete garis yang terpakai All Direktorat OJI
                                                                                    if($insert_allsimposisi){
                                                                                           $delete_garis_7      = mysqli_query($connect, "DELETE FROM od_simposisidir WHERE posisi_id IN (
                                                                                                  SELECT a.posisi_id
                                                                                                  FROM od_simposisidir a 
                                                                                                  LEFT JOIN od_simposisidir b ON b.parent = a.posisi_id
                                                                                                  WHERE a.flagadd = '1' AND a.orderId = '7'
                                                                                                  AND b.posisi_id IS NULL )");
                                                                                           if($delete_garis_7){
                                                                                                  $delete_garis_6      = mysqli_query($connect, "DELETE FROM od_simposisidir WHERE posisi_id IN (
                                                                                                         SELECT a.posisi_id
                                                                                                         FROM od_simposisidir a 
                                                                                                         LEFT JOIN od_simposisidir b ON b.parent = a.posisi_id
                                                                                                         WHERE a.flagadd = '1' AND a.orderId = '6'
                                                                                                         AND b.posisi_id IS NULL )");
                                                                                                  if($delete_garis_6){
                                                                                                         $delete_garis_5      = mysqli_query($connect, "DELETE FROM od_simposisidir WHERE posisi_id IN (
                                                                                                                SELECT a.posisi_id
                                                                                                                FROM od_simposisidir a 
                                                                                                                LEFT JOIN od_simposisidir b ON b.parent = a.posisi_id
                                                                                                                WHERE a.flagadd = '1' AND a.orderId = '5'
                                                                                                                AND b.posisi_id IS NULL )");
                                                                                                         if($delete_garis_5){
                                                                                                                $delete_garis_4      = mysqli_query($connect, "DELETE FROM od_simposisidir WHERE posisi_id IN (
                                                                                                                       SELECT a.posisi_id
                                                                                                                       FROM od_simposisidir a 
                                                                                                                       LEFT JOIN od_simposisidir b ON b.parent = a.posisi_id
                                                                                                                       WHERE a.flagadd = '1' AND a.orderId = '4'
                                                                                                                       AND b.posisi_id IS NULL )");
                                                                                                                if($delete_garis_4){
                                                                                                                       $delete_garis_3      = mysqli_query($connect, "DELETE FROM od_simposisidir WHERE posisi_id IN (
                                                                                                                              SELECT a.posisi_id
                                                                                                                              FROM od_simposisidir a 
                                                                                                                              LEFT JOIN od_simposisidir b ON b.parent = a.posisi_id
                                                                                                                              WHERE a.flagadd = '1' AND a.orderId = '3'
                                                                                                                              AND b.posisi_id IS NULL )");

                                                                                                                       if($delete_garis_3){
                                                                                                                              echo"<script type='text/javascript'>
                                                                                                                              window.alert('Berhasil Semuanya Gaes!!'); 
                                                                                                                              $('#image').fadeOut('slow');  
                                                                                                                              $('#imagebg').fadeOut('slow');  
                                                                                                                              $('#loadings').fadeOut('slow'); 
                                                                                                                              window.redirect('/interface-od');
                                                                                                                              window.location.href = 'https://tm.dev.gthris.com/hrm/hrm{sys=org.vieworg}/interface_od/';
                                                                                                                              </script>"; 
                                                                                                                       }
                                                                                                                }
                                                                                                         }
                                                                                                  }
                                                                                           }
                                                                                    }
                                                                                    // Step delete garis yang terpakai All Direktorat OJI
                                                                                    // TUTUP AGUS DEL

                                                                             }
                                                                      }
                                                                      

                                                                      

                                                                            


                                                                



                                                               }

                                                        // STOPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPPP
                                                 }
                                                       
                                          }  
	?>
<!-- </table> -->