<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<div class="modal-dialog modal-sm">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title"><?php echo $_GET['modal_header']; ?></h4>
                     <button type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
                     <input name="loader_stoper" id="loader_stoper" type="hidden" value="stop_loader">
              </div>


              <form method="post" id="myform">
                            <fieldset id="fset_1">
                                   <legend>Searching Form</legend>

                                   <div class="form-row">
                                          <div class="col-4 name">Attendance Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6"
                                                               autocomplete="off" 
                                                               autofocus="on"
                                                               name="src_attend_code" 
                                                               id="src_attend_code" 
                                                               type="Text" 
                                                               value=""
                                                               size="30" 
                                                               maxlength="50">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Attendance Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6"
                                                               autocomplete="off" 
                                                               autofocus="on"
                                                               name="src_attend_name_id" 
                                                               id="src_attend_name_id" 
                                                               type="Text" 
                                                               value=""
                                                               size="30" 
                                                               maxlength="50">
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

<!-- LOADER STOPER -->
<script>
$(document).ready(function(){
       var loader_stoper = $("#loader_stoper").val();
              if (loader_stoper == "stop_loader") {
                     return stopload();
              } 
       });
</script>
<!-- LOADER STOPER -->