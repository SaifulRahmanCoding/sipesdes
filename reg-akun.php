<!-- filter error ketika $_GET['error'] tidak ada -->
<?php if (empty($_GET['error'])) { $_GET['error']=""; } ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Registrasi User</title>
	<?php require('config/style.php'); ?>
</head>
<body style="background-image: url('assets/img/login.jpg'); background-size: cover;">
	<div id="registrasi" class="d-flex flex-column justify-content-center align-items-center">

		<div class="box col-3 bg-white shadow rounded px-4 py-4 pb-5">
			<!-- logo -->
			<div id="logo" class="text-center">
				<img src="assets/img/logo/logo.png" alt="">
				<h5 class="mt-1 mb-4 fw-bolder">SIPESDES BANTAL</h5>
			</div>

			<form action="action/action-user.php?opsi=input" method="POST">

				<div class="from-group mb-2">
					<input name="nama" id="nama" type="text" class="form-control bg-light" placeholder="Masukkan Nama" value="<?php echo (isset($_GET['nama'])) ? $_GET['nama'] : "" ?>" required>
				</div>

				<div class="from-group mb-2">
					<input name="email" id="email" type="email" class="form-control bg-light" placeholder="Masukkan Email" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>" required>
				</div>

				<div class="from-group mb-2">
					<input name="password" id="password" type="password" class="form-control bg-light" placeholder="Masukkan Password" required>
				</div>

				<div class="from-group mb-2">
					<input name="repassword" id="repassword" type="password" class="form-control bg-light" placeholder="Masukkan Ulang Password" <?php echo ($_GET['error']=="repassword") ? "style='background: #FDD4D4 !important;'" : "" ?> required>

					<!-- pesan error -->
					<?php if($_GET['error']=="repassword") : ?>
						<div class="p-1" style="font-size:11px; color:#FF3F3F;">
							*Password Yang Anda Masukkan Tidak Sama
						</div>
					<?php endif; ?>
				</div>

				<div class="from-group mb-2">

					<select id="level" class="form-select bg-light" name="level" required>
						<?php if(isset($_GET['level'])){ $_GET['level']=$_GET['level']; }else{ $_GET['level']="";} ?>

						<option value=""> - Pilih Level</option>
						<option value="admin" <?php echo ($_GET['level']=="admin") ? "selected" : "" ?> >ADMIN</option>
						<option value="petugas" <?php echo ($_GET['level']=="petugas") ? "selected" : "" ?> >PETUGAS</option>
					</select>
				</div>

				<div class="d-flex justify-content-center">
					<input name="submit" type="submit" value="Registrasi" class="col-12 btn btn-info text-white mt-2">
				</div>

			</form>
			<?php
			// cek nilai hasil ada/terbentuk atau tidak
			if (isset($_GET['hasil'])){ $_GET['hasil']=$_GET['hasil']; }else{ $_GET['hasil']=""; }

			if($_GET['hasil']=="sukses") : ?>
				<div class="mt-2">
					<p class="m-0 p-2 text-center col-12" style="background: #85FF99; color: #00B305; font-size: 14px;">Registrasi <?php echo $_GET['emaildone']?> Berhasil</p>
				</div>
			<?php endif; ?>

			<div class="opsi-login mt-4 text-center">
				<p class="mb-0">---  jika sudah memiliki akun silahkan login ---</p>
				<a href="login.php">Login</a>
			</div>

		</div>

	</div>
</body>
</html>