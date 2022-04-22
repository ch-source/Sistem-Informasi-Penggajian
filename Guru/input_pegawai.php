
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Form Input Data Pegawai</h3>
          </div>
          <div class="box-body">
            <?php
              include "koneksi.php";
              $query = "SELECT max(id_pegawai) as maxId FROM tbl_pegawai";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil);
              $iduser = $data['maxId'];
              $noUrut = (int) substr($iduser, 3, 3);
              $noUrut++;
              $char = "P";
              $iduser= $char . sprintf("%03s", $noUrut);
              ?>
            <form class="form-horizontal"  action="proses_simpan_pegawai.php" role="form" method="post">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">ID Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" value="<?php echo $iduser;?>" name="idpegawai" readonly="readonly">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Nama Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="nama" autofocus="autofocus" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Jenis Kelamin</label>
                      <div class="col-sm-9">
                       <div class="row">
                          <div class="col-sm-3">
                            <input  type="radio" name="jk" required value="Laki-laki"> Laki-laki
                          </div>
                          <div class="col-sm-9">
                            <input type="radio" name="jk" required value="Perempuan"> Perempuan
                          </div>
                        </div>
                      </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Tgl. Lahir</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="tgllahir" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Alamat</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="alamat" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Tgl. Mulai Kerja</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" name="tglmulai" required="required">
                    </div>
                  </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Jabatan</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="jabatan" required="required">
                        <option value="" selected="selected">Jabatan</option>
                        <option value="Admin">Admin</option>
                        <option value="Kepsek">Kepala Sekolah</option>
                        <option value="Pegawai">Pegawai</option>
                        <option value="Guru">Guru</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No. Telepon</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="notelp" required="required">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">No. Rekening</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="norek" required="required">
                    </div>
                  </div>
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
     