<?php
require_once('../assets/koneksi.php');
require('../cek-login.php');

// dapatken variable opsi
$opsi = $_GET['opsi'];

// opsi menambah akun/pejabat
if ($opsi == "input") {

	if (isset($_POST['nama'])) {$nama=$_POST['nama']; }else{ echo "error nama <a href='../pejabat.php'>Kembali</a>"; }
	// batas
	if (isset($_POST['jabatan'])) {$jabatan=$_POST['jabatan']; }else{ echo "error jabatan <a href='../pejabat.php'>Kembali</a>"; }
	// batas
	if (isset($_POST['status'])) {$status=$_POST['status']; }else{ echo "error status <a href='../pejabat.php'>Kembali</a>"; }

	// menyiapkan Query MySQL untuk dieksekusi
	$query = "INSERT INTO tb_pejabat (nama,jabatan,status) VALUES ('$nama','$jabatan','$status')";
	// mengeksekusi MySQL Query
	$insert = mysqli_query($db, $query);

	// menangani ketika error pada saat eksekusi query
	if ($insert == false) { ?>
		<script type='text/javascript'>
			alert('Gagal Menambah Data');
			window.location.href="../pejabat.php";
		</script>
	<?php }else{
		header("Location: ../pejabat.php");
	}
}

// update nama dan email
if ($opsi=="update"){
	if (isset($_POST['id'])) {$id=$_POST['id']; }else{echo "id tidak ditemukan"; }
	// batas
	if (isset($_POST['nama'])) {$nama=$_POST['nama']; }else{echo "nama tidak ditemukan"; }
	// batas
	if (isset($_POST['jabatan'])) {$jabatan=$_POST['jabatan']; }else{echo "jabatan tidak ditemukan"; }
	// batas
	if (isset($_POST['status'])) {$status=$_POST['status']; }else{ echo "error status <a href='../pejabat.php'>Kembali</a>"; }

	$query="UPDATE tb_pejabat SET nama = '$nama', jabatan = '$jabatan', status = '$status' WHERE id_pejabat = $id";
	$update = mysqli_query($db,$query);

	if($update==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data pejabat <?php echo $nama?>');
			window.location.href="../pejabat.php";
		</script>
	<?php }else{ ?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data pejabat');
			window.location.href="../pejabat.php";
		</script>
	<?php }
}

// opsi menghapus pejabat
if($opsi=="delete") {
	if (isset($_GET['id_pejabat'])) {$id_pejabat=$_GET['id_pejabat']; } else{echo "error id <a href='../pejabat.php'>Kembali</a>"; }

	$query = "DELETE FROM tb_pejabat WHERE id_pejabat = $id_pejabat";
	$delete = mysqli_query($db,$query);

	// panggil data id_penduduk paling terakhir
	$query = "SELECT max(id_pejabat) as id_pejabat FROM tb_pejabat ORDER BY id_pejabat DESC";
	$result = mysqli_query($db,$query);
	$id_desc = mysqli_fetch_assoc($result);
	// jumlahkan data id_penduduk terakhir
	if (empty($id_desc)) {$ai = 1; }else{$ai = $id_desc['id_pejabat']+1;}

	// tetapkan auto incremet baru agar kembali terurut dari data sembelumnya
	$query = "ALTER TABLE tb_pejabat auto_increment=$ai";
	mysqli_query($db,$query);

	if($delete==false) { ?>
		<script type='text/javascript'>
			window.location.href="../pejabat.php";
		</script>
	<?php }else{ ?>
		<script type='text/javascript'>
			window.location.href="../pejabat.php";
		</script>
	<?php }
}
?>