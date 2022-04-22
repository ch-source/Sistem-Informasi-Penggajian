
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Laporan Tunjangan Wali Kelas</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal" method="POST" action="laporan/laporan_wk.php" target="_blank">
              <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Periode</label>
                                          <div class="col-sm-10">
                                              <select name="periode" class="form-control" required="required">
                                                  <option value="1">Januari</option>
                                                  <option value="2">Februari</option>
                                                  <option value="3">Maret</option>
                                                  <option value="4">April</option>
                                                  <option value="5">Mei</option>
                                                  <option value="6">Juni</option>
                                                  <option value="7">Juli</option>
                                                  <option value="8">Agustus</option>
                                                  <option value="9">September</option>
                                                  <option value="10">Oktober</option>
                                                  <option value="11">November</option>
                                                  <option value="12">Desember</option>
                                              </select>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-4">
                                  <div class="form-group">
                                          <label class="col-sm-2 control-label">Tahun</label>
                                          <div class="col-sm-10">
                                              <select name="tahun" class="form-control">
                                                  <?php
                                                  $mulai= date('Y') - 50;
                                                  for($i = $mulai; $i<$mulai + 100;$i++){
                                                  $sel = $i == date('Y') ? ' selected="selected"' : '';
                                                  echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                                                  }
                                                  ?>
                                              </select>
                                          </div>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan Tunjangan WK</button>
                                </div>
                              </div>
            </form>
          </div>
        </div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tabel Data Tunjangan Wali Kelas</h3>
          </div>
           <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai-Nama Pegawai</th>
                  <th>Data Tunjangan Wali Kelas</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_pegawai WHERE jabatan IN ('Guru')";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_pegawai'];?>-<?php echo $data_user['nama_pegawai'];?></td>
                  <td>
                  <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID Tunjangan WK</th>
                  <th>Tanggal</th>
                  <th>P/T</th>
                  <th>Jml. Tunjangan WK</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query="SELECT * FROM tbl_kt WHERE id_pegawai='".$data_user['id_pegawai']."'";
                  $sql=mysqli_query($connect, $query);
                  while ($data=mysqli_fetch_array($sql)) {
                  ?>
                <tr>
                  <td><?php echo $data['id_kt'];?></td>
                  <td><?php echo $data['tgl_kt'];?></td>
                  <td><?php echo $data['periode_kt'];?>/<?php echo $data['tahun_kt'];?></td>
                  <td>
                   <?php 
                    $jml= $data['jml_tunjangan_wk'];
                    echo "Rp. ".number_format($jml, 2, ".", ".");
                  ?>
                 </td>
                </tr>
                <?php }?>
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
            <a href="dashboard.php?p=data_tunjangan_wk" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
          </div>
        </div>
      </section>
     