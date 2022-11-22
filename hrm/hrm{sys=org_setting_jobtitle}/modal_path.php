<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data job family grade
$sql_jt      = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.jobtitle_name_en
FROM teomjobtitle a WHERE a.jobtitle_code = '$id'");

$data_jf     = mysqli_fetch_assoc($sql_jt);

// Ambil data job family grade


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>
<!-- Autocomplete -->
<script src="jquery.autocomplete.min.js"></script>

<style>
            
            
            input[type=text] {
                
            }
            input[type=text]:focus {
                border: 2px solid #757575;
            	outline: none;
            }
            .autocomplete-suggestions {
                border: 1px solid #999;
                background: #FFF;
                overflow: auto;
            }
            .autocomplete-suggestion {
                padding: 2px 5px;
                white-space: nowrap;
                overflow: hidden;
            }
            .autocomplete-selected {
                background: #F0F0F0;
            }
            .autocomplete-suggestions strong {
                font-weight: normal;
                color: #3399FF;
            }
            .autocomplete-group {
                padding: 2px 5px;
            }
            .autocomplete-group strong {
                display: block;
                border-bottom: 1px solid #000;
            }
        </style>

<div class="modal-dialog modal-bg">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Career Path</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

              <fieldset id="fset_1">

                                   
                <div class="form-row">
                                          <div class="col-2 name">Search Job Title</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id1="<?php echo $id; ?>"
                                                               name="jt_code" id="jt_code" type="Text" value="<?php echo $data_jf['jobtitle_name_en'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>

                    

                            
                            

                    
                </fieldset>

                <fieldset id="fset_1">
                    <div class="form-row">
                        <div class="col-sm-12">
                            <table width="100%">
                                <tr align="center">
                                    <td style="width:25%"><b style="font-weight:bold; font-size:14px">Previous</b></td>
                                    <td style="width:12%"> </td>
                                    <td style="width:25%"><b style="font-weight:bold; font-size:14px">Current</b></td>
                                    <td style="width:12%"> </td>
                                    <td style="width:12%"><b style="font-weight:bold; font-size:14px">Next</b></td>
                                </tr>
                                <tr>
                                    <td style="width:25%"><div style="width:100%; height:2px; background:black"></div></td>
                                    <td style="width:12%"></td>
                                    <td style="width:25%"><div style="width:100%; height:2px; background:black"></div></td>
                                    <td style="width:12%"></td>
                                    <td style="width:25%"><div style="width:100%; height:2px; background:black"></div></td>
                                </tr>

                                <tr height="50px">
                                    <td style="width:25%"></td>
                                    <td style="width:12%">
                                        <table width="100%">
                                            <tr align="center">
                                                <td><img src="img/in-bal.png" alt=""></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width:25%; text-align:center"><div id="current"><p><?php echo $id; ?></p></div></td>
                                    <td style="width:12%">
                                        <table width="100%">
                                            <tr align="center">
                                                <td><img src="img/in-bal.png" alt=""></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="width:25%"></div></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </fieldset>

                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             
                                                                             <button type="submit" id="submit_jf"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

       $(document).on('click', '#submit_jf', function(){
            //   var jf_code         = $('#jf_code').val();            
            //   var jf_name_en      = $('#jf_name_en').val();
            //   var jf_name_id      = $('#jf_name_id').val();
            //   var jf_desc_en      = $('#jf_desc_en').val();
            //   var jf_desc_id      = $('#jf_desc_id').val();

            //   if($jf_code == ''){
            //          alert('Job family code is required!');
            //          return;
            //   }else if(jf_name_en == ''){
            //          alert('Job family name en is required!');
            //          return;
            //   }else if(jf_name_id == ''){
            //          alert('Job family name id is required!');
            //          return;
            //   }else if(jf_desc_en == ''){
            //          alert('Job family desc en is required!');
            //          return;
            //   }
            //   else if(jf_desc_id == ''){
            //          alert('Job family desc id is required!');
            //          return;
            //   }

            //   // alert(fileupload);
            //   let formData = new FormData();
            //     formData.append('jf_code', jf_code);
            //     formData.append('jf_name_en', jf_name_en);
            //     formData.append('jf_name_id', jf_name_id);
            //     formData.append('jf_desc_en', jf_desc_en);
            //     formData.append('jf_desc_id', jf_desc_id);
               
            //   $.ajax({
            //          type: 'POST',
            //          url: "ajax_add_jf.php",
            //          data: formData,
            //          cache: false,
            //          processData: false,
            //          contentType: false,
	        //     success: function (msg) {
	        //         alert(msg);
            //            location.reload();
	        //     },
	        //     error: function () {
	        //         alert("Data Gagal Diupload");
	        //     }
	        // });

       }); 

       $(document).on('click', '#delete_jfl', function(){
            //   var jfl_code         = $('#jfl_code').val();            
       

            //   // alert(fileupload);
            //   let formData = new FormData();
            //     formData.append('jfl_code', jfl_code);
               
            //   $.ajax({
            //          type: 'POST',
            //          url: "ajax_delete_jfl.php",
            //          data: formData,
            //          cache: false,
            //          processData: false,
            //          contentType: false,
	        //     success: function (msg) {
	        //         alert(msg);
            //            location.reload();
	        //     },
	        //     error: function () {
	        //         alert("Data Gagal Diupload");
	        //     }
	        // });

       }); 


}); 
</script>

<script>
$(document).ready(function() {
    $(document).on('click', '#jobfamilyrelation', function(){
        // var id  = $(this).attr('id1');
        // $.post('data_jobfamilyrelation.php',{id:id}, function (data) {
        //         var w = window.open('data_jobfamilyrelation.php?id='+id+'','width=900,height=200,top=50,left=80,resizable=1,menubar=yes', true);
        //         w.document.open();
        //         w.document.write(data);
        //         w.document.close();
        //         // w.document.focus();
        // });
    });
});
</script>

<script type="text/javascript">
            $(document).ready(function() {

                // Selector input yang akan menampilkan autocomplete.
                $( "#jt_code" ).autocomplete({
                    serviceUrl: "ajax_job_title.php",   // Kode php untuk prosesing data.
                    dataType: "JSON",           // Tipe data JSON.
                    onSelect: function (suggestion) {
                        $( "#jt_code" ).val("" + suggestion.value);
                        $( "#jt_code" ).attr('id1', suggestion.parent);
                        $("#current").html('<p>'+suggestion.value+'</p>');
                    }
                });
            })
        </script>

<script>
