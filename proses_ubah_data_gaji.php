<?php
include"koneksi.php";
$id=$_GET['id'];
$gapok=$_POST['gapok'];
$ukt=$_POST['ukt'];
$pk=$_POST['pk'];

$query="UPDATE tbl_data_gaji SET gapok='$gapok', tunjangan_ijazah='$ukt', potongan_keterlambatan='$pk' WHERE id_pegawai='$id'";
$sql=mysqli_query($connect, $query);
if ($sql) {
	header("location:dashboard.php?p=data_gaji_pegawai&notif=ubah-berhasil");
}else{
	header("location:dashboard.php?p=edit_data_gaji&id=".$id."&notif=gagal");
}
?>

