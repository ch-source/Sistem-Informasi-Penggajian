<?php
 session_start();
include "koneksi.php";
    if (isset($_POST['masuk'])) {
        $user = $_POST['Username'];
        $pass = $_POST['Password'];

        $cek = mysqli_query($connect, "SELECT * FROM tbl_user WHERE username = '$user' AND password = '$pass'");
        $result = mysqli_num_rows($cek);
        $data = mysqli_fetch_array($cek);
        if ($result > 0) {
            if ($data['level']=='Bendahara Komite') {
                $_SESSION['masuk'] = $user;
                 header("location:dashboard.php?p=halaman_awal&notif=login-sukses");      
            }elseif ($data['level']=='Pegawai') {
                $_SESSION['masuk'] = $user;
                header("location:dashboard_pegawai.php?p=halaman_awal&notif=login-sukses");
            }elseif ($data['level']=='Kepsek') {
                $_SESSION['masuk'] = $user;
                header("location:dashboard_kepsek.php?p=halaman_awal&notif=login-sukses");
            }elseif ($data['level']=='Guru') {
                $_SESSION['masuk'] = $user;
                header("location:dashboard_guru.php?p=halaman_awal&notif=login-sukses");
            }
        }else if ($result ==0) {
             header("location:index.php?notif=login-gagal");
            }
        }   
?>