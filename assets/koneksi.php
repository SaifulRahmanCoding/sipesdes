<?php
// kalau pakai offline
$db = new mysqli("localhost","root","","sipesdes");
// cek koneksi
if ($db->connect_error) {
	echo "Gagal menyambungkan ke MySQL : ".$db->connect_error;
	exit();
}
?>