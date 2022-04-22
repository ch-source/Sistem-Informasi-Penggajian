
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Detail Data Cuti Karyawan</h3>
          </div>
          <div class="box-body">
            <?php
              include "koneksi.php";
              $id=$_GET['id'];
              $query = "SELECT * FROM tbl_cuti WHERE id_cuti='$id'";
              $hasil = mysqli_query($connect,$query);
              $data = mysqli_fetch_array($hasil);

              $query1 = "SELECT * FROM tbl_karyawan WHERE id_karyawan='".$data['id_karyawan']."'";
              $hasil1 = mysqli_query($connect,$query1);
              $data1 = mysqli_fetch_array($hasil1);
              ?>
              <?php
            if(isset($_GET['notif'])){
                 if($_GET['notif']=="konfirmasi-gagal"){
                  echo "<div class='alert alert-danger alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=detail_cuti&id=".$id."' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-warning'></i>Oppss!, Data Cuti Karyawan/Pegawai <b>Gagal Dikonfirmasi.</b>
                        </div>";
                }
              }
              ?>
            <div class="row">
              <div class="col-lg-4">ID Cuti</div>
              <div class="col-lg-8"> : <?php echo $data['id_cuti'];?></div>
            </div>
            <div class="row">
              <div class="col-lg-4">ID Karyawan</div>
              <div class="col-lg-8"> : <?php echo $data['id_karyawan'];?> - <?php echo $data1['nama_karyawan'];?></div>
            </div>
             <div class="row">
              <div class="col-lg-4">Jabatan</div>
              <div class="col-lg-8"> : <?php echo $data1['jabatan'];?></div>
            </div>
            <div class="row">
              <div class="col-lg-4">Periode</div>
              <div class="col-lg-8"> : <?php echo $data['periode'];?></div>
            </div>
            <div class="row">
              <div class="col-lg-4">Tahun</div>
              <div class="col-lg-8"> : <?php echo $data['tahun'];?></div>
            </div>
            <div class="row">
              <div class="col-lg-4">Tgl. Ambil Cuti</div>
              <div class="col-lg-8"> : <?php echo $data['tgl_ambil_cuti'];?></div>
            </div>
            <div class="row">
              <div class="col-lg-4">Tgl. Akhir Cuti</div>
              <div class="col-lg-8"> : <?php echo $data['tgl_akhir_cuti'];?></div>
            </div>
            <div class="row">
              <div class="col-lg-4">Keterangan</div>
              <div class="col-lg-8"> : <?php echo $data['keterangan'];?></div>
            </div>
             <div class="row">
              <div class="col-lg-4">Status Data Cuti</div>
              <div class="col-lg-8"> : <?php echo $data['status_cuti'];?></div>
            </div>
            <div class="row">
              <div class="col-lg-12" style="margin-bottom: 8px;"><b>Surat Keterangan:</b></div>
              <div class="col-lg-12" style="text-align: center;"><embed src="./sk_cuti/<?php echo $data['sk_cuti'];?>" type="application/pdf" width="100%" height="400" ></embed></div>
            </div>
          </div>
          <div class="box-footer">
            <?php if ($data['status_cuti']==""){
              echo "<a href='proses_konfirmasi_cuti.php?id=".$data['id_cuti']."' class='btn btn-primary'><i class='fa fa-check'></i> Konfirmasi Cuti</a>
            <a href='dashboard.php?p=data_cuti' class='btn btn-default'><i class='fa fa-close'></i> Tutup</a>";
            }else{
              echo"<a href='dashboard.php?p=data_cuti' class='btn btn-default'><i class='fa fa-close'></i> Tutup</a>";
            }
            ?>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     