<?php
require_once('../assets/koneksi.php');
require('../cek-login.php');

// dapatken variable opsi
$opsi = $_GET['opsi'];

// opsi menambah akun/user
if ($opsi == "input") {

	if (isset($_POST['nama'])) {$nama=$_POST['nama']; }else{ echo "error nama <a href='../reg-akun.php'>Kembali</a>"; }
	// batas
	if (isset($_POST['email'])) {$email=$_POST['email']; }else{ echo "error email <a href='../reg-akun.php'>Kembali</a>"; }
	// batas
	if (isset($_POST['level'])) {$level=$_POST['level']; }else{ echo "error level <a href='../reg-akun.php'>Kembali</a>"; }
	// batas
	if (isset($_POST['password'])) {$password=$_POST['password']; }else{ echo "error password <a href='../reg-akun.php'>Kembali</a>"; }
	// batas
	if (isset($_POST['repassword'])) {$repassword=$_POST['repassword']; }else{ echo "error re-password <a href='../reg-akun.php'>Kembali</a>"; }

	// pengecekan password dan konfirmasi password
	if ($password != $repassword) {
		header("Location: ../reg-akun.php?error=repassword&nama={$nama}&email={$email}&level={$level}");
		exit();
	}else{
		$password=hash("sha256", $password);
	}

	// menyiapkan Query MySQL untuk dieksekusi
	$query = "INSERT INTO tb_user (nama,email,password,level) VALUES ('$nama','$email','$password','$level')";
	// mengeksekusi MySQL Query
	$insert = mysqli_query($db, $query);

	// menangani ketika error pada saat eksekusi query
	if ($insert == false) { ?>
		<script type='text/javascript'>
			alert('Gagal Menambah Data');
			window.location.href="../reg-akun.php";
		</script>
	<?php }else{
		header("Location: ../reg-akun.php?hasil=sukses&emaildone={$email}");
	}
}

// update nama dan email
if ($opsi=="update"){
	if (isset($_POST['id'])) {$id=$_POST['id']; }else{echo "id tidak ditemukan"; }
	// batas
	if (isset($_POST['nama'])) {$nama=$_POST['nama']; }else{echo "nama tidak ditemukan"; }
	// batas
	if (isset($_POST['email'])) {$email=$_POST['email']; }else{echo "email tidak ditemukan"; }
	$query="UPDATE tb_user SET nama = '$nama', email = '$email' WHERE id_user = $id";
	$update = mysqli_query($db,$query);

	if($update==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Mengubah Data User <?php echo $nama?>');
			window.location.href="../akun.php";
		</script>
	<?php }else{ ?>
		<script type='text/javascript'>
			alert('Sukses Mengubah Data User <?php echo $nama?>');
			window.location.href="../akun.php";
		</script>
	<?php }
}

// ubah password
if ($opsi=="updatePass") {
	if (isset($_POST['id'])) {$id=$_POST['id']; }else{echo "id tidak ditemukan"; }
	// batas
	if (isset($_POST['pass_lama'])) {$pass_lama=$_POST['pass_lama']; }else{echo "pass_lama tidak ditemukan"; }
	// batas
	if (isset($_POST['pass_baru'])) {$pass_baru=$_POST['pass_baru']; }else{echo "pass_baru tidak ditemukan"; }
	// hasing password
	$pass_lama = hash("sha256", $pass_lama);

	$query = "SELECT password FROM tb_user WHERE id_user=$id";
	$result = mysqli_query($db,$query);
	$Cpass = mysqli_fetch_assoc($result);

	if( $Cpass['password'] != $pass_lama){ ?>
		<script type='text/javascript'>
			alert('Password Gagal Diubah, Karena Password Lama Tidak Sesuai Dengan Yang Anda Masukkan');
			window.location.href="../akun.php";
		</script>

	<?php }else{

		$pass_baru = hash("sha256", $pass_baru);

		$query="UPDATE tb_user SET password = '$pass_baru' WHERE id_user = $id";
		$update = mysqli_query($db,$query);

		if($update==false) { ?>
			<script type='text/javascript'>
				alert('Gagal Mengubah Password User');
				window.location.href="../akun.php";
			</script>
		<?php }else{ 
			if($sessionid==$id){
				// menghapus semua session yang telah didefinisikan
				session_destroy();
				// mengarahkan menuju halaman login
				?>
				<script type='text/javascript'>
					alert('Sukses Mengubah Password User');
					alert('Silahkan Login Kembali, Karena Password Yang Anda Ubah Adalah Akun Yang Sedang Anda Gunakan');
					window.location.href="../login.php";
				</script>
				<?php
			}else{ ?>
				<!-- menuju menu akun -->
				<script type='text/javascript'>
					alert('Sukses Mengubah Password User');
					window.location.href="../akun.php";
				</script>
				<?php
			}
		}
	}
}
// opsi menghapus akun/user
if($opsi=="delete") {
	if (isset($_GET['id_user'])) {$id_user=$_GET['id_user']; } else{echo "error id <a href='../akun.php'>Kembali</a>"; }

	$query = "DELETE FROM tb_user WHERE id_user = $id_user";
	$delete = mysqli_query($db,$query);

	// panggil data id_penduduk paling terakhir
	$query = "SELECT id_user,nama FROM tb_user ORDER BY id_user DESC";
	$result = mysqli_query($db,$query);
	$id_desc = mysqli_fetch_assoc($result);
	// jumlahkan data id_penduduk terakhir
	$ai = $id_desc['id_user']+1;

	// tetapkan auto incremet baru agar kembali terurut dari data sembelumnya
	$query = "ALTER TABLE tb_user auto_increment=$ai";
	mysqli_query($db,$query);

	if($delete==false) { ?>
		<script type='text/javascript'>
			alert('Gagal Menghapus Data User <?php echo $id_desc['nama']?>');
			window.location.href="../akun.php";
		</script>
	<?php }else{ ?>
		<script type='text/javascript'>
			window.location.href="../akun.php";
		</script>
	<?php }
}
?>