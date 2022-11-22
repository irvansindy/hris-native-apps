<?php $HRS_GEN_SHIFT =  mysqli_query($connect, "SELECT * FROM `HRMSYSDATE`"); ?>
<?php        
                                          $GET_YEAR_FR_PARAM = '2021'; //CONTOH PARAMETER
                                          $GET_SHIFTREGGROUP_FR_PARAM = '285'; //CONTOH PARAMETER
                                          $GET_START_DAY = (5); //CONTOH PARAMETER
                                          
                                          $DEL = mysqli_query($connect, "DELETE FROM HRMGROUPSHEDULEDETAIL WHERE shiftregroup_id = '$GET_SHIFTREGGROUP_FR_PARAM' and scheduleyear = '$GET_YEAR_FR_PARAM'");
                                          $GET_shiftgroupcode = mysqli_fetch_array(mysqli_query($connect, "SELECT shiftgroupcode FROM HRMPREVIEWCALENDAR WHERE shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM'"));
                                          $GET_shiftgroupcode_R = $GET_shiftgroupcode['shiftgroupcode'];

                                          $no = 0;
                                          $no++;
                                          while ($p = mysqli_fetch_array($HRS_GEN_SHIFT)) { 
                                          $HRS_GEN_SHIFTS =  mysqli_query($connect, "SELECT * FROM `HRMTTARSHIFTGROUPDAILY`");
                                               
                                                 while ($ps = mysqli_fetch_array($HRS_GEN_SHIFTS)) {
                                                        $date_no = $no++;
                                                        $date_no_var = $date_no-$GET_START_DAY;
                                                      


                                                        $GET_groupscheduledetail = mysqli_fetch_array(mysqli_query($connect, "SELECT max(groupscheduledetail_id) as _last_no FROM HRMGROUPSHEDULEDETAIL LIMIT 1"));
                                                        $groupscheduledetail_id = $GET_groupscheduledetail['_last_no'] == '0' ? '1' : $GET_groupscheduledetail['_last_no']+1;
                                                        
                                                        $data = mysqli_fetch_array(mysqli_query($connect, "SELECT `calendar` FROM `HRMSYSDATE` WHERE id='$date_no_var'"));
                                                        // echo "SELECT `calendar` FROM `HRMSYSDATE` WHERE id='$date_no_var'"."<br>"; 

                                                        if($data['calendar'] != '')
                                                        {
                                                               $insertGroup = mysqli_query($connect, "INSERT INTO `HRMGROUPSHEDULEDETAIL`
                                                                                                         (
                                                                                                                `groupscheduledetail_id`,
                                                                                                                `scheduleyear`,
                                                                                                                `shiftgroupcode`,
                                                                                                                `shiftregroup_id`,
                                                                                                                `shiftdailycode`,
                                                                                                                `dateshift`,
                                                                                                                `day_no`
                                                                                                         ) 
                                                                                                                VALUES 
                                                                                                                       (
                                                                                                                              '$groupscheduledetail_id',
                                                                                                                              '$GET_YEAR_FR_PARAM',
                                                                                                                              '$GET_shiftgroupcode_R',
                                                                                                                              '$GET_SHIFTREGGROUP_FR_PARAM',
                                                                                                                              '$ps[shiftdailycode]',
                                                                                                                              '$data[calendar]',
                                                                                                                              '$date_no_var'
                                                                                                                       )
                                                                                                                       ");
                                                                     
                                                        }    
                                                 }
                                          }

                                          if($insertGroup){
                                                 $HRS_REGEN_SHIFT =  mysqli_query($connect, "SELECT a.*,b.shiftdailycode as sc,b.`replace`,a.day_no FROM `HRMGROUPSHEDULEDETAIL` a 
                                                                                                  LEFT JOIN HRMSPECIALCONDITION b on a.shiftregroup_id=b.shiftregroup_id AND DATE(b.conditiondate) = a.dateshift
                                                                                                  WHERE a.shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM'
                                                                                                  ORDER BY a.dateshift ASC");

                                                 while ($hrs = mysqli_fetch_array($HRS_REGEN_SHIFT)) {

                                                        echo $hrs['dateshift']." | ".$hrs['sc']." | ".$hrs['replace']." | ".$hrs['day_no']."<br>";

                                                        if($hrs['replace'] == '1')
                                                        {
                                                               $UDP_REP_MOVE = mysqli_query($connect, "UPDATE `HRMGROUPSHEDULEDETAIL` SET
                                                                                                         shiftdailycode = '$hrs[sc]',
                                                                                                         dateshift = '$hrs[dateshift]'
                                                                                                                WHERE shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM' AND
                                                                                                                dateshift = '$hrs[dateshift]'
                                                                                                         ");
                                                        } else if($hrs['replace'] == '0') {

                                                               $GET_DAYNO = mysqli_fetch_array(mysqli_query($connect, "SELECT a.day_no FROM `HRMGROUPSHEDULEDETAIL` a 
                                                                                                         WHERE a.shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM' AND 
                                                                                                         a.day_no = '$hrs[day_no]'
                                                                                                         ORDER BY a.dateshift ASC"));
                                                                                           
                                                                 
                                                                                           
                                                                             $GET_DAYNO_SECs = mysqli_query($connect, "SELECT a.shiftdailycode,a.day_no 
                                                                                                                              FROM `HRMGROUPSHEDULEDETAIL` a
                                                                                                                              WHERE a.shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM' AND
                                                                                                                              a.day_no >= '$hrs[day_no]+1'
                                                                                                                              ORDER BY a.dateshift ASC");

                                                                             while ($hrss = mysqli_fetch_array($GET_DAYNO_SECs)) {
                                                                                    
                                                                                    $DAYNO_REG_MOVE = $hrss['day_no']+1;
                                                                             
                                                                                    echo "<br><br>".$DAYNO_REG_MOVE . " | " .$hrss['day_no'] . " | " . $hrss['shiftdailycode']."<br><br>";
                                                                                    
                                                                                    $UDP_REP_MOVE = mysqli_query($connect, "UPDATE `HRMGROUPSHEDULEDETAIL` SET
                                                                                                                              shiftdailycode = '$hrss[shiftdailycode]'
                                                                                                                                     WHERE shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM' AND
                                                                                                                                     day_no = '$DAYNO_REG_MOVE'
                                                                                                                              ");
                                                                                           
                                                                                           echo "UPDATE `HRMGROUPSHEDULEDETAIL` SET
                                                                                           shiftdailycode = '$hrss[shiftdailycode]'
                                                                                                  WHERE shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM' AND
                                                                                                  day_no = '$DAYNO_REG_MOVE'
                                                                                           ";
                                                        
                                                                                  
                                                                             }

                                                                             $UDP_REP_MOVE = mysqli_query($connect, "UPDATE `HRMGROUPSHEDULEDETAIL` SET
                                                                                                         shiftdailycode = '$hrs[sc]',
                                                                                                         dateshift = '$hrs[dateshift]'
                                                                                                                WHERE shiftregroup_id='$GET_SHIFTREGGROUP_FR_PARAM' AND
                                                                                                                dateshift = '$hrs[dateshift]'
                                                                                                         ");
                                                        }

                                                 }
                                                 echo '<script type="text/javascript">
                                                 $(document).ready(function(){
                                                             modals.style.display = "block";
                                                             document.getElementById("msg").innerHTML = "Successfully Saved Group Schedule";
                                                             return false;
                                                 });
                                                 </script>';
                                          }
                                   ?>