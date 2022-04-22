<?php
include "koneksi.php";
$id=$_GET['id'];
$tgl=$_POST['tgl'];
$karyawan=$_POST['karyawan'];
$jm=$_POST['jm'];
$js=$_POST['js'];
$bulan=$_POST['bulan'];
$tahun=$_POST['tahun'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_rekap_lembur WHERE periode_lembur = '$bulan' AND tahun_lembur = '$tahun' AND id_karyawan = '$karyawan'");
$result = mysqli_num_rows($cek);
$data = mysqli_fetch_array($cek);
$jlhlembur=$data['jlh_lembur']+1;
if ($result > 0) {
	$query1 = "UPDATE tbl_lembur SET tgl_lembur='$tgl', jam_mulai='$jm', jam_selesai='$js', periode_lembur='$bulan', tahun_lembur='$tahun' WHERE id_lembur='$id'";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "UPDATE tbl_rekap_lembur SET jlh_lembur='$jlhlembur' WHERE periode_lembur = '$bulan' AND tahun_lembur = '$tahun' AND id_karyawan = '$karyawan'";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			echo "<script>alert('Data Lembur Berhasil Disimpan.');
			document.location.href='dashboard.php?p=data_lembur'</script>\n";
		}else{
			echo "<script>alert('Opss!!, Data Lembur Gagal Disimpan.');
			document.location.href='dashboard.php?p=data_lembur'</script>\n";
		}
	}

}else if ($result ==0) {
	$query1 = "INSERT INTO `tbl_lembur` (`id_lembur`, `id_karyawan`, `tgl_lembur`, `jam_mulai`, `jam_selesai`, `periode_lembur`, `tahun_lembur`) VALUES ('$id', '$karyawan', '$tgl', '$jm', '$js', '$bulan', '$tahun')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		$query2 = "INSERT INTO `tbl_rekap_lembur` (`id_rl`, `id_karyawan`, `periode_lembur`, `tahun_lembur`, `jlh_lembur`) VALUES ('', '$karyawan', '$bulan', '$tahun', '1')";
		$sql2 = mysqli_query($connect, $query2); 
		if ($sql2) {
			echo "<script>alert('Data Lembur Berhasil Disimpan.');
			document.location.href='dashboard.php?p=data_lembur'</script>\n";
		}else{
			echo "<script>alert('Opss!!, Data Lembur Gagal Disimpan.');
			document.location.href='dashboard.php?p=data_lembur'</script>\n";
		}
	}
}
$query1 = "UPDATE tbl_lembur SET tgl_lembur='$tgl', jam_mulai='$jm', jam_selesai='$js', periode_lembur='$bulan', tahun_lembur='$tahun' WHERE id_lembur='$id'";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		echo "<script>alert('Data Lembur Berhasil Diubah.');
        document.location.href='dashboard.php?p=data_lembur'</script>\n";
    }else{
        echo "<script>alert('Opss!!, Data Lembur Gagal Diubah.');
       	document.location.href='dashboard.php?p=edit_lembur&id=".$id."'</script>\n";
       }

?>