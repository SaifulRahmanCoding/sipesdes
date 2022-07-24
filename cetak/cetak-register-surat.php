<?php
require_once('../assets/koneksi.php');
require_once('../cek-login.php');

if ($sessionStatus==false) {
	header("Location: ../login.php");
}

$query = "SELECT * FROM tb_register_surat";
$result = mysqli_query($db,$query);
// hitung banyak data
$row = mysqli_num_rows($result);
// hitung angka asli lembar
$lembar_asli = $row/15;
// jadikan integer
$lembar_int = intval($lembar_asli);
// bandingkan
$jml_lembar = ($lembar_asli>$lembar_int) ? $lembar_int+1 : $lembar_int;

// include fungsi ubah tanggal
require('../library/ubah_tanggal.php');

// manggil data nama kepdes
$query = "SELECT * FROM tb_pejabat WHERE jabatan='Kepala Desa' AND status = 'aktif'";
$r_kepdes=mysqli_query($db,$query);
$kepdes= mysqli_fetch_assoc($r_kepdes);
$namaKepdes = strtoupper($kepdes['nama']);
// manggil data nama sekdes
$query = "SELECT * FROM tb_pejabat WHERE jabatan='Sekertaris Desa' AND status = 'aktif'";
$r_sekdes=mysqli_query($db,$query);
$sekdes= mysqli_fetch_assoc($r_sekdes);
$namaSekdes = strtoupper($sekdes['nama']);

require('../library/fpdf/fpdf.php');

class myPDF extends FPDF{
	function myCell($w,$h,$x,$t){
		$height = $h/1.7;
		$first = $height;
		$second = $height*2.5;
		$third = ($height*4)+1;
		$len = strlen($t);

		if ($len>$w/2) {
			$txt = str_split($t,$w/2.5);
			$this->SetX($x);
			$this->Cell($w+1,$first,$txt[0],'','','C');
			$this->SetX($x);
			$this->Cell($w+1,$second,$txt[1],'','','C');
			$hitung_array = count($txt);
			if ($hitung_array == 3) {
				$this->SetX($x);
				$this->Cell($w+1,$third,$txt[2],'','','C');
			}
			$this->SetX($x);
			$this->Cell($w+1,$h,'',1,0,'C',0);
		}else{
			$this->SetX($x);
			$this->Cell($w+1,$h,$t,1,0,'C',0);
		}
	}
}
$pdf=new myPDF('L','mm',array(215.9,355.6));
$pdf->SetMargins(40,20,10,10);

// mulai dokumen
$pdf->AddPage();

