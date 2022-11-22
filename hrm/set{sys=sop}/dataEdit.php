<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<script src="vendor/modal/bootstrap.min.js"></script>
<script src="sweetalert.js"></script>
<link rel="stylesheet" href="w3.css">

<div class="col-md-12">
<div class="card">
<div class="card-header d-flex align-items-center" style = "padding-left : 20px; padding-top : 40px; padding-bottom : 40px">
<h4 class="card-title mb-0" style = "font-size : 15px">SOP Edit User Authorization</h4>
<div class="card-actions ml-auto">
</div>
</div>

<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2"  data-backdrop="false">
<div class="modal-dialog" role="document">
<div class="modal-content">
<div class="modal-body">

<button type="button" class="close" onclick='return stopload()' data-dismiss="modal" aria-label="Close" style="margin-top: -15px;">
       <span aria-hidden="true">&times;</span>
</button>

<form>
       <fieldset id="fset_1" style="margin-top: 25px;border-radius: 5px;border: 1px solid #e4e8ea;">
       <legend>Searching</legend>
       <div class="form-row">
              <div class="col-4 name">Cost code</div>
       <div class="col-sm-8">
       <div class="input-group">
              <input class="input--style-6" autocomplete="off" autofocus="on" name="src_cost_code" id="src_cost_code" type="Text" value="" onfocus="hlentry(this)" size="30" maxlength="50"  validate="NotNull:Invalid Form Entry" onchange="formodified(this);" title="">
       </div>
       </div>
       </div>
       </fieldset>

       <button type="submit"  data-dismiss="modal" aria-label="Close" name="submit_filter" id="submit_filter" type="button" class="btn btn-warning button_bot"> 
              Filter
       </button>
</form>

</div>
</div>
</div>
</div>

<!-- Isi Data -->

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sqlProsedur = "SELECT * FROM hrmgroupotorisasi WHERE idGroup = '$id'";
    $prosedur = mysqli_query($connect, $sqlProsedur);
    $masukin = mysqli_fetch_array($prosedur);
    $namaGroupValue = $masukin['namaGroup'];
}
?>

<div style = "margin-top : 10px; margin-left : 30px; margin-right : 30px">
        <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98%; margin: 5px; overflow: scroll">

        <h3>Edit User Authorization</h3>
        <hr>

<fieldset id="fset_1" style = "margin-bottom : 20px; margin-right : 20px">
       <legend>Employee User Authorization</legend>

       <div style = "margin-right : 15px; margin-left : 10px">
       <form method="POST" action="#">
           <div class="form-group row" style = "padding-left : 12px; margin-top : 10px">
               <label class="col-sm-2 col-form-label" style = "font-weight : normal">Nama Group Otorisasi</label>
               <div class="col-sm-10">
                   <input type="hidden" name = "namaGroupLama" value = "<?php echo $namaGroupValue; ?>" class="form-control kategori_field" autocomplete = "off">
                   <input type="text" name = "namaGroup" value = "<?php echo $namaGroupValue; ?>" class="form-control kategori_field" autocomplete = "off">
               </div>
           </div>

           <div class="form-row" id="show_employee">
           <div class="col-11 name">Employee</div>
           <div class="col-sm-1" style="padding-left: 55px;">
           <div class="card-body table-responsive p-0" style="overflow: scroll;overflow-x: hidden;">
           <td>
              <a href='#' class='open_modal_search' class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
                     <div class="toolbar sprite-toolbar-search" id="SEARCH" title="Search">
                     </div>
              </a>
           </td>
           </div>
           </div>
           </div>

           <link rel="stylesheet" href="../../asset/gt_developer/asset_use/jquery.tree-multiselect.min.css">
           <script src="../../asset/gt_developer/asset_use/jquery-ui.min.js"></script>
           <script src="../../asset/gt_developer/asset_use/jquery.tree-multiselect.js"></script>

           <div style = "padding-left : 12px; margin-top : 10px">

              <div id = "box">

              </div>

           </div>

           <br>
           <br>

              <div style = "padding-left : 12px">
                     <input type="submit" name="submit" style = "margin-top : 5px; margin-bottom : 20px; border : none; width : 80px; height : 30px" class="btn btn-primary" value = "Submit">

                     <a href="index.php">
                     <input type="button" style = "border : none; margin-bottom : 15px; width : 80px; height : 30px" class="btn btn-primary" value = "Back">
                     </a>
              </div>

       </form>
       </div>

</fieldset>

    </div>
</div>

<!-- Footer -->
<div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>
<div class='row mb-2'>
<div class='col-sm-10'>
       <?php 
       echo $filterprint; 
       echo '<h6>Still On Development</h6?';
       ?>
</div>
<div class='col-sm-2'>
</div>
</div>
</div>
</div>

<!-- isi JSON -->
<script type="text/javascript">
$(document).ready(function() {
       mymodalss.style.display = "block";
       var src_cost_code = $("#src_cost_code").val();
       $("#box").load("page_otorisasi.php?src_cost_code=" + src_cost_code,
                     function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          $("#box1").show();
                                          if($("#box1").show()) {
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );

       // $('#box2').html('<select id="select2" multiple="multiple"></select>');

       $("#submit_filter").on('click', function() {
              if(c != "") {
                     var src_cost_code = $("#src_cost_code").val();
                     mymodalss.style.display = "block";
                     $("#box1").load("page_otorisasi.php?src_cost_code=" + src_cost_code,
                     function(responseTxt, statusTxt, jqXHR){
                                   if(statusTxt == "success"){
                                          $("#box1").show();
                                          if($("#box1").show()) {
                                                 mymodalss.style.display = "none";
                                          }
                                   }
                                   if(statusTxt == "error"){
                                          alert("Error: " + jqXHR.status + " " + jqXHR.statusText);
                                   }
                            }
                     );
              }
       });
});
</script>
<!-- isi JSON -->