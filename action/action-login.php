<?php
require_once('../assets/koneksi.php');

// mamvalidasi inputan
if (isset($_POST['email'])) {
	$email=$_POST['email'];
}
else{
	echo "email error";
}

if (isset($_POST['password'])) {
	$password=$_POST['password'];
}
else{
	echo "password error";
}

// hasing password
$password=hash("sha256", $password);

// menyiapkan Query MySQL untuk dieksekusi
$query="SELECT * FROM tb_user WHERE email='{$email}'";

// mengekesekusi MySQL Query
$result=mysqli_query($db,$query);

// karena pemanggilan data hanya satu, maka menggunakan syntax di bawah ini. (intinya tidak menggunkan perulangan foreach)
$data=mysqli_fetch_assoc($result);

if (is_null($data)) {
	header("Location: ../login.php?error=email");
}
else if( $data['password'] != $password){
	header("Location: ../login.php?error=password&email={$email}");
}
else{
	// memulai fungsi SESSION, session hanya dapat digunakan setelah fungsi ini
	session_start();

	// status login dikonfirmasi benar
	$_SESSION['status']=true;
	
	$_SESSION['nama']=$data['nama'];
	$_SESSION['level']=$data['level'];
	$_SESSION['id']=$data['id_user'];

	header('Location: ../index.php');
}
?>