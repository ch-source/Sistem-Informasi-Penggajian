<?php
include "koneksi.php";
session_start();
$id=$_GET['id'];
$level=$_POST['level'];
$username=$_POST['username'];
$password=$_POST['password'];

$data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user WHERE username='$_SESSION[masuk]'")); 
if ($data['level'] == 'Bendahara Komite') {
	$konten =$data['id_user'];

$query1 = "UPDATE tbl_user SET nama_user='$username', username='$username', password='$password', level='$level' WHERE id_user='$id'";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		if ($konten==$id) {
			header("location:index.php?notif=ubah-sukses");
		}else{
		header("location:dashboard.php?p=data_users&notif=ubah-berhasil");
		}
	}else{
		header("location:dashboard.php?p=edit_user&id=".$id."&notif=gagal");
    }
}
?>