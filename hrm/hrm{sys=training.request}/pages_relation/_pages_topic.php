<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<style>
       .soya {
  border-collapse: collapse;
  border-radius: 1em;
  overflow: hidden;
}

.soyas {
  padding: 1em;
  background: #ddd;
}

</style>
<table class="table table-hover table-head-fixed soya">
       <thead>
              <tr>
                     <th class="soyas" style="background: #976456;color: white;"></th>
                     <th class="soyas" style="background: #976456;color: white;">Training Category</th>
                     <th class="soyas" style="background: #976456;color: white;">Course Name</th>
                     <th class="soyas" style="background: #976456;color: white;">Provider</th>
              </tr>
       </thead>
       <tbody>
       <?php
       include "../../../application/config.php";
       $no; 
	$rfid = $_GET['rfid'];
       $sfid = $_GET['sfid'];
	//$modal_id = '1';
       $sql_approval = mysqli_query($connect, "SELECT *,
                                                 CASE  
                                                        WHEN a.id_course='$sfid' THEN 'checked'
                                                        ELSE ''
                                                 END AS chek
                                                 FROM trncourse a
                                                        LEFT JOIN trnprovider b ON a.provider=b.provider_code
                                                        INNER JOIN trnmcategory c ON c.parent_code=a.course_code
                                                        WHERE a.course_code LIKE '%$rfid%'");
                            
      	while($r=mysqli_fetch_array($sql_approval)){

       $no++;
?>

              <tr>
                     <td class="soyas" ><input type="radio" id="course" name="inp_course" value="<?php echo $r['id_course']; ?>" <?php echo $r['chek']; ?>></td>
                     <td class="soyas" ><?php echo $r['course_name']; ?></td>
                     <td class="soyas" ><?php echo $r['course_desc']; ?></td>
                     <td class="soyas" ><?php echo $r['providername']; ?></td>
              </tr>


              <?php  } ?>
</table>