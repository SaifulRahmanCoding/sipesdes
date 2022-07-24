<?php
// start session
session_start();

// mengecek dan mendapatkan SESSION status
if (isset($_SESSION['status'])) {
	$sessionStatus=$_SESSION['status'];
}else{
	$sessionStatus=false;
}

// mengecek dan mendapatkan data dan memasukkan nilai kedalam variable
if (isset($_SESSION['nama'])) {
	$sessionNama=$_SESSION['nama'];
}else{
	$sessionNama="";
}
if (isset($_SESSION['level'])) {
	$sessionLevel=$_SESSION['level'];
}else{
	$sessionLevel="";
}
if (isset($_SESSION['id'])) {
	$sessionid=$_SESSION['id'];
}else{
	$sessionid="";
}
?>