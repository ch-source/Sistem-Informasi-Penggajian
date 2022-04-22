
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Absensi</h3>
          </div>
          <div class="box-body">
            <div class="row">
            <div class="col-md-12">
                <a href="dashboard_pegawai.php?p=rekapitulasi_ketidakhadiran" class="btn btn-warning">
                <i class="fa fa-spinner"></i> Rekapitulasi Keterlambatan</a>
              </div>
            </div>
            <br>
            <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="success">
                  <th>No</th>
                  <th>ID Absensi</th>
                  <th>ID Pegawai</th>
                  <th>Periode</th>
                  <th>Tahun</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user WHERE username='$_SESSION[masuk]'")); 
                if ($data['level'] == 'Pegawai') {
                  $konten = $data['id_pegawai'];}
                  $no=1;
                  $query_user="SELECT * FROM tbl_absensi WHERE id_pegawai='$konten'";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_absensi'];?></td>
                  <td><?php echo $data_user['id_pegawai'];?></td>
                  <td><?php echo $data_user['periode'];?></td>
                  <td><?php echo $data_user['tahun'];?></td>
                  <td><?php echo $data_user['tanggal'];?></td>
                  <td><?php echo $data_user['jam_masuk'];?></td>
                  <td><?php echo $data_user['jam_pulang'];?></td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     