<?php
include"koneksi.php";
$id=$_GET['id'];
$periode1=$_GET['periode1'];
$tahun1=$_GET['tahun1'];
$idabsensi=$_POST['idabsensi'];
$idpegawai=$_POST['idpegawai'];
$periode=$_POST['periode'];
$tahun=$_POST['tahun'];
$jam=$_POST['jam'];
$masuk=$_POST['masuk'];
$sm=$_POST['sm'];

$cek = mysqli_query($connect, "SELECT * FROM tbl_rekap_a WHERE periode = '$periode1' AND tahun = '$tahun1' AND id_pegawai='$id'");
        $result = mysqli_num_rows($cek);
        $data = mysqli_fetch_array($cek);
        if ($result > 0) {
        	$query_hapus="DELETE FROM tbl_rekap_a  WHERE periode = '$periode1' AND tahun = '$tahun1' AND id_pegawai='$id'";
        	$sql_hapus=mysqli_query($connect, $query_hapus);
        	
        	$count=count($idabsensi);
        	$sql="INSERT INTO tbl_rekap_a (id_absensi, id_pegawai, periode, tahun, jam_masuk, masuk, status_masuk) VALUES ";
			for ($i=0; $i <$count ; $i++) { 
				$sql.="('{$idabsensi[$i]}', '{$idpegawai[$i]}', '{$periode[$i]}', '{$tahun[$i]}','{$jam[$i]}', '{$masuk[$i]}', '{$sm[$i]}')";
				$sql.=",";
			}
			$sql=rtrim($sql,",");
			$insert=$connect->query($sql);
			if (!$insert) {
				header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=gagal-rekap");
				
			}else{
				header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=berhasil-rekap");
			}
        }else if ($result ==0) {
        	$count=count($idabsensi);
        	$sql="INSERT INTO tbl_rekap_a (id_absensi, id_pegawai, periode, tahun, jam_masuk, masuk, status_masuk) VALUES ";
			for ($i=0; $i <$count ; $i++) { 
				$sql.="('{$idabsensi[$i]}', '{$idpegawai[$i]}', '{$periode[$i]}', '{$tahun[$i]}','{$jam[$i]}', '{$masuk[$i]}', '{$sm[$i]}')";
				$sql.=",";
			}
			$sql=rtrim($sql,",");
			$insert=$connect->query($sql);
			if (!$insert) {
				header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=gagal-rekap");
				
			}else{
				header("location:dashboard.php?p=rekapitulasi_ketidakhadiran&notif=berhasil-rekap");
			}

        }
    ?>

