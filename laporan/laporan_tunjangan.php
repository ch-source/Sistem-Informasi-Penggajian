 <?php
include'koneksi.php';
include"fpdf.php";
require('makefont/makefont.php');
$pdf = new FPDF("L","cm","A4");
$data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user")); 
                if ($data['level'] == 'Kepsek') {
                    $konten = $data['nama_user'];
                }

$pdf->SetMargins(1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->SetX(1.6);   
$pdf->Image('img/lg.png', 1, 1, 2);
$pdf->SetX(1.6); 
$pdf->SetFont('Times','B',12);
$pdf->SetX(3);            
$pdf->MultiCell(15.5,0.6,'SMPK Chritoregi Ende',0,'L');
$pdf->SetX(3);
$pdf->SetFont('Times','i',10);
$pdf->MultiCell(22.5,0.6,'Jln. Perwira No. 73, Ende',0,'L'); 
$periode = $_POST['periode'];
$tahun = $_POST['tahun'];
$pdf->SetX(3);
$pdf->SetFont('Times','i',10);
$pdf->MultiCell(22.5,0.6,"Laporan Tunjangan Jabatan Pegawai/Guru Periode: ".$periode."/ Tahun: ".$tahun,0,'L'); 
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->SetFont('Times','i',8);
$periode = $_POST['periode'];
$tahun = $_POST['tahun'];
$pdf->ln(1);
$pdf->Cell(3.5,0.7,"Di cetak pada : ".date("D-d/m/Y"),0,0,'C');
$pdf->ln(1);
$pdf->SetFont('Times','B',8);
$pdf->Cell(1, 0.6, 'No', 1, 0, 'C');
$pdf->Cell(2, 0.6, 'ID Tunjangan', 1, 0, 'L');
$pdf->Cell(2, 0.6, 'ID Pegawai', 1, 0, 'L');
$pdf->Cell(10, 0.6, 'Nama Pegawai', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'Tanggal', 1, 0, 'L');
$pdf->Cell(2.5, 0.6, 'P/T', 1, 0, 'L');
$pdf->Cell(4, 0.6, 'Jenis Tunjangan', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'Jml. Tunjangan', 1, 1, 'L');

$no=1;
$sql="SELECT * FROM tbl_tunjangan WHERE periode_tjn='$periode' AND tahun_tjn='$tahun'";
$tampil=mysqli_query($connect, $sql);
while($lihat=mysqli_fetch_array($tampil)){
    $pdf->SetFont('Times','',8);
    $pdf->Cell(1, 0.6, $no , 1, 0, 'C');
    $pdf->Cell(2, 0.6, $lihat['id_tunjangan'],1, 0, 'L');
    $pdf->Cell(2, 0.6, $lihat['id_pegawai'],1, 0, 'L');
    $query1="SELECT * FROM tbl_pegawai WHERE id_pegawai='".$lihat['id_pegawai']."'";
    $sql1=mysqli_query($connect, $query1);
    while ($data1=mysqli_fetch_array($sql1)) {
        $pdf->Cell(10, 0.6, $data1['nama_pegawai'],1, 0, 'L');
    }
    $pdf->Cell(3, 0.6, $lihat['tgl_tnjngn'],1, 0, 'L');
    $pdf->Cell(2.5, 0.6, $lihat['periode_tjn']."/".$lihat['tahun_tjn'],1, 0, 'L');
    $pdf->Cell(4, 0.6, $lihat['tnjngn_jabatan'],1, 0, 'L');
    $pdf->Cell(3, 0.6,"Rp. ".number_format($lihat['jml_tnjngn_jbtn'], 2, ".", "."),1, 1, 'L');
    
    $no++;
}
$pdf->ln(1);
$pdf->SetFont('Times','i',10);
$pdf->Cell(22.5,0.7,"Hasil Rekapitulasi Tunjangan Jabatan Pegawai/Guru Periode: ".$periode." Tahun: ".$tahun,0,0,'L');
$pdf->ln(1);
$no=1;
$pdf->SetFont('Times','B',8);
$pdf->Cell(1, 0.6, 'No', 1, 0, 'C');
$pdf->Cell(4, 0.6, 'ID Pegawai', 1, 0, 'L');
$pdf->Cell(10, 0.6, 'Nama Pegawai', 1, 0, 'L');
$pdf->Cell(4.5, 0.6, 'Periode/Tahun', 1, 0, 'L');
$pdf->Cell(8, 0.6, 'Total Tunjangan', 1, 1, 'L');
$sql_x="SELECT * FROM tbl_rekap_tunjangan WHERE periode_tjng='$periode' AND tahun_tjng='$tahun'";
$tampil_x=mysqli_query($connect, $sql_x);
while($lihat_x=mysqli_fetch_array($tampil_x)){
    $pdf->SetFont('Times','',8);
    $pdf->Cell(1, 0.6, $no , 1, 0, 'C');
    $pdf->Cell(4, 0.6, $lihat_x['id_pegawai'],1, 0, 'L');
    $query_a="SELECT * FROM tbl_pegawai WHERE id_pegawai='".$lihat_x['id_pegawai']."'";
    $sql_a=mysqli_query($connect, $query_a);
    while ($data_a=mysqli_fetch_array($sql_a)) {
        $pdf->Cell(10, 0.6, $data_a['nama_pegawai'],1, 0, 'L');
    }
    $pdf->Cell(4.5, 0.6, $lihat_x['periode_tjng']."/".$lihat_x['tahun_tjng'],1, 0, 'L');
    $pdf->Cell(8, 0.6,"Rp. ".number_format($lihat_x['ttl_tnjngn'], 2, ".", "."),1, 1, 'L');
    $no++;
}
$order="SELECT * FROM tbl_rekap_tunjangan WHERE periode_tjng='$periode' AND tahun_tjng='$tahun'";
$query_order=mysqli_query($connect, $order);
$data_order=array();
while(($row_order=mysqli_fetch_array($query_order)) !=null){
$data_order[]=$row_order;
}
$count=count($data_order);
$pdf->SetFont('Times','B',10);
$pdf->Cell(19.5, 0.6,"Jumlah Pegawai",1, 0, '');
$pdf->Cell(8, 0.6, $count ,1, 1, 'C');
$pdf->SetFont('Times','B',10);
$result="SELECT SUM(ttl_tnjngn) AS ttl_tnjngn FROM  tbl_rekap_tunjangan
WHERE periode_tjng='$periode' AND tahun_tjng='$tahun'";
 $sd=mysqli_query($connect, $result);
while($hasil=mysqli_fetch_object($sd))
{
    $pdf->Cell(19.5, 0.6,"Total Tunjangan Jabatan Pegawai/Guru",1, 0, '');
    $pdf->Cell(8, 0.6, "Rp. ".number_format($hasil->ttl_tnjngn, 2, ".", "."),1, 1, '');
}
$pdf->SetMargins(2,1,2);
$pdf->SetFont('Times','',10);
$pdf->SetX(23);            
$pdf->Cell(10,2,"Ende, ".date("d-M-Y"),0,'R');
$pdf->SetFont('Times','',10);
$pdf->SetX(24);            
$pdf->Cell(10,6,$data['nama_user'],0,'R');
$pdf->Output();
?>