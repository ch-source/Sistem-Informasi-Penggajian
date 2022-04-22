<?php
include'koneksi.php';
include"fpdf.php";
require('makefont/makefont.php');
$periode = $_POST['periode'];
$tahun = $_POST['tahun'];
$pdf = new FPDF("L","cm","Letter");
$data = mysqli_fetch_array(mysqli_query($connect, "SELECT * FROM tbl_user")); 
                if ($data['level'] == 'Kepsek') {
                    $konten = $data['nama_user'];
                 
                  

$sql="SELECT * FROM tbl_gaji WHERE periode='$periode' AND tahun = '$tahun'";
$tampil=mysqli_query($connect, $sql);
while ($lihat=mysqli_fetch_array($tampil)) {

$gakot=$lihat['gapok']+$lihat['tunjangan_ijazah']+$lihat['tunjangan_wk']+$lihat['tunjangan_jabatan'];
$sql1="SELECT * FROM tbl_pegawai WHERE id_pegawai = '".$lihat['id_pegawai']."'";
$tampil1=mysqli_query($connect, $sql1);
$lihat1=mysqli_fetch_array($tampil1);
$pdf->SetMargins(2,1,2);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',12);
$pdf->SetX(4);   
$pdf->Image('img/lg.png', 2, 1, 2);
$pdf->SetX(4);
$pdf->SetFont('Times','B',10);
$pdf->SetX(4); 
$pdf->Cell(11,0.6,"SMPK Chritoregi Ende",0,0,'L');
$pdf->Cell(6,0.6,$data['level'],0,0,'L');
$pdf->Cell(1,0.6,":",0,0,'L');
$pdf->Cell(6,0.6,$konten,0,1,'L');
$pdf->SetX(4); 
$pdf->Cell(11,0.6,"Jln. Perwira No. 73, Ende",0,0,'L');
$pdf->Cell(6,0.6,"Tgl. Gaji",0,0,'L');
$pdf->Cell(1,0.6,":",0,0,'L');
$pdf->Cell(6,0.6,$lihat['tanggal'],0,1,'L');
$pdf->SetX(4); 
$pdf->Cell(11,0.6,"Hal : Slip Gaji",0,0,'L');
$pdf->Cell(6,0.6,"Periode/Tahun",0,0,'L');
$pdf->Cell(1,0.6,":",0,0,'L');
$pdf->Cell(6,0.6,$periode."/".$tahun,0,1,'L');
$pdf->Cell(20,0.6,"---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'L');
$pdf->SetFont('Times','i',10);
    $pdf->Cell(5, 0.6,"Pegawai",0, 0, 'L');
    $pdf->Cell(1, 0.6,":",0, 0, 'C');
    $pdf->Cell(13, 0.6, $lihat['id_pegawai']."-".$lihat1['nama_pegawai'],0, 1, 'L');
    $pdf->Cell(5, 0.6,"Jabatan",0, 0, 'L');
    $pdf->Cell(1, 0.6,":",0, 0, 'C');
    $pdf->Cell(13, 0.6, $lihat1['jabatan'],0, 1, 'L');
    $pdf->Cell(10, 0.6,"Gaji Pokok",0, 0, 'L');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6,"Rp. ".number_format($lihat['gapok'], 2, ".", ".") ,0, 1, 'L');
    $pdf->Cell(10, 0.6,"Tunjangan Ijazah",0, 0, 'L');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6,"Rp. ".number_format($lihat['tunjangan_ijazah'], 2, ".", "."),0, 1, 'L');
    $pdf->Cell(10, 0.6,"Tunjangan Jabatan",0, 0, 'L');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6,"Rp. ".number_format($lihat['tunjangan_jabatan'], 2, ".", "."),0, 1, 'L');
    $pdf->Cell(10, 0.6,"Tunjangan Wali Kelas",0, 0, 'L');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6, "Rp. ".number_format($lihat['tunjangan_wk'], 2, ".", "."),0, 1, 'L');
    $pdf->Cell(10, 0.6,"",0, 0, 'L');
    $pdf->Cell(6, 0.6,"",0, 0, 'C');
    $pdf->Cell(5, 0.6,"________________ +",0, 1, 'L');
    $pdf->Cell(10, 0.6,"Gaji Kotor",0, 0, 'R');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6, "Rp. ".number_format($gakot, 2, ".", "."),0, 1, 'L');
    $pdf->Cell(10, 0.6,"Potongan",0, 0, 'L');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6,"Rp. ".number_format($lihat['potongan'], 2, ".", "."),0, 1, 'L');
    $pdf->Cell(10, 0.6,"Potongan Keteralambatan",0, 0, 'L');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6,"Rp. ".number_format($lihat['potongan_terlambat'], 2, ".", "."),0, 1, 'L');
    $pdf->Cell(10, 0.6,"",0, 0, 'L');
    $pdf->Cell(6, 0.6,"",0, 0, 'C');
    $pdf->Cell(5, 0.6,"________________ -",0, 1, 'L');
    $pdf->Cell(10,0.6,"Gaji Bersih",0, 0, 'R');
    $pdf->Cell(6, 0.6,":",0, 0, 'C');
    $pdf->Cell(5, 0.6,"Rp. ".number_format($lihat['total_gaji'], 2, ".", "."),0, 1, 'L');
    $pdf->Cell(20,0.6,"-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'L');
    $pdf->SetFont('Times','i',8);
    $pdf->Cell(20.5,0.7,"Ende, ".date("D-d/m/Y"),0,1,'L');

$pdf->SetMargins(2,1,2);
$pdf->SetFont('Times','',10);
$pdf->SetX(23);            
$pdf->Cell(10,2,"Ende, ".date("d-M-Y"),0,'R');
$pdf->SetFont('Times','',10);
$pdf->SetX(24);            
$pdf->Cell(10,6,$data['nama_user'],0,'R');
}
}


$pdf->Output();
?>