
<?php 
include('config2.php');

$con = mysqli_connect($server,$username,$password,$db);
if($con)
{
	$selectQuery="SELECT 
	                    DATE_FORMAT(tanggal, '%d %b %Y') as tanggal,
                    	id_berita AS `id`,
                    	judul AS `name`,
                    	CASE 
                    		WHEN gambar = '' THEN 'bos_amazone.jpg'
                    	ELSE gambar 
                    	END AS imagepath,
                        CASE 
                    		WHEN gambar = '' THEN 'bos_amazone.jpg'
                    	ELSE gambar 
                    	END AS category,
                    	jam as price,
                    	isi_berita as discount
                    FROM berita
                    WHERE 
                         
                        status = 'Y'
                    ORDER BY id_berita DESC
                    LIMIT 100" ;
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
            
            $msg = "ada kali";
      
            header('Content-Type: application/json');
            echo json_encode($response);
            
}
else
{
	echo "connection failed";
}


?>