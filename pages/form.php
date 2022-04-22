
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Import Data Absensi Pegawai</h3>
          </div>
          <div class="box-body">
          <!-- Buat sebuah tombol Cancel untuk kemabli ke halaman awal / view data -->
          <a href="dashboard.php?p=data_absesnsi" class="btn btn-danger pull-right">
            <i class="glyphicon glyphicon-remove"></i> Batal
          </a>
          <!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
          <form method="post" action="" enctype="multipart/form-data">

            <!--
            -- Buat sebuah input type file
            -- class pull-left berfungsi agar file input berada di sebelah kiri
            -->
            <input type="file" name="file" class="pull-left">

            <button type="submit" name="preview" class="btn btn-success btn-sm">
              <i class="glyphicon glyphicon-eye-open"></i> Preview
            </button>
          </form>

          <hr>

          <!-- Buat Preview Data -->
          <?php
          // Jika user telah mengklik tombol Preview
          if(isset($_POST['preview'])){
            //$ip = ; // Ambil IP Address dari User
            $nama_file_baru = 'data.xlsx';

            // Cek apakah terdapat file data.xlsx pada folder tmp
            if(is_file('tmp/'.$nama_file_baru)) // Jika file tersebut ada
              unlink('tmp/'.$nama_file_baru); // Hapus file tersebut

            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION); // Ambil ekstensi filenya apa
            $tmp_file = $_FILES['file']['tmp_name'];

            // Cek apakah file yang diupload adalah file Excel 2007 (.xlsx)
            if($ext == "xlsx"){
              // Upload file yang dipilih ke folder tmp
              // dan rename file tersebut menjadi data{ip_address}.xlsx
              // {ip_address} diganti jadi ip address user yang ada di variabel $ip
              // Contoh nama file setelah di rename : data127.0.0.1.xlsx
              move_uploaded_file($tmp_file, 'tmp/'.$nama_file_baru);

              // Load librari PHPExcel nya
              require_once 'PHPExcel/PHPExcel.php';

              $excelreader = new PHPExcel_Reader_Excel2007();
              $loadexcel = $excelreader->load('tmp/'.$nama_file_baru); // Load file yang tadi diupload ke folder tmp
              $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

              // Buat sebuah tag form untuk proses import data ke database
              echo "<form method='post' action='import.php'>";

              // Buat sebuah div untuk alert validasi kosong
              echo "<table class='table table-bordered'>
              <tr>
                <th colspan='5' class='text-center'>Preview Data</th>
              </tr>
              <tr>
                <th>ID Cuti</th>
                <th>Id Pegawai</th>
                <th>Periode</th>
                <th>Tahun</th>
                <th>Tanggal</th>
                <th>Jam Masuk</th>
                <th>Jam Keluar</th>
              </tr>";
              $numrow = 1;
              $kosong = 0;
              foreach($sheet as $row){ // Lakukan perulangan dari data yang ada di excel
                // Ambil data pada excel sesuai Kolom
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
                  // Validasi apakah semua data telah diisi
                  $id_absensi_td = ( ! empty($id_absensi))? "" : " style='background: #E07171;'"; // Jika NIS kosong, beri warna merah
                  $id_pegawai_td = ( ! empty($id_pegawai))? "" : " style='background: #E07171;'"; // Jika Nama kosong, beri warna merah
                  $periode_td = ( ! empty($periode))? "" : " style='background: #E07171;'"; // Jika Jenis Kelamin kosong, beri warna merah
                  $tahun_td = ( ! empty($tahun))? "" : " style='background: #E07171;'"; // Jika Telepon kosong, beri warna merah
                  $tanggal_td = ( ! empty($tanggal))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $jam_masuk_td = ( ! empty($jam_masuk))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah
                  $jam_pulang_td = ( ! empty($jam_pulang))? "" : " style='background: #E07171;'"; // Jika Alamat kosong, beri warna merah

                  // Jika salah satu data ada yang kosong

                  if($id_absensi == "" or $id_pegawai == "" or $periode == "" or $tahun == "" or $tanggal == "" or $jam_masuk == "" or $jam_pulang == ""){
                    $kosong++; // Tambah 1 variabel $kosong
                  }

                  echo "<tr>";
                  echo "<td".$id_absensi_td.">".$id_absensi."</td>";
                  echo "<td".$id_pegawai_td.">".$id_pegawai."</td>";
                  echo "<td".$periode_td.">".$periode."</td>";
                  echo "<td".$tahun_td.">".$tahun."</td>";
                  echo "<td".$tanggal_td.">".$tanggal."</td>";
                  echo "<td".$jam_masuk_td.">".$jam_masuk."</td>";
                  echo "<td".$jam_pulang_td.">".$jam_pulang."</td>";
                  echo "</tr>";
                }

                $numrow++; // Tambah 1 setiap kali looping
              }

              echo "</table>";

              // Cek apakah variabel kosong lebih dari 1
              // Jika lebih dari 1, berarti ada data yang masih kosong
              if($kosong > 1){
              ?>
                <script>
                $(document).ready(function(){
                  // Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
                  $("#jumlah_kosong").html('<?php echo $kosong; ?>');

                  $("#kosong").show(); // Munculkan alert validasi kosong
                });
                </script>
              <?php
              }else{ // Jika semua data sudah diisi
                echo "<hr>";

                // Buat sebuah tombol untuk mengimport data ke database
                echo "<button type='submit' name='import' class='btn btn-primary'><i class='glyphicon glyphicon-upload'></i> Import</button>";
              }

              echo "</form>";
            }else{ // Jika file yang diupload bukan File Excel 2007 (.xlsx)
              // Munculkan pesan validasi
              echo "<div class='alert alert-danger'>
              Hanya File Excel 2007 (.xlsx) yang diperbolehkan
              </div>";
            }
          }
          ?>
        </div>
      </div>
  
    </section>
     