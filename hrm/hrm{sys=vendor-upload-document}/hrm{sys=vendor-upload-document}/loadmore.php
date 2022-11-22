
<?php include "../../application/session/session.php";?>
<?php include "../../model/proc-doc/GMDocSearchGen.php";?>
<?php include "../../model/proc-doc/GMDocList.php";?>
<?php	

	$sql = $qListRender;
       $no = 1;

	$query = sqlsrv_query($conn,$sql);

	if ($query) {

       
	$output = "";

	$output .= "<tbody>";

	while ($row = sqlsrv_fetch_array($query,SQLSRV_FETCH_ASSOC)) {
       
       $action = "
       <a href='../../asset/list_document/$row[singkat_file].$row[tipe_file]'>
             
              <button type='submit' id='submit_add' name='submitregister' value='submitregister'
              class='btn btn-success inputDisabled'>Download</button>
       </a>";
       


       $nos = $no++;
   
	$output.="<tr>		
                            <td class='fontCustom'><small>{$nos}</small></td>    
                            <td class='fontCustom'><small>{$row['nama_file']}</small></td>    
                            <td class='fontCustom'><small>{$row['singkat_file']}</small></td>  
                            <td class='fontCustom'><small>{$row['tipe_file']}</small></td>     
                            <td class='fontCustom'><small>{$action}</small></td>                                             
			</tr>";		 
	}

	$output .= "<tbody>";

	$output .= "";

	echo $output;	  

}

?>


