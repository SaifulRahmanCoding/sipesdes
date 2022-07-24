<!-- button ubah password -->
<a class="text-decoration-none fs-6 bg-success bg-gradient text-white py-1 ps-2 pe-1 rounded-start" data-bs-target="#EditPejabat<?php echo $pejabat['id_pejabat']?>" data-bs-toggle="modal" data-bs-dismiss="modal" style="cursor: pointer;"><i class="fa fa-edit"></i></a>

<!-- Modal pass -->
<div class="modal fade" id="EditPejabat<?php echo $pejabat['id_pejabat']?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="EditPejabat<?php echo $pejabat['id_pejabat']?>Label" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<!-- form -->
			<form action="action/action-pejabat.php?opsi=update" method="POST">
				<!-- header -->
				<div class="modal-header">
					<h5 class="modal-title fw-bolder" id="EditPejabat<?php echo $pejabat['id_pejabat']?>Label">Edit Data Pejabat</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<!-- modadl body -->
				<div class="modal-body ps-4">
					<!-- id -->
					<input name="id" id="id"  class="form-control bg-light" type="number" value="<?php echo $pejabat['id_pejabat'];?>" hidden required>

					<div class="form-group mb-1 d-flex align-items-center">
						<label for="nama" class="mb-2 col-3 pt-2 pb-2 text-start">Nama</label>

						<input name="nama" id="nama"  class="form-control bg-light" type="text" value="<?php echo $pejabat['nama'];?>" required>
					</div>

					<div class="form-group mb-1 d-flex align-items-center">
						<label for="jabatan" class="mb-2 col-3 pt-2 pb-2 text-start">Jabatan</label>

						<select id="jabatan" class="form-select bg-light" name="jabatan" required>
							<option value="Kepala Desa" <?php echo ($pejabat['jabatan']=="Kepala Desa") ? "selected" : "" ?> >Kepala Desa</option>
							<option value="Sekertaris Desa" <?php echo ($pejabat['jabatan']=="Sekertaris Desa") ? "selected" : "" ?> >Sekertaris Desa</option>
						</select>
					</div>

					<div class="form-group mb-1 d-flex align-items-center">
						<label for="status" class="mb-2 col-3 pt-2 pb-2 text-start">Status</label>
						<div class="form-check">
							<input type="radio" class="form-check-input" value="aktif" id="aktif" name="status" <?php echo ($pejabat['status']=="aktif") ? "checked" : "" ?> required>
							<label for="aktif" class="form-check-label me-3">Aktif</label>
						</div>
						<div class="form-check disabled">
							<input type="radio" class="form-check-input" value="non-aktif" id="non-aktif" name="status" <?php echo ($pejabat['status']=="non-aktif") ? "checked" : "" ?> required>
							<label for="non-aktif" class="form-check-label">Non-Aktif</label>
						</div>
					</div>

				</div>
				<!-- end modal -->

				<!-- footer -->
				<div class="modal-footer justify-content-center">
					<input type="submit" name="submit" value="Edit Data" class="btn btn-dark text-white col-11 p-2 mb-3">

				</div>
				<!-- end footer -->

			</form>
		</div>
	</div>
</div>