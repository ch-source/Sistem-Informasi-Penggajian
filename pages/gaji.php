      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Form Input Penggajian Pegawai/Guru</h3>
          </div>
          <div class="box-body">
            <a href="javascript:pilihsemua()" class="btn btn-warning btn-xs"><i class="fa fa-check-square-o"></i> Check All</a>&nbsp;&nbsp;
            <a href="javascript:bersihkan()"class="btn btn-danger btn-xs"><i class="fa  fa-ban"></i> Uncheck All</a>

            <form method="post" action="dashboard.php?p=gaji_proses">
            <table id="example2" class="table table-bordered">
                <thead>
                <tr>
                  <th style="text-align: center;">Pilih</th>
                  <th>ID</th>
                  <th>Nama</th>
                  <th>Jabatan</th>
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
                  <td style="text-align: center;" width="10px;">
                  <label>
                    <input type="checkbox" name="id_pegawai[]" value="<?php echo $data_user['id_pegawai'];?>">
                  </label>
                </td>
                  <td><?php echo $data_user['id_pegawai'];?></td>
                  <td><?php echo $data_user['nama_pegawai'];?></td>
                  <td><?php echo $data_user['jabatan'];?></td>
                </tr>
                <?php $no++;}?>
              </tbody>
            </table>
            <div class="row">
              <div class="col-sm-4">
                 <div class="form-group">
                  <label>Periode</label>
                   <select name="periode" class="form-control" required="required">
                    <?php
                    $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                    for($a=1;$a<=12;$a++){
                     if($a==date("m"))
                     { 
                     $pilih="selected";
                     }
                     else 
                     {
                     $pilih="";
                     }
                    echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                    }
                    ?>
                    </select>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-group">
                  <label>Tahun</label>
                    
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
            <a href="dashboard.php?p=data_gaji" class="btn btn-danger"><i class="fa fa-close"></i> Tutup</a>
            <button type="submit" name="simpan" class="btn btn-primary"><i class="fa fa-edit"></i> Input Gaji</button>
          </form>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
      <script>
        function pilihsemua()
        {
            var daftarku = document.getElementsByName("id_pegawai[]");
            var jml=daftarku.length;
            var b=0;
            for (b=0;b<jml;b++)
            {
                daftarku[b].checked=true;
                
            }
        }
        function bersihkan()
        {
            var daftarku = document.getElementsByName("id_pegawai[]");
            var jml=daftarku.length;
            var b=0;
            for (b=0;b<jml;b++)
            {
                daftarku[b].checked=false;  
            }
        }
      </script>