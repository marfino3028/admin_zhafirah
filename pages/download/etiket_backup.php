<?php
	session_start();
	// memanggil library FPDF
	require('fpdf.php');
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	//print_r($_SESSION);
	if ($_SESSION['rg_user'] != "") {
		$data_resep = $db->query("select * from tbl_resep where md5(id)='".$_GET['id']."'");
		$detail = $db->query("select * from tbl_resep_detail where resep_id='".$data_resep[0]['id']."'");
		$pasien = $db->query("select tgl_lahir from tbl_pasien where nomr='".$data_resep[0]['nomr']."'");
		$daftar = $db->query("select tgl_daftar from tbl_pendaftaran where no_daftar='".$data_resep[0]['no_daftar']."'");
		$sbu = $db->query("select nama, alamat from tbl_sbu where status_delete='UD'");
		 
		// intance object dan memberikan pengaturan halaman PDF
		$pdf=new FPDF('P','mm','A5');
		$pdf->AddPage();
		$no = 1;
		for ($i = 0; $i < count($detail); $i++) { 
		if ($no % 2 == 0) {
		$pdf->AddPage();
		}
		$no = $i + 1;
		$pdf->Image('../../images/technocare.jpeg',11,7,20,'PNG');
		$pdf->SetFont('Arial','B',11);
		$pdf->Cell(25,5,'',0,0,'');
		$pdf->Cell(50,5,$sbu[0]['nama'],0,1,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(25,0,'',0,0,'L');
		$pdf->Cell(110,5,$sbu[0]['alamat'],0,1,'L');
		$pdf->Cell(25,0,'',0,0,'L');
		//$pdf->Cell(110,4,'Telp. (021)-39737890',0,1,'L');

		$pdf->Cell(120,5,'',0,1,'L');
		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(70,5,$data_resep[0]['nama'],0,0,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(50,5,'Tgl Lahir : '.date("d F Y", strtotime($pasien[0]['tgl_lahir'])),0,1,'R');
		$pdf->Cell(120,0,'',1,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(70,7,'MRN # '.$data_resep[0]['nomr'],0,0,'L');
		$pdf->Cell(50,7,'Register # : '.$data_resep[0]['no_daftar'],0,1,'R');
		$pdf->SetFont('Arial','',9);
		$pdf->Cell(120,5,'APOTIK FARMASI Tanggal : '.date("d F Y", strtotime($daftar[0]['tgl_daftar'])),0,1,'L');

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(70,7,'No. Resep :',0,0,'L');
		$pdf->Cell(50,7,$detail[$i]['no_resep'],0,1,'R');
		$pdf->Cell(120,0,'',1,1,'L');

		$pdf->SetFont('Arial','',8);

		$pdf->Cell(70,7,$detail[$i]['nama_obat'],0,0,'L');
		$pdf->Cell(50,7,'QTY : '.$detail[$i]['qty'].' PCS',0,1,'R');
		$pdf->Cell(120,0,'',1,1,'L');

		$pdf->Cell(70,7,$detail[$i]['frekuensi'].' Sehari '.$detail[$i]['waktu_minum'],0,0,'L');
		$pdf->Cell(50,1,'',0,1,'R');
		$pdf->Cell(70,7,'',0,0,'L');
		$pdf->Cell(50,10,'',1,1,'R');
		$pdf->Cell(50,20,'',0,1,'');
		}
		
		$pdf->Output();
		//$pdf->Output('D', "SlipGaji-".$data[0]['nik']."-".$data[0]['nama'].$bln_nama[$bln]."-".$_POST['tahun'].".pdf", true);
		//$pdf->Output('F', '../../surat_rujukan/'.$nama_file);
	}
	else {
?>

	<script language="javascript">
            alert ("Mohon maaf, untuk kriteria yang Anda Pilih belum tersedia data");
            close();
        </script>

<?php
	}
?>