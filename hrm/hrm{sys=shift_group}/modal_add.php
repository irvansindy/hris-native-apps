<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<div class="modal-dialog modal-med">
       <div class="modal-content">
              <div class="modal-header">
                     <h4 class="modal-title">Add Access Group</h4>
                     <button type="button" class="close"  onclick='return stopload()' data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <form method="post" id="myform" onsubmit='return HrmsValidationForm()'>
                     <fieldset id="fset_1">
                            <legend>Add Form</legend>

                            <div class="form-row">
                                   <div class="col-4 name">Access Code</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6" autocomplete="off" autofocus="on"
                                                        id="modal_access" name="modal_access" type="Text" value=""
                                                        onfocus="hlentry(this)" size="30" maxlength="50" 
                                                        validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="">
                                          </div>
                                   </div>
                            </div>
                            <div class="form-row">
                                   <div class="col-4 name">Access Name</div>
                                   <div class="col-sm-8">
                                          <div class="input-group">

                                                 <input class="input--style-6" autocomplete="off" autofocus="on"
                                                        id="modal_access_name" name="modal_access_name" id="full_name" type="Text"
                                                        value="" onfocus="hlentry(this)" size="30" maxlength="50"
                                                         validate="NotNull:Invalid Form Entry"
                                                        onchange="formodified(this);" title="">
                                          </div>
                                   </div>
                            </div>
                     </fieldset>
                     <br>
                     <tr>
                            <td colspan="2" align="right" width="100%">
                                   <div class="modal-footer">
                                          <div class="form-group">
                                                 <button type="button"  onclick='return stopload()' class="btn btn-default"
                                                        data-dismiss="modal">Cancel</button>
                                

                                                 <button type="submit" name="submit_add_access" id="submit_add_access"
                                                        class="btn btn-warning">Submit</button>

                                                 <button class="btn btn-warning" type="button" name="submit_add2"
                                                        id="submit_add2" style='display:none;' disabled>
                                                        <span class="spinner-grow spinner-grow-sm" role="status"
                                                               aria-hidden="true"></span>
                                                        Processing..
                                                 </button>


                                          </div>
                                   </div>
                            </td>
                     </tr>
              </form>
       </div>

</div>
</div>
</div>
<script>
              function HrmsValidationForm() {
                     var modal_access = document.getElementById("modal_access").value;
                     var modal_access_name = document.getElementById("modal_access_name").value;

                     if (modal_access == "") {
                            alert("Employee Number invalid");
                            return false;
                     } else if (modal_access_name == "") {
                            alert("Please select type of leave");
                            return false;
                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                     }
              }
              </script>