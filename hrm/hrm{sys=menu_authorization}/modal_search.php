<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />

<div class="modal-dialog modal-sm">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Search Employee</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <form method="post" id="myform">
              <fieldset id="fset_1">
                                   <legend>Searching Form</legend>

                                   <div class="form-row">
                                          <div class="col-4 name">Employee No</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id="modal_emp"
                                                               name="nip" id="nip" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Employee Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id="modal_emp"
                                                               name="full_name" id="full_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Active Status</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <select class="input--style-6 modal_leave" name="inp_active"
                                                        style="width: 50%;height: 30px;" id="inp_active"
                                                        onchange="isi_otomatis_leave()">

                                               
                                                                                    <option value="">--Select One--
                                                                                    </option>
                                                                                    <option value="1">Active</option>
                                                                                    <option value="2">Inactive</option>
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