<?php
include "koneksi.php";
$id=$_POST['id'];
$pegawai=$_POST['pegawai'];
$tgl=$_POST['tgl'];
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];
$tj=$_POST['tj'];
$jmtj=$_POST['jmtj'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_rekap_tunjangan WHERE periode_tjng='$bulan' AND tahun_tjng='$tahun' AND id_pegawai = '$pegawai'");
$result = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
$ttltnjngn=$data['ttl_tnjngn']+$jmtj;
if ($result > 0) {
	$query1 = "INSERT INTO `tbl_tunjangan` (`id_tunjangan`, `id_pegawai`, `tgl_tnjngn` , `periode_tjn`, `tahun_tjn`, `tnjngn_jabatan`, `jml_tnjngn_jbtn`) VALUES ('$id', '$pegawai', '$tgl', '$bulan', '$tahun', '$tj', '$jmtj')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "UPDATE tbl_rekap_tunjangan SET ttl_tnjngn='$ttltnjngn' WHERE periode_tjng='$bulan' AND tahun_tjng='$tahun' AND id_pegawai = '$pegawai'";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			header("location:dashboard.php?p=data_tunjangan&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_tunjangan&notif=gagal");
		}
	}

}else if ($result ==0) {
	$query1 = "INSERT INTO `tbl_tunjangan` (`id_tunjangan`, `id_pegawai`, `tgl_tnjngn` , `periode_tjn`, `tahun_tjn`, `tnjngn_jabatan`, `jml_tnjngn_jbtn`) VALUES ('$id', '$pegawai', '$tgl', '$bulan', '$tahun', '$tj', '$jmtj')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "INSERT INTO `tbl_rekap_tunjangan` (`id_rt`, `id_pegawai`, `periode_tjng`, `tahun_tjng`, `ttl_tnjngn`) VALUES ('', '$pegawai', '$bulan', '$tahun', '$ttltnjngn')";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			header("location:dashboard.php?p=data_tunjangan&notif=berhasil");
		}else{
			header("location:dashboard.php?p=data_tunjangan&notif=gagal");
		}
	}
}
?>