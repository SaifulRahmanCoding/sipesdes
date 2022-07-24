  <!-- Button trigger modal -->
  <button type="button" class="btn btn-success text-white mb-3" data-bs-toggle="modal" data-bs-target="#TambahPejabat">
    <p class="m-0" style="font-size:14px;">Tambah Data</p>
  </button>

  <!-- form -->
  <form action="action/action-pejabat.php?opsi=input" method="POST">
  <!-- Modal -->
  <div class="modal fade" id="TambahPejabat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TambahPejabatLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <!-- header -->
        <div class="modal-header">
          <h5 class="modal-title fw-bolder" id="TambahPejabatLabel">Form Tambah Data Pejabat</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- end header -->

          <div class="modal-body ps-4">

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

              <input name="nama" id="nama"  class="form-control bg-light" type="text" required>
            </div>


            <div class="form-group mb-1 d-flex align-items-center">
              <label for="jabatan" class="mb-2 col-3 pt-2 pb-2">Jabatan</label>

              <select id="jabatan" class="form-select bg-light" name="jabatan" required>
                <option value="">- Pilih Jabatan</option>
                <option value="Kepala Desa">Kepala Desa</option>
                <option value="Sekertaris Desa">Sekertaris Desa</option>
              </select>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="status" class="mb-2 col-3 pt-2 pb-2">Status</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" value="aktif" id="aktif" name="status" required>
                <label for="aktif" class="form-check-label me-3">Aktif</label>
              </div>
              <div class="form-check disabled">
                <input type="radio" class="form-check-input" value="non-aktif" id="non-aktif" name="status" required>
                <label for="non-aktif" class="form-check-label">Non-Aktif</label>
              </div>
            </div>
            
          </div>
          <!-- end modal body -->

          <!-- footer -->
          <div class="modal-footer justify-content-center">
            <input type="submit" name="submit" value="Simpan" class="btn btn-dark text-white col-11 p-2">
          </div>
          <!-- end footer -->
      </div>
    </div>
  </div>
  <!-- end modal -->
  </form>
  <!-- end form -->