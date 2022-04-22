
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Hasil Rekapitulasi Potongan Pegawai</h3>
          </div>
          <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai</th>
                  <th>Periode</th>
                  <th>Tahun</th>
                  <th>Total Potongan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_rekap_ptngn ORDER BY id_pegawai ASC";
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
                  <td><?php echo $data_user['periode_ptngn'];?></td>
                  <td><?php echo $data_user['tahun_ptngn'];?></td>
                  <td>
                  <?php 
                    $ttlptngn= $data_user['ttl_ptngn'];
                    echo "Rp. ".number_format($ttlptngn, 2, ".", ".");
                  ?>
                  </td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="dashboard.php?p=data_potongan" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
            </div>
          </div>
        </div>
      </section>
     