
      
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Hasil Rekapitulasi Tunjangan Jabatan</h3>
          </div>
          <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai-Nama Pegawai</th>
                  <th>Hasil Rekapitulasi Tunjangan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user WHERE username='$_SESSION[masuk]'")); 
                if ($data['level'] == 'Guru') {
                  $konten = $data['id_pegawai'];}
                  $no=1;
                  $query_user="SELECT * FROM tbl_pegawai WHERE id_pegawai='$konten'";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_pegawai'];?>-<?php echo $data_user['nama_pegawai'];?></td>
                  <td>
                    <table class="table table-bordered" style="font-size: 12px;">
                    <thead>
                      <tr class="info">
                        <th>No</th>
                        <th>Periode/Tahun</th>
                        <th>Total Tunjangan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $nob=1;
                        $query_q="SELECT * FROM tbl_rekap_tunjangan WHERE id_pegawai='".$data_user['id_pegawai']."'";
                        $sql_q=mysqli_query($connect, $query_q);
                        while ($data_q=mysqli_fetch_array($sql_q)) {
                        ?>
                      <tr class="info">
                        <td><?php echo $nob;?></td>
                        <td><?php echo $data_q['periode_tjng'];?>/<?php echo $data_q['tahun_tjng'];?></td>
                        <td>
                          <?php 
                          $ttltnjngn= $data_q ['ttl_tnjngn'];
                          echo "Rp. ".number_format($ttltnjngn, 2, ".", ".");
                          ?>
                        </td>
                      </tr>
                      <?php  $nob++;}?>
                    </tbody>
                  </table>
                  </td>
                 
                </tr>
                
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="dashboard_guru.php?p=data_tunjangan" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
          </div>
        </div>
      </section>