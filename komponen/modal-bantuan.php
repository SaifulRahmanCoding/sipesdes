<?php
if ($j_surat == "sktm") {
	$bantuan = "<p><b> Keperluan :</b> Untuk Persyaratan Menyicil Uang UKT di Universitas Jember.</p>";
}elseif($j_surat == "sku"){
	$bantuan = "<p><b>Keterangan :</b> Tersebut diatas mempunyai Usaha dibidang Pertanian yaitu, Petani Tebu.</p> <p><b>Keperluan :</b> Untuk Persyaratan Permohonan Kredit Usaha.</p>";
}elseif ($j_surat == "skkb_skck") {
	$bantuan = "<p><b>Keperluan : </b>Persyaratan Melamar Pekerjaan.</p>";
}elseif ($j_surat = "pindah") {
	$bantuan = "<p><b>Contoh Pindah Dusun/ Desa Dalam Satu Desa/ Kelurahan/ Kecamatan : </b></p>
	<ul>
	<li>Kampung Tenggara, RT-008 / RW-002 Desa Bantal, Kecamatan Asembagus Kode Pos 68373, Kabupaten Situbondo, Provinsi Jawa Timur.</li>
	<li>Kampung Cerpat, RT-001 / RW-004 Desa Kedunglo, Kecamatan Asembagus Kode Pos 68373, Kabupaten Situbondo, Provinsi Jawa Timur.</li>
	</ul>
	<p><b>Contoh Pindah Antar Kecamatan Dalam Satu Kabupaten : </b></p>
	<ul>
	<li>Kampung Olean Krajan RT-005 / RW-003 Desa Olean Kecamatan Situbondo Kode Pos 68316, Kabupaten Situbondo, Provinsi Jawa Timur.</li>
	</ul>
	<p><b>Contoh Pindah Kabupaten,Kota Dalam Satu Provinsi  : </b></p>
	<ul>
	<li>Dusun Sukorejo  RT 023/RW 006 , Desa Sukorejo, Kecamatan Sumber Wringin  Kode Pos 68289, Kabupaten Bondowoso, Provinsi Jawa Timur.</li>
	</ul>
	<p><b>Contoh Pindah Kabupaten,Kota Atau Provinsi  : </b></p>
	<ul>
	<li>Br. Merta Gangga Desa Ubung Kaja Kecamatan Denpasar Utara Kode Pos 80116,  Kota Denpasar, Provinsi Bali.</li>
	</ul>
	";
}
?>

<a class="card-text text-decoration-none fs-6" data-bs-toggle="modal" data-target="#Bantuan" href="#Bantuan" role="button"><i class="far fa-question-circle"></i></a>

<!-- Modal -->
<div class="modal fade" id="Bantuan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="BantuanLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title fw-bolder" id="BantuanLabel">Contoh</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<?php echo $bantuan; ?>
			</div>
		</div>
	</div>
</div>
