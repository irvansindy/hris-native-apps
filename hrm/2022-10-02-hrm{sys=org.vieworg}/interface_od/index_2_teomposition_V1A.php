$SFdatetime             = date("Y-m-d H:i:s");
                         
       
		$no = 0;
		$SFdatetime             	= date("Y-m-d H:i:s");
              
              $process_DEL = mysqli_query($connect, "TRUNCATE teomposition_b1");
              $process_INS = mysqli_query($connect, "INSERT IGNORE INTO teomposition_b1 
                                                
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
                                                        d.people_id as emp_no,
                                                        c.parent_path,
                                                        a.departemen_id,
                                                        a.division_id,
                                                        a.direktorat_id
                                                 FROM tempmigratefinaldata a
                                                 LEFT JOIN teomposition c on a.pos_child=c.position_id
                                                 LEFT JOIN tempmigrateposition d on d.posisi_id=a.pos_child
                                                 
                                                 ");

		if($process_INS) {
                     $get_GT_JMGR	= mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp,a.* FROM teomposition_b1 a LEFT JOIN view_employee b on a.pos_code=b.pos_code WHERE a.gap > '1' ORDER BY a.parent_path ASC");
                     while($r=mysqli_fetch_array($get_GT_JMGR)){
                     $no++;

                     
       if($r['gap'] == '2'){
                                   $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
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
                                   $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                   if(mysqli_num_rows($condition) > 0){
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                   } else {
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                   }
                                   $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                   $upd_One_Parent_Path_20211007 = $getExcecTop1['parent_parentpath'];

                                   $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                        $process_UPD_add_One = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                `parent_path` = '$upd_One_Parent_Path',
                                                                                                                `restruct_remark` = '{{UPDATE+GAP2-new}} UPDATE teomposition_b1 SET 
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
                                   $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
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
                                   $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                   if(mysqli_num_rows($condition) > 0){
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                   } else {
                                          $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                   }
                                   $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;

                                   $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                        $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                        if(mysqli_num_rows($condition) > 0){
                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                        } else {
                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                        }
                                                        $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;

                                                        $process_INS_add_Two = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                               $process_UPD_add_Two = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                       `parent_path` = '$upd_Two_Parent_Path',
                                                                                                                       `restruct_remark` = '{{UPDATE+GAP3-new}} UPDATE teomposition_b1 SET 
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
                                                 $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
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
                                                 $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                 if(mysqli_num_rows($condition) > 0){
                                                        $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                 } else {
                                                        $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                 }
                                                 $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
              
                                                 $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                      $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                      if(mysqli_num_rows($condition) > 0){
                                                                             $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                      } else {
                                                                             $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                      }
                                                                      $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
              
                                                                      $process_INS_add_Two = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                             }
                                                                             $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
              
                                                                             $process_INS_add_Three = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                    $process_UPD_add_Three = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                                            `parent_path` = '$upd_Three_Parent_Path',
                                                                                                                                            `restruct_remark` = '{{UPDATE+GAP4-new}}  UPDATE teomposition_b1 SET 
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
                                                               $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
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
                                                               $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                               if(mysqli_num_rows($condition) > 0){
                                                                      $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                               } else {
                                                                      $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                               }
                                                               $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                            
                                                               $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                    $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                    if(mysqli_num_rows($condition) > 0){
                                                                                           $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                    } else {
                                                                                           $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                    }
                                                                                    $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                            
                                                                                    $process_INS_add_Two = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                           $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                           if(mysqli_num_rows($condition) > 0){
                                                                                                  $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                           } else {
                                                                                                  $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                           }
                                                                                           $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                            
                                                                                           $process_INS_add_Three = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                  $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                  if(mysqli_num_rows($condition) > 0){
                                                                                                         $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                  } else {
                                                                                                         $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                  }
                                                                                                  $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                            
                                                                                                  $process_INS_add_Four = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                         $process_UPD_add_Four = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                                                                 `parent_path` = '$upd_Four_Parent_Path',
                                                                                                                                                                 `restruct_remark` = '{{UPDATE+GAP5-new}} UPDATE teomposition_b1 SET 
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
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
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
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                          
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                  $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                  if(mysqli_num_rows($condition) > 0){
                                                                                                         $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                  } else {
                                                                                                         $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                  }
                                                                                                  $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                          
                                                                                                  $process_INS_add_Two = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                         $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                         if(mysqli_num_rows($condition) > 0){
                                                                                                                $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                         } else {
                                                                                                                $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                         }
                                                                                                         $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                          
                                                                                                         $process_INS_add_Three = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                if(mysqli_num_rows($condition) > 0){
                                                                                                                       $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                } else {
                                                                                                                       $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                }
                                                                                                                $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                          
                                                                                                                $process_INS_add_Four = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                       $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Five_Create_Unique_Declare'");
                                                                                                                       if(mysqli_num_rows($condition) > 0){
                                                                                                                              $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                       } else {
                                                                                                                              $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                       }

                                                                                                                       $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                       
                                                                                                                       $process_INS_add_Six = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                              $process_UPD_add_Seven = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                                                                                      `parent_path` = '$upd_Five_Parent_Path',
                                                                                                                                                                                      `restruct_remark` = '{{UPDATE+GAP6-new}} UPDATE teomposition_b1 SET 
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
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
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
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                        
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                                if(mysqli_num_rows($condition) > 0){
                                                                                                                       $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                                } else {
                                                                                                                       $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                                }
                                                                                                                $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                        
                                                                                                                $process_INS_add_Two = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                       $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                                       if(mysqli_num_rows($condition) > 0){
                                                                                                                              $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                                       } else {
                                                                                                                              $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                                       }
                                                                                                                       $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                        
                                                                                                                       $process_INS_add_Three = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                              $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                              if(mysqli_num_rows($condition) > 0){
                                                                                                                                     $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                              } else {
                                                                                                                                     $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                              }
                                                                                                                              $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                                        
                                                                                                                              $process_INS_add_Four = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                     $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                     if(mysqli_num_rows($condition) > 0){
                                                                                                                                            $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                                     } else {
                                                                                                                                            $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                                     }

                                                                                                                                     $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                                     
                                                                                                                                     $process_INS_add_Six = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                            $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Six_Create_Unique_Declare'");
                                                                                                                                            if(mysqli_num_rows($condition) > 0){
                                                                                                                                                   $add_Six_Create_Unique = $add_Six_Create_Unique_Declare+$add_Six_Create_Unique_Declare;
                                                                                                                                            } else {
                                                                                                                                                   $add_Six_Create_Unique = $add_Six_Create_Unique_Declare;
                                                                                                                                            }

                                                                                                                                            $upd_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                            
                                                                                                                                            $process_INS_add_Sevent = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                        
                                                                                                                                                                                                   
                                                                                                                                            if($process_INS_add_Sevent){
                                                        
                                                                                                                                                   $process_UPD_add_Seven = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                                                                                                           `parent_path` = '$upd_Six_Parent_Path',
                                                                                                                                                                                                           `restruct_remark` = '{{UPDATE+GAP7-new}} UPDATE teomposition_b1 SET 
[parent_path] = {{$upd_Six_Parent_Path}} |
[parent_id] = {{$add_Six_Create_Unique}}
WHERE 
[pos_level] = {{$add_Six_Up_Parent}} AND
[parent_path] = {{$upd_One_Parent}}',
                                                                                                                                                                                                           `parent_id` = '$add_Six_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                                                                    WHERE 
                                                                                                                                                                                                           `pos_level` = '$add_Six_Up_Parent' AND
                                                                                                                                                                                                           `parent_path` = '$upd_One_Parent'");
                                                                                                                                                 
                                                                                                                                                   }
                                                                                                                                     }
                                                                                                                              }
                                                                                                                       }
                                                                                                                }      
                                                                                                         }


       } else if($r['gap'] == '8'){
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                                             $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                                                                         
                                                                            
                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                             $ext_div_id = $getExcecTop1['division_id'];
                                                                             $ext_dir_id = $getExcecTop1['direktorat_id'];
                                                                                                         
                                                                             $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                             $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                
                                                                             $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                                             $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                                             $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                                             
                                                                             $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*8+88*$upd_One_Parent_unik;
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                      
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                              $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                                              if(mysqli_num_rows($condition) > 0){
                                                                                                                                     $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                                              } else {
                                                                                                                                     $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                                              }
                                                                                                                              $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                      
                                                                                                                              $process_INS_add_Two = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                     $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                                                     if(mysqli_num_rows($condition) > 0){
                                                                                                                                            $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                                                     } else {
                                                                                                                                            $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                                                     }

                                                                                                                                     $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                      
                                                                                                                                     $process_INS_add_Three = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                            $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                            if(mysqli_num_rows($condition) > 0){
                                                                                                                                                   $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                                            } else {
                                                                                                                                                   $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                                            }
                                                                                                                                            $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                                                      
                                                                                                                                            $process_INS_add_Four = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                   $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                                   if(mysqli_num_rows($condition) > 0){
                                                                                                                                                          $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                                                   } else {
                                                                                                                                                          $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                                                   }
                                                                                                                                                   
                                                                                                                                                   $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                                                   
                                                                                                                                                   $process_INS_add_Six = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                          $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Six_Create_Unique_Declare'");
                                                                                                                                                          if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                 $add_Six_Create_Unique = $add_Six_Create_Unique_Declare+$add_Six_Create_Unique_Declare;
                                                                                                                                                          } else {
                                                                                                                                                                 $add_Six_Create_Unique = $add_Six_Create_Unique_Declare;
                                                                                                                                                          }
                                                                                                                                            
                                                                                                                                                          $upd_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                                          
                                                                                                                                                          $process_INS_add_Sevent = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                 $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Seven_Create_Unique_Declare'");
                                                                                                                                                                 if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                        $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare+$add_Seven_Create_Unique_Declare;
                                                                                                                                                                 } else {
                                                                                                                                                                        $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare;
                                                                                                                                                                 }
                                                                                                                                                                 
                                                                                                                                                                 $upd_Seven_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Six_Create_Unique.",".$add_Seven_Create_Unique;
                                                                      
                                                                                                                                                                 $process_INS_add_Eight = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                      
                                                                                                                                                                                                                 
                                                                                                                                                                 
                                                                                                                                                                 if($process_INS_add_Eight){
                                                                      
                                                                                                                                                                        $process_UPD_add_Seven = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                                                                                                                                `parent_path` = '$upd_Seven_Parent_Path',
                                                                                                                                                                                                                                `restruct_remark` = '{{UPDATE+GAP8-new}} UPDATE teomposition_b1 SET 
[parent_path] = {{$upd_Seven_Parent_Path}}|
[parent_id] = {{$add_Seven_Create_Unique}}
WHERE 
[pos_level] = {{$add_Seven_Up_Parent}} AND
[parent_path] = {{$upd_One_Parent}}',
                                                                                                                                                                                                                                `parent_id` = '$add_Seven_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                                                                                         WHERE 
                                                                                                                                                                                                                                `pos_level` = '$add_Seven_Up_Parent' AND
                                                                                                                                                                                                                                `parent_path` = '$upd_One_Parent'");
                                                                                                                                                                       
                                                                                                                                                                                      }
                                                                                                                                                          }
                                                                                                                                                   }
                                                                                                                                            }
                                                                                                                                     }
                                                                                                                              }      
                                                                                                                       }


       } else if($r['gap'] == '9'){
                                                                             $getTop1 = mysqli_query($connect, "SELECT CONCAT(b.emp_no,'-',b.Full_Name) as emp, a.* FROM tempmigratefinaldata a LEFT JOIN view_employee b on a.pos_parent=b.position_id WHERE a.pos_child = $r[position_id]");
                                                                             $getExcecTop1 = mysqli_fetch_array($getTop1);
                                                                                                                                                   
                                                                            

                                                                             $ext_dep_id = $getExcecTop1['departemen_id'];
                                                                             $ext_div_id = $getExcecTop1['division_id'];
                                                                             $ext_dir_id = $getExcecTop1['direktorat_id'];

                                                                             $upd_One_Parent = $getExcecTop1['child_parent_path'];
                                                                             $upd_One_Parent_unik = $getExcecTop1['pos_child'];
                                                                                                                                                          
                                                                             $add_One_Parent = $getExcecTop1['parent_orderid']+1;
                                                                             $add_One_Up_Parent = $getExcecTop1['parent_orderid']+2;
                                                                             $add_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'];
                                                                                                                       
                                                                             $add_One_Create_Unique_Declare = $getExcecTop1['pos_parent']*9+99*$upd_One_Parent_unik;
                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_One_Create_Unique_Declare'");
                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare+$add_One_Create_Unique_Declare;
                                                                             } else {
                                                                                    $add_One_Create_Unique = $add_One_Create_Unique_Declare;
                                                                             }
                                                                             $upd_One_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique;
                                                                                                                
                                                                             $process_INS_add_One = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                        $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Two_Create_Unique_Declare'");
                                                                                                                                                                        if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare+$add_Two_Create_Unique_Declare;
                                                                                                                                                                        } else {
                                                                                                                                                                               $add_Two_Create_Unique = $add_Two_Create_Unique_Declare;
                                                                                                                                                                        }
                                                                                                                                                                        $upd_Two_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_One_Create_Unique.",".$add_Two_Create_Unique;
                                                                                                                
                                                                                                                                                                        $process_INS_add_Two = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                               $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Three_Create_Unique_Declare'");
                                                                                                                                                                               if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                      $add_Three_Create_Unique = $add_Three_Create_Unique_Declare+$add_Three_Create_Unique_Declare;
                                                                                                                                                                               } else {
                                                                                                                                                                                      $add_Three_Create_Unique = $add_Three_Create_Unique_Declare;
                                                                                                                                                                               }
                                          
                                                                                                                                                                               $upd_Three_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Two_Create_Unique.",".$add_Three_Create_Unique;
                                                                                                                
                                                                                                                                                                               $process_INS_add_Three = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                                      $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                                                                      if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                             $add_Four_Create_Unique = $add_Four_Create_Unique_Declare+$add_Four_Create_Unique_Declare;
                                                                                                                                                                                      } else {
                                                                                                                                                                                             $add_Four_Create_Unique = $add_Four_Create_Unique_Declare;
                                                                                                                                                                                      }
                                                                                                                                                                                      $upd_Four_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Three_Create_Unique.",".$add_Four_Create_Unique;
                                                                                                                
                                                                                                                                                                                      $process_INS_add_Four = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                                             $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Four_Create_Unique_Declare'");
                                                                                                                                                                                             if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                    $add_Five_Create_Unique = $add_Five_Create_Unique_Declare+$add_Five_Create_Unique_Declare;
                                                                                                                                                                                             } else {
                                                                                                                                                                                                    $add_Five_Create_Unique = $add_Five_Create_Unique_Declare;
                                                                                                                                                                                             }
                                                                                                                                                                                             
                                                                                                                                                                                             $upd_Five_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Four_Create_Unique.",".$add_Five_Create_Unique;
                                                                                                                                                                                             
                                                                                                                                                                                             $process_INS_add_Six = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                                                    $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Six_Create_Unique_Declare'");
                                                                                                                                                                                                    if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                           $add_Six_Create_Unique = $add_Six_Create_Unique_Declare+$add_Six_Create_Unique_Declare;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                           $add_Six_Create_Unique = $add_Six_Create_Unique_Declare;
                                                                                                                                                                                                    }
                                                                                                                                                                                      
                                                                                                                                                                                                    $upd_Six_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Five_Create_Unique.",".$add_Six_Create_Unique;
                                                                                                                                                                                                    
                                                                                                                                                                                                    $process_INS_add_Sevent = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                                                           $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Seven_Create_Unique_Declare'");
                                                                                                                                                                                                           if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                                  $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare+$add_Seven_Create_Unique_Declare;
                                                                                                                                                                                                           } else {
                                                                                                                                                                                                                  $add_Seven_Create_Unique = $add_Seven_Create_Unique_Declare;
                                                                                                                                                                                                           }
                                                                                                                                                                                                           
                                                                                                                                                                                                           $upd_Seven_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Six_Create_Unique.",".$add_Seven_Create_Unique;
                                                                                                                
                                                                                                                                                                                                           $process_INS_add_Eight = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                                                                  $condition = mysqli_query($connect, "SELECT position_id as total FROM teomposition_b1 WHERE position_id = 'add_Eight_Create_Unique_Declare'");
                                                                                                                                                                                                                  if(mysqli_num_rows($condition) > 0){
                                                                                                                                                                                                                         $add_Eight_Create_Unique = $add_Eight_Create_Unique_Declare+$add_Eight_Create_Unique_Declare;
                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                         $add_Eight_Create_Unique = $add_Eight_Create_Unique_Declare;
                                                                                                                                                                                                                  }

                                                                                                                                                                                                                  $upd_Eight_Parent_Path = $getExcecTop1['parent_parentpath'].",".$getExcecTop1['pos_parent'].",".$add_Six_Create_Unique.",".$add_Seven_Create_Unique.",".$add_Eight_Create_Unique;

                                                                                                                                                                                                                  $process_INS_add_Nine = mysqli_query($connect, "INSERT INTO teomposition_b1 
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
                                                                                                                                                                                                           
                                                                                                                                                                                                           $process_UPD_add_Seven = mysqli_query($connect, "UPDATE teomposition_b1 SET 
                                                                                                                                                                                                                                                                          `parent_path` = '$upd_Eight_Parent_Path',
                                                                                                                                                                                                                                                                          `restruct_remark` = '{{UPDATE+GAP9-new}} UPDATE teomposition_b1 SET 
                                          [parent_path] = {{$upd_Eight_Parent_Path}}|
                                          [parent_id] = {{$add_Eight_Create_Unique}}
                                          WHERE 
                                          [pos_level] = {{$add_Eight_Up_Parent}} AND
                                          [parent_path] = {{$upd_One_Parent}}',
                                                                                                                                                                                                                                                                          `parent_id` = '$add_Eight_Create_Unique$upd_One_Parent_unik'
                                                                                                                                                                                                                                                                   WHERE 
                                                                                                                                                                                                                                                                          `pos_level` = '$add_Eight_Up_Parent' AND
                                                                                                                                                                                                                                                                          `parent_path` = '$upd_One_Parent'");
                                                                                                                                                                                                                 
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
                                                 if($get_GT_JMGR){
                                                        echo"<script type='text/javascript'>
                                                        window.alert('Berhasil insert_teomposition_b1!'); 
                                                        window.redirect('/interface-od');
                                                        </script>"; 
                                                 }