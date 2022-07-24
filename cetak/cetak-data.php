<?php
require_once('../assets/koneksi.php');
 // convert file ke bentuk excel
header("Content-type:application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Penduduk_Desa_Bantal.xls");
?>
<table border="1">
	<h1> </h1>
	<h1 align="center">Data Penduduk Desa Bantal SIPESDES</h1>
	<h1> </h1>
	<thead>
		<tr>
			<th>No</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>NO KK</th>
			<th>Dusun</th>
			<th>RT</th>
			<th>RW</th>
			<th>Tempat Lahir</th>
			<th>Tanggal Lahir</th>
			<th>JK</th>
			<th>SHDK</th>
			<th>Agama</th>
			<th>Pendidikan</th>
			<th>Pekerjaan</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$query= "SELECT * FROM tb_penduduk";
		$result=mysqli_query($db, $query);
							// foreach
		$i=1;
		foreach ($result as $penduduk) {
			?>
			<tr>
				<td align="center"><?php echo $i++?></td>
				<td><?php echo "'{$penduduk['nik']}"?></td>
				<td><?php echo $penduduk['nama']?></td>
				<td><?php echo "'{$penduduk['no_kk']}"?></td>
				<td align="center"><?php echo $penduduk['dusun']?></td>
				<td align="center"><?php echo "'{$penduduk['rt']}"?></td>
				<td align="center"><?php echo "'{$penduduk['rw']}"?></td>
				<td align="center"><?php echo $penduduk['tmpt_lahir']?></td>
				<td align="center"><?php echo $penduduk['tgl_lahir']?></td>
				<td align="center"><?php echo $penduduk['jk']?></td>
				<td align="center"><?php echo $penduduk['shdk']?></td>
				<td align="center"><?php echo $penduduk['agama']?></td>
				<td align="center"><?php echo $penduduk['pendidikan']?></td>
				<td align="center"><?php echo $penduduk['pekerjaan']?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
