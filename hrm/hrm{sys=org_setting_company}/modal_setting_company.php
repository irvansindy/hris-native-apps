<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />


<?php 

$id     = $_POST['id'];

?>

<div class="modal-dialog modal-bg">
       <div class="modal-content">

              <div class="modal-header">
                     <h4 class="modal-title">Company Setting</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modal_close"
                            style="margin-top: -15px;">
                            <span aria-hidden="true">&times;</span>
                     </button>
              </div>
              <div class="form-row" id="show_search" style="margin-top:5px; padding: 0px 0px 0px 0px; display:none">
              <div class="col-sm-8"></div>
              <div class="col-sm-2">
              <div id="show_search" style="display:">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="value_search" id="value_search" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                               </div>
                                                               </div>
              <div class="col-sm-2"><button class="btn btn-warning btn-sm" id1="0" id="modal_search">Search</button></div>          
              </div>

              <!-- <form method="post" id="myform"> -->
              <fieldset id="fset_1">
                                   <!-- <legend>Searching Form</legend> -->

                                   <!-- <div class="form-row">
                                          <div class="col-4 name">Employee No</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id="modal_emp"
                                                               name="nip" id="nip" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Employee Name</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" id="modal_emp"
                                                               name="full_name" id="full_name" type="Text" value=""
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
                                                 </div>
                                          </div>
                                   </div>

                                   <div class="form-row">
                                          <div class="col-4 name">Active Status</div>
                                          <div class="col-sm-8">
                                                 <div class="input-group">

                                                 <select class="input--style-6 modal_leave" name="inp_active"
                                                        style="width: 50%;height: 30px;" id="inp_active"
                                                        onchange="isi_otomatis_leave()">

                                               
                                                                                    <option value="">--Select One--
                                                                                    </option>
                                                                                    <option value="1">Active</option>
                                                                                    <option value="2">Inactive</option>
                                                                             </select>
                                                 </div>
                                          </div>
                                   </div> -->
                                  











<div class="col-md-12">
       <div class="card">
              <div class="card-header d-flex align-items-center">
                     <!-- <h4 class="card-title mb-0">Employee Access Menu Information</h4> -->


                     <div class="card-actions ml-auto">
                            


                     </div>
              </div>

              <style>
              body {
                     font-family: Arial;
              }

              /* Style the tab */
              .tab {
                     overflow: hidden;
                     border: 1px solid #ccc;
                     background-color: #f1f1f1;
              }

              /* Style the buttons inside the tab */
              .tab button {
                     background-color: inherit;
                     float: left;
                     border: none;
                     outline: none;
                     cursor: pointer;
                     padding: 14px 16px;
                     transition: 0.3s;
                     font-size: 12px;
              }

              /* Change background color of buttons on hover */
              .tab button:hover {
                     background-color: #ddd;
              }

              /* Create an active/current tablink class */
              .tab button.active {
                     background-color: #ccc;
              }

              /* Style the tab content */
              .tabcontent {
                     display: none;
                     padding: 6px 12px;
                     border: 1px solid #ccc;
                     border-top: none;
              }

              /* Style the close button */
              .topright {
                     float: right;
                     cursor: pointer;
                     font-size: 28px;
              }

              .topright:hover {
                     color: red;
              }
              </style>


                     <body>


                            <div class="tab">
                                    <button class="tablinks" id="companysetting">Company Setting</button>
                                    <button class="tablinks" id="bank">Bank</button>
                                    <button class="tablinks" id="insurance">Insurance</button>
                            </div>

                            <!-- TAB STARTTED -->

                                <div class="card-body table-responsive p-0" style="width: 100vw;height: 78vh; width: 98.8%; margin: 5px; margin: 5px;overflow: scroll;">  

                                    <div id="tampilansetting" class=""></div>

                                   
                                </div>

                            




                     </body>



                     
              <!-- </div> -->

              <div class='card-footer' style='background-color: #eee;height: 37px;padding-top: 5px;'>

                    

              </div>

       </div>
</div>

<!-- Column -->
<input type="hidden" id="return_bank" value="0">
<input type="hidden" id="return_bank_search" value="0">
<input type="hidden" id="return_insurance" value="0">
<input type="hidden" id="return_insurance_search" value="0">
<input type="hidden" id="return_company" value="0">



<script>

