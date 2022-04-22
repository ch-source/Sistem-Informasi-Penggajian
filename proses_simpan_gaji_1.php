<?php
include"koneksi.php";
$id=$_POST['id'];
$tgl=$_POST['tglgaji'];
$periode1=$_POST['periode'];
$tahun1=$_POST['tahun'];
$gapok=$_POST['gapok'];
$tunjanganijazah=$_POST['tunjanganijazah'];
$tunjanganwk=$_POST['tunjanganwk'];
$tunjanganjabatan=$_POST['tunjanganjabatan'];
$ttltunjangan=$_POST['ttltunjangan'];
$datapotongan=$_POST['datapotongan'];
$potonganterlambat=$_POST['potonganterlambat'];
$ttlpotongan=$_POST['ttlpotongan'];
$totalgaji=$_POST['totalgaji'];

$count=count($id);
$sql="INSERT INTO `tbl_gaji` (`id_pegawai`, `periode`, `tahun`, `tanggal`, `gapok`, `tunjangan_ijazah`, `tunjangan_jabatan`, `tunjangan_wk`, `ttl_tunjangan`, `potongan`, `potongan_terlambat`, `ttl_potongan`, `total_gaji`) VALUES ";
for ($i=0; $i <$count ; $i++) { 
	$sql.="('{$id[$i]}', '{$periode1[$i]}', '{$tahun1[$i]}','{$tgl[$i]}', '{$gapok[$i]}', '{$tunjanganijazah[$i]}', '{$tunjanganjabatan[$i]}', '{$tunjanganwk[$i]}', '{$ttltunjangan[$i]}', '{$datapotongan[$i]}', '{$potonganterlambat[$i]}', '{$ttlpotongan[$i]}', '{$totalgaji[$i]}')";
	$sql.=",";
}

$sql=rtrim($sql,",");
			$insert=$connect->query($sql);
			if (!$insert) {
				echo "<script>alert('Opss!, Data Gaji Gagal Disimpan');
				document.location.href='dashboard.php?p=data_gaji'</script>\n";
				
			}else{
				echo "<script>alert('Data Gaji Berhasil Disimpan');
				document.location.href='dashboard.php?p=data_gaji'</script>\n";
			}

?>

