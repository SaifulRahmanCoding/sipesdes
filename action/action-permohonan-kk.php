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
	if (isset($_POST['no_kk'])) {$no_kk = $_POST['no_kk']; } else{echo "kesalahan dari no_kk"; }
	// batas
	if (isset($_POST['nama'])) {$nama = $_POST['nama']; } else{echo "kesalahan dari nama "; }
	// batas
	if (isset($_POST['dusun'])) {$dusun = $_POST['dusun']; } else{echo "kesalahan dari dusun"; }
	// batas
	if (isset($_POST['rt'])) {$rt = $_POST['rt']; } else{echo "kesalahan dari rt"; }
	// batas
	if (isset($_POST['rw'])) {$rw = $_POST['rw']; } else{echo "kesalahan dari rw"; }
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
	if (isset($_POST['pekerjaan'])) {$pekerjaan = ucwords($_POST['pekerjaan']); } else{echo "kesalahan dari pekerjaan"; }
	// batas
	if (isset($_POST['kp_kk'])) {$kp_kk = $_POST['kp_kk']; } else{echo "kesalahan dari kp_kk"; }
	// batas
	if (isset($_POST['id_pejabat'])) {$id_pejabat = $_POST['id_pejabat']; } else{echo "kesalahan dari id_pejabat"; }

	// definisikan jenis surat
	$jenis_surat = "PERMOHONAN KK";
	// tgl surat dibuat
	$tgl_surat = date('Y-m-d');

	$query = "INSERT INTO tb_register_surat(no_surat, tgl_surat, nama, jk, tmpt_lahir, tgl_lahir, wn, agama, nikah, dusun, rt, rw, ket_surat_register,nik,id_pejabat) VALUES ('$no_surat','$tgl_surat','$nama','$jk','$tmpt_lahir','$tgl_lahir','$ket_wn','$agama','$nikah','$dusun','$rt','$rw','$jenis_surat','','$id_pejabat')";
	$insert_register = mysqli_query($db,$query);

	if($insert_register==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Insert Data ke Register');
			window.location.href="../form-permohonan-kk.php";
		</script>
	<?php } 
	$query = "INSERT INTO permohonan_kk(no_surat, pekerjaan, no_kk, nm_kp) VALUES ('$no_surat','$pekerjaan','$no_kk','$kp_kk')";
	$insert_surat = mysqli_query($db,$query);

	if($insert_surat==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Insert Data ke pindah');
			window.location.href="../form-permohonan-kk.php";
		</script>
	<?php }else{
		header('Location: ../register-surat.php');
	} 


}elseif ($opsi == "update") {
	if (isset($_POST['no_surat'])) {$no_surat = $_POST['no_surat']; } else{echo "kesalahan dari no_surat"; }
	// batas
	if (isset($_POST['no_kk'])) {$no_kk = $_POST['no_kk']; } else{echo "kesalahan dari no_kk"; }
	// batas
	if (isset($_POST['nama'])) {$nama = $_POST['nama']; } else{echo "kesalahan dari nama "; }
	// batas
	if (isset($_POST['dusun'])) {$dusun = $_POST['dusun']; } else{echo "kesalahan dari dusun"; }
	// batas
	if (isset($_POST['rt'])) {$rt = $_POST['rt']; } else{echo "kesalahan dari rt"; }
	// batas
	if (isset($_POST['rw'])) {$rw = $_POST['rw']; } else{echo "kesalahan dari rw"; }
	// batas
	if (isset($_POST['agama'])) {$agama = $_POST['agama']; } else{echo "kesalahan dari agama"; }
	// batas
	if (isset($_POST['tmpt_lahir'])) {$tmpt_lahir = $_POST['tmpt_lahir']; } else{echo "kesalahan dari tmpt_lahir"; }
	// batas
	if (isset($_POST['tgl_lahir'])) {$tgl_lahir = $_POST['tgl_lahir']; } else{echo "kesalahan dari tgl_lahir"; }
	// batas
	if (isset($_POST['nikah'])) {$nikah = $_POST['nikah']; } else{echo "kesalahan dari nikah"; }
	// batas
	if (isset($_POST['wn'])) {$wn = $_POST['wn']; } else{echo "kesalahan dari wn"; }
	// batas
	if (isset($_POST['jk'])) {$jk = $_POST['jk']; } else{echo "kesalahan dari jk"; }
	// batas
	if (isset($_POST['pekerjaan'])) {$pekerjaan = ucwords($_POST['pekerjaan']); } else{echo "kesalahan dari pekerjaan"; }
	// batas
	if (isset($_POST['kp_kk'])) {$kp_kk = $_POST['kp_kk']; } else{echo "kesalahan dari kp_kk"; }
	// batas
	if (isset($_POST['id_pejabat'])) {$id_pejabat = $_POST['id_pejabat']; } else{echo "kesalahan dari id_pejabat"; }
	// batas
	if (isset($_POST['update_kepdes'])) {$update_kepdes = $_POST['update_kepdes']; } else{echo "kesalahan dari update_kepdes"; }
	
	// cek jika variabel update_kepdes post bernilai update
	if ($update_kepdes == "update") {
		$query = "SELECT * FROM tb_pejabat WHERE jabatan = 'Kepala Desa' AND status = 'aktif'";
		$query_kepdes = mysqli_query($db,$query);
		$kepdes = mysqli_fetch_assoc($query_kepdes);
		$id_pejabat = $kepdes['id_pejabat'];
	}

	// definisikan jenis surat
	$jenis_surat = "PERMOHONAN KK";
	// update tgl surat dibuat
	$tgl_surat = date('Y-m-d');

	$query = "UPDATE tb_register_surat SET tgl_surat = '$tgl_surat', nama = '$nama', jk = '$jk', tmpt_lahir = '$tmpt_lahir', tgl_lahir = '$tgl_lahir', wn = '$wn', agama = '$agama', nikah = '$nikah', dusun = '$dusun', rt = '$rt', rw = '$rw', id_pejabat='$id_pejabat' WHERE no_surat = '$no_surat'";
	$update_register = mysqli_query($db,$query);
	if($update_register==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Update Data ke Register');
			window.location.href="../edit-surat.php?no_surat=<?php echo $no_surat?>&jenis=<?php echo $jenis_surat?>";
		</script>
	<?php }
	$query = "UPDATE permohonan_kk SET pekerjaan='$pekerjaan',no_kk='$no_kk',nm_kp='$kp_kk' WHERE no_surat = '$no_surat'";
	$update_p_kk = mysqli_query($db,$query);
	if($update_p_kk==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Insert Data ke Permohonan KK');
			window.location.href="../edit-surat.php?no_surat=<?php echo $no_surat?>&jenis=<?php echo $jenis_surat?>";
		</script>
	<?php }else{
		header('Location: ../register-surat.php');
	} 
}
?>
