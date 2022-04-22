
      <section class="content">
         <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Laporan Rekap Gaji Pegawai/Guru</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal" method="POST" action="laporan/laporan_gaji.php" target="_blank">
              <div class="row">
                                      <div class="col-sm-4">
                                        <div class="form-group">
                                          <label class="col-sm-2 control-label">Periode</label>
                                          <div class="col-sm-10">
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
                                          <label class="col-sm-2 control-label">Tahun</label>
                                          <div class="col-sm-10">
                                              <select name="tahun" class="form-control">
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
                                  <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan Rekap Gaji</button>
                                </div>
                              </div>
            </form>
          </div>
        </div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Data Gaji Pegawai/Guru</h3>
          </div>
          <div class="box-body">
            <table id="example1" class="table table-bordered">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Pegawai</th>
                  <th>Data Penggajian</th>
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
                    <table class="table table-bordered" style="font-size: 12px;">
                      <thead>
                        <tr class="success">
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
                        $query="SELECT * FROM tbl_gaji WHERE id_pegawai='".$data_user['id_pegawai']."'";
                        $sql=mysqli_query($connect, $query);
                        while ($data=mysqli_fetch_array($sql)) {
                        ?>
                        <tr class="success">
                          <td><?php echo $data['tanggal'];?></td>
                          <td><?php echo $data['periode'];?>/<?php echo $data['tahun'];?></td>
                          <td>
                            <?php
                            $gapok=$data['gapok'];
                            echo "Rp. ".number_format($gapok, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ti=$data['tunjangan_ijazah'];
                            echo "Rp. ".number_format($ti, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $tj=$data['tunjangan_jabatan'];
                            echo "Rp. ".number_format($tj, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $twk=$data['tunjangan_wk'];
                            echo "Rp. ".number_format($twk, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ttl=$data['ttl_tunjangan'];
                            echo "Rp. ".number_format($ttl, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ptg=$data['potongan'];
                            echo "Rp. ".number_format($ptg, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $pt=$data['potongan_terlambat'];
                            echo "Rp. ".number_format($pt, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $tp=$data['ttl_potongan'];
                            echo "Rp. ".number_format($tp, 2, ".", ".");
                            ?>
                          </td>
                          <td>
                            <?php
                            $ttl=$data['total_gaji'];
                            echo "Rp. ".number_format($ttl, 2, ".", ".");
                            ?></td>
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
     