<!-- Button trigger modal -->
<a class="text-decoration-none fs-6 bg-success bg-gradient text-white py-1 ps-2 pe-1 rounded-start" data-bs-toggle="modal" data-target="#EditUser<?php echo $akun['id_user']?>" href="#EditUser<?php echo $akun['id_user']?>" role="button"><i class="fas fa-edit"></i></a>
<!-- Modal -->
<div class="modal fade" id="EditUser<?php echo $akun['id_user']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditUser<?php echo $akun['id_user']?>Label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<!-- form -->
			<form action="action/action-user.php?opsi=update" method="POST">

				<!-- header -->
				<div class="modal-header">
					<h5 class="modal-title fw-bolder" id="EditUser<?php echo $akun['id_user']?>Label">Form Edit Data User</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<!-- end header -->

				<div class="modal-body ps-4">
					<!-- id -->
					<input name="id" id="id"  class="form-control bg-light" type="number" value="<?php echo $akun['id_user'];?>" hidden required>

					<div class="form-group mb-1 d-flex align-items-center">
						<label for="nama" class="mb-2 col-3 pt-2 pb-2 text-start">Nama</label>

						<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $akun['nama'];?>" required>
					</div>

					<div class="form-group mb-1 d-flex align-items-center">
						<label for="email" class="mb-2 col-3 pt-2 pb-2 text-start">Email</label>

						<input name="email" id="email"  class="form-control bg-light" type="text" value="<?php echo $akun['email'];?>" required>
					</div>

				</div>
				<!-- end modal body -->

				<!-- footer -->
				<div class="modal-footer justify-content-center">
					<input type="submit" name="submit" value="Edit Data" class="btn btn-dark text-white col-11 p-2 mb-3">

					<!-- button ubah password -->
					 <a class="" data-bs-target="#EditUser<?php echo $akun['id_user']?>Dua" data-bs-toggle="modal" data-bs-dismiss="modal" style="cursor: pointer;">Ubah Password</a>
				</div>
				<!-- end footer -->

			</form>
			<!-- end form -->
		</div>
	</div>
</div>
<?php require('komponen/micro-edit-pass.php'); ?>