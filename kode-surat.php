<?php
require_once('assets/koneksi.php');
require_once('cek-login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) { header("Location: login.php"); }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Kode Surat</title>
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
				<div class="container mt-4">
					<div class="wrap col table-responsive shadow-sm rounded p-3 mt-2">
						<h4 class="fw-bolder mb-4">Kode Surat</h4>
						<?php

						$query = "SELECT * FROM kode_surat";
						$result = mysqli_query($db, $query);
						// foreach
						foreach ($result as $kode) {
							$kode_index = $kode['kode_index'];
							$permohonan_kk = $kode['permohonan_kk'];
							$pengantar_pindah = $kode['pengantar_pindah'];
							$skck_skkb = $kode['skck_skkb'];
							$sktm = $kode['sktm'];
							$sku_pertanian = $kode['sku_pertanian'];
							$sku_peternakan = $kode['sku_peternakan'];
							$sku_perdagangan = $kode['sku_perdagangan'];
						}
						?>
						<form action="" method="POST">
							<div class="row">
								<input name="update" id="update"  class="form-control bg-light" type="text" value="update" hidden>
								<!-- satu -->
								<div class="col-4">
									<div class="form-group my-4 mx-2">
										<label for="kode_index" class="mb-2">Kode Index</label>

										<input name="kode_index" id="kode_index"  class="form-control bg-light" type="text" value="<?php echo empty($kode_index) ? "" : $kode_index ?>">
									</div>
									<div class="form-group my-4 mx-2">
										<label for="permohonan_kk" class="mb-2">Permohonan KK</label>

										<input name="permohonan_kk" id="permohonan_kk"  class="form-control bg-light" type="text" value="<?php echo empty($permohonan_kk) ? "" : $permohonan_kk ?>">
									</div>
									<div class="form-group my-4 mx-2">
										<label for="sku_peternakan" class="mb-2">Surat Keterangan Usaha Peternakan</label>

										<input name="sku_peternakan" id="sku_peternakan"  class="form-control bg-light" type="text" value="<?php echo empty($sku_peternakan) ? "" : $sku_peternakan ?>">
									</div>
								</div>

								<!-- dua -->
								<div class="col-4">
									<div class="form-group my-4 mx-2">
										<label for="pengantar_pindah" class="mb-2">Pengantar Pindah</label>

										<input name="pengantar_pindah" id="pengantar_pindah"  class="form-control bg-light" type="text" value="<?php echo empty($pengantar_pindah) ? "" : $pengantar_pindah ?>">
									</div>
									<div class="form-group my-4 mx-2">
										<label for="skck_skkb" class="mb-2">SKCK/SKKB</label>

										<input name="skck_skkb" id="skck_skkb"  class="form-control bg-light" type="text" value="<?php echo empty($skck_skkb) ? "" : $skck_skkb ?>">
									</div>
									<div class="form-group my-4 mx-2">
										<label for="sku_perdagangan" class="mb-2">Surat Keterangan Usaha Perdagangan</label>

										<input name="sku_perdagangan" id="sku_perdagangan"  class="form-control bg-light" type="text" value="<?php echo empty($sku_perdagangan) ? "" : $sku_perdagangan ?>">
									</div>
								</div>
								<!-- tiga -->

								<div class="col-4">
									<div class="form-group my-4 mx-2">
										<label for="sktm" class="mb-2">Surat Keterangan Tidak Mampu</label>

										<input name="sktm" id="sktm"  class="form-control bg-light" type="text" value="<?php echo empty($sktm) ? "" : $sktm ?>">
									</div>
									<div class="form-group my-4 mx-2">
										<label for="sku_pertanian" class="mb-2">Surat Keterangan Usaha Pertanian</label>

										<input name="sku_pertanian" id="sku_pertanian"  class="form-control bg-light" type="text" value="<?php echo empty($sku_pertanian) ? "" : $sku_pertanian ?>">
									</div>
									
								</div>
							</div>

							<input type="submit" name="submit" value="Simpan" class="btn btn-dark text-white col-2">
						</form>

					</div>

				</div>
			</div>
		</div>
	</div>
</body>
</html>
<?php 
require('config/script.php'); 

if(isset($_POST['update'])) :

	$kode_index = $_POST['kode_index'];
	$permohonan_kk = $_POST['permohonan_kk'];
	$pengantar_pindah = $_POST['pengantar_pindah'];
	$skck_skkb = $_POST['skck_skkb'];
	$sktm = $_POST['sktm'];
	$sku_pertanian = $_POST['sku_pertanian'];
	$sku_peternakan = $_POST['sku_peternakan'];
	$sku_perdagangan = $_POST['sku_perdagangan'];
	
	$row = mysqli_num_rows($result);
	if($row == 0){
		$query = "INSERT INTO kode_surat(kode_index, permohonan_kk, pengantar_pindah, skck_skkb, sktm, sku_pertanian, sku_peternakan, sku_perdagangan) VALUES ('$kode_index','$permohonan_kk','$pengantar_pindah','$skck_skkb','$sktm','$sku_pertanian','$sku_peternakan','$sku_perdagangan')";
		$hasil = mysqli_query($db,$query);

	}else{
		$query = "UPDATE kode_surat SET 
		kode_index='$kode_index',
		permohonan_kk='$permohonan_kk',
		pengantar_pindah='$pengantar_pindah',
		skck_skkb='$skck_skkb',
		sktm='$sktm',
		sku_pertanian='$sku_pertanian',
		sku_peternakan='$sku_peternakan',
		sku_perdagangan='$sku_perdagangan'";
		
		$hasil = mysqli_query($db,$query);
	}
	if($hasil==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data');
			window.location.href="kode-surat.php";
		</script>
	<?php }else{ ?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data');
			window.location.href="kode-surat.php";
		</script>
	<?php }

endif;

?>
