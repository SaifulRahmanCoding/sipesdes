<?php
require_once('assets/koneksi.php');
require_once('cek-login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) { header("Location: login.php"); }

// untuk paging
$halaman = 25; //batasan halaman
$page = isset($_GET['halaman']) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Data Penduduk</title>
	<?php require('config/style.php'); ?>
</head>
<body>

	<!-- bagian sidebar -->
	<?php require('komponen/sidebar.php'); ?>

	<!-- header-->
	<?php require('komponen/header-konten.php');?>

	<div id="bungkus" class="d-flex">

		<!-- bagian konten -->
		<div id="konten">

			<!-- isi konten -->
			<div class="isi-konten m-3">

				<div class="wrap shadow-sm pt-3 pb-2 ps-4 mt-3 mb-4 rounded">
					<h4 class="fw-bolder mb-4">Database Penduduk</h4>
					<form action="" method="POST">
						<div class="form-group mb-3 d-flex align-items-center col-8">
							<label for="search" class="col-3 fw-bolder">NIK/ Nama/ No KK</label>

							<input name="search" id="search"  class="form-control bg-light me-3" type="text" placeholder="Cari..." style="max-width:250px;">

							<input type="submit" name="submit" value="Temukan" class="btn btn-success text-white col-2 shadow-sm">
						</div>
					</form>
				</div>
				<?php
				// filter ada atau tidak nik, nama, no kk
				if (empty($_POST['search'])) {
					$cari = "ORDER BY id_penduduk LIMIT $mulai, $halaman";
					$navPage = "ada";
				}else{
					$result_cari = $_POST['search'];
					$cari = "WHERE nama LIKE '%$result_cari%' OR nik LIKE '%$result_cari%' OR no_kk LIKE '%$result_cari%'";
					$navPage = "";
				} ?>

				<div class="wrap col table-responsive shadow-sm rounded p-3">
					<?php 
					if($sessionLevel=="admin") : ?>
						<a href="cetak/cetak-data.php" class="btn btn-success mb-3 me-2" style="font-size:14px;">Cetak Data</a>
					<?php	require('komponen/modal-tambah-penduduk.php'); 
					 endif; ?>

					<table class="table table-striped table-bordered responsive-utilities text-center">
						<thead>
							<tr>
								<th scope="col">No</th>
								
								<?php if($sessionLevel=="admin") : ?>
									<th scope="col" style="min-width:100px;">Aksi</th>
								<?php endif; ?>

								<th scope="col">NIK</th>
								<th scope="col" style="min-width:200px;">Nama</th>
								<th scope="col">NO KK</th>
								<th scope="col">Dusun</th>
								<th scope="col">RT</th>
								<th scope="col">RW</th>
								<th scope="col" style="min-width:100px;">Tempat Lahir</th>
								<th scope="col" style="min-width:150px;">Tanggal Lahir</th>
								<th scope="col">JK</th>
								<th scope="col" style="min-width:200px;">SHDK</th>
								<th scope="col" style="min-width:100px;">Status Kawin</th>
								<th scope="col">Agama</th>
								<th scope="col" style="min-width:200px;">Pendidikan</th>
								<th scope="col" style="min-width:200px;">Pekerjaan</th>
							</tr>
						</thead>

						<tbody>
							<?php

							$query= "SELECT * FROM tb_penduduk $cari";
							$result=mysqli_query($db, $query);
							// cek nilai halaman da atau tidak dan tetapkan $i pakai if ternary
							(isset($_GET['halaman'])) ? $i = (((int)$_GET["halaman"]-1)*25)+1 : $i = 1;
							// foreach
							foreach ($result as $penduduk) {
								?>
								<tr>
									<td><?php echo $i++?></td>
									<?php if($sessionLevel=="admin") : ?>
										<td class="fs-6">
											<!-- modal edit-->
											<?php require('komponen/modal-edit-penduduk.php'); ?>
											<!-- end modal edit -->
											<a class="text-decoration-none fs-6 bg-danger bg-gradient text-white py-1 px-2 rounded-end" href="action/action-penduduk.php?id=<?php echo $penduduk['id_penduduk']?>&opsi=delete" onclick="return confirm_delete()">
												<i class="fa fa-trash-alt"></i>
											</a>

										</td>
									<?php endif; ?>

									<td><?php echo $penduduk['nik']?></td>
									<td class="text-uppercase"><?php echo $penduduk['nama']?></td>
									<td><?php echo $penduduk['no_kk']?></td>
									<td class="text-uppercase"><?php echo $penduduk['dusun']?></td>
									<td><?php echo $penduduk['rt']?></td>
									<td><?php echo $penduduk['rw']?></td>
									<td class="text-uppercase"><?php echo $penduduk['tmpt_lahir']?></td>
									<td><?php echo $penduduk['tgl_lahir']?></td>
									<td class="text-uppercase"><?php echo $penduduk['jk']?></td>
									<td class="text-uppercase"><?php echo $penduduk['shdk']?></td>
									<td class="text-uppercase"><?php echo $penduduk['nikah']?></td>
									<td class="text-uppercase"><?php echo $penduduk['agama']?></td>
									<td class="text-uppercase"><?php echo $penduduk['pendidikan']?></td>
									<td class="text-uppercase"><?php echo $penduduk['pekerjaan']?></td>
								</tr>

							<?php } ?>
						</tbody>
					</table>
				</div>

			</div>
			<!-- end konten -->

			<!-- footer konten -->
			<div class="layerPage m-3">
				<?php
				$sql = mysqli_query($db,"SELECT * FROM tb_penduduk");
				$total = mysqli_num_rows($sql);
				$pages = ceil($total/$halaman);

				// batas page tampil
				$limitpageshow = 1;

				// kondisi disable tombol sebelumnya
				$hilangP = ($page == 1) ? 'disabled' : ' ';

				// kondisi disable tombol selanjutnya
				$hilangN = ($page == $pages) ? 'disabled' : ' ';
				

				if ($navPage == "ada") {

					?>
					<nav aria-label="pagging">
						<ul class="pagination">
							<?php if ($page > 1) {?>
								<li class="page-item">
									<a class="page-link" href="?halaman=1"><i class="fa fa-angle-double-left"></i></a>
								</li>
							<?php } ?>

							<li class="page-item <?php echo $hilangP?>">
								<?php $previouspage = $page-1; ?>
								<a class="page-link" href="?halaman=<?php echo $previouspage; ?>" aria-disabled="true"><i class="fa fa-angle-left"></i></a>
							</li>

							<!-- menampilkan pages -->
							<li class="page-item"><a class="page-link" href="?halaman=<?php echo $page; ?>"><?php echo $page; ?></a></li>

							<li class="page-item <?php echo $hilangN?>">
								<?php $nextpage = $page+1; ?>
								<a class="page-link" href="?halaman=<?php echo $nextpage; ?>"><i class="fa fa-angle-right"></i></a>
							</li>

							<?php if ($page < $pages) { ?>
								<li class="page-item">
									<a class="page-link" href="?halaman=<?php echo $pages?>"><i class="fa fa-angle-double-right"></i></a>
								</li>
							<?php } ?>

						</ul>
						<p>Page: <?php echo $page?> of <?php echo $pages?></p>
					</nav>
				<?php } ?>

			</div>
		</div>
		<!-- end konten -->
	</div>
</body>
</html>
<?php require('config/script.php'); ?>

<script type="text/javascript">	
// konfirmasi hapus
function confirm_delete(){
	return confirm("Anda Yakin Menghapus Data ini?");
}
</script>