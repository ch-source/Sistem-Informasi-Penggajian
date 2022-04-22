      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Detail Penggajian Pegawai</h3>
          </div>
          <div class="box-body" style="overflow: auto;">
           <table class="table table-bordered" style="font-size: 12px;">
            <thead>
              <th>Pegawai</th>
              <th>Tgl</th>
              <th>P/T</th>
              <th>Gapok</th>
              <th>Tunjangan Ijazah</th>
              <th>Tunjangan Wali Kelas</th>
              <th>Tunjangan Jabatan</th>
              <th>TTL. Tunjangan</th>
              <th>Potongan</th>
              <th>Jml. Terlambat</th>
              <th>Potongan Terlambat</th>
              <th>TTL. Potongan</th>
              <th>Total Gaji</th>
            </thead>
            <tbody>
          <?php
          if (isset($_POST['id_pegawai'])) {
                include"koneksi.php";
                $periode=$_POST['periode'];
                $tahun=$_POST['tahun'];
                if (isset($_POST['simpan'])){
                foreach ($_POST['id_pegawai'] as $value) {
              $cek_a = mysqli_query($connect, "SELECT * FROM tbl_gaji WHERE periode = '$periode' AND tahun= '$tahun' AND id_pegawai = '$value'");
                $result_a = mysqli_num_rows($cek_a);
                $data_a = mysqli_fetch_array($cek_a);
               
                if ($result_a > 0) {
                  echo "<script>alert('Opss!, Salah Satu / Beberapa Pegawai/Guru Yang Anda Pilih Sudah Terdaftar Di Tabel Gaji Untuk Periode Dan Tahun Yang Anda Pilih');
                  document.location.href='dashboard.php?p=gaji'</script>\n";
                }else{
                  $query="SELECT * FROM tbl_pegawai WHERE id_pegawai='$value'";
                  $sql=mysqli_query($connect, $query);
                  while ($data=mysqli_fetch_array($sql)) {
                    echo"<tr>";
                    echo"<td>".$data['id_pegawai']."/".$data['nama_pegawai']."</td>";
                    echo"<td>".date('m/d/Y')."</td>";
                    echo"<td>".$periode."/".$tahun."</td>";

                      $query_gaji="SELECT * FROM tbl_data_gaji WHERE id_pegawai='".$data['id_pegawai']."'";
                      $sql_gaji=mysqli_query($connect, $query_gaji);
                      $data_gaji=mysqli_fetch_array($sql_gaji);
                    echo"<td>Rp. ".$data_gaji['gapok']."</td>";
                    echo"<td>Rp. ".$data_gaji['tunjangan_ijazah']."</td>";

                      $query_kt="SELECT * FROM tbl_rekap_kt WHERE periode_rkt='$periode' AND tahun_rkt='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                      $sql_kt=mysqli_query($connect, $query_kt);
                      $data_kelas_tambahan=mysqli_fetch_array($sql_kt);
                    echo"<td>".$data_kelas_tambahan['jml_kt']."</td>";

                    $query_tunjangan="SELECT * FROM tbl_rekap_tunjangan WHERE periode_tjng='$periode' AND tahun_tjng='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                        $sql_tunjangan=mysqli_query($connect, $query_tunjangan);
                        $data_tunjangan=mysqli_fetch_array($sql_tunjangan);
                    echo"<td>Rp. ".$data_tunjangan['ttl_tnjngn']."</td>";

                    $ttl_tunjangan=$data_gaji['tunjangan_ijazah'] + $data_kelas_tambahan['jml_kt'] +  $data_tunjangan['ttl_tnjngn'];
                    echo"<td>Rp. ".$ttl_tunjangan."</td>";

                    $query_potongan="SELECT * FROM tbl_rekap_ptngn WHERE periode_ptngn='$periode' AND tahun_ptngn='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                        $sql_potongan=mysqli_query($connect, $query_potongan);
                        $data_potongan=mysqli_fetch_array($sql_potongan);
                        $potongan=$data_potongan['ttl_ptngn'];
                    echo"<td>Rp. ".$potongan."</td>";

                        $query_absen="SELECT * FROM tbl_rekap_absen WHERE periode='$periode' AND tahun='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                        $sql_absen=mysqli_query($connect, $query_absen);
                        $data_absen=mysqli_fetch_array($sql_absen);
                        $potongan_terlambat=$data_absen['jlh_terlambat'] * $data_gaji['potongan_keterlambatan'];
                        $ttl_potongan=$potongan + $potongan_terlambat;
                    echo"<td>".$data_absen['jlh_terlambat']." Hari</td>";
                    echo"<td>Rp. ".$potongan_terlambat."</td>";
                    echo"<td>Rp. ".$ttl_potongan."</td>";

                    $totalgaji=$data_gaji['gapok'] + $ttl_tunjangan - $ttl_potongan;
                    echo"<td>Rp. ".$totalgaji."</td>";
                    echo"<tr>";
                      }
                }
              }
            }else{
              echo "<script>alert('Opss!, Pegawai/Guru Belum Dipilih');
              document.location.href='dashboard.php?p=gaji'</script>\n";
            }
      ?>
    </tbody>
  </table>
            <hr>
            <hr>
            <form method='post' action='proses_simpan_gaji_1.php'>
              <div class="box-body" style="height:10px; overflow: auto;">
          <?php
          if (isset($_POST['id_pegawai'])) {
                include"koneksi.php";
                $periode=$_POST['periode'];
                $tahun=$_POST['tahun'];
                if (isset($_POST['simpan'])){
                foreach ($_POST['id_pegawai'] as $value) {
                  $query="SELECT * FROM tbl_pegawai WHERE id_pegawai='$value'";
                  $sql=mysqli_query($connect, $query);
                  while ($data=mysqli_fetch_array($sql)) {
                    echo"<div class='row'>";
                        echo"<div class='col-sm-6'>";
                          echo"<div class='form-group'>";
                          echo"<label>ID Pegawai</label>";
                            echo"<input type='text' name='id[]' readonly='readonly' class='form-control' value='".$data['id_pegawai']."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-6'>";
                          echo"<div class='form-group'>";
                          echo"<label>Nama Pegawai</label>";
                            echo"<input name='nama[]' type='text' readonly='readonly' class='form-control' value='".$data['nama_pegawai']."'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";
                      echo"<div class='row'>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Tgl</label>";
                            echo"<input type='text' name='tglgaji[]' readonly='readonly' value='".date('m/d/Y')."' class='form-control' required='required'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Periode</label>";
                          echo"<input type='text' name='periode[]' readonly='readonly' value='".$periode."' class='form-control' required='required'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Tahun</label>";
                            echo"<input type='text' name='tahun[]' readonly='readonly' value='".$tahun."' type='text' class='form-control' required='required'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";
                      $query_gaji="SELECT * FROM tbl_data_gaji WHERE id_pegawai='".$data['id_pegawai']."'";
                      $sql_gaji=mysqli_query($connect, $query_gaji);
                      $data_gaji=mysqli_fetch_array($sql_gaji);
                      echo"<div class='row'>";
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Gapok</label>";
                            echo"<input type='text' name='gapok[]' readonly='readonly' class='form-control' value='".$data_gaji['gapok']."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Tunjangan Ijazah</label>";
                            echo"<input type='text' readonly='readonly' name='tunjanganijazah[]' class='form-control' value='".$data_gaji['tunjangan_ijazah']."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Potongan Terlambat</label>";
                          echo"<input type='text' readonly='readonly' value='".$data_gaji['potongan_keterlambatan']."' class='form-control'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";
                      $query_kt="SELECT * FROM tbl_rekap_kt WHERE periode_rkt='$periode' AND tahun_rkt='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                      $sql_kt=mysqli_query($connect, $query_kt);
                      $data_kelas_tambahan=mysqli_fetch_array($sql_kt);
                      echo"<div class='row'>";
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Tunjangan Wali Kelas</label>";
                            echo"<input name='tunjanganwk[]' type='text' readonly='readonly' class='form-control' value='".$data_kelas_tambahan['jml_kt']."'>";
                          echo"</div>";
                        echo"</div>";
                        $query_tunjangan="SELECT * FROM tbl_rekap_tunjangan WHERE periode_tjng='$periode' AND tahun_tjng='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                        $sql_tunjangan=mysqli_query($connect, $query_tunjangan);
                        $data_tunjangan=mysqli_fetch_array($sql_tunjangan);
                        $tunjangan=$data_tunjangan['ttl_tnjngn'];

                        $ttl_tunjangan=$data_gaji['tunjangan_ijazah'] + $data_kelas_tambahan['jml_kt'] +  $data_tunjangan['ttl_tnjngn'];

                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Tunjangan Jabatan</label>";
                            echo"<input name='tunjanganjabatan[]' type='text' readonly='readonly'  class='form-control' value='".$data_tunjangan['ttl_tnjngn']."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Total Tunjangan</label>";
                            echo"<input name='ttltunjangan[]' type='text' readonly='readonly'  class='form-control' value='".$ttl_tunjangan."'>";
                          echo"</div>";
                        echo"</div>";
                        $query_potongan="SELECT * FROM tbl_rekap_ptngn WHERE periode_ptngn='$periode' AND tahun_ptngn='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                        $sql_potongan=mysqli_query($connect, $query_potongan);
                        $data_potongan=mysqli_fetch_array($sql_potongan);
                        $potongan=$data_potongan['ttl_ptngn'];
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Potongan</label>";
                            echo"<input name='datapotongan[]' type='text' readonly='readonly' class='form-control' value='".$data_potongan['ttl_ptngn']."' >";
                          echo"</div>";
                        echo"</div>";
                        $query_absen="SELECT * FROM tbl_rekap_absen WHERE periode='$periode' AND tahun='$tahun' AND id_pegawai='".$data['id_pegawai']."'";
                        $sql_absen=mysqli_query($connect, $query_absen);
                        $data_absen=mysqli_fetch_array($sql_absen);
                        $potongan_terlambat=$data_absen['jlh_terlambat'] * $data_gaji['potongan_keterlambatan'];
                        $ttl_potongan=$potongan + $potongan_terlambat;
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Jlh. Terlambat</label>";
                            echo"<input type='text' readonly='readonly' value='".$data_absen['jlh_terlambat']."' class='form-control' required='required'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Total Potongan Terlambat</label>";
                          echo"<input name='potonganterlambat[]' type='text' readonly='readonly'  class='form-control' value='".$potongan_terlambat."'>";
                          echo"</div>";
                        echo"</div>";
                        echo"<div class='col-sm-3'>";
                          echo"<div class='form-group'>";
                          echo"<label>Total Potongan</label>";
                          echo"<input name='ttlpotongan[]' type='text' readonly='readonly'  class='form-control' value='".$ttl_potongan."'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";
                     
                     $totalgaji=$data_gaji['gapok'] + $ttl_tunjangan - $ttl_potongan;
                      
                      echo"<div class='row'>";
                        echo"<div class='col-sm-4'>";
                          echo"<div class='form-group'>";
                          echo"<label>Total Gaji</label>";
                          echo"<input type='text' name='totalgaji[]' readonly='readonly' value='".$totalgaji."' class='form-control' required='required'>";
                          echo"</div>";
                        echo"</div>";
                      echo"</div>";


                      }
                }
              }
            }else{
              echo "<script>alert('Opss!, Pegawai/Guru Belum Dipilih');
              document.location.href='dashboard.php?p=gaji'</script>\n";
            }
          }
      ?>
       </div>
      <a href="dashboard.php?p=gaji" class="btn btn-danger"><i class="fa fa-close"></i> Tutup</a>
      <button type='submit' class='btn btn-success'><i class='fa fa-save'></i> Simpan Penggajian</i></button>
      </form>
          </div>
         
        </div>
      </section>
     