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
	<title>Pengaturan User</title>
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
					<div class="wrap col table-responsive shadow-sm rounded p-3">
						<h4 class="fw-bolder">Pengaturan User</h4>
						<?php if ($sessionLevel == "admin"): ?>
							<a href="reg-akun.php" class="btn btn-success text-white mb-3 mt-2">Buat Akun</a>
						<?php endif ?>
						<table class="table table-striped table-bordered responsive-utilities text-center">
							<thead>
								<tr>
									<th scope="col" style="min-width:200px;">Nama</th>
									<th scope="col" style="min-width:150px;">Email</th>
									<th scope="col" style="min-width:150px;">Level</th>
									<th scope="col" style="min-width:100px;">Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								if ($sessionLevel == "admin"):

									$query= "SELECT * FROM tb_user";
									$result=mysqli_query($db, $query);
									// foreach
									foreach ($result as $akun) { 
										$id_user = $akun['id_user']; ?>
										<tr>
											<td class="text-uppercase"><?php echo $akun['nama']?></td>
											<td><?php echo $akun['email']?></td>
											<td class="text-uppercase"><?php echo $akun['level']?></td>
											<td class="fs-6">
												<?php
												require('komponen/modal-edit-user.php'); 
												if($sessionid!="$id_user") : ?>
													<a class="text-decoration-none fs-6 bg-danger bg-gradient text-white py-1 px-2 rounded-end" href="action/action-user.php?id_user=<?php echo $akun['id_user']?>&opsi=delete" onclick="return confirm_delete()">
														<i class="fa fa-trash-alt"></i>
													</a>
												<?php endif; ?>
											</td>
										</tr>
									<?php } 
								endif;

								if ($sessionLevel == "petugas"):
									$query= "SELECT * FROM tb_user WHERE id_user = $sessionid";
									$result=mysqli_query($db, $query);
									// foreach
									foreach ($result as $akun) { ?>
										<tr>
											<td class="text-uppercase"><?php echo $akun['nama']?></td>
											<td><?php echo $akun['email']?></td>
											<td class="text-uppercase"><?php echo $akun['level']?></td>
											<td class="fs-6">
												<?php require('komponen/modal-edit-user.php'); ?>
											</td>
										</tr>
									<?php } 
								endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end konten -->
	</div>
</body>
</html>
<?php 
require('config/script.php');


?>