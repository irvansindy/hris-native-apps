<?php
include "../config.php";
     
		$vars=mysqli_query($connect, "
		SELECT 
            *,
            CASE 
                  WHEN request_approval_formula LIKE '%**%' THEN 'Sequence'
                  WHEN request_approval_formula LIKE '%*%' THEN 'Required'
                  ELSE 'Notification'
            END AS app
            FROM tclcreqappsetting_final_fantasy
            ");
            $truncate=mysqli_query($connect, "TRUNCATE tclcreqappsetting_final_fantasy_final");
		while($rs=mysqli_fetch_array($vars)){

                  $torder     = $rs['ordering'];
                  $tseq       = $rs['seq_id'];
                  $twork      = $rs['request_approval_name'];
                  $text       = $rs['request_approval_formula'];
                  $app        = $rs['app'];
                        
                  echo "WORKFLOW Approval = '$text'";
                        $find_replace       		= array("'", "POS_", "/");
                        $new_replace        		= array('', '', '');
                        $workflow= str_replace($find_replace, $new_replace, explode("/", $text));
                              echo "<pre>";
                        print_r($workflow);
                              echo "</pre>";
                        foreach ($workflow as $key => $data) {
                              echo "$key. $data<br/>";
                              $varpo=mysqli_query($connect, "INSERT INTO tclcreqappsetting_final_fantasy_final (
                              ordering,
                              squence_approval,
                              seq_id,
                              request_approval_name,
                              request_approval_formula,
                              req)
                                          values (
                                                '$key',
                                                '$torder',
                                                '$tseq',
                                                '$twork',
                                                '$data',
                                                '$app')");
                  }
            }
?>