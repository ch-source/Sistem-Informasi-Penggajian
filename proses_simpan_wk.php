<?php
include "koneksi.php";
$id=$_POST['id'];
$guru=$_POST['guru'];
$tgl=$_POST['tgl'];
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$jml=$_POST['jml'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_rekap_kt WHERE periode_rkt='$bulan' AND tahun_rkt='$tahun' AND id_pegawai = '$guru'");
$result = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
$jmlkt=$data['jml_kt']+$jml;
if ($result > 0) {
	$query1 = "INSERT INTO `tbl_kt` (`id_kt`, `id_pegawai`, `tgl_kt`, `periode_kt`, `tahun_kt`, `jml_tunjangan_wk`) VALUES ('$id', '$guru', '$tgl', '$bulan', '$tahun', '$jml')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "UPDATE tbl_rekap_kt SET jml_kt='$jmlkt' WHERE periode_rkt='$bulan' AND tahun_rkt='$tahun' AND id_pegawai = '$guru'";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			header("location:dashboard.php?p=data_tunjangan_wk&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_tunjangan_wk&notif=gagal");
		}
	}

}else if ($result ==0) {
	$query1 = "INSERT INTO `tbl_kt` (`id_kt`, `id_pegawai`, `tgl_kt`, `periode_kt`, `tahun_kt`, `jml_tunjangan_wk`) VALUES ('$id', '$guru', '$tgl', '$bulan', '$tahun', '$jml')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "INSERT INTO `tbl_rekap_kt` (`id_rkt`, `id_pegawai`, `periode_rkt`, `tahun_rkt`, `jml_kt`) VALUES ('', '$guru', '$bulan', '$tahun', '$jmlkt')";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			header("location:dashboard.php?p=data_tunjangan_wk&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_tunjangan_wk&notif=gagal");
		}
	}
}
?>