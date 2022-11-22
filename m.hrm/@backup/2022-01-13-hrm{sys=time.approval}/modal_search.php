<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-med">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Seacrh</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>



              <!-- AgusPrass 04/03/2021 Mengganti searching form leave req -->

              <form method="post" id="myform">

                            <fieldset id="fset_1">
                                   <legend>Searching Form</legend>


                                   

                                   <div class="form-row">
                                          <div class="col-4 name">Leave Request No</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id="modal_emp"
                                                               name="inp_req" id="inp_req" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Date</div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                               <input type="text" 
                                                                      id="inp_date" 
                                                                      name="inp_date" 
                                                                      class="input--style-6"
                                                                      style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " />
                                                 </div>
                                          </div>

                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                               <input type="text" 
                                                                      id="inp_enddate" 
                                                                      name="inp_enddate" 
                                                                      class="input--style-6"
                                                                      style="
                                                                      background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                      background-size: 17px;
                                                                      background-position:right;   
                                                                      background-repeat:no-repeat; 
                                                                      padding-right:10px;  
                                                                      " />

                                                               
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
                               

                            </table>
                     </div>
              </form>



              <!-- <form method="post" id="myform">
                     <div class="modal-body">
                            <table cellpadding="1" cellspacing="1" style="width:100%">
                                   <div id="divForm">
                                          <fieldset id="fset_1">
                                                 <legend>Personal Data</legend>
                                                 <table style="width: 95%;">
                                                        <tbody>
                                                               <tr id="tr_inp_first_name">
                                                                      <td class="label" width="30%"><label
                                                                                    id="lbl_inp_first_name"
                                                                                    for="inp_first_name"
                                                                                    title="">Employee Name
                                                                                    <span
                                                                                           class="required">*</span></label>
                                                                      </td>

                                                               <tr id="tr_inp_gender" class="clTR1">
                                                                      <td class="label" width="30%"><label
                                                                                    id="lbl_inp_gender" for="inp_gender"
                                                                                    title="">Gender <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><input data-xx="55"
                                                                                    data-checked="false" type="radio"
                                                                                    id="inp_gender" name="inp_gender"
                                                                                    langed="0" title="Female" value="0"
                                                                                    onfocus="hlentry(this)"
                                                                                    onclick="formodified(this);"><span>Female&nbsp;</span><input
                                                                                    data-xx="55" data-checked="false"
                                                                                    type="radio" id="inp_gender"
                                                                                    name="inp_gender" langed="1"
                                                                                    title="Male" value="1"
                                                                                    onfocus="hlentry(this)"
                                                                                    onclick="formodified(this);"><span>Male&nbsp;</span>
                                                                      </td>
                                                               </tr>
                                                               <tr id="tr_inp_identity_no" class="clTR1">
                                                                      <td class="label" width="30%"><label
                                                                                    id="lbl_inp_identity_no"
                                                                                    for="inp_identity_no" title="">ID
                                                                                    Number
                                                                                    <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><input
                                                                                    style="margin-bottom: 2px;"
                                                                                    id="nip"
                                                                                    name="nip" type="Text"
                                                                                    value="" onfocus="hlentry(this)"
                                                                                    size="30" maxlength="50" 
                                                                                    validate="NotNull:Invalid Form Entry"
                                                                                    onchange="formodified(this);"
                                                                                    title="">
                                                                      </td>
                                                               </tr>
                                                               <tr id="tr_inp_identity_no" class="clTR1">
                                                                      <td class="label" width="30%"><label
                                                                                    id="lbl_inp_identity_no"
                                                                                    for="inp_identity_no"
                                                                                    title="">Employee Name
                                                                                    <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><input
                                                                                    id="full_name"
                                                                                    name="full_name" type="Text"
                                                                                    value="" onfocus="hlentry(this)"
                                                                                    size="30" maxlength="50" 
                                                                                    validate="NotNull:Invalid Form Entry"
                                                                                    onchange="formodified(this);"
                                                                                    title="">
                                                                      </td>
                                                               </tr>

                                                               <tr id="tr_inp_minempage" class="clTR1"
                                                                      style="display: none;">
                                                                      <td class="label" width="30%"><label
                                                                                    id="lbl_inp_minempage"
                                                                                    for="inp_minempage"
                                                                                    title=""></label></td>
                                                                      <td class="" id="tdb_1"><input id="inp_minempage"
                                                                                    name="inp_minempage" type="Hidden"
                                                                                    value="20" onfocus="hlentry(this)"
                                                                                    size="30" maxlength="50" 
                                                                                    onchange="formodified(this);"
                                                                                    title="">
                                                                      </td>
                                                               </tr>
                                                               <tr id="tr_inp_religion_code" class="clTR1">
                                                                      <td class="label" width="30%"><label
                                                                                    id="lbl_inp_religion_code"
                                                                                    for="inp_religion_code"
                                                                                    title="">Religion
                                                                                    <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><select
                                                                                    id="inp_religion_code"
                                                                                    name="inp_religion_code"
                                                                                    onfocus="hlentry(this)"
                                                                                    onchange="formodified(this);"
                                                                                    style="width:undefined">
                                                                                    <option value="">--Select One--
                                                                                    </option>
                                                                                    <option value="BUDDHIST">Buddhist
                                                                                    </option>
                                                                                    <option value="CATHOLIC">Catholic
                                                                                    </option>
                                                                                    <option value="CHRISTIAN">Christian
                                                                                    </option>
                                                                                    <option value="HINDHU">Hindhu
                                                                                    </option>
                                                                                    <option value="ISLAM">Islam</option>
                                                                                    <option value="KONGHUCU">konghucu
                                                                                    </option>
                                                                             </select></td>
                                                               </tr>
                                                               <tr id="tr_inp_marital_status" class="clTR1">
                                                                      <td class="label" width="30%"><label
                                                                                    id="lbl_inp_marital_status"
                                                                                    for="inp_marital_status"
                                                                                    title="">Marital
                                                                                    Status <span
                                                                                           class="required">*</span></label>
                                                                      </td>
                                                                      <td class="" id="tdb_1"><select
                                                                                    id="inp_marital_status"
                                                                                    name="inp_marital_status"
                                                                                    onfocus="hlentry(this)"
                                                                                    onchange="formodified(this);"
                                                                                    style="width:undefined">
                                                                                    <option value="">--Select One--
                                                                                    </option>
                                                                                    <option value="1">Married</option>
                                                                                    <option value="0">Single</option>
                                                                                    <option value="2">Widow</option>
                                                                                    <option value="3">Widower</option>
                                                                             </select></td>
                                                               </tr>


                                                        </tbody>


                                                 </table>

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
                                          </fieldset>


                            </table>
                     </div>
              </form> -->
       </div>

</div>
</div>
</div>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#inp_date').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_enddate').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
              </script>