<?php
include"koneksi.php";
$id=$_GET['id_a'];
$periode_a=$_POST['periode_a'];
$tahun_a=$_POST['tahun_a'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_rekap_absen WHERE periode = '$periode_a' AND tahun = '$tahun_a' AND id_pegawai='$id'");
        $result = mysqli_num_rows($cek);
        $data = mysqli_fetch_array($cek);
        if ($result > 0) {
            $query_hapus="DELETE FROM tbl_rekap_absen WHERE periode = '$periode_a' AND tahun = '$tahun_a' AND id_pegawai='$id'";
            $sql_hapus=mysqli_query($connect, $query_hapus);
            $order="SELECT * FROM tbl_rekap_a WHERE status_masuk='Telat' AND periode='$periode_a' AND tahun='$tahun_a' AND id_pegawai='$id'";
            $query_order=mysqli_query($connect, $order);
            $data_order=array();
            while(($row_order=mysqli_fetch_array($query_order)) !=null){
            $data_order[]=$row_order;
            }
            $count=count($data_order);
        
            $query_insert="INSERT INTO `tbl_rekap_absen` (`id_rekap`, `id_pegawai`, `periode`, `tahun`, `jlh_terlambat`) VALUES ('', '$id', '$periode_a', '$tahun_a', '$count')";
            $sql_insert=mysqli_query($connect, $query_insert);
            if ($sql_insert) {
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=hitung-rekap");
            }else{
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=gagal-hitung");
            }
        }else if ($result ==0) {
            $order="SELECT * FROM tbl_rekap_a WHERE status_masuk='Telat' AND periode='$periode_a' AND tahun='$tahun_a' AND id_pegawai='$id'";
            $query_order=mysqli_query($connect, $order);
            $data_order=array();
            while(($row_order=mysqli_fetch_array($query_order)) !=null){
            $data_order[]=$row_order;
            }
            $count=count($data_order);
        
            $query_insert="INSERT INTO `tbl_rekap_absen` (`id_rekap`, `id_pegawai`, `periode`, `tahun`, `jlh_terlambat`) VALUES ('', '$id', '$periode_a', '$tahun_a', '$count')";
            $sql_insert=mysqli_query($connect, $query_insert);
            if ($sql_insert) {
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=hitung-rekap");
            }else{
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=gagal-hitung");
            }

        }
    ?>

