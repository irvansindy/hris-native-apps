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

                            <?php
                            

                            $req 		       = mysqli_query($connect, "SET SESSION group_concat_max_len = 100000");
                            $req_app 		= mysqli_query($connect, "SELECT emp_no, 
                                                                                    GROUP_CONCAT(Authorized_formula ORDER BY Authorized_Group ASC SEPARATOR ' or ') AS formula 
                                                                                                  FROM hrmgroupdata
                                                                                                  WHERE emp_no = '$username'
                                                                                                  GROUP BY emp_no");


                            $check_having_formula = mysqli_num_rows($req_app);

                            $check_having_formula = mysqli_num_rows($req_app);
                            $var_having_formula = mysqli_fetch_array($req_app);

                            if($check_having_formula < 1) {
                                   $conversion = "a.emp_no='$username'"; 
                            } else {
                                   $var1 = array("emp_no","cost_code","parent_path","Parent_path","pos_name_en","grade_code","pos_code","AND","OR","|","`");
                                   $var2 = array("a.emp_no","a.cost_code","a.parent_path","a.parent_path","a.pos_name_en","a.grade_code","a.pos_code"," AND "," OR ","','","'");
                                   $conversion = str_replace($var1, $var2, $var_having_formula['formula']); 
                            }
                            

                            if (!empty($_POST['inp_date'])) {
                                   $inp_date     = $_POST['inp_date'];
                                   $where        = "WHERE ($conversion)";
                                   $whereLvr     = "WHERE ($conversion) AND DATE(c.leave_date) = '$inp_date'";
                                   $whereAtt     = "WHERE ($conversion) AND DATE(b.shiftstarttime) = '$inp_date'";
                            } else {
                                   $where        = "WHERE ($conversion)";
                                   $whereLvr     = "WHERE ($conversion) AND DATE(c.leave_date) = '$SFdate'";
                                   $whereAtt     = "WHERE ($conversion) AND DATE(b.shiftstarttime) = '$SFdate'";
                            }
                            $data = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                      count(*) as total
                                                                      FROM view_employee a
                                                                      $where
                                                                      AND a.status='1'"));
                            ?>


                            <?php 
                            $lvr = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                             count(*) as total
                                                                             FROM hrmleaverequest b
                                                                             LEFT JOIN view_employee a on a.emp_id=b.emp_id
                                                                             LEFT JOIN hrdleaverequest c on b.request_no=c.request_no
                                                                             $whereLvr
                                                                             AND (SELECT request_status FROM hrmrequestapproval WHERE request_no=b.request_no ORDER BY request_status DESC LIMIT 1) = 3
                                                                             AND a.status='1'"));
                            ?>

                            <?php 
                            $lvr_outstanding = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                                             count(*) as total
                                                                             FROM hrmleaverequest b
                                                                             LEFT JOIN view_employee a on a.emp_id=b.emp_id
                                                                             LEFT JOIN hrdleaverequest c on b.request_no=c.request_no       
                                                                             $whereLvr
                                                                             AND (SELECT request_status FROM hrmrequestapproval WHERE request_no=b.request_no ORDER BY request_status DESC LIMIT 1) IN ('1','2')
                                                                             AND a.status='1'"));
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
                                        <a href='#' class='open_modal_search'>
                                                               <div class="toolbar sprite-toolbar-search" id="SEARCH"
                                                                      title="Search"></div>
                                                        </a>
                                        </td>

                                        <!-- AgusPrass 02/03/2021 Menambahkan button reload page -->
                                        <td>
                                          <a href='' onclick='return stopload()'>
                                                        <div class="toolbar sprite-toolbar-reload" id="RELOAD"
                                                               title="Reload" onclick="reloadPage();">
                                                        </div>
                                                        </a>
                                        </td>
                                        <!-- AgusPrass 02/03/2021 -->
                                        
                                        </table>
                                          

                                        </div>
                                    </div>

                                    <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                     
                                   
                                   <div class="col-sm-12" style="height: 200%">
                                          <div class="row">
                                                 <div class="col-md-12">
                                   
                                                        <div _ngcontent-smt-c1="" class="ui-g dashboard ng-star-inserted" style="max-height: 150px;">      
                                                        <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-6 ui-lg-3">
                                                               <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-3">
                                                                      <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Total Manpower
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $data['total'];?>  <small>Employee</small>
                                                                      </span>
                                                                      <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-3.svg"></div>
                                                               </div>
                                                        <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-6 ui-lg-3">
                                                               <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-0">
                                                                      <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Employee Leave date (<?php echo date ("d M Y", strtotime ($inp_date)); ?>)
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $lvr['total'];?> <small>Employee</small>
                                                               </span>
                                                               <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg"></div>
                                                               </div>
                                                        <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-6 ui-lg-3">
                                                               <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-1">
                                                               <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Outstanding Request
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $lvr_outstanding['total'];?> <small>Request</small>
                                                               </span>
                                                               <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg"></div>
                                                               </div>
                                                        <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-6 ui-lg-3">
                                                               <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-2">
                                                               <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Total Employee (<?php echo date ("d M Y", strtotime ($inp_date)); ?>)
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $data['total']-$lvr['total'];?> <small>Employee</small>
                                                               
                                                               </span>
                                                               <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-2.svg"></div>
                                                               </div>
                                                        </div>
                                                 </div>
                                          </div>


                                          <div class="row">
                                                 <div class="col-md-12">
                                   
                                                        <div _ngcontent-smt-c1="" class="ui-g dashboard ng-star-inserted" style="max-height: 150px;">      
                                                        <div _ngcontent-smt-c1="" class="ui-g-12 ui-md-6 ui-lg-3">
                                                               <div _ngcontent-smt-c1="" class="ui-g card overview-box overview-box-1">
                                                               <span _ngcontent-smt-c1="" class="overview-box-name">
                                                                      Employee Absenteism
                                                                      </span>
                                                                      <span _ngcontent-smt-c1="" class="overview-box-count">
                                                                      <?php echo $alpha['total'];?> <small>Employee</small>
                                                               </span>
                                                               <img _ngcontent-smt-c1="" src="../../asset/gt_developer/chart/chart-1.svg"></div>
                                                        </div>
                                                 </div>
                                          </div>
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