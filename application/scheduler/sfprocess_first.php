<?php
include "../config.php";
     
		$vars=mysqli_query($connect, "
		SELECT * FROM tclcreqappsetting
            ");
            $truncate=mysqli_query($connect, "TRUNCATE tclcreqappsetting_final_fantasy");
		while($rs=mysqli_fetch_array($vars)){

                  $tseq= $rs['seq_id'];
                  $twork= $rs['request_approval_name'];
                  $text= $rs['request_approval_formula'];
                        
                  echo "WORKFLOW Approval = '$text'";
                        $find_replace       		= array("'", "POS_");
                        $new_replace        		= array('', '');
                        $workflow= str_replace($find_replace, $new_replace, explode("+", $text));
                              echo "<pre>";
                        print_r($workflow);
                              echo "</pre>";
                        foreach ($workflow as $key => $data) {
                              echo "$key. $data<br/>";
                              $varpo=mysqli_query($connect, "INSERT INTO tclcreqappsetting_final_fantasy (
                              ordering,
                              seq_id,
                              request_approval_name,
                              request_approval_formula) 
                                          values (
                                                '$key',
                                                '$tseq',
                                                '$twork',
                                                '$data')");
                  }
            }
?>