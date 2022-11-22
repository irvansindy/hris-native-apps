<?php  
       $src_overtimecode           = '';
       $src_minimumtime            = '';
       if (!empty($_POST['src_overtimecode']) && !empty($_POST['src_minimumtime'])) {
              $src_overtimecode    = $_POST['src_overtimecode'];
              $src_minimumtime     = $_POST['src_minimumtime'];
              $frameworks          = "?src_overtimecode="."".$src_overtimecode." &&src_minimumtime="."".$src_minimumtime."";
       } else if (empty($_POST['src_overtimecode']) && !empty($_POST['src_minimumtime'])) {
              $src_overtimecode    = $_POST['src_overtimecode'];
              $src_minimumtime     = $_POST['src_minimumtime'];
              $frameworks          = "?src_minimumtime="."".$src_minimumtime."";
       } else if (!empty($_POST['src_overtimecode']) && empty($_POST['src_minimumtime'])) {
              $src_overtimecode    = $_POST['src_overtimecode'];
              $src_minimumtime     = $_POST['src_minimumtime'];
              $frameworks          = "?src_overtimecode="."".$src_overtimecode."";
       }
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
                                                 <legend>Searching</legend>
                                                 <div class="form-row">
                                                        <div class="col-4 name">Overtime code</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on" id="src_overtimecode"
                                                                             name="src_overtimecode" id="src_overtimecode" type="Text" value="<?php echo $src_overtimecode; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                                 <div class="form-row">
                                                        <div class="col-4 name">Minimum time</div>
                                                        <div class="col-sm-8">
                                                               <div class="input-group">

                                                                      <input class="input--style-6"
                                                                             autocomplete="off" autofocus="on"
                                                                             name="src_minimumtime" id="src_minimumtime" type="Text" value="<?php echo $src_minimumtime; ?>"
                                                                             onfocus="hlentry(this)" size="30" maxlength="50" 
                                                                             validate="NotNull:Invalid Form Entry"
                                                                             onchange="formodified(this);" title="">
                                                               </div>
                                                        </div>
                                                 </div>

                                          </fieldset>
                                          
                                          <button type="submit" name="submit_add" id="submit_add" type="button" class="btn btn-warning button_bot">
                                                 Filter
                                          </button>
                                          
                                   </form>
				</div>
	       </div><!-- modal-content -->
       </div><!-- modal-dialog -->
</div><!-- modal -->

<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<script type="text/javascript" src="../../asset/sdk_datatables_core/gt_dist/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="../../asset/sdk_datatables_core/datatables/bedanihbuatjson/bootstrap/js/bootstrap.min.js"></script>
<!-- MAIN DATATABLE SERVERSIDE CSS -->
<!-- MAIN DATATABLE SERVERSIDE CSS -->

<!-- isi JSON -->
<script type="text/javascript">
// global the manage memeber table 
$(document).ready(function() {
       datatable = $("#datatable").DataTable({
              processing: true,
              // retrieve: true,
              searching: false,
              paging: true,
              order: [
                     [0, "asc"]
              ],
              bPaginate: true,
              bLengthChange: false,
              bFilter: false,
              bInfo: true,
              bAutoWidth: true,
              language: {
                     "processing": "Please wait..",
              },
              destroy: true,
              "ajax": "php_action/FuncDataRead.php<?php echo $frameworks; ?>"
       });
});
</script>




