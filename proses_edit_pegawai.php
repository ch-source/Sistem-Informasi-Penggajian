<?php
include "koneksi.php";
$id=$_GET['id'];
$nama=$_POST['nama'];
$jk=$_POST['jk'];
$tgllahir=$_POST['tgllahir'];
$alamat=$_POST['alamat'];
$tglmulai=$_POST['tglmulai'];
$jabatan=$_POST['jabatan'];
$sk=$_POST['sk'];
$pt=$_POST['pt'];
$notelp=$_POST['notelp'];
$bank=$_POST['bank'];
$norek=$_POST['norek'];

$query1 = "UPDATE tbl_pegawai SET nama_pegawai='$nama', jk='$jk', tgl_lahir='$tgllahir', alamat='$alamat', tgl_mulai_kerja='$tglmulai', jabatan='$jabatan', sk='$sk', pendidikan_terakhir='$pt', no_telepon='$notelp',  bank='$bank', no_rekening='$norek' WHERE id_pegawai='$id'";
$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		header("location:dashboard.php?p=data_pegawai&notif=ubah-berhasil");
    }else{
    	header("location:dashboard.php?p=edit_pegawai&id=".$id."&notif=ubah-berhasil");
       }

?>