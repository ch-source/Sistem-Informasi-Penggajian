
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Tunjangan Jabatan Pegawai/Guru</h3>
          </div>
          <div class="box-body">
            <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="gagal"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_tunjangan' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Opss!, Data Tunjangan Pegawai <b> Gagal Disimpan.</b>
                        </div>";
                }
              }
              ?>
            <form class="form-horizontal"  action="proses_simpan_tunjangan.php" role="form" method="post">
              <?php
              include "koneksi.php";
              $query = "SELECT max(id_tunjangan) as maxId FROM tbl_tunjangan";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil);
              $iduser = $data['maxId'];
              $noUrut = (int) substr($iduser, 3, 3);
              $noUrut++;
              $char = "TNJ";
              $iduser= $char . sprintf("%03s", $noUrut);
              ?>
              <div class="form-group">
                    <label class="col-sm-2 control-label">ID Tunjangan</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" value="<?php echo $iduser;?>" name="id" readonly="readonly">
                    </div>
                    <label class="col-sm-2 control-label">Nama Pegawai</label>
                    <div class="col-sm-4">
                      <select class="form-control" name="pegawai" autofocus="autofocus" required="required">
                        <option value="" selected="selected">Pilih Pegawai</option>
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
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Tunjangan Jabatan</label>
                        <div class="col-sm-8">
                            <select name="tj" class="form-control" required="required">
                                <option value="" selected="selected">-Pilih Tunjangan-</option>
                                <option value="Kepala Sekolah">Kepala Sekolah</option>
                                <option value="Wakasek">Wakasek</option>
                                <option value="Bendahara Komite">Bendahara Komite</option>
                                <option value="Bendahara BOS">Bendahara BOS</option>
                                <option value="Kepala Perpustakaan">Kepala Perpustakaan</option>
                                <option value="Kepala Tata Usaha">Kepala Tata Usaha</option>
                                <option value="Kepala Labor">Kepala Labor</option>
                                <option value="Pembina Rohani">Pembina Rohani</option>
                                <option value="Pembina Pramuka">Pembina Pramuka</option>
                                <option value="Pembina Kesenian">Pembina Kesenian</option>
                                <option value="Pembina Olahraga">Pembina Olahraga</option>
                                <option value="Kaur Humas">Kaur Humas</option>
                                <option value="Kau Sapras">Kaur Sapras</option>
                                <option value="Kaur Kesiswaan">Kaur Kesiswaan</option>
                                <option value="Pembantu Labor">Pembantu Labor</option>
                                <option value="Pembantu Perpustakaan">Pembantu Perpustakaan</option>
                                <option value="Pembantu Sapras">Pembantu Sapras</option>
                                <option value="Operator Sekolah">Operator Sekolah</option>
                                <option value="Penjaga Sekolah">Penjaga Sekolah</option>
                            </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Jmlh Tunjangan Jabatan</label>
                        <div class="col-sm-8">
                            <input type="text" name="jmtj" class="form-control" required="required"> 
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="text-align:right; ">
                      <button type="submit" class="btn btn-info" ><i class="fa fa-save"></i> Simpan Data Tunjangan</button>
                    </div>
                  </div>
            </form>
            <div class="row">
              <div class="col-sm-12" style="margin-bottom: 10px;">
                <a href="dashboard.php?p=rekapitulasi_tunjangan" class="btn btn-warning"><i class="fa fa-eye"></i> Lihat Rekap Tunjangan</a>
              </div>
            </div>
            <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_tunjangan' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data Tunjangan Pegawai <b> Berhasil Disimpan.</b>
                        </div>";
                }if($_GET['notif']=="berhasil-hapus"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_tunjangan' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data Tunjangan Pegawai <b> Berhasil Dihapus.</b>
                        </div>";
                }
              }
              ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Pegawai-Nama Pegawai</th>
                  <th>Data Tunjangan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_pegawai";
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
                  <th>Tanggal</th>
                  <th>P/T</th>
                  <th>Tunjangan Jabatan</th>
                  <th>Jumlah Tunjangan Jabatan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query="SELECT * FROM tbl_tunjangan WHERE id_pegawai='".$data_user['id_pegawai']."'";
                  $sql=mysqli_query($connect, $query);
                  while ($data=mysqli_fetch_array($sql)) {
                  ?>
                <tr>
                  <td><?php echo $data['tgl_tnjngn'];?></td>
                  <td><?php echo $data['periode_tjn'];?>/<?php echo $data['tahun_tjn'];?></td>
                  <td><?php echo $data['tnjngn_jabatan'];?></td>
                  <td>
                  <?php 
                    $jmtj= $data['jml_tnjngn_jbtn'];
                    echo "Rp. ".number_format($jmtj, 2, ".", ".");
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
     