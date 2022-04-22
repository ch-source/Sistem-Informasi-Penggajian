      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Absensi Pegawai/Guru</h3>
          </div>
          <div class="box-body">
              <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="gagal"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_absesnsi' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Opss!, Data Absensi Pegawai/Guru <b> Gagal Disimpan.</b>
                        </div>";
                }if($_GET['notif']=="oke"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_absesnsi' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Opss!, Data Absensi Pegawai/Guru <b> Gagal Disimpan. Nama Pegawai Yang Di Pilih Sudah Melakukan Absensi Untuk Tanggal Hari Ini !!!</b>
                        </div>";
                }
              }
              ?>
            <form class="form-horizontal"  action="proses_simpan_absensi.php" role="form" method="post">
              <?php
              include "koneksi.php";
              $query = "SELECT max(id_absensi) as maxId FROM tbl_absensi";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil);
              $iduser = $data['maxId'];
              $noUrut = (int) substr($iduser, 3, 3);
              $noUrut++;
              $char = "ABS";
              $iduser= $char . sprintf("%03s", $noUrut);
              ?>
              <div class="form-group">
                    <label class="col-sm-2 control-label">ID Absensi</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" value="<?php echo $iduser;?>" name="id" readonly="readonly">
                    </div>
                    <label class="col-sm-2 control-label">Nama Pegawai/Guru</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="pegawai" autofocus="autofocus" required="required">
                        <option value="" selected="selected">Pilih Pegawai/Guru</option>
                        <?php 
                        $query="SELECT * FROM tbl_pegawai";
                        $sql=mysqli_query($connect, $query);
                        while($data1=mysqli_fetch_array($sql)){
                        echo"<option value='".$data1['id_pegawai']."''>".$data1['id_pegawai']."-".$data1['nama_pegawai']."</option>";
                      }
                      ?>
                      </select>
                    </div>
                  </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tanggal</label>
                      <div class="col-sm-4">
                      <input type="text" class="form-control" name="tgl" value="<?php echo date('d/m/Y');?>" readonly="readonly">
                    </div>
                   <label class="col-sm-2 control-label">Periode & Tahun</label>
                        <div class="col-sm-2">
                            <select name="bulan" class="form-control" required="required">
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
                        <div class="col-sm-2">
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
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Jam Masuk</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="jm" value="<?php ini_set('date.timezone', 'Asia/Makassar'); echo date('h:i:s'); ?>" readonly="readonly">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="text-align:right; ">
                      <button type="submit" class="btn btn-info" ><i class="fa fa-save"></i> Simpan Data Absensi</button>
                    </div>
                  </div>
            </form>
            <hr>
            <div class="row">
              <div class="col-sm-12" style="margin-bottom: 10px;">
                <a href="dashboard.php?p=rekapitulasi_ketidakhadiran" class="btn btn-warning">
                <i class="fa fa-spinner"></i> Rekap Keterlambatan</a>
              </div>
            </div>
            
             <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_absesnsi' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data Absensi Pegawai/Guru <b> Berhasil Disimpan.</b>
                        </div>";
                }
              }
              ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Absensi</th>
                  <th>ID Pegawai</th>
                  <th>Periode/Tahun</th>
                  <th>Tanggal</th>
                  <th>Jam Masuk</th>
                  <th>Jam Keluar</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_absensi";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_absensi'];?></td>
                  <td><?php echo $data_user['id_pegawai'];?></td>
                  <td><?php echo $data_user['periode'];?>/<?php echo $data_user['tahun'];?></td>
                  <td><?php echo $data_user['tanggal'];?></td>
                  <td><?php echo $data_user['jam_masuk'];?></td>
                  <td><?php echo $data_user['jam_pulang'];?></td>
                  <td>
                    <?php if ($data_user['status_pulang']==""){
                      echo"<a href='proses_absen_pulang.php?id=".$data_user['id_absensi']."' class='btn btn-success btn-xs' style='margin-bottom:3px;'><i class='fa fa-edit'></i> Absen Pulang</a>";
                    }else if ($data_user['status_pulang']== 1) {
                      echo "Oke";
                    }
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
     