<div id="sidebar" class="fixed-top pb-5">
	<!-- head sidebar -->
	<div class="head-sidebar text-center d-flex ps-4 sticky-top bg-white">
		<div class="logo my-2">
			<img src="assets/img/logo/logo.png" alt="logo">
		</div>
		<div class="nama-aplikasi text-center d-flex align-items-center ms-3">
			<h1 class="fw-bolder m-0">SIPESDES BANTAL</h1>
		</div>
	</div>

	<!-- menu -->
	<div class="menu-sidebar mt-3">
		<ul class="nav flex-column" id="nav_accordion">

			<!-- level admin -->
			<li class="nav-item">
				<a class="nav-link" href="index.php"><i class="me-2 fa fa-tachometer-alt"></i> Dashboard </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="data-penduduk.php"><i class="me-2 far fa-address-card"></i> Data Penduduk </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="akun.php"><i class="me-2 fa fa-user"></i>&nbsp Akun </a>
			</li>
			<?php if ($sessionLevel=="admin") : ?>
			<li class="nav-item">
				<a class="nav-link" href="pejabat.php"><i class="me-2 fas fa-user-tie"></i>&nbsp Pejabat Desa </a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="kode-surat.php"><i class="me-2 far fa-file-alt"></i>&nbsp Kode Surat </a>
			</li>

			<!-- level petugas -->
			<?php elseif($sessionLevel=="petugas") : ?>
			<!-- accordion -->
			<div class="accordion accordion-flush col-12" id="accordionFlushExample">
				<div class="accordion-item">
					<span class="accordion-header" id="flush-headingSurat">
						<button class="accordion-button collapsed p-2 ps-4 pe-3 text-center" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSurat" aria-expanded="me-2 false" aria-controls="flush-collapseSurat">
							<i class="me-2 fa fa-mail-bulk"></i>&nbspBuat Surat
						</button>
					</span>
					<div id="flush-collapseSurat" class="accordion-collapse collapse" aria-labelledby="flush-headingSurat" data-bs-parent="#accordionFlushExample">
						<div class="accordion-body py-1 px-4">

							<ul class="list-unstyled">
								<li><a class="nav-link" href="form-permohonan-kk.php"><i class="me-2 far fa-circle"></i> Permohonan KK </a></li>
								<li><a class="nav-link" href="form-pindah.php"><i class="me-2 far fa-circle"></i> Pengantar Pindah </a></li>
								<li><a class="nav-link" href="form-skck-skkb.php"><i class="me-2 far fa-circle"></i> SKKB/ SKCK </a></li>
								<li><a class="nav-link" href="form-sku.php"><i class="me-2 far fa-circle"></i> Ket Usaha (SKU) </a></li>
								<li><a class="nav-link" href="form-sktm.php"><i class="me-2 far fa-circle"></i> SKTM </a> </li>
							</ul>

						</div>
					</div>
				</div>
			</div>
			<!-- end accordion -->
			<?php endif;

			if($sessionLevel=="admin" || $sessionLevel=="petugas") : ?>
			<li class="nav-item">
				<a class="nav-link" href="register-surat.php"><i class="me-2 far fa-envelope"></i> Register Surat </a>
			</li>
			<?php endif; ?>
		</ul>
	</div>
</div>
