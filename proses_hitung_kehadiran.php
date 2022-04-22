<?php
include"koneksi.php";
$id_b=$_GET['id_b'];
$periode_b=$_POST['periode_b'];
$tahun_b=$_POST['tahun_b'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_rekap_kehadiran WHERE periode = '$periode_b' AND tahun = '$tahun_b' AND id_pegawai='$id_b'");
        $result = mysqli_num_rows($cek);
        $data = mysqli_fetch_array($cek);
        if ($result > 0) {
            $query_hapus="DELETE FROM tbl_rekap_kehadiran WHERE periode = '$periode_b' AND tahun = '$tahun_b' AND id_pegawai='$id_b'";
            $sql_hapus=mysqli_query($connect, $query_hapus);
            $order="SELECT * FROM tbl_rekap_a WHERE periode='$periode_b' AND tahun='$tahun_b' AND id_pegawai='$id_b'";
            $query_order=mysqli_query($connect, $order);
            $data_order=array();
            while(($row_order=mysqli_fetch_array($query_order)) !=null){
            $data_order[]=$row_order;
            }
            $count=count($data_order);
            $th= 26 - $count;
        
            $query_insert="INSERT INTO `tbl_rekap_kehadiran` (`id_rekap_k`, `id_pegawai`, `periode`, `tahun`, `jml_hadir`, `jml_tdk_hadir`) VALUES ('', '$id_b', '$periode_b', '$tahun_b', '$count', '$th')";
            $sql_insert=mysqli_query($connect, $query_insert);
            if ($sql_insert) {
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=hitung-hadir");
            }else{
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=gagal-hadir");
            }
        }else if ($result ==0) {
            $order="SELECT * FROM tbl_rekap_a WHERE periode='$periode_b' AND tahun='$tahun_b' AND id_pegawai='$id_b'";
            $query_order=mysqli_query($connect, $order);
            $data_order=array();
            while(($row_order=mysqli_fetch_array($query_order)) !=null){
            $data_order[]=$row_order;
            }
            $count=count($data_order);
            $th= 26 - $count;
        
            $query_insert="INSERT INTO `tbl_rekap_kehadiran` (`id_rekap_k`, `id_pegawai`, `periode`, `tahun`, `jml_hadir`, `jml_tdk_hadir`) VALUES ('', '$id_b', '$periode_b', '$tahun_b', '$count', '$th')";
            $sql_insert=mysqli_query($connect, $query_insert);
            if ($sql_insert) {
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=hitung-hadir");
            }else{
                header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=gagal-hadir");
            }

        }
    ?>

