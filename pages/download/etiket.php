<?php
	session_start();
	// memanggil library FPDF
	require('fpdf.php');
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	//print_r($_SESSION);
	if ($_SESSION['rg_user'] != "") {
		$data_resep = $db->query("select * from tbl_resep where md5(id)='".$_GET['id']."' and status_delete='UD'");
		$detail = $db->query("select * from tbl_resep_detail where resep_id='".$data_resep[0]['id']."'and status_delete='UD'");
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
		$pdf->Image('../../images/technocare.jpeg',11,6,15,'PNG');
		$pdf->SetFont('Arial','',11);
		$pdf->Cell(25,5,'',0,0,'');
		$pdf->Cell(50,5,$sbu[0]['nama'],0,1,'L');
		$pdf->SetFont('Arial','',8);
		$pdf->Cell(25,0,'',0,0,'L');
		$pdf->Cell(110,5,$sbu[0]['alamat'],0,1,'L');
		$pdf->Cell(120,0,'',1,1,'L');
		//$pdf->Cell(110,4,'Telp. (021)-39737890',0,1,'L');
		$obat = $db->query("select kategori_nama, golongan_nama, comodity_nama from tbl_obat where kode_obat='".$detail[$i]['kode_obat']."'");

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(120,2,'',0,1,'L');
		$pdf->Cell(26,5,"Nama",0,0,'L');
		$pdf->Cell(5,5,":",0,0,'L');
		$pdf->Cell(70,5,$data_resep[0]['nama'],0,1,'L');
		$pdf->Cell(26,5,"No. MR",0,0,'L');
		$pdf->Cell(5,5,":",0,0,'L');
		$pdf->Cell(70,5,$data_resep[0]['nomr'],0,1,'L');
		$pdf->Cell(26,5,"Tanggal Lahir",0,0,'L');
		$pdf->Cell(5,5,":",0,0,'L');
		$pdf->Cell(70,5,date("d F Y", strtotime($pasien[0]['tgl_lahir'])),0,1,'L');
		$pdf->SetFont('Arial','',8);
		//$pdf->Cell(50,5,'Tgl Lahir : '.date("d F Y", strtotime($pasien[0]['tgl_lahir'])),0,1,'R');

		$pdf->SetFont('Arial','B',10);
		$pdf->Cell(120,5,'',0,1,'R');
		$pdf->Cell(120,5,$obat[0]['golongan_nama'],0,1,'C');
		$pdf->Cell(120,5,$detail[$i]['frekuensi'].' Sehari '.$detail[$i]['waktu_minum'],0,1,'C');

		$pdf->SetFont('Arial','',9);
		$pdf->Cell(120,5,'',0,1,'R');
		$pdf->Cell(55,5,'',0,0,'L');
		$pdf->Cell(35,5,'Tanggal Pemberian : ',0,0,'L');
		$pdf->Cell(20,5,date("d F Y", strtotime($daftar[0]['tgl_daftar'])),0,1,'L');
		$pdf->Cell(55,5,'',0,0,'L');
		$pdf->Cell(35,5,'Tanggal Kadaluarsa : ',0,0,'L');
		$pdf->Cell(20,5,'',0,1,'L');

		$pdf->Cell(70,7,'',0,0,'L');
		$pdf->Cell(50,20,'',0,1,'');
		}
		
		$pdf->Output();
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