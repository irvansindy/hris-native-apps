<?php include "../../application/session/session.php";

$id         = $_POST['id'];


$sql_data   = mysqli_query($connect, "SELECT * FROM teomworklocation WHERE worklocation_code = '$id'");

$data       = mysqli_fetch_assoc($sql_data);

// QUery untuk ambil data city
$sql_city           = mysqli_query($connect, "SELECT
a.city_id,
a.city_name
FROM tgemcity a
WHERE a.state_id = '$data[state_id]'");


// QUery untuk ambil data city

// QUery untuk ambil data state
$sql_state           = mysqli_query($connect, "SELECT
a.state_id,
a.state_name
FROM tgemstate a
WHERE a.country_id = '$data[country_id]'");


// QUery untuk ambil data state

// QUery untuk ambil data country
$sql_country           = mysqli_query($connect, "SELECT
a.country_id,
a.country_name
FROM tgemcountry a");


// QUery untuk ambil data country

?>

<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<link rel="stylesheet" href="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.css" />
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/moment.js"></script>
<script type="text/javascript" src="../../asset/gt_developer/gt_datepicker_20211002/materialDateTimePicker.js"></script>

<div class="modal-dialog modal-lg">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Edit Work Location</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>


              <!-- <form method="post" id="myform"> -->

                            <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <div class="form-row">
                                          <div class="col-4 name">Work Location Code</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="wl_code" id="wl_code" type="Text" value="<?php echo $data['worklocation_code'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Work Location Name *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="wl_name" id="wl_name" type="Text" value="<?php echo $data['worklocation_name'] ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" >
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Work Location Type *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select class="input--style-6" name="wl_type" id="wl_type" style="width: ;height: 30px;">
                                                               <option value="">-- Select one --</option>
                                                               
                                                               <option value="JAKARTA" <?php if($data['worklocation_type'] == 'JAKARTA'){ echo 'selected'; } ?> >JAKARTA</option>
                                                               <option value="KARAWANG" <?php if($data['worklocation_type'] == 'KARAWANG'){ echo 'selected'; } ?> >KARAWANG</option>
                                                               <option value="TANGERANG" <?php if($data['worklocation_type'] == 'TANGERANG'){ echo 'selected'; } ?> >TANGERANG</option>

                                                               
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Work Location Address </div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <textarea class="textarea--style-6" id="wl_address" name="wl_address" placeholder="Address"><?php echo $data['worklocation_address'] ?></textarea>

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">Country *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select class="input--style-6" name="country" id="country" style="width: ;height: 30px;">
                                                               <option value="">-- Select one --</option>
                                                               <?php 
                                                                      while($loop_country = mysqli_fetch_assoc($sql_country)){

                                                                      
                                                               ?>

                                                               <option value="<?php echo $loop_country['country_id']; ?>" <?php if($data['country_id'] == $loop_country['country_id']){ echo 'selected'; } ?> ><?php echo $loop_country['country_name'] ?></option>

                                                               <?php } ?>
                                                        

                                                               
                                                        </select>

                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">State/Province *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select class="input--style-6" name="state" id="state" style="width: ;height: 30px;">
                                                               <option value="">-- Select one --</option>
                                                               <?php 
                                                                      while($loop_state = mysqli_fetch_assoc($sql_state)){

                                                                      
                                                               ?>

                                                               <option value="<?php echo $loop_state['state_id']; ?>" <?php if($data['state_id'] == $loop_state['state_id']){ echo 'selected'; } ?> ><?php echo $loop_state['state_name'] ?></option>

                                                               <?php } ?>
                                                        

                                                               
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                          <div class="col-4 name">City *</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <select class="input--style-6" name="city" id="city" style="width: ;height: 30px;">
                                                               <option value="">-- Select one --</option>
                                                               <?php 
                                                                      while($loop_city = mysqli_fetch_assoc($sql_city)){

                                                                      
                                                               ?>

                                                               <option value="<?php echo $loop_city['city_id']; ?>" <?php if($data['city_id'] == $loop_city['city_id']){ echo 'selected'; } ?> ><?php echo $loop_city['city_name'] ?></option>

                                                               <?php } ?>
                                                        

                                                               
                                                        </select>
                                                 </div>
                                          </div>
                                   </div>
                                   <div class="form-row">
                                        <div class="col-sm-4 name">Phone</div>
                                        <div class="col-sm-3">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                                                id="phone"
                                                                                                name="phone" type="Text"
                                                                                                size="30" maxlength="50" 
                                                                                                
                                                                                                onchange="formodified(this);" title=""
                                                                                                value="<?php echo $data['phone'] ?>" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>eg. +62.21.1111111 and use comma (,) for multiple entries</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-4 name">Fax</div>
                                        <div class="col-sm-3">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                                                id="fax"
                                                                                                name="fax" type="Text"
                                                                                                size="30" maxlength="50" 
                                                                                                
                                                                                                onchange="formodified(this);" title=""
                                                                                                value="<?php echo $data['fax'] ?>" >
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <p>eg. +62.21.1111111 and use comma (,) for multiple entries</p>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-sm-4 name">Email</div>
                                        <div class="col-sm-8">
                                            <div class="input-group">

                                                <input class="input--style-6"
                                                                                                id="email"
                                                                                                name="email" type="Text"
                                                                                                size="30" maxlength="50" 
                                                                                                
                                                                                                onchange="formodified(this);" title=""
                                                                                                value="<?php echo $data['email'] ?>" >
                                            </div>
                                        </div>
                                    </div>
                                   

                                  
                            </fieldset>


                            
                    
                                                 <br>
                                                 <tr>
                                                        <td colspan="2" align="right" width="100%">
                                                               <div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                                    <button type="submit" id="delete_wl"
                                                                                    class="btn btn-danger">Delete</button>
                                                                             <button type="submit" id="ubah_worklocation"
                                                                                    class="btn btn-warning">Submit</button>
                                                                      </div>
                                                               </div>
                                                        </td>
                                                 </tr>
                               

                            </table>
                     </div>
              <!-- </form> -->
       </div>

</div>
</div>
</div>

<script>
$(document).ready(function(){  
       $(document).on('click', '#ubah_worklocation', function(){
              var wl_code          = $('#wl_code').val();            
              var wl_name          = $('#wl_name').val();
              var wl_type          = $('#wl_type').val();
              var wl_address       = $('#wl_address').val();
              var city_val         = $('#city').val();
              var state_val        = $('#state').val();
              var country_val      = $('#country').val();
              var phone            = $('#phone').val();
              var fax              = $('#fax').val();
              var email            = $('#email').val();

              if(wl_name == ''){
                     alert('Work Name is required!');
                     return;
              }else if(wl_type == ''){
                     alert('Work Location Type is required!');
                     return;
              }else if(country_val == ''){
                     alert('Country is required!');
                     return;
              }else if(state_val == ''){
                     alert('State/Provincies is required!');
                     return;
              }else if(city_val == ''){
                     alert('City is required!');
                     return;
              }

              // alert(fileupload);
              let formData = new FormData();
                formData.append('wl_code', wl_code);
                formData.append('wl_name', wl_name);
                formData.append('wl_type', wl_type);
                formData.append('wl_address', wl_address);
                formData.append('city_val', city_val);
                formData.append('state_val', state_val);
                formData.append('country_val', country_val);
                formData.append('phone', phone);
                formData.append('fax', fax);
                formData.append('email', email);
               
              $.ajax({
                     type: 'POST',
                     url: "ajax_ubahworklocation.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                       location.reload();
					return;
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	        });

       }); 

       $(document).on('click', '#delete_wl', function(){
              var wl_code          = $('#wl_code').val();            

       let formData = new FormData();
                formData.append('wl_code', wl_code);

       $.ajax({
                     type: 'POST',
                     url: "ajax_deleteworklocation.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
	                alert(msg);
                       location.reload();
					return;

	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	});

       });
}); 
</script>

<!-- Auto Complete City -->
<script>  
 $(document).ready(function(){  
      $('#city').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"auto_city.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#citylist').fadeIn();  
                          $('#citylist').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '#licity', function(){ 
            var id1 = $(this).attr('id1');
           $('#city').val($(this).text());  
           $('#city_val').val(id1);

           $('#citylist').fadeOut();  
      });  
 });  
 </script>
 <!-- Auto Complete City -->

 <!-- Auto Complete State -->
 <script>  
 $(document).ready(function(){  
       $(document).on('change', '#state', function(){
              var state_id          = $(this).val();            

       let formData = new FormData();
                formData.append('state_id', state_id);

       $.ajax({
                     type: 'POST',
                     url: "auto_city.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
                          
	                $('#city').html(msg);

	            },
	            
	});

       }); 
 });  
 </script>
 <!-- Auto Complete State -->

  <!-- Auto Complete Country -->
<script>  
 $(document).ready(function(){  
       $(document).on('change', '#country', function(){
              var country_id          = $(this).val();            

       let formData = new FormData();
                formData.append('country_id', country_id);

       $.ajax({
                     type: 'POST',
                     url: "auto_state.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {

	                $('#state').html(msg);

	            },
	            
	});
		          $('#city').html('<option value="">-- Select one ---</option>');


       }); 
 });  
 </script>
 <!-- Auto Complete Country -->

             
              <script type="text/javascript">
              $(document).ready(function() {
                     $('#inp_date').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_enddate').bootstrapMaterialDatePicker({
                            time: false,
                            clearButton: true
                     });

                     $('#inp_starttime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });

                     $('#inp_endtime').bootstrapMaterialDatePicker({
                            date: false,
                            format: 'HH:mm'
                     });
              });
              </script>