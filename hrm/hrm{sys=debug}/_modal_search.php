<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<div class="modal-dialog modal-sm">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title"><?php echo $_GET['modal_header']; ?></h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <form method="post" id="myform">
                            <fieldset id="fset_1">
                                   <legend>Searching Form</legend>

                                   <div class="form-row">
                                          <div class="col-4 name">Shift Daily Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6"
                                                               autocomplete="off" 
                                                               autofocus="on"
                                                               name="src_shiftcode" 
                                                               id="src_shiftcode" 
                                                               type="Text" 
                                                               value=""
                                                               size="30" 
                                                               maxlength="50">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Day Type</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">
                                                        <input class="input--style-6"
                                                               autocomplete="off" 
                                                               autofocus="on"
                                                               name="src_daytype" 
                                                               id="src_daytype" 
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