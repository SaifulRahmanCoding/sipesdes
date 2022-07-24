<?php

$query = "SELECT tb_register_surat.*,sku.*,tb_pejabat.nama as namaKepdes FROM tb_register_surat INNER JOIN sku ON tb_register_surat.no_surat = sku.no_surat INNER JOIN tb_pejabat ON tb_register_surat.id_pejabat = tb_pejabat.id_pejabat WHERE tb_register_surat.no_surat='$no_surat'";
$result = mysqli_query($db, $query);

// definisikan data
foreach ($result as $sku) {
	$tgl_surat = $sku['tgl_surat'];
	$nama = $sku['nama'];
	$dusun = $sku['dusun'];
	$rt = $sku['rt'];
	$rw = $sku['rw'];
	$tmpt_lahir = $sku['tmpt_lahir'];
	$tgl_lahir = $sku['tgl_lahir'];
	$jk = $sku['jk'];
	$agama = $sku['agama'];
	$wn = $sku['wn'];
	$nik = $sku['nik'];
	$nikah=$sku['nikah'];
	$id_pejabat=$sku['id_pejabat'];
	$pekerjaan = $sku['pekerjaan'];
	$keperluan = $sku['keperluan'];
	$keterangan = $sku['keterangan'];
	$jenis_sku = $sku['jenis_sku'];
	$namaKepdes = $sku['namaKepdes'];
}

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');

// panggil data kode surat
$query = "SELECT * FROM kode_surat";
$r_kode = mysqli_query($db,$query);;
$kode= mysqli_fetch_assoc($r_kode);
$kodeIndex = $kode['kode_index'];

// sleksi jenis sku
if ($jenis_sku == "pertanian") {
	$kodeSurat = $kode['sku_pertanian'];

}elseif ($jenis_sku == "peternakan") {
	$kodeSurat = $kode['sku_peternakan'];

}elseif ($jenis_sku == "perdagangan") {
	$kodeSurat = $kode['sku_perdagangan'];
}
// offline
define('FPDF_FONTPATH','C:\xampp\htdocs\sipesdes\library\fpdf\font');
// online
// define('FPDF_FONTPATH','/storage/ssd1/301/18576301/public_html/library/fpdf/font');
// include fpdf
require_once('../library/fpdf/WriteTag.php');

$pdf = new PDF_WriteTag('P','mm',array(215.5,330));
$pdf->SetMargins(25,15,20,20);
$pdf->AddFont('bookman','','bookman-old-style.php');
$pdf->AddFont('bookman','I','ufonts.com_bookman-bt-italic.php');
$pdf->AddFont('bookman','B','ufonts.com_bookman-bold.php');
$pdf->AddFont('bookman','BI','ufonts.com_bookman-bold-italic.php');

// mulai dokumen
$pdf->AddPage();
// Stylesheet
$pdf->SetStyle("p","times","N",12.5,"0,0,0",10);
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
$pdf->Cell(0,1,"SURAT KETERANGAN",0,1,'C');

$pdf->SetLineWidth(0.4);
$pdf->Line(78.5,59.5,142,59.5);

$pdf->SetFont('Times','B',12.5);
$pdf->Ln(6);
$tgl_surat_array = explode('-', $tgl_surat);
$tahun_surat = $tgl_surat_array[0];
$pdf->Cell(0,0,"Nomor: $kodeSurat/$no_surat/$kodeIndex/$tahun_surat",0,1,'C');

// isi
$pdf->Ln(10);
$pdf->Cell(5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(0,7,'Yang bertanda tangan dibawah ini :',0,1,'J');

$pdf->Ln(1);
$pdf->Cell(10);
$pdf->Cell(40,7,'Nama',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(0,7,strtoupper($namaKepdes),0,1,'L');

$pdf->Cell(10);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(40,7,'Jabatan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->SetFont('Times','',12.5);
$pdf->MultiCell(0,7,"Kepala Desa Bantal
	Kecamatan Asembagus Kabupaten Situbondo",0,'J');

$pdf->Ln(3);
$pdf->Cell(5);
$pdf->Cell(0,6,'Menerangkan bahwa : ');

$pdf->Ln(7);
$pdf->Cell(10);
$pdf->Cell(40,7,'Nama',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(0,7,$nama,0,1,'L');

$pdf->Cell(10);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(40,7,'Jenis Kelamin',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$jk,0,1,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'Tempat, tgl.Lahir',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$tgl_lahir_baru = ubahTanggal($tgl_lahir);
$pdf->Cell(0,7,"$tmpt_lahir, $tgl_lahir_baru",0,1,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'Agama',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$agama,0,1,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'Kewarganegaraan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$wn,0,1,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'Pekerjaan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$pekerjaan,0,1,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'Status Perkawinan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$nikah,0,1,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'Alamat',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung $dusun, RT $rt / RW $rw, Desa Bantal, Kecamatan Asembagus, Kabupaten Situbondo.",0,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'NIK',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->Cell(0,7,$nik,0,1,'L');

$pdf->Cell(10);
$pdf->Cell(40,7,'Keterangan',0,0,'L');
$pdf->Cell(6,7,':',0,0,'L');
$pdf->MultiCell(0,7,"$keterangan",0,'L');

if (!empty($keperluan)) {
	$pdf->Cell(10);
	$pdf->Cell(40,7,'Keperluan',0,0,'L');
	$pdf->Cell(6,7,':',0,0,'L');
	$pdf->MultiCell(0,7,"$keperluan",0,'L');	
}

$pdf->Ln(5);
$pdf->Cell(6);
$pdf->WriteTag(0,7,"<p>Surat keterangan ini dibuat dengan sebenarnya dan untuk digunakan sebagaimana mestinya.</p>",0,"J",0,0);

// ttd
$pdf->Ln(10);
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
