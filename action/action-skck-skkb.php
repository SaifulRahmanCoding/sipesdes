<?php
require_once('../assets/koneksi.php');
require_once('../cek-login.php');

if ($sessionStatus==false) {
	header("Location: ../login.php");
}
$opsi = (isset($_GET['opsi'])) ? $_GET['opsi'] : "";

if ($opsi == "input") {

	if (isset($_POST['no_surat'])) {$no_surat = $_POST['no_surat']; } else{echo "kesalahan dari no_surat"; }
	// batas
	if (isset($_POST['nik'])) {$nik = $_POST['nik']; } else{echo "kesalahan dari nik"; }
	// batas
	if (isset($_POST['nama'])) {$nama = $_POST['nama']; } else{echo "kesalahan dari nama "; }
	// batas
	if (isset($_POST['dusun'])) {$dusun = $_POST['dusun']; } else{echo "kesalahan dari dusun"; }
	// batas
	if (isset($_POST['rt'])) {$rt = $_POST['rt']; } else{echo "kesalahan dari rt"; }
	// batas
	if (isset($_POST['rw'])) {$rw = $_POST['rw']; } else{echo "kesalahan dari rw"; }
	// batas
	if (isset($_POST['pekerjaan'])) {$pekerjaan = $_POST['pekerjaan']; } else{echo "kesalahan dari pekerjaan"; }
	// batas
	if (isset($_POST['agama'])) {$agama = $_POST['agama']; } else{echo "kesalahan dari agama"; }
	// batas
	if (isset($_POST['tmpt_lahir'])) {$tmpt_lahir = $_POST['tmpt_lahir']; } else{echo "kesalahan dari tmpt_lahir"; }
	// batas
	if (isset($_POST['tgl_lahir'])) {$tgl_lahir = $_POST['tgl_lahir']; } else{echo "kesalahan dari tgl_lahir"; }
	// batas
	if (isset($_POST['nikah'])) {$nikah = $_POST['nikah']; } else{echo "kesalahan dari nikah"; }
	// batas
	if (isset($_POST['ket_wn'])) {$ket_wn = $_POST['ket_wn']; } else{echo "kesalahan dari ket_wn"; }
	// batas
	if (isset($_POST['jk'])) {$jk = $_POST['jk']; } else{echo "kesalahan dari jk"; }
	// batas
	if (isset($_POST['jenis'])) {$jenis = $_POST['jenis']; } else{echo "kesalahan dari jenis"; }
	// batas
	if (isset($_POST['keperluan'])) {$keperluan = ucwords($_POST['keperluan']); } else{echo "kesalahan dari keperluan"; }
	// batas
	if (isset($_POST['id_pejabat'])) {$id_pejabat = $_POST['id_pejabat']; } else{echo "kesalahan dari id_pejabat"; }

	// tentukan jenis surat
	if ($jenis == "SURAT KETERANGAN KELAKUAN BAIK") {
		$jenis_surat = "SKKB";
	}elseif ($jenis == "SURAT KETERANGAN CATATAN KEPOLISIAN") {
		$jenis_surat = "SKCK";
	}
	// tgl surat dibuat
	$tgl_surat = date('Y-m-d');

	$query = "INSERT INTO tb_register_surat(no_surat, tgl_surat, nama, jk, tmpt_lahir, tgl_lahir, wn, agama, nikah, dusun, rt, rw, ket_surat_register,nik,id_pejabat) VALUES ('$no_surat','$tgl_surat','$nama','$jk','$tmpt_lahir','$tgl_lahir','$ket_wn','$agama','$nikah','$dusun','$rt','$rw','$jenis_surat','$nik','$id_pejabat')";
	$insert_register = mysqli_query($db,$query);

	if($insert_register==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Insert Data ke Register');
			window.location.href="../form-skck-skkb.php";
		</script>
	<?php } 

	$query = "INSERT INTO skck_skkb(no_surat, pekerjaan, keperluan, jenis_surat) VALUES ('$no_surat','$pekerjaan','$keperluan','$jenis')";
	$insert_surat = mysqli_query($db,$query);

	if($insert_surat==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Insert Data ke SKCK/SKKB');
			window.location.href="../form-skck-skkb.php";
		</script>
	<?php }else{
		header('Location: ../register-surat.php');
	}


}elseif ($opsi == "update") {
	if (isset($_POST['no_surat'])) {$no_surat = $_POST['no_surat']; } else{echo "kesalahan dari no_surat"; }
	// batas
	if (isset($_POST['nik'])) {$nik = $_POST['nik']; } else{echo "kesalahan dari nik"; }
	// batas
	if (isset($_POST['nama'])) {$nama = $_POST['nama']; } else{echo "kesalahan dari nama "; }
	// batas
	if (isset($_POST['dusun'])) {$dusun = $_POST['dusun']; } else{echo "kesalahan dari dusun"; }
	// batas
	if (isset($_POST['rt'])) {$rt = $_POST['rt']; } else{echo "kesalahan dari rt"; }
	// batas
	if (isset($_POST['rw'])) {$rw = $_POST['rw']; } else{echo "kesalahan dari rw"; }
	// batas
	if (isset($_POST['pekerjaan'])) {$pekerjaan = $_POST['pekerjaan']; } else{echo "kesalahan dari pekerjaan"; }
	// batas
	if (isset($_POST['agama'])) {$agama = $_POST['agama']; } else{echo "kesalahan dari agama"; }
	// batas
	if (isset($_POST['tmpt_lahir'])) {$tmpt_lahir = $_POST['tmpt_lahir']; } else{echo "kesalahan dari tmpt_lahir"; }
	// batas
	if (isset($_POST['tgl_lahir'])) {$tgl_lahir = $_POST['tgl_lahir']; } else{echo "kesalahan dari tgl_lahir"; }
	// batas
	if (isset($_POST['nikah'])) {$nikah = $_POST['nikah']; } else{echo "kesalahan dari nikah"; }
	// batas
	if (isset($_POST['wn'])) {$wn = $_POST['wn']; } else{echo "kesalahan dari ket_wn"; }
	// batas
	if (isset($_POST['jk'])) {$jk = $_POST['jk']; } else{echo "kesalahan dari jk"; }
	// batas
	if (isset($_POST['jenis'])) {$jenis = $_POST['jenis']; } else{echo "kesalahan dari jenis"; }
	// batas
	if (isset($_POST['keperluan'])) {$keperluan = ucwords($_POST['keperluan']); } else{echo "kesalahan dari keperluan"; }
	// batas
	if (isset($_POST['id_pejabat'])) {$id_pejabat = $_POST['id_pejabat']; } else{echo "kesalahan dari id_pejabat"; }

	if (isset($_POST['update_kepdes'])) {$update_kepdes = $_POST['update_kepdes']; } else{echo "kesalahan dari update_kepdes"; }
	
	// cek jika variabel update_kepdes post bernilai update
	if ($update_kepdes == "update") {
		$query = "SELECT * FROM `tb_pejabat` WHERE jabatan = 'Kepala Desa' AND status = 'aktif'";
		$query_kepdes = mysqli_query($db,$query);
		$kepdes = mysqli_fetch_assoc($query_kepdes);
		$id_pejabat = $kepdes['id_pejabat'];
	}

	// tentukan jenis surat
	if ($jenis == "SURAT KETERANGAN KELAKUAN BAIK") {
		$jenis_surat = "SKKB";
	}elseif ($jenis == "SURAT KETERANGAN CATATAN KEPOLISIAN") {
		$jenis_surat = "SKCK";
	}

	// update tgl surat dibuat
	$tgl_surat = date('Y-m-d');

	$query = "UPDATE tb_register_surat SET tgl_surat = '$tgl_surat', nama = '$nama', jk = '$jk', tmpt_lahir = '$tmpt_lahir', tgl_lahir = '$tgl_lahir', wn = '$wn', agama = '$agama', nikah = '$nikah', dusun = '$dusun', rt = '$rt', rw = '$rw', ket_surat_register= '$jenis_surat', nik='$nik', id_pejabat='$id_pejabat' WHERE no_surat = '$no_surat'";
	$update_register = mysqli_query($db,$query);
	
	if($update_register==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Update Data ke Register');
			window.location.href="../edit-surat.php?no_surat=<?php echo $no_surat?>&jenis=<?php echo $jenis_surat?>";
		</script>
	<?php }

	$query = "UPDATE skck_skkb SET pekerjaan = '$pekerjaan', keperluan = '$keperluan', jenis_surat='$jenis' WHERE no_surat = '$no_surat'";
	$update_skck_skkb = mysqli_query($db,$query);

	if($update_skck_skkb==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Insert Data ke <?php echo $jenis_surat ?>');
			window.location.href="../edit-surat.php?no_surat=<?php echo $no_surat?>&jenis=<?php echo $jenis_surat?>";
		</script>
	<?php }else{
		header('Location: ../register-surat.php');
	} 
}
?>
