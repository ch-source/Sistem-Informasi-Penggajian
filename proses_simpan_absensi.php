<?php
include "koneksi.php";
$id=$_POST['id'];
$pegawai=$_POST['pegawai'];
$tgl=$_POST['tgl'];
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$jm=$_POST['jm'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_absensi WHERE tanggal = '".date('d/m/Y')."' AND id_pegawai = '$pegawai'");
$result = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
if ($result > 0) {
	header("location:dashboard.php?p=data_absesnsi&notif=oke");
}else if ($result ==0) {
	$query1 = "INSERT INTO `tbl_absensi` (`id_absensi`, `id_pegawai`, `tanggal` , `periode`,`tahun`, `jam_masuk`, `jam_pulang`, `status_pulang`) VALUES ('$id', '$pegawai', '$tgl', '$bulan', '$tahun', '$jm', '', '')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
			header("location:dashboard.php?p=data_absesnsi&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_absesnsi&notif=gagal");
		}
}
?>