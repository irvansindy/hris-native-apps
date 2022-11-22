
<?php				
			
			if (isset($_POST["limit"], $_POST["start"])) {
				$page = $_POST["limit"];
				$limit = $_POST["start"];
			}else{
				$page = 0;
				$limit = 10;
			}

	?>
<?php 
$qListRender = "SELECT 
                a.*
                FROM hrmnews a
                ORDER BY a.id desc
                LIMIT $limit, $page";

$qListRenderAll = "SELECT 
                a.*
                FROM berita a
				$WHERES
                ORDER BY a.id_berita desc";
?>  