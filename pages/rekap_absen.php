      
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Form Rekap Keterlambatan Pegawai</h3>
          </div>
          <div class="box-body">
            <?php
            include "koneksi.php";
              $id=$_GET['id'];
              $periode1=$_POST['periode'];
              $tahun1=$_POST['tahun'];
            ?>
            <p><i>Tabel Hasil Rekapitulasi Keterlambatan Pegawai : <b><?php echo $id;?></b>, Periode: <b><?php echo $periode1;?></b>-Tahun: <b><?php echo $tahun1;?></b></i></p>
            <table class="table table-bordered">
              <thead>
                <thead>
                  <tr class="warning">
                    <th>ID Absensi</th>
                    <th>ID Pegawai</th>
                    <th>Periode/Tahun</th>
                    <th>Jam Masuk</th>
                    <th>Masuk</th>
                    <th>Status Masuk</th>
                  </tr>
                </thead>
                <tbody>
                   <?php

                $query_x="SELECT a.*, 
                TIME_TO_SEC(TIMEDIFF('07:00:00',a.masuk))/60 AS telat_masuk, 
                TIME_TO_SEC(TIMEDIFF('13:00:00',a.keluar))/60 AS cepat_pulang, 
                IF(TIME_TO_SEC(TIMEDIFF('07:00:00',a.masuk))/60<0,'Telat','Tepat Waktu') AS status_masuk,
                IF(TIME_TO_SEC(TIMEDIFF('13:00:00',a.keluar))/60<0,'Cepat','Tepat Waktu') AS status_pulang
                FROM (SELECT
                id_absensi,
                id_pegawai,
                periode,
                tahun,
                tanggal,
                jam_masuk,

                DATE_FORMAT(MIN(jam_masuk), '%H:%i') AS masuk,
                CASE WHEN MAX(jam_masuk)<>MIN(jam_masuk) 
                  THEN DATE_FORMAT(MAX(tbl_absensi.jam_masuk), '%H:%i') END AS keluar 
                FROM
                tbl_absensi WHERE periode='$periode1' AND tahun='$tahun1' AND id_pegawai='$id'
                GROUP BY id_absensi, DATE(jam_masuk)) AS a";
                $sql_x=mysqli_query($connect,$query_x);
                while ($data_x=mysqli_fetch_array($sql_x)) {?>
                  <tr class="warning">
                    <td><?php echo $data_x['id_absensi'];?></td>
                    <td><?php echo $data_x['id_pegawai'];?></td>
                    <td><?php echo $data_x['periode'];?>/<?php echo $data_x['tahun'];?></td>
                    <td><?php echo $data_x['jam_masuk'];?></td>
                    <td><?php echo $data_x['masuk'];?></td>
                    <td><?php echo $data_x['status_masuk'];?></td>
                  </tr>
                <?php }?>
                </tbody>
              </thead>
            </table>
            <hr>
            <form class="form-horizontal" method="post" action="proses_rekap_absen_semua.php?id=<?php echo $id;?>&periode1=<?php echo $periode1;?>&tahun1=<?php echo $tahun1;?>">
              <div class="box box-danger">
                <div class="box-body" style="height: 200px; overflow: auto;">
               <?php

                $query_x="SELECT a.*, 
                TIME_TO_SEC(TIMEDIFF('07:00:00',a.masuk))/60 AS telat_masuk, 
                TIME_TO_SEC(TIMEDIFF('13:00:00',a.keluar))/60 AS cepat_pulang, 
                IF(TIME_TO_SEC(TIMEDIFF('07:00:00',a.masuk))/60<0,'Telat','Tepat Waktu') AS status_masuk,
                IF(TIME_TO_SEC(TIMEDIFF('13:00:00',a.keluar))/60<0,'Cepat','Tepat Waktu') AS status_pulang
                FROM (SELECT
                id_absensi,
                id_pegawai,
                periode,
                tahun,
                tanggal,
                jam_masuk,

                DATE_FORMAT(MIN(jam_masuk), '%H:%i') AS masuk,
                CASE WHEN MAX(jam_masuk)<>MIN(jam_masuk) 
                  THEN DATE_FORMAT(MAX(tbl_absensi.jam_masuk), '%H:%i') END AS keluar 
                FROM
                tbl_absensi WHERE periode='$periode1' AND tahun='$tahun1' AND id_pegawai='$id'
                GROUP BY id_absensi, DATE(jam_masuk)) AS a";
                $sql_x=mysqli_query($connect,$query_x);
                while ($data_x=mysqli_fetch_array($sql_x)) {?>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ID Absensi</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" readonly="readonly"  name="idabsensi[]" value="<?php echo $data_x['id_absensi'];?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">ID Pegawai</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" readonly="readonly"  name="idpegawai[]" value="<?php echo $data_x['id_pegawai'];?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Periode</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" readonly="readonly"  name="periode[]" value="<?php echo $data_x['periode'];?>" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Tahun</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="tahun[]" value="<?php echo $data_x['tahun'];?>" readonly="readonly"  required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Jam Masuk</label>
                    <div class="col-sm-10">
                      <input type="text" readonly="readonly"  class="form-control" name="jam[]" value="07:00:00" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Masuk</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="masuk[]" value="<?php echo $data_x['jam_masuk'];?>" readonly="readonly"  required="required">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-sm-2 control-label">Status Masuk</label>
                    <div class="col-sm-10">
                      <input type="text" readonly="readonly" class="form-control" name="sm[]" value="<?php echo $data_x['status_masuk'];?>" required="required">
                    </div>
                </div>

              <?php }?>
            </div>
          </div>
          <button type="submit" class="btn btn-info"><i class="fa fa-save"></i>Simpan</button>
          <a href="dashboard.php?p=rekapitulasi_ketidakhadiran" class="btn btn-default"><i class="fa fa-close"></i>Tutup</a>
              </form>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     