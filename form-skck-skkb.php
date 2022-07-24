<?php
require_once('assets/koneksi.php');
require_once('cek-login.php');

//cek apakah sudah login
//jika belum login, akan di lempar ke form login 
if ($sessionStatus==false) {
	header("Location: login.php");
}
// deteksi isi variabel nik dan set nilai
$cari_nik = (isset($_POST['nik'])) ? $_POST['nik'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Buat SKKB/SKCK</title>
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
						<h4 class="fw-bolder fs-5">Form Surat Keterangan Kelakuan Baik/Surat Keterangan Catatan Kepolisian</h4>
						<!-- form temukan NIK -->
						<form action="" method="POST">
							<div class="form-group mb-3 d-flex align-items-center col-8">
								<label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK Penduduk</label>

								<input name="nik" id="nik"  class="form-control bg-light me-3" type="text" placeholder="Temukan NIK">

								<input type="submit" name="submit" value="Temukan" class="btn btn-success text-white col-2">
							</div>

						</form>

					</div>
					<?php
					// query untuk nomer surat
					$query = "SELECT no_surat FROM tb_register_surat ORDER BY no_surat DESC";
					$result = mysqli_query($db, $query);
					$no_surat = mysqli_fetch_assoc($result);

					// nomor surat otomatis
					if (empty($no_surat['no_surat'])) {
						$no_surat_cek = "001";
					}else{
						$no_surat = $no_surat['no_surat'];
						$no_surat_cek = $no_surat+1;
						$hitung_word = strlen($no_surat_cek);
						if ($hitung_word == 3) {
							$no_surat_cek = $no_surat_cek;
						}elseif ($hitung_word == 2) {
							$no_surat_cek = "0$no_surat_cek";
						}else{
							$no_surat_cek = "00$no_surat_cek";
						}
					}
					// filter atau pencegah error pemanggilan data
					if (empty($cari_nik)) {
						die();
					}

					// panggil data nik dari data penduduk
					$query = "SELECT * FROM tb_penduduk WHERE nik = '$cari_nik'";
					$hasil = mysqli_query($db, $query);
					// hitung jumlah data ada berapa baris
					$jml_data = mysqli_num_rows($hasil);

					// definisikan data
					foreach ($hasil as $penduduk) {
						$nama = $penduduk['nama'];
						$dusun = $penduduk['dusun'];
						$rt = $penduduk['rt'];
						$rw = $penduduk['rw'];
						$tmpt_lahir = $penduduk['tmpt_lahir'];
						$tgl_lahir = $penduduk['tgl_lahir'];
						$jk = $penduduk['jk'];
						$pekerjaan = $penduduk['pekerjaan'];
						$agama = $penduduk['agama'];
						$nikah = $penduduk['nikah'];
					}

					// kondisi jika nik yang di cari tidak ditemukan 
					if ($jml_data == 0) {
						?>
						<div class="no-data wrap shadow-sm p-3 d-flex justify-content-center">
							<div class="bg-danger rounded px-2 py-1">
								<span class="text-white" style="cursor: default; font-size: 14px;">Data Tidak Ditemukan !</span>
							</div>
						</div>
						<?php
						die();
					}

					// filter kata ke 2 dari pekerjaan
					$pekerjaan2 = explode('/', strtolower($pekerjaan));
					$pekerjaan2[1] = (empty($pekerjaan2[1])) ? $pekerjaan2[1] = "" : "$pekerjaan2[1]";
					$array_pekerjaan = ucwords($pekerjaan2[1]);
					$kata_2_pekerjaan = "/$array_pekerjaan";
					// deteksi kata ke 2 dari pekerjaan apakah ada
					$kata_array_pekerjaan = (empty($pekerjaan2[1])) ? "" : $kata_2_pekerjaan;
					// gabung dengan kata ke 1
					$pekerjaan_hasil = ucwords("$pekerjaan2[0]$kata_array_pekerjaan");

					?>
					<div class="wrap shadow-sm p-3 mt-3">
						<form action="action/action-skck-skkb.php?opsi=input" method="POST">
							<div class="row ps-3">
								<!-- kiri -->
								<div class="col-5 me-5">
									<!-- panggil data id sesuai jabatan aktif kepala desa -->
									<?php
									$query = "SELECT * FROM `tb_pejabat` WHERE jabatan = 'Kepala Desa' AND status = 'aktif'";
									$query_kepdes = mysqli_query($db,$query);
									$kepdes = mysqli_fetch_assoc($query_kepdes);
									?>
									<input name="id_pejabat" id="id_pejabat"  class="form-control bg-light" type="text" value="<?php echo $kepdes['id_pejabat'];?>" hidden required>
									
									<div class="form-group mb-1 d-flex align-items-center">
										<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

										<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat_cek?>" onkeypress="return hanyaAngka(event)" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK</label>

										<input name="nik" id="nik"  class="form-control bg-light" type="text" value="<?php echo $cari_nik?>" onkeypress="return hanyaAngka(event)" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

										<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $nama?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="dusun" class="mb-2 col-3 pt-2 pb-2">Dusun</label>

										<select id="dusun" class="form-select bg-light" name="dusun" required>
											<option value="Utara" <?php echo ($dusun=="UTARA") ? "selected" : "" ?> >Utara</option>
											<option value="Tenggara" <?php echo ($dusun=="TENGGARA") ? "selected" : "" ?> >Tenggara</option>
											<option value="Selatan" <?php echo ($dusun=="SELATAN") ? "selected" : "" ?> >Selatan</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rt" class="mb-2 col-3 pt-2 pb-2">RT</label>

										<input name="rt" id="rt"  class="form-control bg-light" type="text" value="<?php echo $rt?>" onkeypress="return hanyaAngka(event)" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW</label>

										<input name="rw" id="rw"  class="form-control bg-light" type="text" value="<?php echo $rw?>" onkeypress="return hanyaAngka(event)" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="pekerjaan" class="mb-2 col-3 pt-2 pb-2">Pekerjaan</label>

										<input name="pekerjaan" id="pekerjaan"  class="form-control bg-light" type="text" value="<?php echo $pekerjaan_hasil?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="agama" class="mb-2 col-3 pt-2 pb-2 ">Agama</label>

										<select id="agama" class="form-select bg-light" name="agama" required>

											<option value="Islam" <?php echo ($agama == "ISLAM") ? "selected" : "" ?> >Islam</option>
											<option value="Kristen" <?php echo ($agama == "KRISTEN") ? "selected" : "" ?> >Kristen</option>
											<option value="Katholik" <?php echo ($agama == "KATHOLIK") ? "selected" : "" ?> >Katholik</option>
											<option value="Hindu" <?php echo ($agama == "HINDU") ? "selected" : "" ?> >Hindu</option>
											<option value="Budha" <?php echo ($agama == "BUDHA") ? "selected" : "" ?> >Budha</option>
											<option value="Khonghucu" <?php echo ($agama == "KHONGHUCU") ? "selected" : "" ?> >Khonghucu</option>
											<option value="Kepercaya an" <?php echo ($agama == "KEPERCAYA AN") ? "selected" : "" ?> >Kepercaya an</option>

										</select>
									</div>

								</div>

								<!-- kanan -->
								<div class="col-6">

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tmpt_lahir" class="mb-2 col-3 pt-2 pb-2 me-4">Tempat Lahir</label>

										<input name="tmpt_lahir" id="tmpt_lahir"  class="form-control bg-light" type="text" value="<?php echo ucwords(strtolower($tmpt_lahir)) ?>" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="tgl_lahir" class="mb-2 col-3 pt-2 pb-2 me-4">Tgl Lahir</label>

										<input name="tgl_lahir" id="tgl_lahir"  class="form-control bg-light" type="date" value="<?php echo $tgl_lahir?>" required>
									</div>


									<div class="form-group mb-1 d-flex align-items-center">
										<label for="ket_wn" class="mb-2 col-3 pt-2 pb-2 me-4">Warga Negara</label>

										<input name="ket_wn" id="ket_wn"  class="form-control bg-light" type="text" value="WNI" required>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="jk" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis Kelamin</label>

										<div class="form-check">
											<input type="radio" class="form-check-input" value="Laki-Laki" id="laki-laki" name="jk" <?php echo ($jk=="L") ? "checked" : "" ?> required>
											<label for="laki-laki" class="form-check-label me-4">Laki-Laki</label>
										</div>
										<div class="form-check disabled">
											<input type="radio" class="form-check-input" value="Perempuan" id="perempuan" name="jk" <?php echo ($jk=="P") ? "checked" : "" ?> required>
											<label for="perempuan" class="form-check-label">Perempuan</label>
										</div>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">
										<label for="nikah" class="col-3 pt-2 pb-2 me-4">Status Nikah</label>

										<select id="nikah" class="form-select bg-light" name="nikah" required>
											<option value="" <?php echo ($nikah == "-") ? "selected" : "" ?> > - Pilih</option>
											<option value="Belum Kawin" <?php echo ($nikah == "BELUM KAWIN") ? "selected" : "" ?> >Belum Kawin</option>
											<option value="Kawin" <?php echo ($nikah == "KAWIN") ? "selected" : "" ?> >Kawin</option>
											<option value="Cerai Mati" <?php echo ($nikah == "CERAI MATI") ? "selected" : "" ?> >Cerai Mati</option>
											<option value="Cerai Hidup" <?php echo ($nikah == "CERAI HIDUP") ? "selected" : "" ?> >Cerai Hidup</option>
										</select>
									</div>

									<div class="form-group mb-1 d-flex align-items-center">

										<label for="keperluan" class="mb-2 col-3 pt-4 pb-4 me-4">Keperluan</label>

										<textarea class="form-control bg-light" id="keperluan" name="keperluan"></textarea>
									</div>
									
									<div class="form-group mb-1 d-flex align-items-center">

										<label for="jenis" class="mb-2 col-3 pt-2 pb-2 me-4">SKKB / SKCK</label>

										<select id="jenis" class="form-select bg-light" name="jenis" required>
											<option value="">- Pilih Jenis</option>
											<option value="SURAT KETERANGAN CATATAN KEPOLISIAN">SKCK</option>
											<option value="SURAT KETERANGAN KELAKUAN BAIK">SKKB</option>
										</select>

									</div>

									<div>
										<label class="mb-2 col-3 me-4">Bantuan &nbsp<?php $j_surat = "skkb_skck"; require('komponen/modal-bantuan.php'); ?></label>
									</div>

								</div>
							</div>

							<input type="submit" name="submit" value="Buat Surat" class="btn btn-dark text-white col-2 ms-3 mt-3">
						</form>
					</div>

				</div>
			</div>

		</div>
		<!-- end konten -->
	</div>
</body>
</html>
<?php require('config/script.php'); ?>