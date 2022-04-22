 <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Halaman Admin</h1>
    </section>
    <!-- Main content -->
    <section class="content">
       <?php
              if(isset($_GET['notif'])){
                if($_GET['notif']=="login-sukses"){
                  echo "<div class='alert alert-success alert-dismissible'>
                        <a style='text-decoration:none;' href='dashboard.php?p=halaman_awal' type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</a>
                          <i class='icon fa fa-check'></i> Anda Berhasil Login.</b>
                        </div>";
                }
              }
              ?>
      <div class="callout callout-success">
        <h4><i class="fa fa-globe"></i> Welcome To Website Payrool SMPK Christoregi Ende</h4>
      </div>
      <div class="row">
        <div class="col-sm-3">
           <div class="box box-success">
           <div class="box-body" style="text-align: center;">
             <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pegawai/Guru</div>
             <?php 
             include"koneksi.php";
             $order="SELECT * FROM tbl_pegawai";
              $query_order=mysqli_query($connect, $order);
              $data_order=array();
              while(($row_order=mysqli_fetch_array($query_order)) !=null){
              $data_order[]=$row_order;
              }
              $count=count($data_order); 
             ?>
             <?php echo $count;  ?> Orang
              <div class="col-auto">

                <i class="fa fa-users fa-2x text-success"></i>
              </div>
           </div>
       </div>
        </div>
         <div class="col-sm-3">
           <div class="box box-primary">
           <div class="box-body" style="text-align: center;">
             <div class="text-xs font-weight-bold text-uppercase mb-1">Total Tunjangan Jabatan</div>
             <?php 
             include"koneksi.php";
             $order_a="SELECT SUM(jml_tnjngn_jbtn) AS ttl FROM tbl_tunjangan ";
              $query_order_a=mysqli_query($connect, $order_a);
              while($row_order_a=mysqli_fetch_object($query_order_a))
              { 
              echo "Rp. ".number_format($row_order_a->ttl, 2, ".", ".");
              }
             ?>
              <div class="col-auto">
                <i class="fa fa-file fa-2x text-primary"></i>
              </div>
           </div>
       </div>
        </div>
         <div class="col-sm-3">
           <div class="box box-info">
           <div class="box-body" style="text-align: center;">
             <div class="text-xs font-weight-bold text-uppercase mb-1">Total Tunjangan Wali Kelas</div>
             <?php 
             include"koneksi.php";
             $order_b="SELECT SUM(jml_tunjangan_wk) AS total FROM tbl_kt";
              $query_order_b=mysqli_query($connect, $order_b);
              while($row_order_b=mysqli_fetch_object($query_order_b)){
                echo "Rp. ".number_format($row_order_b->total, 2, ".", ".");
              }
             ?>
              <div class="col-auto">
                <i class="fa fa-table fa-2x text-info"></i>
              </div>
           </div>
       </div>
        </div>
         <div class="col-sm-3">
           <div class="box box-danger">
           <div class="box-body" style="text-align: center;">
             <div class="text-xs font-weight-bold text-uppercase mb-1">Total Potongan</div>
             <?php 
             include"koneksi.php";
             $order_c="SELECT SUM(jml_ptngn) AS jml FROM tbl_potongan";
              $query_order_c=mysqli_query($connect, $order_c);
              while($row_order_c=mysqli_fetch_object($query_order_c)){
                echo "Rp. ".number_format($row_order_c->jml, 2, ".", ".");
              } 
             ?>
              <div class="col-auto">
                <i class="fa fa-calendar-plus-o fa-2x text-danger"></i>
              </div>
           </div>
       </div>
        </div>
      </div>
        <!-- /.modal -->

      <h3>Grafik Kehadiran Pegawai/Guru</h3>
      <div>
          <canvas id="myChart"></canvas>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
      <script>
  var ctx = document.getElementById("myChart").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: [
      "Januari", 
      "Februari", 
      "Maret", 
      "April", 
      "Mei", 
      "Juni", 
      "Juli", 
      "Agustus",
      "September",
      "Oktober",
      "November",
      "Desember"],
      datasets: [{
        label: '',
        data: [
        <?php 
        $jumlah_hadir = mysqli_query($connect,"SELECT * FROM tbl_rekap_kehadiran WHERE jml_hadir >='26'");
        echo mysqli_num_rows($jumlah_hadir);
        ?>
        ],
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
        ],
        borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero:true
          }
        }]
      }
    }
  });
</script>
    </section>
    <!-- /.content -->