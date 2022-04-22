<?php
include "koneksi.php";
$id=$_POST['id'];
$pegawai=$_POST['pegawai'];
$periode=$_POST['periode'];
$tahun=$_POST['tahun'];
$tgl=$_POST['tgl'];
$gapok=$_POST['gapok'];
$bkt=$_POST['bkt'];
$bf=$_POST['bf'];
$tb=$_POST['tb'];
$tjg=$_POST['tjg'];
$ptg=$_POST['ptg'];
$potongan=$_POST['potongan'];
$tp=$_POST['tp'];
$thr=$_POST['thr'];
$total=$_POST['total'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_gaji WHERE periode = '$periode' AND tahun = '$tahun' AND id_pegawai='$pegawai'");
        $result = mysqli_num_rows($cek);
        $data = mysqli_fetch_array($cek);
        if ($result > 0) {
            header("location:dashboard.php?p=data_gaji&notif=gagal-lagi");
        }else if ($result ==0) {
             $query1 = "INSERT INTO `tbl_gaji` (`id_gaji`, `id_pegawai`, `periode`, `tahun`, `tanggal`, `gapok`, `bonus_full_absen`, `bonus_kls_tmbhn`, `jml_bonus`, `tunjangan`, `potongan`, `potongan_terlambat`, `ttl_potongan`, `thr`, `total_gaji`) VALUES ('$id', '$pegawai', '$periode', '$tahun', '$tgl', '$gapok', '$bf', '$bkt', '$tb', '$tjg', '$ptg', '$potongan', '$tp', '$thr', '$total')";
			$sql1 = mysqli_query($connect, $query1); 
			if ($sql1) {
				 header("location:dashboard.php?p=data_gaji&notif=berhasil");
		    }else{
		         header("location:dashboard.php?p=data_gaji&notif=gagal");
		       }
		 }

?>