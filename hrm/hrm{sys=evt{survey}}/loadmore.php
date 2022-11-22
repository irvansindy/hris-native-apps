<?php include "../../application/session/session.php";?>


<?php	
	// Include the database configuration file
       date_default_timezone_set('Asia/Bangkok');
       $date_now	= date('d-m-Y');

       if(isset($_POST['id'])){
              $id    = $_POST['id'];
       }else{
              $id    = '1';
       }

       if (!empty($_POST['empnip']) && !empty($_POST['empname'])) {
              $identitynip = $_POST['empnip'];
              $identityname = $_POST['empname'];
              $where = "WHERE (a.request_no like '$identitynip') AND (b.full_name like '%$identityname%') AND g.emp_no='$username'";
       } elseif (!empty($_POST['empnip']) && empty($_POST['empname'])) {
              $identitynip = $_POST['empnip'];
              $where = "WHERE (a.request_no like '$identitynip')";
       } elseif (!empty($_POST['empname'])) {
              $identityname = $_POST['empname'];
              $where = "WHERE (b.full_name like '%$identityname%')";
       } else {
              $where = "WHERE a.nip = '$_SESSION[username]' AND b.status = '1'";
       }


	if (isset($_POST["limit"], $_POST["start"])) {
		$page = $_POST["limit"];
		$limit = $_POST["start"];
	}else{
		$page = 0;
		$limit = 10;
	}

	$no = 0;

       $output = "";

       $output .= "<thead>";


       $output .= "<tr><th class='fontCustom' style='z-index: 1;'  nowrap='nowrap'>No.</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >ID Event</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >Title</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >Year</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >Start Period</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >End Period</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >PIC Division</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >PIC Departement</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >Status</th>";

       $output .= "<th class='fontCustom' style='z-index: 1;' >Survey</th></tr>";

       $output .= "<thead>";

       if($id == '1'){
              $sql   = mysqli_query($connect, "SELECT
              b.*,
              DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
              DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
              DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
              DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
              a.aksi,
              case
                     when 
                                            ((current_date() >= b.start_date)
                                             AND 
                                            (current_date() <= b.end_date))
                                      then 'YES'
                     ELSE 'NO'
              END AS status
              FROM hrmsurveyanggotaevent a
              LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
               
                       WHERE (a.nip = '$_SESSION[username]' AND a.aksi <> '1')
                       AND b.status = '1' 
                       
                       AND (current_date() <= b.end_date AND current_date() >= b.start_date)
                              
       
                            GROUP BY b.id_event                  
                       ORDER BY b.start_date asc
                       LIMIT $limit, $page

                       ");
       
       }elseif($id == '2'){
              $sql   = mysqli_query($connect, "SELECT
              b.*,
              DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
              DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
              DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
              DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
              a.aksi,
              case
                     when 
                                            (NOW() >= b.start_date)
                                             AND 
                                            (NOW() <= b.end_date) 
                                      then 'YES'
                     ELSE 'NO'
              END AS status
              FROM hrmsurveyanggotaevent a
              LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
               
                       WHERE a.nip = '$_SESSION[username]' 
                       AND (b.status = '1' AND NOW() <= b.start_date)

           GROUP BY b.id_event                  
                       ORDER BY tanggal_mulai asc 
                       LIMIT $limit, $page
");
       }elseif($id == '3'){
              $sql   = mysqli_query($connect, "(SELECT
              b.*,
              DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
              DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
              DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
              DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
              a.aksi,
              case
                     when 
                                            (NOW() >= b.start_date)
                                             AND 
                                            (NOW() <= b.end_date) 
                                      then 'YES'
                     ELSE 'NO'
              END AS status
              FROM hrmsurveyanggotaevent a
              LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
               
                       WHERE (a.nip = '$_SESSION[username]')
                       AND (b.status = '1' AND NOW() > b.end_date))
UNION
(SELECT
              b.*,
              DATE_FORMAT(b.start_date, '%d-%m-%Y') as mulai,
              DATE_FORMAT(b.end_date, '%d-%m-%Y') as selesai,
              DATE_FORMAT(b.start_date, '%d %b %Y') as tanggal_mulai,
              DATE_FORMAT(b.end_date, '%d %b %Y') as tanggal_selesai,
              a.aksi,
              case
                     when 
                                            (NOW() >= b.start_date)
                                             AND 
                                            (NOW() <= b.end_date) 
                                      then 'YES'
                     ELSE 'NO'
              END AS status
              FROM hrmsurveyanggotaevent a
              LEFT JOIN hrmsurveyevent b ON b.id_event = a.id_event
               
                       WHERE (a.nip = '$_SESSION[username]' AND a.aksi = '1' AND b.`status` = '1'))
                        
                       LIMIT $limit, $page

                       ");
       }


		
	

	$output .= "<tbody>";

	while ($row = mysqli_fetch_assoc($sql)) {

              // $activebadge = '';
              // if($row['name_en'] == "Draft") {
              //        $activebadge = "badge-draft";
              // } elseif($row['name_en'] == "Unverified") {
              //        $activebadge = "badge-Unverified";  
              // } elseif($row['name_en'] == "Partially Approved") {
              //        $activebadge = "badge-Partially-Approved"; 
              // } elseif($row['name_en'] == "Fully Approved") {
              //        $activebadge = "badge-Fully-Approved";
              // } elseif($row['name_en'] == "Revised") {
              //        $activebadge = "badge-Revised";
              // } elseif($row['name_en'] == "Rejected") {
              //        $activebadge = "badge-Rejected"; 
              // } elseif($row['name_en'] == "Cancelled") {
              //        $activebadge = "badge-Cancelled";                
              // } else {
              //        $activebadge = "badge-Closed";
              // }
       
    
    if($row['aksi'] == '0'){ 
       if($row['status'] == 'YES'){
              $button = "<a href='../hrm{sys=evt{evt}}?id={$row["id_event"]}&survey=1'><img src='../../asset/dist/img/icons/acticon-note.png' data-toggle='tooltip' title=''></a>";   
       }else{
              $button = "<a href='#'><img src='../../asset/dist/img/icons/acticon-note.png' data-toggle='tooltip' title=''></a>";   
       }
        $aksi   = 'New'; 
    }else{ 
        $aksi   = 'Done'; 
        $button = "<a href='../hrm{sys=evt{evt}}?id={$row["id_event"]}'><img src='../../asset/dist/img/icons/glasses.png' data-toggle='tooltip' title=''></a>";
    }
	$no++;
	$output.="<tr>
		
			<td class='fontCustom'>{$no}</td>		
			<td class='fontCustom'>{$row["id_event"]}</td>
                     <td class='fontCustom'>{$row["judul"]}</td>
			<td class='fontCustom'>{$row["tahun"]}</td>
			<td class='fontCustom'>{$row["tanggal_mulai"]}</td>
			<td class='fontCustom'>{$row["tanggal_selesai"]}</td>
                     <td class='fontCustom'>{$row["divisi"]}</td>
                     <td class='fontCustom'>{$row["dept"]}</td>
                     <td class='fontCustom'>{$aksi}</td>
			<td class='fontCustom'>
                     {$button}
			</td>
	     </tr>";
	}

	$output .= "</tbody>";
			
	$output .= "";
	echo $output;	  
	// }

?>



<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_edit.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_edit").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_edit.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_search").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_search.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>

<!-- Javascript untuk popup modal Edit-->
<script type="text/javascript">
$(document).ready(function() {
       $(".open_modal_appsetting").click(function(e) {
              var m = $(this).attr("id");
              $.ajax({
                     url: "modal_appsetting.php",
                     type: "POST",
                     data: {
                            id: m,
                     },
                     success: function(ajaxData) {
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal({
                                   backdrop: 'static',
                                   keyboard: 'false'
                            });
                     }
              });
       });
});
</script>


<script>
    $(".class_hapus").click(function () {
        var jawab = confirm("Hapus data?");
        if (jawab === true) {

//            kita set hapus false untuk mencegah duplicate request
            var hapus = false;

            if (!hapus) {

                hapus = true;
       
                $.post('controller/aksi_hapus.php', {id: $(this).attr('id')},

                function (data) {  
                    alert("Berhasil hapus data");
                    window.location = '/';
                    window.location.reload();
                    window.refresh();
                });

            }

        } else {

            return false;

        }

    });
</script>




