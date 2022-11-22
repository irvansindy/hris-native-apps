<link rel="stylesheet" href="../../asset/gt_developer/developer_hris_form.css" />
<table class="table table-bordered table-hover table-head-fixed">
       <style>
              .imagine {
                     border: 1px solid #ddd;
                     border-radius: 4px;
                     padding: 5px;
                     width: 150px;
              }
       </style>
       <tbody>
              <?php
              include "../../../application/config.php";
              $no;
              $rfid = $_GET['rfid'];
              $sql_approval = mysqli_query($connect, "SELECT
                                                               CASE 
                                                                      WHEN a.file_type IN ('xls','xlsx','csv') THEN 'excel.png'
                                                                      WHEN a.file_type IN ('pdf') THEN 'pdf.png'
                                                                      ELSE a.file_name
                                                                      END AS `file_name`,
                                                               a.original_filenames,
                                                               DATE_FORMAT(a.created_date, '%d %b %Y %H:%i:%s') as created_date,
                                                               b.emp_no,
                                                               b.Full_Name
                                                        FROM 
                                                        hrmattachment a 
                                                        LEFT JOIN view_employee b on a.created_by = b.emp_no
                                                        WHERE a.request_no = '$rfid'
                                                        ORDER BY created_date DESC");
              while ($r = mysqli_fetch_array($sql_approval)) {
                     $no++;
                     $data = '<img class="imagine" src="../../asset/request.file.attachment/' . $r['file_name'] . '" > <a type="button" nowrap="nowrap" data-toggle="modal" data-target="#UpdateForm" data-backdrop="static" style="color: orange; border: 5px; cursor:pointer;font-weight: bold;font-size: 13px;" onclick="editMember(`' . $r['file_name'] . '`)">' . $r['created_date'] . ' <br>| ['.$r['emp_no'].'] '.$r['Full_Name'].'</a>  <br> <label style="padding-top: 4px;color: #A5B0B7 !important;">' . $r['original_filenames'] . ' </label>';
              ?>
                     <tr>
                            <td><?php echo $data; ?></td>
                     </tr>
              <?php  } ?>
</table>