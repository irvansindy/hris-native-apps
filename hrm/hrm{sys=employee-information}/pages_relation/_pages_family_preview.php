<?php
include "../../../application/config.php";
$rfid = $_GET['rfid'];
$SFnumbercon = $_GET['SFnumbercon'];


$modal = mysqli_query($connect, "SELECT * FROM mgtools_teodempfamily a
              LEFT JOIN hrmfamilyrelation b ON b.relationship_code=a.relationship 
       WHERE emp_id = '$rfid' AND a.request_no = '$SFnumbercon'");



while ($row = mysqli_fetch_array($modal)) {



       ?>
       <tr>
              <td><br>
                     <img src="../../asset/dist/img/icons/acticon-remove.png"
                            style="width: 17px;margin-top: -10px;cursor: pointer;" alt="user" data-toggle="modal"
                            data-target="#FormDisplayDelete" onclick="FamilyDeleteForm(`<?php echo $row['empfamily_id'] ?>`)"
                            data-backdrop="static" class="profile-pic rounded-circle" style="width: 17px;margin-top: -10px;">
                     <img src="../../asset/emp_photos/13-0299.jpeg" alt="user" class="profile-pic rounded-circle" width="30">
                     <a type="button" nowrap="nowrap" data-toggle="modal" data-target="#FamilyForm" data-backdrop="static"
                            style="color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;"
                            onclick="FamilyForm(`<?php echo $row['empfamily_id'] ?>`)"><?php echo $row['name'] ?></a> <br>
                     <label style="padding-top: 4px;color: #A5B0B7 !important;">
                            <?php echo $row['relationship_name_en'] ?>
                     </label>
                     <br>
              </td>
       </tr>
<?php } ?>