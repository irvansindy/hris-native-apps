<?php 
include "../../../application/session/session_ess.php";
$id = $_POST['nc'];

$sql_ambil_template = mysqli_query($connect, "SELECT 
b.template_content_en
FROM tclmletterdocument a 
LEFT JOIN tsfmlettertemplate b ON a.template_code = b.template_code
WHERE a.letter_no = '$id'");

$template = mysqli_fetch_assoc($sql_ambil_template);

?>
<?php echo $template['template_content_en'] ?>