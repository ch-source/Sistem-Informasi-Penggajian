
      <section class="content">
        <div class="row">
          <div class="col-lg-2" style="margin-bottom: 5px;">
            <a href="dashboard.php?p=input_pegawai" class="btn btn-success"><i class="fa fa-plus"></i> TAMBAH Pegawai</a>
          </div>
          <div class="col-lg-6" style="margin-bottom: 5px;" style="text-align: left;">
            <a href="dashboard.php?p=data_gaji_pegawai" class="btn btn-info"><i class="fa fa-eye"></i> Data Gaji Pegawai</a>
          </div>
        </div>
        <div class="box box-info" >
          <div class="box-header with-border" >
            <h3 class="box-title" >Data Pegawai</h3>
          </div>
          <div class="box-body">
            <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_pegawai' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data Pegawai Baru <b>Berhasil Disimpan.</b>
                        </div>";
                }if($_GET['notif']=="ubah-berhasil"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=data_pegawai' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Data Pegawai <b>Berhasil Diubah.</b>
                        </div>";
                }
              }
              ?>
              <div class="box-body" style="overflow: auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  
                  <th>Pegawai</th>
                  <th>JK</th>
                  <th>Tgl. Lahir</th>
                  <th>Alamat</th>
                  <th>Tgl. Mulai Kerja</th>
                  <th>Jabatan</th>
                  <th>Status Kepegawaian</th>
                  <th>Pendidikan Terakhir</th>
                  <th>No. Telepon</th>
                  <th>BANK/No. Rekening</th>
                  <th style="text-align: center;">Opsi</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                  include "koneksi.php";
                  
                  $query_user="SELECT * FROM tbl_pegawai";
                  $sql_user=mysqli_query($connect, $query_user);
                  while ($data_user=mysqli_fetch_array($sql_user)) {
                  ?>
                <tr>
                  <td><?php echo $data_user['id_pegawai'];?>/<?php echo $data_user['nama_pegawai'];?></td>
                  <td><?php echo $data_user['jk'];?></td>
                  <td><?php echo $data_user['tgl_lahir'];?></td>
                  <td><?php echo $data_user['alamat'];?></td>
                  <td><?php echo $data_user['tgl_mulai_kerja'];?></td>
                  <td><?php echo $data_user['jabatan'];?></td>
                  <td><?php echo $data_user['sk'];?></td>
                  <td><?php echo $data_user['pendidikan_terakhir'];?></td>
                  <td><?php echo $data_user['no_telepon'];?></td>
                  <td><?php echo $data_user['bank'];?>/<?php echo $data_user['no_rekening'];?></td>
                  <td>
                    <?php if ($data_user['status_data_gaji']==""){
                      echo"<a href='dashboard.php?p=edit_pegawai&id=".$data_user['id_pegawai']."' class='btn btn-success btn-xs' style='margin-bottom:3px;'><i class='fa fa-edit'></i> Ubah</a>";
                      echo"<a href='dashboard.php?p=input_data_gaji&id=".$data_user['id_pegawai']."' class='btn btn-info btn-xs'><i class='fa fa-edit'></i> Input Data Gaji</a>";
                    }else{
                      echo"<a href='dashboard.php?p=edit_pegawai&id=".$data_user['id_pegawai']."' class='btn btn-success btn-xs' style='margin-bottom:3px;><i class='fa fa-edit'></i> Ubah</a>";
                      echo"<a href='dashboard.php?p=edit_data_gaji&id=".$data_user['id_pegawai']."' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i> Ubah Data Gaji</a>";
                    }?>
                  </td>
                </tr>
                <?php }?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     