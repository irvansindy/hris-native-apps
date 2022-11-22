<?php include "../../../application/session/session.php";?>
<?php
    include "../../../application/config.php";
    $data1 = $_POST['data1'];
    $data2 = $_POST['data2'];
    $sel_parameter = strtoupper($_POST['sel_parameter']);

    echo $data1 . "<br>";
    echo $data2 . "<br>";
    
       for($iemg=0;$iemg<count($_POST['sel_parameter']);$iemg++){
		$iemg_plus = $iemg+1;
		$sel_parameters	= $_POST['sel_parameter'][$iemg];
		
		if($sel_parameter!==''){
		       $data = $sel_parameters . "<br>";
		}
	}
?>