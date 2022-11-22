<?php 

?>
<div class="modal-body">
    <!-- <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;"> -->
            <fieldset id="fset_1">
                <div class="form-row">
                    <div class="col-3 name">Disease Code *</div>
                    <div class="col-sm-9" style="padding-left:20px">
                        <div class="input-group">
                            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_dc" id="tambah_dc" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:bold"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                        </div>
                        
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-3 name">Disease Name *</div>
                        <div class="col-sm-9">
                            <div class="from-row">
                                <div class="col-sm-12" style="padding-left:0px">
                                    <div class="from-row">
                                        <div class="col-sm-10">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="tambah_dm_en" id="tambah_dm_en" type="Text" value=""
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="input-group">
                                                <img src="img/flag_en.png" alt="">    
                                            </div>
                                        </div>
                                    </div>
                                    <div class="from-row" style="margin-top:40px">
                                        <div class="col-sm-10">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                autocomplete="off" autofocus="on" 
                                                                name="tambah_dm_id" id="tambah_dm_id" type="Text" value=""
                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                validate="NotNull:Invalid Form Entry"
                                                                onchange="formodified(this);" title="">
                                            </div>
                                        </div>
                                    <div class="col-sm-2">
                                        <div class="input-group">
                                            <img src="img/flag_id.png" alt="">    
                                        </div>
                                    </div>
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
                                                                           
                                                                                                                                                        
                                                                             <button type="submit" id="tambah_disease" id1=""
                                                                                    class="btn btn-warning btn-sm submit">Submit</button>
                                                                            
                                                                      </div>
                                                               </div>
<!-- </div> -->
</div>