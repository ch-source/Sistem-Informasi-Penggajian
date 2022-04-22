 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Halaman Pegawai</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <?php
              if(isset($_GET['notif'])){
                if($_GET['notif']=="login-sukses"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard_pegawai.php?p=halaman_awal' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Anda Berhasil Login.</b>
                        </div>";
                }
              }
              ?>
      <div class="callout callout-success">
        <h4><i class="fa fa-globe"></i> Welcome To Website Payrool SMPK Christoregi Ende </h4>
      </div>
      <div class="row">
          <div class="col-lg-12" style="text-align: center;">
            <img src="">
          </div>
        </div>
    </section>
    <!-- /.content -->