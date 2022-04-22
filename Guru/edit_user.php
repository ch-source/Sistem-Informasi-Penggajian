 
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Form Edit Data Pegawai</h3>
          </div>
          <div class="box-body">
            <?php 
            include"koneksi.php";
            $id=$_GET['id'];
            $query_user="SELECT * FROM tbl_user WHERE id_user='$id'";
            $sql_user=mysqli_query($connect, $query_user);
            $data_user=mysqli_fetch_array($sql_user);
            ?>
            <form class="form-horizontal"  action="proses_edit_user.php?id=<?php echo $id;?>" role="form" method="post">
              
                  <div class="form-group">
                    <label class="col-sm-2 control-label">ID Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $data_user['id_pegawai'];?>" name="idpegawai" readonly="readonly">
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Level</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="level" required="required">
                        <option value="" selected="selected">Pilih Level User</option>
                        <option value="Admin">Admin</option>
                        <option value="Kepsek">Kepala Sekolah</option>
                        <option value="Pegawai">Pegawai</option>
                        <option value="Guru">Guru</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama User</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nm"  value="<?php echo $data_user['nama_user'];?>" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control"  value="<?php echo $data_user['username'];?>" name="username" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password"  value="<?php echo $data_user['password'];?>" class="form-control" name="password" required="required">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12" style="text-align:right; ">
                      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan Perubahan</button>
                      <a href="dashboard.php?p=data_user" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
                    </div>
                  </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     