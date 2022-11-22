<?php
$req_menu 			= mysqli_query($connect, "SELECT emp_no, 
                                                GROUP_CONCAT(formula ORDER BY formula ASC SEPARATOR ' OR ') AS formula 
                                                        FROM users_menu_access
                                                        WHERE 
                                                        emp_no = '13-0299'
                                                        GROUP BY emp_no");

$var_having_formula_req_menu = mysqli_fetch_array($req_menu);

$var1 = array("OR",",");
$var2 = array("','","','");
$conversion_formula = str_replace($var1, $var2, $var_having_formula_req_menu['formula']); 
$qSequence_r = "'$conversion_formula'"; 
?>