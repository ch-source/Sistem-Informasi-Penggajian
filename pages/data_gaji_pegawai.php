
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tabel Data Gaji</h3>
          </div>
          <div class="box-body">
            <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_gaji_pegawai' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i>  Data Gaji Pegawai <b>Berhasil Disimpan.</b>
                        </div>";
                }if($_GET['notif']=="ubah-berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_gaji_pegawai' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i>  Data Gaji Pegawai <b>Berhasil Diubah.</b>
                        </div>";
                }
              }
              ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Data Gaji</th>
                  <th>ID Pegawai</th>
                  <th>Dana Komite</th>
                  <th>Tunjangan Ijazah</th>
                  <th>Potongan Keterlambatan</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_data_gaji";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_data_gaji'];?></td>
                  <td><?php echo $data_user['id_pegawai'];?></td>
                  <td><?php
                  $gapok=$data_user['gapok'];
                  echo "Rp. ".number_format($gapok, 2, ".", ".");
                  ?></td>
                  <td><?php
                  $ufa=$data_user['tunjangan_ijazah'];
                  echo "Rp. ".number_format($ufa, 2, ".", ".");
                  ?></td>
                  <td><?php
                  $pk=$data_user['potongan_keterlambatan'];
                  echo "Rp. ".number_format($pk, 2, ".", ".");
                  ?></td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <a href="dashboard.php?p=data_pegawai" class=" btn btn-default"><i class="fa fa-close"></i> Tutup</a>
          </div>
        </div>
      </section>
     