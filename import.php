<?php
/*
-- Source Code from My Notes Code (www.mynotescode.com)
--
-- Follow Us on Social Media
-- Facebook : http://facebook.com/mynotescode/
-- Twitter  : http://twitter.com/mynotescode
-- Google+  : http://plus.google.com/118319575543333993544
--
-- Terimakasih telah mengunjungi blog kami.
-- Jangan lupa untuk Like dan Share catatan-catatan yang ada di blog kami.
*/

// Load file koneksi.php
include "koneksi.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	$nama_file_baru = 'data.xlsx';

	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';

	$excelreader = new PHPExcel_Reader_Excel2007();
	$loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file excel yang tadi diupload ke folder tmp
	$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

	$numrow = 1;
	foreach($sheet as $row){
		// Ambil data pada excel sesuai Kolom
		$id_absensi = $row['A']; // Ambil data NIS
		$id_pegawai = $row['B']; // Ambil data nama
		$periode = $row['C']; // Ambil data jenis kelamin
		$tahun = $row['D']; // Ambil data telepon
		$tanggal = $row['E']; // Ambil data alamat
		$jam_masuk = $row['F']; // Ambil data alamat
		$jam_pulang = $row['G']; // Ambil data alamat

		// Cek jika semua data tidak diisi
		if($id_absensi == "" && $id_pegawai == "" && $periode == "" && $tahun == "" && $tanggal == "" && $jam_masuk == "" && $jam_pulang == "")
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
			// Buat query Insert
			$query = "INSERT INTO tbl_absensi VALUES('".$id_absensi."','".$id_pegawai."','".$periode."','".$tahun."','".$tanggal."','".$jam_masuk."','".$jam_pulang."')";

			// Eksekusi $query
			mysqli_query($connect, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: dashboard.php?p=data_absesnsi&notif=import-sukses'); // Redirect ke halaman awal
?>
