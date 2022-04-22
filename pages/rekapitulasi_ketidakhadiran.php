
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Rekapitulasi Keterlambatan Pegawai</h3>
          </div>
          <div class="box-body">
             <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="berhasil-rekap"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=rekapitulasi_ketidakhadiran' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Proses Rekapitulasi Keterlambatan Pegawai <b>Sukses.</b>
                        </div>";
                }if($_GET['notif']=="hitung-rekap"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=rekapitulasi_ketidakhadiran' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i>  Proses Hitung Keterlambatan Pegawai <b>Sukses.</b>
                        </div>";
                }if($_GET['notif']=="hitung-hadir"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=rekapitulasi_ketidakhadiran' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i>  Proses Hitung Ketidakhadiran Pegawai <b>Sukses.</b>
                        </div>";
                }if($_GET['notif']=="gagal-rekap"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=rekapitulasi_ketidakhadiran' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Opss!, Proses Rekapitulasi Keterlambatan Pegawai <b>Gagal.</b>
                        </div>";
                }if($_GET['notif']=="gagal-hitung"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=rekapitulasi_ketidakhadiran' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Opss!, Proses Hitung Keterlambatan Pegawai <b>Gagal.</b>
                        </div>";
                }if($_GET['notif']=="gagal-hadir"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=rekapitulasi_ketidakhadiran' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Opss!, Proses Hitung Ketidakhadiran Pegawai <b>Gagal.</b>
                        </div>";
                }
              }
              ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai</th>
                  <th>Data Keterlambatan</th>
                  <th>Hasil Rekapitulasi Keterlambatan</th>
                  <th>Hasil Rekaptulasi Ketidakhadiran</th>
                  <th>Opsi</th>
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

                  <td>
                    <table class="table table-bordered" style="font-size: 12px;">
                    <thead>
                      <tr class="danger">
                        <th>No</th>
                        <th>Periode/Tahun</th>
                        <th>Hadir</th>
                        <th>Tidak Hadir</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $noc=1;
                        $query_x="SELECT * FROM tbl_rekap_kehadiran WHERE id_pegawai='".$data_user['id_pegawai']."'";
                        $sql_x=mysqli_query($connect, $query_x);
                        while ($data_x=mysqli_fetch_array($sql_x)) {
                        ?>
                      <tr class="danger">
                        <td><?php echo $noc;?></td>
                        <td><?php echo $data_x['periode'];?>/<?php echo $data_x['tahun'];?></td>
                        <td><?php echo $data_x['jml_hadir'];?> Hari</td>
                        <td><?php echo $data_x['jml_tdk_hadir'];?> Hari</td>
                      </tr>
                      <?php  $noc++;}?>
                    </tbody>
                  </table>
                  </td>
                  <td><a href="#" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-default<?php echo $data_user['id_pegawai'];?>" style="margin-bottom: 5px;"><i class="fa fa-edit"></i> Rekap Keterlambatan</a>
                  <a href="#" class="btn btn-info btn-xs"  data-toggle="modal" data-target="#modal-info<?php echo $data_user['id_pegawai'];?>" style="margin-bottom: 5px;"><i class="fa fa fa-spinner"></i> Hitung Keterlambatan</a>
                  <a href="#" class="btn btn-danger btn-xs"  data-toggle="modal" data-target="#modal-warning<?php echo $data_user['id_pegawai'];?>"><i class="fa fa fa-edit"></i> Rekap Ketidakhadiran</a>
                  </td>
                </tr>
                <div class="modal fade" id="modal-default<?php echo $data_user['id_pegawai'];?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Pilih Periode & Tahun Rekap</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                            $id=$data_user['id_pegawai'];
                            $query_modal="SELECT * FROM tbl_pegawai WHERE id_pegawai='$id'";
                            $sql_modal=mysqli_query($connect, $query_modal);
                            $data_modal=mysqli_fetch_array($sql_modal);
                            ?>
                              <form class="form-horizontal"  action="dashboard.php?p=rekap_absen&id=<?php echo $id;?>" role="form" method="post">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Periode</label>
                                          <div class="col-sm-8">
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
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Tahun</label>
                                          <div class="col-sm-8">
                                              <select name="tahun" class="form-control" required="required">
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
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-12" style="text-align:right; ">
                                        <button type="submit" class="btn btn-info"><i class="fa fa-angle-double-right"></i> Berikutnya</button>
                                      </div>
                                    </div>
                              </form>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                      </div>
                      <!-- /.modal -->

                    <div class="modal modal-info fade" id="modal-info<?php echo $data_user['id_pegawai'];?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Pilih Periode & Tahun</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                            $id_a=$data_user['id_pegawai'];
                            ?>
                              <form class="form-horizontal"  action="proses_hitung_keterlambatan.php?id_a=<?php echo $id_a;?>" role="form" method="post">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Periode</label>
                                          <div class="col-sm-8">
                                              <select name="periode_a" class="form-control" required="required">
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
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Tahun</label>
                                          <div class="col-sm-8">
                                              <select name="tahun_a" class="form-control" required="required">
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
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-12" style="text-align:right; ">
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
                                      </div>
                                    </div>
                              </form>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->



                    <div class="modal modal-warning fade" id="modal-warning<?php echo $data_user['id_pegawai'];?>">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Pilih Periode & Tahun</h4>
                          </div>
                          <div class="modal-body">
                            <?php
                            $id_b=$data_user['id_pegawai'];
                            ?>
                              <form class="form-horizontal"  action="proses_hitung_kehadiran.php?id_b=<?php echo $id_b;?>" role="form" method="post">
                                    <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Periode</label>
                                          <div class="col-sm-8">
                                              <select name="periode_b" class="form-control" required="required">
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
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="col-sm-4 control-label">Tahun</label>
                                          <div class="col-sm-8">
                                              <select name="tahun_b" class="form-control" required="required">
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
                                    </div>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-12" style="text-align:right; ">
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-save"></i> Simpan</button>
                                      </div>
                                    </div>
                              </form>
                          </div>
                        </div>
                        <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                    </div>
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
     