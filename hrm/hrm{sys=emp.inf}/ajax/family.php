<?php 
include "../../../application/session/session_ess.php";
$username = $_POST['id'];

$sql_family = mysqli_query($connect, "SELECT 
c.relationship_name_en,
b.name,
DATE_FORMAT(b.birthdate, '%d %M %Y') AS tanggal_lahir,
CASE 
   when b.alive_status = '1' then 'HIDUP'
   when b.alive_status = '0' then 'MENINGGAL'
END AS alaive_status
FROM view_employee a
LEFT JOIN mgtools_teodempfamily b ON b.emp_id = a.emp_id
LEFT JOIN teomfamilyrelation c ON c.relationship_code = b.relationship
WHERE a.emp_no = '$username'");
?>

<fieldset id="fset_1">
<legend>Family Depent</legend>  
<div class="form-row" style="padding-bottom:0px">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Family Member</th>
      <th scope="col" style="padding-left:0">Full Name</th>
      <th scope="col">Birth Date</th>
      <th scope="col">Alive Status</th>
    </tr>
  </thead>
  <tbody>
    <?php 
       $no = 1;
       while($data = mysqli_fetch_assoc($sql_family)){
    ?>
    <tr>
      <th scope="row"><?php echo $data['relationship_name_en']; ?></th>
      <td style="padding-left:0"><?php echo $data['name']; ?></td>
      <td><?php echo $data['tanggal_lahir']; ?></td>
      <td><?php echo $data['alaive_status']; ?></td>
    </tr>
    <?php $no++; } ?>
  </tbody>
</table>
</div>
</fieldset>