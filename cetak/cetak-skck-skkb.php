<?php

$query = "SELECT tb_register_surat.*,skck_skkb.*,tb_pejabat.nama as namaKepdes FROM tb_register_surat INNER JOIN skck_skkb ON tb_register_surat.no_surat = skck_skkb.no_surat INNER JOIN tb_pejabat ON tb_register_surat.id_pejabat = tb_pejabat.id_pejabat WHERE tb_register_surat.no_surat='$no_surat'";
$result = mysqli_query($db, $query);

// definisikan data
foreach ($result as $skck_skkb) {
	$tgl_surat = $skck_skkb['tgl_surat'];
	$nama = $skck_skkb['nama'];
	$dusun = $skck_skkb['dusun'];
	$rt = $skck_skkb['rt'];
	$rw = $skck_skkb['rw'];
	$tmpt_lahir = $skck_skkb['tmpt_lahir'];
	$tgl_lahir = $skck_skkb['tgl_lahir'];
	$jk = $skck_skkb['jk'];
	$agama = $skck_skkb['agama'];
	$wn = $skck_skkb['wn'];
	$nik = $skck_skkb['nik'];
	$nikah=$skck_skkb['nikah'];
	$id_pejabat=$skck_skkb['id_pejabat'];
	$pekerjaan = $skck_skkb['pekerjaan'];
	$keperluan = $skck_skkb['keperluan'];
	$jenis_surat = $skck_skkb['jenis_surat'];
	$namaKepdes = $skck_skkb['namaKepdes'];
}

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');
// panggil data kode surat
$query = "SELECT * FROM kode_surat";
$r_kode = mysqli_query($db,$query);;
$kode= mysqli_fetch_assoc($r_kode);
$kodeIndex = $kode['kode_index'];
$kodeSurat = $kode['skck_skkb'];
// offline
define('FPDF_FONTPATH','C:\xampp\htdocs\sipesdes\library\fpdf\font');
// online
// define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
// include fpdf
require('../library/fpdf/WriteTag.php');

$pdf = new PDF_WriteTag('P','mm',array(215.5,330));
$pdf->SetMargins(25,15,20,20);
$pdf->AddFont('bookman','','bookman-old-style.php');
$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
$pdf->AddPage();
// Stylesheet
$pdf->SetStyle("p","times","N",12.5,"0,0,0",12.5);
$pdf->SetStyle("p2","times","N",12.2,"0,0,0",12.5);
$pdf->SetStyle("p3","times","N",12.5,"0,0,0",0);
$pdf->SetStyle("b","times","B",0,"0,0,0");
// meletakkan gambar
$pdf->Image('../assets/img/logo/logo-kop.png',37,15.7,19.1,24.6);
// juudul
$pdf->Cell(22);
$pdf->SetFont('bookman','B',16);
$pdf->Cell(0,6.8,'PEMERINTAH KABUPATEN SITUBONDO',0,1,'C');
$pdf->Cell(22);
$pdf->Cell(0,6.8,'KECAMATAN ASEMBAGUS',0,1,'C');
$pdf->Cell(22);
$pdf->SetFont('bookman','B',18);
$pdf->Cell(0,6.8,'KANTOR KEPALA DESA BANTAL',0,1,'C');
$pdf->Cell(22);
$pdf->SetFont('bookman','',12);
$pdf->Cell(0,6.8,'Jalan Samir Nomor 10 Telepon Nomor 082301186497',0,1,'C');

// garis kop
$pdf->SetLineWidth(1);
$pdf->Line(25,44,195,44);
$pdf->SetLineWidth(0);
$pdf->Line(25,45,195,45);

// jenis surat dan nomor surat
$pdf->SetFont('Times','B',12.5);
$pdf->Ln(14);
$pdf->Cell(0,1,$jenis_surat,0,1,'C');

if ($jenis == "SKCK") {
	$pdf->SetLineWidth(0.4);
	$pdf->Line(60,59.5,160.3,59.5);
}elseif ($jenis == "SKKB") {
	$pdf->SetLineWidth(0.4);
	$pdf->Line(66.5,59.5,154,59.5);
}

