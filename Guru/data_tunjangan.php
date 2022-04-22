
     
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Rekapitulasi Tunjangan Jabatan</h3>
          </div>
          <div class="box-body">
            <div class="row">
            <div class="col-md-12">
              <a href="dashboard_guru.php?p=rekapitulasi_tunjangan" class="btn btn-warning">
                <i class="fa fa-spinner"></i> Rekapitulasi Tunjangan</a>
              </div>
            </div>
            <br>
            <br>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="success">
                  <th>No</th>
                  <th>ID Tunjangan</th>
                  <th>ID Pegawai</th>
                  <th>Tanggal</th>
                  <th>P/T</th>
                  <th>Tunjangan Jabatan</th>
                  <th>Jumlah Tunjangan Jabatan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user WHERE username='$_SESSION[masuk]'")); 
                if ($data['level'] == 'Guru') {
                  $konten = $data['id_pegawai'];}
                  $no=1;
                  $query_user="SELECT * FROM tbl_tunjangan WHERE id_pegawai='$konten'";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_tunjangan'];?></td>
                  <?php
                        $query="SELECT*FROM tbl_pegawai WHERE id_pegawai='".$data_user['id_pegawai']."'";
                      $sql=mysqli_query($connect, $query);
                      $data=mysqli_fetch_array($sql) ?>
                  <td><?php echo $data_user['id_pegawai'];?>-<?php echo $data['nama_pegawai'];?></td>
                  <td><?php echo $data_user['tgl_tnjngn'];?></td>
                  <td><?php echo $data_user['periode_tjn'];?>/<?php echo $data_user['tahun_tjn'];?></td>
                  <td><?php echo $data_user['tnjngn_jabatan'];?></td>
                  <td>
                  <?php 
                    $jmtj= $data_user['jml_tnjngn_jbtn'];
                    echo "Rp. ".number_format($jmtj, 2, ".", ".");
                  ?>
                  </td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </section>