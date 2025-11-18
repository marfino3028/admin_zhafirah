<?php
session_start();
// memanggil library FPDF
require("fpdf.php");
date_default_timezone_set("Asia/Jakarta");
include "../../3rdparty/engine.php";
if ($_SESSION['mci_user'] != "") {
$data = $db->query("select * from tbl_pegawai where nik='".$_SESSION['mci_user']."'")->fetchAll();
$bln = $_POST['bulan'];
$bln_nama = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

 
// intance object dan memberikan pengaturan halaman PDF
$pdf=new FPDF();
$pdf->AddPage();
 
//$pdf->Image('https://emp.mci21.id/images/logo-mci.png',10,10,75);
$pdf->Image('https://emp.mci21.id/images/logo-mci.png',15,5,25,'PNG');
$pdf->SetFont('Times','BU',12);
$pdf->Cell(200,40,'ABSENSI KARYAWAN MAKSIMA',0,0,'C');
$pdf->SetFont('Times','B',14);
$pdf->Cell(-169);
$pdf->Cell(0,5,'MAKSIMA',10,1,'L');
$pdf->Cell(31);
$pdf->Cell(0,5,'CAKRAWALA',10,1,'L');
$pdf->Cell(31);
$pdf->Cell(0,5,'INSANI',10,1,'L');

$pdf->SetFont('Times','',10);
$pdf->Text(10, 36,'Nama : '.$data[0]['nama'],1,0,'L');
$pdf->Text(10, 40,'NIK : '.$data[0]['nik'],1,0,'L');
$pdf->Text(10, 44,'Jabatan : '.$data[0]['jabatan'],1,0,'L');
$pdf->Text(10, 48,'Cabang : '.$data[0]['cabang'],1,0,'L');
$pdf->Text(168, 48,'Bulan : '.$bln_nama[$bln].' '.$_POST['tahun'],1,0,'R');

 
$pdf->Cell(8,25,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(8,12,'Tgl',1,0,'C');
$pdf->Cell(30,6,'Jam Kerja/Lembur' ,1,0,'C');
$pdf->Cell(40,6,'Pemberi Tugas',1,0,'C');
$pdf->Cell(75,12,'Keterangan Aktifitas',1,0,'C');
$pdf->Cell(40,6,'Jam Lembur',1,0,'C');

$pdf->Cell(8,6,'',0,1);
$pdf->SetFont('Times','B',9);
$pdf->Cell(8,0,'',0,0,'L');
$pdf->Cell(15,6,'Mulai' ,1,0,'C');
$pdf->Cell(15,6,'Selesai' ,1,0,'C');
$pdf->Cell(30,6,'Pemberi Tugas',1,0,'C');
$pdf->Cell(10,6,'Paraf',1,0,'C');
$pdf->Cell(75,0,'Keterangan Aktifitas',0,0,'C');
$pdf->Cell(10,6,'I',1,0,'C');
$pdf->Cell(10,6,'II',1,0,'C');
$pdf->Cell(10,6,'III',1,0,'C');
$pdf->Cell(10,6,'IV',1,0,'C');

$pdf->Cell(8,6,'',0,1);
$pdf->SetFont('Times','',9);
$no=0;
for ($i = 0; $i <= 30; $i++) {
    $no = $no + 1;
    $tgls = $_POST['tahun'].'-'.$bln.'-'.$no;
    $msk = $db->query("select jam from tbl_absensi where nik='".$_SESSION['mci_nik']."' and tanggal='".$tgls."' and status='MSK' order by tgl_insert")->fetchAll();
    $masuk[$i] = substr($msk[0]['jam'], 0, 5);

    $plg = $db->query("select jam from tbl_absensi where nik='".$_SESSION['mci_nik']."' and tanggal='".$tgls."' and status='PLG' order by tgl_insert")->fetchAll();
    $pulang[$i] = substr($plg[0]['jam'], 0, 5);
    
	$jml = $db->query("select satu, dua, tiga, empat, keterangan, pemberi_tugas from tbl_lembur where nama='".$_SESSION['mci_nik']."' and tanggal='".$tgls."' and status_pengajuan='A' and status_pakai='P'")->fetchAll();
	
	if ($masuk[$i] != "" or $pulang[$i] != "") {
	    $hari_kerja = $hari_kerja + 1;
	}

    $pdf->Cell(8,5, $no,1,0,'C');
    $pdf->Cell(15,5, $masuk[$i],1,0, 'C');
    $pdf->Cell(15,5, $pulang[$i],1,0, 'C');
    $pdf->Cell(30,5, $jml[0]['pemberi_tugas'],1,0);  
    $pdf->Cell(10,5, '',1,0);  
    $pdf->Cell(75,5, $jml[0]['keterangan'],1,0);
    $pdf->Cell(10,5, $jml[0]['satu'],1,0, 'C');  
    $pdf->Cell(10,5, $jml[0]['dua'],1,0, 'C');  
    $pdf->Cell(10,5, $jml[0]['tiga'],1,0, 'C');  
    $pdf->Cell(10,5, $jml[0]['empat'],1,1, 'C');  
    $satu = $satu + $jml[0]['satu'];
    $dua = $dua + $jml[0]['dua'];
    $tiga = $tiga + $jml[0]['tiga'];
    $empat = $empat + $jml[0]['empat'];
}
$pdf->Image('https://emp.mci21.id/images/ttd.png',8,220,70,'PNG');
//$pdf->Cell(70, 25, $data[0]['nama'],1,0, 'C');  
//$pdf->Text(20, 250,$data[0]['nama'],1,0,'C');
$pdf->Image('https://emp.mci21.id/images/catatan.png',8,255,100,'PNG');

$pdf->SetXY(10, 219);
$pdf->Cell(8,8, '',0,0,'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(30,8, '',0,0);  
$pdf->Cell(40,8, '',0,0);  
$pdf->SetFont('Times','B');
$pdf->SetFillColor(210,221,242);
$pdf->Cell(45,8, 'Jumlah Jam Lembur',1,0, 'R', true);
$pdf->Cell(10,8, $satu,1,0, 'C');  
$pdf->Cell(10,8, $dua,1,0, 'C');  
$pdf->Cell(10,8, $tiga,1,0, 'C');  
$pdf->Cell(10,8, $empat,1,1, 'C');  

$pdf->SetXY(10, 229);
$pdf->Cell(8,8, '',0,0,'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(30,8, '',0,0);  
$pdf->Cell(40,8, '',0,0);  
$pdf->SetFont('Times','B');
$pdf->SetFillColor(210,221,242);
$pdf->Cell(45,8, 'Jumlah Hari Kerja',1,0, 'R', true);
$pdf->Cell(10,8, $hari_kerja,1,0, 'C');  
$pdf->Cell(10,8, '',0,0, 'C');  
$pdf->Cell(10,8, '',0,0, 'C');  
$pdf->Cell(10,8, '',0,1, 'C');  

$pdf->SetXY(10, 239);
$pdf->Cell(8,8, '',0,0,'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(30,8, '',0,0);  
$pdf->Cell(40,8, '',0,0);  
$pdf->SetFont('Times','B', '10');
$pdf->SetFillColor(210,221,242);
$pdf->Cell(85,8, 'PERSETUJUAN ABSENSI',1,1, 'C', true);

$pdf->SetXY(10, 247);
$pdf->Cell(8,8, '',0,0,'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(15,8, '',0,0, 'C');
$pdf->Cell(30,8, '',0,0);  
$pdf->Cell(40,8, '',0,0);  
$pdf->SetFont('Times','B');
$pdf->SetFillColor(210,221,242);
$pdf->Cell(42,8, 'Diperiksa',1,0, 'C');
$pdf->Cell(43,8, 'Mengetahui, Menyetujui',1,1, 'C');  

$pdf->SetXY(10, 255);
$pdf->Cell(8,20, '',0,0,'C');
$pdf->Cell(15,20, '',0,0, 'C');
$pdf->Cell(15,20, '',0,0, 'C');
$pdf->Cell(30,20, '',0,0);  
$pdf->Cell(40,20, '',0,0);  
$pdf->Cell(42,21, '',1,0, 'C');
$pdf->Cell(43,21, '',1,1, 'C');  

$pdf->SetFont('Times','', 12);
$pdf->SetXY(0, 243.5);
$pdf->SetX(9.5);
// FPDF align Right text
$pdf->Cell( 67, 11, $data[0]['nama'], 0, 0, 'C' );

$pdf->Output();
//$pdf->Output('D', "Absensi-".$bln_nama[$bln]."-".$_POST['tahun'].'-'.date("YmdHis").".pdf", true);

}
else {
    
    
}
?>