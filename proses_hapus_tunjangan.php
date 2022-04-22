<?php
include "koneksi.php";
$id=$_GET['id'];


$cek = mysqli_query($connect, "SELECT * FROM tbl_lembur WHERE id_lembur='$id'");
$data = mysqli_fetch_array($cek);
$periode=$data['periode_lembur'];
$tahun=$data['tahun_lembur'];
$id_karyawan=$data['id_karyawan'];

$cek1 = mysqli_query($connect, "SELECT * FROM tbl_rekap_lembur WHERE periode_lembur='$periode' AND tahun_lembur='$tahun' AND id_karyawan='$id_karyawan'");
$data1 = mysqli_fetch_array($cek1);
$jlhlembur=$data1['jlh_lembur']-1;

$query="UPDATE tbl_rekap_lembur SET jlh_lembur='$jlhlembur' WHERE periode_lembur='$periode' AND tahun_lembur='$tahun' AND id_karyawan='$id_karyawan'";
$sql=mysqli_query($connect, $query);
if ($sql) {
	$query1="DELETE  FROM tbl_lembur WHERE id_lembur='$id'";
	$sql1=mysqli_query($connect, $query1);
	if ($sql) {
		echo "<script>alert('Data Lembur Berhasil Dihapus.');
			document.location.href='dashboard.php?p=data_lembur'</script>\n";
	}else{
		echo "<script>alert('Opss!!, Data Lembur Gagal Dihapus.');
			document.location.href='dashboard.php?p=data_lembur'</script>\n";
	}
}
?>