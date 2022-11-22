<?php 
include "../../../application/session/session_ess.php";
$username = $_POST['id'];

$sql_contact = mysqli_query($connect, "SELECT 
b.contact_name,
c.relationship_name_en,
b.phone,
b.address
FROM view_employee a
LEFT JOIN mgtools_teodempemergency b ON b.emp_id = a.emp_id
LEFT JOIN teomfamilyrelation c ON b.relationship_code = c.relationship_code
WHERE a.emp_no = '$username'");


?>
<fieldset id="fset_1">
<legend>Emergency Contact</legend>  
<div class="form-row" style="padding-bottom:0px">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Contact Name</th>
      <th scope="col" style="padding-left:0">Relation</th>
      <th scope="col">Contact Number</th>
      <th scope="col">Address</th>
    </tr>
  </thead>
  <tbody>
    <?php 
       $no = 1;
       while($data = mysqli_fetch_assoc($sql_contact)){
    ?>
    <tr>
      <th scope="row"><?php echo $data['contact_name']; ?></th>
      <td style="padding-left:0"><?php echo $data['relationship_name_en']; ?></td>
      <td><?php echo $data['phone']; ?></td>
      <td><?php echo $data['address']; ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table>
</div>
</fieldset>