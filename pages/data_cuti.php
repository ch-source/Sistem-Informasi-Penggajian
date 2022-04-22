
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Tabel Data Cuti Pegawai</h3>
          </div>
          <div class="box-body">
             <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="konfirmasi-sukses"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_cuti' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i>  Data Cuti Pegawai <b>Berhasil Dikonfirmasi.</b>
                        </div>";
                }
              }
              ?>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>ID Cuti</th>
                  <th>Pegawai</th>
                  <th>Periode</th>
                  <th>Tahun</th>
                  <th>Tgl. Ambil Cuti</th>
                  <th>JTgl. Akhir Cuti</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th style="text-align: center;">Opsi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  $no=1;
                  $query_user="SELECT * FROM tbl_cuti";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $no;?></td>
                  <td><?php echo $data_user['id_cuti'];?></td>
                  <td><?php echo $data_user['id_pegawai'];?></td>
                  <td><?php echo $data_user['periode'];?></td>
                  <td><?php echo $data_user['tahun'];?></td>
                  <td><?php echo $data_user['tgl_ambil_cuti'];?></td>
                  <td><?php echo $data_user['tgl_akhir_cuti'];?></td>
                  <td><?php echo $data_user['keterangan'];?></td>
                  <td><?php echo $data_user['status_cuti'];?></td>
                  <td style="text-align: center;"><a href="dashboard.php?p=detail_cuti&id=<?php echo $data_user['id_cuti'];?>" class="btn btn-warning btn-xs"><i class="fa fa-eye"></i> Detail</a>
                  </td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     