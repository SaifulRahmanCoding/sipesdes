<?php

$query = "SELECT tb_register_surat.*,pengantar_pindah.*,tb_pejabat.nama as namaKepdes FROM tb_register_surat INNER JOIN pengantar_pindah ON tb_register_surat.no_surat = pengantar_pindah.no_surat INNER JOIN tb_pejabat ON tb_register_surat.id_pejabat = tb_pejabat.id_pejabat WHERE tb_register_surat.no_surat='$no_surat'";
$result = mysqli_query($db, $query);

// definisikan data
foreach ($result as $pindah) {
	$tgl_surat = $pindah['tgl_surat'];
	$nama = $pindah['nama'];
	$dusun = $pindah['dusun'];
	$rt = $pindah['rt'];
	$rw = $pindah['rw'];
	$tmpt_lahir = $pindah['tmpt_lahir'];
	$tgl_lahir = $pindah['tgl_lahir'];
	$jk = $pindah['jk'];
	$agama = $pindah['agama'];
	$wn = $pindah['wn'];
	$nik = $pindah['nik'];
	$no_kk = $pindah['no_kk'];
	$kp_keluarga = $pindah['kp_keluarga'];
	$nikah = $pindah['nikah'];
	$jenis_pindah = $pindah['jenis_pindah'];
	$alamat_pindah = $pindah['alamat_pindah'];
	$jml_pindah = $pindah['jml_pindah'];
	$namaKepdes = $pindah['namaKepdes'];
}

// panggil data kode surat
$query = "SELECT * FROM kode_surat";
$r_kode = mysqli_query($db,$query);;
$kode= mysqli_fetch_assoc($r_kode);
$kodeIndex = $kode['kode_index'];
$kodeSurat = $kode['pengantar_pindah'];

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');
require('../library/terbilang.php');

if ($jenis_pindah == "ANTAR DUSUN RT/RW DALAM SATU DESA/KELURAHAN") {
	$judul_surat = "ANTAR DUSUN, RT/RW DALAM SATU DESA/KELURAHAN";
}else{
	$judul_surat = $jenis_pindah;
}
// offline
define('FPDF_FONTPATH','C:\xampp\htdocs\sipesdes\library\fpdf\font');
// online
// define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
require_once('../library/fpdf/WriteTag.php');

// penerapan objek
$pdf = new PDF_WriteTag('P','mm',array(215.5,330));
$pdf->SetMargins(25,15,20,20);
$pdf->AddFont('bookman','','bookman-old-style.php');
$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
$pdf->AddPage();

// Stylesheet
$pdf->SetStyle("p","times","N",12,"0,0,0",12.5);

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
$pdf->Ln(10);
$pdf->Cell(0,5,"SURAT PENGANTAR PINDAH",0,1,'C');
$pdf->SetFont('Times','BU',12.5);
$pdf->Cell(0,5,$judul_surat,0,1,'C');

$pdf->SetFont('Times','B',12.5);
$pdf->Ln(3);
$tgl_surat_array = explode('-', $tgl_surat);
$tahun_surat = $tgl_surat_array[0];
$pdf->Cell(0,0,"Nomor: $kodeSurat/$no_surat/$kodeIndex/$tahun_surat",0,1,'C');

$pdf->Ln(10);
$pdf->SetFont('Times','',12.5);
$pdf->WriteTag(0,7,"<p>Yang bertanda tangan di bawah ini, menerangkan Permohonan Pindah Penduduk WNI dengan data sebagai berikut :</p>",0,'J');

$pdf->Ln(1);
$pdf->Cell(5);
$pdf->Cell(6,7,'1.',0,0,'L');
$pdf->Cell(58,7,'NIK',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$nik,0,1,'L');

$pdf->Cell(5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(6,7,'2.',0,0,'L');
$pdf->Cell(58,7,'Nama Lengkap',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(0,7,$nama,0,1,'L');

$pdf->Cell(5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(6,7,'3.',0,0,'L');
$pdf->Cell(58,7,'Nomor Kartu Keluarga',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$no_kk,0,1,'L');

$pdf->Cell(5);
$pdf->Cell(6,7,'4.',0,0,'L');
$pdf->Cell(58,7,'Nama Kepala Keluarga',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(0,7,$kp_keluarga,0,1,'L');

$pdf->Cell(5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(6,7,'5.',0,0,'L');
$pdf->Cell(58,7,'Alamat Sekarang',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung $dusun, RT  $rt / RW $rw, Desa Bantal, Kecamatan Asembagus Kode Pos 68373, Kabupaten Situbondo, Provinsi Jawa Timur.",0,'J');
$pdf->Cell(5);
$pdf->Cell(6,7,'6.',0,0,'L');
$pdf->Cell(58,7,'Alamat Tujuan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,ucwords($alamat_pindah),0,'J');

$pdf->Cell(5);
$pdf->Cell(6,7,'7.',0,0,'L');
$pdf->Cell(58,7,'Jumlah Keluarga Yang Pindah',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,"$jml_pindah (".terbilang($jml_pindah).") Orang",0,1,'L');

$pdf->Ln(3);
$pdf->Cell(0,7,"Adapun Permohonan Pindah Penduduk WNI yang bersangkutan sebagaimana terlampir.",0,1,'L');

$pdf->WriteTag(0,7,"<p>Demikian Surat Pengantar Pindah ini dibuat agar digunakan sebagaimana mestinya.</p>",0,'J');

// ttd
$pdf->Ln(12.5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(30);
$pdf->Cell(78,6,'',0,0,'L');
$pdf->Cell(45,6,"Bantal,".ubahTanggal($tgl_surat)."",0,1,'C');
$pdf->Cell(30);
$pdf->Cell(78,6,'',0,0,'L');
$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');
$pdf->Ln(25);
$pdf->Cell(17);
$pdf->SetFont('Times','BU',12.5);
$pdf->Cell(91,6,'',0,0,'C');
$pdf->Cell(45,6,strtoupper($namaKepdes),0,1,'C');


$pdf->Ln(20);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(0,6,'Keterangan  :',0,0,'L');
$pdf->Ln(10);
$pdf->Cell(0,6,'Surat Pengantar ini dibawa oleh pemohon dan diarsipkan di Kecamatan',0,0,'L');

$pdf->Output();
?>