$(document).ready(function() {
    // Default active button
    var element1 = document.getElementById("companysetting");
    element1.classList.add("active");
    // Default active button

    // Default open data company setting
    load_data();
    function load_data(){
       

        var id      = '<?php echo $id; ?>';

                        $.ajax({
                            url:"data_company_setting.php",
                            method:"POST",
                            data:{id:id},
                            success:function(data){

                                $('#tampilansetting').html(data);
                            
                                
                                
                            }

                        })
                    

    }
    // Default open data company setting

    // Load bank setting
    function load_bank(modal_search,value_search){
       var return_bank        = $('#return_bank').val()
       if(return_bank == '1'){
              return;
       }

        var id      = '<?php echo $id; ?>';

                    $.ajax({
                        url:"data_bank_setting.php",
                        method:"POST",
                        data:{id:id},
                        success:function(data){

                            $('#tampilansetting').html(data);
                            // setTimeout(function() {
                            //        load_bank();
                            // }, 2000);
                            
                            
                        }

                    })
                

    }
    // Load bank setting

    // Load insurance setting
    function load_insurance(modal_search,value_search){
       var return_insurance        = $('#return_insurance').val()
       if(return_insurance == '1'){
              return;
       }

       var id      = '<?php echo $id; ?>';

            $.ajax({
                url:"data_insurance_setting.php",
                method:"POST",
                data:{id:id},
                success:function(data){

                    $('#tampilansetting').html(data);
                     
                   
                            // setTimeout(function() {
                            //        load_insurance();
                            // }, 2000);
                    
                    
                }

            })
        

}
// Load insurance setting


    $(document).on('click', '#companysetting', function(){
       $('#return_bank').val('1');
       $('#return_bank_search').val('1');
       $('#return_insurance').val('1');
       $('#return_company').val('0');
        // active inactive button
        var element1 = document.getElementById("companysetting");
        var element2 = document.getElementById("bank");
        var element3 = document.getElementById("insurance");
        element1.classList.add("active");
        element2.classList.remove("active");
        element3.classList.remove("active");
        load_data();
        // active inactive button
        const show_search = $("#show_search");
        show_search.css("display", "none");

    }); 

    $(document).on('click', '#bank', function(){
       $('#return_bank').val('0');
       $('#return_bank_search').val('1');
       $('#return_insurance_search').val('1');
       $('#return_insurance').val('1');
       $('#return_company').val('1');
        // active inactive button
        var element1 = document.getElementById("companysetting");
        var element2 = document.getElementById("bank");
        var element3 = document.getElementById("insurance");
        element1.classList.remove("active");
        element2.classList.add("active");
        element3.classList.remove("active");
        load_bank();
        // active inactive button

        const show_search = $("#show_search");
        show_search.css("display", "");

        $('#modal_search').attr('id1', '1');


    }); 
    
    $(document).on('click', '#insurance', function(){
       $('#return_bank').val('1');
       $('#return_bank_search').val('1');
       $('#return_insurance_search').val('1');
       $('#return_insurance').val('0');
       $('#return_company').val('1');
        // active inactive button
        var element1 = document.getElementById("companysetting");
        var element2 = document.getElementById("bank");
        var element3 = document.getElementById("insurance");
        element1.classList.remove("active");
        element2.classList.remove("active");
        element3.classList.add("active");
        load_insurance();
        // active inactive button

        const show_search = $("#show_search");
        show_search.css("display", "");

        $('#modal_search').attr('id1', '2');

    }); 

    $(document).on('click', '#modal_close', function(){
       $('#return_bank').val('1');
       $('#return_bank_search').val('1');
       $('#return_insurance').val('1');
       $('#return_insurance_search').val('1');
       $('#return_company').val('0');
}); 
//     Ubah Company
       $(document).on('click', '#ubah_company', function(){
              const fileupload     = $('#picture').prop('files')[0];  
              var company_id       = $('#company_id').val();            
              var company_code     = $('#company_code').val();
              var company_type     = $('#company_type').val();
              var company_name     = $('#company_name').val();
              var short_name       = $('#short_name').val();
              var company_level    = $('#company_level').val();
              var tax_country      = $('#tax_country').val();
              var base_currency    = $('#base_currency').val();
              var secbase_currency = $('#secbase_currency').val();
              var time_setting     = $('#time_setting').val();
              var status           = $('#status').val();
              var address1         = $('#address1').val();
              var address2         = $('#address2').val();
              var city_val         = $('#city').val();
              var state_val        = $('#state').val();
              var country_val      = $('#country').val();
              var postal_code      = $('#postal_code').val();
              var phone            = $('#phone').val();
              var fax              = $('#fax').val();
              var email            = $('#email').val();
              var vision_en        = $('#vision_en').val();
              var vision_id        = $('#vision_id').val();
              var mission_en       = $('#mission_en').val();
              var mission_id       = $('#mission_id').val();

              // alert(fileupload);
              let formData = new FormData();
                formData.append('picture', fileupload);
                formData.append('company_id', company_id);
                formData.append('company_code', company_code);
                formData.append('company_type', company_type);
                formData.append('company_name', company_name);
                formData.append('short_name', short_name);
                formData.append('company_level', company_level);
                formData.append('tax_country', tax_country);
                formData.append('base_currency', base_currency);
                formData.append('secbase_currency', secbase_currency);
                formData.append('time_setting', time_setting);
                formData.append('status', status);
                formData.append('address1', address1);
                formData.append('address2', address2);
                formData.append('city_val', city_val);
                formData.append('state_val', state_val);
                formData.append('country_val', country_val);
                formData.append('postal_code', postal_code);
                formData.append('phone', phone);
                formData.append('fax', fax);
                formData.append('email', email);
                formData.append('vision_en', vision_en);
                formData.append('vision_id', vision_id);
                formData.append('mission_en', mission_en);
                formData.append('mission_id', mission_id);


              $.ajax({
                     type: 'POST',
                     url: "ajax_ubahcompany.php",
                     data: formData,
                     cache: false,
                     processData: false,
                     contentType: false,
	            success: function (msg) {
                     //   load_data();
                       alert(msg);
                       window.location.href = '../hrm{sys=org_setting_company}';
	            },
	            error: function () {
	                alert("Data Gagal Diupload");
	            }
	        });

       }); 
// Ubah Company

// Reload bank
$(document).on('click', '#reload_bank', function(){
       $('#return_bank').val('0');
       $('#return_bank_search').val('1');
       $('#return_insurance_search').val('1');
       $('#return_insurance').val('1');
       $('#return_company').val('1');
        
        load_bank();

}); 
// Reload Bank
// Reload insurance
$(document).on('click', '#reload_insurance', function(){
       $('#return_bank').val('1');
       $('#return_bank_search').val('1');
       $('#return_insurance_search').val('1');
       $('#return_insurance').val('0');
       $('#return_company').val('1');
        
        load_insurance();

}); 
// Reload Bank

// Search

$(document).on('click', '#modal_search', function(){
        
        var modal_search    = $(this).attr('id1');
        var value_search    = $('#value_search').val();

       //  alert(value_search);
       if(modal_search == '1'){
              $('#return_bank').val('1');
              $('#return_bank_search').val('1');
              setTimeout(function() {
                     $('#return_bank_search').val('0');
                     load_bank_search(modal_search,value_search);
                     $('#value_search').val('');
              }, 2000);
              
       }else if(modal_search == '2'){
              $('#return_insurance').val('1');
              $('#return_insurance_search').val('1');
              setTimeout(function() {
                     $('#return_insurance_search').val('0');
                     load_insurance_search(modal_search,value_search);
                     $('#value_search').val('');
              }, 2000);
       }

});

// Search

// Load bank setting search
function load_bank_search(modal_search,value_search){
       var return_bank        = $('#return_bank_search').val()
       if(return_bank == '1'){
              return;
       }

        var id      = '<?php echo $id; ?>';

        let formData = new FormData();
                formData.append('id', id);
                formData.append('value_search', value_search);

                    $.ajax({
                            type: 'POST',
                            url: "data_bank_setting.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                        success:function(data){

                            $('#tampilansetting').html(data);
                            // setTimeout(function() {
                            //        load_bank_search(modal_search,value_search);
                            // }, 2000);
                            
                            
                        }

                    })
                

    }
// Load bank setting search

// Load insurance setting search
function load_insurance_search(modal_search,value_search){
       var return_insurance        = $('#return_insurance_search').val()
       if(return_insurance == '1'){
              return;
       }

        var id      = '<?php echo $id; ?>';

        let formData = new FormData();
                formData.append('id', id);
                formData.append('value_search', value_search);

                    $.ajax({
                            type: 'POST',
                            url: "data_insurance_setting.php",
                            data: formData,
                            cache: false,
                            processData: false,
                            contentType: false,
                        success:function(data){

                            $('#tampilansetting').html(data);
                            // setTimeout(function() {
                            //        load_insurance_search(modal_search,value_search);
                            // }, 2000);
                            
                            
                        }

                    })
                

    }
// Load insurance setting search
    
});  

</script>







                                 
                            </fieldset>

                            
       </div>

</div>
</div>

</div>