<?php 
include "../../application/session/session.php";
$username = $_POST['id'];

$sql_profile = mysqli_query($connect, "SELECT 
a.Full_Name,
a.emp_no,
a.photo,
a.pos_name_en,
b.name_en AS martialstatus,
CASE
   when a.gender = '1' then 'Male'
   when a.gender = '0' then 'Famale'
END AS gender,
DATE_FORMAT(a.start_date, '%d %M %Y') AS join_date,
c.grade_name AS grade,
a.grade_code
FROM view_employee a 
LEFT JOIN teommarital b ON b.code = a.maritalstatus 
LEFT JOIN teomjobgrade c ON a.grade_code = c.grade_code
WHERE a.emp_no = '$username'");

$profile = mysqli_fetch_assoc($sql_profile);

?>
<table width="100%">
    <tr>
        <td style="width:25%">
            <table width="100%">
                <tr>
                    <td>
                        <img src="../../asset/emp_photos/<?php echo $profile['photo']; ?>" alt="" style="width:100px">
                    </td>
                </tr>
            </table>
        </td>
        <td valign="top">
            <table width="100%">
                <tr>
                    <td><p style="font-weight:bold; margin-left:5px; margin-bottom:0px"><?php echo $profile['Full_Name']; ?></p></td>
                </tr>
                <tr>
                    <td><p style="margin-left:5px; margin-bottom:0px"><?php echo $profile['emp_no']; ?> / (<?php echo $profile['gender'];?> - <?php echo $profile['martialstatus']; ?>)</p></td>
                </tr>
                <tr>
                    <td><p style="margin-left:5px; margin-bottom:0px"><?php echo $profile['pos_name_en']; ?></p></td>
                </tr>
                <tr>
                    <td><p style="margin-left:5px; margin-bottom:0px">Join : <?php echo $profile['join_date']; ?></p></td>
                </tr>
                <tr>
                    <td><p style="margin-left:5px; margin-bottom:0px">Grade : <?php echo $profile['grade']; ?></p></td>
                </tr>
                <tr>
                    <td><a href='#' style="margin-left:5px;" class='' id1="<?php echo $profile['emp_no']; ?>" data-toggle='modal' id='modal_view_profile' data-target='#modal-default'><img src='../../asset/img/icons/acticon-note.png'></a></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

