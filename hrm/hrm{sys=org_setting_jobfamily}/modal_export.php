
<?php include "../../application/session/session.php"; 


$sql_job_family   = mysqli_query($connect, "SELECT  
a.jf_code,
a.jf_name_en
FROM teomjf a ");

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
                                          <div class="col-4 name">Job Family Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                    <select class="input--style-6" name="job_family" id="job_family" style="width: ;height: 30px;">
                                                        <!-- <option value="">-- Select one --</option> -->

                                                        <option value="0" >-- Select All --</option>
                                                        <?php  
                                                            while($loop_job_family = mysqli_fetch_assoc($sql_job_family)){
                                                        ?>
                                                        <option value="<?php echo $loop_job_family['jf_code'] ?>" ><?php echo $loop_job_family['jf_name_en'] ?></option>
                                                       <?php } ?>

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