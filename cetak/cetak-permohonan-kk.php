<?

$query = "SELECT tb_register_surat.*,permohonan_kk.*,tb_pejabat.nama as namaKepdes FROM tb_register_surat INNER JOIN permohonan_kk ON tb_register_surat.no_surat = permohonan_kk.no_surat INNER JOIN tb_pejabat ON tb_register_surat.id_pejabat = tb_pejabat.id_pejabat WHERE tb_register_surat.no_surat='$no_surat'";
$result = mysqli_query($db, $query);

// definisikan data
foreach ($result as $p_kk) {
	$tgl_surat = $p_kk['tgl_surat'];
	$nama = $p_kk['nama'];
	$dusun = $p_kk['dusun'];
	$rt = $p_kk['rt'];
	$rw = $p_kk['rw'];
	$tmpt_lahir = $p_kk['tmpt_lahir'];
	$tgl_lahir = $p_kk['tgl_lahir'];
	$jk = $p_kk['jk'];
	$agama = $p_kk['agama'];
	$wn = $p_kk['wn'];
	$no_kk = $p_kk['no_kk'];
	$pekerjaan = $p_kk['pekerjaan'];
	$nikah = $p_kk['nikah'];
	$nm_kp = $p_kk['nm_kp'];
	$id_pejabat = $p_kk['id_pejabat'];
	$namaKepdes = $p_kk['namaKepdes'];
}

// panggil data kode surat
$query = "SELECT * FROM kode_surat";
$r_kode = mysqli_query($db,$query);;
$kode= mysqli_fetch_assoc($r_kode);
$kodeIndex = $kode['kode_index'];
$kodeSurat = $kode['permohonan_kk'];

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');
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
$pdf->SetStyle("p","times","N",12.5,"0,0,0",12.5);
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

// bawah kop surat
$pdf->SetFont('Times','',12.5);
$pdf->Ln(9);
$pdf->Cell(109);
$pdf->Cell(60,2,"Bantal, ".ubahTanggal($tgl_surat)."",0,1,'C');
$pdf->Cell(18,5,"Nomor",0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$tgl_surat_array = explode('-', $tgl_surat);
$tahun_surat = $tgl_surat_array[0];
$pdf->Cell(0,5,"$kodeSurat/$no_surat/$kodeIndex/$tahun_surat",0,1,'L');

$pdf->Cell(18,5,'Sifat',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(84,5,"Penting",0,0,'L');
$pdf->Cell(0,5,"Kepada :",0,1,'C');

$pdf->Cell(18,5,'Lampiran',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->Cell(81.5,5,"1 Berkas",0,0,'L');
$pdf->Cell(0,5,"Yth. Sdr. Kepala Sub Dinas",0,1,'L');

$pdf->Cell(18,5,'Perihal',0,0,'L');
$pdf->Cell(2);
$pdf->Cell(5,5,':',0,0,'L');
$pdf->SetFont('Times','U',12.5);
$pdf->Cell(82,5,"Permohonan Pembuatan KK",0,0,'L');
$pdf->SetFont('Times','',12.5);
$pdf->Cell(0,5,"Kependudukan dan Pencatatan Sipil",0,1,'L');

$pdf->Cell(107);
$pdf->Cell(0,5,"Kabupaten Situbondo",0,1,'L');
$pdf->Cell(114);
$pdf->Cell(0,5,"Di",0,1,'L');
$pdf->Cell(107);
$pdf->SetFont('Times','BU',12.5);
$pdf->Cell(0,5,"SITUBONDO",0,1,'C');


$pdf->Ln(9);
$pdf->SetFont('Times','',12.5);
$pdf->WriteTag(0,7,"<p>Yang bertanda tangan di bawah ini kami Kepala Desa Bantal, Kecamatan Asembagus, Kabupaten Situbondo menyampaikan bahwa :</p>",0,"J");

$pdf->Ln(1);
$pdf->Cell(12.5);
$pdf->Cell(45,7,'Nama',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(0,7,strtoupper($nama),0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(45,7,'Jenis Kelamin',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$jk,0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(45,7,'Tempat, tgl.Lahir',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,"$tmpt_lahir, ".ubahTanggal($tgl_lahir)."",0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(45,7,'Pekerjaan',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$pekerjaan,0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(45,7,'Nama Kepala Keluarga',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(0,7,$nm_kp,0,1,'L');

$pdf->Cell(12.5);
$pdf->SetFont('Times','',12.5);
$pdf->Cell(45,7,'Kartu Keluarga Nomor',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->Cell(0,7,$no_kk,0,1,'L');

$pdf->Cell(12.5);
$pdf->Cell(45,7,'Alamat',0,0,'L');
$pdf->Cell(5,7,':',0,0,'L');
$pdf->MultiCell(0,7,"Kampung  $dusun, RT  $rt /  RW $rw, Desa  Bantal,  Kecamatan Asembagus, Kode Pos 68373 Kabupaten Situbondo, Jawa Timur.",0,'L');

$pdf->Ln(5);
$pdf->SetFont('Times','',12.5);
$pdf->WriteTag(0,7,"<p>Tersebut di atas benar-benar belum pernah Cetak Kartu Keluarga (KK) di Dinas Kependudukan dan Pencatatan Sipil Kabupaten Situbondo. Demikian permohonan ini kami buat dengan sebenarnya dan harap maklum adanya.</p>",0,"J");

// ttd
$pdf->Ln(7);
$pdf->Cell(148,6,'',0,1,'C');
$pdf->Cell(103);
$pdf->SetFont('Times','B',12.5);
$pdf->Cell(45,6,'Kepala Desa Bantal',0,0,'C');
$pdf->Ln(25);
$pdf->Cell(5);
$pdf->SetFont('Times','BU',12.5);
$pdf->Cell(98);
$pdf->Cell(45,6,strtoupper($namaKepdes),0,0,'C');

$pdf->Output();
?>
