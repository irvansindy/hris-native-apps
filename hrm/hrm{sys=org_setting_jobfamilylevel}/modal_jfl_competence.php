<?php include "../../application/session/session.php";

$id     = $_POST['id'];


// Ambil data job family 
$sql_jfl_competence     = mysqli_query($connect, "SELECT 
a.competence_code,
a.point_value
FROM tpmrjflcompetence a WHERE a.jfl_code = '$id'");
// Ambil data job family 


?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-lg">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Family Level Competence</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->
                                <div class="card-body table-responsive p-0"
                                        style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px;overflow: scroll;">
                                        <table id="example3LOAD" width="99%" border="1"
                                                class="table table-bordered table-striped table-hover table-head-fixed">


                                                <thead>
                                                        <tr>
                                                               <th class="fontCustom" style="z-index: 1;">CompetenceCode</th>
                                                               <th class="fontCustom" style="z-index: 1;">Competency</th>
                                                               <th class="fontCustom" style="z-index: 1;">Competence Point</th>
                                                               


                                                               
                                                               

                                                        </tr>
                                                     

                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        while($data_jfl_competence  = mysqli_fetch_assoc($sql_jfl_competence)){
                                                    ?>
                                                    <tr>
                                                        <td class='fontCustom'><?php echo $data_jfl_competence['competence_code']; ?></td>
                                                        <td class='fontCustom'><?php echo $data_jfl_competence['competence_code']; ?></td>
                                                        <td class='fontCustom'><?php echo $data_jfl_competence['point_value']; ?></td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                                       

                                        </table>


                                        

                                </div>
                                   
                                   
                            </fieldset>
                            <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                             <!-- <button type="submit" id="submit_jfl"
                                                                                    class="btn btn-warning">Submit</button> -->
                                                                      </div>
                                                               </div>
</div>
</div>
                            
                           
<script>
$(document).ready(function(){  

    

}); 
</script>

<script>
$(document).ready(function() {
   
});
</script>
