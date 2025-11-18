<?php
session_start();
// memanggil library FPDF
require('fpdf.php');
date_default_timezone_set("Asia/Jakarta");
include "../../3rdparty/engine.php";
if ($_SESSION['mci_user'] != "") {
    if ($_SESSION['mci_user'] == "20219999") {
        $data1 = $db->query("select * from tbl_payrol_g_final where bln='".$_POST['bulan']."' and thn='".$_POST['tahun']."' and nik='E.00002' and status_view='ON'")->fetchAll();
        $data = $db->query("select * from tbl_pegawai where nik='E.00002'")->fetchAll();
    }
    else {
        $data1 = $db->query("select * from tbl_payrol_g_final where bln='".$_POST['bulan']."' and thn='".$_POST['tahun']."' and nik='".$_SESSION['mci_user']."' and status_view='ON'")->fetchAll();
        $data = $db->query("select * from tbl_pegawai where nik='".$_SESSION['mci_user']."'")->fetchAll();
    }
$bln = $_POST['bulan'];
$bln_report = $_POST['bulan'];
$thn_report = $_POST['tahun'];
$_POST['bulan'] = $data1[0]['bln'];
$_POST['tahun'] = $data1[0]['thn'];

$bln_nama = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

$slipGaji = $db->query("select * from tbl_payrol_g_final where nik='".$data[0]['nik']."' and thn='".$_POST['tahun']."' and bln='".$_POST['bulan']."' and status_view='ON'")->fetchAll();

if ($data1[0]['gapok'] > 0) {
 
$pdf=new FPDF('P','mm','A4');
$pdf->AddPage();
 
//$pdf->Image('https://emp.mci21.id/images/logo-mci.png',10,10,75);
$pdf->Image('https://emp.mci21.id/images/logo-mci.png',15,5,25,'PNG');
$pdf->SetFont('Arial','BU',12);
$pdf->Cell(190,20,'SLIP GAJI KARYAWAN MAKSIMA',0,0,'R');
$pdf->SetFont('Times','B',14);
$pdf->Cell(-159);
$pdf->Cell(0,5,'MAKSIMA',10,1,'L');
$pdf->Cell(31);
$pdf->Cell(0,5,'CAKRAWALA',10,1,'L');
$pdf->Cell(31);
$pdf->Cell(0,5,'INSANI',10,1,'L');

$pdf->SetFont('Times','',12);
$pdf->Text(12, 38,'NIK / Nama : '.$data[0]['nik'].' / '.$data[0]['nama'],1,0,'L');
$pdf->Text(12, 43,'Jabatan : '.$data[0]['jabatan'],1,0,'L');
$pdf->Text(158, 43,'Rekening : '.$slipGaji[0]['rekening'],1,0,'R');
$pdf->Text(12, 48,'Cabang : '.$data[0]['cabang'],1,0,'L');
$pdf->Text(158, 48,'Bulan : '.$bln_nama[$bln].' '.$_POST['tahun'],1,0,'R');

 
$pdf->Cell(5,32,'',0,1);

$pdf->SetFont('Arial','B',12);
$pdf->setFillColor(230,230,230);
$pdf->Cell(193,7, 'PENDAPATAN','B',1,'L', 'C', TRUE);

$pdf->SetFont('Arial','B',12);
$pdf->SetFont('','U');
$pdf->Cell(110,7, 'PRIBADI (A)',0,0,'0');
$pdf->Cell(50,7, 'PERUSAHAAN (B)',0,1,'0');
$pdf->SetFont('Arial','',10);

$pdf->Cell(55,5, '1. Gaji Pokok',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['gapok']*1, 0),0,0,'R'); 
$pdf->Cell(25,5, '',0,0);
$pdf->Cell(60,5, '12. Tunjangan JHT (3,70%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*3.7)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '2. Uang Penginapan',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_klaim_penginapan']*1, 0),0,0,'R'); 
$pdf->Cell(25,5, '',0,0);
$pdf->Cell(60,5, '13. Tunjangan JKK (0,24%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*0.24)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '3. Uang Lembur',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_lembur']*1, 0),0,0,'R'); 
$pdf->Cell(25,5, '',0,0);
$pdf->Cell(60,5, '14. Tunjangan JKM (0,30%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*0.30)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '4. Insentif Kor Lap',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_insentif_koordinator']*1, 0),0,0,'R'); 
$pdf->Cell(25,5, '',0,0);
$pdf->Cell(60,5, '15. Tunjangan JP (2%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*2)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '5. Uang Bantuan Kedukaan',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_wafat']*1, 0),0,0,'R'); 
$pdf->Cell(25,5, '',0,0);
$pdf->Cell(60,5, '16. BPJS Kesehatan (4%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*4)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$total_perusahaan = ($slipGaji[0]['gapok']*3.7/100) + ($slipGaji[0]['gapok']*0.24/100) + ($slipGaji[0]['gapok']*0.30/100) + ($slipGaji[0]['gapok']*2/100) + ($slipGaji[0]['gapok']*4/100);

$pdf->Cell(55,5, '6. Uang Bantuan Kelahiran',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_kelahiran']*1, 0),0,0,'R');
$pdf->Cell(25,5, '',0,0);
$pdf->setFillColor(230,230,230);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,7, 'Total Perusahaan (B)',0,0, 'C', 'C', TRUE);
$pdf->Cell(5,7, 'RP.',0,0, 'R', 'C', TRUE);
$pdf->Cell(18,7, number_format($total_perusahaan, 0),0,0,'R', 'C', TRUE); 
$pdf->Cell(5,7, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(55,5, '7. Tunjangan Hari Raya (THR)',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_thr']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '8. Insentif',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_insentif']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '9. Uang Kompensasi',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_uang_kompensasi']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '10. Transport Cleaning',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_transport_cleaning']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(55,5, '11. Rapel Gapok',0,0);
$pdf->Cell(10,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['pendapatan_ugs']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$total_pribadi = $slipGaji[0]['pendapatan_total'];

$pdf->setFillColor(230,230,230);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(55,7, 'Total Pribadi (A)',0,0, 'C', 'C', TRUE);
$pdf->Cell(10,7, 'RP.',0,0, 'R', 'C', TRUE);
$pdf->Cell(20,7, number_format($total_pribadi, 0),0,0,'R', 'C', TRUE); 
$pdf->Cell(5,7, '',0,1); //end line

$total_Pendapatan = $total_perusahaan + $total_pribadi;

$pdf->Cell(5,2,'',0,1);

$pdf->SetFont('Arial','B',12);
$pdf->Cell(148,7, 'TOTAL PENDAPATAN (A + B)','T, B',0, 'R', 'C', TRUE);
$pdf->Cell(40,7, 'Rp. '.number_format($total_Pendapatan, 0), 'T, B',0, 'R', 'C', TRUE); 
$pdf->Cell(5,7, '', 'T, B',1, 'C', TRUE); //end line


$pdf->SetFont('Arial','B',12);
$pdf->Cell(193,7, '','',1,'L');
$pdf->Cell(193,7, 'POTONGAN','B',1,'L', 'C', TRUE);


$pdf->SetFont('Arial','',10);
$pdf->SetFont('','U');
$pdf->Cell(110,7, 'PRIBADI (C)',0,0,'0');
$pdf->Cell(50,7, 'PERUSAHAAN (D)',0,1,'0');
$pdf->SetFont('Arial','',10);

$pdf->Cell(72,5, '1. Premi BPJS Kesehatan (1%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_bpjs_kesehatan'], 0),0,0,'R'); 
$pdf->Cell(13,5, '',0,0);
$pdf->Cell(60,5, '14. Tunjangan JHT (3,70%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*3.7)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(72,5, '2. Potongan Tidak Masuk Kerja',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_ganti_sementara'], 0),0,0,'R'); 
$pdf->Cell(13,5, '',0,0);
$pdf->Cell(60,5, '15. Tunjangan JKK (0,24%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*0.24)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(72,5, '3. Simpanan Koperasi',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_simpanan_koperasi'], 0),0,0,'R'); 
$pdf->Cell(13,5, '',0,0);
$pdf->Cell(60,5, '16. Tunjangan JKM (0,30%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*0.30)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(72,5, '4. Potongan JHT (2%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_bpjs_jht'], 0),0,0,'R'); 
$pdf->Cell(13,5, '',0,0);
$pdf->Cell(60,5, '17. Tunjangan JP (2%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*2)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->Cell(72,5, '5. Potongan JP (1%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_bpjs_jp'], 0),0,0,'R'); 
$pdf->Cell(13,5, '',0,0);
$pdf->Cell(60,5, '18. BPJS Kesehatan (4%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(18,5, number_format(($slipGaji[0]['gapok']*4)/100, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$total_perusahaan = ($slipGaji[0]['gapok']*3.7/100) + ($slipGaji[0]['gapok']*0.24/100) + ($slipGaji[0]['gapok']*0.30/100) + ($slipGaji[0]['gapok']*2/100) + ($slipGaji[0]['gapok']*4/100);

$pdf->Cell(72,5, '6. Potongan Pengelolaan',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_pengelolaan']*1, 0),0,0,'R');
$pdf->Cell(13,5, '',0,0);
$pdf->setFillColor(230,230,230);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(60,7, 'Total Perusahaan (D)',0,0, 'C', 'C', TRUE);
$pdf->Cell(5,7, 'RP.',0,0, 'R', 'C', TRUE);
$pdf->Cell(18,7, number_format($total_perusahaan, 0),0,0,'R', 'C', TRUE); 
$pdf->Cell(5,7, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(72,5, '7. Potongan WASERDA',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_waserda']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(72,5, '8. Komersil                '.$slipGaji[0]['potongan_komersil_jml'],0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_komersil_ke']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(72,5, '9. Potongan BPJS Tambahan (1%)',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_bpjs_tambahan'], 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(72,5, '10. Potongan PPh 21',0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_pph21'], 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(72,5, '11. Potongan Maksima      '.$slipGaji[0]['potongan_alqardh_jml'],0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_alqardh_ke'], 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(72,5, '12. Potongan Multiguna Maksima '.$slipGaji[0]['potongan_multiguna_jml'],0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_multiguna_ke'], 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pdf->SetFont('Arial','',10);
$pdf->Cell(72,5, '13. Potongan Kredit HP '.$slipGaji[0]['potongan_handphone_jml'],0,0);
$pdf->Cell(5,5, 'RP.',0,0, 'R');
$pdf->Cell(20,5, number_format($slipGaji[0]['potongan_handphone_ke']*1, 0),0,0,'R'); 
$pdf->Cell(5,5, '',0,1); //end line

$pengurangan_pribadi = $slipGaji[0]['potongan_total'];

$pdf->setFillColor(230,230,230);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(72,7, 'Total Pribadi (C)',0,0, 'C', 'C', TRUE);
$pdf->Cell(5,7, 'RP.',0,0, 'R', 'C', TRUE);
$pdf->Cell(20,7, number_format($pengurangan_pribadi, 0),0,0,'R', 'C', TRUE); 
$pdf->Cell(5,7, '',0,1); //end line

$pdf->Cell(5,2,'',0,1);
$total_potongan = $pengurangan_pribadi + $total_perusahaan;
$pdf->SetFont('Arial','B',12);
$pdf->Cell(148,7, 'TOTAL POTONGAN (C + D)','T, B',0, 'R', 'C', TRUE);
$pdf->Cell(40,7, 'Rp. '.number_format($total_potongan, 0), 'T, B',0, 'R', 'C', TRUE); 
$pdf->Cell(5,7, '', 'T, B',1, 'C', TRUE); //end line

$total_bersih = $total_Pendapatan - $total_potongan;
$pdf->SetFont('Arial','B',12);
$pdf->Cell(193,7, '','',1,'L');
$pdf->Cell(148,7, 'PENGHASILAN BERSIH (TOTAL PENDAPATAN - TOTAL POTONGAN)','T, B',0, 'C', TRUE);
$pdf->Cell(40,7, 'Rp. '.number_format($total_bersih, 0), 'T, B',0, 'R', 'C', TRUE); 
$pdf->Cell(5,7, '', 'T, B',1, 'C', TRUE); //end line

$pdf->Output();
//$pdf->Output('D', "SlipGaji-".$data[0]['nik']."-".$data[0]['nama'].$bln_nama[$bln]."-".$_POST['tahun'].".pdf", true);
}
else {
?>
<script language="javascript">
	//alert ("Mohon maaf, untuk kriteria yang Anda Pilih belum tersedia data di bulan ".<?php echo $bln_nama[$bln_report].' '.$bln_nama[$thn_report]?>);
	alert ("Mohon maaf, untuk kriteria yang Anda Pilih belum tersedia data di bulan <?php echo $bln_nama[$bln_report].' '.$thn_report ?>");
	close();
</script>

<?php
}
}
else {
    
    echo 'Silahkkan login terlebih dahulu';
}
?>