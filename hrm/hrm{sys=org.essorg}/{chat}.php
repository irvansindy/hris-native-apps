<?php include "../../application/session/session.php";?>
<?php include "../template/sys.header.php";?>
<?php include "../template/sys.sidebar.php";?>

<!-- Theme style -->
<link rel="stylesheet" href="asset/dist/css/AdminLTE.min.css">

<!-- Text Editor -->
  <!-- summernote -->
<link rel="stylesheet" href="asset/texteditor/summernote/summernote-bs4.min.css">
  <!-- CodeMirror -->
<link rel="stylesheet" href="asset/texteditor/codemirror/codemirror.css">
<link rel="stylesheet" href="asset/texteditor/codemirror/theme/monokai.css">
<!-- Text Editor -->





<?php 

$req_id             = $_GET['param'];

$sql_get_datareq    = mysqli_query($connect, "SELECT 
a.request_no,
CONCAT('[', a.request_by, ']', ' ', b.Full_Name) AS nama,
DATE_FORMAT(a.request_date, '%d %M %Y') AS tanggal
FROM hrmorgessrequest a 
LEFT JOIN view_employee b ON b.emp_no = a.request_by
WHERE a.request_no = '$req_id'");

$data_req           = mysqli_fetch_assoc($sql_get_datareq);

$footer = 'yes'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer
?>

        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <input type="hidden" name="" id="req_id" value="<?php echo $req_id; ?>">


            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">

                        <div class="row">
                           
                            <!-- Column -->
		            <div class="col-md-1">
			    </div>
                            <div class="col-md-10">
                                <div class="card">
                                
                                    <div class="form-row" style="padding-bottom:0px">
                                        <div class="col-3 name" style="font-weight:bold">Request No</div>
                                        <div class="col-9 name" style="font-weight:bold">: <?php echo $req_id; ?></div>
                                    </div>
                                    <div class="form-row" style="padding-bottom:0px">
                                        <div class="col-3 name" style="font-weight:bold">Request By</div>
                                        <div class="col-9 name" style="font-weight:bold">: <?php echo $data_req['nama']; ?></div>
                                    </div>
                                    <div class="form-row" >
                                        <div class="col-3 name" style="font-weight:bold">Request Date</div>
                                        <div class="col-9 name" style="font-weight:bold">: <?php echo $data_req['tanggal']; ?></div>
                                    </div>
                                
                                </div>

                                <div class="card">
                                    <div class="card-body table-responsive p-0" style="width: 100vw;height: 87vh; width: 98.8%; margin: 5px;overflow: scroll;" id="ajax_chat">

                                   

                                
                                    </div>
                                
                            </div>
                            <!--/.direct-chat -->
                            <div class="box-footer" style="margin-top:10px" id="footer_chat">
                     
                                                
                      
                                                
                                          
                                    
                                </div>
                                
                        </div>
			<div class="col-md-1">
			</div>

                        </div>
                        <!-- /.col -->
                            <!-- Column -->
                        </div>
                    </div>
                   
                        
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->


<!-- Untuk send message -->

<script type="text/javascript" language="javascript" >
$(document).ready(function(){

    load_chat();

    function load_chat(){

        // Loader
        mymodalss.style.display = "block";
        // Loader

        var m   = $('#req_id').val();
        // alert(m);
        
        $.ajax({
            url: "{load_chat}.php",
            type: "POST",
            data:   {
                    id: m,
                    },
                    success: function(ajaxData) {
                        $("#ajax_chat").html(ajaxData);
                                  
                        // Loader
                        mymodalss.style.display = "none";
                        return false;
                        // Loader
                    }
        });

        $.ajax({
            url: "{footer_chat}.php",
            type: "POST",
            data:   {
                    id: m,
                    },
                    success: function(ajaxData) {
                        $("#footer_chat").html(ajaxData);
                       
                    }
        });
    }

    // Ajax send message
    $(document).on('click', '#submit_chat', function(){

        var place_chat      = $('#place_chat').val();
        var text_chat       = $('.text_chat').val();  
        const fileupload    = $('#attachment_chat').prop('files')[0];   
        var req_id          = $(this).attr('id1');      

        let formData = new FormData();
        formData.append('file', fileupload);
        formData.append('text_chat', text_chat);
        formData.append('req_id', req_id);
        formData.append('place_chat', place_chat);

                
        $.ajax({
              type: 'POST',
              url: "{send_message}.php",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
            success: function (msg) {
                   
                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    load_chat();

                   
            }
       
        });

    });

    // Ajax send meeting
    $(document).on('click', '#submit_meeting', function(){

        var to          = $('#meeting_to').val();
        var subject     = $('#meeting_subject').val();
        var time_start  = $('.meeting_time_start').val();
        var time_end    = $('.meeting_time_end').val();
        var content     = $('.meeting_content').val();  
        var req_id      = $(this).attr('id1');      

        let formData = new FormData();
        formData.append('to', to);
        formData.append('subject', subject);
        formData.append('time_start', time_start);
        formData.append('time_end', time_end);
        formData.append('content', content);
        formData.append('req_id', req_id);


         //alert(to);
         //alert(subject);
         //alert(time_start);
	 //alert(time_end);
         //alert(content);
         //alert(req_id);

                
        $.ajax({
              type: 'POST',
              url: "{send_meeting}.php",
              data: formData,
              cache: false,
              processData: false,
              contentType: false,
            success: function (msg) {
                   
                    modals.style.display ="block";
                    mymodalss.style.display = "none";
                    $('#msg').html(msg);

                    load_chat();

                   
            }
       
        });

    });

    $(document).on('click', '#refresh_chat', function(){
        load_chat();
    });

});
</script>

<!-- Untuk send meeting -->

           
<!-- Text Editor -->
<script src="asset/texteditor/jquery/jquery.min.js"></script>
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
$(document).on('change', '#set_meeting', function(){
    var id      = $(this).attr('id1');

    
    if(id   == '0'){
        $('#set_meeting').attr('id1', '1');
        const show_meeting = $(".meeting_form");
        show_meeting.css("display", "");
        const show_reply = $("#show_reply");
        show_reply.css("display", "none");
    }else if(id == '1'){
        $('#set_meeting').attr('id1', '0');
        const show_meeting = $(".meeting_form");
        show_meeting.css("display", "none");
        const show_reply = $("#show_reply");
        show_reply.css("display", "");
    }

});
</script>

<?php include "../template/sys.footer_chat.php";?>

