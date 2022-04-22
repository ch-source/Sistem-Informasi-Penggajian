
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Form Edit Data Lembur Karyawan/Pegawai</h3>
          </div>
          <div class="box-body">
             <?php
              include "koneksi.php";
              $id=$_GET['id'];
              $query = "SELECT * FROM tbl_lembur WHERE id_lembur='$id'";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil);
              ?>
            <form class="form-horizontal"  action="proses_edit_lembur.php?id=<?php echo $id;?>" role="form" method="post">
              <div class="form-group">
                    <label class="col-sm-2 control-label">ID Lembur</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $id;?>" readonly="readonly">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">ID Karyawan</label>
                          <div class="col-sm-8">
                          <input type="text" class="form-control" value="<?php echo $data['id_karyawan'];?>" name="karyawan" readonly="readonly">
                        </div> 
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Nama Karyawan</label>
                          <div class="col-sm-8">
                          <input type="text" class="form-control" readonly="readonly">
                        </div> 
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Tgl. Lembur</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" value="<?php echo $data['tgl_lembur'];?>" name="tgl" autofocus="autofocus" required="required">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Jam Mulai (Ex: 0:00 PM/AM)</label>
                        <div class="col-sm-8">
                          <input type="time" name="jm"  value="<?php echo $data['jam_mulai'];?>" required="required" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Jam Selesai (Ex: 0:00 PM/AM)</label>
                        <div class="col-sm-8">
                          <input type="time" name="js"  value="<?php echo $data['jam_selesai'];?>" required="required" class="form-control">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label class="col-sm-4 control-label">Periode</label>
                        <div class="col-sm-8">
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
                      <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan Data Perubahan</button>
                      <a href="dashboard.php?p=data_lembur" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
                    </div>
                  </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     