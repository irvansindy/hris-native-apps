<?php include "../../application/session/session.php";?>
	<script type="text/javascript" src="jquery.js"></script>
 
	<form method="post" class="form-user">		
		<table>
			<tr>
				<td>Nama</td>
				<td><input type="text" name="nama"></td>
			</tr>
			<tr>
				<td></td>
				<td><a class="tombol-simpan">Simpan</a></td>
			</tr>
		</table>
	</form>

 
	<script type="text/javascript">
	$(document).ready(function(){
		$(".tombol-simpan").click(function(){
			var data = $('.form-user').serialize();
			$.ajax({
				type: 'POST',
				url: "aksi.php",
				data: data,
				success: function() {
					alert('New message received');
				}
			});
		});
	});
	</script>
