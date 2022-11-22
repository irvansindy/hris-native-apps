<div class="col-md-12">
                                <div class="card">
                                    <div class="card-header d-flex align-items-center">
                                        <h4 class="card-title mb-0">GT Shift Calendar</h4>
                       

                                        <div class="card-actions ml-auto">
                                        <table>

                                        <td>
                                          <div onclick="return startload()" class="toolbar sprite-toolbar-add open_modal_add" id="add" title="Add"></div>
                                        </td>
                                        
                                        <td>
                                          <form action="../rfid=repository/cli_Template_Download/eo/DownloadGTTGREmployeeExport.php" method="POST">
                                          
                                          <input type="hidden" name="inp_emp" value="<?php echo $mynip; ?>">
                                          <input type="hidden" name="inp_name" value="<?php echo $myname; ?>">
                                                 <button type="submit" class="toolbar sprite-toolbar-excel" id="EXCEL" style="border: 0;background-color: white;" name="submit_approve" value="submit"></button>
                                          </form>
                                        </td>
                                        <td>
                                        
                                        <a href='#' onclick="return startload()" class='open_modal_search'>
                                                               <div class="toolbar sprite-toolbar-search" id="SEARCH"
                                                                      title="Search"></div>
                                                        </a>

                                        </td>
                                        <!-- AgusPrass 02/03/2021 Menghapus # pada href-->
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
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                                <th class="fontCustom" style="z-index: 1;" nowrap="nowrap">No</th>
                                                                <th class="fontCustom" style="z-index: 1;">Group Code</th>
                                                                <th class="fontCustom" style="z-index: 1;">Group Name</th>
                                                                <th class="fontCustom" style="z-index: 1;">Year</th>
                                                                <th class="fontCustom" style="z-index: 1;">Preview</th>
                                                                <th class="fontCustom" style="z-index: 1;">Last Modified</th>
                                                                <th class="fontCustom" style="z-index: 1;width: 80%;"></th>
                                                        </tr>

                                                </thead>
                                                        <?php
                                                               $sql = mysqli_query($connect, "SELECT * FROM `HRMTSHIFTREGROUP` ORDER BY shiftyear DESC");
                                                               $no = 0;
                                                               $no++;
                                                               while ($r = mysqli_fetch_array($sql)) {
                                                        ?>
                                                        <tr>
                                                               <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $no++; ?></td>          
                                                               <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $r['group_code']; ?></td>   
                                                               <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $r['shiftregroup_name']; ?></td>   
                                                               <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo $r['shiftyear']; ?></td>   
                                                               <td class="fontCustom" style="z-index: 1;" nowrap="nowrap">View</td>        
                                                               <td class="fontCustom" style="z-index: 1;" nowrap="nowrap"><?php echo date("d M Y h:i:s" , strtotime($r['modified_date'])); ?></td>
                                                                <?php } ?>   
                                                        </tr>
                                        </table>
                                    </div>

                                    <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                                          <div class='row mb-2'>
                                                 <div class='col-sm-10'>
                                                        <?php echo $filterprint; ?>
                                                 </div>
                                                 <div class='col-sm-2'>
                                                        <div id="toolbarlist">
                                                               <div class="toolbar-load sprite-toolbar-loadmore" id="ADD"
                                                                      title="Add"
                                                                      onclick='return startloadmore()'
                                                                      onclick="innerPop('?xfid=hrm.employee.add&amp;forcegen=1',reposBlock)">
                                                                      <a onclick='return startloadmore()' class="down" href="#"><button>Load More</a></div>
                                                        </div>
                                                 </div>
                                          </div>

                                    </div>

                                </div>
                            </div>


<!-- Column -->                    
<div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
       aria-hidden="true">
</div>
<!-- Column -->

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_add").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_add.php?emp_id=<?php echo $username; ?>",
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