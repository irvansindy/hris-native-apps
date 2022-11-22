<?php
		include "../config.php";
						  $process_INS_SIMPOSISI = mysqli_query($connect, "TRUNCATE `simposisi`");
						  $process_INS_SIMPOSISI = mysqli_query($connect, "INSERT IGNORE INTO simposisi
																	(	
																		   posisi_id,
																		   kode_posisi,
																		   nama_posisi,
																		   parent,
																		   parent_path,
																		   flagadd,
																		   people_id,
																		   orderid,
																		   parent_path_reference,
																		   restruct_remark,
																		   departemen_id,
																		   division_id,
																		   direktorat_id
																	) 
																	
																	SELECT 
																		   position_id,
																		   pos_code,
																		   pos_name_en,
																		   parent_id,
																		   parent_path,
																		   flag_add,
																		   emp_id,
																		   pos_level,
																		   parent_path_reference,
																		   restruct_remark,
																		   ext_department_id,
																		   ext_division_id,
																		   ext_directorat_id
																	FROM
																	teomposition_b1");
						if($process_INS_SIMPOSISI){
							$process_DELETE_SIMPOSISI = mysqli_query($connect, "SELECT
															   a.posisi_id
															   FROM
															   simposisi a
															   LEFT JOIN simposisi b ON a.posisi_id=b.parent
															   WHERE a.kode_posisi LIKE '%insert%' AND
															   b.parent IS NULL");
							while($r_simposisi=mysqli_fetch_array($process_DELETE_SIMPOSISI)){
								$get_One = mysqli_fetch_array(mysqli_query($connect, "SELECT
																						a.parent
																						FROM
																						simposisi a
																						WHERE a.kode_posisi LIKE '%insert%' AND a.kode_posisi = '$r_simposisi[posisi_id]'"));   
								$process_One = mysqli_query($connect, "DELETE FROM simposisi WHERE posisi_id = '$r_simposisi[posisi_id]'");
							}

							$process_DELETE_SIMPOSISI = mysqli_query($connect, "SELECT
															   a.posisi_id
															   FROM
															   simposisi a
															   LEFT JOIN simposisi b ON a.posisi_id=b.parent
															   WHERE a.kode_posisi LIKE '%insert%' AND
															   b.parent IS NULL");
							while($r_simposisi=mysqli_fetch_array($process_DELETE_SIMPOSISI)){
								$get_One = mysqli_fetch_array(mysqli_query($connect, "SELECT
																						a.parent
																						FROM
																						simposisi a
																						WHERE a.kode_posisi LIKE '%insert%' AND a.kode_posisi = '$r_simposisi[posisi_id]'"));   
								$process_One = mysqli_query($connect, "DELETE FROM simposisi WHERE posisi_id = '$r_simposisi[posisi_id]'");
							}

							$process_DELETE_SIMPOSISI = mysqli_query($connect, "SELECT
															   a.posisi_id
															   FROM
															   simposisi a
															   LEFT JOIN simposisi b ON a.posisi_id=b.parent
															   WHERE a.kode_posisi LIKE '%insert%' AND
															   b.parent IS NULL");
							while($r_simposisi=mysqli_fetch_array($process_DELETE_SIMPOSISI)){
								$get_One = mysqli_fetch_array(mysqli_query($connect, "SELECT
																						a.parent
																						FROM
																						simposisi a
																						WHERE a.kode_posisi LIKE '%insert%' AND a.kode_posisi = '$r_simposisi[posisi_id]'"));   
								$process_One = mysqli_query($connect, "DELETE FROM simposisi WHERE posisi_id = '$r_simposisi[posisi_id]'");
							}

							$process_DELETE_SIMPOSISI = mysqli_query($connect, "SELECT
															   a.posisi_id
															   FROM
															   simposisi a
															   LEFT JOIN simposisi b ON a.posisi_id=b.parent
															   WHERE a.kode_posisi LIKE '%insert%' AND
															   b.parent IS NULL");
							while($r_simposisi=mysqli_fetch_array($process_DELETE_SIMPOSISI)){
								$get_One = mysqli_fetch_array(mysqli_query($connect, "SELECT
																						a.parent
																						FROM
																						simposisi a
																						WHERE a.kode_posisi LIKE '%insert%' AND a.kode_posisi = '$r_simposisi[posisi_id]'"));   
								$process_One = mysqli_query($connect, "DELETE FROM simposisi WHERE posisi_id = '$r_simposisi[posisi_id]'");
							}

							$process_DELETE_SIMPOSISI = mysqli_query($connect, "SELECT
															   a.posisi_id
															   FROM
															   simposisi a
															   LEFT JOIN simposisi b ON a.posisi_id=b.parent
															   WHERE a.kode_posisi LIKE '%insert%' AND
															   b.parent IS NULL");
							while($r_simposisi=mysqli_fetch_array($process_DELETE_SIMPOSISI)){
								$get_One = mysqli_fetch_array(mysqli_query($connect, "SELECT
																						a.parent
																						FROM
																						simposisi a
																						WHERE a.kode_posisi LIKE '%insert%' AND a.kode_posisi = '$r_simposisi[posisi_id]'"));   
								$process_One = mysqli_query($connect, "DELETE FROM simposisi WHERE posisi_id = '$r_simposisi[posisi_id]'");
							}

							$process_DELETE_SIMPOSISI = mysqli_query($connect, "SELECT
															   a.posisi_id
															   FROM
															   simposisi a
															   LEFT JOIN simposisi b ON a.posisi_id=b.parent
															   WHERE a.kode_posisi LIKE '%insert%' AND
															   b.parent IS NULL");
							while($r_simposisi=mysqli_fetch_array($process_DELETE_SIMPOSISI)){
								$get_One = mysqli_fetch_array(mysqli_query($connect, "SELECT
																						a.parent
																						FROM
																						simposisi a
																						WHERE a.kode_posisi LIKE '%insert%' AND a.kode_posisi = '$r_simposisi[posisi_id]'"));   
								$process_One = mysqli_query($connect, "DELETE FROM simposisi WHERE posisi_id = '$r_simposisi[posisi_id]'");
							}

							$process_DELETE_SIMPOSISI = mysqli_query($connect, "SELECT
															   a.posisi_id
															   FROM
															   simposisi a
															   LEFT JOIN simposisi b ON a.posisi_id=b.parent
															   WHERE a.kode_posisi LIKE '%insert%' AND
															   b.parent IS NULL");
							while($r_simposisi=mysqli_fetch_array($process_DELETE_SIMPOSISI)){
								$get_One = mysqli_fetch_array(mysqli_query($connect, "SELECT
																						a.parent
																						FROM
																						simposisi a
																						WHERE a.kode_posisi LIKE '%insert%' AND a.kode_posisi = '$r_simposisi[posisi_id]'"));   
								$process_One = mysqli_query($connect, "DELETE FROM simposisi WHERE posisi_id = '$r_simposisi[posisi_id]'");
							}
					 	}
					

						  echo '<script>
										alert("finish process data");
								 </script>';
						  
			

	 ?>