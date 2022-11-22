<?php 
include "../../application/session/session.php";

$id     = $_POST['id'];

// Query ambil data company
$sql    = mysqli_query($connect, "SELECT
a.company_logo,
a.company_code,
a.company_type,
a.company_name,
a.nick_name,
a.company_level,
a.taxcountry,
a.currency_code,
a.gmt_id,
a.`status`,
a.company_address,
a.company_address2,
a.city_id,
a.state_id,
a.country_id,
a.company_zipcode,
a.company_phone,
a.company_fax,
a.company_email,
a.vision_en,
a.vision_id,
a.mission_en,
a.mission_id
FROM teomcompany a
WHERE a.company_id = '$id'");

$data_company   = mysqli_fetch_assoc($sql);
// Query ambil data company

// Query ambil data currency
$sql_curr   = mysqli_query($connect, "SELECT
a.currency_symbol,
a.currency_code,
a.description
FROM tgemcurrency a
WHERE a.currency_code IN ('EUR','IDR','SKT','USD')");
// Query ambil data currency

// Query untuk ambil data time setting
$sql_timesett   = mysqli_query($connect, "SELECT
a.gmt_id,
a.gmtplusmin,
a.gmtrefhour,
a.gmtrefminute,
a.gmtcountry 
FROM tsfmtimezone a");
// Query untuk ambil data time setting

// Query untuk ambil tax country
$sql_taxcountry     = mysqli_query($connect, "SELECT 
a.name_en
FROM tpymtaxcountry a
WHERE a.code = '$data_company[taxcountry]'");

$data_taxcountry    = mysqli_fetch_assoc($sql_taxcountry);
// Query untuk ambil tax country

// QUery untuk ambil data city
$sql_city           = mysqli_query($connect, "SELECT
a.city_id,
a.city_name
FROM tgemcity a");

// $data_city      = mysqli_fetch_assoc($sql_city);
// QUery untuk ambil data city

// QUery untuk ambil data state
$sql_state           = mysqli_query($connect, "SELECT
a.state_id,
a.state_name
FROM tgemstate a");

// $data_state      = mysqli_fetch_assoc($sql_state);
// QUery untuk ambil data state

// QUery untuk ambil data country
$sql_country           = mysqli_query($connect, "SELECT
a.country_id,
a.country_name
FROM tgemcountry a");

// $data_country      = mysqli_fetch_assoc($sql_country);
// QUery untuk ambil data country

// Query untuk ambil company type
$sql_companytype    = mysqli_query($connect,"SELECT 
a.lob_code,
a.lob_name
FROM tgemlineofbusiness a");
// Query untuk ambil company type


?>
<!-- <form name='form1' method="post" id="multiple_upload_form" enctype="multipart/form-data"> -->

<input type="hidden" id="company_id" value="<?php echo $id; ?>">

<div class="form-row">
    <div class="col-sm-3 name">Company Logo</div>
    <div class="col-sm-8">
        <div class="form-row">
            <div class="col-sm-8">
                <img src="../../asset/upload/img/<?php echo $data_company['company_logo']; ?>" alt="" style="border: 3px solid gray;">
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-8">
                <a href="../../asset/upload/img/<?php echo $data_company['company_logo']; ?>" target="_blank"><u><?php echo $data_company['company_logo']; ?></u></a>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm-8">
            <input type="file" name="picture" id="picture" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Company Code</div>
    <div class="col-sm-8">
        <div class="input-group">
            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="company_code" id="company_code" type="Text"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""
                                                               value="<?php echo $data_company['company_code']; ?>" disabled>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Company Type *</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="company_type" id="company_type" style="width: ;height: 30px;">
                <?php 
                    while($data_companytype = mysqli_fetch_assoc($sql_companytype)){
                ?>
                <option value="<?php echo $data_companytype['lob_code'] ?>" <?php if($data_companytype['lob_code'] == $data_company['company_type']){ echo 'selected';} ?>><?php echo $data_companytype['lob_name'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Company Name *</div>
    <div class="col-sm-8">
        <div class="input-group">

            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="company_name" id="company_name" type="Text" value="<?php echo $data_company['company_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Short Name *</div>
    <div class="col-sm-8">
        <div class="input-group">

            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="short_name" id="short_name" type="Text" value="<?php echo $data_company['nick_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="">
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Company Level *</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="company_level" id="company_level" style="width: ;height: 30px;">
                <option value="2" <?php if($data_company['company_level'] == '2'){ echo 'selected';} ?>>Holding</option>
                <option value="1" <?php if($data_company['company_level'] == '1'){ echo 'selected';} ?>>Company</option>
                <option value="3" <?php if($data_company['company_level'] == '3'){ echo 'selected';} ?>>Business Unit</option>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Tax Country</div>
    <div class="col-sm-8">
        <div class="input-group">

            <input class="input--style-6"
                                                               autocomplete="off" autofocus="on"
                                                               name="tax_country" id="tax_country" type="Text"
                                                               onfocus="hlentry(this)" size="30" maxlength="50" 
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title=""
                                                               value="<?php echo $data_taxcountry['name_en']; ?>" disabled>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Base Currency *</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="base_currency" id="base_currency" style="width: ;height: 30px;">
                <option value="0">-- Select Currency --</option>
                <?php 
                    while($data_curr = mysqli_fetch_assoc($sql_curr)){
                ?>
                <option value="<?php echo $data_curr['currency_code'] ?>" <?php if($data_curr['currency_code'] == $data_company['currency_code']){ echo 'selected';} ?>><?php echo $data_curr['currency_symbol'] ?>-<?php echo $data_curr['description'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Secondary Base Currency</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="secbase_currency" id="secbase_currency" style="width: ;height: 30px;">
                <option value="0">Not specify</option>
                <?php 
                    while($data_curr = mysqli_fetch_assoc($sql_curr)){
                ?>
                <option value="<?php echo $data_curr['currency_code'] ?>" <?php if($data_curr['currency_code'] == 'x'){ echo 'selected';} ?>><?php echo $data_curr['currency_symbol'] ?>-<?php echo $data_curr['description'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Time Setting *</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="time_setting" id="time_setting" style="width: ;height: 30px;">
                <option value="0">-- Select Time Setting --</option>
                <?php 
                    while($data_timesett = mysqli_fetch_assoc($sql_timesett)){
                ?>
                <option value="<?php echo $data_timesett['gmt_id'] ?>" <?php if($data_timesett['gmt_id'] == $data_company['gmt_id']){ echo 'selected';} ?>>(GMT <?php echo $data_timesett['gmtplusmin'] ?><?php echo $data_timesett['gmtrefhour'] ?>:<?php echo $data_timesett['gmtrefminute'] ?>) <?php echo $data_timesett['gmtcountry'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Status</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="status" id="status" style="width: ;height: 30px;">
                <option value="1" <?php if($data_company['status'] == '1'){ echo 'selected';} ?>>Active</option>
                <option value="0" <?php if($data_company['status'] == '0'){ echo 'selected';} ?>>Inactive</option>
                <option value="2" <?php if($data_company['status'] == '2'){ echo 'selected';} ?>>Account</option>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Address</div>
    <div class="col-sm-8">
        <div class="input-group">
            <textarea class="textarea--style-6" id="address1" name="address1" placeholder="Address"><?php echo $data_company['company_address']; ?></textarea>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Other Address</div>
    <div class="col-sm-8">
        <div class="input-group">
            <textarea class="textarea--style-6" id="address2" name="address2" placeholder="Other Address"><?php echo $data_company['company_address2']; ?></textarea>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Country</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="country" id="country" style="width: ;height: 30px;">
                <option value="0">-- Select Country --</option>
                <?php 
                    while($data_country = mysqli_fetch_assoc($sql_country)){
                ?>
                <option value="<?php echo $data_country['country_id']; ?>" <?php if($data_country['country_id'] == $data_company['country_id']){ echo 'selected';} ?>><?php echo $data_country['country_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">State/Province</div>
    <div class="col-sm-8">
        <div class="input-group">

            <select class="input--style-6" name="state" id="state" style="width: ;height: 30px;">
                <option value="0">-- Select State --</option>
                <?php 
                    while($data_state = mysqli_fetch_assoc($sql_state)){
                ?>
                <option value="<?php echo $data_state['state_id']; ?>" <?php if($data_state['state_id'] == $data_company['state_id']){ echo 'selected';} ?>><?php echo $data_state['state_name']; ?></option>
                <?php } ?>
            </select>

        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">City</div>
    <div class="col-sm-8">
        <div class="input-group">

            

            <select class="input--style-6" name="city" id="city" style="width: ;height: 30px;">
                <option value="0">-- Select Time City --</option>
                <?php 
                    while($data_city = mysqli_fetch_assoc($sql_city)){
                ?>
                <option value="<?php echo $data_city['city_id']; ?>" <?php if($data_city['city_id'] == $data_company['city_id']){ echo 'selected';} ?>><?php echo $data_city['city_name']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
</div>


<div class="form-row">
    <div class="col-sm-3 name">Postal Code</div>
    <div class="col-sm-8">
        <div class="input-group">

            <input class="input--style-6"
                                                               id="postal_code"
                                                               name="postal_code" type="Text"
                                                               size="30" maxlength="50" 
                                                               
                                                               onchange="formodified(this);" title=""
                                                               value="<?php echo $data_company['company_zipcode']; ?>" >
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Phone</div>
    <div class="col-sm-4">
        <div class="input-group">

            <input class="input--style-6"
                                                               id="phone"
                                                               name="phone" type="Text"
                                                               size="30" maxlength="50" 
                                                               
                                                               onchange="formodified(this);" title=""
                                                               value="<?php echo $data_company['company_phone']; ?>" >
        </div>
    </div>
    <div class="col-sm-4">
        <p>eg. +62.21.1111111 and use comma (,) for multiple entries</p>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Fax</div>
    <div class="col-sm-4">
        <div class="input-group">

            <input class="input--style-6"
                                                               id="fax"
                                                               name="fax" type="Text"
                                                               size="30" maxlength="50" 
                                                               
                                                               onchange="formodified(this);" title=""
                                                               value="<?php echo $data_company['company_fax']; ?>" >
        </div>
    </div>
    <div class="col-sm-4">
        <p>eg. +62.21.1111111 and use comma (,) for multiple entries</p>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Email</div>
    <div class="col-sm-8">
        <div class="input-group">

            <input class="input--style-6"
                                                               id="email"
                                                               name="email" type="Text"
                                                               size="30" maxlength="50" 
                                                               
                                                               onchange="formodified(this);" title=""
                                                               value="<?php echo $data_company['company_email']; ?>" >
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Vision</div>
    <div class="col-sm-8">
        <div class="form-row" style="padding: 0px 0px 0px 0px">
            <div class="col-sm-9">
                <div class="input-group">
                    <textarea class="textarea--style-6" id="vision_en" name="vision_en" placeholder="Vision"><?php echo $data_company['vision_en']; ?></textarea>        
                </div>
            </div>
            <div class="col-sm-1">
                <div class="input-group">
                    <img src="img/flag_en.png" alt="">    
                </div>
            </div>
        </div>
        <div class="form-row" style="padding: 0px 0px 0px 0px">
            <div class="col-sm-9">
                <div class="input-group">
                    <textarea class="textarea--style-6" id="vision_id" name="vision_id" placeholder="Visi"><?php echo $data_company['vision_id']; ?></textarea>        
                </div>
            </div>
            <div class="col-sm-1">
                <div class="input-group">
                    <img src="img/flag_id.png" alt="">    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-row">
    <div class="col-sm-3 name">Mission</div>
    <div class="col-sm-8">
        <div class="form-row" style="padding: 0px 0px 0px 0px">
            <div class="col-sm-9">
                <div class="input-group">
                    <textarea class="textarea--style-6" id="mission_en" name="mission_en" placeholder="Mission"><?php echo $data_company['mission_en']; ?></textarea>        
                </div>
            </div>
            <div class="col-sm-1">
                <div class="input-group">
                    <img src="img/flag_en.png" alt="">    
                </div>
            </div>
        </div>
        <div class="form-row" style="padding: 0px 0px 0px 0px">
            <div class="col-sm-9">
                <div class="input-group">
                    <textarea class="textarea--style-6" id="mission_id" name="mission_id" placeholder="Misi"><?php echo $data_company['mission_id']; ?></textarea>        
                </div>
            </div>
            <div class="col-sm-1">
                <div class="input-group">
                    <img src="img/flag_id.png" alt="">    
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
                                                                      <div class="form-group">
                                                                             <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Cancel</button>
                                                                            
                                                                             <button id="ubah_company" type="submit"
                                                                                    class="btn btn-warning" value="">Ubah</button>
                                                                      </div>
                                                               </div>
<!-- </form> -->

<!-- Auto Complete State -->
<script>  
 $(document).ready(function(){  
    $(document).on('change', '#country', function(){
        $('#city').empty();
        var country_id  = $(this).val();
        
        $.ajax({  
                     url:"auto_state.php",  
                     method:"POST",  
                     data:{country_id:country_id},  
                     success:function(data)  
                     {  
                          $('#state').html(data);  
                     }  
        });  
    });
 });  
 </script>
 <!-- Auto Complete State -->

 <!-- Auto Complete City -->
<script>  
 $(document).ready(function(){  
    $(document).on('change', '#state', function(){
        var state_id  = $(this).val();
        
        $.ajax({  
                     url:"auto_city.php",  
                     method:"POST",  
                     data:{state_id:state_id},  
                     success:function(data)  
                     {  
                          $('#city').html(data);  
                     }  
        });  
    });
 });  
 </script>
 <!-- Auto Complete City -->

  <!-- Auto Complete Country -->
<script>  
 $(document).ready(function(){  
      $('#country').keyup(function(){  
           var query = $(this).val();  
           if(query != '')  
           {  
                $.ajax({  
                     url:"auto_country.php",  
                     method:"POST",  
                     data:{query:query},  
                     success:function(data)  
                     {  
                          $('#countrylist').fadeIn();  
                          $('#countrylist').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', '#licountry', function(){ 
            var id1 = $(this).attr('id1');
           $('#country').val($(this).text());  
           $('#country').attr('id1', id1);
           $('#country_val').val(id1);

           $('#countrylist').fadeOut();  
      });  
 });  
 </script>
 <!-- Auto Complete Country -->