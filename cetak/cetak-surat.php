<?php
require_once('../assets/koneksi.php');
require_once('../cek-login.php');

if ($sessionStatus==false) {
	header("Location: ../login.php");
}

// dapatkan jenis dan tetapkan
$jenis = (isset($_GET['jenis'])) ? $_GET['jenis'] : "" ;
$no_surat = (isset($_GET['no_surat'])) ? $_GET['no_surat'] : "" ;

if ($jenis == "SKTM") {
	require_once('cetak-sktm.php');

}elseif ($jenis == "SKU") {
	require_once('cetak-sku.php');

}elseif ($jenis == "SKCK" OR $jenis == "SKKB") {
	require_once('cetak-skck-skkb.php');

}elseif ($jenis == "PENGANTAR PINDAH") {
	require_once('cetak-pindah.php');

}elseif ($jenis == "PERMOHONAN KK") {
	require_once('cetak-permohonan-kk.php');

}

?>