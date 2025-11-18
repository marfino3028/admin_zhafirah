<?php
	session_start();
	// memanggil library FPDF
	require('fpdf.php');
	date_default_timezone_set("Asia/Jakarta");
	include "../../3rdparty/engine.php";
	
	if ($_SESSION['rg_user'] != "") {
		$daftar = $db->query("select * from tbl_pendaftaran where md5(no_daftar)='".$_GET['id']."'");
		$pasien = $db->query("select * from tbl_pasien where nomr='".$daftar[0]['nomr']."'");
		$bln = $_POST['bulan'];
		$bln_nama = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
		 
		// intance object dan memberikan pengaturan halaman PDF
		$pdf=new FPDF('P','mm','A4');
		$pdf->AddPage();
		 
		$pdf->Image('logo_dialisa.png',145,2,60,'PNG');
		$pdf->SetFont('Arial','BU',12);
		$pdf->Cell(200,40,'HASIL PEMERIKSAAN KESEHATAN / EXAMINATION RESULLT UMUM',0,0,'L');
		$pdf->SetFont('Times','B',14);
		
		$pdf->Cell(5,32,'',0,1);
		
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(200,7,'NO. MCU : UMUM-'.$pasien[0]['nomr'],0,1,'L');

		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(30,7,'Nama Lengkap ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(58,7,'Full Name ',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$pasien[0]['nm_pasien'],0,1,'L');
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(43,7,'Tempat Tanggal Lahir ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(45,7,'Place / Birth of Date',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$pasien[0]['tmpt_lahir'].', '.date("d F Y", strtotime($pasien[0]['tgl_lahir'])),0,1,'L');
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(29,7,'Jenis Kelamin ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(59,7,'Sex',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$pasien[0]['jk'],0,1,'L');
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(36,7,'Status Pernikahan ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(52,7,'Maritial Status',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$pasien[0][''],0,1,'L');
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(20,7,'Pekerjaan ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(68,7,'Occupation',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$pasien[0]['pekerjaan'],0,1,'L');
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(15,7,'Alamat ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(73,7,'Address',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,substr($pasien[0]['alamat_pasien'], 0, 40),0,1,'L');
		if (substr($pasien[0]['alamat_pasien'], 40, 40) != "") {
			$pdf->Cell(106,7,'',0,0,'L');
			$pdf->Cell(50,7,substr($pasien[0]['alamat_pasien'], 40, 40),0,1,'L');
		}
		if (substr($pasien[0]['alamat_pasien'], 80, 40) != "") {
			$pdf->Cell(106,7,'',0,0,'L');
			$pdf->Cell(50,7,substr($pasien[0]['alamat_pasien'], 80, 40),0,1,'L');
		}
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(13,7,'Paket ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(75,7,'Package',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$daftar[0]['paket_mcu_nama'],0,1,'L');

                                            	$data[$i]['kode_dokter'] = $dktrmcu[0]['dokter_kode'];
                                            	$dokter = $db->queryItem("select nama_dokter from tbl_dokter where kode_dokter='".$daftar[0]['kode_dokter']."'");
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(40,7,'Dokter Pemeriksaan ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(48,7,'Doctors Examiner',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$dokter,0,1,'L');
		
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(40,7,'Tanggal Pemeriksaan ',0,0,'L');
		$pdf->SetFont('Arial','i',12);
		$pdf->Cell(48,7,'Date of Examination',0,0,'L');
		$pdf->SetFont('Arial','',12);
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,date("d F Y", strtotime($daftar[0]['tgl_daftar'])),0,1,'L');
		
		$worklist = $db->query("select * from tbl_mcu_worklist where nomr='".$daftar[0]['nomr']."' order by tanggal desc");
		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(5,4,'',0,1);
		$pdf->Cell(100,7,'ANAMNESIA',0,0,'L');
		$pdf->Cell(100,7,'KEBIASAAN',0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Keluhan',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['keluhan'],0,0,'L');
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(33,7,'Makan',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['makan'],0,1,'L');

		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Diabetes Melitus',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['diabet'],0,0,'L');
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(33,7,'Merokok',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['merokok'],0,1,'L');

		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Hipertensi',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['hipertensi'],0,0,'L');
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(33,7,'Alkohol',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['alkohol'],0,1,'L');

		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Penyakit Jantung',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['jantung'],0,0,'L');
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(33,7,'Kopi',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['kopi'],0,1,'L');

		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Penyakit Paru-Paru',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['paru'],0,0,'L');
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(33,7,'Olahraga',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['olahraga'],0,1,'L');

		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Kecelakaan',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['kecelakaan'],0,0,'L');
		$pdf->Cell(15,7,'',0,0,'L');
		$pdf->Cell(33,7,'Pola Devikasi',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['pola_devikasi'],0,1,'L');

		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Dirawat di RS',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['rawat'],0,1,'L');
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Pengobatan',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['pengobatan'],0,1,'L');
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Alergi',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['alergi'],0,1,'L');
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Operasi',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['operasi'],0,1,'L');
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Diabetes - Ayah',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['diabet_ayah'],0,1,'L');
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Hipertensi Ayah',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['hipertensi_ayah'],0,1,'L');

		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(5,4,'',0,1);
		$pdf->Cell(100,7,'PEMERIKSAAN FISIK',0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Tekanan Darah',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['tekanan_darah'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Denyut Nadi',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['denyut_nadi'],0,1,'L');
		
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Berat Badan',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['berat_badan'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Lingkar Perut',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['lingkar_perut'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'BMI',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['bmi'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Respirasi',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['respirasi'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Suhu Badan',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['suhu'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Telinga',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['telinga'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Auricula Externa',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['extema'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'MT',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['mt'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Hidung',0,0,'L');
		$pdf->Cell(3,7,':',0,0,'L');
		$pdf->Cell(50,7,$worklist[0]['hidung'],0,1,'L');


		$pdf->SetFont('Arial','B',12);
		$pdf->Cell(5,4,'',0,1);
		$pdf->Cell(100,7,'Saran dan Kesimpulan',0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Saran : ',0,1,'L');
		$pdf->Cell(10,7,'',0,0,'L');
		$pdf->Cell(150,7,$worklist[0]['saran'],0,1,'L');

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(5,7,'',0,1,'L');
		$pdf->Cell(5,7,'',0,0,'L');
		$pdf->Cell(33,7,'Kesimpulan : ',0,1,'L');
		$pdf->Cell(10,7,'',0,0,'L');
		$pdf->Cell(150,7,$worklist[0]['kesimpulan'],0,1,'L');

		$pdf->Output();
		//$pdf->Output('D', "SlipGaji-".$data[0]['nik']."-".$data[0]['nama'].$bln_nama[$bln]."-".$_POST['tahun'].".pdf", true);
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