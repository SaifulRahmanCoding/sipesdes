<?php
require_once('assets/koneksi.php');
require_once('cek-login.php');

if ($sessionStatus==false) {
	header("Location: login.php");
}
// dapatkan no surat dan tetapkan
if (isset($_GET['no_surat'])) {$no_surat=$_GET['no_surat']; } else{echo "error no_surat <a href='register-surat.php'>Kembali</a>"; }

$query = "DELETE FROM tb_register_surat WHERE no_surat = $no_surat";
$delete = mysqli_query($db,$query);

if($delete==false) { ?>
	<script type='text/javascript'>
		alert('Gagal Menghapus Data Surat');
		window.location.href="register-surat.php";
	</script>
<?php }else{ ?>
	<script type='text/javascript'>
		window.location.href="register-surat.php";
	</script>
<?php }
?>