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
	<title>Pejabat Desa</title>
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
						<h4 class="fw-bolder mb-3">Pejabat Desa</h4>
						<?php require('komponen/modal-tambah-pejabat.php');?>
						<table class="table table-striped table-bordered responsive-utilities text-center">
							<thead>
								<tr>
									<th scope="col">No</th>
									<th scope="col" style="min-width:200px;">Nama</th>
									<th scope="col" style="min-width:150px;">Jabatan</th>
									<th scope="col" style="min-width:100px;">Status</th>
									<th scope="col" style="min-width:80px;">Aksi</th>
								</tr>
							</thead>

							<tbody>
								<?php
								$query= "SELECT * FROM tb_pejabat ORDER BY jabatan ASC";
								$result=mysqli_query($db, $query);
								// foreach
								$i=1;
								foreach ($result as $pejabat) { 
								$id_pejabat = $pejabat['id_pejabat'];
								?>
								<tr>
									<td><?php echo $i++?></td>
									<td class="text-uppercase"><?php echo $pejabat['nama']?></td>
									<td class="text-uppercase"><?php echo $pejabat['jabatan']?></td>
									<td class="text-uppercase"><?php echo $pejabat['status']?></td>
									<td class="fs-6">
									<?php require('komponen/modal-edit-pejabat.php'); ?>
										<a class="text-decoration-none fs-6 bg-danger bg-gradient text-white py-1 px-2 rounded-end" href="action/action-pejabat.php?id_pejabat=<?php echo $pejabat['id_pejabat']?>&opsi=delete" onclick="return confirm_delete()">
											<i class="fa fa-trash-alt"></i>
										</a>
									</td>
								</tr>
								<?php } ?>
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
<?php require('config/script.php'); ?>
<script type="text/javascript">	
// konfirmasi hapus
function confirm_delete(){
	return confirm("Anda Yakin Menghapus Data ini?");
}
</script>