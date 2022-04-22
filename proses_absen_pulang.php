<?php
include"koneksi.php";
$id = $_GET['id'];

$tz = 'Asia/Makassar';
$dt = new DateTime("now", new DateTimeZone($tz));
$timestamp = $dt->format('h:i:s');

$query1 = "UPDATE tbl_absensi SET jam_pulang='$timestamp', status_pulang='1' WHERE id_absensi='$id'";
$sql1 = mysqli_query($connect, $query1); 
	if ($sql1) {
		header("location:dashboard.php?p=data_absesnsi&notif=berhasil");
    }else{
    	header("location:dashboard.php?p=data_absesnsi&id=".$id."&notif=gagal");
       }
?>