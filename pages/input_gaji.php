
      <section class="content">
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Form Input Penggajian Pegawai/Guru</h3>
          </div>
          <div class="box-body">
            <form class="form-horizontal"  action="proses_simpan_gaji.php" role="form" method="post">
              <?php
              include "koneksi.php";
              if (isset($_POST['check1'])) {
                  $id=$_GET['id'];
                  $periode=$_POST['periode'];
                  $tahun=$_POST['tahun'];
                  $query = "SELECT max(id_gaji) as maxId FROM tbl_gaji";
                  $hasil = mysqli_query($connect,$query);
                  $data = mysqli_fetch_array($hasil);
                  $iduser = $data['maxId'];
                  $noUrut = (int) substr($iduser, 3, 3);
                  $noUrut++;
                  $char = "GJI";
                  $iduser= $char . sprintf("%03s", $noUrut);

                  $query_kt="SELECT * FROM tbl_rekap_kt WHERE periode_kt='$periode' AND tahun_kt='$tahun' AND id_pegawai='$id'";
                  $sql_kt=mysqli_query($connect, $query_kt);
                  $data_kelas_tambahan=mysqli_fetch_array($sql_kt);

                  $query_gaji="SELECT * FROM tbl_data_gaji WHERE id_pegawai='$id'";
                  $sql_gaji=mysqli_query($connect, $query_gaji);
                  $data_gaji=mysqli_fetch_array($sql_gaji);


                  $query_absen="SELECT * FROM tbl_rekap_absen WHERE periode='$periode' AND tahun='$tahun' AND id_pegawai='$id'";
                  $sql_absen=mysqli_query($connect, $query_absen);
                  $data_absen=mysqli_fetch_array($sql_absen);

                  $bonus_kls_tmbhn=$data_kelas_tambahan['jml_kt'] * $data_gaji['upah_kls_tmbhn'];
                  $potongan_terlambat=$data_absen['jlh_terlambat'] * $data_gaji['potongan_keterlambatan'];

                  $query_tunjangan="SELECT * FROM tbl_rekap_tunjangan WHERE periode_tnjngn='$periode' AND tahun_tnjngn='$tahun' AND id_pegawai='$id'";
                  $sql_tunjangan=mysqli_query($connect, $query_tunjangan);
                  $data_tunjangan=mysqli_fetch_array($sql_tunjangan);
                   $tunjangan=$data_tunjangan['ttl_tnjngn'] ;

                  $query_potongan="SELECT * FROM tbl_rekap_ptngn WHERE periode_ptngn='$periode' AND tahun_ptngn='$tahun' AND id_pegawai='$id'";
                  $sql_potongan=mysqli_query($connect, $query_potongan);
                  $data_potongan=mysqli_fetch_array($sql_potongan);
                  $potongan=$data_potongan['ttl_ptngn'] ;
                  $ttl_potongan=$potongan + $potongan_terlambat;
                  

                  $order="SELECT * FROM tbl_absensi WHERE periode='$periode' AND tahun='$tahun' AND id_pegawai='$id'";
                  $query_order=mysqli_query($connect, $order);
                  $data_order=array();
                  while(($row_order=mysqli_fetch_array($query_order)) !=null){
                  $data_order[]=$row_order;
                  }
                  $count=count($data_order);
                
                  $query_pegawai="SELECT * FROM tbl_pegawai WHERE id_pegawai='$id'";
                  $sql_pegawai=mysqli_query($connect, $query_pegawai);
                  $data_pegawai=mysqli_fetch_array($sql_pegawai);

                  $awal=date_create("".$data_pegawai['tgl_mulai_kerja']."");
                  $akhir=date_create();
                  $diff=date_diff($awal, $akhir);

                  if ($diff->y==0) {
                    $xxx=$diff->m/12*$data_gaji['gapok'];
                    $jlh_thr=round($xxx);
                  }else{
                    $jlh_thr=$diff->y*$data_gaji['gapok'];
                  }
                  $bonus_full_absen=$count*$data_gaji['upah_full_absen'];
                  $total_bonus=$bonus_kls_tmbhn+$bonus_full_absen;
                  $totalgaji=$data_gaji['gapok']+ $total_bonus - $data_tunjangan['ttl_tnjngn']+$jlh_thr-$ttl_potongan;
                }else{
                  $id=$_GET['id'];
                  $periode=$_POST['periode'];
                  $tahun=$_POST['tahun'];
                  $query = "SELECT max(id_gaji) as maxId FROM tbl_gaji";
                  $hasil = mysqli_query($connect,$query);
                  $data = mysqli_fetch_array($hasil);
                  $iduser = $data['maxId'];
                  $noUrut = (int) substr($iduser, 3, 3);
                  $noUrut++;
                  $char = "GJI";
                  $iduser= $char . sprintf("%03s", $noUrut);

                  $query_kt="SELECT * FROM tbl_rekap_kt WHERE periode_kt='$periode' AND tahun_kt='$tahun' AND id_pegawai='$id'";
                  $sql_kt=mysqli_query($connect, $query_kt);
                  $data_kelas_tambahan=mysqli_fetch_array($sql_kt);

                  $query_gaji="SELECT * FROM tbl_data_gaji WHERE id_pegawai='$id'";
                  $sql_gaji=mysqli_query($connect, $query_gaji);
                  $data_gaji=mysqli_fetch_array($sql_gaji);


                  $query_absen="SELECT * FROM tbl_rekap_absen WHERE periode='$periode' AND tahun='$tahun' AND id_pegawai='$id'";
                  $sql_absen=mysqli_query($connect, $query_absen);
                  $data_absen=mysqli_fetch_array($sql_absen);

                  $bonus_kls_tmbhn=$data_kelas_tambahan['jml_kt'] * $data_gaji['upah_kls_tmbhn'];
                  $potongan_terlambat=$data_absen['jlh_terlambat'] * $data_gaji['potongan_keterlambatan'];

                  $query_tunjangan="SELECT * FROM tbl_rekap_tunjangan WHERE periode_tnjngn='$periode' AND tahun_tnjngn='$tahun' AND id_pegawai='$id'";
                  $sql_tunjangan=mysqli_query($connect, $query_tunjangan);
                  $data_tunjangan=mysqli_fetch_array($sql_tunjangan);
                  $tunjangan=$data_tunjangan['ttl_tnjngn'] ;

                  $query_potongan="SELECT * FROM tbl_rekap_ptngn WHERE periode_ptngn='$periode' AND tahun_ptngn='$tahun' AND id_pegawai='$id'";
                  $sql_potongan=mysqli_query($connect, $query_potongan);
                  $data_potongan=mysqli_fetch_array($sql_potongan);
                  $potongan=$data_potongan['ttl_ptngn'] ;
                  $ttl_potongan=$potongan + $potongan_terlambat;
                  

                  $order="SELECT * FROM tbl_absensi WHERE periode='$periode' AND tahun='$tahun' AND id_pegawai='$id'";
                  $query_order=mysqli_query($connect, $order);
                  $data_order=array();
                  while(($row_order=mysqli_fetch_array($query_order)) !=null){
                  $data_order[]=$row_order;
                  }
                  $count=count($data_order);
                
                  $query_pegawai="SELECT * FROM tbl_pegawai WHERE id_pegawai='$id'";
                  $sql_pegawai=mysqli_query($connect, $query_pegawai);
                  $data_pegawai=mysqli_fetch_array($sql_pegawai);

                  $awal=date_create("".$data_pegawai['tgl_mulai_kerja']."");
                  $akhir=date_create();
                  $diff=date_diff($awal, $akhir);

                  if ($diff->y==0) {
                    $xxx=$diff->m/12*$data_gaji['gapok'];
                    $jlh_thr=round($xxx);
                  }else{
                    $jlh_thr=$diff->y*$data_gaji['gapok'];
                  }
                  $bonus_full_absen=$count*$data_gaji['upah_full_absen'];
                  $total_bonus=$bonus_kls_tmbhn+$bonus_full_absen;
                  $totalgaji=$data_gaji['gapok']+ $total_bonus - $data_tunjangan['ttl_tnjngn']+$jlh_thr-$ttl_potongan;
                }
                ?>
              <div class="row">
                <div class="col-sm-8">
                  <div class="row">
                    <div class="col-sm-3">
                      <div class="form-group">
                            <div class="col-sm-12">
                              <input type="text" class="form-control" value="<?php echo $iduser;?>" name="id" readonly="readonly">
                            </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                            <div class="col-sm-12">
                              <input type="text" class="form-control" value="<?php echo $id;?>" name="pegawai" readonly="readonly">
                            </div>
                      </div>
                    </div>
                    <div class="col-sm-3">
                      <div class="form-group">
                            <div class="col-sm-12">
                              <input type="text" class="form-control" value="<?php echo $periode;?>" name="periode" readonly="readonly">
                            </div>
                      </div>
                    </div>
                     <div class="col-sm-3">
                      <div class="form-group">
                            <div class="col-sm-12">
                              <input type="text" class="form-control" value="<?php echo $tahun;?>" name="tahun" readonly="readonly">
                            </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Gapok (Rp)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" value="<?php echo $data_gaji['gapok'];?>" name="gapok" readonly="readonly">
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Tgl. Gaji</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="tgl" required="required">
                        </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                            <label class="col-sm-6 control-label">Bonus Kelas Tambahan (Rp)</label>
                            <div class="col-sm-6">
                              <input type="number" class="form-control" required="required" value="<?php echo $bonus_kls_tmbhn;?>" name="bkt" readonly="readonly">
                            </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                            <label class="col-sm-6 control-label">Bonus Full Absen (Rp)</label>
                            <div class="col-sm-6">
                              <input type="number" class="form-control" required="required" name="bf" <?php if ($count<=25){
                                echo"value='0'";
                              }else{
                                echo"value='".$bonus_full_absen."'";
                              } ?>
                              readonly="readonly">
                            </div>
                      </div>
                    </div>
                    <div class="col-sm-4">
                       <div class="form-group">
                            <label class="col-sm-6 control-label">Total Bonus (Rp)</label>
                            <div class="col-sm-6">
                              <input type="number" class="form-control" required="required" name="tb" <?php if ($count<=25){
                                echo"value='".$bonus_kls_tmbhn."''";
                              }else{
                                echo"value='".$total_bonus."'";
                              } ?>
                              readonly="readonly">
                            </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Tunjangan (Rp)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" value="<?php echo $tunjangan;?>"name="tjg" readonly="readonly">
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Potongan (Rp)</label>
                        <div class="col-sm-10">
                          <input type="number" required="required" class="form-control" value="<?php echo $potongan;?>"  name="ptg" readonly="readonly">
                        </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Potongan Keterlambatan (Rp)</label>
                        <div class="col-sm-10">
                          <input type="number" required="required" class="form-control" value="<?php echo $potongan_terlambat;?>"  name="potongan" readonly="readonly">
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">Total Potongan (Rp)</label>
                        <div class="col-sm-10">
                          <input type="number" required="required" class="form-control" value="<?php echo $ttl_potongan;?>"  name="tp" readonly="readonly">
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-2 control-label">THR (Rp)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" value="<?php echo $jlh_thr;?>"name="thr" readonly="readonly">
                        </div>
                  </div>
                   <div class="form-group">
                        <label class="col-sm-2 control-label">Total Gaji (Rp)</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" required="required" value="<?php echo $totalgaji;?>"  name="total" readonly="readonly">
                        </div>
                  </div>

                      <div class="row">
                        <div class="col-sm-12" style="text-align:right; margin-bottom: 4px; ">
                          <button type="submit" class="btn btn-info"><i class="fa fa-save"></i> Simpan Penggajian</button>
                        </div>
                      </div>
                    </div>
                <div class="col-sm-4" style="font-size: 10px;">
                  <b>Perhitungan Gaji</b>
                  <hr>
                  <div class="row">
                    <div class="col-sm-4">Bonus KT</div>
                    <div class="col-sm-8"> : <?php echo $data_kelas_tambahan['jml_kt'];?> Jam * Rp. <?php echo $data_gaji['upah_kls_tmbhn'];?> = Rp. <?php echo $bonus_kls_tmbhn;?></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Bonus Full Absen</div>
                    <div class="col-sm-8"> : <?php echo $count;?> Hari * Rp. <?php echo $data_gaji['upah_full_absen'];?> = Rp. <?php echo $bonus_full_absen;?></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Tunjangan</div>
                    <div class="col-sm-8"> : Rp. <?php echo $data_tunjangan['ttl_tnjngn'];?></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Potongan</div>
                    <div class="col-sm-8"> : Rp. <?php echo $data_potongan['ttl_ptngn'];?></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Potongan Keterlambatan</div>
                    <div class="col-sm-8"> : <?php echo $data_absen['jlh_terlambat'];?> Hari *  Rp. <?php echo $data_gaji['potongan_keterlambatan'];?> = Rp. <?php echo $potongan_terlambat;?></div>
                  </div>
                   <div class="row">
                    <div class="col-sm-4">Total Potongan</div>
                    <div class="col-sm-8"> : Rp. <?php echo $data_potongan['ttl_ptngn'];?> +  Rp. <?php echo $data_gaji['potongan_keterlambatan'];?> = Rp. <?php echo $ttl_potongan;?></div>
                  </div>
                  <div class="row">
                    <div class="col-sm-4">Total Gaji</div>
                    <div class="col-sm-8"> : Rp. <?php echo $data_gaji['gapok'];?> + Rp. <?php echo $total_bonus;?> + <?php echo $jlh_thr;?> - Rp. <?php echo $data_tunjangan['ttl_tnjngn'];?> - Rp. <?php echo $ttl_potongan;?> = Rp.<?php echo $totalgaji;?></div>
                  </div>
                  <b>Perhitungan THR</b>
                  <hr>
                  <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10"> Lama Kerja 1 Tahun Atau Lebih</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2">THR</div>
                    <div class="col-sm-10"> : Lama Kerja * Gaji Pokok</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2"></div>
                    <div class="col-sm-10"> Lama Kerja Kurang Dari 1 Tahun</div>
                  </div>
                  <div class="row">
                    <div class="col-sm-2">THR</div>
                    <div class="col-sm-10"> :<?php
                    if ($diff->y==0) {
                       echo "".$diff->m." Bulan / 12 * Rp.".$data_gaji['gapok']."= Rp.".$jlh_thr."";
                      }else{
                        echo "".$diff->y." Tahun * Rp.".$data_gaji['gapok']."= Rp.".$jlh_thr."";
                      }
                     ?>
                    </div>
                  </div>
                </div>

            </form>
          </div>
          <div class="box-footer">
             <a href="dashboard.php?p=data_gaji" class="btn btn-default"><i class="fa fa-close"></i> Tutup</a>
          </div>
          <!-- /.box-body -->
        </div>
      </section>
     