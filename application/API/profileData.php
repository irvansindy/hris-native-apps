<?php 
include('config2.php');

$con = mysqli_connect($server,$username,$password,$db);
if($con){
$userid=$_GET['userid'];
    $selectQuery="SELECT 
                    a.latitude,
                    a.longlatitude,
                    SUBSTRING(a.nama, 1, 1) AS initial,
                    a.username,
                    a.nama as name,
                    b.email,
                    b.phone as mobile,
                    a.password,
                    b.address,
                    b.photo as avatar,
                    CASE 
						  	WHEN LENGTH(b.pos_name_en) > 90 THEN CONCAT(SUBSTRING(b.pos_name_en,1,90), '...')
                    ELSE b.pos_name_en
                    END AS pos_name_en
                    FROM users a
                    
                    INNER JOIN view_employee b on a.username=b.emp_no
                    
                    WHERE a.username='$userid'" ;
                    
                    
	$result=$con->query($selectQuery);
	$response=array();
			if($result->num_rows>0)
			{
				
				while($row=$result->fetch_assoc())
				{
					array_push($response,$row);
				}
			}
            $con->close();
            header('Content-Type: application/json');
            echo json_encode($response);
	
}
else
{
    echo "database connection failed";
}

?>