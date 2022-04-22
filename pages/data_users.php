
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Users</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal"  action="proses_simpan_user.php" role="form" method="post">
              <?php
              include "koneksi.php";
              $query = "SELECT max(id_user) as maxId FROM tbl_user";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil);
              $iduser = $data['maxId'];
              $noUrut = (int) substr($iduser, 3, 3);
              $noUrut++;
              $char = "USR";
              $iduser= $char . sprintf("%03s", $noUrut);
              ?>
              <?php
              if(isset($_GET['notif'])){
                if($_GET['notif']=="berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_users' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data User Baru <b>Berhasil Ditambahkan.</b>
                        </div>";
                }if($_GET['notif']=="gagal"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_users' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Oppss!, Data User <b>Gagal Disimpan.</b>
                        </div>";
                }if($_GET['notif']=="username-ada"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_users' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Oppss!, Data User <b>Gagal Disimpan</b>, Username Yang Anda Masukkan Sudah Terdaftar.
                        </div>";
                }if($_GET['notif']=="ubah-berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_users' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data User <b>Berhasil Diubah.</b>
                        </div>";
                }
              }
              ?>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Pegawai</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="pegawai" autofocus="autofocus" required="required">
                        <option value="" selected="selected">Pilih Pegawai</option>
                        <?php 
                        $query="SELECT * FROM tbl_pegawai WHERE status_user=''";
                        $sql=mysqli_query($connect, $query);
                        while($data1=mysqli_fetch_array($sql)){
                        echo"<option value='".$data1['id_pegawai']."''>".$data1['id_pegawai']."-".$data1['nama_pegawai']."</option>";
                      }
                      ?>
                      </select>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="level" required="required">
                        <option value="" selected="selected">Pilih Level User</option>
                        <option value="Bendahara Komite">Bendahara Komite</option>
                        <option value="Kepsek">Kepala Sekolah</option>
                        <option value="Pegawai">Pegawai</option>
                        <option value="Guru">Guru</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="username" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" name="password" required="required" class="form-control">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="text-align:right; ">
                      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan Data User</button>
                    </div>
                  </div>
            </form>
            <hr>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th style="text-align: center;">Opsi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_user";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_user'];?></td>
                  <td><?php echo $data_user['username'];?></td>
                  <td><?php echo $data_user['level'];?></td>
                  <td style="text-align: center;"><a href="dashboard.php?p=edit_user&id=<?php echo $data_user['id_user'];?>" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Ubah</a>
                  </td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     