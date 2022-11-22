<?php 

$req_id     = $_POST['id'];

?>

<!-- Text Editor -->
  <!-- summernote -->
<link rel="stylesheet" href="asset/texteditor/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
<link rel="stylesheet" href="asset/texteditor/codemirror/codemirror.css">
<link rel="stylesheet" href="asset/texteditor/codemirror/theme/monokai.css">
<!-- Text Editor -->

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

                                                <div class="form-row" style="padding-top:0px; padding-bottom:0px">
                                                    <div class="col-2">
                                                        <div class="input-group">
                                                            <div class="form-group" style="margin-bottom:0px">
                                                                <table>
                                                                    <tr>
                                                                        <td style="width:30px">
                                                                            <input class="" type="checkbox" id="set_meeting" id1="0" value=""> 
                                                                        </td>
                                                                        <td>
                                                                            <label style="margin-top:4px" for="formFileMultiple" class="form-label">Set Meeting</label>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                                
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="col-8">

                                                    </div>
                                                    <div class="col-2">
                                                        <table>
                                                            <tr>
                                                                <td>
                                                                    <div class="toolbar sprite-toolbar-reload" id="refresh_chat" title="Reload"
                                                                            onclick="">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <label style="margin-top:4px" for="formFileMultiple" class="form-label">Refresh Chat</label>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        
                                                    </div>
                                                </div>

                                                <div>
                                                    <fieldset id="fset_1" class="meeting_form" style="display:none">
                                                        <div class="form-row">
                                                        <div class="col-1 name">To *</div>
                                                            <div class="col-sm-11">
                                                                    <div class="input-group">

                                                                            <input class="input--style-6" id1=""
                                                                                autocomplete="off" autofocus="on" 
                                                                                name="meeting_to" id="meeting_to" type="Text" value=""
                                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                                validate="NotNull:Invalid Form Entry"
                                                                                onchange="formodified(this);" title="" placeholder="(email1@gt-tires.com,email2@gt-tires.com)">
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                        <div class="col-1 name">Subject *</div>
                                                            <div class="col-sm-11">
                                                                    <div class="input-group">

                                                                            <input class="input--style-6" id1=""
                                                                                autocomplete="off" autofocus="on" 
                                                                                name="meeting_subject" id="meeting_subject" type="Text" value=""
                                                                                onfocus="hlentry(this)" size="30" maxlength="" 
                                                                                validate="NotNull:Invalid Form Entry"
                                                                                onchange="formodified(this);" title="">
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                        <div class="col-1 name">Date and Time *</div>
                                                            <div class="col-sm-5">
                                                                    <div class="input-group">

                                                                        <input type="text" id="meeting_time_start" class="input--style-6 meeting_time_start"
                                                                                    name="meeting_time_start" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    autocomplete="off"/>
                                                                    </div>
                                                            </div>
                                                            <div class="col-sm-1" style="text_align:center; margin-top:8px">
                                                                To
                                                            </div>
                                                            <div class="col-sm-5">
                                                                    <div class="input-group">

                                                                        <input type="text" id="meeting_time_end" class="input--style-6 meeting_time_end"
                                                                                    name="meeting_time_end" style="
                                                                                    background-image:url(../../asset/dist/img/icons/calendar_icon.gif);  
                                                                                    background-size: 17px;
                                                                                    background-position:right;   
                                                                                    background-repeat:no-repeat; 
                                                                                    padding-right:10px;  
                                                                                    "
                                                                                    autocomplete="off"/>
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                    <div class="form-group">
                                                                        <textarea id="summernote1" class="meeting_content">
                                                                            
                                                                        </textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-12">
                                                                <button class="btn btn-primary" id="submit_meeting" id1="<?php echo $req_id; ?>" style="width:100%">Send Meeting</button>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div id="show_reply" style="display:">
                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <div class="input-group">
                                                                <div class="form-group">
                                                                    <textarea id="summernote" class="text_chat">
                                                                        
                                                                    </textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    
                                            
                                                    <div class="form-row">
                                                        <div class="col-6">
                                                            <div class="input-group">
                                                                <label for="formFileMultiple" class="form-label">Attachment</label>
                                                                <input class="form-control" type="file" id="attachment_chat" multiple style="border: solid 2px">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="input-group">
                                                                <label for="formFileMultiple" class="form-label">Attachment Place</label>
                                                                <select class="input--style-6" name="place_chat" id="place_chat" style="width: ;height: 27px;">
                                                            
                                                                    <option value="1">CHAT</option>
                                                                    <option value="2">DRAFT & REVISION DOCUMENTS</option>
                                                                    <option value="3">MOM DOCUMENTS</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <div style="width:100%; background-color:#ffcc33; padding:10px">
                                                                <span style="color:#000000; font-weight:bold">Please do not attach documents containing confidential data</span>
                                                                <ul>
                                                                    <li><span style="color:#000000">Max upload size: 3MB</span></li>
                                                                    <li><span style="color:#000000">Only for Image and document file (.jpg, .jpeg, .gif, .doc, .docx, .xls, .xlsx, .pdf, .txt, .odt, .ods, .zip, and *.rar)</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-12">
                                                            <button class="btn btn-primary" id="submit_chat" id1="<?php echo $req_id; ?>" style="width:100%">Send Message</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                

                                                <!-- Text Editor -->
<!-- <script src="asset/texteditor/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="asset/texteditor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->

<!-- Summernote -->
<script src="asset/texteditor/summernote/summernote-bs4.min.js"></script>
<!-- CodeMirror -->
<script src="asset/texteditor/codemirror/codemirror.js"></script>
<script src="asset/texteditor/codemirror/mode/css/css.js"></script>
<script src="asset/texteditor/codemirror/mode/xml/xml.js"></script>
<script src="asset/texteditor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- Text Editor -->

<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

<script>
  $(function () {
    // Summernote
    $('#summernote1').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

<script type="text/javascript">
              $(document).ready(function() {
                     $('#meeting_time_start').bootstrapMaterialDatePicker({
                            date: true,
                            time: true,
                            clearButton: true,
                            format: 'YYYY-MM-DD HH:mm'
                     });

                     $('#meeting_time_end').bootstrapMaterialDatePicker({
                            date: true,
                            time: true,
                            clearButton: true,
                            format: 'YYYY-MM-DD HH:mm'
                     });

                     $('#modal_leave_end').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: true,
                            time: true,
                            format: 'HH:mm:ss'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
</script>

<script type="text/javascript">
    $(document).ready(function() {
                
        const min_height = $(".note-editing-area");
        min_height.css("min-height", "200px");

        const editable = $(".note-editable");
        editable.css("min-height", "200px");

    })
</script>



