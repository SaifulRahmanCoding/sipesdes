<?php
// query panggil data
$query = "SELECT * FROM tb_register_surat INNER JOIN pengantar_pindah ON tb_register_surat.no_surat = pengantar_pindah.no_surat WHERE tb_register_surat.no_surat='$no_surat'";
$result = mysqli_query($db, $query);

// definisikan data
foreach ($result as $pindah) {
	$tgl_surat = $pindah['tgl_surat'];
	$nama = $pindah['nama'];
	$dusun = $pindah['dusun'];
	$rt = $pindah['rt'];
	$rw = $pindah['rw'];
	$tmpt_lahir = $pindah['tmpt_lahir'];
	$tgl_lahir = $pindah['tgl_lahir'];
	$jk = $pindah['jk'];
	$agama = $pindah['agama'];
	$wn = $pindah['wn'];
	$nik = $pindah['nik'];
	$no_kk = $pindah['no_kk'];
	$kp_keluarga = $pindah['kp_keluarga'];
	$nikah = $pindah['nikah'];
	$id_pejabat = $pindah['id_pejabat'];
	$jenis_pindah = $pindah['jenis_pindah'];
	$alamat_pindah = $pindah['alamat_pindah'];
	$jml_pindah = $pindah['jml_pindah'];
}
?>
<div class="wrap shadow-sm p-3 mt-3">
	<form action="action/action-pindah.php?opsi=update" method="POST">
		<div class="row ps-3">
			<!-- kiri -->
			<div class="col-5 me-5">
				<input name="id_pejabat" id="id_pejabat"  class="form-control bg-light" type="text" value="<?php echo $id_pejabat ?>" hidden required>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

					<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat?>" onkeypress="return hanyaAngka(event)" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK</label>

					<input name="nik" id="nik"  class="form-control bg-light" type="text" value="<?php echo $nik?>" onkeypress="return hanyaAngka(event)" required>
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

					<input name="rt" id="rt"  class="form-control bg-light" type="text" value="<?php echo $rt?>" onkeypress="return hanyaAngka(event)" maxlength = "3" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW</label>

					<input name="rw" id="rw"  class="form-control bg-light" type="text" value="<?php echo $rw?>" onkeypress="return hanyaAngka(event)" maxlength = "3" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="no_kk" class="mb-2 col-3 pt-2 pb-2">Nomor KK</label>

					<input name="no_kk" id="no_kk"  class="form-control bg-light" type="text" value="<?php echo $no_kk?>" onkeypress="return hanyaAngka(event)" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="kp_kk" class="mb-2 col-3 pt-2 pb-2">Nama Kepala Keluarga</label>

					<input name="kp_kk" id="kp_kk"  class="form-control bg-light" type="text" value="<?php echo $kp_keluarga?>" required>
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

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="tmpt_lahir" class="mb-2 col-3 pt-2 pb-2">Tempat Lahir</label>

					<input name="tmpt_lahir" id="tmpt_lahir"  class="form-control bg-light" type="text" value="<?php echo ucwords(strtolower($tmpt_lahir));?>" required>
				</div>

			</div>

			<!-- kanan -->
			<div class="col-6">

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="tgl_lahir" class="mb-2 col-3 pt-2 pb-2 me-4">Tgl Lahir</label>

					<input name="tgl_lahir" id="tgl_lahir"  class="form-control bg-light" type="date" value="<?php echo $tgl_lahir;?>" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="wn" class="mb-2 col-3 pt-2 pb-2 me-4">Warga Negara</label>

					<input name="wn" id="wn"  class="form-control bg-light" type="text" value="<?php echo $wn?>" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="jk" class="mb-2 col-3 pt-2 pb-2 me-4">Jenis Kelamin</label>

					<div class="form-check">
						<input type="radio" class="form-check-input" value="Laki-Laki" id="laki-laki" name="jk" <?php echo ($jk=="Laki-Laki") ? "checked" : "" ?> required>
						<label for="laki-laki" class="form-check-label me-4">Laki-Laki</label>
					</div>
					<div class="form-check disabled">
						<input type="radio" class="form-check-input" value="Perempuan" id="perempuan" name="jk" <?php echo ($jk=="Perempuan") ? "checked" : "" ?> required>
						<label for="perempuan" class="form-check-label">Perempuan</label>
					</div>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="nikah" class="col-3 pt-2 pb-2 me-4">Status Nikah</label>

					<select id="nikah" class="form-select bg-light" name="nikah" required>
						<option value="-" <?php echo ($nikah == "-") ? "selected" : "" ?> > - Pilih</option>
						<option value="Belum Kawin" <?php echo ($nikah == "Belum Kawin") ? "selected" : "" ?> >Belum Kawin</option>
						<option value="Kawin" <?php echo ($nikah == "Kawin") ? "selected" : "" ?> >Kawin</option>
						<option value="Cerai Mati" <?php echo ($nikah == "Cerai Mati") ? "selected" : "" ?> >Cerai Mati</option>
						<option value="Cerai Hidup" <?php echo ($nikah == "Cerai Hidup") ? "selected" : "" ?> >Cerai Hidup</option>
					</select>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="alamat_pindah" class="mb-2 col-3 pt-2 pb-2 me-4">Alamat Pindah</label>

					<textarea name="alamat_pindah" id="alamat_pindah" class="form-control bg-light" rows="4"><?php echo $alamat_pindah?></textarea>

				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="jml_pindah" class="mb-2 col-3 pt-2 pb-2 me-4">Jumlah yang Pindah</label>

					<input name="jml_pindah" id="jml_pindah"  class="form-control bg-light" type="text" onkeypress="return hanyaAngka(event)" maxlength = "2" value="<?php echo $jml_pindah ?>" required>

					<label for="jml_pindah" class="mb-2 col-6 pt-2 ms-2">Orang</label>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">

					<label for="jenis" class="mb-2 col-3 pt-2 pb-2 me-4">Format Surat</label>

					<select id="jenis" class="form-select bg-light" name="jenis" required>
						<option value="">- Pilih</option>

						<option value="ANTAR DUSUN RT/RW DALAM SATU DESA/KELURAHAN" <?php echo ($jenis_pindah == "ANTAR DUSUN RT/RW DALAM SATU DESA/KELURAHAN") ? "selected" : "" ?> >ANTAR DUSUN, RT/RW DALAM SATU DESA/KELURAHAN</option>

						<option value="ANTAR KECAMATAN DALAM SATU KABUPATEN/KOTA" <?php echo ($jenis_pindah == "ANTAR KECAMATAN DALAM SATU KABUPATEN/KOTA") ? "selected" : "" ?> >ANTAR KECAMATAN DALAM SATU KABUPATEN/KOTA</option>

						<option value="ANTAR KABUPATEN/KOTA DALAM SATU PROVINSI" <?php echo ($jenis_pindah == "ANTAR KABUPATEN/KOTA DALAM SATU PROVINSI") ? "selected" : "" ?> >ANTAR KABUPATEN/KOTA DALAM SATU PROVINSI</option>

						<option value="ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI" <?php echo ($jenis_pindah == "ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI") ? "selected" : "" ?> >ANTAR KABUPATEN/KOTA ATAU ANTAR PROVINSI</option>

					</select>
				</div>

				<div class="form-goup mb-1 d-flex align-items-center">
					<label class="col-3">Data Kepala Desa</label>
					<div class="form-check">
						<input type="checkbox" class="form-check-input ms-1" value="update" name="update_kepdes">
						<label class="form-check-label ms-2">Update</label>
					</div>
				</div>

				<div>
					<label class="mb-2 col-3 me-4">Bantuan &nbsp<?php $j_surat = "pindah"; require('komponen/modal-bantuan.php'); ?></label>
				</div>
			</div>
		</div>

		<input type="submit" name="submit" value="Edit Surat" class="btn btn-outline-dark col-2 ms-3 mt-3">
		<button class="btn col-2 mt-3 ms-3">
			<a class="btn btn-outline-danger py-1 px-5 text-decoration-none rounded" style="font-size: 17px;" href="register-surat.php">Kembali</a>
		</button>
	</form>
</div>