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
$pdf->MultiCell(15.5,0.6,'SD KATOLIK NAIDEWA',0,'L');
$pdf->SetX(1.6);
$pdf->SetFont('Times','i',10);
$pdf->MultiCell(22.5,0.6,'Jln. Harimau No. 88 X, Ngada, NTT',0,'L'); 
$periode = $_POST['periode'];
$tahun = $_POST['tahun'];
$pdf->SetX(1.6);
$pdf->SetFont('Times','i',10);
$pdf->MultiCell(22.5,0.6,"Laporan Potongan Pegawai Periode: ".$periode."/ Tahun: ".$tahun,0,'L'); 
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
$pdf->Cell(2, 0.6, 'ID Potongan', 1, 0, 'L');
$pdf->Cell(2, 0.6, 'ID Pegawai', 1, 0, 'L');
$pdf->Cell(4.3, 0.6, 'Nama Pegawai', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'Tanggal', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'P/T', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'PSP', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'PKW', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'Memotomori', 1, 0, 'L');
$pdf->Cell(3, 0.6, 'Total Potongan', 1, 1, 'L');

$no=1;
$sql="SELECT * FROM tbl_potongan WHERE periode_ptngn='$periode' AND tahun_ptngn='$tahun'";
$tampil=mysqli_query($connect, $sql);
while($lihat=mysqli_fetch_array($tampil)){
    $pdf->SetFont('Times','',7);
    $pdf->Cell(1, 0.6, $no , 1, 0, 'C');
    $pdf->Cell(2, 0.6, $lihat['id_potongan'],1, 0, 'L');
    $pdf->Cell(2, 0.6, $lihat['id_pegawai'],1, 0, 'L');
    $query1="SELECT * FROM tbl_pegawai WHERE id_pegawai='".$lihat['id_pegawai']."'";
    $sql1=mysqli_query($connect, $query1);
    while ($data1=mysqli_fetch_array($sql1)) {
        $pdf->Cell(4.3, 0.6, $data1['nama_pegawai'],1, 0, 'L');
    }
    $pdf->Cell(3, 0.6, $lihat['tgl_ptngn'],1, 0, 'L');
    $pdf->Cell(3, 0.6, $lihat['periode_ptngn']."/".$lihat['tahun_ptngn'],1, 0, 'L');
    $pdf->Cell(3, 0.6,"Rp. ".number_format($lihat['ptngn_smpn_pnjm'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(3, 0.6,"Rp. ".number_format($lihat['ptngn_knsms_wjb'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(3, 0.6,"Rp. ".number_format($lihat['memotomori'], 2, ".", "."),1, 0, 'L');
    $pdf->Cell(3, 0.6,"Rp. ".number_format($lihat['tl_ptngn'], 2, ".", "."),1, 1, 'L');
    $no++;
}
$pdf->SetFont('Times','B',7);
$order="SELECT * FROM tbl_potongan WHERE periode_ptngn='$periode' AND tahun_ptngn='$tahun'";
$query_order=mysqli_query($connect, $order);
$data_order=array();
while(($row_order=mysqli_fetch_array($query_order)) !=null){
$data_order[]=$row_order;
}
$count=count($data_order);
$pdf->SetFont('Times','B',7);
$pdf->Cell(24.3, 0.6,"Jumlah Pegawai",1, 0, '');
$pdf->Cell(3, 0.6, $count ,1, 1, 'C');
$pdf->SetFont('Times','B',7);
$result="SELECT SUM(tl_ptngn) AS tl_ptngn FROM  tbl_potongan
WHERE periode_ptngn='$periode' AND tahun_ptngn='$tahun'";
 $sd=mysqli_query($connect, $result);
while($hasil=mysqli_fetch_object($sd))
{
    $pdf->Cell(24.3, 0.6,"Total Potongan Pegawai",1, 0, '');
    $pdf->Cell(3, 0.6, "Rp. ".number_format($hasil->tl_ptngn, 2, ".", "."),1, 1, '');
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