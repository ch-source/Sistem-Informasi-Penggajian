<?php
include "koneksi.php";
$pegawai=$_POST['idpegawai'];
$nama=$_POST['nama'];
$jk=$_POST['jk'];
$tgllahir=$_POST['tgllahir'];
$alamat=$_POST['alamat'];
$tglmulai=$_POST['tglmulai'];
$jabatan=$_POST['jabatan'];
$sk=$_POST['sk'];
$golongan=$_POST['golongan'];
$pt=$_POST['pt'];
$mk=$_POST['mk'];
$umur=$_POST['umur'];
$notelp=$_POST['notelp'];
$bank=$_POST['bank'];
$norek=$_POST['norek'];

$query1 = "INSERT INTO `tbl_pegawai` (`id_pegawai`, `nama_pegawai`, `jk`, `tgl_lahir`, `alamat`, `tgl_mulai_kerja`, `jabatan`, `sk`, `pendidikan_terakhir`, `no_telepon`, `bank`, `no_rekening`, `status_user`, `status_data_gaji`) VALUES ('$pegawai', '$nama', '$jk', '$tgllahir', '$alamat', '$tglmulai', '$jabatan', '$sk', '$pt', '$notelp', '$bank', '$norek', '', '')";
	$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		header("location:dashboard.php?p=data_pegawai&notif=berhasil");
    }else{
        header("location:dashboard.php?p=input_pegawai&notif=gagal");
}

?>