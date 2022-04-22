
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Laporan Potongan</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal" method="POST" action="laporan/laporan_potongan.php" target="_blank">
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
                                  <button type="submit" class="btn btn-info"><i class="fa fa-print"></i> Cetak Laporan Potongan</button>
                                </div>
                              </div>
            </form>
          </div>
        </div>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tabel Data Potongan</h3>
          </div>
           <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Potongan</th>
                  <th>ID Pegawai</th>
                  <th>Tanggal</th>
                  <th>Periode</th>
                  <th>Tahun</th>
                  <th>Potongan Simpan Pinjam</th>
                  <th>Potongan Konsumsi Wajib</th>
                  <th>Memotomori</th>
                  <th>Total Potongan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_potongan ORDER BY id_pegawai DESC";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_potongan'];?></td>
                  <td><?php echo $data_user['id_pegawai'];?></td>
                  <td><?php echo $data_user['tgl_ptngn'];?></td>
                  <td><?php echo $data_user['periode_ptngn'];?></td>
                  <td><?php echo $data_user['tahun_ptngn'];?></td>
                  <td>
                  <?php 
                    $psp=$data_user['ptngn_smpn_pnjm'];
                    echo "Rp. ".number_format($psp, 2, ".", ".");
                  ?>
                  </td>
                  <td>
                  <?php 
                    $pkw= $data_user['ptngn_knsms_wjb'];
                    echo "Rp. ".number_format($pkw, 2, ".", ".");
                  ?>
                  </td>
                  <td>
                  <?php 
                    $mtm= $data_user['memotomori'];
                    echo "Rp. ".number_format($mtm, 2, ".", ".");
                  ?>
                  </td>
                  <td>
                  <?php 
                    $tp= $data_user['tl_ptngn'];
                    echo "Rp. ".number_format($tp, 2, ".", ".");
                  ?>
                  </td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          </div>
        </div>
      </section>
     