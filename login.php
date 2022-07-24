<?php
require_once('cek-login.php');

// filter error ketika $_GET['error'] tidak ada
if (empty($_GET['error'])) { $_GET['error']=""; }

// filter sudah login atau belum
if ($sessionStatus==true) { ?>
	<script type='text/javascript'>
		alert('Anda Sudah Login Dengan User <?php echo ucwords($sessionNama)?>');
		window.location.href="index.php";
	</script>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Login</title>
	<?php require('config/style.php'); ?>
</head>
<body style="background-image: url('assets/img/login.jpg'); background-size: cover;">
	<div id="login" class="d-flex flex-column justify-content-center align-items-center">

		<div class="box col-3 bg-white shadow rounded px-4 py-4 pb-5">
			<!-- logo -->
			<div id="logo" class="text-center">
				<img src="assets/img/logo/logo.png" alt="">
				<h5 class="mt-1 mb-4 fw-bolder">SIPESDES BANTAL</h5>
			</div>
			
			<form action="action/action-login.php" method="POST">

				<div class="input-group">
					<span class="input-group-text" id="basic-addon1">@</span>
					<input name="email" id="email" type="email" class="form-control bg-light <?php echo ($_GET['error']=="email") ? "is-invalid" : "" ?>" placeholder="Email" value="<?php echo (isset($_GET['email'])) ? $_GET['email'] : "" ?>" required>
				</div>
				<!-- pesan error -->
				<?php if($_GET['error']=="email") : ?>
					<div class="p-1 fst-italic" style="font-size:11px; color:#FF3F3F;">
						*Email Belum Terdaftar
					</div>
				<?php endif; ?>

				<div class="input-group mt-2">
					<span class="input-group-text" id="basic-addon1">🔒︎</span>
					
					<input name="password" id="password" type="password" class="form-control bg-light <?php echo ($_GET['error']=="password") ? "is-invalid" : "" ?>" placeholder="Password" required>
				</div>
				<!-- pesan error -->
				<?php if($_GET['error']=="password") : ?>
					<div class="p-1 fst-italic" style="font-size:11px; color:#FF3F3F;">
						*Password Salah
					</div>
				<?php endif; ?>

				<div class="d-flex justify-content-center">
					<input name="submit" type="submit" value="Login" class="col-12 btn btn-info text-white mt-4">
				</div>
			</form>
		</div>
	</div>
</body>
</html>