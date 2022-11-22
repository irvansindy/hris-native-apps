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
?>

<?php
if (isset($_POST['submit'])) {
?>
<div class='panel panel-default'>	
			<div class='panel-body'>     
      <fieldset class='col-md-12'>
<p style="font-size: 15px;font-weight: bold;">Trafic import data :</p>
<div id="progress" style="width:100%;border:1px solid rgba(102,102,102,1); text-shadow: 4px 4px 4px #666666;"></div>
<div id="info" style="margin-top: 16px;font-size: 13px;"></div>
<?php
}
?>
<script type="text/javascript">
    function validateForm()
    {
        function hasExtension(inputID, exts) {
            var fileName = document.getElementById(inputID).value;
            return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(fileName);
        }
        if(!hasExtension('filepegawaiall', ['.xls'])){
            alert("Hanya file XLS (Excel 2003) yang diijinkan.");
            return false;
        }
    }
</script>

<table border="1">
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
	  
      	$DataRows1          	 = $data->val($i, 1);
      	$DataRows2            = $data->val($i, 2);
      	$DataRows3            = $data->val($i, 3);
      	$DataRows4            = $data->val($i, 4);
      	$DataRows5            = $data->val($i, 5);
	$DataRows6            = $data->val($i, 6);

	$ColumnHead1     	= 'emp_no';
	$ColumnHead2     	= 'request_type';
	$ColumnHead3     	= 'empno_appvr1';
	$ColumnHead4     	= 'empno_appvr2';
	$ColumnHead5    	= 'empno_appvr3';
	$ColumnHead6    	= 'pa_requester';
	  
	$TemplateHead1     	= 'Employee No';
	$TemplateHead2     	= 'Request type';
	$TemplateHead3     	= 'Approver 1';
	$TemplateHead4     	= 'Approver 2';
	$TemplateHead5    	= 'Approver 3';
	$TemplateHead6    	= 'Performance Requester';

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
	
	
	

        $barisreal = $baris-1;
        $k = $i-1;

	if ($TemplateHead1 != $ExcelHead1 || $TemplateHead2 != $ExcelHead2 || $TemplateHead3 != $ExcelHead3 || $TemplateHead4 != $ExcelHead4 || $TemplateHead5 != $ExcelHead5 || $TemplateHead6 != $ExcelHead6){
		echo "<tr><td>".$k." . Invalid Header"."</td></tr>";
	}

        $percent = intval($k/$barisreal * 100)."%";

       echo '<script language="javascript">
			document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.'; background: linear-gradient(229deg, #b9b9b980, #8c8b88);\">&nbsp;</div>";
			document.getElementById("info").innerHTML="'.$k.' Record successfully upload ('.$percent.' Finish).";
		</script>';

	$query = "INSERT INTO `tclcdreqappsetting` (`emp_no`, `request_type`, `empno_appvr1`, `empno_appvr2`,`empno_appvr3`) VALUES ('123', 'Attendance.leave', '123', '123' , '123')";
	
	if (
		empty($DataRows1) or 
		empty($DataRows2))
	{

      	$query_delete = "TRUNCATE tclcdreqappsetting_failed"; $delete = mysqli_query($connect, $query_delete);
	
	$query = "INSERT INTO tclcdreqappsetting_failed (
				$DatabasesHead1,
				$DatabasesHead2,
				$DatabasesHead3,
				$DatabasesHead4,
				$DatabasesHead5)values(
					'$DataRows1',
					'$DataRows2',
					'$DataRows3',
					'$DataRows4',
					'$DataRows5')";

		if($DataRows2 == 'Performance') {
			$query1 = "INSERT INTO `tclcdreqPMappsetting` (
						`emp_no`, 
						`request_type`, 
						`employee`
						) VALUES (
							'$DataRows6', 
							'$DataRows2', 
							'$DataRows1')";
			$hasil1 = mysqli_query($connect, $query1);
		}
		
	} else {
	
		$query = "INSERT INTO tclcdreqappsetting (
				$DatabasesHead1,
				$DatabasesHead2,
				$DatabasesHead3,
				$DatabasesHead4,
				$DatabasesHead5,
				_timestamp,
				created_by
				) VALUES (
					'$DataRows1',
					'$DataRows2',
					'$DataRows3',
					'$DataRows4',
					'$DataRows5',
					'$SFdatetime',
					'$username') 

				ON DUPLICATE KEY UPDATE
				
				$DatabasesHead3 = '$DataRows3',
				$DatabasesHead4 = '$DataRows4',
				$DatabasesHead5 = '$DataRows5',
				_timestamp	  = '$SFdatetime',
				created_by	  = '$username'";

		if($DataRows2 == 'Performance') {
			$query1 = "INSERT INTO `tclcdreqPMappsetting` (
						`emp_no`, 
						`request_type`, 
						`employee`
						) VALUES (
							'$DataRows6', 
							'$DataRows2', 
							'$DataRows1')
							
						ON DUPLICATE KEY UPDATE
						`emp_no` = '$DataRows6'";

			$hasil1 = mysqli_query($connect, $query1);
		}
	
	}
	
	$hasil = mysqli_query($connect, $query);

	if($hasil) {
		ECHO "";
	} else {
		ECHO "<tr><td>Some data failed process !!"."</td></tr>";
	}

	flush();
    }

    unlink($_FILES['filepegawaiall']['name']);
}
}

?>


</table>