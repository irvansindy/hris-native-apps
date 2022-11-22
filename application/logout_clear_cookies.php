<?php   
session_start(); //to ensure you are using same session
session_destroy(); //destroy the session
setcookie('username', '', 0, '/');
setcookie('password', '', 0, '/');

unset($_COOKIE['StrixscarII']); 
setcookie('StrixscarII', null, -1, '/'); 

header("location:../login?logout=yes"); //to redirect back to "index.php" after logging out
exit();
?>