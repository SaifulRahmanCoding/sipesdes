<?php
// query panggil data
$query = "SELECT * FROM tb_register_surat INNER JOIN sku ON tb_register_surat.no_surat = sku.no_surat WHERE tb_register_surat.no_surat='$no_surat'";
$result = mysqli_query($db, $query);

// definisikan data
foreach ($result as $sku) {
	$tgl_surat = $sku['tgl_surat'];
	$nama = $sku['nama'];
	$dusun = $sku['dusun'];
	$rt = $sku['rt'];
	$rw = $sku['rw'];
	$tmpt_lahir = $sku['tmpt_lahir'];
	$tgl_lahir = $sku['tgl_lahir'];
	$jk = $sku['jk'];
	$agama = $sku['agama'];
	$wn = $sku['wn'];
	$nik = $sku['nik'];
	$nikah=$sku['nikah'];
	$id_pejabat=$sku['id_pejabat'];
	$pekerjaan = $sku['pekerjaan'];
	$keperluan = $sku['keperluan'];
	$keterangan = $sku['keterangan'];
	$jenis_sku = $sku['jenis_sku'];
}
?>
<div class="wrap shadow-sm p-3 mt-3">
	<form action="action/action-sku.php?opsi=update" method="POST">
		<div class="row ps-3">
			<!-- kiri -->
			<div class="col-5 me-5">
				<input name="id_pejabat" id="id_pejabat"  class="form-control bg-light" type="text" value="<?php echo $id_pejabat;?>" hidden required>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="no_surat" class="mb-2 col-3 pt-2 pb-2">No Surat</label>

					<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat;?>" disabled required>
					<input name="no_surat" id="no_surat"  class="form-control bg-light" type="text" value="<?php echo $no_surat;?>" hidden required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK</label>

					<input name="nik" id="nik"  class="form-control bg-light" type="text" value="<?php echo $nik ?>" onkeypress="return hanyaAngka(event)" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

					<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $nama;?>" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="dusun" class="mb-2 col-3 pt-2 pb-2">Dusun</label>

					<select id="dusun" class="form-select bg-light" name="dusun" required>
						<option value="Utara" <?php echo ($dusun=="Utara") ? "selected" : "" ?> >Utara</option>
						<option value="Tenggara" <?php echo ($dusun=="Tenggara") ? "selected" : "" ?> >Tenggara</option>
						<option value="Selatan" <?php echo ($dusun=="Selatan") ? "selected" : "" ?> >Selatan</option>
					</select>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="rt" class="mb-2 col-3 pt-2 pb-2">RT</label>

					<input name="rt" id="rt"  class="form-control bg-light" type="text" value="<?php echo $rt;?>" onkeypress="return hanyaAngka(event)" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="rw" class="mb-2 col-3 pt-2 pb-2">RW</label>

					<input name="rw" id="rw"  class="form-control bg-light" type="text" value="<?php echo $rw;?>" onkeypress="return hanyaAngka(event)" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="pekerjaan" class="mb-2 col-3 pt-2 pb-2">Pekerjaan</label>

					<input name="pekerjaan" id="pekerjaan"  class="form-control bg-light" type="text" value="<?php echo $pekerjaan;?>" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="agama" class="mb-2 col-3 pt-2 pb-2 ">Agama</label>

					<select id="agama" class="form-select bg-light" name="agama" required>

						<option value="Islam" <?php echo ($agama == "Islam") ? "selected" : "" ?> >Islam</option>
						<option value="Kristen" <?php echo ($agama == "Kristen") ? "selected" : "" ?> >Kristen</option>
						<option value="Katholik" <?php echo ($agama == "Katholik") ? "selected" : "" ?> >Katholik</option>
						<option value="Hindu" <?php echo ($agama == "Hindu") ? "selected" : "" ?> >Hindu</option>
						<option value="Budha" <?php echo ($agama == "Budha") ? "selected" : "" ?> >Budha</option>
						<option value="Khonghucu" <?php echo ($agama == "Khonghucu") ? "selected" : "" ?> >Khonghucu</option>
						<option value="Kepercaya an" <?php echo ($agama == "Kepercaya an") ? "selected" : "" ?> >Kepercaya an</option>

					</select>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="tmpt_lahir" class="mb-2 col-3 pt-2 pb-2">Tempat Lahir</label>

					<input name="tmpt_lahir" id="tmpt_lahir"  class="form-control bg-light" type="text" value="<?php echo $tmpt_lahir;?>" required>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="tgl_lahir" class="mb-2 col-3 pt-2 pb-2">Tgl Lahir</label>

					<input name="tgl_lahir" id="tgl_lahir"  class="form-control bg-light" type="date" value="<?php echo $tgl_lahir;?>" required>
				</div>

			</div>

			<!-- kanan -->
			<div class="col-6">

				<div class="form-group mb-1 d-flex align-items-center">
					<label for="wn" class="mb-2 col-3 pt-2 pb-2 me-4">Warga Negara</label>

					<input name="wn" id="wn"  class="form-control bg-light" type="text" value="<?php echo $wn ?>" required>
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
					<label for="bidangUsaha" class="col-3 pt-3 pb-3 me-4">Bidang Usaha</label>

					<select id="bidangUsaha" class="form-select bg-light" name="bidangUsaha" required>
						<option value="">- Pilih</option>
						<option value="pertanian" <?php echo ($jenis_sku == "pertanian") ? "selected" : "" ?> >PERTANIAN</option>
						<option value="peternakan" <?php echo ($jenis_sku == "peternakan") ? "selected" : "" ?> >PETERNAKAN</option>
						<option value="perdagangan" <?php echo ($jenis_sku == "perdagangan") ? "selected" : "" ?> >PERDAGANGAN</option>

					</select>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">

					<label for="keterangan" class="mb-2 col-3 pt-4 pb-4 me-4">Keterangan</label>

					<textarea class="form-control bg-light" id="keterangan" name="keterangan"><?php echo $keterangan ?></textarea>
				</div>

				<div class="form-group mb-1 d-flex align-items-center">

					<label for="keperluan" class="mb-2 col-3 pt-4 pb-4 me-4">Keperluan </label>

					<textarea class="form-control bg-light" id="keperluan" name="keperluan"><?php echo $keperluan ?></textarea>
				</div>

				<div class="form-goup mb-1 d-flex align-items-center">
					<label class="col-3">Data Kepala Desa</label>
					<div class="form-check">
						<input type="checkbox" class="form-check-input ms-1" value="update" name="update_kepdes">
						<label class="form-check-label ms-2">Update</label>
					</div>
				</div>

				<div>
					<label for="keperluan" class="mb-2 col-3 me-4">Bantuan &nbsp<?php $j_surat = "sku"; require('komponen/modal-bantuan.php'); ?></label>
				</div>

			</div>
		</div>

		<input type="submit" name="submit" value="Edit Surat" class="btn btn-outline-dark col-2 ms-3 mt-3">
		<button class="btn col-2 mt-3 ms-3">
			<a class="btn btn-outline-danger py-1 px-5 text-decoration-none rounded" style="font-size: 17px;" href="register-surat.php">Kembali</a>
		</button>
	</form>
</div>