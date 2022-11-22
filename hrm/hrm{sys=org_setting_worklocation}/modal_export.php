
<?php include "../../application/session/session.php"; 

$sql_worklocation_code   = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM teomworklocation a ");

$sql_worklocation   = mysqli_query($connect, "SELECT 
a.worklocation_code
FROM teomworklocation a ");

?>
<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<div class="modal-dialog modal-sm">
       <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title">Export Data</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <form action="export/excel" method="POST">                            
                                <fieldset id="fset_1">
                                   <legend>Export Filter</legend>

                                   <div class="form-row">
                                          <div class="col-4 name">Work Location Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="wl_code" id="wl_code" style="width: ;height: 30px;">
                                                        <option value="">-- Select one --</option>

                                                        <option value="0" >-- Select All --</option>
                                                        <?php  
                                                            while($loop_wl_code = mysqli_fetch_assoc($sql_worklocation_code)){
                                                        ?>
                                                        <option value="<?php echo $loop_wl_code['worklocation_code'] ?>" ><?php echo $loop_wl_code['worklocation_code'] ?></option>
                                                       <?php } ?>

                                                    </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Work Location Type</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="wl_type" id="wl_type" style="width: ;height: 30px;">
                                                                <option value="">-- Select one --</option>

                                                               <option value="0">-- Select All --</option>
                                                               
                                                               <option value="JAKARTA" >JAKARTA</option>
                                                               <option value="KARAWANG" >KARAWANG</option>
                                                               <option value="TANGERANG" >TANGERANG</option>

                                                               
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   



                                 
                            </fieldset>

                            <br>
                                                 <tr>
                                                        <td colspan="2" align="right" width="100%">
                                                               <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <button type="submit"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
                                                        </td>
                                                 </tr>





                   
              </form>
       </div>

</div>
</div>
</div>