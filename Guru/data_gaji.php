
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tabel Data Gaji</h3>
          </div>
          <div class="box-body">
            <?php
                  include "koneksi.php";
                  $data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user WHERE username='$_SESSION[masuk]'")); 
                if ($data['level'] == 'Guru') {
                  $konten = $data['id_pegawai'];}
                  ?>
             <form method="post" action="laporan/slip_gaji_pegawai_a.php?id=<?php echo $konten;?>" target="_blank">
            <div class="row">
              <div class="col-sm-4">
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
              <div class="col-sm-4">
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
              <div class="col-sm-4">
                <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Slip Gaji</button>
              </div>
            </div>
          </form>
            <hr>
            <table id="example1" class="table table-bordered">
                <thead>
                <tr class="warning">
                  <th>No</th>
                  <th>Nama Pegawai</th>
                  <th>Data Penggajian</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user WHERE username='$_SESSION[masuk]'")); 
                if ($data['level'] == 'Guru') {
                  $konten = $data['id_pegawai'];}
                  $nox=1;
                  $query_x="SELECT * FROM tbl_pegawai WHERE id_pegawai='$konten'";
                  $sql_x=mysqli_query($connect, $query_x);
                  while ($data_x=mysqli_fetch_array($sql_x)) {
                  ?>
                <tr>
                  <td><?php echo $nox;?></td>
                  <td><?php echo $data_x['id_pegawai'];?>-<?php echo $data_x['nama_pegawai'];?></td>
            <td>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="success">
                  <th>No</th>
                  <th>Tgl</th>
                  <th>Periode/Tahun</th>
                  <th>Gapok</th>                 
                  <th>Tunjangan Ijazah</th>
                  <th>Tunjangan Jabatan</th>
                  <th>Tunjangan Wali Kelas</th>
                  <th>Ttl. Tunjangan</th>
                  <th>Potongan</th>
                  <th>Potongan Terlambat</th>
                  <th>Ttl. Potongan</th>
                  <th>Total Gaji</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_gaji WHERE id_pegawai='".$data_x['id_pegawai']."'";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                          <td><?php echo $no;?></td>
                          <td><?php echo $data_user['tanggal'];?></td>
                          <td><?php echo $data_user['periode'];?>/<?php echo $data_user['tahun'];?></td>
                          <td>
                            <?php
                            $gapok=$data_user['gapok'];
                            echo "Rp. ".number_format($gapok, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ti=$data_user['tunjangan_ijazah'];
                            echo "Rp. ".number_format($ti, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $tj=$data_user['tunjangan_jabatan'];
                            echo "Rp. ".number_format($tj, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $twk=$data_user['tunjangan_wk'];
                            echo "Rp. ".number_format($twk, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ttl=$data_user['ttl_tunjangan'];
                            echo "Rp. ".number_format($ttl, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ptg=$data_user['potongan'];
                            echo "Rp. ".number_format($ptg, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $pt=$data_user['potongan_terlambat'];
                            echo "Rp. ".number_format($pt, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $tp=$data_user['ttl_potongan'];
                            echo "Rp. ".number_format($tp, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ttl=$data_user['total_gaji'];
                            echo "Rp. ".number_format($ttl, 2, ".", ".");
                            ?></td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
            </td>
            </tr>
                <?php $nox++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     