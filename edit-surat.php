<?php
require_once('assets/koneksi.php');
require_once('cek-login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}

// dapatkan nilai no_surat
if (isset($_GET['no_surat'])) {$no_surat = $_GET['no_surat']; }else{header('Location: register-surat.php'); }
if (isset($_GET['jenis'])) {$jenis_surat = $_GET['jenis']; }else{header('Location: register-surat.php'); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit <?php echo $jenis_surat?></title>
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
			<div class="isi-konten m-4">
				<div class="container">
					<div class="wrap shadow-sm p-3">
						<h4 class="fw-bolder">Halaman Edit <?php echo $jenis_surat?></h4>
					</div>
					<?php
					if ($jenis_surat == "SKTM") {
						require('komponen/edit-micro-sktm.php');

					}elseif ($jenis_surat == "SKU") {
						require('komponen/edit-micro-sku.php');
						
					}elseif ($jenis_surat == "SKCK" OR $jenis_surat == "SKKB") {
						require('komponen/edit-micro-skck-skkb.php');
					}elseif ($jenis_surat == "PENGANTAR PINDAH") {
						require('komponen/edit-micro-pindah.php');

					}elseif ($jenis_surat == "PERMOHONAN KK") {
						require('komponen/edit-micro-permohonan-kk.php');
					}
					?>
				</div>
			</div>

		</div>
		<!-- end konten -->
	</div>
</body>
</html>
<?php require('config/script.php'); ?>