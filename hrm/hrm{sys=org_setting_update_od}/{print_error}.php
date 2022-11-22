<?php 
include "config.php";

$sql_tampil_error   = mysqli_query($masuk, "SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'pos id sama poscode beda' AS type
from od_tempmigrateposition a
LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.posisi_id 
Where b.kode_posisi <> a.kode_posisi
UNION ALL
SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'poscode sama beda pos id' AS type
from od_tempmigrateposition a
LEFT JOIN od_tempmigrateposition b ON b.kode_posisi = a.kode_posisi 
Where b.posisi_id <> a.posisi_id
UNION ALL
SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'pos id sama beda parent' AS type
from od_tempmigrateposition a
LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.posisi_id 
Where b.parent <> a.parent
UNION ALL
SELECT distinct x.posisi_idx,x.kode_posisix,x.nama_posisix,y.Direktorat_id,y.Division_id,y.Departemen_id,'org unit sama memiliki dir/div/dept beda' AS type
FROM
	(
		SELECT 
		a.position_id AS posisi_idx,
		a.kode_posisi AS kode_posisix,
		a.nama_posisi AS nama_posisix,
		a.parent_path AS parent_pathx ,
				CONCAT(b.Departemen_id,',',b.Division_id,',',b.Direktorat_id) AS orgunitx,
				c.position_id,c.kode_posisi,c.parent_path,c.orgunit,c.nama_posisi
		FROM od_tempmigratepositionpath a
		LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.position_id
		LEFT JOIN
				(
					SELECT a.position_id,a.kode_posisi,a.nama_posisi,a.parent_path,
							CONCAT(b.Departemen_id,',',b.Division_id,',',b.Direktorat_id) AS orgunit
					FROM od_tempmigratepositionpath a
					LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.position_id
				) c ON c.parent_path = a.parent_path 
		WHERE CONCAT(b.Departemen_id,',',b.Division_id,',',b.Direktorat_id) <> c.orgunit
	)x LEFT JOIN od_tempmigrateposition y ON y.posisi_id = x.posisi_idx
UNION ALL
SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'child dan parent punya job title sama' AS type
from od_tempmigrateposition a
LEFT JOIN od_tempmigrateposition b ON b.posisi_id = a.parent
LEFT JOIN od_orglevel c ON c.level_cat = a.Jobtitle_code
LEFT JOIN od_orglevel d ON d.level_cat = b.Jobtitle_code
WHERE c.level_cat = d.level_cat
UNION ALL
SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Direktorat_id,a.Division_id,a.Departemen_id,'Dept, division_id tidak sesuai master orgunit' AS type
from od_tempmigrateposition a
LEFT JOIN od_tempmigrateorgunit b ON b.Departemen_id = a.Departemen_id
WHERE a.Division_id <> b.Division_id
AND a.Departemen_id <> '0'
AND a.Departemen_id <> ''
UNION ALL
SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Departemen_id,a.Division_id,a.Direktorat_id,'Dept, Directorate tidak sesuai master orgunit' AS type
from od_tempmigrateposition a
LEFT JOIN od_tempmigrateorgunit b ON b.Departemen_id = a.Departemen_id
WHERE a.Direktorat_id <> b.Direktorat_id
AND a.Departemen_id <> '0'
AND a.Departemen_id <> ''
UNION ALL
SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Departemen_id,a.Division_id,a.Direktorat_id,'Divisi, Directorate tidak sesuai master orgunit' AS type
from od_tempmigrateposition a
LEFT JOIN od_tempmigrateorgunit b ON b.division_id = a.division_id
WHERE a.Direktorat_id <> b.Direktorat_id
AND a.division_id <> '0'
AND a.division_id <> ''
UNION ALL
SELECT a.posisi_id,a.kode_posisi,a.nama_posisi,a.Departemen_id,a.Division_id,a.Direktorat_id,'Penamaan tidak sesuai' AS type
from od_tempmigrateposition a
WHERE (a.nama_posisi LIKE '%HOD%' OR a.nama_posisi LIKE '%Department head%' OR a.nama_posisi LIKE '%dept head%'
		 OR a.nama_posisi LIKE '%asst dept head%' OR a.nama_posisi LIKE '%sub dept head%' OR a.nama_posisi LIKE '%sub department head%'
		 OR a.nama_posisi LIKE '%sec head%'
		)
		
");
?>
<table border="1">
    <thead>
        <tr>
            <th>NO</th>
            <th>Posisi ID</th>
            <th>Kode Posisi</th>
            <th>Nama Posisi</th>
            <th>Direktorat ID</th>
            <th>Divisi ID</th>
            <th>Departemen ID</th>
            <th>Type Error</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $no     = 1;
            while($data_tampil_error    = mysqli_fetch_assoc($sql_tampil_error)){
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data_tampil_error['posisi_id']; ?></td>
            <td><?php echo $data_tampil_error['kode_posisi']; ?></td>
            <td><?php echo $data_tampil_error['nama_posisi']; ?></td>
            <td><?php echo $data_tampil_error['Direktorat_id']; ?></td>
            <td><?php echo $data_tampil_error['Division_id']; ?></td>
            <td><?php echo $data_tampil_error['Departemen_id']; ?></td>
            <td><?php echo $data_tampil_error['type']; ?></td>
        </tr>
        <?php $no++; } ?>
    </tbody>
</table>