<!-- LOADER -->
<div onclick='return stopload()' id="loading-circle"></div>
<!-- LOADER -->
<?php  
       $SFdate              = date("Y-m-d");
       $inp_date            = $SFdate;
       $inp_enddate         = '';
       // jika nip dan nama terisi
       if (!empty($_POST['inp_date'])) {
              $inp_date            = $_POST['inp_date'];
       // jika nip saja yang terisi
       } elseif (!empty($_POST['inp_date'])) {
              $inp_date            = $_POST['inp_date'];
        // jika tidak ada yang terisi
       } elseif (!empty($_POST['inp_enddate'])) {
              $inp_date            = $_POST['inp_date'];
       } 
?>


<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


                            <?php
                            $req 				= mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
                            $req_app 			= mysqli_query($connect, "SELECT emp_no, 
                                                                                    GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ' or ') AS formula 
                                                                                                  FROM hrmgroupdata
                                                                                                  WHERE 
                                                                                                  emp_no = '$username' AND 
                                                                                                  Authorized_formula <> '' AND 
                                                                                                  Authorized_formula IS NOT NULL AND
                                                                                                  status_use = '1'
                                                                                                  GROUP BY emp_no");
                                   
                            $check_having_formula = mysqli_num_rows($req_app);
                            $var_having_formula = mysqli_fetch_array($req_app);

                            $req_app_use_full_query	= mysqli_query($connect, "SELECT
                                                                                    '$username' as user,
                                                                                    a.position_id,
                                                                                    a.parent_id,
                                                                                    a.parent_path
                                                                                    FROM hrmorgstruc a
                                                                                    LEFT JOIN view_employeemidtemp b on b.position_id = a.position_id
                                                                                    where b.emp_no = '$username'");
                            $check_having_formula_use_full_query 	= mysqli_num_rows($req_app_use_full_query);
                            $var_having_formula_use_full_query 	= mysqli_fetch_array($req_app_use_full_query);

                            $var_having_formula_use_full_query_user_print 		= $var_having_formula_use_full_query['user'];
                            $var_having_formula_use_full_query_position_print 	= $var_having_formula_use_full_query['position_id'];
                            $var_having_formula_use_full_query_parent_id_print 	= $var_having_formula_use_full_query['parent_id'];
                            $var_having_formula_use_full_query_parent_path_print 	= $var_having_formula_use_full_query['parent_path'];

                            // 22-03-2021_agus prasetya update group data formula whatsapp windy 
			
                                                 // $qEmployee = mysqli_query($connect, "SELECT 
                                                 // 						'$var_having_formula_use_full_query_user_print' as user_emp,
                                                 // 						GROUP_CONCAT(b.emp_no ORDER BY b.emp_no ASC SEPARATOR '|') AS formula 
                                                 // 						from hrmorgstruc a
                                                 // 						left join view_employeemidtemp b on b.position_id = a.position_id
                                                 // 						left join view_employeemidtemp c on c.emp_id = b.emp_id
                                                 // 						left join hrmorgstruc d on d.position_id = b.position_id
                                                 // 						where (a.parent_path like '%,$var_having_formula_use_full_query_position_print' or a.parent_path like '%,$var_having_formula_use_full_query_parent_id_print%')
                                                 // 						and b.emp_no is not null
                                                 // 						and case when b.end_date is null or b.end_date >= now() then 'aktif' else 'resign' end = 'aktif'
                                                 // 						GROUP BY user_emp");
                                                 $qEmployee = mysqli_query($connect, "SELECT 
                                                 '$var_having_formula_use_full_query_user_print' as user_emp,
                                                 GROUP_CONCAT(emp_no ORDER BY emp_no ASC SEPARATOR '|') AS formula 
                                                 FROM
                                                 (
                                                        select 
                                                        b.emp_no,c.full_name,d.pos_name_en as posisi,
                                                        b.worklocation_code as Plant,Left(b.cost_code,3) as costcenter,
                                                        case when b.end_date is null or b.end_date >= now() then 'aktif' else 'resign' end as statusemp,
                                                        case when b.emp_no = '$var_having_formula_use_full_query_user_print' or a.parent_path <> '$var_having_formula_use_full_query_parent_path_print' then 'yes' else 'no' end as sts
                                                        from hrmorgstruc a
                                                        left join view_employee b on b.position_id = a.position_id
                                                        left join view_employee c on c.emp_id = b.emp_id
                                                        left join hrmorgstruc d on d.position_id = b.position_id
                                                        where (a.parent_path like '%,$var_having_formula_use_full_query_position_print' or a.parent_path like '%,$var_having_formula_use_full_query_parent_id_print%')
                                                        and b.emp_no is not null
                                                 )groupdata
                                          where groupdata.sts = 'yes'");

                            // 22-03-2021_agus prasetya update group data formula whatsapp windy
                            $var_having_formula_qEmployee = mysqli_fetch_array($qEmployee);

                            if($var_having_formula_qEmployee && $check_having_formula == 0) {
                                   $var1 = array("emp_no","cost_code","parent_path","Parent_path","pos_name_en","grade_code","pos_code","AND","OR","|","`");
                                   $var2 = array("a.emp_no","a.cost_code","a.parent_path","a.parent_path","a.pos_name_en","a.grade_code","a.pos_code"," AND "," OR ","','","' ");
                                   $conversion_formula = str_replace($var1, $var2, $var_having_formula_qEmployee['formula']); 
                                   $conversion = "a.emp_no IN ('$conversion_formula')"; 
                            } else {
                                   $var1 = array("emp_no","cost_code","parent_path","Parent_path","pos_name_en","grade_code","pos_code","AND","OR","|","`");
                                   $var2 = array("a.emp_no","a.cost_code","a.parent_path","a.parent_path","a.pos_name_en","a.grade_code","a.pos_code"," AND "," OR ","','","' ");
                                   $conversion_formula = str_replace($var1, $var2, $var_having_formula_qEmployee['formula']);
                                   $conversion_formula_print = "a.emp_no IN ('$conversion_formula')"; 
                                   
                                   $conversion = str_replace($var1, $var2, $var_having_formula['formula']). ' or '. $conversion_formula_print; 
                            }
                            

                            if (!empty($_POST['inp_date']) ) {
                                   $inp_date     = $_POST['inp_date'];
                                   $where        = "WHERE ($conversion)";
                                   $whereLvr     = "WHERE ($conversion) AND DATE(c.leave_date) = '$inp_date'";
                                   $whereAtt     = "WHERE ($conversion) AND DATE(b.shiftstarttime) = '$inp_date'";
                            } else {
                                   $where        = "WHERE ($conversion)";
                                   $whereLvr     = "WHERE ($conversion) AND DATE(c.leave_date) = '$SFdate'";
                                   $whereAtt     = "WHERE ($conversion) AND b.dateforcheck = '$SFdate'";
                            }
                            $data = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                      count(*) as total
                                                                      FROM view_employee a
                                                                      LEFT JOIN teodempcompany b on a.emp_id=b.emp_id
                                                                      $where
                                                                      AND b.status='1'"));
                            ?>


                            <?php 
                            $lvr = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                             count(*) as total
                                                                             FROM hrmleaverequest b
                                                                             LEFT JOIN view_employee a on a.emp_id=b.emp_id
                                                                             LEFT JOIN hrdleaverequest c on b.request_no=c.request_no
                                                                             LEFT JOIN teodempcompany d on a.emp_id=d.emp_id
                                                                             $whereLvr
                                                                             AND (SELECT request_status FROM hrmrequestapproval WHERE request_no=b.request_no ORDER BY request_status DESC LIMIT 1) = 3
                                                                             AND d.status='1'"));
                            ?>

                            <?php 
                            $lvr_outstanding = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                             count(*) as total
                                                                             FROM hrmleaverequest b
                                                                             LEFT JOIN view_employee a on a.emp_id=b.emp_id
                                                                             LEFT JOIN hrdleaverequest c on b.request_no=c.request_no
                                                                             LEFT JOIN teodempcompany d on a.emp_id=d.emp_id       
                                                                             $whereLvr
                                                                             AND (SELECT request_status FROM hrmrequestapproval WHERE request_no=b.request_no ORDER BY request_status DESC LIMIT 1) IN ('1','2')
                                                                             AND d.status='1'"));
                            ?>

                            <?php 
                            $alpha = mysqli_fetch_array(mysqli_query($connect, "SELECT
                                                                             COUNT(b.attend_code) as total 
                                                                             FROM hrdattendance b
                                                                             LEFT JOIN VIEW_EMPLOYEE a on a.emp_id=b.emp_id
                                                                             $whereAtt and b.attend_code='ABSN'
                                                                     
                                                                             limit 100"));
                            ?>

                         
                            

<link id="theme-css" rel="stylesheet" type="text/css" href="../../asset/gt_developer/chart/theme-cyan.css">
<link id="layout-css" rel="stylesheet" type="text/css" href="../../asset/gt_developer/chart/layout-cyan.css">
<link rel="stylesheet" href="../../asset/gt_developer/chart/styles.css">
<script charset="utf-8" src="../../asset/gt_developer/chart/1-es2015.js"></script>
<script charset="utf-8" src="../../asset/gt_developer/chart/2-es2015.js"></script>




<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">Dashboard Employee</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>
                                       
                                        <td>
                                          <a href='' onclick='return stopload()'>
                                                        <div class="toolbar sprite-toolbar-reload" id="RELOAD"
                                                               title="Reload" onclick="reloadPage();">
                                                        </div>
                                                        </a>
                                        </td>
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">

                                        <div _ngcontent-smt-c1="" class="ui-g dashboard ng-star-inserted" style="max-height: 150px;"> 
                                        <div class="form-row" style="width: 100%;">
                            
                                          <div class="col-sm-3">
              
                                          <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-12 ui-lg-12">
                                                 <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-3">
                                                                      <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Total Manpower
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $data['total'];?>  <small>Employee</small>
                                                                      </span>
                                                                      <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-3.svg">
                                                                      
                                                               </div>              
                                                        </div>  
                                          </div>

                                          <div class="col-sm-3">
              
                                          <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-12 ui-lg-12">
                                                 <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-0">
                                                                      <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Emp Leave date (<strong><?php echo date ("d M Y", strtotime ($inp_date)); ?></strong>)
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $lvr['total'];?>  <small>Employee</small>
                                                                      </span>
                               
                                                                      <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
                                                                      
                                                               </div>              
                                                        </div>  
                                          </div>

                                          <div class="col-sm-3">
              
                                          <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-12 ui-lg-12">
                                                 <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-1">
                                                                      <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Outstanding Request
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $lvr_outstanding['total'];?> <small>Employee</small>
                                                                      </span>
                                                                      <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-3.svg">
                                                                      
                                                               </div>              
                                                        </div>  
                                          </div>


                                          <div class="col-sm-3">
              
                                          <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-12 ui-lg-12">
                                                 <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-2">
                                                                      <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Total Manpower
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $data['total']-$lvr['total'];?>  <small>Employee</small>
                                                                      </span>
                                                                      <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-3.svg">
                                                                      
                                                               </div>              
                                                        </div>  
                                          </div>
                                   </div>













                                   <div class="form-row" style="width: 100%;">
                            
                                          <div class="col-sm-3">
              
                                          <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-12 ui-lg-12">
                                                 <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-1">
                                                                      <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Employee Absenteism
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $alpha['total'];?>  <small>Employee</small>
                                                                      </span>
                                                                      <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg">
                                                                      
                                                               </div>              
                                                        </div>  
                                          </div>

                                          
                                   </div>
                                   </div>


                                   
















                                          
                                          
                                          

                                          
                                   
                                     
                                   
                                   <div class="col-sm-12" style="height: 200%">
                                          


                                         
                                   </div>
                            </div>
                     </div>  
              </div>
              <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                   aria-hidden="true">
                            </div>
                            <!-- Column -->        
<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>