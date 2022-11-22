<style>
body {
       font-family: Arial;
       margin: 0;
}

.header {
       padding-top: 5px;
       padding-bottom: 5px;
       text-align: center;
       background: #3d8ad9;
       font-weight: 200px;
       color: white;
       height: 25px;
       border-bottom: 3px solid #FFF;
}
</style>

<body>
       <div class="header">
              <img src="../../../asset/dist/img/corporate_upload.png" width="120" />
       </div>
</body>

<?php require_once '../../../application/config.php'; ?>
<?php require_once '../../../application/session/session.php'; ?>
<?php
date_default_timezone_set('Asia/Bangkok');

$SFyear              = date("Y");
$SFdate              = date("Y-m-d");
$SFtime              = date('h:i:s');
$SFdatetime          = date("Y-m-d H:i:s");
$SFnumber            = date("Ymdhis");
$var_find            = array('-', '');
$var_replace         = array('', '');


?>

<?php
if (isset($_POST['submit'])) {
?>
<div class='panel panel-default'>
       <div class='panel-body'>
              <fieldset class='col-md-12'>
                     <p style="font-size: 15px;font-weight: bold;">Trafic import data :</p>
                     <div id="progress"
                            style="width:100%;border:1px solid rgba(102,102,102,1); text-shadow: 4px 4px 4px #666666;">
                     </div>
                     <div id="info" style="margin-top: 16px;font-size: 13px;"></div>
                     <?php
}
?>

<br>
<table border="1" cellspacing="0" style="border-collapse:collapse; border:0.5pt solid grey; width:100%;">
	<tbody>
		<tr>
			<td style="background-color:#45b7c6; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">No.</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Employee No</span></strong></span></span></td>
			<td style="background-color:#45b7c6; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Employee Name</span></strong></span></span></td>
			<td style="background-color:#afafaf; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Performance Result Index</span></strong></span></span></td>
			<td style="background-color:#afafaf; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Permormance Grade</span></strong></span></span></td>
			<td style="background-color:#afafaf; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Performance Result Index Adjustment</span></strong></span></span></td>
			<td style="background-color:#afafaf; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Performance Grade Adjustment</span></strong></span></span></td>
			<td style="background-color:#afafaf; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Remark</span></strong></span></span></td>
			<td style="background-color:#afafaf; border-color:grey; height:15.0pt; text-align:center; vertical-align:middle; white-space:nowrap;"><span style="font-size:10pt"><span style="color:white"><strong><span style="font-family:Calibri,sans-serif">Flag</span></strong></span></span></td>
		</tr>
	</tbody>




<?php
require_once '../../../application/config.php';
require '../../../asset/gt_excel/excel_reader.php';

