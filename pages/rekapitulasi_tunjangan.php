
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Hasil Rekapitulasi Tunjangan Pegawai</h3>
          </div>
          <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai-Nama Pegawai</th>
                  <th>P/T</th>
                  <th>Total Tunjangan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_rekap_tunjangan ORDER BY id_pegawai ASC";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {

                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <?php
                        $query="SELECT*FROM tbl_pegawai WHERE id_pegawai='".$data_user['id_pegawai']."'";
                      $sql=mysqli_query($connect, $query);
                      $data=mysqli_fetch_array($sql) ?>
                  <td><?php echo $data_user['id_pegawai'];?>-<?php echo $data['nama_pegawai'];?></td>
                  <td><?php echo $data_user['periode_tjng'];?>/<?php echo $data_user['tahun_tjng'];?></td>
                  <td>
                  <?php 
                    $ttltnjngn= $data_user['ttl_tnjngn'];
                    echo "Rp. ".number_format($ttltnjngn, 2, ".", ".");
                  ?>
                  </td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="dashboard.php?p=data_tunjangan" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
            </div>
          </div>
        </div>
      </section>
     