$pdf->SetFont('Times','B',12.5);
$pdf->Ln(6);
$tgl_surat_array = explode('-', $tgl_surat);
$tahun_surat = $tgl_surat_array[0];
$pdf->Cell(0,0,"Nomor: $kodeSurat/$no_surat/$kodeIndex/$tahun_surat",0,1,'C');

// isi
$pdf->Ln(10);
$pdf->SetFont('Times','',12.5);
$pdf->WriteTag(0,7,"<p>Bersama ini kami Petinggi Bantal, Kecamatan Asembagus, Kabupaten Situbondo, menerangkan dengan sebenarnya bahwa: </p>",0,'J');

$pdf->Ln(2);
$pdf->Cell(4);
$pdf->Cell(40,7,'Nama',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(0,7,$nama,0,1,'L');

$pdf->Cell(4);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(40,7,'Jenis Kelamin',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$jk,0,1,'L');

$pdf->Cell(4);
$pdf->Cell(40,7,'Tempat, tgl.Lahir',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$tgl_lahir_baru = ubahTanggal($tgl_lahir);
$pdf->Cell(0,7,"$tmpt_lahir, $tgl_lahir_baru",0,1,'L');

$pdf->Cell(4);
$pdf->Cell(40,7,'Kewarganegaraan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$wn,0,1,'L');

$pdf->Cell(4);
$pdf->Cell(40,7,'Agama',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$agama,0,1,'L');

$pdf->Cell(4);
$pdf->Cell(40,7,'Pekerjaan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$pekerjaan,0,1,'L');

$pdf->Cell(4);
$pdf->Cell(40,7,'Status Perkawinan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$nikah,0,1,'L');

$pdf->Cell(4);
$pdf->Cell(40,7,'NIK',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$nik,0,1,'L');

$pdf->Cell(4);
$pdf->Cell(40,7,'Alamat',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung $dusun, RT $rt / RW $rw, Desa Bantal, Kecamatan Asembagus, Kabupaten Situbondo.",0,'J');

$pdf->Ln(2);
$pdf->WriteTag(0,7,"<p2>Benar-benar penduduk Desa Bantal, Kecamatan Asembagus, Kabupaten Situbondo, selanjutnya berdasarkan Penelitian dan pengamatan kami yang bersangkutan tidak pernah terlibat didalam:</p2>",0,"J",0,0);

$pdf->Ln(1);
$pdf->Cell(5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(0,7,'1. Tindak pidana umun',0,1,'L');
$pdf->Cell(5);
$pdf->Cell(0,7,'2. Tindak kejahatan narkoba dan lain-lain',0,1,'L');
$pdf->Cell(5);
$pdf->Cell(0,7,'3. Tindakan lain yang berurusan dengan Pihak Kepolisian',0,1,'L');
$pdf->WriteTag(0,7,"
	<p3>Keterangan tersebut digunakan untuk <b>$keperluan</b></p3>
	<p>Demikian surat keterangan ini dibuat dengan sebenarnya dan untuk digunakan sebagaimana mestinya.</p>"
	,0,"J",0,0);

// ttd
$pdf->Ln(8);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(120);
$tgl_surat_baru = ubahTanggal($tgl_surat);
$hari = $tgl_surat_baru[0];
$bulan = $tgl_surat_baru[1];
$tahun = $tgl_surat_baru[2];
$pdf->Cell(40,6,"Bantal, $tgl_surat_baru",0,1,'C');
$pdf->Cell(15);
$pdf->Cell(55,6,'Yang bersangkutan',0,0,'C');
$pdf->Cell(50);
$pdf->Cell(40,6,'Kepala Desa Bantal',0,0,'C');
$pdf->Ln(25);
$pdf->Cell(15);
$pdf->SetFont('Times','BU',12.5);
$pdf->Cell(55,6,strtoupper($nama),0,0,'C');
$pdf->Cell(50);
$pdf->Cell(40,6,strtoupper($namaKepdes),0,0,'C');

$pdf->Output();
?>