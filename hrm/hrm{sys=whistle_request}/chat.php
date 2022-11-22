<?php include "../../application/session/session.php";?>
<?php include "../template/sys.header.php";?>

<!-- <script src="../../asset/gt_developer/jquery.min.js"></script> -->

<?php include "../template/sys.sidebar.php";?>



<?php  
       $getispic = mysqli_fetch_array(mysqli_query($connect, "SELECT pic,GROUP_CONCAT('`', _id , '`') AS authorized
                                                                             FROM whstm_pic_category
                                                                             WHERE pic = '$username'
                                                                             GROUP BY pic"));

                                                                             // echo "SELECT pic,GROUP_CONCAT('`', _id , '`') AS authorized
                                                                             // FROM whstm_pic_category
                                                                             // WHERE pic = '$username'
                                                                             // GROUP BY pic";

       $getispic_r = str_replace("`" , "'" , $getispic['authorized']);

       if(empty($getispic_r)){
              $display_action = 'display:none;';
       } else {
              $display_action = '';
       }

      
?>


<?php
$page   = '92'; //menu id SELECT * FROM hrmmenu WHERE menu_id = '21'
$footer = 'no'; //set as `yes` if you want to use default footer & set as `no` if you want to use custom footer

$param = base64_decode($_GET['_key']);

$employee = mysqli_fetch_array(mysqli_query($connect, "SELECT 
                                                               a.whistle_description,
                                                               a._id_whistle,
                                                               x1.Full_Name as employee_name_create,
                                                               x2.Full_Name as employee_name_pic,
                                                               a.created_by,
                                                               b.pic
                                                        FROM whstd_request a
                                                        LEFT JOIN whstm_pic_category b ON a.category=b._id
                                                        LEFT JOIN view_employee x1 ON a.created_by=x1.emp_no
                                                        LEFT JOIN view_employee x2 ON b.pic=x2.emp_no
                                                        WHERE _id_whistle = '$param'"));
if($employee['created_by'] == $username) {
       $employees = $employee['pic'].".jpeg";
       $emp_name = $employee['employee_name_pic'];
} else {
       $employees = $employee['created_by'].".jpeg";
       $emp_name = $employee['employee_name_create'];
}

$new_key = $employee['_id_whistle'];
$new_des = $employee['whistle_description'];
?>



<!-- Modal -->
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"  data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-body">

                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                                   <form method="post" id="myform">
                                          <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
                                                 <legend>Case Detail</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name"><label>Id Request</label></div>
                                                 </div>
                                                  <div class="form-row">
                                                        <div class="col-12 name"><?php echo $new_key; ?> </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name"><label>Case Detail</label></div>
                                                 </div>
                                                 <div class="form-row">
                                                        <div class="col-12 name"><?php echo $new_des; ?> </div>
                                                 </div>
                                                 <div class="form-row">
                                                        <div class="col-4 name"><label>Attachment</label></div>
                                                 </div>
                                                 <div class="form-row">
                                                        <div id="box_update"></div>
                                                 </div>
                                       
                                          </fieldset>
                                          <button type="button" onclick='return stopload()' data-dismiss="modal"
                                   aria-label="Close"  class="btn btn-warning button_bot">
                                                 Close
                                          </button>
                                   </form>
				</div>

			</div><!-- modal-content -->
		</div><!-- modal-dialog -->
	</div><!-- modal -->



 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>

                            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet" type="text/css"/>
<script>
$(document).ready(function(){
  $("#box_update").load("pages_relation/_pages_photo.php?rfid=<?php echo $new_key; ?>&username=<?php echo $username; ?>", 
                                   function(responseTxt_spv_up, statusTxt_spv_up, jqXHR_spv_up){
                                          if(statusTxt_spv_up == "success"){
                                                 $("#box_update").show();
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                     );
});
</script>
	


        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="display: block;">
            <div class="row page-titles">
                <div class="col-md-5 col-12 align-self-center">
               

                       

                    <h3 class="text-themecolor mb-0">         
                           
                    
                    
                <h3 class="text-themecolor mb-0">         
                           
                    
                     <!-- <div class="incoming_msg_img"> <img onclick="history.back()" class="profile-pic rounded-circle"
                                                                             src="asset/img/arrow.png"
											style="height: 29px;width: 60px;"
                                                                             alt="<php echo $emp_name; ?>">
                                                                        </div> -->
                     <div class="incoming_msg_img">
                                                                             
                                                                             <!-- <img class="profile-pic rounded-circle"
                                                                             src="../../asset/emp_photos/<php echo $employees; ?>"
											style="height: 25px;width: 60px;"
                                                                             alt="<php echo $emp_name; ?>"> </div>  -->
                                                                    Whistle Chat&nbsp;&nbsp;

                                                                      </h3>

                    <ol class="breadcrumb mb-0 p-0 bg-transparent">
                       
                        <?php echo $new_key; ?></li>
                    </ol>


                                   
                </div>

              <div class="col-md-7 col-12 align-self-center">
                     <div class="d-flex mt-2 justify-content-end">
                            <div class="d-flex me-3 ms-2">
                                   <div class="chart-text me-2">
                                          <h6 class="mb-0"><small>DETAIL REQUEST</small></h6>
                                          <h4 class="mt-0 text-info"><a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                                                 <div class="toolbar sprite-toolbar-cus" id="SEARCH" title="Search">
                                                 </div>
                                          </a></h4>
                                   </div>
                            </div>
                     </div>
              </div>

            



              
            </div>

            
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid" style="background: white;margin-top: -15px;">
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="row">
                         
<style>

img {
       max-width: 100%;
}

.inbox_people {
       background: #f8f8f8 none repeat scroll 0 0;
       float: left;
       overflow: hidden;
       width: 40%;
       border-right: 1px solid #c4c4c4;
}

.inbox_msg {
       clear: both;
       overflow: hidden;
       border-radius: 17px;
}

.top_spac {
       margin: 20px 0 0;
}


.headind_srch {
       padding: 10px 29px 10px 20px;
       overflow: hidden;
       /* border-bottom: 1px solid #c4c4c4; */
}

.recent_heading h4 {
       color: #05728f;
       font-size: 21px;
       margin: auto;
}

.srch_bar input {
       /* //border: 1px solid #cdcdcd; */
       border-width: 0 0 1px 0;
       width: 80%;
       padding: 2px 0 4px 6px;
       background: none;
}

.srch_bar .input-group-addon button {
       background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
       border: medium none;
       padding: 0;
       color: #707070;
       font-size: 18px;
}

.srch_bar .input-group-addon {
       margin: 0 0 0 -27px;
}

.chat_ib h5 {
       font-size: 15px;
       color: #464646;
       margin: 0 0 8px 0;
}

.chat_ib h5 span {
       font-size: 13px;
       float: right;
}

.chat_ib p {
       font-size: 14px;
       color: #989898;
       margin: auto
}

.chat_img {
       float: left;
       width: 11%;
}

.chat_ib {
       float: left;
       padding: 0 0 0 15px;
       width: 88%;
}

.chat_people {
       overflow: hidden;
       clear: both;
}

.chat_list {
       border-bottom: 1px solid #c4c4c4;
       margin: 0;
       padding: 18px 16px 10px;
}

.inbox_chat {
       height: 550px;
       overflow-y: scroll;
}

.active_chat {
       background: #ebebeb;
}

.incoming_msg_img {
       display: inline-block;
       width: 6%;
}

.received_msg {
       display: inline-block;
       padding: 0 0 0 0px;
       vertical-align: top;
       width: 92%;
}

.received_withd_msg p {
       background: #ebebeb none repeat scroll 0 0;
       border-radius: 3px;
       color: #646464;
       font-size: 14px;
       margin: 0;
       padding: 5px 10px 5px 12px;
       width: 100%;
}

.time_date {
       color: #747474;
       display: block;
       font-size: 12px;
       margin: 8px 0 0;
}



.mesgs {
       float: left;
       padding: 1px 2px 0 2px;
       width: 100%;
}

.sent_msg p {
       background: #05728f none repeat scroll 0 0;
       border-radius: 3px;
       font-size: 14px;
       margin: 0;
       color: #fff;
       padding: 5px 10px 5px 12px;
       width: 100%;
}

.outgoing_msg {
       overflow: hidden;
       margin: 2px 0 2px;
}



.sent_msg_respon {
              text-align: center;
       }





/* //MOBILE */
@media only screen and (max-width: 500px) {
       .sent_msg {
              float: right;
              width: 94%;
       }
       .received_withd_msg {
              width: 94%;
       }
       .float{
              position: absolute;
              width: 120px;
              height: 42px;
              bottom: 105px;
right: 44px;
              background-color: #DFDFDFD4;
              color: #A8A8A8;
              border-radius: 11px;
              text-align: center;
              box-shadow: 1px 1px 1px #999;
              padding-top: 13px;
       }
       .input_msg_write textarea {
              display: block;
              flex: 1;
              width: 98%;
              height: 50px;
              border-radius: 60px;
              margin: 5px;
              padding: 11px;
              outline: none;
              font-size: 19px;
              padding-left: 30px;
              padding-right: 90px;
              border: 2px solid #ccc;
              color: #555;
              resize: none;
       }
       .msg_send_btn {
              background: #05728f none repeat scroll 0 0;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 14px;
              top: 13px;
              width: 33px;
       }
       .msg_send_btn_attach {
              background: #05728f none repeat scroll 0 0;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 52px;
              top: 14px;
              width: 32px;
              background: gray;
       }
       .msg_send_btn_action {
              background: orange;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 91px;
              top: 14px;
              width: 32px;
       }
       .footer_chat {
              position: fixed;
              left: 0;
              bottom: 0;
              width: 100%;
              background-color: #fff;
              color: grey;
              text-align: right;
              z-index: 2;
       }
       .chart-text.me-2 {
              top: -100px;
              margin-top: -61px;
              margin-right: -4px;
       }
       .outgoing_msg_respon {
              overflow: hidden;
              margin-right: 20%;
              margin-left: 20%;
              background: #ffe7ba;
              padding-top: 10px;
              height: 1u;
              padding-bottom: 10px;
              margin-bottom: 11px;
              border-radius: 10px;
       }
}

/* //MOBILE */
@media only screen and (max-width: 991px) {
	.sent_msg {
              float: right;
              width: 94%;
       }
       .received_withd_msg {
              width: 94%;
       }
       .float{
              position: absolute;
              width: 120px;
              height: 42px;
              bottom: 105px;
              right: 44px;
              background-color: #DFDFDFD4;
              color: #A8A8A8;
              border-radius: 11px;
              text-align: center;
              box-shadow: 1px 1px 1px #999;
              padding-top: 13px;
       }
       .input_msg_write textarea {
              display: block;
              flex: 1;
              width: 98%;
              height: 50px;
              border-radius: 60px;
              margin: 5px;
              padding: 11px;
              outline: none;
              font-size: 19px;
              padding-left: 30px;
              padding-right: 90px;
              border: 2px solid #ccc;
              color: #555;
              resize: none;
       }
       .msg_send_btn {
              background: #05728f none repeat scroll 0 0;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 14px;
              top: 13px;
              width: 33px;
       }
       .msg_send_btn_attach {
              background: #05728f none repeat scroll 0 0;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 52px;
              top: 14px;
              width: 32px;
              background: gray;
       }
       .msg_send_btn_action {
              background: orange;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 91px;
              top: 14px;
              width: 32px;
       }
       .footer_chat {
              position: fixed;
              left: 0;
              bottom: 0;
              width: 100%;
              background-color: #fff;
              color: grey;
              text-align: right;
              z-index: 2;
       }
       .chart-text.me-2 {
              top: -100px;
              margin-top: -61px;
              margin-right: -4px;
       }
       .outgoing_msg_respon {
              overflow: hidden;
              margin-right: 20%;
              margin-left: 20%;
              background: #ffe7ba;
              padding-top: 10px;
              height: 1u;
              padding-bottom: 10px;
              margin-bottom: 11px;
              border-radius: 10px;
       }
       
}

/* //WEBSITE */
@media (min-width: 1080px) {
       .sent_msg {
              float: right;
              width: 62%;
       }
       .received_withd_msg {
              width: 62%;
       }
       .float{
              position: absolute;
              width: 120px;
              height: 42px;
              bottom: 107px;
              right: 196px;
              background-color: #DFDFDFD4;
              color: #A8A8A8;
              border-radius: 11px;
              text-align: center;
              box-shadow: 1px 1px 1px #999;
              padding-top: 13px;
       }

       .input_msg_write textarea {
              display: block;
              flex: 1;
              width: 91vw;
              height: 50px;
              border-radius: 60px;
              margin: 5px;
              margin-left: 5px;
              padding: 11px;
              padding-right: 11px;
              padding-left: 11px;
              outline: none;
              font-size: 19px;
              padding-left: 30px;
              padding-right: 197px;
              border: 2px solid #ccc;
              color: #555;
              resize: none;
              margin-left: 94px;
       }
       .msg_send_btn {
              background: #05728f none repeat scroll 0 0;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 29px;
              top: 13px;
              width: 32px;
       }
       .msg_send_btn_attach {
              background: #05728f none repeat scroll 0 0;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              right: 65px;
              top: 13px;
              width: 32px;
              background: gray;
       }
       .msg_send_btn_action {
              background: orange;
              border: medium none;
              border-radius: 50%;
              color: #fff;
              cursor: pointer;
              font-size: 17px;
              height: 33px;
              position: absolute;
              margin-right: 12px;
              top: 14px;
              width: 32px;
              right : 92px;
       }
       .footer_chat {
              position: fixed;
              left: 0;
              bottom: 0;
              width: 100%;
              background-color: #fff;
              color: grey;
              text-align: right;
              z-index: 2;
       }
       .outgoing_msg_respon {
              overflow: hidden;
              margin-right: 30%;
              margin-left: 30%;
              background: #ffe7ba;
              padding-top: 10px;
              height: 1u;
              padding-bottom: 10px;
              margin-bottom: 11px;
              border-radius: 10px;
       }


       
}


.input_msg_write input {
       background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
       border: medium none;
       color: #4c4c4c;
       font-size: 15px;
       min-height: 48px;
       width: 60%;
}



.type_msg {
       border-top: 1px solid #c4c4c4;
       position: relative;
}



.messaging {
       padding: 0 0 50px 0;
       background: white;
}


.msg_history {
       height: 516px;
       overflow-y: auto;
}
</style>
<style>
                                   body {
                                   font-family: sans-serif;
                                   background-color: #eeeeee;
                                   }

                                   .file-upload {
                                   background-color: #ffffff;
                                   width: 600px;
                                   margin: 0 auto;
                                   padding: 20px;
                                   }

                                   .file-upload-btn {
                                   width: 100%;
                                   margin: 0;
                                   color: #fff;
                                   background: #1FB264;
                                   border: none;
                                   padding: 10px;
                                   border-radius: 4px;
                                   border-bottom: 4px solid #15824B;
                                   transition: all .2s ease;
                                   outline: none;
                                   text-transform: uppercase;
                                   font-weight: 700;
                                   }

                                   .file-upload-btn:hover {
                                   background: #1AA059;
                                   color: #ffffff;
                                   transition: all .2s ease;
                                   cursor: pointer;
                                   }

                                   .file-upload-btn:active {
                                   border: 0;
                                   transition: all .2s ease;
                                   }

                                   .file-upload-content {
                                   display: none;
                                   text-align: center;
                                   }

                                   .file-upload-input {
                                   position: absolute;
                                   margin: 0;
                                   padding: 0;
                                   width: 100%;
                                   height: 100%;
                                   outline: none;
                                   opacity: 0;
                                   cursor: pointer;
                                   }

                                   .image-upload-wrap {
                                   margin-top: 20px;
                                   border: 4px dashed #1FB264;
                                   position: relative;
                                   }

                                   .image-dropping,
                                   .image-upload-wrap:hover {
                                   background-color: #1FB264;
                                   border: 4px dashed #ffffff;
                                   }

                                   .image-title-wrap {
                                   padding: 0 15px 15px 15px;
                                   color: #222;
                                   }

                                   .drag-text {
                                   text-align: center;
                                   }

                                   .drag-text h3 {
                                   font-weight: 100;
                                   text-transform: uppercase;
                                   color: #15824B;
                                   padding: 60px 0;
                                   }

                                   .file-upload-image {
                                   max-height: 200px;
                                   max-width: 200px;
                                   margin: auto;
                                   padding: 20px;
                                   }

                                   .remove-image {
                                   width: 200px;
                                   margin: 0;
                                   color: #fff;
                                   background: #cd4535;
                                   border: none;
                                   padding: 10px;
                                   border-radius: 4px;
                                   border-bottom: 4px solid #b02818;
                                   transition: all .2s ease;
                                   outline: none;
                                   text-transform: uppercase;
                                   font-weight: 700;
                                   }

                                   .remove-image:hover {
                                   background: #c13b2a;
                                   color: #ffffff;
                                   transition: all .2s ease;
                                   cursor: pointer;
                                   }

                                   .remove-image:active {
                                   border: 0;
                                   transition: all .2s ease;
                                   }

                                   


.my-float{
	margin-top:22px;
}
</style>


<!------ Include the above in your HEAD tag ---------->
         

<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript"
       src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->



<html>

<head>
       <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet"> 
</head>

<body>
       <!-- <div class="container"> -->
              <div class="messaging" style="width:100%">
                     <div class="inbox_msg">
                            <div class="mesgs">
                                   <div class="msg_history" id="msg_history">
                                          <div id="load-into-div-first"></div>
                                          <div id="load-into-div-second"></div>
                                   </div>
                                   

                                   

                                   <form class="form-horizontal" enctype="multipart/form-data" action="php_action/FuncDataCreateSPVUP.php" method="POST" id="FormDisplayCreateSPVUP">
                                   
                                 
                                   <input type="hidden" id="row_msg" class="row_msg"/>
                                   <input type="hidden" value="<?php echo $new_key; ?>" id="identity" name="identity" />

                                   

                                   <footer class='footer_chat'>
                                          <div class="type_msg">
                                          <div class="input_msg_write">

                                                        <!-- <input type="file" id="file" name="file" /> -->

                                                
                                                        <textarea placeholder="Type a message" id="write_msg" class="write_msg"></textarea>
                                                        <button class="msg_send_btn" id="msg_send_btn" type="button"><i
                                                                      class="fa fa-paper-plane-o"
                                                                      aria-hidden="true"></i></button><br>
                                                        <button class="msg_send_btn_attach" onclick="$('.file-upload-input').trigger( 'click' )"  id="msg_send_btn" type="button"><i
                                                                      class="fa fa-paperclip"
                                                                      aria-hidden="true"></i></button>
                                                        <button class="msg_send_btn_action" style="<?php echo $display_action; ?>" data-toggle="modal" type="button"
                                                           data-target="#CreateForm"  id="CreateButton" data-keyboard="false" data-backdrop="false"><i
                                                                      class="fa fa-file-text-o"
                                                                      
                                                                      
                                                                      aria-hidden="true"></i></button>
                                                 </div>
                                          </div>
                                   </footer>

                                   
                                   </form>                                  


                                   

                                   <script class="jsbin" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
                         
                                   <!-- <button class="file-upload-btn" type="button" onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button> -->

                                   <input class="file-upload-input" type='file' id="file" name="file" accept="image/*" />

                                   


                                   
                                   

                            </div>
                     </div>


              </div>
       </div>
</body>

</html>







                        </div>
                    </div>
                </div>
                <!-- Row -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
      



<!-- add modal -->
<div class="modal  fade fade-custom" tabindex="-1" role="dialog" id="CreateForm">
       <div class="modal-dialog modal-belakang modal-bgkpi" role="document">
              <div class="modal-content">
                     <div class="modal-header">
                            <h4 class="modal-title">Response Request</h4>
                            <a type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
                                   <span aria-hidden="true"><img src="../../asset/dist/img/icons/icon_del.png"></span>
                            </a>
                     </div>

                     <div class="card-body table-responsive p-0" style="width: 100vw;height: 50vh; width: 98%; margin: 5px;overflow: scroll;overflow-x: hidden;">
                     
                     <form class="form-horizontal" action="php_action/FuncDataCreateResponse.php" method="POST"
                            id="FormDisplayCreate">

                            <fieldset id="fset_1">
                                   <legend>Detail Information</legend>

                                   <div class="messages_create"></div>

                                   <input id="inp_emp_no" name="inp_emp_no" type="hidden" value="<?php echo $username; ?>">
                       
                                   <div class="form-row" id="WD0">
                                          <div class="col-sm-2 name">ID Whistle blower <span class="required">*</span></div>
                                          <div class="col-sm-10">
                                                 <div class="input-group">
                                                        <input class="input--style-6" autocomplete="off" autofocus="on"
                                                               id="inp_whistle_request" 
                                                               name="inp_whistle_request"
                                                               type="Text" value="<?php echo $new_key; ?>" onfocus="hlentry(this)" size="30"
                                                               maxlength="50"
                                                               placeholder="input title"
                                                               style="text-transform:uppercase;"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Status<span class="required">*</span></div>
                                          <div class="col-sm-4">
                                                 <div class="input-group">

                                                        <select class="form-control input--style-6" 
                                                                      autocomplete="off" 
                                                                      autofocus="on"
                                                                      id="inp_status" 
                                                                      name="inp_status"
                                                                      style="height: 33px;">
                                                                             <option value="" selected> --Select one --</option>
                                                                             <?php 
                                                                             $sql=mysqli_query($connect, "SELECT * FROM hrmstatus WHERE code IN ('101','102')");
                                                                             while ($data=mysqli_fetch_array($sql)) {
                                                                             ?>
                                                                             <option value="<?=$data['code']?>"><?=$data['name_id']?></option> 
                                                               <?php
                                                               }
                                                               ?>
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-sm-2 name">Case Detail <span class="required">*</span></div>
                                          <div class="col-sm-6">
                                                 <div class="input-group">
                                                        <textarea id="editor" value="" name="inp_address"></textarea>
                                                 </div>
                                          </div>
                                   </div>

                                  
                                  
                                   
                                 
                            </fieldset>





                            </div>
                            <div class="modal-footer-sdk">
                                   <button type="reset" class="btn-sdk btn-primary-left" data-dismiss="modal" onclick="ResetTable();"
                                          aria-hidden="true">
                                          &nbsp;Cancel&nbsp;
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="submit" name="submit_add" id="submit_add">
                                          Confirm
                                   </button>
                                   <button class="btn-sdk btn-primary-right" type="button" name="submit_add2"
                                          id="submit_add2" style='display:none;' disabled>
                                          <span class="spinner-grow spinner-grow-sm" role="status"
                                                 aria-hidden="true"></span>
                                          &nbsp;&nbsp;Processing..
                                   </button>
                            </div>
                    
                     </form>
              </div>
       </div>
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /edit modal -->
<?php include "../template/sys.footer.php";?>
<script>
function RefreshPage() {
       datatable.ajax.reload(null, true);

       setTimeout(function(){
              mymodalss.style.display = "none";
              document.getElementById("msg").innerHTML = "Data refreshed";
              return false;
       }, 2000);

       mymodalss.style.display = "block";
       document.getElementById("msg").innerHTML = "Data refreshed";
       return false;
}
</script>

<!-- isi JSON -->
<script type="text/javascript">



$(document).ready(function() {
       $("#CreateButton").on('click', function() {
              // reset the form 

       
              $("#FormDisplayCreate")[0].reset();
              // empty the message div

              $(".messages_create").html("");

              // submit form
              $("#FormDisplayCreate").unbind('submit').bind('submit', function() {

                     $(".text-danger").remove();

                     var form = $(this);

                     var inp_emp_no              = $("#inp_emp_no").val();
                     var inp_whistle_request     = $("#inp_whistle_request").val();
                     var inp_status              = $("#inp_status").val();
                     var editor              = $("#editor").val();

                     
                     

                     var regex=/^[a-zA-Z]+$/;
                  
                     if (inp_emp_no == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Emp id cannot empty";

                     } else if (inp_whistle_request == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Title cannot empty";

                     } else if (inp_status == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Startdate cannot empty";
                     
                     } else if (editor == "") {
                            modals.style.display ="block";
                            document.getElementById("msg").innerHTML = "Suspector cannot empty";

                     } else {
                            $('#submit_add').hide();
                            $('#submit_add2').show();
                             mymodalss.style.display = "block";
                     }

                     if (inp_emp_no && inp_whistle_request && inp_status && editor) {
                            //submi the form to server
                            $.ajax({
                                   url: form.attr('action'),
                                   type: form.attr('method'),
                                   // data: form.serialize(),

                                   data: new FormData(this),
                                   processData: false,
                                   contentType: false,

                                   dataType: 'json',
                                   success: function(response) {

                                          // remove the error 
                                          $(".form-group").removeClass('has-error').removeClass('has-success');

                                          if (response.code =='success_message') {

                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                                 
                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 
                                                 

                                                 // failed_message_without_attachment

                                          } else {
                                                 mymodalss.style.display = "none";
                                                 modals.style.display ="block";
                                                 document.getElementById("msg").innerHTML = response.messages;

                                                 $('#submit_add').show();
                                                 $('#submit_add2').hide();

                                                 window.setTimeout(
                                                        function() {
                                                               $(".alert")
                                                                      .fadeTo(
                                                                             500,
                                                                             0
                                                                             )
                                                                      .slideUp(
                                                                             500,
                                                                             function() {
                                                                                    $(this)
                                                                             .remove();
                                                                             }
                                                                      );
                                                        },
                                                        4000
                                                        );
                                          } // /else
                                   } // success  
                            }); // ajax subit 				
                     } /// if
                     return false;
              }); // /submit form for create member
       }); // /add modal
});







$(document).ready(function() {
       selesai();
       $.ajax(
       {
       url: "get_row_data.php", // path to your PHP file
       type: 'POST',
       dataType: 'json',

       data: {
              'id_chat': '<?php echo $new_key; ?>' // <-- the $ sign in the parameter name seems unusual, I would avoid it
       },
       success: function(response)
              {
                     $("#row_msg").val(response.messages);
                     // alert(response.messages);
              } // success
       }) // ajax
              $.ajax(
                     {
                     url: "new_data_load.php", // path to your PHP file
                     type: 'POST',
                     dataType:"html",
                     data: { 
                            'id_chat': '<?php echo $new_key; ?>' // <-- the $ sign in the parameter name seems unusual, I would avoid it
                     },
                     success: function(data)
                     {
                            // If you want to add the data at the bottom of the <div> use .append()

                            $('#load-into-div-first').append(data); // load-into-div is the ID of the DIV where you load the <select>
                            // $('#load-into-div-second').hide;

                            // Or if you want to add the data at the top of the div
                            

                            var objDiv = document.getElementById("msg_history");
                            objDiv.scrollTop = objDiv.scrollHeight;

                            //$('#load-into-div').prepend(data); // Prepend will add the new data at the top of the selector
              } // success
       }) // ajax
});


$("#msg_send_btn").click(function(){
  var msges = document.getElementById("write_msg").value;

  
   
    $.ajax(
    {
    url: "new_data.php", // path to your PHP file
    type: 'POST',
    dataType:"html",
    data: {
        'id_chat': '<?php echo $new_key; ?>',
        'messageng': msges // <-- the $ sign in the parameter name seems unusual, I would avoid it
    },
    success: function(response){
                     document.getElementById('write_msg').value = "";

                     var objDiv = document.getElementById("msg_history");
                     objDiv.scrollTop = objDiv.scrollHeight;
              },
}) // ajax
});

document.getElementById("file").onchange = function() {
    
        var fd = new FormData();
        var files = $('#file')[0].files;
        var identity = document.getElementById("identity").value;
        
        // Check file selected or not
        if(files.length > 0 ){
           fd.append('file',files[0]);

           $.ajax({
              url: 'new_data.php?identity=' + identity,
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(response){
                 if(response != 0){
                    $("#img").attr("src",response); 
                    $(".preview img").show(); // Display image element
                 }else{
                    alert('file not uploaded');
                 }
              },
           });
        }else{
           alert("Please select a file.");
        }
    };


 
function selesai() {

	setTimeout(function() {

              $.ajax(
              {
              url: "get_row_data.php", // path to your PHP file
              type: 'POST',
              dataType: 'json',

              data: {
                     'id_chat': '<?php echo $new_key; ?>' // <-- the $ sign in the parameter name seems unusual, I would avoid it
              },
              success: function(response)
                     {
                            // alert(response.messages);

                            var row_msg = $("#row_msg").val();

                            if(row_msg != response.messages){

                                   const audio = new Audio("alert.mp3");
                                   audio.play();

                                   // alert("bedanih");
                                   $.ajax(
                                   {
                                   url: "get_row_data.php", // path to your PHP file
                                   type: 'POST',
                                   dataType: 'json',

                                   data: {
                                          'id_chat': '<?php echo $new_key; ?>' // <-- the $ sign in the parameter name seems unusual, I would avoid it
                                   },
                                   success: function(response)
                                          {
                                                 $("#row_msg").val(response.messages);
                                                 // alert(response.messages);
                                          } // success
                                   }); // ajax'

                                   $.ajax(
                                          {
                                          url: "new_data_load.php", // path to your PHP file
                                          type: 'POST',
                                          dataType:"html",
                                          data: { 
                                                 'id_chat': '<?php echo $new_key; ?>' // <-- the $ sign in the parameter name seems unusual, I would avoid it
                                          },
                                          success: function(data)
                                          {
                                                 

                                                 // $('#load-into-div-first').hide();

                                                
                                                 //alert("data")
                                                 // If you want to add the data at the bottom of the <div> use .append()

                                                $("#load-into-div-first").load("new_data_load.php?id_chat=<?php echo $new_key; ?>", function(responseTxt, statusTxt, xhr){
                                                 if(statusTxt == "success")
                                                        // alert("External content loaded successfully! document scroll top");
                                                        var objDiv = document.getElementById("msg_history");
                                                        objDiv.scrollTop = objDiv.scrollHeight;
                                    
                                                 });
                                                 

                                                 
                                                 

                                                 

                                                 //$('#load-into-div').prepend(data); // Prepend will add the new data at the top of the selector
                                   } // success
                            }) // ajax
                                   
                                   
                            }
                            // alert(response.messages);
                     } // success
              }) // ajax

    
		selesai();
	}, 2000);
}
 
// function update() {
// 	$.getJSON("new_data_load.php", function(data) {
// 		$("table").empty();
// 		var no = 1;
// 		$.each(data, function() {
// 			$('#load-into-div').append(data);
// 		});
// 	});
// }
</script>
<!-- employeeListSpectator -->
<script src="asset/ckeditor.js"></script>
<script src="asset/js/sample.js"></script>
<script src="asset/js/sampleupdate.js"></script>
                        
    <script>
                     initSample();
                     initSampleUpdate();
              </script>