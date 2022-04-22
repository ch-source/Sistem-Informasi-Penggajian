
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Rekapitulasi Keterlambatan</h3>
          </div>
          <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai</th>
                  <th>Data Keterlambatan</th>
                  <th>Hasil Rekapitulasi Keterlambatan</th>
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
                      <tr class="warning">
                        <th>No</th>
                        <th>Periode/Tahun</th>
                        <th>Jam Masuk</th>
                        <th>Masuk</th>
                        <th>Status Masuk</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $noa=1;
                        $query="SELECT * FROM tbl_rekap_a WHERE id_pegawai='".$data_user['id_pegawai']."'";
                        $sql=mysqli_query($connect, $query);
                        while ($data=mysqli_fetch_array($sql)) {
                        ?>
                      <tr class="warning">
                        <td><?php echo $noa;?></td>
                        <td><?php echo $data['periode'];?>/<?php echo $data['tahun'];?></td>
                        <td><?php echo $data['jam_masuk'];?></td>
                        <td><?php echo $data['masuk'];?></td>
                        <td><?php echo $data['status_masuk'];?></td>
                      </tr>
                      <?php  $noa++;}?>
                    </tbody>
                  </table>
                  </td>
                  <td>
                    <table class="table table-bordered" style="font-size: 12px;">
                    <thead>
                      <tr class="info">
                        <th>No</th>
                        <th>Periode/Tahun</th>
                        <th>Total Keterlambatan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $nob=1;
                        $query_q="SELECT * FROM tbl_rekap_absen WHERE id_pegawai='".$data_user['id_pegawai']."'";
                        $sql_q=mysqli_query($connect, $query_q);
                        while ($data_q=mysqli_fetch_array($sql_q)) {
                        ?>
                      <tr class="info">
                        <td><?php echo $nob;?></td>
                        <td><?php echo $data_q['periode'];?>/<?php echo $data_q['tahun'];?></td>
                        <td><?php echo $data_q['jlh_terlambat'];?> Hari</td>
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
            <a href="dashboard_guru.php?p=data_absesnsi" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
          </div>
        </div>
      </section>
     