<?php 
include "../../../application/session/session_ess.php";

$username = $_POST['id'];

$sql = mysqli_query($connect, "SELECT 
a.emp_no,
DATE_FORMAT(a.start_date, '%d %M %Y') AS join_date,
a.first_name,
a.middle_name,
a.last_name,
a.birthplace,
DATE_FORMAT(a.birthdate, '%d %M %Y') AS birthdate,
b.identity_no AS ktp,
c.customfield16 AS nokk,
CASE
  when a.gender = '1' then 'LAKI - LAKI'
  when a.gender = '0' then 'PEREMPUAN'
END AS gender,
d.bloodtype,
e.religion_name_en,
CASE
  when a.maritalstatus = '1' then 'Kawin'
  when a.maritalstatus = '0' then 'Lajang'
END AS maritalstatus,
f.nationality_name_id,
a.phone,
a.email AS email_perusahaan,
c.customfield15 AS email_pribadi,
g.address AS alamatktp,
g.zipcode AS zipcodektp,
h.country_name AS negaraktp,
i.state_name AS provinsiktp,
j.city_name AS kotaktp,
g.rt AS rtktp,
g.rw AS rwktp,
o.district_name AS kecamatanktp,
p.subdistrict_name AS kelurahanktp,
k.address AS alamatdomisili,
k.zipcode AS zipcodedomisili,
l.country_name AS negaradomisili,
m.state_name AS provinsidomisili,
n.city_name AS kotadomisili,
k.rt AS rtdomisili,
k.rw AS rwdomisili,
q.district_name AS kecamatandomisli,
r.subdistrict_name AS kelurahandomisili
FROM view_employee a
LEFT JOIN mgtools_teodemppersonal b ON b.emp_id = a.emp_id 
LEFT JOIN mgtools_teodempcustomfield c ON c.emp_id = a.emp_id
LEFT JOIN mgtools_teodempmedical d ON d.emp_id = a.emp_id
LEFT JOIN teomreligion e ON e.religion_code = b.religion_code
LEFT JOIN teomnationality f ON f.nationality_code = b.nationality_code
LEFT JOIN mgtools_teodempaddress g ON g.emp_id = a.emp_id AND g.addresstype_code = 'B'
LEFT JOIN tgemcountry h ON h.country_id = g.country_id
LEFT JOIN tgemstate i ON i.state_id = g.state_id
LEFT JOIN tgemcity j ON j.city_id = g.city_id
LEFT JOIN mgtools_teodempaddress k ON k.emp_id = a.emp_id AND k.addresstype_code = 'A'
LEFT JOIN tgemcountry l ON l.country_id = k.country_id
LEFT JOIN tgemstate m ON m.state_id = k.state_id
LEFT JOIN tgemcity n ON n.city_id = k.city_id
LEFT JOIN tgemdistrict o ON o.district_id = g.district
LEFT JOIN tgemsubdistrict p ON p.subdistrict_id = g.subdistrict
LEFT JOIN tgemdistrict q ON q.district_id = k.district
LEFT JOIN tgemsubdistrict r ON r.subdistrict_id = k.subdistrict
WHERE a.emp_no = '$username'");

$data = mysqli_fetch_assoc($sql);

?>

<!-- <div class="modal-body"> -->
<fieldset id="fset_1">
    <legend>Personal Data</legend>    
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Employee Number :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['emp_no']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Join Date :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['join_date']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-4">
            <div class="form-row">
                <div class="col-12 name">First Name :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['first_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-row">
                <div class="col-12 name">Midle Name :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['middle_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="form-row">
                <div class="col-12 name">Last Name :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['last_name']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-6">
            <div class="form-row">
                <div class="col-12 name">Birthplace :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['birthplace']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-row">
                <div class="col-12 name">Birthdate :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['birthdate']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-12 name">NIK (Identity Card) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['ktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-12 name">NIKK (Family Identity Card) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['nokk']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Gender :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['gender']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Blood Type :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['bloodtype']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Religion :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['religion_name_en']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Marital Status :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['maritalstatus']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-2 name">Nationality :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['nationality_name_id']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-12 name">Personal Contact (No Handphone) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['phone']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-12 name">Personal Contact (Email Company) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['email_perusahaan']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-12 name">Personal Contact (Personal Email) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['email_pribadi']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-3 name">Address (ID Card) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                    <textarea class="textarea--style-6" style="min-height:80px" id="" name="" placeholder="Address" disabled><?php echo $data['alamatktp']; ?></textarea>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-3 name">ZIP Code (ID Card) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['zipcodektp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-4">
            <div class="form-row">
                <div class="col-12 name">Country :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['negaraktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-row">
                <div class="col-12 name">State :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['provinsiktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-row">
                <div class="col-12 name">City :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['kotaktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-1">
            <div class="form-row">
                <div class="col-12 name">RT :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['rtktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-1">
            <div class="form-row">
                <div class="col-12 name">RW :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['rwktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-6">
            <div class="form-row">
                <div class="col-12 name">Distric :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['kecamatanktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-row">
                <div class="col-12 name">Subdistrict :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['kelurahanktp']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-3 name">Address (Domisili) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                    <textarea class="textarea--style-6" style="min-height:80px" id="" name="" placeholder="Address" disabled><?php echo $data['alamatdomisili']; ?></textarea>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-12">
            <div class="form-row">
                <div class="col-3 name">ZIP Code (Domisili) :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['zipcodedomisili']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-4">
            <div class="form-row">
                <div class="col-12 name">Country :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['negaradomisili']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-row">
                <div class="col-12 name">State :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['provinsidomisili']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="form-row">
                <div class="col-12 name">City :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['kotadomisili']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-1">
            <div class="form-row">
                <div class="col-12 name">RT :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['rtdomisili']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-1">
            <div class="form-row">
                <div class="col-12 name">RW :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['rwdomisili']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
    <div class="form-row" style="padding-bottom:0px">
        <div class="col-6">
            <div class="form-row">
                <div class="col-12 name">Distric :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['kecamatandomisli']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="form-row">
                <div class="col-12 name">Subdistrict :</div>
            </div>
            <div class="form-row">
                <div class="col-sm-12" >
                    <div class="input-group">
                        <input class="input--style-6"
                                                               autocomplete="off" autofocus="on" 
                                                               name="tambah_nc" id="tambah_nc" type="Text" value="<?php echo $data['kelurahandomisili']; ?>"
                                                               onfocus="hlentry(this)" size="30" maxlength="" style="font-weight:"
                                                               validate="NotNull:Invalid Form Entry"
                                                               onchange="formodified(this);" title="" disabled>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</fieldset>
<!-- </div> -->