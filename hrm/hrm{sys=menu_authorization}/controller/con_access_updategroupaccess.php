<?php
if (isset($_POST['save'])) {

       $emp_no       = $_POST['emp_no'];
       $active       = $_POST['active'];
       $access_name  = $_POST['access_name'];
       
       if(isset($_POST["framework"]))
       {
        $framework = '';
        foreach($_POST["framework"] as $row)
        {
         $framework .= substr($row,4,4) . ',';
        }
        $framework = substr($framework, 0, -1);
       }
       ?>
       
       <?php 
       if(isset($_POST["framework"]))
       {
        $framework_parent = '';
        foreach($_POST["framework"] as $row)
        {
         $framework_parent .= substr($row,0,3) . "','";
        }
        $framework_parent = substr($framework_parent, 0, -1);
       }
       ?>
       
       <?php $delete_before = mysqli_query($connect, "DELETE FROM hrm_accessgroup WHERE access_code='$emp_no'");  ?>
       
       <?php
       $framework_parentparent_conversion = mysqli_query($connect, "SELECT CONCAT(menu_id, ',') as menu_id FROM hrmmenu WHERE module_code IN ('$framework_parent'') and submenu_id='0'");
       if (mysqli_num_rows($framework_parentparent_conversion) > 0) { ?>
              <?php while ($row = mysqli_fetch_array($framework_parentparent_conversion)) { ?>
       
                            <?php $dataPrint = $row['menu_id'].$framework.',' ; ?>
       
                            <?php
                            $var1 = array(" ");
                            $var2 = array("");
                            $conversion = str_replace($var1, $var2, $dataPrint); 
                            echo substr($conversion,-2,100);
                            ?>
                            
                            <?php 
                            
                            
                            if($delete_before) {
                                   $insert_after = mysqli_query($connect, "INSERT INTO hrm_accessgroup (`access_code`, `access_name`, `formula`, `status`) VALUES ('$emp_no', '$access_name', '$conversion', '$active')");
                                   
                                   if($insert_after) {
                                          $req_app 	= mysqli_fetch_array(mysqli_query($connect, "SELECT access_code, 
                                                                                                         GROUP_CONCAT(formula ORDER BY formula ASC SEPARATOR '') AS formula 
                                                                                                                       FROM hrm_accessgroup
                                                                                                                       WHERE
                                                                                                                       access_code = '$emp_no'
                                                                                                                       GROUP BY access_code"));
                                          $var1 = array("`");
                                          $var2 = array("'");
                                          if($req_app){
                                          $conversion_formula = str_replace($var1, $var2, $req_app['formula']);
                                          } else {
                                          $conversion_formula = "";
                                          }         
                                          $forumla_used = "'".$conversion_formula."'";
       
                                          $update_insert_after = mysqli_query($connect, "UPDATE users_menu_access SET formula = '$forumla_used' WHERE is_acccessgroup_use = '$emp_no'");
                                   }
       
                            }
                            ?>
                           
                     <?php
                     }
       }

       
if($insert_after) {
       echo   "<script type='text/javascript'>
                  window.alert('Successfully Setting Access Menu'); 
                  window.location.replace('../hrm{sys=menu_authorization}/menu_auth_grp?rfid=$access_name&group_set=GRP');         
              </script>";  

      } else {
       echo   "<script type='text/javascript'>
                     window.alert('Something went error');     
              </script>";
      } 
}
?>