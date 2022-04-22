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
$pdf->MultiCell(22.5,0.6,"Laporan Rekap Gaji Pegawai/Guru Periode: ".$periode."/ Tahun: ".$tahun,0,'L'); 
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
$pdf->Cell(3, 0.6, 'ID Pegawai', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'Nama Pegawai', 1, 0, 'L');
$pdf->Cell(2, 0.6, 'Tgl.Gaji', 1, 0, 'L');
$pdf->Cell(2, 0.6, 'P/T', 1, 0, 'L');
$pdf->Cell(2.2, 0.6, 'Gapok', 1, 0, 'L');
$pdf->Cell(2.2, 0.6, 'TI', 1, 0, 'L');
$pdf->Cell(2.2, 0.6, 'TJ', 1, 0, 'L');
$pdf->Cell(2.2, 0.6, 'TWK', 1, 0, 'L');
$pdf->Cell(2.2, 0.6, 'TLT', 1, 0, 'L');
$pdf->Cell(2.2, 0.6, 'TP', 1, 0, 'L');
$pdf->Cell(3.2, 0.6, 'Total Gaji', 1, 1, 'L');

$no=1;
$sql="SELECT * FROM tbl_gaji WHERE periode='$periode' AND tahun='$tahun'";
$tampil=mysqli_query($connect, $sql);
while($lihat=mysqli_fetch_array($tampil)){
    $pdf->SetFont('Times','',7);
    $pdf->Cell(1, 0.5, $no , 1, 0, 'C');
    $pdf->Cell(3, 0.5, $lihat['id_pegawai'],1, 0, 'L');
    $query1="SELECT * FROM tbl_pegawai WHERE id_pegawai='".$lihat['id_pegawai']."'";
    $sql1=mysqli_query($connect, $query1);
    while ($data1=mysqli_fetch_array($sql1)) {
        $pdf->Cell(3, 0.5, $data1['nama_pegawai'],1, 0, 'L');
    }
    $pdf->Cell(2, 0.5, $lihat['tanggal'],1, 0, 'L');
    $pdf->Cell(2, 0.5, $lihat['periode']."/".$lihat['tahun'],1, 0, 'L');
    $pdf->Cell(2.2, 0.5,"Rp. ".number_format($lihat['gapok'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(2.2, 0.5,"Rp. ".number_format($lihat['tunjangan_ijazah'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(2.2, 0.5,"Rp. ".number_format($lihat['tunjangan_jabatan'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(2.2, 0.5,"Rp. ".number_format($lihat['tunjangan_wk'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(2.2, 0.5,"Rp. ".number_format($lihat['ttl_tunjangan'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(2.2, 0.5,"Rp. ".number_format($lihat['ttl_potongan'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(3.2, 0.5,"Rp. ".number_format($lihat['total_gaji'], 2, ".", "."),1, 1, 'L');
    $no++;
}
$pdf->SetFont('Times','B',7);
$order="SELECT * FROM tbl_gaji WHERE periode='$periode' AND tahun='$tahun'";
$query_order=mysqli_query($connect, $order);
$data_order=array();
while(($row_order=mysqli_fetch_array($query_order)) !=null){
$data_order[]=$row_order;
}
$count=count($data_order);
$pdf->SetFont('Times','B',7);
$pdf->Cell(24.2, 0.5,"Jumlah Pegawai",1, 0, '');
$pdf->Cell(3.2, 0.5, $count ,1, 1, 'C');
$pdf->SetFont('Times','B',7);
$result="SELECT SUM(total_gaji) AS total_gaji FROM  tbl_gaji
WHERE periode='$periode' AND tahun='$tahun'";
 $sd=mysqli_query($connect, $result);
while($hasil=mysqli_fetch_object($sd))
{
    $pdf->Cell(24.2, 0.5,"Total Pengeluaran Untuk Gaji",1, 0, '');
    $pdf->Cell(3.2, 0.5, "Rp. ".number_format($hasil->total_gaji, 2, ".", "."),1, 1, '');
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