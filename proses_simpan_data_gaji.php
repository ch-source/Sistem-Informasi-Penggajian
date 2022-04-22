<?php
include"koneksi.php";
$id=$_GET['id'];
$ukt=$_POST['ukt'];
$uf=$_POST['uf'];
$pk=$_POST['pk'];


$query="INSERT INTO `tbl_data_gaji` (`id_data_gaji`, `id_pegawai`, `gapok`, `tunjangan_ijazah`, `potongan_keterlambatan`) VALUES ('', '$id', '$ukt', '$uf', '$pk')";
$sql=mysqli_query($connect, $query);
if ($sql) {
	$query1="UPDATE tbl_pegawai SET status_data_gaji='Ok' WHERE id_pegawai='$id'";
	$sql1=mysqli_query($connect, $query1);
	header("location:dashboard.php?p=data_gaji_pegawai&notif=berhasil");
}else{
	header("location:dashboard.php?p=input_data_gaji&id=".$id."&notif=gagal");
}
?>

