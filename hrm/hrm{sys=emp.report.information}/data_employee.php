<?php 
include "../../application/session/session.php";

$view_emloyee = $_POST['filter_employee'];
$encode_employee = json_encode($view_emloyee, TRUE);
$replace1 = str_replace('[', '', $encode_employee);
$replace2 = str_replace(']', '', $replace1);

$sql_personal = mysqli_query($connect, "SELECT 
a.emp_no,
a.photo,
DATE_FORMAT(a.start_date, '%d %M %Y') AS join_date,
DATE_FORMAT(a.end_date, '%d %M %Y') AS end_date,
a.first_name,
a.middle_name,
a.last_name,
a.Full_Name,
a.birthplace,
DATE_FORMAT(a.birthdate, '%d %M %Y') AS birthdate,
b.identity_no AS ktp,
c.customfield16 AS nokk,
CASE
  when a.gender = '1' then 'Male'
  when a.gender = '0' then 'Female'
END AS gender,
d.bloodtype,
e.religion_name_en,
CASE
  when a.maritalstatus = '1' then 'Married'
  when a.maritalstatus = '0' then 'Single'
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
WHERE a.emp_no IN ($replace2)")


?>

<style>
body {
	background-color:white;
	font-family:Verdana; 
	font-size:8pt;
}
table {
	border-collapse:collapse;
}
td {
	background-color:white;
	padding:2px 4px 2px 4px;
	font:8pt Verdana;
	
	vertical-align:top;
}
</style>

<form method="post" id="" action="export/print_excel.php">
<input type="hidden" name="req_employee" value='<?php echo $replace2; ?>'>

<div>
    <table>
        <tr>
            <td>
                <button>
                <img src="../../asset/img/icons/excel.png" alt="">
                </button>
            </td>
        </tr>
    </table>
</div>
</form>
<div>
    <div id="title_report" style="text-align:center"><strong>EMPLOYEE DETAIL REPORT</strong></div>
    <br>
    <?php 
    while($profile = mysqli_fetch_assoc($sql_personal)){
    ?>
    <div>
        <table width="100%" border="1">
            <tr>
                <td width="85%">
                    <table width="100%">
                        <tr>
                            <td width="15%">
                                <p style="margin-bottom:0px">Name</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['Full_Name']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <p style="margin-bottom:0px">Employee No</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['emp_no']; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td valign="center" style="text-align:center">
                    <img style="height:120px" src="../../asset/emp_photos/<?php echo $profile['photo']; ?>" alt="">
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table width="100%" border="1">
            <tr>
                <td colspan="2"><p style="margin-bottom:0px; font-weight:bold">Personal Information</p></td>
            </tr>
            <tr>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Nationality</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['nationality_name_id']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Birth Place</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['birthplace']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Gender</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['gender']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Marital Status</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['maritalstatus']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Marital Date</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px">N/A</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Marital Place</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px">N/A</p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">ID Number</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['ktp']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Date of Birth</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['birthdate']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Religion</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['religion_name_en']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Salutation</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px">N/A</p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Email</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['email_perusahaan']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">ID Expired date</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['end_date'] ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table width="100%" border="1">
            <tr>
                <td colspan="2"><p style="margin-bottom:0px; font-weight:bold">Addres and Phone Information</p></td>
            </tr>
            <tr>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px; font-weight:bold">Current Address</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['alamatdomisili'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">City</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['kotadomisili'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Country</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['negaradomisili'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px; font-weight:bold">ID Card Address</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['alamatktp'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">City</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['kotaktp'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Country</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['negaraktp'] ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Phone</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['phone'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">State / Province</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['provinsidomisili'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Postal Code</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['zipcodedomisili'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Phone</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['phone'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">State / Province</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['provinsiktp'] ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Postal Code</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $profile['zipcodektp'] ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div>
                    <table width="100%"  border="1">
                        <tr>
                            <td colspan="2"><p style="margin-bottom:0px; font-weight:bold">Emergency Contact Information</p></td>
                        </tr>
                        <?php 
                        $sql_emergency = mysqli_query($connect, "SELECT 
                        a.contact_name,
                        b.relationship_name_en,
                        a.relationship_other,
                        a.phone,
                        c.state_name,
                        d.city_name,
                        e.country_name,
                        a.zipcode,
                        a.address
                        FROM mgtools_teodempemergency a 
                        LEFT JOIN teomfamilyrelation b ON a.relationship_code = b.relationship_code
                        LEFT JOIN tgemstate c ON c.state_id = a.state_id
                        LEFT JOIN tgemcity d ON d.city_id = a.city_id
                        LEFT JOIN tgemcountry e ON e.country_id = a.country_id
                        WHERE a.emp_id = (SELECT emp_id FROM view_employee WHERE emp_no = '$profile[emp_no]')");

                        while($data_emergency = mysqli_fetch_assoc($sql_emergency)){
                        ?>
                        <tr>
                            <td width="50%">
                                <table width="100%">
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">Name</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['contact_name']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">Relationship Other</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['relationship_other']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">Relationship</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['relationship_name_en']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">Phone / Mobile Phone</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['phone']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">
                                <table width="100%">
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">City</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['city_name']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">Country</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['country_name']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">State / Province</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['state_name']; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="35%">
                                            <p style="margin-bottom:0px">Postal Code</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['zipcode']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table width="100%">
                                    <tr>
                                        <td width="20%">
                                            <p style="margin-bottom:0px">Address</p>
                                        </td>
                                        <td width="2%">
                                            <p style="margin-bottom:0px">:</p>
                                        </td>
                                        <td width="">
                                            <p style="margin-bottom:0px"><?php echo $data_emergency['address']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
    </div>
    <br>
    <div>
        <table width="100%" border="1">
            <tr>
                <td colspan="6">
                    <p style="margin-bottom:0px; font-weight:bold">Family and Dependent Information</p>
                </td>
            </tr>
            <tr>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Name</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Relationship</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Birthdate</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Status</p>
                </td>
            </tr>
            <?php 
            $sql_family = mysqli_query($connect, "SELECT 
            c.relationship_name_en,
            b.name,
            DATE_FORMAT(b.birthdate, '%d %M %Y') AS tanggal_lahir,
            CASE 
               when b.alive_status = '1' then 'Active'
               when b.alive_status = '0' then 'Inactive'
            END AS alaive_status
            FROM view_employee a
            LEFT JOIN mgtools_teodempfamily b ON b.emp_id = a.emp_id
            LEFT JOIN teomfamilyrelation c ON c.relationship_code = b.relationship
            WHERE a.emp_no = '$profile[emp_no]'");

            while($family = mysqli_fetch_assoc($sql_family)){
            ?>
            <tr>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $family['name']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $family['relationship_name_en']; ?></p>
                </td>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $family['tanggal_lahir']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $family['alaive_status']; ?></p>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    <div>
        <table width="100%" border="1">
            <tr>
                <td colspan="6">
                    <p style="margin-bottom:0px; font-weight:bold">Education</p>
                </td>
            </tr>
            <tr>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Level</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Name</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Major</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Period</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">City</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Country</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">GPA</p>
                </td>
            </tr>
            <?php 
            $sql_education = mysqli_query($connect, "SELECT 
            b.edu_type,
            c.edu_name,
            b.major,
            d.city_name,
            f.country_name,
            e.name_en,
            b.start_year,
            b.end_year,
            b.gpa
            FROM view_employee a
            LEFT JOIN mgtools_teodempeducation b ON b.emp_id = a.emp_id
            LEFT JOIN teomeduinstitution c ON c.edu_code = b.edu_name
            LEFT JOIN tgemcity d ON d.city_id = b.city
            LEFT JOIN TEOMFACULTY e ON e.code = b.faculty
            LEFT JOIN tgemcountry f ON f.country_id = b.country
            WHERE a.emp_no = '$profile[emp_no]'");

            while($data_education = mysqli_fetch_assoc($sql_education)){
            ?>
            <tr>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_education['edu_type']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_education['edu_name']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_education['major']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_education['start_year']; ?> - <?php echo $data_education['end_year']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_education['city_name']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_education['country_name']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_education['gpa']; ?></p>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    <div>
        <?php 
        $sql_employee_information = mysqli_query($connect, "SELECT 
        a.employ_code,
        DATE_FORMAT(a.start_date, '%d %M %Y') AS start_date,
        b.jobtitle_name_en,
        a.pos_name_en,
        a.grade_code,
        a.parent_path,
        DATE_FORMAT(ADDDATE(a.birthdate, INTERVAL 55 YEAR), '%d %M %Y') as pre_pension,
        a.cost_code,
        DATE_FORMAT(a.start_date, '%d %M %Y') AS join_group,
        DATE_FORMAT(a.end_date, '%d %M %Y') AS pension_date,
        a.worklocation_code,
        a.grade_category,
        c.jobstatusname_en,
        a.spv_parent,
        case 
		    when a.employ_code = dtcontract.employmentstatus_code then DATE_FORMAT(dtcontract.enddate, '%d %M %Y') 
			else a.employ_code 
		end as end_contract_date,
        DATE_FORMAT(ADDDATE(a.birthdate, INTERVAL 56 YEAR), '%d %M %Y') as pension_date
        FROM view_employee a 
        LEFT JOIN teomjobtitle b ON b.jobtitle_code = a.jobtitle_code
        LEFT JOIN teomjobstatus c ON c.jobstatuscode = a.jobstatuscode
        LEFT JOIN 
        (
         select MAX(x.enddt) AS enddate, x.employmentstatus_code, x.emp_id from hrmemploymenthistory x where x.employmentstatus_code in ('CNTR','DAYC')
        )dtcontract ON dtcontract.emp_id = a.emp_id
        WHERE a.emp_no = '$profile[emp_no]'");

        $data_employee_information = mysqli_fetch_assoc($sql_employee_information);
        $in_position        = str_replace(",", "','", $data_employee_information['parent_path']);
        $final_inposition   = "'".$in_position."'";

        $sql_get_dept = mysqli_query($connect, "SELECT a.pos_name_en FROM hrmorgstruc a WHERE a.position_id IN ($final_inposition) AND a.org_level = 'DEP'");
        $data_dept = mysqli_fetch_assoc($sql_get_dept);
        ?>
        <table width="100%" border="1">
            <tr>
                <td colspan="2">
                    <p style="margin-bottom:0px; font-weight:bold">Employement Information</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <p style="margin-bottom:0px;">Current Status</p>
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <table width="100%">
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Employee Status</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['employ_code']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Start Date</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['start_date']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Job Title</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['jobtitle_name_en']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Position</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['pos_name_en']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Grade</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['grade_code']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Department</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_dept['pos_name_en']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Cost Center</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['cost_code']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Pre Pension Date</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['pre_pension']; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
                <td>
                    <table width="100%">
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Join Group</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['join_group']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">End Contract Date</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['end_contract_date']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Work Location</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['worklocation_code']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Grade Category</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['grade_category']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Job Status</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['jobstatusname_en']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Direct Supervisor</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['spv_parent']; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                &nbsp
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">  </p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px">  </p>
                            </td>
                        </tr>
                        <tr>
                            <td width="35%">
                                <p style="margin-bottom:0px">Pension Date</p>
                            </td>
                            <td width="2%">
                                <p style="margin-bottom:0px">:</p>
                            </td>
                            <td width="">
                                <p style="margin-bottom:0px"><?php echo $data_employee_information['pension_date']; ?></p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <table width="100%" border="1">
            <tr>
                <td colspan="6">
                    <p style="margin-bottom:0px; font-weight:bold">Career History</p>
                </td>
            </tr>
            <tr>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">History No</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Effective Date</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Position</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Organization Unit</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Employee Status</p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px; font-weight:bold">Career Transition</p>
                </td>
            </tr>
            <?php 
            $sql_career = mysqli_query($connect, "SELECT 
            a.history_no,
            DATE_FORMAT(a.effectivedt, '%d %M %Y') AS effective_date,
            b.pos_name_en,
            orgunit.pos_name_en AS orgunitname,
            c.employmentstatus_name_en,
            d.careertransition_name_en
            FROM hrmemploymenthistory a 
            LEFT JOIN hrmorgstruc b ON b.pos_code = a.position_code
            LEFT JOIN 
            (
            SELECT z.position_id, z.pos_name_en
            FROM hrmorgstruc z
            ) orgunit ON orgunit.position_id = b.parent_id
            LEFT JOIN teomemploymentstatus c ON c.employmentstatus_code = a.employmentstatus_code
            LEFT JOIN tcamcareertransition d ON d.careertransition_code = a.careertransition_code
            WHERE a.emp_no = '$profile[emp_no]'
            ORDER BY a.effectivedt ASC");

            while($data_career = mysqli_fetch_assoc($sql_career)){
            ?>
            <tr>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_career['history_no']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_career['effective_date']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_career['pos_name_en']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_career['orgunitname']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_career['employmentstatus_name_en']; ?></p>
                </td>
                <td width="">
                    <p style="margin-bottom:0px"><?php echo $data_career['careertransition_name_en']; ?></p>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <br>
    <?php } ?>
</div>