<div class="col-md-12">
       <div class="card" style="width: 103.3%;padding-left: -10px;margin-left: -20px;margin-top: -26px;">
             

              <div class="card-body table-responsive p-0"
                     style="width: 100vw;height: 78vh; width: 99.5%; margin: 5px;overflow: scroll;">
                     <form action="" method="POST">


                     

                                          <table class="table table-bordered table-striped table-hover table-head-fixed" id="tbl_posts_second" style="width: 660px;">
                                                 <thead>
                                                        <tr>
                                                               <th>Order</th>
                                                               <th>Formula</th>
                                                               <th><a class="add-record_second" style="margin-right: 7px;" data-added="0"><img src="../../asset/img/icons/acssadd.png"></a></th>
                                                        </tr>
                                                 </thead>
                                                 <tbody id="tbl_posts_body_second">
                                                        <?php
                                                               $no = 0;
                                                               $get_formula = mysqli_query($connect, "SELECT * FROM hrmattformula_dev");
                                                               while($row_formula = mysqli_fetch_array($get_formula)){
                                                               $no = $no+1;
                                                        ?>
                                                        <tr id="recs-<?php echo $no; ?>">
                                                               <td><span class="sn"><?php echo $row_formula['process_order']; ?></span>.</td>
                                                               <td><textarea type="text" id="formula<?php echo $no; ?>" name="formula1[]" style="width: 450px;height: 100px;" class="form-control each"><?php echo $row_formula['attformula']; ?></textarea></td>
                                                               </textarea></td>
                                                               <td><a class="delete-record_seconds" data-added="0"><img src="../../asset/img/icons/minus.png"></a>
                                                               <img onclick="SelectName<?php echo $row_formula['process_order']; ?>()" src="../../asset/dist/img/suggest.png" style="cursor: pointer;"></td>
                                                        </tr>

                                                        <script type="text/javascript">
                                                        var popup;
                                                        function SelectName<?php echo $row_formula['process_order']; ?>() {
                                                               var x = document.getElementById("formula<?php echo $no; ?>").value; 
                                                               popup = window.open("Popup.php?id=" + x + '&git=<?php echo $row_formula['process_order']; ?>', "Popup", "width=510,height=300");
                                                               popup.focus();
                                                               return false
                                                        }
                                                        </script>

                                                         <script type="text/javascript">
                                                        $(document).ready(function() {
                                                               jQuery(document).delegate('a.add-record_second', 'click', function(e) {
                                                                      e.preventDefault();
                                                                      var content = jQuery('#sample_table_second tr'),
                                                                             size = jQuery('#tbl_posts_second >tbody >tr').length + 1,
                                                                             element = null,
                                                                             element = content.clone();
                                                                      element.attr('id', 'recs-' + size);
                                                                      element.find('.delete-record_second').attr('data-id', size);
                                                                      element.find('.each').attr('id', 'formula' + size);
                                                                      element.appendTo('#tbl_posts_body_second');
                                                                      element.find('.sn').html(size);
                                                               });
                                                               jQuery(document).delegate('a.delete-record_second', 'click', function(e) {
                                                                      e.preventDefault();
                                                                             var id = jQuery(this).attr('data-id');
                                                                             var targetDiv = jQuery(this).attr('targetDiv');
                                                                             jQuery('#recs-' + id).remove();

                                                                             //regnerate index number on table
                                                                             $('#tbl_posts_body_second tr').each(function(index) {
                                                                                    $(this).find('span.sn').html(index + 1);
                                                                             });
                                                                             return true;
                                                               });
                                                               jQuery(document).delegate('a.delete-record_seconds', 'click', function(e) {
                                                                      e.preventDefault();
                                                                             var id = jQuery(this).attr('data-id');
                                                                             var targetDiv = jQuery(this).attr('targetDiv');
                                                                             jQuery('#recs-<?php echo $no; ?> ').remove();

                                                                             //regnerate index number on table
                                                                             $('#tbl_posts_body_second tr').each(function(index) {
                                                                                    $(this).find('span.sn').html(index + 1);
                                                                             });
                                                                             return true;
                                                               });
                                                        });
                                                        </script>
  <?php } ?>
                                                      
                                                 </tbody>
                                          </table>
                                          <div style="display:none;">
                                                 <table id="sample_table_second"
                                                        class="table table-bordered table-striped table-hover table-head-fixed">
                                                        <tr id="" class="reset-delete-record">
                                                               <td><span class="sn"></span>.</td>
                                                               <td><textarea type="text" id="" name="formula1[]" style="width: 450px;height: 100px;" class="form-control each"><?php echo $row_formula['attformula']; ?></textarea></td>
                                                               <td>
                                                                      <a class="delete-record_second" data-added="0"><img src="../../asset/img/icons/minus.png"></a>
                                                                      <img onclick="SelectName()" src="../../asset/dist/img/suggest.png" style="cursor: pointer;" class="each">
                                                               </td>
                                                        </tr>
                                                 </table>
                                          </div>
                                        

                                          <script type="text/javascript">
                                          $(document).ready(function() {
                                                 jQuery(document).delegate('a.add-record_second', 'click', function(e) {
                                                        e.preventDefault();
                                                        var content = jQuery('#sample_table_second tr'),
                                                               size = jQuery('#tbl_posts_second >tbody >tr').length + 1,
                                                               element = null,
                                                               element = content.clone();
                                                        element.attr('id', 'recs-' + size);
                                                        element.find('.delete-record_second').attr('data-id', size);
                                                        element.find('.each').attr('id', 'formula' + size);
                                                        element.appendTo('#tbl_posts_body_second');
                                                        element.find('.sn').html(size);
                                                 });
                                                 jQuery(document).delegate('a.delete-record_second', 'click', function(e) {
                                                        e.preventDefault();
                                                               var id = jQuery(this).attr('data-id');
                                                               var targetDiv = jQuery(this).attr('targetDiv');
                                                               jQuery('#recs-' + id).remove();

                                                               //regnerate index number on table
                                                               $('#tbl_posts_body_second tr').each(function(index) {
                                                                      $(this).find('span.sn').html(index + 1);
                                                               });
                                                               return true;
                                                 });
                                                 jQuery(document).delegate('a.delete-record_seconds', 'click', function(e) {
                                                        e.preventDefault();
                                                               var id = jQuery(this).attr('data-id');
                                                               var targetDiv = jQuery(this).attr('targetDiv');
                                                               jQuery('#recs-1').remove();

                                                               //regnerate index number on table
                                                               $('#tbl_posts_body_second tr').each(function(index) {
                                                                      $(this).find('span.sn').html(index + 1);
                                                               });
                                                               return true;
                                                 });
                                          });
                                          </script>

                            <button type="submit" name="submitformula" value="submitformula" class="btn btn-warning">Submit</button>
                     </form>
              </div>
                                               
              </div>
       </div>
</div>

<?php include "insert.php";?>