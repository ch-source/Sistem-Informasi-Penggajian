<?php
include "koneksi.php";
$query = "SELECT max(id_user) as maxId FROM tbl_user";
$hasil = mysqli_query($connect,$query);
$data = mysqli_fetch_array($hasil);
$iduser = $data['maxId'];
$noUrut = (int) substr($iduser, 3, 3);
$noUrut++;
$char = "USR";
$iduser= $char . sprintf("%03s", $noUrut);

$pegawai=$_POST['pegawai'];
$level=$_POST['level'];
$username=$_POST['username'];
$password=$_POST['password'];
$cek = mysqli_query($connect, "SELECT * FROM tbl_user WHERE username = '$username'");
$result = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
if ($result > 0) {
	header("location:dashboard.php?p=data_users&notif=username-ada");
}else if ($result ==0){
	$query1 = "INSERT INTO `tbl_user` (`id_user`, `id_pegawai`, `nama_user`, `username`, `password`, `level`) VALUES ('$iduser', '$pegawai', '$username', '$username', '$password', '$level')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "UPDATE tbl_pegawai SET status_user='Ok' WHERE id_pegawai='$pegawai'";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql1) {
			header("location:dashboard.php?p=data_users&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_users&notif=gagal");
		}
	}
}

?>