if(isset($_POST['submit'])){

	 	$target = basename($_FILES['filepegawaiall']['name']) ;
		move_uploaded_file($_FILES['filepegawaiall']['tmp_name'], $target);
		$data = new Spreadsheet_Excel_Reader($_FILES['filepegawaiall']['name'],false);

		$baris = $data->rowcount($sheet_index=0);

		for ($i=1; $i<=$baris; $i) {
			$ExcelHead1            = $data->val($i, 1);
			$ExcelHead2            = $data->val($i, 2);
			$ExcelHead3            = $data->val($i, 3);
			$ExcelHead4            = $data->val($i, 4);
			$ExcelHead5            = $data->val($i, 5);
			$ExcelHead6            = $data->val($i, 6);

		for ($i=2; $i<=$baris; $i++) {

			$find_replace         = array('.', ',');
			$new_replace          = array('.', '.');
			
			$DataRows1          	= $data->val($i, 1);
			$DataRows2          	= strtoupper($data->val($i, 2));
			// $DataRows2           = date('Y-m-d', strtotime($data->val($i, 2)));
			$DataRows3           = str_replace($find_replace, $new_replace, $data->val($i, 3));
			$DataRows4           = $data->val($i, 4);
			$DataRows5           = $data->val($i, 5);
			$DataRows6           = $data->val($i, 6);

			$ColumnHead1     	= 'request_for';
			$ColumnHead2     	= 'request_name';
			$ColumnHead3     	= 'pa_result';
			$ColumnHead4     	= 'pa_grade';
			$ColumnHead5     	= 'pa_result_adjust';
			$ColumnHead6     	= 'pa_grade_adjust';
			
			$TemplateHead1     	= 'Employee No';
			$TemplateHead2     	= 'Employee Name';
			$TemplateHead3     	= 'Performance Result Index';
			$TemplateHead4     	= 'Permormance Grade';
			$TemplateHead5     	= 'Performance Result Index Adjustment';
			$TemplateHead6     	= 'Performance Grade Adjustment';

			$period		= mysqli_fetch_array(mysqli_query($connect, "SELECT YEAR(period_start) AS tahun, period_id FROM hrmperf_set_period ORDER BY period_id DESC LIMIT 1"));

			if ($TemplateHead1 != $ExcelHead1){
				$DatabasesHead1 = 'unidentified';
			} else {
				$DatabasesHead1 = $ColumnHead1;
			}
				if ($TemplateHead2 != $ExcelHead2){
					$DatabasesHead2 = 'unidentified';
				} else {
					$DatabasesHead2 = $ColumnHead2;
				}
					if ($TemplateHead3 != $ExcelHead3){
						$DatabasesHead3 = 'unidentified';
					} else {
						$DatabasesHead3 = $ColumnHead3;
					}		  
						if ($TemplateHead4 != $ExcelHead4){
							$DatabasesHead4 = 'unidentified';
						} else {
							$DatabasesHead4 = $ColumnHead4;
						}
							if ($TemplateHead5 != $ExcelHead5){
								$DatabasesHead5 = 'unidentified';
							} else {
								$DatabasesHead5 = $ColumnHead5;
							}
								if ($TemplateHead6 != $ExcelHead6){
									$DatabasesHead6 = 'unidentified';
								} else {
									$DatabasesHead6 = $ColumnHead6;
								}
							
			$get_employee		= mysqli_query($connect, "SELECT * FROM view_employee WHERE emp_no = '$DataRows1' AND Full_Name = '$DataRows2' and (end_date IS NULL OR end_date = '0000-00-00 00:00:00')");
			$SFnumbercon         = 'PAREQ'.$period['tahun'].'-'.$DataRows1;
			$get_prev_upload	= mysqli_query($connect, "SELECT * FROM hrmperf_finalresult WHERE ipp_reqno = '$SFnumbercon'");

			$get_access		= mysqli_query($connect, "SELECT * FROM hrdperf_set_period WHERE emp_no = '$DataRows1'");

			$data2  = strtoupper($DataRows2);

			$barisreal = $baris-1;
			$k = $i-1;

			if ($TemplateHead1 != $ExcelHead1 || $TemplateHead2 != $ExcelHead2 || $TemplateHead3 != $ExcelHead3 || $TemplateHead4 != $ExcelHead4 || $TemplateHead5 != $ExcelHead5 || $TemplateHead6 != $ExcelHead6){
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;' colspan='8'>".$k." . Invalid Header"."</td>
					</tr>";
			} else if ($DataRows1 == '') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;'>Please fill empty column</td>
						<td style='padding: 5px;border: 1px solid grey;'>Data can't process</td>
					</tr>";
			} else if ($DataRows2 == '') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;'>Please fill empty column</td>
						<td style='padding: 5px;border: 1px solid grey;'>Data can't process</td>
					</tr>";
			} else if ($DataRows3 == '') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;'>Please fill empty column</td>
						<td style='padding: 5px;border: 1px solid grey;'>Data can't process</td>
					</tr>";
			} else if ($DataRows4 == '') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;'>Please fill empty column</td>
						<td style='padding: 5px;border: 1px solid grey;'>Data can't process</td>
					</tr>";
			} else if ($DataRows5 == '') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;'>Please fill empty column</td>
						<td style='padding: 5px;border: 1px solid grey;'>Data can't process</td>
					</tr>";
				} else if ($DataRows6 == '') {
					echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
							<td style='padding: 5px;border: 1px solid grey;'>$k</td>
							<td style='padding: 5px;border: 1px solid grey;'>$DataRows1</td>
							<td style='padding: 5px;border: 1px solid grey;'>$DataRows2</td>
							<td style='padding: 5px;border: 1px solid grey;'>$DataRows3</td>
							<td style='padding: 5px;border: 1px solid grey;'>$DataRows4</td>
							<td style='padding: 5px;border: 1px solid grey;'>$DataRows5</td>
							<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows6</td>
							<td style='padding: 5px;border: 1px solid grey;'>Please fill empty column</td>
							<td style='padding: 5px;border: 1px solid grey;'>Data can't process</td>
						</tr>";
			}  else if (mysqli_num_rows($get_employee) == '0') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>Employee not found please make sure employee no and employee name match</td>
						<td style='padding: 5px;border: 1px solid grey;background: red;color: whitesmoke;'>Data can't process</td>
					</tr>";
			}  else if (mysqli_num_rows($get_access) != '0') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>Employee must create performance plan please contact OD Department for more information</td>
						<td style='padding: 5px;border: 1px solid grey;background: #f7e70a;color: #685252;'>Data can't process</td>
					</tr>";
			}  else if (mysqli_num_rows($get_prev_upload) != '0') {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;'>Data updated, employee have previous result please check $SFnumbercon</td>
						<td style='padding: 5px;border: 1px solid grey;'>Update</td>
					</tr>";
				
				$query = "UPDATE hrmperf_finalresult SET
									$DatabasesHead3 = '$DataRows3',
									$DatabasesHead4 = '$DataRows4',
									$DatabasesHead5 = '$DataRows5',
									$DatabasesHead6 = '$DataRows6',
									modified_date = '$SFdatetime',
									modified_by = '$username',
									status = 'update'
						WHERE ipp_reqno = '$SFnumbercon'";
				
				$hasil 	= mysqli_query($connect, $query);
			} else {
				echo "<tr style='font-size: 11px;font-family: arial;color: #222;'>
						<td style='padding: 5px;border: 1px solid grey;'>$k</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows1</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows2</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows3</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows4</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows5</td>
						<td style='padding: 5px;border: 1px solid grey;'>$DataRows6</td>
						<td style='padding: 5px;border: 1px solid grey;'></td>
						<td style='padding: 5px;border: 1px solid grey;'>Insert</td>
					</tr>";
				
				$query = "INSERT INTO hrmperf_finalresult
								(
									ipp_reqno,
									$DatabasesHead1,
									ip_period,
									$DatabasesHead3,
									$DatabasesHead4,
									$DatabasesHead5,
									$DatabasesHead6,
									created_date,
									created_by,
									modified_date,
									modified_by,
									status
								)
									VALUES
										(
											'$SFnumbercon',
											'$DataRows1',
											'$period[period_id]',
											'$DataRows3',
											'$DataRows4',
											'$DataRows5',
											'$DataRows6',
											'$SFdatetime',
											'$username',
											'$SFdatetime',
											'$username',
											'insert'
										)";
				
				$hasil 	= mysqli_query($connect, $query);
			}

			$percent = intval($k/$barisreal * 100)."%";

			echo '<script language="javascript">
						document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.'; background: linear-gradient(229deg, #b9b9b980, #8c8b88);\">&nbsp;</div>";
						document.getElementById("info").innerHTML="'.$k.' Record successfully upload ('.$percent.' Finish).";
					</script>';			
			}
		unlink($_FILES['filepegawaiall']['name']);
		}
	}
?>
</table>