// perulangan untuk lembar
for($i=0;$i<$jml_lembar;$i++){
	$pdf->SetFont('Times','B',14);
	$pdf->Cell(0,5,'BUKU REGISTER SURAT KETERANGAN',0,1,'L');
	$pdf->Ln(4);
	// tabel
	$pdf->SetFont('Times','B',10);

	$h = 10;
	$w = 17;
	$x = $pdf->GetX();
	$pdf->myCell($w,$h,$x,'NOMOR URUT');
	$y = $pdf->GetY();
	$x = $pdf->GetX();
	$w = 22;
	$pdf->myCell($w,$h,$x,'TGL SURAT');
	$x = $pdf->GetX();
	$w = 57;
	$pdf->myCell($w,$h,$x,'NAMA');
	$x = $pdf->GetX();
	$w = 10;
	$pdf->myCell($w,$h,$x,'JK');
	$x = $pdf->GetX();
	$w = 22;
	$pdf->myCell($w,$h,$x,'TEMPAT');
	$x = $pdf->GetX();
	$w = 22;
	$pdf->myCell($w,$h,$x,'TGL LAHIR');
	$x = $pdf->GetX();
	$w = 27;
	$pdf->myCell($w,$h,$x,'KEWARGANE GARAAN');
	$x = $pdf->GetX();
	$w = 20;
	$pdf->myCell($w,$h,$x,'AGAMA');
	$x = $pdf->GetX();
	$w = 30;
	$pdf->myCell($w,$h,$x,'			STATUS 		PERKAWINAN');
	$x = $pdf->GetX();
	$w = 40;
	$pdf->myCell($w,$h,$x,'ALAMAT');
	$x = $pdf->GetX();
	$w = 27;
	$pdf->myCell($w,$h,$x,'KETERANGAN');

	$pdf->Ln();

	// baris nomor
	$h = 4;
	$w = 17;
	$x = 40; 
	$pdf->SetFont('Times','',8);
	$pdf->myCell($w,$h,$x,"1");
	$y = $pdf->GetY();
	$x = $pdf->GetX();
	$w = 22;
	$pdf->myCell($w,$h,$x,"2");
	$x = $pdf->GetX();
	$w = 57;
	$pdf->myCell($w,$h,$x,"3");
	$x = $pdf->GetX();
	$w = 10;
	$pdf->myCell($w,$h,$x,"4");
	$x = $pdf->GetX();
	$w = 22;
	$pdf->myCell($w,$h,$x,"5");
	$x = $pdf->GetX();
	$w = 22;
	$pdf->myCell($w,$h,$x,"6");
	$x = $pdf->GetX();
	$w = 27;
	$pdf->myCell($w,$h,$x,"7");
	$x = $pdf->GetX();
	$w = 20;
	$pdf->myCell($w,$h,$x,"8");
	$x = $pdf->GetX();
	$w = 30;
	$pdf->myCell($w,$h,$x,"9");
	$x = $pdf->GetX();
	$w = 40;
	$pdf->myCell($w,$h,$x,"10");
	$x = $pdf->GetX();
	$w = 27;
	$pdf->myCell($w,$h,$x,"11");

	$pdf->Ln();

	// perulangan untuk baris data 
	for($j=0;$j<15;$j++){
		$reg = mysqli_fetch_assoc($result);
		$no_surat = (!empty($reg['no_surat'])) ? $reg['no_surat'] : "";
		$tgl_surat = (!empty($reg['tgl_surat'])) ? $reg['tgl_surat'] : "";
		// kondisi bila tgl_surat ada, maka dibuah
		if (!empty($tgl_surat)) {
			$tgl_surat_array = explode('-', $tgl_surat);
			$tgl_surat = "$tgl_surat_array[2]/$tgl_surat_array[1]/$tgl_surat_array[0]";
		}

		$nama = (!empty($reg['nama'])) ? strtoupper($reg['nama']) : "";
		$jk = (!empty($reg['jk'])) ? $reg['jk'] : "";
		$tmpt_lahir = (!empty($reg['tmpt_lahir'])) ? $reg['tmpt_lahir'] : "";
		$tgl_lahir = (!empty($reg['tgl_lahir'])) ? $reg['tgl_lahir'] : "";
		// kondisi bila tgl_lahir ada, maka dibuah
		if (!empty($tgl_lahir)) {
			$tgl_lahir_array = explode('-', $tgl_lahir);
			$tgl_lahir = "$tgl_lahir_array[2]/$tgl_lahir_array[1]/$tgl_lahir_array[0]";
		}

		$wn = (!empty($reg['wn'])) ? $reg['wn'] : "";
		$agama = (!empty($reg['agama'])) ? $reg['agama'] : "";
		$nikah = (!empty($reg['nikah'])) ? $reg['nikah'] : "";
		$dusun = (!empty($reg['dusun'])) ? $reg['dusun'] : "";
		$rt = (!empty($reg['rt'])) ? $reg['rt'] : "";
		$rw = (!empty($reg['rw'])) ? $reg['rw'] : "";
		$ket_surat_register = (!empty($reg['ket_surat_register'])) ? $reg['ket_surat_register']  : "";
		$alamat = (!empty($dusun && $rt && $rw)) ? "$dusun / $rt / $rw" : "";
		if ($jk=="Laki-Laki") {
			$jk_new = "L";
		}elseif ($jk=="Perempuan") {
			$jk_new = "P";
		}else{ $jk_new = ""; }

		// $h = 7.7;
		$h = 7.7;
		$w = 17;
		$x = $pdf->GetX();
		$pdf->SetFont('Times','',10);
		$pdf->myCell($w,$h,$x,"$no_surat");
		$y = $pdf->GetY();
		$x = $pdf->GetX();
		$w = 22;
		$pdf->myCell($w,$h,$x,"$tgl_surat");
		$x = $pdf->GetX();
		$w = 57;
		$pdf->myCell($w,$h,$x,"$nama");
		$x = $pdf->GetX();
		$w = 10;
		$pdf->myCell($w,$h,$x,"$jk_new");
		$x = $pdf->GetX();
		$w = 22;
		$pdf->myCell($w,$h,$x,"$tmpt_lahir");
		$x = $pdf->GetX();
		$w = 22;
		$pdf->myCell($w,$h,$x,"$tgl_lahir");
		$x = $pdf->GetX();
		$w = 27;
		$pdf->myCell($w,$h,$x,"$wn");
		$x = $pdf->GetX();
		$w = 20;
		$pdf->myCell($w,$h,$x,"$agama");
		$x = $pdf->GetX();
		$w = 30;
		$pdf->myCell($w,$h,$x,"$nikah");
		$x = $pdf->GetX();
		$w = 40;
		$pdf->myCell($w,$h,$x,"$alamat");
		$x = $pdf->GetX();
		$w = 27;
		$pdf->SetFont('Times','',8.5);
		$pdf->myCell($w,$h,$x,"$ket_surat_register");

		$pdf->Ln();

	}

	$pdf->Ln(5);
	// barsi 1
	$pdf->SetFont('Times','',12.5);
	$pdf->Cell(146,6,"Mengetahui :",0,0,'C');
	$pdf->Cell(20);
	$pdf->Cell(0,6,".........................................",0,1,'C');

	// barsi 2
	$pdf->Cell(146,6,"Kepala Desa Bantal",0,0,'C');
	$pdf->Cell(20);
	$pdf->Cell(0,6,"Sekertaris Desa Bantal",0,1,'C');

	// barsi 3
	$pdf->Ln(13);
	$pdf->SetFont('Times','BU',12.5);
	$pdf->Cell(146,6,"$namaKepdes",0,0,'C');
	$pdf->Cell(20);
	$pdf->Cell(0,6,"$namaSekdes",0,0,'C');

	$pdf->Ln();
}
$pdf->Output();
?>