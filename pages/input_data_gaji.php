  
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Form Input Data Gaji Pegawai/Guru</h3>
          </div>
          <div class="box-body">
            <?php
              include "koneksi.php";
              $id=$_GET['id'];
              $query = "SELECT * FROM tbl_pegawai WHERE id_pegawai='$id'";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil); 
              ?>
              <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="gagal"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=input_data_gaji&id='".$id."' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i> Oppss!, Data Gaji Pegawai <b>Gagal Disimpan.</b>
                        </div>";
                }
              }
              ?>
            <form class="form-horizontal"  action="proses_simpan_data_gaji.php?id=<?php echo $id;?>" role="form" method="post">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label">ID Pegawai</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" value="<?php echo $data['id_pegawai'];?>" readonly="readonly">
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <div class="col-sm-12">
                      <input type="text" class="form-control" value="<?php echo $data['nama_pegawai'];?>" name="nama" readonly="readonly">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Dana Komite (Rp)</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="ukt" required="required">
                    </div>
                    <label class="col-sm-2 control-label" style="text-align: left;">/Bulan</label>
              </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Tunjangan Ijazah (Rp)</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="uf" required="required">
                    </div>
                    <label class="col-sm-2 control-label" style="text-align: left;">/Bulan</label>
              </div>
              <div class="form-group">
                    <label class="col-sm-2 control-label">Potongan Keterlambatan(Rp)</label>
                    <div class="col-sm-8">
                      <input type="number" class="form-control" name="pk" required="required">
                    </div>
                    <label class="col-sm-2 control-label" style="text-align: left;">/Hari</label>
              </div>
              <hr>
                  <div class="row">
                    <div class="col-sm-12" style="text-align:right; ">
                      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan</button>
                      <a href="dashboard.php?p=data_pegawai" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
                    </div>
                  </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     