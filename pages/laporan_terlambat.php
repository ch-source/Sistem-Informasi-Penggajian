
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Laporan Keterlambatan Pegawai</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal" method="POST" action="laporan/laporan_terlambat.php" target="_blank">
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
                                  <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan Keterlambatan</button>
                                </div>
                              </div>
            </form>
          </div>
        </div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Keterlambatan Pegawai/Guru</h3>
          </div>
          <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai</th>
                  <th>Rekapitulasi Keterlambatan</th>
                  <th>Hasil Rekapitulasi Keterlambatan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_pegawai ORDER BY id_pegawai ASC";
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
            <a href="dashboard.php?p=data_absesnsi" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
          </div>
        </div>
      </section>
     
     