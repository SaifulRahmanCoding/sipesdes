<?php
require_once('assets/koneksi.php');
require_once('cek-login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) { header("Location: login.php"); }

// untuk paging
$halaman = 15; //batasan halaman
$page = isset($_GET['halaman']) ? (int)$_GET["halaman"] : 1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register Surat Keterangan</title>
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
					<h4 class="fw-bolder mb-4">Register Surat Keterangan</h4>
					<form action="" method="POST">
						<div class="form-group mb-3 d-flex align-items-center col-8">
							<label for="search" class="col-4 fw-bolder">Nomor Surat/ Nama Pemohon/ Keterangan</label>

							<input name="search" id="search"  class="form-control bg-light mx-3" type="text" placeholder="Cari..." style="max-width:250px;">

							<input type="submit" name="submit" value="Temukan" class="btn btn-success text-white col-2 shadow-sm">
						</div>
					</form>
				</div>
				<?php
				// filter ada atau tidak nik, nama, no kk
				if (empty($_POST['search'])) {
					$cari = "ORDER BY no_surat DESC LIMIT $mulai, $halaman";
					$navPage = "ada";
				}else{
					$result_cari = $_POST['search'];
					$cari = "WHERE nama LIKE '%$result_cari%' OR no_surat LIKE '%$result_cari%' OR ket_surat_register LIKE '%$result_cari%'";
					$navPage = "";
				} ?>
				<div class="wrap col table-responsive shadow-sm rounded p-3">
					<?php 
					if($sessionLevel=="admin") : ?>
						<a class="btn btn-success mb-3" style="font-size: 14px;" href="cetak/cetak-register-surat.php" target="_blank">Cetak Register Surat</a>
					<?php endif; ?>
					<table class="table table-striped table-bordered responsive-utilities text-center">
						<thead>
							<tr>
								<?php if($sessionLevel == "petugas") : ?>
								<th scope="col" style="min-width:130px;">Aksi</th>
								<?php endif; ?>
								<th scope="col">Nomor Surat</th>
								<th scope="col" style="min-width:130px;">Tanggal Surat</th>
								<th scope="col" style="min-width:150px;">Nama</th>
								<th scope="col" style="min-width:100px;">Jenis Kelamin</th>
								<th scope="col">Tempat</th>
								<th scope="col" style="min-width:130px;">Tanggal Lahir</th>
								<th scope="col">Kewarganegaraan</th>
								<th scope="col">Agama</th>
								<th scope="col" style="min-width:100px;">Status Perkawinan</th>
								<th scope="col" style="min-width:100px;">Alamat (Dusun/RT/RW)</th>
								<th scope="col">Keterangan</th>
							</tr>
						</thead>

						<tbody>
							<?php
							require('library/ubah_tanggal.php');

							$query= "SELECT * FROM tb_register_surat $cari";
							$result=mysqli_query($db, $query);
							// foreach
							foreach ($result as $register) {
								?>
								<tr>
									<?php if($sessionLevel == "petugas") : ?>
									<td class="fs-6">
										<!-- cetak -->
										<a class="text-decoration-none fs-6 bg-warning text-white p-1 px-2 rounded-start" data-bs-toggle="tooltip" title="Cetak Surat" href="cetak/cetak-surat.php?no_surat=<?php echo $register['no_surat']?>&jenis=<?php echo $register['ket_surat_register']?>" target="_blank"><i class="fa fa-print"></i></a>
										<!-- edit -->
										<a class="text-decoration-none fs-6 bg-success text-white py-1 ps-2 pe-1" data-bs-toggle="tooltip" title="Edit Surat" href="edit-surat.php?no_surat=<?php echo $register['no_surat']?>&jenis=<?php echo $register['ket_surat_register']?>"><i class="fa fa-edit"></i></a>
										<!-- hapus/delete -->
										<a class="text-decoration-none fs-6 bg-danger text-white py-1 px-2 rounded-end" data-bs-toggle="tooltip" title="Hapus Surat" href="delete-surat.php?no_surat=<?php echo $register['no_surat']?>" onclick="return confirm_delete()">
											<i class="fa fa-trash-alt"></i>
										</a>
									</td>
									<?php endif; ?>
									<td><?php echo $register['no_surat']?></td>
									<?php $tgl_surat = $register['tgl_surat']; ?>
									<td><?php echo ubahTanggal($tgl_surat) ?></td>
									<td class="text-uppercase"><?php echo $register['nama']?></td>
									<td class="text-uppercase"><?php echo $register['jk']?></td>
									<td class="text-uppercase"><?php echo $register['tmpt_lahir']?></td>
									<td>
										<?php
										$tgl_lahir = $register['tgl_lahir']; 
										echo ubahTanggal($tgl_lahir)
										?>
									</td>
									<td class="text-uppercase"><?php echo $register['wn']?></td>
									<td class="text-uppercase"><?php echo $register['agama']?></td>
									<td class="text-uppercase"><?php echo $register['nikah']?></td>
									<?php
									$dusun = $register['dusun'];
									$rt = $register['rt'];
									$rw = $register['rw'];
									$alamat = "$dusun/$rt/$rw";
									?>
									<td class="text-uppercase"><?php echo $alamat?></td>
									<td class="text-uppercase"><?php echo $register['ket_surat_register']?></td>
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
				$sql = mysqli_query($db,"SELECT * FROM tb_register_surat");
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
	return confirm('Anda Yakin Menghapus Data Ini?');
}
</script>