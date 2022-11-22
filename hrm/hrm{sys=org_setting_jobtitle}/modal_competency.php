<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data job family grade
$sql_jt      = mysqli_query($connect, "SELECT 
a.jobtitle_code,
a.competence_code,
b.competence_name_en,
a.point_value
FROM tpmrjobtitlecompetence a 
LEFT JOIN tpmmcompetence b ON b.competence_code = a.competence_code
WHERE a.jobtitle_code = '$id'
ORDER BY a.created_by ASC");

// $data_jf     = mysqli_fetch_assoc($sql_jf);

// Ambil data job family grade


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-md">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Competence</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

              <fieldset id="fset_1">

                                   
                <div class="card-body table-responsive p-0"
                            style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                            <table id="example3LOAD" width="99%" border="1"
                                    class="table table-bordered table-striped table-hover table-head-fixed">


                                    <thead>
                                        <tr>
                                                <th class="fontCustom" style="z-index: 1;" >Competence Code</th>
                                                <th class="fontCustom" style="z-index: 1;" >Competency</th>
                                                <th class="fontCustom" style="z-index: 1;" >Competence Point</th>

                                                


                                                
                                                

                                            </tr>
                                        

                                    </thead>
                                    <tbody>
                                    <!-- <?php 
                                        while($data_job_title = mysqli_fetch_assoc($sql_jt)){
                                    ?>
                                        <tr>
                                            <td class='fontCustom'><?php echo $data_job_title['competence_code']; ?></td>
                                            <td class='fontCustom'><?php echo $data_job_title['competence_name_en']; ?></td>
                                            <td class='fontCustom'><?php echo $data_job_title['point_value']; ?></td>
                                        </tr>
                                    <?php } ?> -->
                                    </tbody>
                                    
                                        

                            </table>


                            

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
