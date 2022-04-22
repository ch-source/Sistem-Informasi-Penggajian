
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Tunjangan Wali Kelas</h3>
          </div>
          <div class="box-body">
            <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="gagal"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_tunjangan_wk' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Opss!, Data Tunjangan Wali Kelas <b> Gagal Disimpan.</b>
                        </div>";
                }
              }
              ?>
            <form class="form-horizontal"  action="proses_simpan_wk.php" role="form" method="post">
              <?php
              include "koneksi.php";
              $query = "SELECT max(id_kt) as maxId FROM tbl_kt";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil);
              $iduser = $data['maxId'];
              $noUrut = (int) substr($iduser, 3, 3);
              $noUrut++;
              $char = "KT";
              $iduser= $char . sprintf("%03s", $noUrut);
              ?>
              <div class="form-group">
                    <label class="col-sm-2 control-label">ID Tunjangan WK</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" value="<?php echo $iduser;?>" name="id" readonly="readonly">
                    </div>
                    <label class="col-sm-2 control-label">Nama Guru</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="guru" autofocus="autofocus" required="required">
                        <option value="" selected="selected">Pilih Guru</option>
                        <?php 
                        $query="SELECT * FROM tbl_pegawai WHERE jabatan IN ('Guru')";
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
                      <input type="date" class="form-control" name="tgl" required="required">
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
                    <label class="col-sm-2 control-label">Jml. Tunjangan Wali Kelas</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="jml" required="required">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="text-align:right; ">
                      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan Data Tunjangan WK</button>
                    </div>
                  </div>
            </form>
            <hr>
            <div class="row">
              <div class="col-sm-12" style="margin-bottom: 10px;">
                <a href="dashboard.php?p=rekaptulasi_tunjangan_wk" class="btn btn-warning"><i class="fa fa-eye"></i> Lihat Rekap Tunjangan WK</a>
              </div>
            </div>
            <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_tunjangan_wk' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data Tunjangan Wali Kelas <b> Berhasil Disimpan.</b>
                        </div>";
                }if($_GET['notif']=="berhasil-hapus"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_tunjangan_wk' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data Tunjangan Wali Kelas <b> Berhasil Dihapus.</b>
                        </div>";
                }
              }
              ?>
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
        </div>
      </section>
     