<?php
include "koneksi.php";
$id=$_POST['id'];
$pegawai=$_POST['pegawai'];
$tgl=$_POST['tgl'];
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$jp=$_POST['jp'];
$ptg=$_POST['ptg'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_rekap_ptngn WHERE periode_ptngn = '$bulan' AND tahun_ptngn = '$tahun' AND id_pegawai = '$pegawai'");
$result = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
$ttlptngn=$data['ttl_ptngn']+$ptg;

if ($result > 0) {
	$query1 = "INSERT INTO `tbl_potongan` (`id_potongan`, `id_pegawai`, `tgl_ptngn`, `periode_ptngn`, `tahun_ptngn`, `jenis_ptngn`, `jml_ptngn`) VALUES ('$id', '$pegawai', '$tgl', '$bulan', '$tahun', '$jp', '$ptg')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "UPDATE tbl_rekap_ptngn SET ttl_ptngn='$ttlptngn' WHERE periode_ptngn = '$bulan' AND tahun_ptngn = '$tahun' AND id_pegawai = '$pegawai'";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			header("location:dashboard.php?p=data_potongan&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_potongan&notif=gagal");
		}
	}

}else if ($result ==0) {
	$query1 = "INSERT INTO `tbl_potongan` (`id_potongan`, `id_pegawai`, `tgl_ptngn`, `periode_ptngn`, `tahun_ptngn`, `jenis_ptngn`, `jml_ptngn`) VALUES ('$id', '$pegawai', '$tgl', '$bulan', '$tahun', '$jp', '$ptg')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "INSERT INTO `tbl_rekap_ptngn` (`id_rp`, `id_pegawai`, `periode_ptngn`, `tahun_ptngn`, `ttl_ptngn`) VALUES ('', '$pegawai', '$bulan', '$tahun', '$ttlptngn')";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			header("location:dashboard.php?p=data_potongan&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_potongan&notif=gagal");
		}
	}
}
?>