<?php
function ubahTanggal($tgl){
	// tanggal Hari Ini
	if (!empty($tgl)) {
		// code...
		$tgl_baru = explode("-", $tgl);
		$tahun = $tgl_baru[0];
		$bulan = $tgl_baru[1];
		$hari = $tgl_baru[2]; 
		switch ($bulan) {
			case '01':
			$bulan = "Januari";
			break;
			case '02':
			$bulan = "Februari";
			break;
			case '03':
			$bulan = "Maret";
			break;
			case '04':
			$bulan = "April";
			break;
			case '05':
			$bulan = "Mei";
			break;
			case '06':
			$bulan = "Juni";
			break;
			case '07':
			$bulan = "Juli";
			break;
			case '08':
			$bulan = "Agustus";
			break;
			case '09':
			$bulan = "September";
			break;
			case '10':
			$bulan = "Oktober";
			break;
			case '11':
			$bulan = "November";
			break;
			case '12':
			$bulan = "Desember";
			break;

		}
		return "$hari $bulan $tahun";
	}
}
?>