<table>
		<!--form upload file-->
		<form method="post" enctype="multipart/form-data" >
			<tr>
				<td>Masukan Password</td>
				<td><input name="password" type="text" required="required"></td>
			</tr>
			<tr>
				<td></td>
				<td><input name="upload" type="submit" value="Generate"></td>
			</tr>
		</form>
</table>

<?php
	if (isset($_POST['upload'])) {
        $password = $_POST['password'];
		
			$pass  = password_hash($password, PASSWORD_DEFAULT);

            echo $pass;
			
	}
	?>