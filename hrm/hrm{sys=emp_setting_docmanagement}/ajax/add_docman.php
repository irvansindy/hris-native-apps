<?php 


?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Document Name *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="add_dm" id="add_dm" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-3 name">Reminder</div>
                    <div class="col-sm-9" >
                        <div class="input-group">
                            <div class="from-row">
                                <div class="col-sm-6">
                                    <select class="input--style-6" name="add_day" id="add_day" style="width: ;height: 27px;">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>

                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="input--style-6" name="add_daytpe" id="add_daytpe" style="width: ;height: 27px;">
                                        <option value="Day">Day</option>
                                        <option value="Week">Week</option>
                                        <option value="Month">Month</option>
                                       
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
                
                
                <!-- <a href='#' id1='' id2='' class='' data-toggle='modal' id='' data-target='#modal-view-od-1'><img src='../../asset/img/icons/glasses.png'></a> -->
                
            </fieldset>


            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                      <button type="button"
                                                                                    class="btn btn-default btn-sm"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                           
                                                                       

                                                                             
                                                                             <button type="submit" id="tambah_docman" id1=""
                                                                                    class="btn btn-warning btn-sm submit" >Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>