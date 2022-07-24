<!-- Modal pass -->
<div class="modal fade" id="EditUser<?php echo $akun['id_user']?>Dua" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditUser<?php echo $akun['id_user']?>Label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<!-- form -->
			<form action="action/action-user.php?opsi=updatePass" method="POST">
				<!-- header -->
				<div class="modal-header">
					<h5 class="modal-title fw-bolder" id="EditUser<?php echo $akun['id_user']?>Label">Form Ubah Password</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<!-- modadl body -->
				<div class="modal-body ps-4">
					<!-- id -->
					<input name="id" id="id"  class="form-control bg-light" type="number" value="<?php echo $akun['id_user'];?>" hidden required>

					<div class="form-group mb-1 d-flex align-items-center">
						<label for="pass_lama" class="mb-2 col-3 pt-2 pb-2 text-start">Password Lama</label>

						<input name="pass_lama" id="pass_lama"  class="form-control bg-light" type="text" placeholder="Ketik Password Lama" required>
					</div>

					<div class="form-group mb-1 d-flex align-items-center">
						<label for="pass_baru" class="mb-2 col-3 pt-2 pb-2 text-start">Password Baru</label>

						<input name="pass_baru" id="pass_baru"  class="form-control bg-light" type="text" placeholder="Ketik Password Baru" required>
					</div>
				</div>
				<!-- end modal -->

				<!-- footer -->
				<div class="modal-footer justify-content-center">
					<input type="submit" name="submit" value="Ubah Password" class="btn btn-dark text-white col-11 p-2 mb-3">

					<!-- button ubah password -->
					 <a class="" data-bs-target="#EditUser<?php echo $akun['id_user']?>" data-bs-toggle="modal" data-bs-dismiss="modal" style="cursor: pointer;">Kembali</a>
				</div>
				<!-- end footer -->

			</form>
		</div>
	</div>
</div>