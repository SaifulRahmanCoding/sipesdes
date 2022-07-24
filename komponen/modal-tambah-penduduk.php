  <!-- Button trigger modal -->
  <button type="button" class="btn btn-success text-white mb-3" data-bs-toggle="modal" data-bs-target="#TambahPenduduk">
    <p class="m-0" style="font-size:14px;">Tambah Data</p>
  </button>

  <!-- form -->
  <form action="action/action-penduduk.php?opsi=input" method="POST">
  <!-- Modal -->
  <div class="modal fade" id="TambahPenduduk" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="TambahPendudukLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <!-- header -->
        <div class="modal-header">
          <h5 class="modal-title fw-bolder" id="TambahPendudukLabel">Form Tambah Data Penduduk</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- end header -->

          <div class="modal-body ps-4">

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="no_kk" class="mb-2 col-3 pt-2 pb-2">Nomor KK</label>

              <input name="no_kk" id="no_kk" class="form-control bg-light" type="text" onkeypress="return hanyaAngka(event)" maxlength="20">
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="nama" class="mb-2 col-3 pt-2 pb-2">Nama</label>

              <input name="nama" id="nama" class="form-control bg-light" type="text" required>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="nik" class="mb-2 col-3 pt-2 pb-2">NIK</label>

              <input name="nik" id="nik" class="form-control bg-light" type="text" onkeypress="return hanyaAngka(event)" maxlength="20" required>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="dusun" class="mb-2 col-3 pt-2 pb-2">Dusun</label>

              <select id="dusun" class="form-select bg-light" name="dusun" required>
                <option value="">- Pilih Dusun</option>
                <option value="UTARA">UTARA</option>
                <option value="TENGGARA">TENGGARA</option>
                <option value="SELATAN">SELATAN</option>
              </select>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="rt" class="mb-2 col-3 pt-2 pb-2">RT</label>

              <input name="rt" id="rt" class="form-control bg-light" type="text" onkeypress="return hanyaAngka(event)" maxlength="3" required>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="rw" class="mb-2 col-3 pt-2 pb-2">RW</label>

              <input name="rw" id="rw" class="form-control bg-light" onkeypress="return hanyaAngka(event)" type="text" maxlength="3" required>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="tmpt_lahir" class="mb-2 col-3 pt-2 pb-2">Tempat Lahir</label>

              <input name="tmpt_lahir" id="tmpt_lahir" class="form-control bg-light" type="text" required>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="tgl_lahir" class="mb-2 col-3 pt-2 pb-2">Tanggal Lahir</label>

              <input name="tgl_lahir" id="tgl_lahir" class="form-control bg-light" type="date" required>
            </div>


            <div class="form-group mb-1 d-flex align-items-center">
              <label for="jk" class="mb-2 col-3 pt-2 pb-2">Jenis Kelamin</label>
              <div class="form-check">
                <input type="radio" class="form-check-input" value="L" id="laki-laki" name="jk" required>
                <label for="laki-laki" class="form-check-label me-3">Laki-Laki</label>
              </div>
              <div class="form-check disabled">
                <input type="radio" class="form-check-input" value="P" id="perempuan" name="jk" required>
                <label for="perempuan" class="form-check-label">Perempuan</label>
              </div>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">

              <label for="shdk" class="mb-2 col-3 pt-2 pb-2">SHDK</label>

              <select id="shdk" class="form-select bg-light" name="shdk" required>
                <option value="">- Pilih</option>
                <option value="KEPALA KELUARGA">KEPALA KELUARGA</option>
                <option value="ISTRI">ISTRI</option>
                <option value="ANAK">ANAK</option>
                <option value="CUCU">CUCU</option>
                <option value="ORANG TUA">ORANG TUA</option>
                <option value="MERTUA">MERTUA</option>
                <option value="MENANTU">MENANTU</option>
                <option value="FAMILI LAIN">FAMILI LAIN</option>
                <option value="LAINNYA">LAIN-NYA</option>

              </select>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="nikah" class="mb-2 col-3 pt-2 pb-2">Status Nikah</label>

              <select id="nikah" class="form-select bg-light" name="nikah" required>
                <option value="-"> - Pilih</option>
                <option value="BELUM KAWIN">BELUM KAWIN</option>
                <option value="KAWIN">KAWIN</option>
                <option value="CERAI MATI">CERAI MATI</option>
                <option value="CERAI HIDUP">CERAI HIDUP</option>
              </select>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="agama" class="mb-2 col-3 pt-2 pb-2">Agama</label>

              <select id="agama" class="form-select bg-light" name="agama" required>
                <option value="">- Pilih Agama</option>
                <option value="ISLAM">ISLAM</option>
                <option value="KRISTEN">KRISTEN</option>
                <option value="KATHOLIK">KATHOLIK</option>
                <option value="HINDU">HINDU</option>
                <option value="BUDHA">BUDHA</option>
                <option value="KHONGHUCU">KHONGHUCU</option>
                <option value="KEPERCAYA AN">KEPERCAYA AN</option>

              </select>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="pekerjaan" class="mb-2 col-3 pt-2 pb-2">Pekerjaan</label>

              <input name="pekerjaan" id="pekerjaan" class="form-control bg-light" type="text" required>
            </div>

            <div class="form-group mb-1 d-flex align-items-center">
              <label for="pendidikan" class="mb-2 col-3 pt-2 pb-2">Pendidikan</label>

              <select id="pendidikan" class="form-select bg-light" name="pendidikan" required>
                <option value="">- Pilih Pendidikan</option>
                <option value="TIDAK/BELUM SEKOLAH">TIDAK/BELUM SEKOLAH</option>
                <option value="BELUM TAMAT SD/SEDERAJAT">BELUM TAMAT SD/SEDERAJAT</option>
                <option value="TAMAT SD/SEDERAJAT">TAMAT SD/SEDERAJAT</option>
                <option value="SLTP/SEDERAJAT">SLTP/SEDERAJAT</option>
                <option value="SLTA/SEDERAJAT">SLTA/SEDERAJAT</option>
                <option value="DIPLOMA I/II">DIPLOMA I/II</option>
                <option value="DIPLOMA III">DIPLOMA III</option>
                <option value="DIPLOMA IV/STRATA I">DIPLOMA IV/STRATA I</option>
                <option value="AKADEMI/DIPLOMA III/SARJANA MUDA">AKADEMI/DIPLOMA III/SARJANA MUDA</option>
                <option value="STRATA-II">STRATA-II</option>
                <option value="STRATA-III">STRATA-III</option>
              </select>

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