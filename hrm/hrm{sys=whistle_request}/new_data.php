<?php 
include "../../application/session/session.php";

$SFdate                 = date("Y-m-d");
$SFtime                 = date('h:i:s');
$SFtime_current         = date('Y-m-d h:i');
$SFdatetime             = date("Y-m-d H:i:s");
$SFnumber               = date("YmdHis");
$SFnumbercon            = 'LVR'.$SFnumber;

if(isset($_FILES['file']['name'])){

   $inp_id = $_GET['identity'];

   $whstd_request_own = mysqli_fetch_array(mysqli_query($connect, "SELECT created_by FROM whstd_request WHERE _id_whistle = '$inp_id'"));

       if($whstd_request_own['created_by'] == $username)  {
              $flag = '1';
       } else {
              $flag = '0';
       }

   /* Getting file name */
   $filename = $_FILES['file']['name'];

   /* Location */
   $location = "../../asset/request.file.whistleblower.attachment/".$filename;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("jpg","jpeg","png");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
         $response = $location;

         $sql = "INSERT INTO `whstm_chat` (`id_chat`, `_whistle_id`, `message`, `flag`, `created_date`, `company_id`, `image` , `created_by`) VALUES ('$inp_id', '$inp_id', 'image', '$flag', '$SFdatetime', '15135', '$filename' , '$username')";

              // condition start
              $query_0 = $connect->query($sql);
              
      }
   }

   echo $response;
   exit;

} 


//if form is submitted
if($_POST) {	

	

	//========================POST VALUE FORM========================//
	$inp_messageng       = $_POST['messageng'];
	$inp_id              = $_POST['id_chat'];
	//========================POST VALUE FORM========================//


       $whstd_request_own = mysqli_fetch_array(mysqli_query($connect, "SELECT created_by FROM whstd_request WHERE _id_whistle = '$inp_id'"));

       if($whstd_request_own['created_by'] == $username)  {
              $flag = '1';
       } else {
              $flag = '0';
       }

	
	$sql = "INSERT INTO `whstm_chat` (`id_chat`, `_whistle_id`, `message`, `flag`, `created_date`, `company_id`, `created_by`) VALUES ('$inp_id', '$inp_id', '$inp_messageng', '$flag', '$SFdatetime', '15135' , '$username')";

	// condition start
	$query_0 = $connect->query($sql);
	$connect->close();

}
