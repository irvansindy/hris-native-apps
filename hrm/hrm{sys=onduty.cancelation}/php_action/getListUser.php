<?php
    // error_reporting(0);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../application/config.php';

    $datetime = date('Y-m-d h:i:s');
    $date = date('Y-m-d');
    $year = date('Y');
    $dateprint = date('d M Y');
    $time = date('h:i:s');
    $request = date('Ydhis');

    if(!empty($_POST['value'])) {
        $response = '';

        $emp = $_POST['emp'];
        $value = $_POST['value'];

        $queryUser = "SELECT 
		a.emp_no, 
		a.Full_Name,
		a.pos_name_en,
		a.photo
			FROM view_employee a 
			WHERE 
			(a.emp_no LIKE '$value%' OR a.Full_Name LIKE '$value%')
		GROUP BY a.emp_no
		ORDER BY a.emp_no DESC
		LIMIT 10";

        $resultsUser = mysqli_query($connect, $queryUser);
        // echo $count = mysqli_num_rows($resultsUser);
        // die();
        $response = '<ul class="list-unstyled job_title_ul">';
        if (mysqli_num_rows($resultsUser) > 0) {
            while ($data = mysqli_fetch_array($resultsUser)) {
                $response .= '<li class="job_title_li" id="job_title_li" onclick="myFunction'.$data["emp_no"].'()"><img width="30px" src="../../asset/emp_photos/'.$data["photo"].'" alt="Employee">'.$data["position_name_en"].' '.$data["emp_no"].' [ '.$data["Full_Name"].' ] <br><label style="font-size: 8px;color: #646464;">'.$data["pos_name_en"].'</label></li>';

                echo '<script>
				function myFunction'.$data["emp_no"].'() {
					$("'.$data["functions_contra"].'").hide();
					$("'.$data["functions"].'").show();
					$("#box_sp_up").hide();
					$("#box_sp_up_down").hide();
					$("#inp_formtype").val("'.$data["functions_type"].'");
				}
				</script>';
            }
        } else {
            $response .= '<li class="job_title_li">Tidak ada data</li>';
        }
        $response .= '</ul>';

        echo $response;
    }
?>