<?php 
include "../../application/config.php";

       if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sqlProsedur = "UPDATE hrmprosedur SET status = 'Tidak Aktif', modified_date = NOW() WHERE prosedur_code = '$id'";
            mysqli_query($connect, $sqlProsedur);
          ?>
               <script>
               document.location="index.php";
               </script>';
          <?php
               }
          ?>