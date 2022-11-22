<?php 
include "../../../application/session/session_ess.php";
$username = $_POST['id'];

$sql_education = mysqli_query($connect, "SELECT 
b.edu_type,
c.edu_name,
d.city_name,
e.name_en,
b.start_year,
b.end_year,
b.gpa
FROM view_employee a
LEFT JOIN mgtools_teodempeducation b ON b.emp_id = a.emp_id
LEFT JOIN teomeduinstitution c ON c.edu_code = b.edu_name
LEFT JOIN tgemcity d ON d.city_id = b.city
LEFT JOIN TEOMFACULTY e ON e.code = b.faculty
WHERE a.emp_no = '$username'");


?>
<fieldset id="fset_1">
<legend>Education Information</legend>  
<div class="form-row" style="padding-bottom:0px">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Education</th>
      <th scope="col">School</th>
      <th scope="col">City</th>
      <th scope="col">Faculty</th>
      <th scope="col">Start Years</th>
      <th scope="col">End Years</th>
      <th scope="col">IPK</th>
    </tr>
  </thead>
  <tbody>
    <?php 
       $no = 1;
       while($data = mysqli_fetch_assoc($sql_education)){
    ?>
    <tr>
      <th scope="row"><?php echo $data['edu_type']; ?></th>
      <td ><?php echo $data['edu_name']; ?></td>
      <td><?php echo $data['city_name']; ?></td>
      <td><?php echo $data['name_en']; ?></td>
      <td><?php echo $data['start_year']; ?></td>
      <td><?php echo $data['end_year']; ?></td>
      <td><?php echo $data['gpa']; ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table>
</div>
</fieldset>